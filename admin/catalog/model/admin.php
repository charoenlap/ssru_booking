<?php  
	class adminModel extends db {
		public function login($data=array()){
			$result = array(
				'result' => 'fail'
			);
			$username = $this->escape($data['username']);
			$password = $this->escape($data['password']);
			$sql_admin = "SELECT * FROM booking_admin WHERE username = '".$username."' AND password = md5('".$password."') LIMIT 0,1";
			$result_admimn = $this->query($sql_admin);
			if($result_admimn->num_rows > 0){
				$result = array(
					'result' => 'success',
					'detail' => $result_admimn->row
				);
			}
			return $result;
		}
	}
?>