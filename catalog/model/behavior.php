<?php 
	class BehaviorModel extends db {
		public function listBehavior($data = array()){
			$result = array();
			$stu_code = $this->escape($data['stu_code']);
			$sql = "SELECT * FROM booking_behavior 
			LEFT JOIN booking_behavior_type ON booking_behavior.id_behavior_type = booking_behavior_type.id_behavior_type
			 WHERE stu_code = '".$stu_code."'";
			$result_behavior = $this->query($sql);
			$result = $result_behavior->rows;
			return $result;
		}
		public function getTotalBehavior($code) {
			$this->select('IF(100 - SUM(behavior_point)<=0,0,100 - SUM(behavior_point)) as point');
			$this->where('stu_code', $code);
			$result = $this->get('behavior');
			return $result->row['point'];
		}
	}
?>