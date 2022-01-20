<?php 
	class CommonController extends Controller {
	    public function header($data=array()) {
	    	check_admin();
	    	// var_dump($data);
	    	$this->render('common/header',$data);
	    }
	    public function footer($data=array()){
	    	check_admin();
	    	$this->render('common/footer',$data);
	    }
	    public function logout($data=array()){
	    	check_admin();
	    	session_destroy();
	    	$this->redirect('home',$data);
	    }
	}
?>