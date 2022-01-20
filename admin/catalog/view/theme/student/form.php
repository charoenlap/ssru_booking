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
                     <h4 class="card-title">นักศึกษา</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <form action="<?php echo $action; ?>" method="post">
                     <div class="form-group row mb-0">
                      <label for="inputPassword" class="col-sm-2 col-form-label">รหัสนักศึกษา</label>
                      <div class="col-sm-10">
                        <?php Form::text('stu_code','รหัสนักศึกษา',''); ?>
                      </div>
                    </div>
                     <div class="form-group row mb-0">
                      <label for="inputPassword" class="col-sm-2 col-form-label">ชื่อ นามสกุล</label>
                      <div class="col-sm-2">
                        <?php Form::select('stu_prefix',$prefix,'','name','name',''); ?>
                      </div>
                      <div class="col-sm-4">
                        <?php Form::text('stu_name','ชื่อนักศึกษา',''); ?>
                      </div>
                      <div class="col-sm-4">
                        <?php Form::text('stu_lname','นามสกุล นักศึกษา',''); ?>
                      </div>
                    </div>
                     <div class="form-group row mb-0">
                      <label for="inputPassword" class="col-sm-2 col-form-label">วันเกิด (ค.ศ. - เดือน - วัน)</label>
                      <div class="col-sm-10">
                        <?php Form::date('stu_birth','วันเกิดนักศึกษา',''); ?>
                      </div>
                    </div>
                     <div class="form-group row mb-0">
                      <label for="inputPassword" class="col-sm-2 col-form-label">รหัสศูนย์</label>
                      <div class="col-sm-10">
                        <?php Form::select('center_code',$list_center,'','center_code','center_name',''); ?>
                      </div>
                    </div>
                     <div class="form-group row mb-0">
                      <label for="inputPassword" class="col-sm-2 col-form-label">คณะ</label>
                      <div class="col-sm-10">
                        <?php Form::select('id_group',$list_group,'','id_group','group_name',''); ?>
                      </div>
                    </div>
                     <div class="form-group row mb-0">
                      <label for="inputPassword" class="col-sm-2 col-form-label">สาขา</label>
                      <div class="col-sm-10">
                        <?php Form::select('branch_code',$list_branch,'','branch_code','branch_name',''); ?>
                      </div>
                    </div>
                     <div class="form-group row mb-0">
                      <label for="inputPassword" class="col-sm-2 col-form-label">ระดับการศึกษา</label>
                      <div class="col-sm-10">
                        <?php Form::select('level_code',$list_level,'','level_code','level_name',''); ?>
                      </div>
                    </div>
                     <div class="form-group row mb-0">
                      <label for="inputPassword" class="col-sm-2 col-form-label">รหัสเข้าระบบ</label>
                      <div class="col-sm-5">
                        <?php Form::text('stu_password','รหัสเข้าระบบ',''); ?>
                      </div>
                      <div class="col-sm-5">
                        <?php Form::text('confirm','ยืนยันรหัส',''); ?>
                      </div>
                    </div>
                     <div class="row">
                        <div class="col-md-12">
                           <button class="btn btn-success" type="submit">บันทึก</button>
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
</script>
      
