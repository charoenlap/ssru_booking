
      <!-- Page Content  -->
      <div id="content-page" class="content-page">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="iq-card">
                           <div class="iq-card-body tasks-box">
                              <div class="d-flex align-items-center">                                 
                                 <a href="#" class="iq-icon-box rounded-circle iq-bg-primary mr-3">
                                    <i class="las la-user-graduate"></i>
                                 </a>
                                 <div>
                                    <h6>ข้อมูลนักศึกษา :</h6>
                                    <h3><?php echo $dashboard['sum_student']; ?></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="iq-card">
                           <div class="iq-card-body tasks-box">
                              <div class="d-flex align-items-center">                                 
                                 <a href="#" class="iq-icon-box rounded-circle iq-bg-success mr-3">
                                    <i class="las la-calendar-check"></i>
                                 </a>
                                 <div>
                                    <h6>กิจกรรม :</h6>
                                    <h3><?php echo $dashboard['sum_event']; ?></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="iq-card">
                           <div class="iq-card-body tasks-box">
                              <div class="d-flex align-items-center">                                 
                                 <a href="#" class="iq-icon-box rounded-circle iq-bg-info mr-3">
                                    <i class="las la-file"></i>
                                 </a>
                                 <div>
                                    <h6>การเข้าร่วมกิจกรรม :</h6>
                                    <h3><?php echo $dashboard['sum_take_event']; ?></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="iq-card">
                           <div class="iq-card-body tasks-box">
                              <div class="d-flex align-items-center">                                 
                                 <a href="#" class="iq-icon-box rounded-circle iq-bg-danger mr-3">
                                    <i class="las la-user-tag"></i>
                                 </a>
                                 <div>
                                    <h6>ข้อมูลพฤติกรรม :</h6>
                                    <h3><?php echo $dashboard['sum_behavior']; ?></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-sm-12">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">กิจกรรม</h4>
                        </div>
                        <!-- <div class="iq-card-header-toolbar d-flex align-items-center">
                           <div class="dropdown">
                              <span class="dropdown-toggle text-primary" id="dropdownMenuButton-5" data-toggle="dropdown">
                              <i class="ri-more-2-fill"></i>
                              </span>
                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton-5">
                                 <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                 <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                 <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                 <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                 <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                              </div>
                           </div>
                        </div> -->
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <table class="table mb-0 table-bordered" id="datatables">
                              <thead>
                                 <tr>
                                    <th scope="col" class="text-center">ลำดับ</th>
                                    <th scope="col" style="width:15%">วันที่</th>
                                    <th scope="col">รหัสนักศึกษา</th>
                                    <th scope="col">ชื่อนักศึกษา</th>
                                    <th>ชื่อกิจกรรม</th>
                                 </tr>
                              </thead>
                              <tbody>
                                <!--  <?php $i=1;foreach($listTakeEvent as $val): ?>
                                 <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td><?php echo $val['stu_code']; ?></td>
                                    <td><?php echo $val['stu_name'].' '.$val['stu_lname']; ?></td>
                                    <td><?php echo $val['event_name']; ?></td>
                                 </tr>
                                 <?php $i++;endforeach; ?> -->
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
      $('#dashboard').addClass('active');

      



      var paramemter = new Object();

      var path  = '<?php echo route('dashboard/ajaxListTakeEvent');?>';
      var table = $('#datatables');
      table.DataTable({
         processing : true,
         serverSide : true,
         searching: false,
         paging: false,
         info: false,
         ordering: false,
         // order: [[0, "asc"]],
         columnDefs: [
            // { targets: 0, orderable: false },
            // { targets: 7, orderable: false },
            // { className: "text-center", "targets": [ 0,1,2,3,4,8 ] },
            // { className: "text-right", "targets": [ 5,6,7 ] }
         ],
         ajax : {
            url : path,
            type: "POST",
            data: paramemter,
            dataFilter: function(data){
               var json = jQuery.parseJSON( data );
               console.log(json);
               return JSON.stringify( json ); // return JSON string
            }
         },
         dataSrc: 'data',
         columns: [
            { data: 'no' },
            { data: 'date' },
            { data: 'stu_code' },
            { data: 'stu_name' },
            { data: 'event_name' },
         ],
      });

   });
</script>
      
