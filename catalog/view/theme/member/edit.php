<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card mt-3 rounded-0">
				<div class="card-body">
					<form action="<?php echo $action ?>" method="POST">
						<?php if($result=='success'){?>
							<p class="alert alert-success">เปลี่ยนรหัสผ่านสำเร็จ</p>
						<?php }elseif($result=='fail'){?>
							<p class="alert alert-danger">โปรดตรวจสอบ รหัสผ่านไม่ตรงกัน หรือเป็นค่าว่าง</p>
						<?php } ?>
						<div class="row">
							<div class="col-md-12">
								<h5>แก้ไขข้อมูลนักศึกษา</h5>
								<hr>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-6">
								<label for="">รหัสผ่าน</label>
								<input type="password" class="form-control" placeholder="password" name="password">
							</div>
							<div class="col-md-6">
								<label for="">ยืนยันรหัสผ่าน</label>
								<input type="password" class="form-control" placeholder="confirm password" name="confirmPassword">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-right">
								<button class="btn btn-primary">บันทึกรหัสผ่าน</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>