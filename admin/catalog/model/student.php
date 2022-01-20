<?php  
	class studentModel extends db {
		public function getStudentsHasEvent($filter=array(), $start=0, $limit=null) {
			$this->select('s.id_student,s.stu_prefix,s.stu_code,s.stu_name,s.stu_lname,g.group_name,b.branch_name');
			foreach ($filter as $key => $value) {
				if ($key=='s.stu_year') {
					$this->where('s.stu_code', "$value%", 'LIKE');
				} else {
					$this->where($key, $value);
				}
			}
			if ($start>=0 && $limit >= 1) {
				$this->limit($start,$limit);
			}
			$this->where('te.id_take_event is not null');
			$this->join('take_event te', 'te.id_student = s.id_student', 'LEFT');
			$this->join('group g', 'g.id_group = s.id_group', 'LEFT');
			$this->join('branch b', 'b.branch_code = s.branch_code', 'LEFT');
			$this->group_by('s.id_student');
			$result = $this->get('student s');
			return $result->rows;
		}
		public function countStudentsHasEvent($filter=array()) {
			foreach ($filter as $key => $value) {
				if ($key=='s.stu_year') {
					$this->where('s.stu_code', "$value%", 'LIKE');
				} else {
					$this->where($key, $value);
				}
			}
			$this->where('te.id_take_event is not null');
			$this->join('take_event te', 'te.id_student = s.id_student', 'LEFT');
			$this->join('group g', 'g.id_group = s.id_group', 'LEFT');
			$this->join('branch b', 'b.branch_code = s.branch_code', 'LEFT');
			$this->group_by('s.id_student');
			$result = $this->get('student s');
			return $result->num_rows;
		}
		public function addStudent($data) {
			return $this->insert('student',$data);
		}
		public function getTypeStudent($data=array()){
			$result = array();
			$sql = "SELECT * FROM booking_type_student WHERE type_student_status=1";
			$result = $this->query($sql);
			// $result_num_rows = $this->query("SELECT * ".$sql);
			$result = array(
				// 'num_rows' 	=>  $result_num_rows->num_rows,
				'data'		=>	$result->rows
			);
			return $result;
		}
		public function muntiInsertStudent($data = array()){
			$result = array(
				'result' => 'fail'
			);
			if(isset($data['csv'])){
				if(!empty($data['csv'])){
					// $this->query('TRUNCATE booking_student;');
					$sql = "LOAD DATA LOCAL INFILE '" . $data['csv'] . "' INTO TABLE booking_student FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' 
					IGNORE 1 ROWS (stu_code,center_code,id_type_student,id_group,branch_code,level_code,stu_prefix,stu_name,stu_lname,stu_birth,stu_year);";

					$result_dump_file = $this->query($sql);
					$result = array(
						'result' => 'success'
					);
				}
			}
			return $result;
		}
		public function checkUploadIncorrect() {
			$this->where("stu_code = '' ");
			$this->delete('student');

			$this->select('count(*) as count, stu_code');
			$this->group_by('stu_code');
			// $this->where('is_upload', 0);
			$result = $this->get('student');
			foreach ($result->rows as $value) {
				if ($value['count']>1) {
					$this->where('stu_code', $value['stu_code']);
					$this->where('is_upload', 0);
					$this->order_by('id_student');
					$this->delete('student');
					// DELETE FROM booking_student WHERE stu_code = 1 AND is_upload = 0 ORDER BY id_student
				}
			}
		}
		public function exportStudent($data = array()){
			$result = array();
			$sql = "SELECT * FROM booking_student";
			$result_student = $this->query($sql);
			foreach($result_student->rows as $val){
				$result[] = array(
					'stu_code' => $val['stu_code'],
					'center_code' => $val['center_code'],
					'id_type_student' => $val['id_type_student'],
					'id_group' => $val['id_group'],
					'branch_code' => $val['branch_code'],
					'level_code' => $val['level_code'],
					'stu_prefix' => $val['stu_prefix'],
					'stu_name' => $val['stu_name'],
					'stu_lname' => $val['stu_lname'],
					'stu_birth' => $val['stu_birth']
				);
			}
			return $result;
		}
		public function countStudents($data=array()) {
			if (isset($data['search'])&&!empty($data['search'])) {
				$this->group_start();
				$this->where('s.stu_code', $data['search']);
				$this->where_like('s.stu_code', '%'.$data['search'].'%', 'OR');
				$this->where_or('s.stu_name', $data['search']);
				$this->where_like('s.stu_name', '%'.$data['search'].'%', 'OR');
				$this->where_or('s.stu_lname', $data['search']);
				$this->where_like('s.stu_lname', '%'.$data['search'].'%', 'OR');
				$this->where_or("CONCAT(s.stu_name,' ',s.stu_lname)", $data['search']);
				$this->where_like("CONCAT(s.stu_name,' ',s.stu_lname)", '%'.$data['search'].'%', 'OR');
				$this->where_or("CONCAT(s.stu_prefix,' ',s.stu_name,' ',s.stu_lname)", $data['search']);
				$this->where_like("CONCAT(s.stu_prefix,' ',s.stu_name,' ',s.stu_lname)", '%'.$data['search'].'%', 'OR');
				$this->where_or('g.group_name', $data['search']);
				$this->where_like('g.group_name', '%'.$data['search'].'%', 'OR');
				$this->where_or('b.branch_name', $data['search']);
				$this->where_like('b.branch_name', '%'.$data['search'].'%', 'OR');
				$this->where_or('l.level_name', $data['search']);
				$this->where_like('l.level_name', '%'.$data['search'].'%', 'OR');
				$this->group_end();
			}

			if (isset($data['stu_code'])&&!empty($data['stu_code'])) {
				$this->where('s.stu_code', $data['stu_code']);
			}
			if (isset($data['center_code'])&&!empty($data['center_code'])) {
				$this->where('c.center_code', $data['center_code']);
			}
			if (isset($data['id_group'])&&!empty($data['id_group'])) {
				$this->where('g.id_group', $data['id_group']);
			}
			if (isset($data['branch_code'])&&!empty($data['branch_code'])) {
				$this->where('b.branch_code', $data['branch_code']);
			}
			if (isset($data['level_code'])&&!empty($data['level_code'])) {
				$this->where('l.level_code', $data['level_code']);
			}

			$this->join('center c', 'c.center_code=s.center_code', 'LEFT');
			$this->join('group g', 'g.id_group=s.id_group', 'LEFT');
			$this->join('branch b', 'b.branch_code=s.branch_code', 'LEFT');
			$this->join('level l', 'l.level_code=s.level_code', 'LEFT');
			$result = $this->get('student s');
			return $result->num_rows;
		}
		public function getStudents($data=array()) {
			// $this->where('')
			if (isset($data['start'])&&isset($data['limit'])) {
				$this->limit($data['start'],$data['limit']);	
			} else {
				$this->limit(0,10);	
			}

			if (isset($data['order'])&&!empty($data['order'])&&isset($data['by'])) {
				$this->order_by($data['order'], $data['by']);
			} else {
				$this->order_by('s.stu_name', 'ASC');
			}
			

			if (isset($data['stu_code'])&&!empty($data['stu_code'])) {
				$this->where('s.stu_code', $data['stu_code']);
			}
			if (isset($data['center_code'])&&!empty($data['center_code'])) {
				$this->where('c.center_code', $data['center_code']);
			}
			if (isset($data['id_group'])&&!empty($data['id_group'])) {
				$this->where('g.id_group', $data['id_group']);
			}
			if (isset($data['branch_code'])&&!empty($data['branch_code'])) {
				$this->where('b.branch_code', $data['branch_code']);
			}
			if (isset($data['level_code'])&&!empty($data['level_code'])) {
				$this->where('l.level_code', $data['level_code']);
			}

			if (isset($data['search'])&&!empty($data['search'])) {
				$this->group_start();
				$this->where('s.stu_code', $data['search']);
				$this->where_like('s.stu_code', '%'.$data['search'].'%', 'OR');
				$this->where_or('s.stu_name', $data['search']);
				$this->where_like('s.stu_name', '%'.$data['search'].'%', 'OR');
				$this->where_or('s.stu_lname', $data['search']);
				$this->where_like('s.stu_lname', '%'.$data['search'].'%', 'OR');
				$this->where_or("CONCAT(s.stu_name,' ',s.stu_lname)", $data['search']);
				$this->where_like("CONCAT(s.stu_name,' ',s.stu_lname)", '%'.$data['search'].'%', 'OR');
				$this->where_or("CONCAT(s.stu_prefix,' ',s.stu_name,' ',s.stu_lname)", $data['search']);
				$this->where_like("CONCAT(s.stu_prefix,' ',s.stu_name,' ',s.stu_lname)", '%'.$data['search'].'%', 'OR');
				$this->where_or('g.group_name', $data['search']);
				$this->where_like('g.group_name', '%'.$data['search'].'%', 'OR');
				$this->where_or('b.branch_name', $data['search']);
				$this->where_like('b.branch_name', '%'.$data['search'].'%', 'OR');
				$this->where_or('l.level_name', $data['search']);
				$this->where_like('l.level_name', '%'.$data['search'].'%', 'OR');
				$this->group_end();
			}

			$this->join('center c', 'c.center_code=s.center_code', 'LEFT');
			$this->join('group g', 'g.id_group=s.id_group', 'LEFT');
			$this->join('branch b', 'b.branch_code=s.branch_code', 'LEFT');
			$this->join('level l', 'l.level_code=s.level_code', 'LEFT');
			$result = $this->get('student s');



			return $result->rows;
		}
		public function getstudent($data=array()){
			$result = array();
			// echo $data['page'];exit();
			$where = "WHERE id_student <> '' ";
			$center_code = (isset($data['center_code'])?$data['center_code']:'');
			$stu_code = (isset($data['stu_code'])?$data['stu_code']:'');
			$id_group = (isset($data['id_group'])?$data['id_group']:'');
			$branch_code = (isset($data['branch_code'])?$data['branch_code']:'');
			$level_code = (isset($data['level_code'])?$data['level_code']:'');

			if(!empty($stu_code)){
				$where .= " AND booking_student.stu_code like '%".$stu_code."%'";
			}
			if(!empty($center_code)){
				$where .= " AND booking_center.center_code = '".$center_code."'";
			}
			$id_group = (isset($data['id_group'])?$data['id_group']:'');
			if(!empty($id_group)){
				$where .= " AND booking_group.id_group = '".$id_group."'";
			}
			$branch_code = (isset($data['branch_code'])?$data['branch_code']:'');
			if(!empty($branch_code)){
				$where .= " AND booking_branch.branch_code  = '".$branch_code."'";
			}
			$level_code = (isset($data['level_code'])?$data['level_code']:'');
			if(!empty($level_code)){
				$where .= " AND booking_level.level_code  = '".$level_code."'";
			}
			$page = ($data['page']-1)*DEFAULT_LIMIT_PAGE;
			$sql_stu = " FROM booking_student 
			JOIN booking_type_student
				ON booking_student.id_type_student = booking_type_student.id_type_student 
				JOIN booking_group
				ON booking_student.id_group = booking_group.id_group 
				JOIN booking_branch
				ON booking_student.branch_code = booking_branch.branch_code 
				JOIN booking_center
				ON booking_student.center_code = booking_center.center_code 
				JOIN booking_level
				ON booking_student.level_code = booking_level.level_code

			";
			// echo $where;exit();
			$result_stu = $this->query("SELECT * ".$sql_stu.$where.' GROUP BY booking_student.id_student LIMIT '.($page).','.DEFAULT_LIMIT_PAGE);
			$result_stu_num_rows = $this->query("SELECT * ".$sql_stu.$where.' GROUP BY booking_student.id_student');
			$result = array(
				'num_rows' 	=>  $result_stu_num_rows->num_rows,
				'data'		=>	$result_stu->rows
			);
			return $result;
		}
		public function getStudentById($id_student) {
			$this->where('id_student', $id_student);
			$result = $this->get('student');
			return $result->row;
		}

		public function changeAllPassword() {
			// $this->where('id_student', $id);
			// $data['stu_password'] = $this->escape($password);
			$result = $this->get('student');
			foreach ($result->rows as $value) {
				$this->where('stu_password is null');
				$this->where('id_student', $value['id_student']);
				$data = array('stu_password' => md5($value['stu_code']));
				$result = $this->update('student', $data);
				echo $this->last_query();
				echo '<br>';
			}
		}

		public function changePassword($id_student, $password) {
			$this->where('id_student', $id_student);
			$data = array('stu_password' => $password);
			return $this->update('student', $data);

		}


		public function getTypeStudentById($id) {
			$this->where('id_type_student', $id);
			$result = $this->get('type_student');
			return $result->row;
		}
		public function addTypeStudent($data=array()) {
			return $this->insert('type_student', $data);
		}
		public function editTypeStudent($data=array(), $id) {
			$this->where('id_type_student', $id);
			return $this->update('type_student', $data);
		}
		public function delTypeStudent($id) {
			$this->where('id_type_student', $id);
			return $this->delete('type_student');
		}




	}
?>