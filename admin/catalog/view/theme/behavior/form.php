<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <?php if(!empty($result)){ ?>
      <div class="row">
         <div class="col-md-12">
            <p class="alert alert-success">บันทึกเรียบร้อย</p>
         </div>
      </div>
      <?php } ?>
      <div class="row">
         <div class="col-sm-12">
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
                        <div class="col-md-4">
                           <label for="">รหัสนักศึกษา</label>
                           <?php Form::text('stu_code','รหัสนักศึกษา',is($data,'stu_code')); ?>
                        </div>
                        <div class="col-md-4">
                           <label for="">พฤติกรรม</label>
                           <select name="id_behavior_type" id="" class="select2 form-control">
                           <?php foreach($listBehavior['data'] as $val): ?>
                           <option value="<?php echo $val['id_behavior_type'];?>"><?php echo $val['behavior_type_name']; ?></option>
                           <?php endforeach ?>
                           </select>
                        </div>
                        <div class="col-md-4">
                           <label for="">คะแนน</label>
                           <?php Form::number('behavior_point','คะแนน',is($data,'behavior_point')); ?>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <label for="">หมายเหตุ</label>
                           <?php Form::text('behavior_comment','หมายเหตุ',is($data,'behavior_comment')); ?>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <a href="<?php echo route('behavior/home'); ?>" class="btn btn-outline-dark">ยกเลิก</a>
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
   
</script>

