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
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Import นักศึกษาที่ผ่านการเข้าร่วมกิจกรรม</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="">ชื่อกิจกรรม</label>
                                    <p><?php echo $data['event_name']; ?></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="">ไฟล์ Excel</label>
                                    <div class="form-group">
                                        <!-- <label for="exampleFormControlFile1">File Excel</label> -->
                                        <input type="file" class="form-control" name="file_name" id="file">
                                    </div>
                                    <br>
                                    <a href="upload_approve/1595578533_รวมข้อมูลกิจกรรมต้อนรับน้องใหม่ 2560.xlsx" target="new">ตัวอย่างไฟล์</a>
                                    <!-- <div class="custom-file"> 
                              <input type="file" class="custom-file-input" id="" name="file_name">
                              <label class="custom-file-label" for="">Choose file</label>
                           </div> -->
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
</script>