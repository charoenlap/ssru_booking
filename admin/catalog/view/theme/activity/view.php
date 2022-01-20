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
                     <h4 class="card-title">ผู้เข้าร่วมกิจกรรม <a href="index.php?route=activity/home"><u><?php echo $event['event_name'];?></u></a></h4>
                  </div>
                  <!-- <div class="iq-card-header-toolbar d-flex align-items-center">
                     <a href="<?php echo route('activity/form'); ?>" class="btn btn-primary">เพิ่มกิจกรรม</a>
                  </div> -->
               </div>
               <div class="iq-card-body">
                  <div class="table-responsive">
                     <table class="table mb-0 table-bordered" id="datatables">
                        <thead>
                           <tr>
                              <th scope="col" class="text-center" width="50px">No</th>
                              <th scope="col">รหัสนักศึกษา</th>
                              <th scope="col">ชื่อ</th>
                              <th scope="col">ปี</th>
                              <th scope="col">ประเภท</th>
                              <th scope="col">คณะ</th>
                              <th scope="col">สาขา</th>
                              <th scope="col" width="15%">ยกเลิก</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $i=1;foreach($list_take as $val){ ?>
                           <tr>
                              <td class="text-center"><?php echo $i; ?></td>
                              <td><?php echo $val['stu_code']; ?></td>
                              <td><?php echo $val['stu_prefix'].' '.$val['stu_name'].' '.$val['stu_lname']; ?></td>
                              <td><?php echo $val['stu_year']; ?></td>
                              <td><?php echo $val['level_name']; ?></td>
                              <td><?php echo $val['group_name']; ?></td>
                              <td><?php echo $val['branch_name']; ?></td>
                              <td class="text-center"><a href="index.php?route=activity/cancelEvent&id_event=<?php echo $val['id_event'];?>&id_student=<?php echo $val['id_student'];?>" class="btn btn-primary" onclick="return confirm('ยืนยันยกเลิกการจอง');">ยกเลิกการจอง</a></td>
                           </tr>
                           <?php $i++; } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

      
<script>
   $(document).ready(function() {
      $('#activity').addClass('menu-open');
      $('#activity').find('.iq-submenu').addClass('menu-open');
      $('#a1').addClass('active');
   });
   $('#datatables').DataTable();
</script>

