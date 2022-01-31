<?php 
	class EventModel extends db {
		public function delTakeEvent($id_take_event) {
			$update = array(
				't_e_status' => 4,
				'cancel_date' => date('Y-m-d H:i:s',time())
			);
			$this->where('id_take_event', $id_take_event);
			return $this->update('take_event', $update);
			// $take_event = $this->get('take_event');
			// $take_event_info = $take_event->row;

			// $set = "event_total_join-1";

			// $this->where('id_event', $take_event_info['id_event']);
			// $event_info = $this->get('event');
			// $event_info = $event_info->row;
			// if ($event_info['event_total_join']-1 < 0) {
			// 	$set = '0';
			// }
			// $this->query("UPDATE booking_event SET event_total_join = $set WHERE id_event = '".(int)$take_event_info['id_event']."'");

			// $this->where('id_take_event', $id_take_event);
			// return $this->delete('take_event');
		}
		public function listSumApproveEvent($data = array()) {

			$stu_code = (int)$data['stu_code'];
			$t_e_status = (int)$data['t_e_status'];
			$sql = "
			SELECT 
				id_event_type,
				event_type_name,
				SUM(event_unit) as event_unit, 
				SUM(event_hour) as event_hour  FROM (
					SELECT 
						et.id_event_type,
						et.event_type_name,
						SUM(e.event_unit) as event_unit, 
						SUM(e.event_hour) as event_hour 
					FROM booking_take_event te
						LEFT JOIN booking_event e ON e.id_event = te.id_event
						LEFT JOIN booking_student s ON s.id_student = te.id_student
						LEFT JOIN booking_event_sub es ON es.id_event = e.id_event AND es.id_type_student = s.id_type_student
						LEFT JOIN booking_event_type et ON et.id_event_type = es.id_event_type
					WHERE s.stu_code='".$stu_code."' 
						AND te.t_e_status = ".$t_e_status." 
						AND e.id_event is not null 
						AND es.id_event is not null 
			 			AND et.id_event_type is not null
					GROUP BY et.id_event_type, te.id_event
			) table_sum GROUP BY id_event_type";
			// echo $sql;exit();

			$result = $this->query($sql);
			return $result->rows;
		}
		public function sumApproveEvent($data = array()) {
			$stu_code = (int)$data['stu_code'];
			$t_e_status = (int)$data['t_e_status'];
			$sql = "SELECT SUM(e.event_unit) as event_unit FROM booking_take_event te
			LEFT JOIN booking_event e ON e.id_event = te.id_event
			LEFT JOIN booking_student s ON s.id_student = te.id_student
			LEFT JOIN booking_event_sub es ON es.id_event = e.id_event AND es.id_type_student = s.id_type_student
			LEFT JOIN booking_event_type et ON et.id_event_type = es.id_event_type
			WHERE s.stu_code='".$stu_code."' AND te.t_e_status = ".$t_e_status." ";
			$result = $this->query($sql);
			return $result->row['event_unit'];
		}
		public function listApproveEvent($data = array()){
			$result = array();
			$stu_code = (int)$data['stu_code'];
			$t_e_status = (int)$data['t_e_status'];
			// $sql = "SELECT * FROM booking_take_event 
			// LEFT JOIN booking_event_sub ON booking_take_event.id_event_sub = booking_event_sub.id_event_sub  
			// LEFT JOIN booking_event ON booking_event_sub.id_event = booking_event.id_event  
			// LEFT JOIN booking_event_type ON booking_event_sub.id_event_type = booking_event_type.id_event_type 
			// WHERE stu_code='".$stu_code."' AND t_e_status = '".$t_e_status."' AND booking_event_type.event_type_status = 1
			// GROUP BY booking_event_type.id_event_type ";
			$sql = "SELECT * FROM (SELECT * FROM booking_take_event WHERE stu_code='".$stu_code."' AND t_e_status = '".$t_e_status."') te
			LEFT JOIN booking_event e ON e.id_event = te.id_event
			LEFT JOIN booking_student s ON s.id_student = te.id_student
			LEFT JOIN booking_event_sub es ON es.id_event = e.id_event AND es.id_type_student = s.id_type_student
			LEFT JOIN booking_event_type et ON et.id_event_type = es.id_event_type
			WHERE e.id_event is not null GROUP BY te.id_event ";  
			// echo $sql;exit();
			$result_event = $this->query($sql);
			foreach($result_event->rows as $val){
				$result[] = array(
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
		public function checkHaveEvent($data=array()){
			$result = array();
			$stu_code = (int)$data['stu_code'];
			$t_e_status = (int)$data['t_e_status'];

			$sql_check_te = "SELECT id_take_event FROM booking_take_event te 
			LEFT JOIN booking_student s ON s.id_student = te.id_student
			WHERE s.stu_code='".$stu_code."' AND te.t_e_status = ".$t_e_status;
			$result_check_te = $this->query($sql_check_te);
			return $result_check_te->num_rows;
		}
		public function check_event($data=array()){
			$result = array(
				'result' => 'fail'
			);
			$id_take_event = (int)$data['id_take_event'];
			$stu_code = $data['stu_code'];
			$sql = "SELECT * FROM booking_take_event WHERE id_take_event='".$id_take_event."' AND stu_code='".$stu_code."'";
			$result_check = $this->query($sql);
			if($result_check->num_rows>0){
				$result = array(
					'result' => 'success',
					'take_event_no' => $result_check->row['take_event_no'],
					'id_event' => $result_check->row['id_event']
				);
			}
			return $result;
		}
		public function getEvent($data=array()){
			$id_event = (int)$data['id_event'];
			$stu_code = $data['stu_code'];
			$sql = "SELECT * FROM booking_take_event 
			LEFT JOIN booking_event ON booking_take_event.id_event = booking_event.id_event 
			WHERE booking_take_event.id_event='".$id_event."' AND stu_code='".$stu_code."'";
			$result_check = $this->query($sql);
			$result = array();
			if($result_check->num_rows>0){
				$result = $result_check->row;
			}
			return $result;
		}
		public function listEvent($data=array()){
			$date_start = $data['date_start'];
			$date_end 	= $data['date_end'];
			$list_event_type = $data['list_event_type'];
			$id_type_student = (int)$data['id_type_student'];
			$current_year = (int)$data['current_year'];

			$where = '';
			if(!empty($date_start) AND !empty($date_end)){
				$where .= " AND (booking_event.event_date_start >= '".$date_start."' AND booking_event.event_date_end <= '".$date_end."')";
			}
			if(!empty($list_event_type)){
				$where .= " AND (booking_event_sub.id_event_type = '".$list_event_type."') ";
			}
			// $where .= " AND booking_event_sub.id_type_student = '".$id_type_student."' AND booking_event_sub.year_".$current_year." = '1'";
			$where .= " AND booking_event_sub.id_type_student = '".$id_type_student."' ";
			$result = array();
			$sql = "SELECT * FROM booking_event 
			LEFT JOIN booking_event_sub ON booking_event.id_event = booking_event_sub.id_event 
			LEFT JOiN booking_event_type ON booking_event_type.id_event_type = booking_event_sub.id_event_type 
			LEFT JOIN booking_type_student ON booking_type_student.id_type_student = booking_event_sub.id_type_student 
			WHERE booking_event.event_status <> 3 AND booking_event.event_show = 1 ".$where." ORDER BY booking_event.event_date_start ASC ";
			$result = $this->query($sql)->rows;
			return $result;
		}
		public function getTakeEvent($data=array()){
			$result = array();
			$id_student = (int)$data['id_student'];
			$status = isset($data['status']) ? (int)$data['status'] : 0;
			$sql = "SELECT * FROM booking_take_event 
			LEFT JOIN booking_event ON booking_take_event.id_event = booking_event.id_event 
			WHERE booking_take_event.id_student = '".$id_student."' AND (booking_take_event.t_e_status = '".$status."') AND booking_event.id_event is not null ";
			$result = $this->query($sql)->rows;
			return $result;
		}
		public function takeEvent($data = array()){
			$result = array(
				'result' => 'fail'
			);
			$id_event_sub = (int)$data['id_event_sub'];
			$sql_event_sub = "SELECT * FROM booking_event_sub WHERE id_event_sub='".(int)$data['id_event_sub']."'";
			$result_event_sub = $this->query($sql_event_sub);
			$data['id_event'] = $result_event_sub->row['id_event'];


			$sql_check_booking = "SELECT * FROM booking_take_event WHERE id_student='".(int)$data['id_student']."' AND id_event = '".(int)$data['id_event']."'";
			$result_check_booking = $this->query($sql_check_booking);
			if($sql_check_booking->num_rows == 0 ){
				$sql_event = "SELECT * FROM booking_event WHERE id_event = '".(int)$data['id_event']."'";
				$result_event = $this->query($sql_event);

				$data_insert = array(
					'id_student'    => $data['id_student'],
					'stu_code'      => $data['stu_code'],
					'id_event'      => $data['id_event'],
					't_e_status'    => '0',
					'take_event_no' => ((int)$result_event->row['event_total_join']+1),
					'id_event_sub'  => $data['id_event_sub'],
					'take_event_date'    => date('Y-m-d H:i:s', time())
				);
				$result_insert = $this->insert('take_event',$data_insert);

				$sql_update_event = "UPDATE booking_event SET event_total_join = event_total_join+1 WHERE id_event = '".(int)$data['id_event']."'";
				$this->query($sql_update_event);
				$result = array(
					'result' => 'success',
					'detail'=> $result_insert
				);
			}
			return $result;
		}
		public function listTypeEvent($data=array()){
			$result = array();
			// $list = array(
			// 	'กิจกรรมบังคับ','กิจกรรมเลือก'
			// );
			// $result = $list;
			// // 
			// // $sql = "SELECT * FROM booking_event";
			// // $result = $this->query($sql)->rows;
			$this->where('event_type_status', 1);
			$result = $this->get('event_type');
			return $result->rows;
		}
	}
?>