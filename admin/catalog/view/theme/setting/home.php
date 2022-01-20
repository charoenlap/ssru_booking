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
                            <h4 class="card-title">ตั้งค่าทั่วไป</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form action="<?php echo $action; ?>" method="post">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label"><b>จำนวนชั่วโมงรวม</b> ที่ผ่านกิจกรรม</label>
                                <div class="col-sm-10">
                                    <?php Form::number('setting_allpassevent', 'จำนวนชั่วโมงรวม ที่ผ่านกิจกรรม', is($data,'setting_allpassevent')); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label"><b>จำนวนชั่วโมง</b> ที่ผ่านแต่ละกิจกรรม</label>
                                <div class="col-sm-10">
                                    <?php Form::number('setting_passevent', 'จำนวนชั่วโมง ที่ผ่านแต่ละกิจกรรม', is($data,'setting_passevent')); ?>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">จำนวนเต็มหน่วย กิตกิจกรรมสะสม</label>
                                <div class="col-sm-10">
                                    <?php Form::number('setting_maxevent', 'จำนวนเต็มหน่วยกิจกรรมสะสม', is($data,'setting_maxevent')); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-success" type="submit">บันทึก</button>
                                </div>
                            </div>
                        </form>
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
    $('#s0').addClass('active');
    $('.table').DataTable();
});
</script>