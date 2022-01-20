<?php  
	class yearModel extends db {
		public function getStudentYear($filter=array()) {
			if (count($filter)>0) {
				$row=0;
				foreach ($filter as $key => $value) {
					$this->where_like($key, '%'.$value.'%', ($row==0?'AND':'OR'));
					$row++;
				}
			}
			$result = $this->get('student_year');
			return $result->rows;
		}
		public function getStudentYearById($id) {
			$this->where('id_student_year', $id);
			$result = $this->get('student_year');
			return $result->row;
		}
		public function addStudentYear($data=array()) {
			return $this->insert('student_year', $data);
		}
		public function editStudentYear($data=array(), $id) {
			$this->where('id_student_year', $id);
			return $this->update('student_year', $data);
		}
		public function delStudentYear($id) {
			$this->where('id_student_year', $id);
			return $this->delete('student_year');
		}
	}
?>