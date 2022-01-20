<?php  
	class systemModel extends db {
		public function getSystem($key) {
			$this->where('system_key', $key);
			$result = $this->get('system');
			return $result->row;
		}
	}
?>