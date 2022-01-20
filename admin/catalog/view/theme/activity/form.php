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
               <form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="route" value="<?php echo $route;?>">
                  <input type="hidden" name="id_event" value="<?php echo $id_event;?>">
                  <div class="iq-card-header d-flex justify-content-between">
                     <div class="iq-header-title">
                        <h4 class="card-title">กิจกรรม</h4>
                     </div>
                     <div class="iq-card-header-toolbar d-flex align-items-center">
                        
                     </div>
                  </div>
                  <div class="iq-card-body">
                     <div class="row mb-3">
                        <div class="col-md-6">
                           <label for="">ชื่อกิจกรรม</label>
                           <?php Form::text('event_name','ชื่อกิจกรรม',is($data,'event_name')); ?>
                        </div>
                        <div class="col-md-6">
                           <label for="">ปีการศึกษา</label>
                           <?php Form::number('event_year','ปีการศึกษา',is($data,'event_year')); ?>
                        </div>
                     </div>
                     <div class="row mb-3">
                        <div class="col-md-6">
                           <label for="">สถานที่จัด</label>
                           <?php Form::text('event_place','สถานที่จัด',is($data,'event_place')); ?>
                        </div>
                        <div class="col-md-6">
                           <label for="">ประธาน</label>
                           <?php Form::text('event_head','ประธาน',is($data,'event_head')); ?>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <label for="">ช่วงเวลากิจกรรม</label>
                        </div>
                     </div>
                     <div class="row mb-3">
                        <div class="col-md-6">
                           <?php Form::date('event_date_start','วันที่เริ่ม',date_f(is($data,'event_date_start'),'Y-m-d')); ?>
                           <?php Form::time('event_time_start','เวลาที่เริ่ม', time_f(is($data,'event_time_start')),'H:i'); ?>
                        </div>
                        <div class="col-md-6">
                           <?php Form::date('event_date_end','วันที่สิ้นสุด',date_f(is($data,'event_date_end'),'Y-m-d')); ?>
                           <?php Form::time('event_time_end','เวลาที่สิ้นสุด', time_f(is($data,'event_time_end')),'H:i'); ?>
                        </div>
                     </div>
                     <div class="row mb-3">
                        <div class="col-md-6">
                           <label for="">จำนวนผุ้เข้าร่วม</label>
                           <?php Form::number('event_total','จำนวนผุ้เข้าร่วม',is($data,'event_total')); ?>
                        </div>
                     </div>
                     <div class="row mb-3">
                        <div class="col-md-12 text-right">
                           <a id="btn-plus" href="#" class="btn btn-success"><i class="las la-plus"></i> เพิ่ม</a>
                        </div>
                     </div>
                     <div class="form-plus">
                     <?php foreach($sub as $key => $val){?>
                        <div class="row mb-3">
                           <div class="col-md-4">
                              <label for="">ประเภทกิจกรรม</label>
                              <?php Form::selectArr('id_event_type',$list_event,'select2','id_event_type','event_type_name',is($val,'id_event_type')); ?>
                           </div>
                           <div class="col-md-4">
                              <label for="">ประเภทนักศึกษา</label>
                              <?php Form::selectArr('id_type_student',$list_type_student,'select2','id_type_student','type_student_name',is($val,'id_type_student')); ?>
                           </div>
                           <div class="col-md-3">
                              <label for="">ชั้นปี</label>
                              <div class="form-group">
                                 <div class="">
                                    <input type="checkbox" class="" id="" name="chk[<?php echo $key;?>][1]" value="1" <?php echo ($val['year_1']?'checked':''); ?>> 1 
                                    <input type="checkbox" class="" id="" name="chk[<?php echo $key;?>][2]" value="1" <?php echo ($val['year_2']?'checked':''); ?>> 2
                                    <input type="checkbox" class="" id="" name="chk[<?php echo $key;?>][3]" value="1" <?php echo ($val['year_3']?'checked':''); ?>> 3
                                    <input type="checkbox" class="" id="" name="chk[<?php echo $key;?>][4]" value="1" <?php echo ($val['year_4']?'checked':''); ?>> 4
                                    <input type="checkbox" class="" id="" name="chk[<?php echo $key;?>][5]" value="1" <?php echo ($val['year_5']?'checked':''); ?>> 5
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php } ?>
                     </div>
                     <div class="row mb-3">
                        <div class="col-md-12">
                           <label for="">รายละเอียด</label>
                           <textarea id="" cols="30" rows="10" class="form-control" name="event_detail"><?php echo is($data,'event_detail'); ?></textarea>
                        </div>
                     </div>
                     <div class="row mb-3">
                        <div class="col-md-6">
                           <div class="form-group">
                              <?php echo is($data,'event_file'); ?>
                              <div class="custom-file">
                                 <input type="file" class="custom-file-input" id="customFile" name="event_file">
                                 <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row mb-3">
                        <!-- <div class="col-md-4">
                           <label for="">กิจกรรมหลัก</label>
                           <select name="" id="" class="form-control">
                              <option value=""></option>
                           </select>
                        </div> -->
                        <div class="col-md-4">
                           <label for="">จำนวนชั่วโมง</label>
                           <?php Form::text('event_hour','จำนวนชั่วโมง',is($data,'event_hour')); ?>
                        </div>
                        <div class="col-md-4">
                           <label for="">จำนวนหน่วยกิจ</label>
                           <?php Form::text('event_unit','จำนวนหน่วยกิจ',is($data,'event_unit')); ?>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <label for="">สภานะ</label>
                           <?php 
                           $list_status = array(
                              array('name'=>'เปิด','value'=>1),
                              array('name'=>'ปิด','value'=>0)
                           );
                           Form::select('event_show',$list_status,'','value','name',is($data,'event_show')); 
                           ?>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <a href="index.php?route=activity/home" class="btn btn-outline-dark">ยกเลิก</a>
                           <button class="btn btn-success" type="submit">บันทึก</button>
                        </div>
                     </div>
                  </div>
               </form>
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

   $(document).ready(function() {
      $('.form-plus').on('click', '.btn-delete', function(event) {
         event.preventDefault();
         var row = $(this).data('row');
         $('.form-plus .row.row'+row).remove();
         console.log(row);
      });
      var row=0;
      $('#btn-plus').click(function(event) {
         var html = '<div class="row mb-3 row'+row+'">'+
         '<div class="col-md-4">'+
         '<label for="">ประเภทกิจกรรม</label>'+
         '<?php Form::selectArr('id_event_type',$list_event,'select2','id_event_type','event_type_name',is($data,'id_event_type')); ?>'+
         '</div>'+
         '<div class="col-md-4">'+
         '<label for="">ประเภทนักศึกษา</label>'+
         '<?php Form::selectArr('id_type_student',$list_type_student,'select2','id_type_student','type_student_name',is($data,'id_type_student')); ?>'+
         '</div>'+
         '<div class="col-md-3">'+
         '<label for="">ชั้นปี</label>'+
         '<div class="form-group">'+
         '<div class="">'+
         '<input type="checkbox" class="" id="" name="chk['+row+'][1]" value="1"> 1 '+
         '<input type="checkbox" class="" id="" name="chk['+row+'][2]" value="1"> 2 '+
         '<input type="checkbox" class="" id="" name="chk['+row+'][3]" value="1"> 3 '+
         '<input type="checkbox" class="" id="" name="chk['+row+'][4]" value="1"> 4 '+
         '<input type="checkbox" class="" id="" name="chk['+row+'][5]" value="1"> 5 '+
         '</div>'+
         '</div>'+
         '</div>'+
         '<div class="col-md-1">'+
         '<label for="">ลบ</label><br>'+
         '<button type="button" class="btn btn-danger btn-delete" data-row="'+row+'"><i class="las la-trash-alt"></i></button>'+
         '</div>'+
         '</div>';
         $('.form-plus').append(html);
         row += 1;
         event.preventDefault();
      });
   });
</script>

