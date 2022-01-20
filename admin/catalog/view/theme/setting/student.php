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
                     <h4 class="card-title">ตั้งค่า ประเภทนักศึกษา</h4>
                  </div>
                  <div class="iq-card-header-toolbar d-flex align-items-center">
                     <a href="<?php echo route('setting/student_form'); ?>" class="btn btn-primary">เพิ่มประเภทนักศึกษา</a>
                  </div>
               </div>
               <div class="iq-card-body">
                  <table class="table">
                     <thead>
                        <tr>
                           <th>ชื่อ</th>
                           <th width="25%"></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($students as $key => $value): ?>
                        <tr>
                           <td><?php echo $value['type_student_name'].' '.($value['type_student_status']==0?'<span class="text-danger">[ปิด]</span>':''); ?></td>
                           <td class="text-center">
                              <a href="index.php?route=setting/student_form&id=<?php echo $value['id_type_student'];?>" class="btn btn-primary">แก้ไข</a>
                              <a href="index.php?route=setting/student_del&id=<?php echo $value['id_type_student'];?>" onclick="return confirm('ยืนยันการลบ');" class="btn btn-primary">ลบ</a>
                           </td>
                        </tr>
                        <?php endforeach ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
   $(document).ready(function() {
      $('#setting').addClass('active');
      $('#setting').find('.iq-submenu').addClass('menu-open');
      $('#s2').addClass('active');
      $('.table').DataTable();
   });
</script>
      
