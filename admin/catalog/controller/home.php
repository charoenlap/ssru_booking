<?php  
	class homeController extends Controller{
		public function index(){
			$data = array();
			if(method_post()):
				$data = $_POST;
				

	    		// $response = $this->apiGoogle();
			//$response['status']==true;

	    		//if($response['status'] == true){

					$admin = $this->model('admin');
					$data_select = array(
						'username' => $data['username'],
						'password' => $data['password']
					);
					$result_admin = $admin->login($data_select);
					if($result_admin['result'] == 'success'){
						$this->setSession('login_admin',1);
						redirect('dashboard/dashboard');
					}else{
						redirect('home&result=fail');
					}
				//}else{
	    			// var_dump($result);
	    			//redirect('home&result=fail_captcha&error='.$response['message']);
	    		//}

			endif;
			$data['action'] = route('home');
			$this->render('home',$data);
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
