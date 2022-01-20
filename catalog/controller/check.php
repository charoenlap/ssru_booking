<?php  
	class checkController extends Controller{
		public function home(){
			$data = array();
			$behavior = $this->model('behavior');
			// var_dump($_SESSION);
			$stu_code = $this->getSession('stu_code');
			$data_select = array(
				'stu_code' => $stu_code
			);
			$result_behavior = $behavior->listBehavior($data_select);
			$data['point'] = $behavior->getTotalBehavior($stu_code);
			if (empty($data['point'])) {
				$data['point'] = 100;
			}
			$data['point_class'] = '';
			switch (true) {
				case $data['point']==100: 
					$data['point_class']='text-success'; break;
				case $data['point']<=60&&$data['point']>50: 
					$data['point_class']='text-warning'; break;
				case $data['point']<=50: 
					$data['point_class']='text-danger'; break;
				default: 
					$data['point_class']=''; break;
			}
			if ($data['point']==100) {
				$data['point_class'] = 'text-success';
			} else if ($data['point']) {

			}
			$data['list_behavior'] = $result_behavior;
			$this->view('check/home',$data);
		}
	}
?>