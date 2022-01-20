<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">ตั้งค่า</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
                     <input type="hidden" name="id_setting" value="<?php echo $id_setting; ?>">
                     <div class="row mb-3">
                        <div class="col-md-6">
                           <label for="">ชื่อ</label>
                           <?php Form::text('setting_name','ชื่อ',is($setting,'setting_name')); ?>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="">อัพโหลดไฟล์</label>
                              <?php echo is($setting,'setting_value'); ?>
                              <div class="custom-file">
                                 <input type="file" class="custom-file-input" id="customFile" name="setting_file">
                                 <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <input type="submit" value="บันทึก" class="btn btn-primary">
                           <a href="<?php echo route('banner/home'); ?>" class="btn">กลับ</a>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- <script>
   $(document).ready(function() {
      $('#banner').addClass('active');
   });
   $('#datatables').DataTable();
</script>
       -->
