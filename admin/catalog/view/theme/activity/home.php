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
                            <h4 class="card-title">กิจกรรม</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <a href="<?php echo route('activity/form'); ?>" class="btn btn-primary">เพิ่มกิจกรรม</a>&nbsp;
                            <!-- <a href="<?php echo route('activity/removeImport'); ?>" class="btn btn-danger">ลบกิจกรรมที่ Import</a> -->
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered" id="datatables">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" width="50px">No</th>
                                        <th scope="col">กิจกรรม</th>
                                        <th scope="col" class="text-center" width="50%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;foreach($list_event as $val){ ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td><?php echo $val['event_name']; ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-primary" href="<?php echo route('activity/import&id_event='.$val['id_event']); ?>">Import น.ศ. เข้ากิจกรรม</a>
                                            <a class="btn btn-primary" href="<?php echo route('activity/viewActivity&id_event='.$val['id_event']); ?>">ดูคนจอง</a>
                                            <a class="btn btn-primary" href="<?php echo route('activity/form&id_event='.$val['id_event']); ?>">แก้ไข</a>
                                            <a class="btn btn-danger" onclick="return confirm('ยืนยันการลบ');" href="<?php echo route('activity/delete&id_event='.$val['id_event']); ?>">ลบ</a>
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
    $('#a1').addClass('active');
});
$('#datatables').DataTable();
</script>