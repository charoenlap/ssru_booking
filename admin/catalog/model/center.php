<?php  
	class centerModel extends db {
		public function getCenter($data=array()){
			$result = array();
			$sql_booking_center = "SELECT * FROM booking_center WHERE del = 0 ORDER BY center_name";
			$result_booking_center = $this->query($sql_booking_center);
			// $result_booking_center_num_rows = $this->query("SELECT * ".$sql_booking_center);
			$result = array(
				// 'num_rows' 	=>  $result_booking_center_num_rows->num_rows,
				'data'		=>	$result_booking_center->rows
			);
			return $result;
		}

		public function getLists($data=array()) {
			$this->where('del', 0);
			$query = $this->get('center');
			return $query->rows;
		}

		public function getList($id) {
			$this->where('del', 0);
			$this->where('id_code_center', $id);
			$query = $this->get('center');
			return $query->row;
		}

		public function add($data) {
			return $this->insert('center', $data);
		}

		public function edit($id, $data) {
			$this->where('id_code_center', $id);
			return $this->update('center', $data);
		}

		public function countCenterByCode($code) {
			$this->where('center_code', $code);
			$query = $this->get('center');
			return $query->num_rows;
		}
	}
?>