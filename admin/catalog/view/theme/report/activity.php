<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">รายงานเข้าจองกิจกรรม</h4>
                  </div>
                  <div class="iq-card-header-toolbar d-flex align-items-center">
                     <?php if (count($listTakeEvent)>0) { ?>
                        <a href="<?php echo route('report/export'.'&type=1&id_event='.$id_event);?>" class="btn btn-primary">Export Excel</a>
                     <?php } ?>
                  </div>
               </div>
               <div class="iq-card-body">
                  <form action="<?php echo $action;?>" method="POST" class="mb-4">
                     <input type="hidden" name="route" value="student/home">
                     <div class="row">
                        <div class="col-md-3">
                           <label for="">เลือกกิจกรรม</label>
                           <?php Form::select('id_event', $event_list, '', 'id_event', 'event_name', is($data,'id_event')); ?>
                        </div>
                        <div class="col-md-2">
                           <label for="">&nbsp;</label>
                           <div>
                              <input type="submit" value="ค้นหา" class="btn btn-primary btn-block btn-lg">
                           </div>
                        </div>
                     </div>
                  </form>

                  <div class="table-responsive">
                     <table class="table mb-0 table-bordered" id="datatables">
                        <thead>
                           <tr>
                              <th scope="col" class="text-center"  style="width:12%;">ลำดับที่จอง</th>
                              <th scope="col" style="width:100px;">รหัสนักศึกษา</th>
                              <th scope="col">ชื่อ-สกุล</th>
                              <th scope="col">สถานะ</th>
                              <th scope="col">วัน-เวลา</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach($listTakeEvent as $key => $val): ?>
                           <tr>
                              <td class="text-center"><?php echo ++$key; ?></td>
                              <td><?php echo $val['stu_code']; ?></td>
                              <td><?php echo $val['stu_name'].' '.$val['stu_lname']; ?></td>
                              <td><?php echo $val['status']; ?></td>
                              <td><?php echo $val['take_event_date']; ?></td>
                           </tr>
                           <?php endforeach; ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<style href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"></style>
<style href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"></style>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>


<script>
   $(document).ready(function() {
      $('#report').addClass('menu-open');
      $('#report').find('.iq-submenu').addClass('menu-open');
      $('#r1').addClass('active');
   });
   $('#datatables').DataTable( {
        // dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ]
    } );
</script>
      
