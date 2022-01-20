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
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-3">
            <div class="iq-card">
               <div class="iq-card-body">
                  <p>รหัสนักศึกษา <?php echo $student['stu_code']; ?></p>
                  <p>ชื่อนักศึกษา <?php echo $student['stu_prefix']; ?> <?php echo $student['stu_name']; ?></p>
                  <p>นามสกุล <?php echo $student['stu_lname']; ?></p>
               </div>
            </div>
         </div>
         <div class="col-sm-9">
            <div class="iq-card">
               <div class="iq-card-body">
                  <table class="table mb-0 table-bordered">
                     <thead>
                        <tr></tr>
                     </thead>
                     <tbody>
                        <?php $i=0;foreach($event as $val){?>
                           <tr>
                              <td><?php echo ++$i;?></td>
                              <td><?php echo $val['event_name'];?></td>
                              <td><?php echo $val['event_date_start'];?></td>
                              <td><?php echo $val['event_unit'];?></td>
                              <td><?php echo $val['event_hour'];?></td>
                              <td>
                                 <a href="index.php?route=student/del&id=<?php echo $val['id_take_event'];?>&id_student=<?php echo $id_student;?>" class="btn btn-primary">ลบ</a>
                              </td>
                           </tr>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>