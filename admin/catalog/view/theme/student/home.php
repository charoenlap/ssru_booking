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
               <div class="iq-card-body">
                  <form action="<?php echo $action;?>" method="GET" class="mb-4">
                     <input type="hidden" name="route" value="student/home">
                     <div class="row">
                        <div class="col">
                           <label for="">รหัสนักศึกษา</label>
                           <input type="text" class="form-control" placeholder="รหัสนักศึกษา" name="stu_code" value="<?php echo $stu_code; ?>">
                        </div>
                        <div class="col">
                           <label for="">รหัสศูนย์</label>
                           <select name="center_code" class="form-control" id="">
                              <option value="">เลือกศูนย์</option>
                              <?php foreach($list_center as $val){?>
                              <option value="<?php echo $val['center_code'];?>" <?php echo ($val['center_code']==get('center_code')?'selected':''); ?>><?php echo $val['center_name'];?></option>
                              <?php } ?>
                           </select>
                        </div>
                        <div class="col">
                           <label for="">คณะ</label>
                           <select name="id_group" class="form-control" id="">
                              <option value="">เลือกคณะ</option>
                              <?php foreach($list_group as $val){?>
                              <option value="<?php echo $val['id_group'];?>" <?php echo ($val['id_group']==get('id_group')?'selected':''); ?>><?php echo $val['group_name'];?></option>
                              <?php } ?>
                           </select>
                        </div>
                        <div class="col">
                           <label for="">สาขา</label>
                           <div id="htmlbranch"></div>
                           <!-- <select name="branch_code" class="form-control" id="">
                              <option value="">สาขา</option>
                              <?php foreach($list_branch as $val){?>
                              <option value="<?php echo $val['branch_code'];?>" <?php echo ($val['branch_code']==$branch_code?'selected':''); ?>><?php echo $val['branch_code'].' '.$val['branch_name'];?></option>
                              <?php } ?>
                           </select> -->
                        </div>
                        <div class="col">
                           <label for="">รหัสระดับการศึกษา</label>
                           <select name="level_code" class="form-control" id="">
                              <option value="">เลือกระดับการศึกษา</option>
                              <?php foreach($list_level as $val){?>
                              <option value="<?php echo $val['level_code'];?>" <?php echo ($val['level_code']==get('level_code')?'selected':''); ?>><?php echo $val['level_name'];?></option>
                              <?php } ?>
                           </select>
                        </div>
                        <div class="col">
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
                              <th scope="col" class="text-center">No</th>
                              <th scope="col">รหัสนักศึกษา</th>
                              <th scope="col">ชื่อ - สกุล</th>
                              <th>รหัสศูนย์</th>
                              <th>คณะ</th>
                              <th>สาขา</th>
                              <th>รหัสระดับการศึกษา</th>
                              <th width="170px;">แก้ไข</th>
                           </tr>
                        </thead>
                        <tbody></tbody>
                     </table>
                  </div>
                  <hr>
                  <!-- <?php echo $pageing; ?> -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {

      $('#student').addClass('menu-open');
      $('#student').find('.iq-submenu').addClass('menu-open');
      $('#st1').addClass('active');

      function getBranchCode() {
         return $('#htmlbranch [name="branch_code"]').val();
      }
   
      var paramemter = new Object();
      paramemter.stu_code    = '<?php echo get('stu_code');?>';;
      paramemter.center_code = '<?php echo get('center_code');?>';
      paramemter.id_group    = '<?php echo get('id_group');?>';
      paramemter.branch_code = '<?php echo get('branch_code');?>';
      paramemter.level_code  = '<?php echo get('level_code');?>';;

      var path  = '<?php echo route('student/ajaxGetStudents');?>';
      var table = $('#datatables');
      table.DataTable({
         processing : true,
         serverSide : true,
         order: [[1, "asc"]],
         columnDefs: [
            { targets: 0, orderable: false },
            { targets: 7, orderable: false },
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
            { data: 'stu_code' },
            { data: 'stu_name' },
            { data: 'center_name' },
            { data: 'group_name' },
            { data: 'branch_name' },
            { data: 'level_name' },
            { data: 'link' },
         ],
      });




      <?php if (!empty($id_group)) { ?>
      getBranch(<?php echo $id_group;?>,<?php echo isset($branch_code)&&!empty($branch_code) ? $branch_code : '';?>);
      <?php } else { ?>
      // getBranch($('[name="id_group"] > option:first-child').attr('value'));
      $('#htmlbranch').html('<select class="form-control " name="branch_code" id="branch_code" style="width: 100%"><option value="">กรุณาเลือกคณะ</option></select>');
      <?php } ?>
      $('[name="id_group"]').change(function(event) {
         $('#htmlbranch').html('<select class="form-control" disabled="disabled"><option>กำลังโหลด</option></select>');
         getBranch($(this).val());
      });
       
      function getBranch(value, selected='') {
         $.post('<?php echo MURL.'admin/'.route('report/getBranchByGroupId');?>', {id_group: value, default: selected}, function(data, textStatus, xhr) {
            $('#htmlbranch').html(data);
         });
      }
   });
</script>
      
