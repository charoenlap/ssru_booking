<?php 
	class indexController extends Controller{
		public function home(){
			$data = array();
			$result_setting = $this->model('setting');
			// $data['banner_1'] = $result_setting->getSetting( array('id_setting'=>1) );
			// $data['banner_2'] = $result_setting->getSetting( array('id_setting'=>2) );
			// $data['banner_3'] = $result_setting->getSetting( array('id_setting'=>3) );
			$data['banner_4'] = $result_setting->getSetting( array('id_setting'=>4) )['setting_value'];
			$this->view('index/home',$data);
		}
	}
?>