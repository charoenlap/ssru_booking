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
                     <h4 class="card-title">ข้อมูลนักศึกษา</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <form action="<?php echo $action;?>" method="POST" class="mb-4">
                     <div class="row">
                        <div class="col">
                           <label for="">รหัสนักศึกษา</label>
                           <input type="text" readonly class="form-control-plaintext" value="<?php echo $student['stu_code'];?>">
                        </div>
                        <div class="col">
                           <label for="">ชื่อ</label>
                           <input type="text" readonly class="form-control-plaintext" value="<?php echo $student['stu_name'].' '.$student['stu_lname'];?>">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col">
                           <label for="">รหัสผ่าน</label>
                           <input type="text" name="password" class="form-control" value="" required autofocus="on">
                        </div>
                        <div class="col">
                           <label for="">ยืนยันรหัสผ่าน</label>
                           <input type="text" name="confirm" class="form-control" value="" required>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col">
                           <label for="">&nbsp;</label>
                           <div>
                              <input type="submit" value="เปลี่ยนรหัสผ่าน" class="btn btn-primary btn-block btn-lg">
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {
      $('#student').addClass('active');
   });
   $('#datatables').DataTable();
</script>
      
