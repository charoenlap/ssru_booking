<?php 
	class HomeController extends Controller {
	    public function index() {
	    	$data = array();
	    	if(method_post()){

	    		//$response = $this->apiGoogle();
	    		$response['status'] = true;

	    		if($response['status']==true){
	    			$student = $this->model('student');
	    			$event = $this->model('event');
		    		$data_login = array(
		    			'stu_code' 		=> post('stu_code'),
		    			'stu_password'	=> post('stu_password')
		    		);
		    		$result_login = $student->login($data_login);
		    		if($result_login['result']=='success'){
		    			$behavior = (int)$result_login['data']['stu_point_behavior']-(int)$result_login['behavior'];
		    			// var_dump($result_login);exit();
		    			$this->setSession('id_student',$result_login['data']['id_student']);
		    			$this->setSession('stu_detail',$result_login['data']);
		    			$this->setSession('stu_code',$result_login['data']['stu_code']);
		    			$this->setSession('stu_prefix',$result_login['data']['stu_prefix']);
		    			$this->setSession('stu_name',$result_login['data']['stu_name']);
		    			$this->setSession('stu_lname',$result_login['data']['stu_lname']);
		    			// $this->setSession('stu_group',$result_login['data']['stu_group']);
		    			// $this->setSession('stu_branch',$result_login['data']['stu_branch']);
						$this->setSession('stu_point_event',$result_login['event_unit']);
						// ! get New Sub 
						$event = $this->model('event');
						$data_select = array(
							'stu_code'   => $this->getSession('stu_code'),
							't_e_status' => 3
						);
						/*
						$sum_event_aprrove =  array();
						$sum_event_aprrove = $event->listSumApproveEvent($data_select);
						$sum_hour = 0;
						foreach ($sum_event_aprrove as $key => $value) {
							$sum_hour += $value['event_hour'];
						} 
						*/
						$sum_event = 0;
						$list_event_approve =  array();
						$list_event_approve = $event->listSumApproveEvent($data_select);
						// var_dump($list_event_approve);exit();
						foreach ($list_event_approve as $key => $value) {
							$sum_event += (double)$value['event_unit'];
						}
						
						// $this->setSession('stu_point_event', $event->sumApproveEvent(array('stu_code'=>$result_login['data']['stu_code'],'t_e_status'=>3)));
						// echo $sum_event;exit();
						$this->setSession('stu_point_event', $sum_event);
	    				$this->setSession('stu_point_behavior',$behavior);
	    				$this->setSession('stu_code_edu',$result_login['data']['stu_code_edu']);

		    			// เช็ค เข้าครั้งแรก
		    			// รหัสผ่าน จะเท่ากับ เลขรหัสนักศึกษา
		    			$student_info = $student->getStudentById($result_login['data']['id_student']);
		    			if ($student_info['stu_password']==md5($student_info['stu_code'])) {
		    				redirect('member/edit');
		    			} else {
		    				redirect('index/home');	
		    			}

		    			
		    			}else{
		    			redirect('home&result=fail');
		    			}
	    			}else{
	    			// var_dump($result);
	    			redirect('home&result=fail_captcha&error='.$response['message']);
	    		}
	    	}
	    	$data['result'] = get('result');
	    	$data['action'] = route('home');
	    	$data['title'] = "SSRU";
	    	$style = array(
	    		'assets/home.css'
	    	);
	    	$data['style'] 	= $style;
 	    	$this->render('home',$data); 
	    }
	    public function logout(){
	    	$this->destroySession();
	    	redirect('home');
	    }


	    public function apiGoogle() {
	    	$data = array(
	    		'status' => false,
	    		'message' => ''
	    	);

	    	if (!isset($_POST['g-recaptcha-response'])) {
	    		$data['status'] = false;
	    		$data['message'] = 'Not found post recaptcha';
	    	} else {
		    	$url = 'https://www.google.com/recaptcha/api/siteverify';
		    	$post = array(
		    		'secret' => '6LcuA94ZAAAAAK9-exGgIYPEsCuUyC8Na30miEWA',
		    		'response' => $_POST['g-recaptcha-response'],
		    		'remoteip' => $_SERVER['REMOTE_ADDR']
		    	);

		    	$ch = curl_init();

				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec($ch);
				curl_close ($ch);
				$json = json_decode($server_output, true);


				$error = array(
					'missing-input-secret' => 'The secret parameter is missing.',
					'invalid-input-secret' => 'The secret parameter is invalid or malformed.',
					'missing-input-response' => 'The response parameter is missing.',
					'invalid-input-response' => 'The response parameter is invalid or malformed.',
					'bad-request' => 'The request is invalid or malformed.',
					'timeout-or-duplicate' => 'The response is no longer valid: either is too old or has been used previously.',
				);

				if ($json['success'] == true) {
					$data['status'] = true;
					$data['message'] = '';
				} else {
					$data['status'] = false;
					$data['message'] = $error[$json['error-codes']];
				}
	    	}

	    	return $data;

	    }
	}
?>
