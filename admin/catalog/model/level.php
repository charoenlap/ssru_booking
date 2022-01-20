<?php  
	class levelModel extends db {
		public function getLevel($data=array()){
			$result = array();
			$sql_booking_level = "SELECT * FROM booking_level ORDER BY level_name";
			$result_booking_level = $this->query($sql_booking_level);
			// $result_booking_level_num_rows = $this->query("SELECT * ".$sql_booking_level);
			$result = array(
				// 'num_rows' 	=>  $result_booking_level_num_rows->num_rows,
				'data'		=>	$result_booking_level->rows
			);
			return $result;
		}
	}
?>