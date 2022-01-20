<?php 
	class MemberModel extends db {
		public function changePwd($data=array()){
			$result = array(
				'result' => 'fail'
			);
			$password = $this->escape($data['password']);
			$confirmPassword = $this->escape($data['confirmPassword']);
			$stu_code = $this->escape($data['stu_code']);
			if( ($password == $confirmPassword) AND !empty($password) ){
				$sql = "UPDATE booking_student SET stu_password = MD5('".$password."') WHERE stu_code = '".(int)$stu_code."'";
				$result_student = $this->query($sql);
				// if($result_student->num_rows){
					$result = array(
						'result' 	=> 'success'
					);
				// }
			}
			return $result;
		}
	}
?>