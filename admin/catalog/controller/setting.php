<?php  
	class settingController extends Controller{

		public function home() {
			check_admin();
			$data = array();
			if($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}
			$data['action'] = route('setting/home');
			$system = $this->model('system');
			$data['setting_allpassevent'] = $system->getSystem('setting_allpassevent')['system_value'];
			$data['setting_passevent'] = $system->getSystem('setting_passevent')['system_value'];
			$data['setting_maxevent'] = $system->getSystem('setting_maxevent')['system_value'];
			if (method_post()) {
				$result = $system->editSystem($_POST);
				if ($result) {
					$this->setSession('success', 'แก้ไข สำเร็จ');
				} else {
					$this->setSession('error', 'เกิดข้อผิดพลาดในการ แก้ไข');
				}
				redirect('setting/home');
				exit();
			}
			$this->view('setting/home',$data);
		}



		// ! มหาวิทยาลัย ==================================================
		public function center() {
			check_admin();
			$data = array();

			$center = $this->model('center');
			$data['results'] = $center->getLists();

			if ($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if ($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}

			$this->view('setting/center', $data);
		}

		public function center_form() {
			check_admin();
			$data = array();
			$center = $this->model('center');
			$id = get('id');
			$data['action'] = route('setting/center_form', ($id>0 ? '&id='.$id : ''));

			if ($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if ($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}

			if ($id>0) {
				$result = $center->getList($id);
				$data['id_code_center'] = $result['id_code_center'];
				$data['center_code'] = $result['center_code'];
				$data['center_name'] = $result['center_name'];
			}

			if (method_post()) {
				$post = $_POST;
				
				$check = $center->countCenterByCode($_POST['center_code']);
				if ($check>0) {
					$this->setSession('error', 'รหัส '.$_POST['center_code'].' มีใช้งานอยู่แล้ว');
					redirect('setting/center_form', ($id>0?'&id='.$id:''));
					exit();
				}
				if (isset($id)&&$id>0) {
					$post['date_modify'] = date('Y-m-d H:i:s');
					$result = $center->edit($id, $post);
					if ($result==1) {
						$this->setSession('success', 'แก้ไขเรียนร้อยแล้ว');
					} else {
						$this->setSession('error', 'แก้ไขผิดพลาด');
					}
				} else {
					$post['date_added'] = date('Y-m-d H:i:s');
					$result = $center->add($post);
					if ($result>0) {
						$this->setSession('success', 'เพิ่มเรียบร้อยแล้ว');
					} else {
						$this->setSession('error', 'แก้ไขผิดพลาด');
					}
				}
				redirect('setting/center');
			}
			

			$this->view('setting/center_form', $data);
		}

		public function center_del() {
			check_admin();
			$id = get('id');
			$center = $this->model('center');
			$update = array('del'=>1);
			$center->edit($id, $update);
			redirect('setting/center');
		}


		// ! คณะ ==================================================
		public function group() {
			check_admin();
			$data = array();

			$group = $this->model('group');
			$data['results'] = $group->getLists();

			if ($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if ($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}

			$this->view('setting/group', $data);
		}

		public function group_form() {
			check_admin();
			$data = array();
			$group = $this->model('group');
			$id = get('id');
			$data['action'] = route('setting/group_form', ($id>0 ? '&id='.$id : ''));

			if ($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if ($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}

			if ($id>0) {
				$result = $group->getList($id);
				$data['id_group'] = $result['id_group'];
				$data['group_name'] = $result['group_name'];
			}

			if (method_post()) {
				$post = $_POST;
				
				// $check = $group->countgroupByCode($_POST['group_code']);
				// if ($check>0) {
				// 	$this->setSession('error', 'รหัส '.$_POST['group_code'].' มีใช้งานอยู่แล้ว');
				// 	redirect('setting/group_form', ($id>0?'&id='.$id:''));
				// 	exit();
				// }
				if (isset($id)&&$id>0) {
					$post['date_modify'] = date('Y-m-d H:i:s');
					$result = $group->edit($id, $post);
					if ($result==1) {
						$this->setSession('success', 'แก้ไขเรียนร้อยแล้ว');
					} else {
						$this->setSession('error', 'แก้ไขผิดพลาด');
					}
				} else {
					$post['date_added'] = date('Y-m-d H:i:s');
					$result = $group->add($post);
					if ($result>0) {
						$this->setSession('success', 'เพิ่มเรียบร้อยแล้ว');
					} else {
						$this->setSession('error', 'แก้ไขผิดพลาด');
					}
				}
				redirect('setting/group');
			}
			

			$this->view('setting/group_form', $data);
		}

		public function group_del() {
			check_admin();
			$id = get('id');
			$group = $this->model('group');
			$update = array('del'=>1);
			$group->edit($id, $update);
			redirect('setting/group');
		}


		// ! สาขา ==================================================// ! คณะ ==================================================
		public function branch() {
			check_admin();
			$data = array();

			$id_group = get('id_group');
			$data['id_group'] = $id_group;
			$group = $this->model('group');
			$data['group'] = $group->getList($id_group);
			$data['groups'] = $group->getLists();

			$branch = $this->model('branch');
			$filter = array('id_group'=>$id_group);
			$data['results'] = $branch->getLists($filter);


			if ($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if ($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}

			$this->view('setting/branch', $data);
		}

		public function branch_form() {
			check_admin();
			$data = array();
			$id_group = get('id_group');
			$data['id_group'] = $id_group;
			$group = $this->model('group');
			$data['group'] = $group->getList($id_group);
			$data['groups'] = $group->getLists();

			$branch = $this->model('branch');
			$id = get('id');
			$data['action'] = route('setting/branch_form', '&id_group='.get('id_group').($id>0 ? '&id='.$id : ''));

			if ($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if ($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}

			if ($id>0) {
				$result = $branch->getList($id);
				$data['id_branch'] = $result['id_branch'];
				$data['branch_code'] = $result['branch_code'];
				$data['branch_name'] = $result['branch_name'];
			}

			if (method_post()) {
				$post = $_POST;
				$id_group = post('id_group');
				
				if ($id>0) {
					$check = $branch->countBranchByCode(post('branch_code'), $id);
				} else {
					$check = $branch->countBranchByCode(post('branch_code'));
				}
				
				if ($check>0) {
					$this->setSession('error', 'รหัส '.post('branch_code').' มีใช้งานอยู่แล้ว');
					redirect('setting/branch_form', '&id_group='.get('id_group').($id>0?'&id='.$id:''));
					exit();
				}
				if (isset($id)&&$id>0) {
					$post['date_modify'] = date('Y-m-d H:i:s');
					$result = $branch->edit($id, $post);
					if ($result==1) {
						$this->setSession('success', 'แก้ไขเรียนร้อยแล้ว');
					} else {
						$this->setSession('error', 'แก้ไขผิดพลาด');
					}
				} else {
					$post['date_added'] = date('Y-m-d H:i:s');
					$result = $branch->add($post);
					if ($result>0) {
						$this->setSession('success', 'เพิ่มเรียบร้อยแล้ว');
					} else {
						$this->setSession('error', 'แก้ไขผิดพลาด');
					}
				}
				redirect('setting/branch','&id_group='.$id_group);
			}
			

			$this->view('setting/branch_form', $data);
		}

		public function branch_del() {
			check_admin();
			$id = get('id');
			$branch = $this->model('branch');
			$update = array('del'=>1);
			$branch->edit($id, $update);
			redirect('setting/branch','&id_group='.get('id_group'));
		}




		

		public function event() {
			check_admin();
			$data = array();
			$event = $this->model('event');
			$data['event_types'] = $event->getEventType()['data'];
			if($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}
			$this->view('setting/event',$data);
		}
		public function event_form() {
			check_admin();
			$id = get('id');
			$data = array();
			$event = $this->model('event');
			$data['event_type_name']   = '';
			$data['event_type_status'] = 1;
			$data['status'] = array(
				array('key' => 0,  'text' => 'ปิด'),
				array('key' => 1,  'text' => 'เปิด'),
			);
			$parameter = '';
			if (!empty($id)) {
				$parameter = '&id='.$id;
			}
			$data['action'] = route('setting/event_form'.$parameter);
			if (method_post()) {
				$post = array(
					'event_type_name' => post('event_type_name'),
					'event_type_status' => post('event_type_status'),
				);
				if (empty($id)) {
					$result = $event->addEventType($post);
					if ($result>0) {
						$this->setSession('success', 'เพิ่มกิจกรรม สำเร็จ');
					} else {
						$this->setSession('error', 'เกิดข้อผิดพลาดในการ เพิ่มกิจกรรม');
					}
				} else {
					$result = $event->editEventType($post, $id);
					if ($result>0) {
						$this->setSession('success', 'แก้ไขกิจกรรม สำเร็จ');
					} else {
						$this->setSession('error', 'เกิดข้อผิดพลาดในการ แก้ไขกิจกรรม');
					}
				}
				redirect('setting/event');
				exit();
			}
			if (!empty($id)) {
				$result = $event->getEventTypeById($id);
				$data['event_type_name'] = $result['event_type_name'];
				$data['event_type_status'] = $result['event_type_status'];
			}
			$this->view('setting/event_form',$data);	
		}
		public function event_del() {
			check_admin();
			$id = get('id');
			$data = array();
			$event = $this->model('event');
			if (!empty($id)) {
				$result = $event->delEventType($id);
				if ($result>0) {
					$this->setSession('success', 'ลบกิจกรรม สำเร็จ');
				} else {
					$this->setSession('error', 'เกิดข้อผิดพลาดในการ ลบกิจกรรม');
				}
			} else {
				$this->setSession('error', 'เกิดข้อผิดพลาดในการ ลบกิจกรรม');
			}
			redirect('setting/event');
			exit();
		}

		

		public function student() {
			check_admin();
			$data = array();
			$student = $this->model('student');
			$data['students'] = $student->getTypeStudent()['data'];
			if($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}
			$this->view('setting/student',$data);
		}
		public function student_form() {
			check_admin();
			$id = get('id');
			$data = array();
			$student = $this->model('student');
			$data['type_student_name']   = '';
			$data['type_student_status'] = 1;
			$data['status'] = array(
				array('key' => 0,  'text' => 'ปิด'),
				array('key' => 1,  'text' => 'เปิด'),
			);
			$parameter = '';
			if (!empty($id)) {
				$parameter = '&id='.$id;
			}
			$data['action'] = route('setting/student_form'.$parameter);
			if (method_post()) {
				$post = array(
					'type_student_name' => post('type_student_name'),
					'type_student_status' => post('type_student_status'),
				);
				if (empty($id)) {
					$result = $student->addTypeStudent($post);
					if ($result>0) {
						$this->setSession('success', 'เพิ่มประเภทนักศึกษา สำเร็จ');
					} else {
						$this->setSession('error', 'เกิดข้อผิดพลาดในการ เพิ่มประเภทนักศึกษา');
					}
				} else {
					$result = $student->editTypeStudent($post, $id);
					if ($result>0) {
						$this->setSession('success', 'แก้ไขประเภทนักศึกษา สำเร็จ');
					} else {
						$this->setSession('error', 'เกิดข้อผิดพลาดในการ แก้ไขประเภทนักศึกษา');
					}
				}
				redirect('setting/student');
				exit();
			}
			if (!empty($id)) {
				$result = $student->getTypeStudentById($id);
				$data['type_student_name'] = $result['type_student_name'];
				$data['type_student_status'] = $result['type_student_status'];
			}
			$this->view('setting/student_form',$data);	
		}
		public function student_del() {
			check_admin();
			$id = get('id');
			$data = array();
			$student = $this->model('student');
			if (!empty($id)) {
				$result = $student->delTypeStudent($id);
				if ($result>0) {
					$this->setSession('success', 'ลบประเภทนักศึกษา สำเร็จ');
				} else {
					$this->setSession('error', 'เกิดข้อผิดพลาดในการ ลบประเภทนักศึกษา');
				}
			} else {
				$this->setSession('error', 'เกิดข้อผิดพลาดในการ ลบประเภทนักศึกษา');
			}
			redirect('setting/student');
			exit();
		}


		public function year() {
			check_admin();
			$data = array();
			$year = $this->model('year');
			$data['year'] = $year->getStudentYear();
			if($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}
			$this->view('setting/year',$data);
		}
		public function year_form() {
			check_admin();
			$id = get('id');
			$data = array();
			$year = $this->model('year');
			$data['year_name']   = '';
			$data['year_status'] = 1;
			$data['status'] = array(
				array('key' => 0,  'text' => 'ปิด'),
				array('key' => 1,  'text' => 'เปิด'),
			);
			$parameter = '';
			if (!empty($id)) {
				$parameter = '&id='.$id;
			}
			$data['action'] = route('setting/year_form'.$parameter);
			if (method_post()) {
				$post = array(
					'year_name' => post('year_name'),
					'year_status' => post('year_status'),
				);
				if (empty($id)) {
					$result = $year->addStudentYear($post);
					if ($result>0) {
						$this->setSession('success', 'เพิ่มประเภทนักศึกษา สำเร็จ');
					} else {
						$this->setSession('error', 'เกิดข้อผิดพลาดในการ เพิ่มประเภทนักศึกษา');
					}
				} else {
					$result = $year->editStudentYear($post, $id);
					if ($result>0) {
						$this->setSession('success', 'แก้ไขประเภทนักศึกษา สำเร็จ');
					} else {
						$this->setSession('error', 'เกิดข้อผิดพลาดในการ แก้ไขประเภทนักศึกษา');
					}
				}
				redirect('setting/year');
				exit();
			}
			if (!empty($id)) {
				$result = $year->getStudentYearById($id);
				$data['year_name'] = $result['year_name'];
				$data['year_status'] = $result['year_status'];
			}
			$this->view('setting/year_form',$data);	
		}
		public function year_del() {
			check_admin();
			$id = get('id');
			$data = array();
			$year = $this->model('year');
			if (!empty($id)) {
				$result = $year->delStudentYear($id);
				if ($result>0) {
					$this->setSession('success', 'ลบประเภทนักศึกษา สำเร็จ');
				} else {
					$this->setSession('error', 'เกิดข้อผิดพลาดในการ ลบประเภทนักศึกษา');
				}
			} else {
				$this->setSession('error', 'เกิดข้อผิดพลาดในการ ลบประเภทนักศึกษา');
			}
			redirect('setting/year');
			exit();
		}
	}
?>