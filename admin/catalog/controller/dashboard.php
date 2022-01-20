<?php 
	class DashboardController extends Controller {
	    public function dashboard(){
	    	check_admin();
	    	$data = array();
	    	$dashboard = $this->model('dashboard');
	    	$data['dashboard'] = $dashboard->getDashboard();

	    	$event = $this->model('event');
	    	$data_select = array(
	    		'limit' => '0,10'
	    	);
	    	$data['listTakeEvent'] = array();
			// $data['listTakeEvent'] = $event->listTakeEvent($data_select);
	    	$this->view('dashboard/dashboard',$data);
	    }

	    public function ajaxListTakeEvent() {

	    	$event = $this->model('event');
	    	$data = array();
	    	$data["draw"] = post('draw');
			$data["recordsTotal"] = post('length');
			$result = $event->dashboardTakeEvent();
			$i=1;
			foreach ($result as $value) {
				$data['data'][] = array(
					'no'         => $i++,
					'date'       => date('d-m-Y H:i:s', strtotime($value['date'])),
					'stu_code'   => $value['stu_code'],
					'stu_name'   => $value['stu_name'],
					'event_name' => $value['event_name']
				);
			}
			$data["recordsFiltered"] = count($data['data']);

			$this->json($data);
	    }
	}
?>