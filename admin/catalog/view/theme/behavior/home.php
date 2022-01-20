
      <!-- Page Content  -->
      <div id="content-page" class="content-page">
         <div class="container-fluid">
            <?php if(!empty($result)): ?>
            <div class="row">
               <div class="col-md-12">
                  <p class="text-success alert alert-success">
                     เพิ่มพฤติกรรมสำเร็จ
                  </p>
               </div>
            </div>
            <?php endif; ?>
            <div class="row">
               <div class="col-sm-12">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">ข้อมูลพฤติกรรม</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                           <a href="<?php echo route('behavior/form'); ?>" class="btn btn-primary">เพิ่มกิจกรรม</a>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <table class="table mb-0 table-bordered" id="datatables">
                              <thead>
                                 <tr>
                                    <th scope="col" width="50px">ลำดับ</th>
                                    <th scope="col">รหัสนักศึกษา</th>
                                    <th scope="col">หมายเหตุ</th>
                                    <th scope="col">คะแนน</th>
                                    <th scope="col">วันที่สร้าง</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php $i=1;foreach($list_stu_behavior['data'] AS $val): ?>
                                 <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $val['stu_code']; ?></td>
                                    <td><?php echo $val['behavior_type_name']; ?></td>
                                    <td>(- <?php echo (int)$val['behavior_point']; ?>)</td>
                                    <td><?php echo (!empty($val['date_create'])?date_f($val['date_create'],'Y-m-d H:i:s'):''); ?></td>
                                 </tr>
                              <?php $i++;endforeach; ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

<script>
   $(document).ready(function() {
      $('#behavior').addClass('active');
   });
   $('#datatables').DataTable();
</script>
      
