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
                            <h4 class="card-title">ตั้งค่าสาขา <?php echo isset($id_group)&&$id_group>0 ? 'ของ'.$group['group_name'] : '';?></h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <a href="<?php echo route('setting/branch_form&id_group='.$id_group); ?>" class="btn btn-primary">เพิ่มสาขา ของคณะ <?php echo $group['group_name'];?></a>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="mb-3">
                            <select name="" id="id_group" class="form-control">
                                <option value="">กรุณาเลือกคณะ</option>
                                <?php foreach ($groups as $key => $value) : ?>
                                <option value="<?php echo $value['id_group'];?>" <?php echo $value['id_group']==$id_group ? 'selected': '';?>><?php echo $value['id_group'].' '.$value['group_name'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>รหัส</th>
                                    <th>ชื่อ</th>
                                    <th width="25%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $key => $value): ?>
                                <tr>
                                    <td><?php echo $value['branch_code'];?></td>
                                    <td><?php echo $value['branch_name'];?></td>
                                    <td class="text-center">
                                        <a href="index.php?route=setting/branch_form&id_group=<?php echo $id_group;?>&id=<?php echo $value['id_branch'];?>" class="btn btn-primary">แก้ไข</a>
                                        <a href="index.php?route=setting/branch_del&id_group=<?php echo $id_group;?>&id=<?php echo $value['id_branch'];?>" onclick="return confirm('ยืนยันการลบ?');" class="btn btn-primary">ลบ</a>
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
    $('#s7').addClass('active');
    $('.table').DataTable();

    $('#id_group').change(function() {
        window.location.href = "index.php?route=setting/branch&id_group=" + $(this).val();
    });
});
</script>