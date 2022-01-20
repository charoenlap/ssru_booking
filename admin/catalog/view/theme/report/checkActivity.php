<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">รายงานตรวจสอบชั่วโมงกิจกรรม</h4>
                  </div>
                  <div class="iq-card-header-toolbar d-flex align-items-center">
                     <a href="" class="btn btn-primary">เพิ่มกิจกรรม</a>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="table-responsive">
                     <table class="table mb-0 table-bordered" id="datatables">
                        <thead>
                           <tr>
                              <th scope="col" class="text-center">No</th>
                              <th scope="col">กิจกรรม</th>
                              <th scope="col" class="text-center">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td class="text-center">1</td>
                              <td>Lorem ipsum dolor sit amet</td>
                              <td class="text-center"><button class="btn btn-primary">Edit</button></td>
                           </tr>
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
      $('#report').addClass('menu-open');
      $('#report').find('.iq-submenu').addClass('menu-open');
      $('#r4').addClass('active');
   });
   $('#datatables').DataTable();
</script>
      
