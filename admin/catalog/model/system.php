<?php  
	class systemModel extends db {
		public function getSystems() {
			$result = $this->get('system');
			return $result->rows;
		}
		public function getSystem($key) {
			$this->where('system_key', $key);
			$result = $this->get('system');
			return $result->row;
		}
		public function editSystem($data=array()) {
			$return = true;
			$result = array();
			if (count($data)==0) {
				return false;
			}

			foreach ($data as $key => $value) {
				$this->where('system_key',$key);
				$check = $this->get('system');
				if ($check->num_rows==1) {
					$this->where('system_key', $key);
					$result[] = $this->update('system', array('system_value'=>$value));
				} else {
					$result[] = $this->insert('system', array('system_key'=>$key,'system_value'=>$value));
				}
				
			}
			if (in_array(false, $result)) {
				return false;
			} else {
				return true;
			}
		}
	}
?>