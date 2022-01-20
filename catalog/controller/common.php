<?php 
	class CommonController extends Controller {
	    public function header($data=array()) {
	    	$data = array();
	    	$data['id_student'] = $this->getSession('id_student');
			$data['stu_code'] = $this->getSession('stu_code');
			$data['stu_prefix'] = $this->getSession('stu_prefix');
			$data['stu_name'] = $this->getSession('stu_name');
			$data['stu_lname'] = $this->getSession('stu_lname');
			$data['stu_code_edu'] = $this->getSession('stu_code_edu');
			$data['stu_detail'] = $this->getSession('stu_detail');

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
	    	$result_setting = $this->model('setting');
			$data['banner_1'] = $result_setting->getSetting( array('id_setting'=>1) )['setting_value'];
			$data['banner_2'] = $result_setting->getSetting( array('id_setting'=>2) )['setting_value'];
			$data['banner_3'] = $result_setting->getSetting( array('id_setting'=>3) )['setting_value'];
	    	$this->render('common/header',$data);
	    }
	    public function footer($data=array()){
	    	$this->render('common/footer',$data);
	    }
	}
?>