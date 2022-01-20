<?php
	class behaviorController extends Controller{
		public function home(){
			check_admin();
			$data = array();
			$data['result'] = get('result');

			$behavior = $this->model('behavior');
			$data['list_stu_behavior'] = $behavior->listStuBehavior();
			$this->view('behavior/home',$data);
		}
		public function form(){
			check_admin();
			$behavior = $this->model('behavior');
			if(method_post()){
				$data_select = $_POST;
				$result_add = $behavior->addBehavior($data_select);
				$this->redirect('behavior/home&result=success');
			}
			$data = array();
			$data['result'] = '';
			$data['listBehavior'] = $behavior->getBehavior();
			$data['action'] = route('behavior/form');
			
			$this->view('behavior/form',$data);
		}
	}
?>