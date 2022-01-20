<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">ตั้งค่าทั่วไป</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="table-responsive">
                     <table class="table mb-0 table-bordered" id="datatables">
                        <thead>
                           <tr>
                              <th scope="col" class="text-center" style="width:70px;">ลำดับ</th>
                              <th style="width:70px;"></th>
                              <th scope="col">รายการ</th>
                              <th scope="col" style="width:70px;">วันที่แก้ไข</th>
                              <th scope="col" class="text-center" style="width:70px;">แก้ไข</th>

                           </tr>
                        </thead>
                        <tbody>
                           <?php $i=1;foreach($setting as $val){ ?>
                           <tr>
                              <td class="text-center"><?php echo $i; ?></td>
                              <td>
                                 <?php if($val['setting_type']=="1"){?>
                                 <img src="../uploads/setting/<?php echo $val['setting_value']; ?>" alt="" style="width:150px;">
                                 <?php } ?>
                              </td>
                              <td><?php echo $val['setting_name']; ?></td>
                              <td><?php echo (!empty($val['date_update'])?date_f($val['date_update'],'Y-m-d'):''); ?></td>
                              <td class="text-center">
                                 <a href="<?php echo route('banner/subBanner&id_setting='.$val['id_setting']); ?>" class="btn btn-info">แก้ไข</a>
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
      $('#setting').addClass('active');
      $('#setting').find('.iq-submenu').addClass('menu-open');
      $('#s4').addClass('active');
      $('.table').DataTable();
   });
</script>
      
