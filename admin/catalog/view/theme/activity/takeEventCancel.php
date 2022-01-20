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
                     <h4 class="card-title">นักศึกษาที่ ยกเลิกกิจกรรม</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="table-responsive">
                     <table class="table mb-0 table-bordered" id="datatables">
                        <thead>
                           <tr>
                              <th scope="col" class="text-center" width="50px">No</th>
                              <th scope="col">กิจกรรม</th>
                              <th scope="col">กลุ่ม</th>
                              <th scope="col">รหัสนักศึกษา</th>
                              <th scope="col">นักศึกษา</th>
                              <th scope="col">วันที่ขอยกเลิก</th>
                              <th scope="col" class="text-center" width="25%">จัดการ</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $i=1;foreach($list_event as $val){ ?>
                           <tr>
                              <td class="text-center"><?php echo $i; ?></td>
                              <td><?php echo $val['event_name']; ?></td>
                              <td><?php echo $val['group_name'].' '.$val['branch_name']; ?></td>
                              <td><?php echo $val['stu_code']; ?></td>
                              <td><?php echo $val['stu_prefix'].' '.$val['stu_name'].' '.$val['stu_lname']; ?></td>
                              <td><?php echo $val['cancel_date']; ?></td>
                              <td class="text-center">
                                 <a class="btn btn-primary" href="<?php echo route('activity/confirmCancelTakeEvent&id_event='.$val['id_event'].'&id_student='.$val['id_student']); ?>">ยืนยันการยกเลิก</a>
                                 <a class="btn btn-danger" onclick="return confirm('ไม่ยืนยันการยกเลิกกิจกรรมนี้');" href="<?php echo route('activity/cancelCancelTakeEvent&id_event='.$val['id_event'].'&id_student='.$val['id_student']); ?>">ไม่ยืนยัน</a>
                              </td>
                           </tr>
                           <?php $i++;} ?>
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
      $('#a3').addClass('active');
   });
   $('#datatables').DataTable();
</script>

