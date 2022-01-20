<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card rounded-0 mb-5">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<h5>ตรวจสอบคะแนนพฤติกรรม <span class="<?php echo $point_class;?>">( <?php echo $point ?> คะแนน )</span></h5>
							<hr>
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>ลำดับ</th>
											<th>วันที่</th>
											<th>ประเภทความผิด</th>
											<th>หมายเหตุ</th>
											<th>คะแนน</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td style="width:70px;">1.</td>
											<td style="width:120px;">-</td>
											<td>-</td>
											<td>-</td>
											<td style="width:100px;">+ 100</td>
										</tr>
										<?php if(count($list_behavior)>0): ?>
											<?php $i=2;foreach($list_behavior as $val): ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo (!empty($val['date_create'])?date_f($val['date_create'],'Y-m-d'):''); ?></td>
												<td><?php echo $val['behavior_type_name']; ?></td>
												<td><?php echo $val['behavior_comment']; ?></td>
												<td>- <?php echo $val['behavior_point']; ?></td>
											</tr>
											<?php $i++;endforeach; ?>
										<?php endif ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#check').addClass('active');
	});
</script>

