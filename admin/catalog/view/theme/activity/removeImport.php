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
                                <h4 class="card-title">ลบไฟล์ Import ล่าสุด</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">เลือกช่วงเวลาไฟล์ที่อัพโหลด</label>
                                    <div class="form-group">
                                        <select name="removefile" id="" class="form-control">
                                            <?php foreach ($files as $key => $value) { ?>
                                            <option value="<?php echo $value['id_event_file'];?>"><?php echo date('d/m/Y H:i:s', strtotime($value['date_create'])).' : '.$value['file_name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-danger">กรุณาอ่าน!! : การลบไฟล์ที่ Import มีผลทำให้ <u><b>รายชื่อนศ.ที่อยู่ในกิจกรรม จะถูกปัดสถานะกิจกรรมเป็น ยกเลิก ทั้งหมด</b></u></p>
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('การลบไฟล์มีผลกระทบ ต่อ กิจกรรมที่นศ.ได้รับ ยืนยันการลบใช่ไหม?');">ลบ</button>
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