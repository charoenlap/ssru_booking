<div class="container">
	<div class="row">
		<div class="col-md-12">
            <?php if (!empty($success)): ?>
               <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
            <?php endif ?>
            <?php if (!empty($error)): ?>
               <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
            <?php endif ?>
		</div>
		<div class="col-lg-3 col-md-4 mb-2">
			<div class="card rounded-0">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<p><b>ข้อมูลนักศึกษา</b></p>
						</div>
						<div class="col-md-12">
							<p><b>รหัส</b> <?php echo $stu_code; ?></p>
							<p><b>ชื่อ</b> <?php echo $stu_prefix; ?> <?php echo $stu_name; ?></p>
							<p><b>นามสกุล</b> <?php echo $stu_lname; ?></p>
							<p><b>คณะ</b> <?php echo $stu_detail['group_name']; ?></p>
							<p><b>สาขา</b> <?php echo $stu_detail['branch_name']; ?></p>
							<p><b>วุฒิการศึกษา</b> <?php echo $stu_detail['level_name']; ?></p>
							<p><b>คะแนนพฤติกรรม</b> (<?php echo $stu_point_behavior; ?>)</p>
							<p><b>หน่วยกิจกรรมสะสม</b> (<?php echo $stu_point_event; ?>/100)</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<a href="<?php echo route('member/edit'); ?>" class="btn btn-outline-dark mb-3 w-100 rounded-0">แก้ไขข้อมูลส่วนตัว</a>
						</div>
						<div class="col-md-12">
							<a href="<?php echo route('activity/home'); ?>" class="btn btn-outline-dark mb-3 w-100 rounded-0">ตรวจสอบกิจกรรมที่ได้เข้าร่วม</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-9 col-md-8">
			<div class="card rounded-0">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<h5 class="text-warning">กิจกรรมที่จอง</h5>
							<hr>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div id="accordion">
								<?php $i=0;foreach($reserve as $val){ 
										$status = ($val['event_status']==0?'<span class="badge badge-pill badge-info float-right mt-2">สถานะ : '.$val['event_total_join'].'/'.$val['event_total'].'</span>':'<span class="badge badge-pill badge-danger float-right mt-2">สถานะ : เต็ม</span>');
									?>
								<div class="card">
									<div class="card-header p-1 bg-white" id="heading<?php echo $i;?>">
										<a href="#" class="btn btn-link text-dark collapsed" data-toggle="collapse" data-target="#collapse<?php echo $i;?>" aria-expanded="false" aria-controls="collapse<?php echo $i;?>">
										<?php echo $val['event_name']; ?>
										</a>
										<br>
										<a href="<?php echo route('booking/printbook&id_take_event='.$val['id_take_event']); ?>" class="btn btn-primary float-right btn-sm mr-1 rounded-0"><i class="fa fa-print"></i> ปริ้นใบจอง</a>
									</div>
									<div id="collapse<?php echo $i;?>" class="collapse <?php echo ($i==0?'show':''); ?>" aria-labelledby="heading<?php echo $i;?>" data-parent="#accordion">
										<div class="card-body">
											<div class="row mb-3">
												<div class="col-md-10">
													<p class="mb-0">วันที่จัดกิจกรรม : <?php echo date_f($val['event_date_start'],'Y-M-d'); ?></p>
													<p class="mb-0">สถานที่จัดงาน : <?php echo $val['event_place']; ?></p>
													<p class="mb-0">จำนวนผุ้เข้าร่วม : <?php echo $val['event_total']; ?></p>
													<p class="mb-0">จำนวนผู้จองกิจกรรมล่าสุด : <?php echo $val['event_total_join']; ?></p>
													<?php if (!empty($val['event_file'])) { ?>
													<p class="mb-0">ดาวน์โหลดไฟล์ : <a href="<?php echo FILE_PATH.$val['event_file']; ?>" target="new">ไฟล์</a></p>
													<?php } ?>
												</div>
												<div class="col-md-2">
													<a href="<?php echo route('booking/cancelEvent'.'&id_take_event='.$val['id_take_event']);?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการเลิกกิจกรรม');">ยกเลิกกิจกรรม</a>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<?php echo $val['event_detail']; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php $i++;} ?>
							</div>
							<?php if(empty($reserve)){ ?>
								<p class=""><b>ไม่พบกิจกรรม</b></p>
							<?php } ?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<h5 class="text-danger">กิจกรรมที่ยกเลิก</h5>
							<hr>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div id="accordion">
								<?php $i=0;foreach($cancle as $val){ 
									$status = ($val['event_status']==0?'<span class="badge badge-pill badge-info float-right mt-2">สถานะ : '.$val['event_total_join'].'/'.$val['event_total'].'</span>':'<span class="badge badge-pill badge-danger float-right mt-2">สถานะ : เต็ม</span>');
								?>
								<div class="card-header p-1 bg-white" id="heading<?php echo $i;?>">
									<a href="#" class="btn btn-link text-dark collapsed" data-toggle="collapse" data-target="#collapse<?php echo $i;?>" aria-expanded="false" aria-controls="collapse<?php echo $i;?>">
									<?php echo $val['event_name']; ?>
									</a>
								</div>
								<div id="collapse<?php echo $i;?>" class="collapse <?php echo ($i==0?'show':''); ?>" aria-labelledby="heading<?php echo $i;?>" data-parent="#accordion">
									<div class="card-body">
										<div class="row mb-3">
											<div class="col-md-10">
												<p class="mb-0">วันที่จัดกิจกรรม : <?php echo date_f($val['event_date_start'],'Y-M-d'); ?></p>
												<p class="mb-0">สถานที่จัดงาน : <?php echo $val['event_place']; ?></p>
												<p class="mb-0">จำนวนผุ้เข้าร่วม : <?php echo $val['event_total']; ?></p>
												<p class="mb-0">จำนวนผู้จองกิจกรรมล่าสุด : <?php echo $val['event_total_join']; ?></p>
												<?php if (!empty($val['event_file'])) { ?>
												<p class="mb-0">ดาวน์โหลดไฟล์ : <a href="<?php echo FILE_PATH.$val['event_file']; ?>" target="new">ไฟล์</a></p>
												<?php } ?>
											</div>
											<div class="col-md-2">
												<p class="text-danger">รอดำเนินการ</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<?php echo $val['event_detail']; ?>
											</div>
										</div>
									</div>
								</div>
								<?php $i++;} ?>
							</div>
							<?php if(empty($cancle)){ ?>
								<p class=""><b>ไม่พบกิจกรรม</b></p>
							<?php } ?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<h5 class="text-success">กิจกรรมที่ผ่านมา</h5>
							<hr>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div id="accordion">
								<?php $i=0;foreach($history as $val){ 
									$status = ($val['event_status']==0?'<span class="badge badge-pill badge-info float-right mt-2">สถานะ : '.$val['event_total_join'].'/'.$val['event_total'].'</span>':'<span class="badge badge-pill badge-danger float-right mt-2">สถานะ : เต็ม</span>');
								?>
								<div class="card-header p-1 bg-white" id="heading<?php echo $i;?>">
									<a href="#" class="btn btn-link text-dark collapsed" data-toggle="collapse" data-target="#collapse<?php echo $i;?>" aria-expanded="false" aria-controls="collapse<?php echo $i;?>">
									<?php echo $val['event_name']; ?>
									</a>
								</div>
								<div id="collapse<?php echo $i;?>" class="collapse <?php echo ($i==0?'show':''); ?>" aria-labelledby="heading<?php echo $i;?>" data-parent="#accordion">
									<div class="card-body">
										<div class="row mb-3">
											<div class="col-md-12">
												<p class="mb-0">วันที่จัดกิจกรรม : <?php echo date_f($val['event_date_start'],'Y-M-d'); ?></p>
												<p class="mb-0">สถานที่จัดงาน : <?php echo $val['event_place']; ?></p>
												<p class="mb-0">จำนวนผุ้เข้าร่วม : <?php echo $val['event_total']; ?></p>
												<p class="mb-0">จำนวนผู้จองกิจกรรมล่าสุด : <?php echo $val['event_total_join']; ?></p>
												<?php if (!empty($val['event_file'])) { ?>
												<p class="mb-0">ดาวน์โหลดไฟล์ : <a href="<?php echo FILE_PATH.$val['event_file']; ?>" target="new">ไฟล์</a></p>
												<?php } ?>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<?php echo $val['event_detail']; ?>
											</div>
										</div>
									</div>
								</div>
								<?php $i++;} ?>
							</div>
							<?php if(empty($history)){ ?>
								<p class=""><b>ไม่พบกิจกรรม</b></p>
							<?php } ?>
						</div>
					</div>
					<hr>
				</div>
			</div>
		</div>
	</div>
</div>

