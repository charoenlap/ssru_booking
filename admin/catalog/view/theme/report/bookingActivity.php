<!-- Page Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">สรุปผลการเข้าร่วมกิจกรรม</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <?php if (count($result)>0) { ?>
                            <a href="<?php echo route('report/export'.'&type=2&stu_year='.$stu_year.'&id_group='.$id_group.'&branch_code='.$branch_code);?>" class="btn btn-primary">Export Excel</a>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form action="<?php echo $action;?>" method="POST" class="mb-4">
                            <div class="row">
                                <div class="col">
                                    <label for="">ปีการศึกษา (ปป)</label>
                                    <input type="text" class="form-control" name="stu_year" placeholder="สองหลัก เช่น 62" value="<?php echo $stu_year;?>">
                                </div>
                                <div class="col">
                                    <label for="">คณะ</label>
                                    <?php Form::select('id_group',$list_group,'','id_group','group_name',is($data,'id_group')); ?>
                                </div>
                                <div class="col">
                                    <label for="">สาขา</label>
                                    <!-- <?php Form::select('branch_code',$list_branch,'','branch_code','branch_name',is($data,'branch_code')) ?> -->
                                    <div id="htmlbranch"></div>
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
                                        <th>ลำดับ</th>
                                        <th>รหัสนักศึกษา</th>
                                        <th>ชื่อ - นามสกุล</th>
                                        <th>คณะ</th>
                                        <th>สาขาวิชา</th>
                                        <th>สรุปผลเข้าร่วมกิจกรรม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result as $key => $value): ?>
                                    <tr>
                                        <td><?php echo ++$key; ?></td>
                                        <td><?php echo $value['stu_code']; ?></td>
                                        <td><?php echo $value['stu_prefix'].' '.$value['stu_name'].' '.$value['stu_lname']; ?></td>
                                        <td><?php echo $value['group_name']; ?></td>
                                        <td><?php echo $value['branch_name']; ?></td>
                                        <th class="text-center">
                                            <?php echo $value['result']; ?>
                                        </th>
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
</div>


<script>
$(document).ready(function() {
    $('#report').addClass('menu-open');
    $('#report').find('.iq-submenu').addClass('menu-open');
    $('#r2').addClass('active'); 
    <?php
    if (!empty($id_group)) {
    ?>
        getBranch( <?php echo $id_group; ?> , <?php echo isset($branch_code) && !empty($branch_code) ? $branch_code : ''; ?> ); 
    <?php
    } else {
    ?>
        getBranch($('[name="id_group"] > option:first-child').attr('value')); 
    <?php
    } 
    ?>
    $('[name="id_group"]').change(function(event) {
        $('#htmlbranch').html('<select class="form-control" disabled="disabled"><option>กำลังโหลด</option></select>');
        getBranch($(this).val());
    });

    function getBranch(value, selected = '') {
        $.post('<?php echo MURL.'admin/'.route('report/getBranchByGroupId ');?>', {id_group: value,default: selected}, function(data, textStatus, xhr) {
            $('#htmlbranch').html(data);
        });
    }
});
$('#datatables').DataTable();
</script>