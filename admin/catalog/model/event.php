<?php  
	class eventModel extends db {
		
		public function delTakeEvent($id=0){
			if($id){
				$this->query('DELETE FROM booking_take_event WHERE id_take_event = '.$id);
			}
		}
		public function listApproveEventStudent($id=0){
			$result = array();
			// $id = (int)$data['id'];
			// $t_e_status = (int)$data['t_e_status'];
			// $sql = "SELECT * FROM booking_take_event 
			// LEFT JOIN booking_event_sub ON booking_take_event.id_event_sub = booking_event_sub.id_event_sub  
			// LEFT JOIN booking_event ON booking_event_sub.id_event = booking_event.id_event  
			// LEFT JOIN booking_event_type ON booking_event_sub.id_event_type = booking_event_type.id_event_type 
			// WHERE id='".$id."' AND t_e_status = '".$t_e_status."' AND booking_event_type.event_type_status = 1
			// GROUP BY booking_event_type.id_event_type ";
			$sql = "SELECT *,te.id_take_event AS id FROM booking_take_event te
			LEFT JOIN booking_event e ON e.id_event = te.id_event
			LEFT JOIN booking_student s ON s.id_student = te.id_student
			LEFT JOIN booking_event_sub es ON es.id_event = e.id_event AND es.id_type_student = s.id_type_student
			LEFT JOIN booking_event_type et ON et.id_event_type = es.id_event_type
			WHERE te.id_student='".$id."' AND e.id_event is not null GROUP BY te.id_event ";  
			// echo $sql;exit(); 
			$result_event = $this->query($sql);
			foreach($result_event->rows as $val){
				$result[] = array(
					'id_take_event'		=> $val['id_take_event'],
					'id_event'			=> $val['id_event'],
					'event_name' 		=> $val['event_name'],
					'event_date_start'	=> $val['event_date_start'],
					'event_unit'		=> $val['event_unit'],
					'event_type_name'	=> $val['event_type_name'],
					'event_hour'		=> $val['event_hour'],
					'status_event'		=>	''
				);
			}
			return $result;
		}
		public function getUnitByEventTypeAndStudent($id_event_type, $id_student) {
			$this->where('te.id_student', (int)$id_student);
			$this->where('es.id_event_type', (int)$id_event_type);
			$this->where('te.t_e_status',3);
			$this->where('es.id_event_sub is not null');
			$this->where('e.id_event is not null');
			$this->where('ts.id_type_student is not null');
			$this->select('SUM(e.event_unit) as unit');
			$this->join('event e','e.id_event = te.id_event','LEFT');
			$this->join('student s','s.id_student=te.id_student','LEFT');
			$this->join('type_student ts','ts.id_type_student=s.id_type_student','LEFT');
			$this->join('event_sub es','te.id_event=es.id_event AND es.id_type_student=ts.id_type_student','LEFT');
			$result = $this->get('take_event te');
			return $result->row['unit'];

		}
		public function delEvent($id_event){
			// $id_event = (int)$data['id_event'];
			$result = array(
				'result' => 'fail'
			);
			$result_del = $this->delete('event',"id_event = '".$id_event."'");
			$this->delete('event_sub',"id_event = '".$id_event."'");
			if($result_del){
				$result = array(
					'result' => 'success'
				);
			}
			return $result;
		}
		public function updateEvent($data=array(), $id_event) {
			$this->where('id_event', $id_event);
			return $this->update('event', $data);
		}
		public function changeStatusTakeEvent($id_event, $id_student, $status=0) {
			if ($status==1) {
				$set = "event_total_join-1";
				$this->where('id_event', $id_event);
				$event_info = $this->get('event');
				$event_info = $event_info->row;
				if ($event_info['event_total_join']-1 < 0) {
					$set = '0';
				}
				$this->query("UPDATE booking_event SET event_total_join = $set WHERE id_event = '".(int)$id_event."'");
			}

			
			$this->where('id_event', $id_event);
			$this->where('id_student', $id_student);
			$data = array('t_e_status'=> $status);
			if ($status==1||$status==0) {
				$data['cancel_date'] = NULL;
			}
			$result = $this->update('take_event', $data);

			return $result;
		}
		public function dashboardTakeEvent() {
			$this->select("te.take_event_date as date, s.stu_code, concat(s.stu_name,' ',s.stu_lname) as stu_name, e.event_name");
			$this->limit(0,10);
			$this->order_by('te.id_take_event', 'DESC');
			$this->join('student s', 's.id_student = te.id_student', 'LEFT');
			$this->join('event e', 'e.id_event = te.id_event', 'LEFT');
			$result = $this->get('take_event te');
			return $result->rows;
		}
		public function listTakeEvent($data=array()){
			$result = array();
			$limit = '';
			if (count($data)>0) {
				foreach ($data as $key => $value) {
					if ($key=='limit') {
						$ex = explode(',', $value);
						$this->limit($ex[0], $ex[1]);
					} else if ($key=='id_event') {
						$this->where('te.id_event', $value);
					} else if ($key=='id_type_student') {
						$this->where('s.id_type_student', $value);
					} else if ($key=='id_group') {
						$this->where('g.id_group', $value);
					} else if ($key=='branch_code') {
						$this->where('b.branch_code', $value);
					} else {
						$this->where($key, $value);
					}
				}
			}
			// if(isset($data['limit'])){
			// 	// $limit = ' LIMIT '.$data['limit'];
			// 	$ex = explode(',', $data['limit']);
			// 	$this->limit($ex[0], $ex[1]);
			// }
			// if (isset($data['id_event'])) {
			// 	// $where = "WHERE booking_take_event.id_event = '".$data['id_event']."'";/
			// 	$this->where('te.id_event', $data['id_event']);
			// }
			if (!isset($data['t_e_status'])) {
				$this->group_start();
					$this->where('te.t_e_status', 3);
					$this->where_or('te.t_e_status', 0);
				$this->group_end();
			} else {
				$this->group_start(); 
					$this->where('te.t_e_status', $data['t_e_status']);
					$this->where('te.cancel_date is not null','','');
				$this->group_end();
			}
			$this->join('event e','e.id_event=te.id_event','LEFT');
			$this->join('student s','s.stu_code=te.stu_code','LEFT');
			$this->join('group g','g.id_group = s.id_group','LEFT');
			$this->join('branch b','b.branch_code = s.branch_code','LEFT');
			$this->join('level l','l.level_code = s.level_code','LEFT');
			$this->join('type_student ts','ts.id_type_student = s.id_type_student','LEFT');
			$this->order_by('te.id_take_event','ASC');
			$result = $this->get('take_event te');
			// $sql = "SELECT * FROM booking_take_event 
			// LEFT JOIN booking_event ON booking_take_event.id_event = booking_event.id_event 
			// LEFT JOIN booking_student ON booking_take_event.stu_code = booking_student.stu_code 
			// LEFT JOIN booking_group ON booking_group.id_group = booking_student.id_group
			// LEFT JOIN booking_branch ON booking_branch.branch_code = booking_student.branch_code
			// LEFT JOIN booking_level ON booking_level.level_code = booking_student.level_code
			// $where
			// ORDER BY id_take_event ".$limit;
			// $query = $this->query($sql);
			// $result = $query->rows;
			// $result =
			// echo $this->last_query();	
			return $result->rows;
		}
		public function listUploadEvent($data = array()){
			$result = array();
			$sql = "SELECT * FROM booking_upload_event ORDER BY id_event_file DESC";
			$result_upload_event = $this->query($sql);
			$result = $result_upload_event->rows;
			return $result;
		}
		public function listApproveEvent($data=array()) {
			$this->select('s.stu_code,s.stu_prefix,s.stu_name,s.stu_lname,g.group_name,b.branch_name,SUM(e.event_unit) as event_unit');
			$this->where('te.t_e_status', 3);
			foreach ($data as $key => $value) {
				if ($key=='s.stu_year') {
					$this->where('s.stu_code', "$value%", 'LIKE');
				} else {
					$this->where($key, $value);
				}
			}
			$this->join('event e', 'e.id_event=te.id_event', 'LEFT');
			$this->join('student s', 's.id_student=te.id_student', 'LEFT');
			$this->join('group g', 'g.id_group=s.id_group', 'LEFT');
			$this->join('branch b', 'b.branch_code=s.branch_code', 'LEFT');
			$this->order_by('s.stu_code','ASC');
			$this->group_by('s.id_student');
			$result = $this->get('take_event te');
			return $result->rows;
		}
		public function approveEvent($data = array()){
			$result = array();
			$data_insert = array(
				'file_name' => $data['file_name'],
				'date_create' => date('Y-m-d H:i:s')
			);
			$result_upload_event = $this->insert('upload_event',$data_insert);
			$where = '';
			foreach($data['list_approve'] as $val){
				$where .= " OR (id_take_event = '".$val."')";
			}
			$this->query("UPDATE booking_take_event SET t_e_status = '3' WHERE (t_e_status = '0' ) ".$where);
			$result = array(
				'result' => 'success'
			);
			return $result;
		}
		public function csvApproveEventByStuCode($id_event, $file){
			$data_insert = array(
				'file_name' => $file,
				'date_create' => date('Y-m-d H:i:s')
			);
			$result_upload_event = $this->insert('upload_event',$data_insert);

			$sql = "LOAD DATA LOCAL INFILE '" . DOCUMENT_ROOT.'admin/upload_approve/'.$file . "' INTO TABLE booking_take_event FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' (stu_code);";
			$result_dump_file = $this->query($sql);






			$result = array();
			$data_insert = array(
				'file_name' => $data['file_name'],
				'date_create' => date('Y-m-d H:i:s')
			);
			$result_upload_event = $this->insert('upload_event',$data_insert);
			$where = '';
			$idstudent = array();
			foreach($data['list_approve'] as $val){
				// $where .= " OR (id_take_event = '".$val."')";
				$this->where('stu_code', trim($val));
				$student = $this->get('student');
				$idstudent[] = "'".$student->row['id_student']."'";
			}
			$sql = "UPDATE booking_take_event SET t_e_status = '3' WHERE t_e_status = '0' AND id_event = '".$data['id_event']."' AND id_student IN (".implode($idstudent).") ";
			$this->query($sql);
			$result = array(
				'result' => 'success'
			);
			return $result;
		}
		public function getUploadEvent($id) {
			$this->where('id_event_file', $id);
			$result = $this->get('upload_event');
			return $result->row;
		}
		public function getUploadEvents() {
			$this->order_by('date_create', 'DESC');
			$result = $this->get('upload_event');
			return $result->rows;
		}
		public function cancelEventByStuCode($data=array()) {
			foreach($data['list_approve'] as $val){
				// $where .= " OR (id_take_event = '".$val."')";
				$this->where('stu_code', trim($val));
				$student = $this->get('student');

				$this->where('id_event', $data['id_event']);
				$this->where('id_student', $student->row['id_student']);
				$takeevent = $this->get('take_event');

				
				if ($takeevent->num_rows==0) {
					$insert = array(
						'id_event'        => $data['id_event'],
						'id_student'      => $student->row['id_student'],
						'id_event_sub'    => 0,
						'stu_code'        => trim($val),
						't_e_status'      => 3,
						'take_event_no'   => 0,
						'take_event_date' => date('Y-m-d H:i:s', time())
					);
					$this->insert('take_event', $insert);
				} else {
					$update = array(
						't_e_status'      => 3,
					);
					$this->where('id_event', $data['id_event']);
					$this->where('id_student', $student->row['id_student']);
					$this->update('take_event', $update);
				}
			}
		}
		public function approveEventByStuCode($data = array()){
			$result = array();
			$data_insert = array(
				'file_name' => $data['file_name'],
				'date_create' => date('Y-m-d H:i:s')
			);
			$result_upload_event = $this->insert('upload_event',$data_insert);
			$where = '';
			$idstudent = array();
			foreach($data['list_approve'] as $val){
				// $where .= " OR (id_take_event = '".$val."')";
				$this->where('stu_code', trim($val));
				$student = $this->get('student');

				$this->where('id_event', $data['id_event']);
				$this->where('id_student', $student->row['id_student']);
				$takeevent = $this->get('take_event');
				
				if ($takeevent->num_rows==0) {
					$insert = array(
						'id_event'        => $data['id_event'],
						'id_student'      => $student->row['id_student'],
						'id_event_sub'    => 0,
						'stu_code'        => trim($val),
						't_e_status'      => 3,
						'take_event_no'   => 0,
						'take_event_date' => date('Y-m-d H:i:s', time())
					);
					$this->insert('take_event', $insert);
				} else {
					$update = array(
						't_e_status'      => 3,
					);
					$this->where('id_event', $data['id_event']);
					$this->where('id_student', $student->row['id_student']);
					$this->update('take_event', $update);
				}
			}

			$result = array(
				'result' => 'success'
			);
			return $result;
		}
		public function getEventDetail($data=array()){
			$result = array();
			$id_event = (int)$data['id_event'];
			$sql_event = "SELECT * FROM booking_event WHERE id_event = '".$id_event."'";
			$result_event = $this->query($sql_event);

			$sql_event_sub = "SELECT * FROM booking_event_sub WHERE id_event = '".$id_event."'";
			$result_event_sub = $this->query($sql_event_sub);

			$result = array(
				'data' => $result_event->row,
				'sub' => $result_event_sub->rows
			);

			return $result;
		}
		public function actionEvent($data=array()){
			$id_event = (int)$data['id_event'];
			$data_event = array(
				'event_name' 		=> $data['event_name'],
				'event_year' 		=> $data['event_year'],
				'event_place' 		=> $data['event_place'],
				'event_head' 		=> $data['event_head'],
				'event_date_start' 	=> $data['event_date_start'],
				'event_date_end' 	=> $data['event_date_end'],
				'event_time_start' 	=> $data['event_time_start'],
				'event_time_end' 	=> $data['event_time_end'],
				'event_total' 		=> $data['event_total'],
				'event_hour' 		=> $data['event_hour'],
				'event_unit' 		=> $data['event_unit'],
				'event_show' 		=> $data['event_show'],
				'event_detail' 		=> htmlspecialchars($data['event_detail'], ENT_QUOTES),

			);
			if(!empty($data['event_file'])){
				$data_event['event_file'] = $data['event_file'];
			}
			
			$this->delete('event_sub',"id_event='".$id_event."'");
			
			if($data['id_event']){
				$result_update = $this->update('event',$data_event,"id_event = '".$id_event."'");
			}else{
				$data_event['event_status'] 		= 0;
				$data_event['event_total_join'] 	= 0;
				$id_event = $this->insert('event',$data_event);
			}
			
			$data_event_sub = array(); 
			foreach($data['chk'] as $key => $val){
				$data_event_sub[] = array(
					'id_event_type' 	=> $data['id_event_type'][$key],
					'id_type_student' 	=> $data['id_type_student'][$key],
					'id_event'			=> $id_event,
					'year_1'			=> (isset($val[1])?$val[1]:0),
					'year_2'			=> (isset($val[2])?$val[2]:0),
					'year_3'			=> (isset($val[3])?$val[3]:0),
					'year_4'			=> (isset($val[4])?$val[4]:0),
					'year_5'			=> (isset($val[5])?$val[5]:0)
				);
			}
			foreach($data_event_sub as $val){
				$this->insert('event_sub',$val);
			}
		}
		public function getEvent($data=array()){
			$result = array();
			$id_event = (int)(isset($data['id_event'])?$data['id_event']:'');
			$where = "";
			if(!empty($id_event)){
				$where = " WHERE id_event = '".$id_event."'";
			}
			$sql_booking_event = "SELECT * FROM booking_event ".$where." ORDER BY id_event DESC ";
			$result_booking_event = $this->query($sql_booking_event);
			// $result_booking_event_num_rows = $this->query("SELECT * ".$sql_booking_event);
			$result = array(
				// 'num_rows' 	=>  $result_booking_event_num_rows->num_rows,
				'data'		=>	$result_booking_event->rows
			);
			return $result;
		}
		public function getEventType($data=array()){
			$result = array();
			$sql_booking_event_type = "SELECT * FROM booking_event_type WHERE event_type_status = 1";
			$result_booking_event_type = $this->query($sql_booking_event_type);
			// $result_booking_event_type_num_rows = $this->query("SELECT * ".$sql_booking_event_type);
			$result = array(
				// 'num_rows' 	=>  $result_booking_event_type_num_rows->num_rows,
				'data'		=>	$result_booking_event_type->rows
			);
			return $result;
		}
		public function getEventTypeById($id) {
			$this->where('id_event_type', $id);
			$result = $this->get('event_type');
			return $result->row;
		}
		public function addEventType($data=array()) {
			return $this->insert('event_type', $data);
		}
		public function editEventType($data=array(),$id) {
			$this->where('id_event_type', $id);
			return $this->update('event_type', $data);
		}
		public function delEventType($id) {
			$this->where('id_event_type', $id);
			return $this->delete('event_type');
		}
	}
?>