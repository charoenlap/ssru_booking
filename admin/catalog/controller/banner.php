<?php  
	class bannerController extends Controller{
		public function home(){
			check_admin();
			$setting = $this->model('setting');
			$data['setting'] = $setting->getBanner();
			$this->view('banner/home',$data);
		}
		public function subBanner(){
			check_admin();
			$data = array();
			$id_setting = get('id_setting');
			$data['id_setting'] = $id_setting;
			$data['action'] = route('banner/subBanner');
			$setting = $this->model('setting');
			if(method_post()){
				$id_setting = post('id_setting');
				$setting_type = '';
				if(isset($_FILES['setting_file'])){
					$path = DOCUMENT_ROOT.'uploads/setting/';
					$name = time();
					$file_name = upload($_FILES['setting_file'],$path,$name);
					$setting_value = $file_name;
				}
				$data_update = array(
					'id_setting'	=> $id_setting,
					'setting_name' 	=> post('setting_name'),
					'setting_value' => $setting_value,
					'setting_type' 	=> 1,
					'data_update' 	=> date('Y-m-d H:i:s')
				);
				// var_dump($data_update);exit();
				$setting->saveSetting($data_update);
				redirect('banner/home');
			}
			$data_setting = array(
				'id_setting' => $id_setting
			);
			$data['setting'] = $setting->getSetting($data_setting);
			$this->view('banner/subBanner',$data);
		}
		public function addBanner(){
			check_admin();
			$this->view('banner/addBanner');
		}
	}
?>