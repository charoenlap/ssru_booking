<?php 
	class DashboardModel extends db {
		public function getDashboard($data = array()){
			$result = array();
			// $sql_student = "SELECT count(id_student) AS sum_student FROM booking_student";
			// $sql_event = "SELECT count(id_event) AS sum_event FROM booking_event";
			// $sql_take_event = "SELECT count(id_take_event) AS sum_take_event FROM booking_take_event";
			// $sql_behavior = "SELECT count(id_behavior) AS sum_behavior FROM booking_behavior";
			$sql = "SELECT  
			(SELECT count(id_student) AS sum_student FROM booking_student) as sum_student, 
			(SELECT count(id_event) AS sum_event FROM booking_event) as sum_event,
			(SELECT count(id_take_event) AS sum_take_event FROM booking_take_event) as sum_take_event,
			(SELECT count(id_behavior) AS sum_behavior FROM booking_behavior) as sum_behavior";
			$result = $this->query($sql);
			$result = array(
				'sum_student' 		=> (int)$result->row['sum_student'],
				'sum_event' 		=> (int)$result->row['sum_event'],
				'sum_take_event' 	=> (int)$result->row['sum_take_event'],
				'sum_behavior' 		=> (int)$result->row['sum_behavior']
			);

			return $result;
		}
	}
?>