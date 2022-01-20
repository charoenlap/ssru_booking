<!-- Page Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">อัพโหลดไพล์</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="route" value="<?php echo $route;?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <!-- <div class="custom-file">  -->
                                        <input type="file" class="" id="" name="file_name">
                                        <!-- <label class="custom-file-label" for="">Choose file</label> -->
                                        <!-- </div> -->
                                        <br>
                                        <a href="upload_approve/1595578533_รวมข้อมูลกิจกรรมต้อนรับน้องใหม่ 2560.xlsx" target="new">ตัวอย่างไฟล์</a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">อัพโหลด .xlsx, .xls</button>
                                </div>
                            </div>
                            <?php if($result=='success'){?>
                            <p class="alert alert-success">อัพโหลดเรียบร้อย พร้อมอัพเดทกิจกรรมที่อัพโหลดของนักศึกษา</p>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">ไพล์อัพโหลด</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered" id="datatables">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" width="10%">ลำดับ</th>
                                        <th scope="col">ไพล์</th>
                                        <th>วันที่</th>
                                        <th scope="col" class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;foreach($list_upload as $val){ ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i;
                               ?></td>
                                        <td><?php echo $val['file_name']; ?></td>
                                        <td><?php echo $val['date_create']; ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-info" href="upload_approve/<?php echo $val['file_name']; ?>" target="_blank">ดาวน์โหลดไฟล์</a>

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
    $('#activity').addClass('menu-open');
    $('#activity').find('.iq-submenu').addClass('menu-open');
    $('#a2').addClass('active');
});
$('#datatables').DataTable();
</script>