<?php  
	class activityController extends Controller{
		public function home(){
			check_admin();
			$event = $this->model('event');
			$result_event = $event->getEvent();
			$data['list_event'] = $result_event['data'];
			$data['success'] = '';
			$data['error'] = '';
			if (isset($_GET['result'])) {
				if (get('result')=='success') {
					$data['success'] = 'ลบกิจกรรมสำเร็จ';
				} else {
					$data['error'] = 'เกิดข้อผิดพลาดในการลบ';
				}
			}
			if ($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
			}
			if ($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
			}
			$this->view('activity/home',$data);
		}
		
		public function removeImport() {
			check_admin();
			$data = array();
			$data['action'] = route('activity/removeImport');
			$event = $this->model('event');
			// ? get file in server for ready to delete
			$data['files'] = $event->getUploadEvents();
			
			$dir = 'admin/upload_approve/1597911276_import_ปฐมนิเทศนักศึกษา ภาคพิเศษ ประจำปีการศึกษา 2562.xlsx';
			$result_excel = readExcel($dir,1);
			foreach ($result_excel as $k => $v) {
				var_dump($v[0]);
			}
			
			// $data['files'] = array();
			// if (is_dir($dir)) {
			// 	$ignored = array('.', '..', '.svn', '.htaccess');
			// 	$files = array();    
			// 	foreach (scandir($dir) as $file) {
			// 		if (!in_array($file, $ignored)) { 
			// 			$timestamp = filemtime($dir . '/' . $file);
			// 			$files[$file] = date('d-m-Y H:i:s : ',$timestamp).$file;
			// 		}
			// 	}
			// 	krsort($files);
			// 	// print_r($files);
			// 	$data['files'] = $files;
			// }

			if (method_post()) {
				$file_info = $event->getUploadEvent(post('removefile'));
				$file = 'admin/upload_approve/'.$file_info['file_name'];
				$pathfile = DOCUMENT_ROOT.$file;
				if (file_exists($pathfile)) {
					$result_excel = readExcel($file,1);
					$data_list_stucode = array();
					foreach($result_excel as $val){
						$data_list_stucode[] = $val[0];
					}
					echo '<pre>';
					print_r($data_list_stucode);
					echo '</pre>';
					exit();
				}
			}

			$this->view('activity/removeImport', $data);
		}

		public function import() {
			check_admin();
			$data = array();

			$id_event = get('id_event');
			$event = $this->model('event');
			$event_info = $event->getEvent(array('id_event'=>$id_event));
			$data['event_name'] = $event_info['data'][0]['event_name'];
			$data['action'] = route('activity/import'.'&id_event='.$id_event);

			if(method_post()){
				if(isset($_FILES['file_name'])){
					$data_insert = array();
					$path = 'admin/upload_approve/';
					$name = time().'_import_'.$_FILES['file_name']['name'];
					$result_upload = upload_excel($_FILES['file_name'],DOCUMENT_ROOT.$path,$name);
					$path = $path.$name;
					$result_excel = readExcel($path,1);
					$data_list_stucode = array();
					foreach($result_excel as $val){
						$data_list_stucode[] = $val[0];
					}
					$data_insert['file_name'] = $name;
					$data_insert['list_approve'] = $data_list_stucode;
					$data_insert['id_event'] = $id_event;
					$result_event_upload = $event->approveEventByStuCode($data_insert);
					$data['result'] = $result_event_upload['result'];
					if ($data['result']=='success') {
						$this->setSession('success', 'อัพโหลดเอกสาร นักศึกษาเข้ากิจกรรมเรียบร้อยแล้ว');
					} else {
						$this->setSession('error', 'เกิดข้อผิดพลาดในการอัพโหลดเอกสาร นักศึกษาเข้ากิจกรรม');
					}
					redirect('activity/home');
				}
			}

			$this->view('activity/import', $data);
		}
		public function importCSV() {
			check_admin();
			$data = array();

			$id_event = get('id_event');
			$event = $this->model('event');
			$event_info = $event->getEvent(array('id_event'=>$id_event));
			$data['event_name'] = $event_info['data'][0]['event_name'];
			$data['action'] = route('activity/import'.'&id_event='.$id_event);

			if(method_post()){
				if(isset($_FILES['file_name'])){
					$data_insert = array();
					$path = 'admin/upload_approve/';
					$name = time().'_importcsv_'.$_FILES['file_name']['name'];
					$result_upload = upload_csv($_FILES['file_name'],DOCUMENT_ROOT.$path,$name);
					$path = $path.$name;
					// $result_excel = readExcel($path,1);
					// $data_list_stucode = array();
					// foreach($result_excel as $val){
						// $data_list_stucode[] = $val[0];
					// }
					// $data_insert['file_name'] = $name;
					// $data_insert['list_approve'] = $data_list_stucode;
					// $data_insert['id_event'] = $id_event;
					$result_event_upload = $event->csvApproveEventByStuCode($id_event, $name);

					$data['result'] = $result_event_upload['result'];
					if ($data['result']=='success') {
						$this->setSession('success', 'อัพโหลดเอกสาร นักศึกษาเข้ากิจกรรมเรียบร้อยแล้ว');
					} else {
						$this->setSession('error', 'เกิดข้อผิดพลาดในการอัพโหลดเอกสาร นักศึกษาเข้ากิจกรรม');
					}
					redirect('activity/home');
				}
			}

			$this->view('activity/import', $data);
		}
		public function viewActivity() {
			check_admin();
			$event = $this->model('event');
			$id = get('id_event');
			$filter = array('id_event'=> $id, 't_e_status'=>0);
			$data['event'] = $event->getEventDetail($filter)['data'];
			$result_event = $event->listTakeEvent($filter);
			$data['list_take'] = $result_event;
			// $data['list_event'] = $result_event['data'];

			$data['success'] = '';
			$data['error'] = '';
			if (isset($_GET['result'])) {
				if (get('result')=='success') {
					$data['success'] = 'ลบกิจกรรมสำเร็จ';
				} else {
					$data['error'] = 'เกิดข้อผิดพลาดในการลบ';
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

			$this->view('activity/view',$data);
		}
		public function cancelEvent() {
			check_admin();
			$id_event = get('id_event');
			$id_student = get('id_student');
			$event = $this->model('event');
			$result = $event->changeStatusTakeEvent($id_event, $id_student, 1);
			if ($result) {
				$this->setSession('success', 'ยกเลิกสำเร็จ');
			} else {
				$this->setSession('error', 'เกิดข้อผิดพลาดในการยกเลิก');
			}
			redirect('activity/viewActivity&id_event='.$id_event);
			exit();
		}
		public function delEvent(){
			check_admin();
			
		}
		public function takeEventCancel() {
			check_admin();
			$data = array();

			$event = $this->model('event');
			$filter = array('t_e_status'=>4);
			$data['list_event'] = $event->listTakeEvent($filter);

			if ($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if ($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}

			$this->view('activity/takeEventCancel', $data);
		}
		public function confirmCancelTakeEvent() {
			$id_event = get('id_event');
			$id_student = get('id_student');

			$event = $this->model('event');
			$result = $event->changeStatusTakeEvent($id_event, $id_student, 1);
			// $event->updateEvent($update, $id_event);
			if ($result) {
				$this->setSession('success', 'ยืนยันการยกเลิกกิจกรรมของนักศึกษาสำเร็จ');
			} else {
				$this->setSession('error', 'เกิดข้อผิดพลาดในการยืนยันการยกเลิกกิจจกรมของนักศึกษา');
			}
			redirect('activity/takeEventCancel');
		}
		public function cancelCancelTakeEvent() {
			$id_event = get('id_event');
			$id_student = get('id_student');

			$event = $this->model('event');
			$result = $event->changeStatusTakeEvent($id_event, $id_student, '0');
			if ($result) {
				$this->setSession('success', 'ไม่ยอมรับการยกเลิกกิจกรรมของนักศึกษาสำเร็จ');
			} else {
				$this->setSession('error', 'เกิดข้อผิดพลาดในการ ไม่ยอมรับการยกเลิกกิจจกรมของนักศึกษา');
			}
			redirect('activity/takeEventCancel');
		}
		public function upload(){
			check_admin();
			$data = array();
			$data['action'] = route('activity/upload');
			$data['route'] = 'activity/upload';
			$event = $this->model('event');
			$data['result'] = '';
			if(method_post()){
				if(isset($_FILES['file_name'])){
					$data_insert = array();
					$path = 'admin/upload_approve/';
					$name = time().'_upload_'.$_FILES['file_name']['name'];
					$result_upload = upload_excel($_FILES['file_name'],DOCUMENT_ROOT.$path,$name);
					$path = $path.$name;
					$result_excel = readExcel($path,1);
					$data_list_approve = array();
					foreach($result_excel as $val){
						$data_list_approve[] = $val[0];
					}
					$data_insert['file_name'] = $name;
					$data_insert['list_approve'] = $data_list_approve;
					$result_event_upload = $event->approveEvent($data_insert);
					$data['result'] = $result_event_upload['result'];
				}
			}
			$data['list_upload'] = $event->listUploadEvent();
			$this->view('activity/upload',$data);
		}
		public function form(){
			check_admin();
			$id_event = get('id_event');

			if(method_post()){
				$id_event = $_POST['id_event'];
				$event = $this->model('event');
				$data = $_POST;
				if(isset($_FILES['event_file'])){
					$path = DOCUMENT_ROOT.'uploads/files/';
					$name = time();
					$file_name = upload($_FILES['event_file'],$path,$name);
					$data['event_file'] = $file_name;
				}
				$result_edit_event = $event->actionEvent($data);
				$para_id_event = '';
				if($id_event){
					$para_id_event = '&id_event='.$id_event.'&result=sucess';
					redirect('activity/form'.$para_id_event);
				}else{
					redirect('activity/home'.$para_id_event);
				}
				
			}
			$data['result'] = get('result');

			$data['success'] = '';
			$data['error'] = '';
			if (isset($_GET['result'])) {
				if (get('result')=='success') {
					$data['success'] = 'จัดการกิจกรรมสำเร็จ';
				} else {
					$data['error'] = 'เกิดข้อผิดพลาดในจัดการกิจกรรม';
				}
			}
			
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
	    	$event = $this->model('event');
	    	$data_event = array(
	    		'id_event' => $id_event
	    	);
	    	$result_event_detail = $event->getEventDetail($data_event);
	    	$data['data'] = $result_event_detail['data'];
	    	$data['sub'] = $result_event_detail['sub'];

	    	$student = $this->model('student');
	    	$data['route'] = 'activity/form';
	    	$data['id_event'] = get('id_event');
	    	$data['action'] = route($data['route']);
	    	$data['list_event'] = $event->getEventType()['data'];
	    	$data['list_type_student'] = $student->getTypeStudent()['data'];
			$this->view('activity/form',$data);
		}
		public function delete() {
			check_admin();
			$id_event = get('id_event');
			if (!isset($id_event)||empty($id_event)) {
				redirect('activity/home');
			}
			$event = $this->model('event');
			$result = $event->delEvent($id_event);
			redirect('activity/home'.'&result='.$result['result']);
		}
	}
?>