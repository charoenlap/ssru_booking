<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            
            <?php if (!empty($success)): ?>
               <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
            <?php endif ?>
            <?php if (!empty($error)): ?>
               <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
            <?php endif ?>
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">อัพโหลดข้อมูลนักศึกษา</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <form action="<?php echo $action_form_import; ?>" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleFormControlFile1">File CSV</label>
                      <input type="file" class="form-control-file" name="file" id="file" accept=".csv">
                      <a href="csv/1595578330_import_student.csv" target="new">ตัวอย่างไฟล์</a>
                    </div>
                    <div class="form-group">
                      <label for=""></label>
                        <button type="submit" id="submit" name="import" class="btn btn-primary btn-sm ">Import (.csv)</button>
                    </div>
                 
                 </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="uploadalert">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger">คำเตือน!!</h5>
      </div>
      <div class="modal-body">
        <p><i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i> ระบบกำลังอัพโหลดไฟล์และประมวลผล กรุณารอจนกว่าข้อความนี้จะหายไป</p>
      </div>
    </div>
  </div>
</div>
<script>
   $(document).ready(function() {

      $('#frmExcelImport').submit(function(event) {
         $('#uploadalert').modal({ backdrop: false });
      });


      $('#student').addClass('menu-open');
      $('#student').find('.iq-submenu').addClass('menu-open');
      $('#st2').addClass('active');
   
   });
</script>
      
