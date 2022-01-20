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
                            <h4 class="card-title">ตั้งค่า คณะ</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <a href="<?php echo route('setting/group_form'); ?>" class="btn btn-primary">เพิ่มคณะ</a>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ชื่อ</th>
                                    <th width="25%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $key => $value): ?>
                                <tr>
                                    <td><?php echo $value['group_name'];?></td>
                                    <td class="text-center">
                                        <a href="index.php?route=setting/branch&id_group=<?php echo $value['id_group'];?>" class="btn btn-primary">จัดการสาขา</a>
                                        <a href="index.php?route=setting/group_form&id=<?php echo $value['id_group'];?>" class="btn btn-primary">แก้ไข</a>
                                        <a href="index.php?route=setting/group_del&id=<?php echo $value['id_group'];?>" onclick="return confirm('ยืนยันการลบ?');" class="btn btn-primary">ลบ</a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
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
    $('#s6').addClass('active');
    $('.table').DataTable();
});
</script>