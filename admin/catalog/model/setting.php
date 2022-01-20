<?php  
	class settingModel extends db {
		public function getBanner($data=array()){
			$result = array();
			$sql = "SELECT * FROM booking_setting";
			$result_setting = $this->query($sql);
			$result = $result_setting->rows;
			return $result;
		}
		public function saveSetting($data=array()){
			$result = array();
			$id_setting = (int)$data['id_setting'];
			$data_update = array(
				'setting_name' => $data['setting_name'],
				'setting_type' => (int)$data['setting_type'],
				'date_update' => date('Y-m-d H:i:s')
			);
			if(!empty($data['setting_value'])){
				$data_update['setting_value'] = $data['setting_value'];
			}
			$result_setting = $this->update('setting',$data_update,"id_setting = '".$id_setting."'");
			// var_dump($data_update);
			// exit();
			return $result;
		}
		public function getSetting($data=array()){
			$result = array();
			$id_setting = (int)$data['id_setting'];
			$sql = "SELECT * FROM booking_setting WHERE id_setting = '".$id_setting."'";
			$result_setting = $this->query($sql);
			$result = $result_setting->row;
			return $result;
		}
	}
?>