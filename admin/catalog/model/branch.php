<?php  
	class branchModel extends db {
		public function getBranch($data=array()){
			$result = array();
			$sql_booking_branch = "SELECT * FROM booking_branch WHERE del = 0 GROUP BY branch_code ORDER BY branch_name";
			$result_booking_branch = $this->query($sql_booking_branch);
			// $result_booking_branch_num_rows = $this->query("SELECT * ".$sql_booking_branch);
			$result = array(
				// 'num_rows' 	=>  $result_booking_branch_num_rows->num_rows,
				'data'		=>	$result_booking_branch->rows
			);
			return $result;
		}
		public function getBrnachByGroupId($id_group) {
			$this->where('id_group',$id_group);
			$this->where('del', 0);
			$result = $this->get('branch');
			return $result->rows;
		}
		public function getBranchByCode($code) {
			$this->where('branch_code', $code);
			$this->where('del', 0);
			$result = $this->get('branch');
			return $result->row;
		}
		public function countBranchByCode($code, $id=null) {
			$this->where('branch_code', $code);
			if ($id!=null) {
				$this->where('id_branch', $id, '!='); // not this id
			}
			$this->where('del', 0);
			$result = $this->get('branch');
			return $result->num_rows;
		}

		public function getLists($data=array()) {
			$this->where('del', 0);
			if (count($data)>0) {
				foreach ($data as $key => $value) {
					$this->where($key, $value);
				}
			}
			$query = $this->get('branch');
			return $query->rows;
		}

		public function getList($id) {
			$this->where('del', 0);
			$this->where('id_branch', $id);
			$query = $this->get('branch');
			return $query->row;
		}

		public function add($data) {
			return $this->insert('branch', $data);
		}

		public function edit($id, $data) {
			$this->where('id_branch', $id);
			return $this->update('branch', $data);
		}
	}
?>