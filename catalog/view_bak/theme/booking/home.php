<?php if($status=='fail'){?>
<p class="alert alert-danger">คุณได้จองกิจกรรมนี้ไปแล้ว</p>
<?php } ?>
<div class="container">
	<div class="row">
		<div class="col-lg-3 col-md-4">
			<div class="card rounded-0 mb-2">
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
							<p><b>หน่วยกิจกรรมสะสม</b> (<?php echo $stu_point_event; ?>)</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<a href="<?php echo route('member/edit'); ?>" class="btn btn-outline-dark mb-3 w-100 rounded-0">แก้ไขข้อมูลส่วนตัว</a>
						</div>
						<div class="col-md-12">
							<a href="<?php echo route('booking/booking'); ?>" class="btn btn-outline-dark mb-3 w-100 rounded-0">ตรวจสอบกิจกรรมที่ได้เข้าร่วม</a>
						</div>
					</div>
				</div>
			</div>
			<div class="card rounded-0 mb-2">
				<div class="card-body">
					<form action="<?php echo $action;?>" method="GET">
						<input type="hidden" name="route" value="booking/home">
						<div class="row">
							<div class="col-md-12">
								<h5>ตัวกรอง</h5>
								<hr>
							</div>
							<div class="col-md-12 ">
								<label for="">วันที่</label>
								<?php Form::date('date_start','วันที่',$date_start); ?>
							</div>
							<div class="col-md-12 ">
								<label for="">ถึงวันที่</label>
								<?php Form::date('date_end','ถึงวันที่',$date_end); ?>
							</div>
							<div class="col-md-12">
								<label>ประเภทกิจกรรม</label>
								<select name="list_event_type" id="" class="form-control rounded-0">
									<option value="">ทั้งหมด</option>
									<?php foreach($list_event_type as $val){ ?>
										<option value="<?php echo $val['id_event_type']?>" <?php echo ($txt_event_type==$val['id_event_type']?'selected':''); ?>><?php echo $val['event_type_name']?></option>
									<?php } ?>
								</select>
								
							</div>
							<div class="col-md-12 mt-3">
								<div class="row">
									<div class="col-md-6">
										<a href="<?php echo route('booking/home');?>">ล้างการค้นหา</a>
									</div>
									<div class="col-md-6">
										<input type="submit" class="btn btn-primary btn-block" value="ค้นหา">
									</div>
								</div>
								<hr>
							</div>
							<div class="col-md-12">
								<a href="<?php echo route('booking/booking'); ?>" class="btn btn-warning mb-3 w-100 rounded-0">กิจกรรมที่จอง</a>
							</div>
							<div class="col-md-12">
								<a href="<?php echo route('booking/booking'); ?>" class="btn btn-success mb-3 w-100 rounded-0">กิจกรรมที่ผ่านมา</a>
							</div>
							<div class="col-md-12">
								<a href="<?php echo route('booking/booking'); ?>" class="btn btn-danger mb-3 w-100 rounded-0">กิจกรรมที่ยกเลิก</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-9 col-md-8">
			<div class="card rounded-0">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<h5>รายการกิจกรรมที่เปิดจอง</h5>
							<hr>
						</div>
						<div class="col-md-12">
							<div id="accordion">
								<?php if (count($list_event)>0): ?>
								<?php $i=0;foreach($list_event as $val){
									$status = ($val['event_status']==0?'<span class="badge badge-pill badge-info float-right mt-2">สถานะ : '.$val['event_total_join'].'/'.$val['event_total'].'</span>':'<span class="badge badge-pill badge-danger float-right mt-2">สถานะ : เต็ม</span>');
								?>
								<div class="card">
									<div class="card-header p-1 bg-white" id="heading<?php echo $i;?>">
										<h5 class="mb-0">
										<button class="btn btn-link text-dark" 
										data-toggle="collapse" 
										data-target="#collapse<?php echo $i;?>" 
										aria-expanded="true" 
										aria-controls="collapse<?php echo $i;?>">
										<?php echo $val['event_name']; ?>
										</button>
										<?php echo $status; ?>
										</h5>
									</div>
									<div id="collapse<?php echo $i;?>" class="collapse <?php echo ($i==0?'show':''); ?>" aria-labelledby="heading<?php echo $i;?>" data-parent="#accordion">
										<div class="card-body">
											<div class="row mb-3">
												<div class="col-md-12">
													<p class="mb-0">วันที่จัดกิจกรรม : <?php echo (isset($val['event_date_start'])?date_f($val['event_date_start'],'Y-M-d'):''); ?></p>
													<p class="mb-0">สถานที่จัดงาน : <?php echo $val['event_place']; ?></p>
													<p class="mb-0">จำนวนผู้เข้าร่วม : <?php echo $val['event_total']; ?></p>
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
												<?php if($val['event_status']==0){ ?>
													<?php  
													$condition = array();
													$condition[1] = (!in_array($val['id_event'],$take_event)); // ยังไม่เคยลงกิจกรรมนี้
													$condition[2] = $val['event_total']!=0; // ตั้งค่าจำนวนกิจกรรม
													$condition[3] = $val['event_total_join']<=$val['event_total']; // มีคนลงกิจกรรมนี้เกิน
													$condition[4] = (!in_array($val['id_event'],$cancelevent)); // กำลังยกเลิก
													?>
													<div class="col-md-12 text-right">
														<?php if (in_array($val['id_event'],$take_event)): // เคยลงกิจกรรมนี้แล้ว ?>
															<p class="text-success">คุณได้จองกิจกรรมนี้แล้ว</p>
														<?php elseif ($val['event_total_join']>=$val['event_total']): // มีคนลงกิจกรรมนี้เต็มแล้ว ?>
															<p class="text-success">กิจกรรมนี้เต็มแล้ว</p>
														<?php elseif (in_array($val['id_event'],$cancelevent)): // มีคนลงกิจกรรมนี้เต็มแล้ว ?>
															<p class="text-danger">รอดำเนินการยกเลิกกิจกรรม</p>
														<?php else: ?>
															<a class="btn btn-success rounded-0" href="<?php echo route('booking/takeEvent&id_event_sub='.$val['id_event_sub']); ?>">จองทันที</a>
														<?php endif ?>
													</div>
													
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								<?php $i++;} ?>
								<?php endif ?>
							</div>
							<?php if(empty($list_event)){ ?>
								<p class="text-danger"><b>ไม่พบกิจกรรม</b></p>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="row">
		<div class="col-md-2">
			<div class="nav flex-column nav-pills menu-date" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">20 ต.ค 2563</a>
				<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">19 ต.ค 2563</a>
				<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">10 ต.ค 2563</a>
				<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">5 ต.ค 2563</a>
			</div>
		</div>
		<div class="col-md-10">
			<div class="card rounded-0">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<h5>รายการกิจกรรม</h5>
						</div>
						<div class="col-md-6 text-right">
							<a href="<?php echo route('booking/booking'); ?>" class="btn btn-warning rounded-0">กิจกรรมที่จอง</a>
							<button class="btn btn-success rounded-0">กิจกรรมที่ผ่านมา</button>
							<button class="btn btn-danger rounded-0">กิจกรรมที่ยกเลิก</button>
						</div>
						<div class="col-md-12">
							<hr>
						</div>
					</div>
					<div class="tab-content" id="v-pills-tabContent">
						<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
							<div class="row">
								<div class="col-md-12">
									<div id="accordion">
										<div class="card">
											<div class="card-header p-1 bg-white" id="headingOne">
												<h5 class="mb-0">
												<button class="btn btn-link text-dark" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												กิจกรรม Lorem ipsum dolor sit amet, consectetur adipisicing elit #1
												</button>
												</h5>
											</div>
											<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
												<div class="card-body">
													<div class="row mb-3">
														<div class="col-md-12">
															<p class="mb-0">วันที่จัดกิจกรรม : 16 ก.ย. 63</p>
															<p class="mb-0">สถานที่จัดงาน : ห้องประชุมช่อแก้ว ชั้น 3</p>
															<p class="mb-0">จำนวนผุ้เข้าร่วม : 100</p>
															<p class="mb-0">จำนวนผู้จองกิจกรรมล่าสุด : 50</p>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<p>
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam pariatur totam excepturi, ratione consectetur ex, fuga, quam deserunt molestias facilis debitis! Animi, quis quisquam aliquid aspernatur, excepturi fuga pariatur facere? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis officia corporis ipsum veniam maiores hic consequatur. Tempore tenetur, in sed iusto, ab et quos magni fuga quia hic illo possimus.
															</p>
														</div>
														<div class="col-md-12">
															<button class="btn btn-success">จองทันที</button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-header p-1 bg-white" id="headingTwo">
												<h5 class="mb-0">
												<button class="btn btn-link text-dark collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
												กิจกรรม Lorem ipsum dolor sit amet, consectetur adipisicing elit #2
												</button>
												</h5>
											</div>
											<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
												<div class="card-body">
													<div class="row">
														<div class="col-md-12">
															<p>
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus reiciendis, fugit sapiente quisquam repellendus a similique recusandae sint mollitia fuga obcaecati culpa. Quo ducimus dolorem hic voluptas sed error explicabo? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum eum adipisci beatae perferendis eveniet, deserunt in suscipit, rerum doloribus reprehenderit optio accusamus fugiat rem animi doloremque alias aliquid natus. Sit!
															</p>
														</div>
														<div class="col-md-12">
															<button class="btn btn-success">จองทันที</button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-header p-1 bg-white" id="headingThree">
												<h5 class="mb-0">
												<button class="btn btn-link text-dark collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
												กิจกรรม Lorem ipsum dolor sit amet, consectetur adipisicing elit #3
												</button>
												</h5>
											</div>
											<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
												<div class="card-body">
													<div class="row">
														<div class="col-md-12">
															<p>
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus obcaecati debitis, in ipsum aliquam minima officiis id omnis optio porro dignissimos officia saepe laudantium ad non aperiam dicta quo nulla.
															</p>
														</div>
														<div class="col-md-12">
															<button class="btn btn-success">จองทันที</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
					  	<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
					  	<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
</div>

<script>
	$(document).ready(function() {
		$('#booking').addClass('active');
	});
</script>
