<?php  
	class studentController extends Controller{
		public function home(){
			check_admin();
			$data = array();
			$student = $this->model('student');
			$center = $this->model('center');
			$data['list_center'] = $center->getCenter()['data'];

			$group = $this->model('group');
			$data['list_group'] = $group->getGroup()['data'];

			$level = $this->model('level');
			$data['list_level'] = $level->getLevel()['data'];

			$branch = $this->model('branch');
			$data['list_branch'] = $branch->getBranch()['data'];
			// $result = $student->getstudent();
			// $data['action_form_import'] = route('student/importExcel');
			$data['action_form_import'] = route('student/importCSV');
			
			
			$link = route('student/home');
			$page = (int)(get('page')?get('page'):1);

			$data['center_code'] 	= $center_code 	= (get('center_code')?get('center_code'):'');
			$data['level_code'] 	= $level_code 	= (get('level_code')?get('level_code'):'');
			$data['stu_code'] 		= $stu_code 	= (get('stu_code')?get('stu_code'):'');
			$data['id_group'] 		= $id_group 	= (get('id_group')?get('id_group'):'');
			$data['branch_code'] 	= $branch_code 	= (get('branch_code')?get('branch_code'):'');

			// echo $stu_code;exit();
			
			$data_student = array(
				'page' => $page,
				'center_code' 	=> $center_code,
				'level_code' 	=> $level_code,
				'stu_code'		=> $stu_code,
				'id_group'		=> $id_group,
				'branch_code'	=> $branch_code
			);
			$result_student = $student->getstudent($data_student);
			$data['result_student'] = $result_student['data'];
			// $data_pageing = array(
			// 	'total' 	=> $result_student['num_rows'],
			// 	'link' 		=> $link,
			// 	'active' 	=> $page,
			// );
			// $data['page'] = $page;
			// $data['pageing'] = pageing($data_pageing);
			$data['action'] = route('student/home');
			// $data['']

			$data['add'] = route('student/addStudent');

			if ($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if ($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}
			
			$this->view('student/home',$data);
		}
		public function edit(){
			check_admin();
			$data = array();
			$id = get('id_student');
			$data['id_student'] = $id;
			$data['action'] = route('student/edit&id_student='.$id);

			$student = $this->model('student');

			$student_info = $student->getStudentById($id);
			$data['event'] = $this->model('event')->listApproveEventStudent($id);
			// listApproveEvent();
			$data['student'] = $student_info;

			// if (method_post()) {
				
			// 		// $password = md5(trim(post('password')));
			// 		// $result = $student->changePassword($id, $password);		
			// 		if ($result) {
			// 			$this->setSession('success', 'เปลี่ยนรหัสผ่านสำเร็จ');
			// 		} else {
			// 			$this->setSession('error', 'ผิดพลาดในการเปลี่ยนรหัส');
			// 		}
			// 		redirect('student/home');
			// 		exit();
			// }
			
			// if ($this->hasSession('success')) {
			// 	$data['success'] = $this->getSession('success');
			// 	$this->rmSession('success');
			// }
			// if ($this->hasSession('error')) {
			// 	$data['error'] = $this->getSession('error');
			// 	$this->rmSession('error');
			// }
			
			$this->view('student/edit',$data);
		}
		public function del(){
			$data = array();

			$id_student = get('id_student');
			$id = get('id');
			$this->model('event')->delTakeEvent($id);
			$this->redirect('student/edit&id_student='.$id_student);
		}
		public function upload() {

			check_admin();
			$data = array();

			$data['action_form_import'] = route('student/importCSV');
			
			
			if ($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if ($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}
			
			$this->view('student/upload',$data);
		}
		public function ajaxGetStudents() {
			$json = array();
			$json['data'] = array();

			$json["draw"] = post('draw');
			$json["recordsTotal"] = post('length');

			if (
				!empty($_POST['stu_code']) || 
				!empty($_POST['branch_code']) ||
				!empty($_POST['id_group']) ||
				!empty($_POST['level_code']) ||
				($_POST['center_code']!=''&&$_POST['center_code']!=null)
			) {


				$student = $this->model('student');

				$start = 0;
				$limit = 10;
				$column = array(
					'',
					's.stu_code',
					's.stu_name',
					'c.center_name',
					'g.group_name',
					'b.branch_name',
					'l.level_name',
				);
				$order = '';
				$by = '';
				$search = '';
				if (isset($_POST['start'])) {
					$start = post('start');
				}
				if (isset($_POST['length'])) {
					$limit = post('length');
				}
				if (isset($_POST['order'][0]['column'])) {
					$order = $column[$_POST['order'][0]['column']];
				}
				if (isset($_POST['order'][0]['column'])) {
					$by = $_POST['order'][0]['dir'];
				}
				if (isset($_POST['search']['value'])&&!empty($_POST['search']['value'])) {
					$search = $_POST['search']['value'];
				}

				$filter = array(
					'start'       => $start,
					'limit'       => $limit,
					'order'       => $order,
					'by'          => $by,
					'search'      => $search,
					'stu_code'    => post('stu_code'),
					'center_code' => post('center_code'),
					'id_group'    => post('id_group'),
					'branch_code' => post('branch_code'),
					'level_code'  => post('level_code')
				);
				$student_info = $student->getStudents($filter);
				if (count($student_info)>0) {
					foreach ($student_info as $key => $val) {
						$json['data'][] = array(
							'no'          => ++$key,
							'stu_code'    => $val['stu_code'],
							'stu_name'    => $val['stu_prefix'].' '.$val['stu_name'].' '.$val['stu_lname'],
							'center_name' => $val['center_name'],
							'group_name'  => $val['group_name'],
							'branch_name' => $val['branch_name'],
							'level_name'  => $val['level_name'],
							'link'        => '<a href="index.php?route=student/password&id_student='.$val['id_student'].'" class="btn btn-primary">รหัสผ่าน</a> <a href="index.php?route=student/edit&id_student='.$val['id_student'].'" class="btn btn-primary">กิจกรรม</a>'
						);
					}
				}

				$json["recordsFiltered"] = $student->countStudents($filter);
			} else {
				$json['data'] = array();
				$json["recordsFiltered"] = 0;	
			}

			

			$this->json($json);
		}
		public function addStudent() {
			$data = array();

			$style = array(
	    		'assets/boostrap_jquery/css/bootstrap-datepicker3.css',
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		'assets/boostrap_jquery/js/bootstrap-datepicker.js',
  				'assets/boostrap_jquery/js/locales/bootstrap-datepicker.en-AU.min.js',
  				'assets/boostrap_jquery/js/jquery-ui.js',
	    	);
	    	$data['script'] = $script;

			$center = $this->model('center');
			$data['list_center'] = $center->getCenter()['data'];

			$group = $this->model('group');
			$data['list_group'] = $group->getGroup()['data'];

			$level = $this->model('level');
			$data['list_level'] = $level->getLevel()['data'];

			$branch = $this->model('branch');
			$data['list_branch'] = $branch->getBranch()['data'];

			$data['prefix'] = array(
				array('name'=>'นาย'),
				array('name'=>'นางสาว'),
				array('name'=>'นาง')
			);

			$data['action'] = route('student/addStudent');

			if (method_post()) {
				$post = $_POST;

				if (post('stu_password')!=post('confirm')) {
					$this->setSession('error', 'รหัสผ่านไม่ตรงกัน');
					redirect('student/addStudent');
					exit();
				}

				$post['id_type_student'] = 1;
				$post['stu_password'] = md5($post['stu_password']);
				unset($post['confirm']);

				$student = $this->model('student');
				$result = $student->addStudent($post);
				if ($result>0) {
					$this->setSession('success', 'เพิ่มนักศึกษาเรียบร้อยแล้ว');
				} else {
					$this->setSession('error', 'เกิดข้อผิดพลาดในการเพิ่มนักศึกษา');
				}
				redirect('student/home');
				exit();
			}

			$this->view('student/form',$data);
		}
		public function password() {
			check_admin();
			$data = array();
			$id = get('id_student');
			$data['id_student'] = $id;
			$data['action'] = route('student/password&id_student='.$id);

			$student = $this->model('student');

			$student_info = $student->getStudentById($id);
			$data['student'] = $student_info;

			if (method_post()) {
				if (post('password')!=post('confirm')) {
					$this->setSession('error','รหัสผ่านไม่ตรงกัน');
					redirect('student/password&id_student='.$id);
					exit();
				} else {
					$password = md5(trim(post('password')));
					$result = $student->changePassword($id, $password);		
					if ($result) {
						$this->setSession('success', 'เปลี่ยนรหัสผ่านสำเร็จ');
					} else {
						$this->setSession('error', 'ผิดพลาดในการเปลี่ยนรหัส');
					}
					redirect('student/home');
					exit();
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
			
			$this->view('student/password',$data);
		}
		public function importCSV() {
			check_admin();
			$path = 'admin/csv/';
			$doc_path = DOCUMENT_ROOT.$path;
			$name = time().'_import_student.csv';
			$result_upload = upload_csv($_FILES['file'],$doc_path, $name);
			// echo '<pre>';
			// print_r($_FILES['file']);
			// echo '</pre>';
			// exit();
			$typename = explode('.', $name);
			$typename = end($typename);
			if (!in_array($typename, array('csv'))) {
				$this->setSession('error', 'กรุณาอัพโหลดไฟล์ csv เท่านั้น');
				redirect('student/home');
			}
			if ($result_upload==true) {
				$insert = array();
				$insert['csv'] = $doc_path.$name;
				$student = $this->model('student');
				$result = $student->muntiInsertStudent($insert);
				if ($result['result']=='success') {
					$student->checkUploadIncorrect();
					$this->setSession('success', 'Import นักศึกษาเรียบร้อยแล้ว');
				} else {
					$this->setSession('error', 'เกิดข้อผิดพลาดในการ Import นักศึกษา');
				}
				$this->genPassword();
				redirect('student/home');
			} else {
				$this->setSession('error', 'เกิดข้อผิดพลาดในการ Upload นักศึกษา');
				redirect('student/home');
			}
		}
		public function importExcel(){ 
			check_admin();
			$path = 'admin/file/';
			$name = time().'_'.$_FILES['file']['name'];
			$result_upload = upload_excel($_FILES['file'],DOCUMENT_ROOT.$path,$name);
			$typename = explode('.', $name);
			$typename = end($typename);
			if (!in_array($typename, array('xls','xlsx'))) {
				$this->setSession('error', 'กรุณาอัพโหลดไฟล์ excel (.xls, .xlsx) เท่านั้น');
				redirect('student/home');
			}
			if($result_upload==true){
				$path = $path.$name;
				$result_excel = readExcel($path);
				$data_excel = array();
				$count = 1;
				$file_csv_output = DOCUMENT_ROOT.'admin/csv/'.time()."_output.csv";
				$output = fopen($file_csv_output,'w') or die("Can't open ".$file_csv_output);
				foreach($result_excel as $val){
					$year = substr($val[0],0,2);
					$data_excel = array(
						'stu_code' 			=> $val[0],
						'center_code' 		=> sprintf("%02d", $val[1]),
						'id_type_student' 	=> $val[2],
						'id_group' 			=> $val[3],
						'branch_code' 		=> $val[4],
						'level_code' 		=> $val[5],
						'stu_prefix' 		=> $val[6],
						'stu_name' 			=> $val[7],
						'stu_lname' 		=> $val[8],
						'stu_birth' 		=> $val[9],
						'stu_year'			=> $year
					);
					fputcsv($output, $data_excel);
					$count++; 
				}
				fclose($output) or die("Can't close ".$file_csv_output);
				
				$student = $this->model('student');
				$data_insert = array(
					'csv' => $file_csv_output
				);
				$result_student = $student->muntiInsertStudent($data_insert);
				exit();
				header('location:index.php?route=student/home');
			} else {
				$this->setSession('error', 'ประเภทไฟล์ไม่ถูกต้อง');
				redirect('student/home');
			}
			
		}
		public function exportExcel(){
			check_admin();
			$data = array();
			$student = $this->model('student');
			$data_excel = $student->exportStudent();
			$FileName = time().'_export.xlsx';
			$path = 'admin/excel/';
			$result = exportExcel($FileName,$path,$data_excel);
			header('location:excel/'.$FileName); 
		}

		public function genPassword() {
			check_admin();
			$student = $this->model('student');
			$student->changeAllPassword();
		}


		public function event() {
			$stu_code = get('stu_code');
			$student = $this->model('student');
			$filter = array('stu_code'=>$stu_code);
			$student_info = $student->getstudent($filter);	
			print_r($student_info);
		}
	}
?>