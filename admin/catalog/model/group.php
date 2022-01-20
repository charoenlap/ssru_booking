<?php  
	class groupModel extends db {
		public function getGroup($data=array()){
			$result = array();
			$sql_booking_group = "SELECT * FROM booking_group WHERE del = 0 ORDER BY group_name";
			$result_booking_group = $this->query($sql_booking_group);
			// $result_booking_group_num_rows = $this->query("SELECT * ".$sql_booking_group);
			$result = array(
				// 'num_rows' 	=>  $result_booking_group_num_rows->num_rows,
				'data'		=>	$result_booking_group->rows
			);
			return $result;
		}
		public function getGroupById($id) {
			$this->where('id_group', $id);
			$this->where('del', 0);
			$result = $this->get('group');
			return $result->row;
		}

		public function getLists($data=array()) {
			$this->where('del', 0);
			if (count($data)>0) {
				foreach ($data as $key => $value) {
					$this->where($key, $value);
				}
			}
			$query = $this->get('group');
			return $query->rows;
		}

		public function getList($id) {
			$this->where('del', 0);
			$this->where('id_group', $id);
			$query = $this->get('group');
			return $query->row;
		}

		public function add($data) {
			return $this->insert('group', $data);
		}

		public function edit($id, $data) {
			$this->where('id_group', $id);
			return $this->update('group', $data);
		}
	}
?>