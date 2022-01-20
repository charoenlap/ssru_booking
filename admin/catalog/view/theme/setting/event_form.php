<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <?php if(isset($result)){ ?>
      <div class="row">
         <div class="col-md-12">
            <p class="alert alert-success">บันทึกเรียบร้อย</p>
         </div>
      </div>
      <?php } ?>
      <div class="row">
         <div class="col-sm-12">
            
            <?php if (!empty($success)): ?>
               <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
            <?php endif ?>
            <?php if (!empty($error)): ?>
               <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
            <?php endif ?>
            <div class="iq-card">
               <form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
                  <div class="iq-card-header d-flex justify-content-between">
                     <div class="iq-header-title">
                        <h4 class="card-title">กิจกรรม</h4>
                     </div>
                     <div class="iq-card-header-toolbar d-flex align-items-center">
                        
                     </div>
                  </div>
                  <div class="iq-card-body">
                     <div class="row mb-3">
                        <div class="col-md-6">
                           <label for="">ชื่อกิจกรรม</label>
                           <?php Form::text('event_type_name','ชื่อกิจกรรม',is($data,'event_type_name')); ?>
                        </div>
                        <div class="col-md-6">
                           <label for="">สถานะ</label>
                           <?php Form::select('event_type_status', $status, 'select2', 'key', 'text',is($data,'event_type_status')); ?>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <a href="index.php?route=setting/event" class="btn btn-outline-dark">ยกเลิก</a>
                           <button class="btn btn-success" type="submit">บันทึก</button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

      
<script>
   $(document).ready(function() {
      $('#setting').addClass('menu-open');
      $('#setting').find('.iq-submenu').addClass('menu-open');
      $('#s1').addClass('active');
   $('#datatables').DataTable();
   });

</script>

