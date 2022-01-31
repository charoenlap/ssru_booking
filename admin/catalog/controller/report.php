<?php  
	class reportController extends Controller{
		public function activity(){
			check_admin();
			$data = array();
			$data['action'] = route('report/activity');
			$event = $this->model('event');
			$filter = array();
			$data['event_list'] = $event->getEvent($filter)['data'];
			$data['event_list'][] = array('id_event'=>'', 'event_name'=>'');
			$data['listTakeEvent'] = array();
			$data['id_event'] = '';
			if (method_post()) {
				$data['id_event'] = post('id_event');
				$filter = array('id_event'=> post('id_event'));
				$listevent = $event->listTakeEvent($filter);	
				$data['listTakeEvent'] = array();
				foreach ($listevent as $value) {
					$status = '';
					switch ($value['event_status']) {
						case 0: $status='จอง'; break;
						case 1: $status='ยกเลิก'; break;
						case 2: $status='ยืนยัน'; break;
						case 3: $status='สำเร็จ'; break;
						case 4: $status='รอยกเลิก'; break;
						default: $status=''; break;
					}
					$data['listTakeEvent'][] = array(
						'stu_code'        => $value['stu_code'],
						'stu_name'        => $value['stu_name'],
						'stu_lname'       => $value['stu_lname'],
						'status'          => $status,
						'take_event_date' => $value['take_event_date'],
					);
				}
			}
			if ($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if ($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}
			$this->view('report/activity',$data);
		}
		public function bookingActivity(){

			check_admin();
			$data = array();
			$data['action'] = route('report/bookingActivity');

			$group = $this->model('group');
			$data['list_group'] = $group->getGroup()['data'];
			
			$branch = $this->model('branch');
			$data['list_branch'] = $branch->getBranch()['data'];
			

			$data['stu_year'] = '';
			$data['id_group'] = '';
			$data['branch_code'] = '';

			$data['result'] = array();

			if (method_post()) {
				$data['stu_year'] = post('stu_year');
				$data['id_group'] = post('id_group');
				$data['branch_code'] = post('branch_code');				

				

				$event = $this->model('event');
				$filter = array(
					's.stu_year' => $data['stu_year'],
					'g.id_group' => $data['id_group'],
					'b.branch_code' => $data['branch_code']
				);
				$data['result'] = $event->listApproveEvent($filter);
				foreach ($data['result'] as $key => $value) {
					$data['result'][$key]['result'] = ($value['event_unit']>=80) ? '<span class="text-success">ผ่าน</span>' : '<span class="text-danger">ไม่ผ่าน ('.$value['event_unit'].')</span>';
				}
			}

			$this->view('report/bookingActivity', $data);
		}
		public function statusActivity() {
			check_admin();
			$data = array();
			$data['action'] = route('report/statusActivity');

			$group = $this->model('group');
			$data['list_group'] = $group->getGroup()['data'];
			$branch = $this->model('branch');
			$data['list_branch'] = $branch->getBranch()['data'];
			$event = $this->model('event');
			$data['list_eventtype'] = $event->getEventType()['data'];

			$data['stu_year'] = '';
			$data['id_group'] = '';
			$data['branch_code'] = '';

			$data['result'] = array();

			// $data['pagination'] = '';

			$data['column'] = array();
			$column = array();
			$column[] =  array('data'=>'no');
			$column[] =  array('data'=>'stu_code');
			$column[] =  array('data'=>'name');
			$column[] =  array('data'=>'center');
			$column[] =  array('data'=>'branch');

			$event = $this->model('event');
			$list_eventtype = $event->getEventType()['data'];
			foreach ($list_eventtype as $key => $value) {
				$column[] =  array('data'=>'event_'.$value['id_event_type']);
			}

			$column[] =  array('data'=>'pass');
			$column[] =  array('data'=>'receipt');
			$data['column'] = json_encode($column);

			if (method_post()) {
				$system = $this->model('system');
				$passevent = $system->getSystem('setting_allpassevent')['system_value'];
				$setting_passevent = $system->getSystem('setting_passevent')['system_value'];

				$data['stu_year'] = post('stu_year');
				$data['id_group'] = post('id_group');
				$data['branch_code'] = post('branch_code');	
				$filter = array(
					's.stu_year'    => $data['stu_year'],
					'g.id_group'    => $data['id_group'],
					'b.branch_code' => $data['branch_code']
				);
				$student = $this->model('student');
				$data['result'] = $student->getStudentsHasEvent($filter);
				foreach ($data['result'] as $key => $result) {
					$event_type = $event->getEventType()['data'];
					$data['result'][$key]['sum_event_type'] = 0;
					$check = true;
					$k = 0;
					foreach ($event_type as $et) {
						$num = (double)$event->getUnitByEventTypeAndStudent($et['id_event_type'],$result['id_student']);
						if ($num<=$setting_passevent&&$k!=0) {
							$check = false;
						}
						$k++;
						$data['result'][$key]['event_type'][$et['id_event_type']] = $num;
						$data['result'][$key]['sum_event_type'] += $num;
					}
					// $data['result'][$key]['pass'] = ($data['result'][$key]['sum_event_type']>=$passevent ? '<span class="text-success">ผ่าน</span>' : '<span class="text-danger">ไม่ผ่าน</span>');
					$data['result'][$key]['pass'] = ($check==true ? '<span class="text-success">ผ่าน</span>' : '<span class="text-danger">ไม่ผ่าน</span>');
					// $data['result'][$key]['receipt'] = ($data['result'][$key]['sum_event_type']>=$passevent ? '<span class="text-success">ได้รับ</span>' : '<span class="text-danger">ไม่ได้รับ</span>');
					$data['result'][$key]['receipt'] = ($check==true ? '<span class="text-success">ได้รับ</span>' : '<span class="text-danger">ไม่ได้รับ</span>');

				}

				// $config_page = array(
				// 	'total'=>count($data['result']),
				// 	'link' => route('report/statusActivity'),
				// 	'active' => (isset($_GET['page']) ? $_GET['page'] : 1)
				// );
				// $data['pagination'] = pageing($config_page);
			}


			$this->view('report/statusActivity', $data);
		}

		public function ajaxReportStatusActivity() 
		{
			$json = array();
			$json["draw"] = post('draw');
			$json["recordsTotal"] = post('length');

			$system = $this->model('system');
			$passevent = $system->getSystem('setting_allpassevent')['system_value'];

			$data['stu_year'] = post('stu_year');
			$data['id_group'] = post('id_group');
			$data['branch_code'] = post('branch_code');	
			$filter = array(
				's.stu_year'    => $data['stu_year'],
				'g.id_group'    => $data['id_group'],
				'b.branch_code' => $data['branch_code']
			);
			
			$student = $this->model("student");
			$json["recordsFiltered"] = $student->countStudentsHasEvent($filter);

			$json['data'] = array();
			// $start = post('start');
			// $limit = post('length');
			// $student = $this->model('student');
			// $json['data'] = $student->getStudentsHasEvent($filter, $start, $limit);
			// foreach ($json['data'] as $key => $result) {
			// 	$event_type = $event->getEventType()['data'];
			// 	$json['data'][$key]['sum_event_type'] = 0;
			// 	foreach ($event_type as $et) {
			// 		$num = (double)$event->getUnitByEventTypeAndStudent($et['id_event_type'],$result['id_student']);
			// 		$json['data'][$key]['event_type'][$et['id_event_type']] = $num;
			// 		$json['data'][$key]['sum_event_type'] += $num;
			// 	}
			// 	$json['data'][$key]['pass'] = ($json['data'][$key]['sum_event_type']>=$passevent ? '<span class="text-success">ผ่าน</span>' : '<span class="text-danger">ไม่ผ่าน</span>');
			// 	$json['data'][$key]['receipt'] = ($json['data'][$key]['sum_event_type']>=$passevent ? '<span class="text-success">ได้รับ</span>' : '<span class="text-danger">ไม่ได้รับ</span>');
			// }

			$this->json($json);
		}


		public function export() {
			$type = get('type');
			if ($type==1) {
				$this->export_type1();
			} else if ($type==2) {
				$this->export_type2();
			} else if ($type==3) {
				$this->export_type3();
			}
		}
		private function export_type1() {
			$id_event = get('id_event');
			if (empty($id_event)) {
				$this->setSession('error', 'ไม่ได้เลือกกิจกรรม');
				redirect('report/activity');
			}

			$event = $this->model('event');
			$event_info = $event->getEvent(array('id_event'=>$id_event));

			$export = array();
			$export[] = array($event_info['data'][0]['event_name']);
			$export[] = array(
				'ลำดับ',
				'รหัสนักศึกษา',
				'ชื่อ-นามสกุล',
				'สถานะ',
				'วัน เวลา',
			);

			$filter = array('id_event'=> $id_event);
			$lists = $event->listTakeEvent($filter);
			foreach ($lists as $key => $value) {
				$status = '';
				switch ($value['event_status']) {
					case 0: $status='จอง'; break;
					case 1: $status='ยกเลิก'; break;
					case 2: $status='ยืนยัน'; break;
					case 3: $status='สำเร็จ'; break;
					case 4: $status='รอยกเลิก'; break;
					default: $status=''; break;
				}
				$export[] = array(
					++$key,
					$value['stu_code'],
					$value['stu_name'].' '.$value['stu_lname'],
					$status,
					$value['take_event_date']
				);
			}
			$name = 'export_event_activity.xlsx';
			exportExcel($name,'admin/excel/', $export, 'กิจกรรม');
			header('location:'.MURL.'admin/excel/'.$name);
			exit();
		}
		private function export_type2() {
			
			$stu_year = get('stu_year');
			$id_group = get('id_group');
			$branch_code = get('branch_code');	

			if (empty($stu_year)||empty($id_group)||empty($branch_code)) {
				$this->setSession('error', 'ไม่พบตัวเลือก');
				redirect('report/activity');
			}

			$group = $this->model('group');
			$group_info = $group->getGroupById($id_group);
			$branch = $this->model('branch');
			$branch_info = $branch->getBranchByCode($branch_code);

			$export = array();
			$export[] = array('สรุปผลเข้าร่วมกิจกรรมของนักศึกษา ประจำปีการศึกษา 25'.$stu_year);
			$export[] = array($group_info['group_name'].' '.$branch_info['branch_name']);
			$export[] = array(
				'ลำดับ',
				'รหัสนักศึกษา',
				'ชื่อ-นามสกุล',
				'คณะ',
				'สาขาวิชา',
				'สรุปผลเข้าร่วมกิจกรรม',
			);


			$event = $this->model('event');
			$list = $event->listApproveEvent();
			foreach ($list as $key => $value) {
				$pass = ($value['event_unit']>=80) ? 'ผ่าน' : 'ไม่ผ่าน ('.$value['event_unit'].')';
				$export[] = array(
					++$key,
					$value['stu_code'],
					$value['stu_name'].' '.$value['stu_lname'],
					$value['group_name'],
					$value['branch_name'],
					$pass
				);
			}

			$name = 'export_eventpass.xlsx';
			exportExcel($name,'admin/excel/', $export, 'กิจกรรม');
			header('location:'.MURL.'admin/excel/'.$name);
			exit();
		}
		private function export_type3() {
			
			$stu_year = get('stu_year');
			$id_group = get('id_group');
			$branch_code = get('branch_code');	

			if (empty($stu_year)||empty($id_group)||empty($branch_code)) {
				$this->setSession('error', 'ไม่พบตัวเลือก');
				redirect('report/activity');
			}

			$group = $this->model('group');
			$group_info = $group->getGroupById($id_group);
			$branch = $this->model('branch');
			$branch_info = $branch->getBranchByCode($branch_code);

			$export = array();
			$export[] = array('สรุปผลเข้าร่วมกิจกรรมของนักศึกษา ประจำปีการศึกษา 25'.$stu_year);
			$export[] = array($group_info['group_name'].' '.$branch_info['branch_name']);
			
			$event = $this->model('event');
			$system = $this->model('system');
			$passevent = $system->getSystem('setting_allpassevent')['system_value'];
			$column = array(
				'ลำดับ',
				'รหัสนักศึกษา',
				'ชื่อ-นามสกุล',
				'คณะ',
				'สาขาวิชา',
			);
			$event_type = $event->getEventType()['data'];
			foreach ($event_type as $et) {
				$column[] = $et['event_type_name'];
			}
			$column[] = 'สรุปรวมหน่วยกิจกรรม';
			$column[] = 'เกณฑ์กิจกรรม';
			$column[] = 'เกณฑ์ใบรับรอง';
			$export[] = $column;

			$setting_passevent = $system->getSystem('setting_passevent')['system_value'];

			$filter = array(
				's.stu_year'    => $stu_year,
				'g.id_group'    => $id_group,
				'b.branch_code' => $branch_code
			);
			$student = $this->model('student');
			$last_result = $student->getStudentsHasEvent($filter);
			foreach ($last_result as $key => $result) {
				$event_type = $event->getEventType()['data'];
				$sum = 0;
				$event_type_value = array();

				$event_type = $event->getEventType()['data'];
				$last_result[$key]['sum_event_type'] = 0;
				$k = 0;
				$check = true;
				foreach ($event_type as $et) {
					$num = (double)$event->getUnitByEventTypeAndStudent($et['id_event_type'],$result['id_student']);
					if ($num<=$setting_passevent&&$k!=0) {
						$check = false;
					}
					$k++;
					$last_result[$key]['event_type'][$et['id_event_type']] = $num;
					$last_result[$key]['sum_event_type'] += $num;
					$event_type_value[$et['id_event_type']] = $num;
					$sum += $num;
				}
				// $pass = ($last_result[$key]['sum_event_type']>=$passevent ? 'ผ่าน' : 'ไม่ผ่าน');
				// $receipt = ($last_result[$key]['sum_event_type']>=$passevent ? 'ได้รับ' : 'ไม่ได้รับ');
				$pass = $check==true ? 'ผ่าน' : 'ไม่ผ่าน';
				$receipt = $check==true ? 'ได้รับ' : 'ไม่ได้รับ';

				$column = array(
					++$key,
					$result['stu_code'],
					$result['stu_prefix'].' '.$result['stu_name'].' '.$result['stu_lname'],
					$result['group_name'],
					$result['branch_name'],
				);

				foreach ($event_type as $et) {
					$column[] = $event_type_value[$et['id_event_type']];
				}
				$column[] = $sum;
				$column[] = $pass;
				$column[] = $receipt;
				$export[] = $column;

			}

			$name = 'export_eventpassstudent.xlsx';
			exportExcel($name,'admin/excel/', $export, 'สรุปผลเข้าร่วมกิจกรรมของนักศึกษา');
			header('location:'.MURL.'admin/excel/'.$name);
			exit();
		}

		public function getBranchByGroupId() {
			if (method_post()) {
				$branch = $this->model('branch');
				$list_branch = $branch->getBrnachByGroupId(post('id_group'));
				$html = Form::select('branch_code',$list_branch,'','branch_code','branch_name', post('default'));
				echo $html;
				exit();
			}
		}

		public function checkActivity(){
			check_admin();
			$this->view('report/checkActivity');
		}
	}
?>