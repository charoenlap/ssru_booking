<?php 
	class StudentModel extends db {
		public function login($data=array()){
			$result = array(
				'result' => 'fail'
			);
			$stu_code = $this->escape($data['stu_code']);
			$stu_password = md5($data['stu_password']);
			if(!empty($stu_password)){
				$sql = "SELECT * FROM (SELECT * FROM booking_student WHERE 
				(stu_code = '".$stu_code."' AND stu_password='".$stu_password."') 
				OR 
				(stu_code = '".$stu_code."' AND stu_birth='".$stu_password."' 
				AND 
				(stu_password='' OR stu_password IS NULL))  LIMIT 0,1) booking_student 
				LEFT JOIN booking_type_student
				ON booking_student.id_type_student = booking_type_student.id_type_student 
				LEFT JOIN booking_group
				ON booking_student.id_group = booking_group.id_group 
				LEFT JOIN booking_branch
				ON booking_student.branch_code = booking_branch.branch_code 
				LEFT JOIN booking_center
				ON booking_student.center_code = booking_center.center_code 
				LEFT JOIN booking_level
				ON booking_student.level_code = booking_level.level_code
				";
				// echo $sql; exit();
				$result_student = $this->query($sql);
				if($result_student->num_rows){
					$stu_code = $result_student->row['stu_code'];
					$sql_behavior = "SELECT SUM(behavior_point) as sum_behavior FROM booking_behavior 
					 WHERE stu_code = '".$stu_code."'  LIMIT 0,1";
					$result_behavior = $this->query($sql_behavior);
					// $result = $result_behavior->rows;




					$sql_take = "SELECT SUM(event_unit) AS event_unit FROM (SELECT * FROM booking_take_event WHERE stu_code='".$stu_code."' LIMIT 0,1) booking_take_event 
					LEFT JOIN booking_event_sub ON booking_take_event.id_event_sub = booking_event_sub.id_event_sub  
					LEFT JOIN booking_event ON booking_event_sub.id_event = booking_event.id_event  
					LEFT JOIN booking_event_type ON booking_event_sub.id_event_type = booking_event_type.id_event_type 
					";
					$result_take_event = $this->query($sql_take);



					$result_student->row['stu_point_behavior'] = 100;
					$result = array(
						'result' 		=> 'success',
						'data' 			=> $result_student->row,
						'behavior'		=> $result_behavior->row['sum_behavior'],
						'event_unit'	=> $result_take_event->row['event_unit']
					);
				}
			}
			return $result;
		}
		public function getStudent($data = array()){
			$stu_code = $data['stu_code'];
			$result = array();
			$sql = "SELECT * FROM (SELECT * FROM booking_student WHERE booking_student.stu_code = '".$stu_code."' LIMIT 0,1 ) booking_student
				LEFT JOIN booking_type_student
				ON booking_student.id_type_student = booking_type_student.id_type_student 
				LEFT JOIN booking_group
				ON booking_student.id_group = booking_group.id_group 
				LEFT JOIN booking_branch
				ON booking_student.branch_code = booking_branch.branch_code 
				LEFT JOIN booking_center
				ON booking_student.center_code = booking_center.center_code 
				LEFT JOIN booking_level
				ON booking_student.level_code = booking_level.level_code"
			;
			$result_student = $this->query($sql);
			$result = $result_student->row;
			return $result;
		}

		public function getStudentById($id=0) {
			$sql = "SELECT * FROM booking_student WHERE id_student = '".$id."'";
			$result = $this->query($sql);
			// $this->where('id_student', $id);
			// $result = $this->get('student');
			return $result->row;
		}
	}
?>