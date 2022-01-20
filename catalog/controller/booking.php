<?php  
	class bookingController extends Controller{
		public function home(){
			$data = array();
			// debug($_SESSION);
			$data['stu_detail'] = $this->getSession('stu_detail');
			$current_year = getCurrentYear((int)$data['stu_detail']['stu_year']);
			// debug($current_year);
			// debug($data['stu_detail']);
			
			$id_student = id_student();
			$event = $this->model('event');
			$data['status'] = get('status');
			$data['take_event'] = array();
			$result_take_event = $event->getTakeEvent( array('id_student'=>$id_student, 'status'=>3) );
			// var_dump($result_take_event);
			foreach($result_take_event as $val){
				$data['take_event'][] = $val['id_event'];
			}
			$data['cancelevent'] = array();
			$result_cancelevent = $event->getTakeEvent( array('id_student'=>$id_student, 'status'=>4) );
			foreach($result_cancelevent as $val){
				$data['cancelevent'][] = $val['id_event'];
			}
			$date_start = get('date_start');
			$date_end 	= get('date_end');
			$txt_event_type = get('list_event_type');
			$data_event = array(
				'date_start'		=> $date_start,
				'date_end'			=> $date_end,
				'list_event_type'	=> $txt_event_type,
				'current_year' 		=> $current_year,
				'id_type_student'	=> $data['stu_detail']['id_type_student']
			);
			$data['list_event'] = array();
			$system = $this->model('system');
			$setting_maxevent = $system->getSystem('setting_maxevent')['system_value'];

			$data['list_event'] = $event->listEvent($data_event);
			$data['list_event_type']    = $event->listTypeEvent();
			$data['id_student']         = $id_student;
			$data['stu_code']           = $this->getSession('stu_code');
			$data['stu_prefix']         = $this->getSession('stu_prefix');
			$data['stu_name']           = $this->getSession('stu_name');
			$data['stu_lname']          = $this->getSession('stu_lname');
			$data['stu_group']          = $this->getSession('stu_group');
			$data['stu_branch']         = $this->getSession('stu_branch');
			$data['stu_point_behavior'] = (int)$this->getSession('stu_point_behavior');
			$data['stu_point_event']    = (int)$this->getSession('stu_point_event').'/'.$setting_maxevent;
			$data['stu_code_edu']       = $this->getSession('stu_code_edu');
			$data['date']               = date('Y-m-d');
			$data['date_start']         = (empty($date_start)?$data['date']:$date_start);
			$data['date_end']           = (empty($date_end)?$data['date']:$date_end);
			$data['txt_event_type']     = $txt_event_type;


	    	$data['action'] = route('booking/home');

			$this->view('booking/home',$data);
		}
		public function booking(){
			$data = array();
			$id_student = id_student();
			$data['id_student']         = $id_student;
			$data['stu_code']           = $this->getSession('stu_code');
			$data['stu_prefix']         = $this->getSession('stu_prefix');
			$data['stu_name']           = $this->getSession('stu_name');
			$data['stu_lname']          = $this->getSession('stu_lname');
			$data['stu_group']          = $this->getSession('stu_group');
			$data['stu_branch']         = $this->getSession('stu_branch');
			$data['stu_point_behavior'] = (int)$this->getSession('stu_point_behavior');
			$data['stu_point_event']    = (int)$this->getSession('stu_point_event');
			$data['stu_code_edu']       = $this->getSession('stu_code_edu');
			$data['stu_detail']         = $this->getSession('stu_detail');

			$event = $this->model('event');

			$data['reserve'] = $event->getTakeEvent( array('id_student'=>$id_student,'status'=>0) );
			$data['cancle']  = $event->getTakeEvent( array('id_student'=>$id_student,'status'=>4) );
			$data['history'] = $event->getTakeEvent( array('id_student'=>$id_student,'status'=>3) );
			// var_dump($data['reserve']);

			if ($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if ($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}

			$this->view('booking/booking',$data);
		}
		public function cancelEvent() {
			$id_take_event = get('id_take_event');
			if (empty($id_take_event)) {
				$this->setSession('error','ไม่พบกิจกรรม');
				redirect('booking/booking');
				exit();
			}

			$event = $this->model('event');
			$result = $event->delTakeEvent($id_take_event);
			if ($result) {
				$this->setSession('success', 'ยกเลิกกิจจกรมแล้ว');
			} else {
				$this->setSession('error', 'เกิดข้อผิดพลาดในการยกเลิก กรุณาติดต่อเจ้าหน้าที่');
			}
			redirect('booking/booking');
		}
		public function takeEvent(){
			$id_event_sub = get('id_event_sub');
			$id_student = (int)id_student();
			$stu_code = $this->getSession('stu_code');
			$event = $this->model('event');
			$check = $event->getTakeEvent(array('id_student'=>$id_student));
			if (!empty($check)&&count($check)>0) {
				redirect('booking/home&status=fail');
			}
			$data_take = array(
				'id_event_sub' => $id_event_sub,
				'id_student' => $id_student,
				'stu_code'	=> $stu_code
			);
			$result_take_event = $event->takeEvent($data_take);
			if($result_take_event['result'] == 'success'){
				redirect('booking/booking');
			}else{
				redirect('booking/home&status=fail');
			}
		}
		public function printbook(){
			$data = array();
			$id_student = id_student();
			$stu_code = $this->getSession('stu_code');
			$id_take_event = get('id_take_event');
			$data['id_take_event'] = $id_take_event;
			$event = $this->model('event');
			$data_check = array(
				'stu_code' => $stu_code,
				'id_take_event'	=> $id_take_event
			);
			$result_check = $event->check_event($data_check);

			$id_event = (isset($result_check['id_event'])?$result_check['id_event']:'');
			// var_dump($result_check);
			if($result_check['result']=='success'){
				// echo DOCUMENT_ROOT;exit();
				require DOCUMENT_ROOT.'system/lib/php-barcode-generator-master/vendor/autoload.php';
				$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
				require DOCUMENT_ROOT.'system/lib/qrcode/vendor/autoload.php';
				// $name_img = time().'_'.$id_take_event;
				\PHPQRCode\QRcode::png($id_take_event, "qrcode/".$id_take_event.".png", 'L', 4, 2);

				$student = $this->model('student');

				$data_student = array(
					'id_student' => id_student(),
					'stu_code'	=> $stu_code
				);
				$data['student_detail'] = $student->getStudent($data_student);
				$data_check = array(
					'stu_code' => $stu_code,
					'id_event'	=> $id_event
				);
				$data['detail'] = $event->getEvent($data_check);
				$data['barcode'] = $generator->getBarcode($id_take_event, $generator::TYPE_CODE_128);
				$data['id_event'] = $id_event;
				$data['id_student'] = $id_student;
				$data['stu_code'] = $this->getSession('stu_code');
				$data['stu_prefix'] = $this->getSession('stu_prefix');
				$data['stu_name'] = $this->getSession('stu_name');
				$data['stu_lname'] = $this->getSession('stu_lname');
				$data['stu_group'] = $this->getSession('stu_group');
				$data['stu_branch'] = $this->getSession('stu_branch');
				$data['stu_point_behavior'] = (int)$this->getSession('stu_point_behavior');
				$data['stu_point_event'] = (int)$this->getSession('stu_point_event');
				$data['stu_code_edu'] = $this->getSession('stu_code_edu');
				$this->render('booking/print',$data);
			}else{
				redirect('home');
			}
		}
		public function pastactivity(){
			$this->view('booking/pastactivity');
		}
		public function cancelactivity(){
			$this->view('booking/cancelactivity');
		}
	}
?>