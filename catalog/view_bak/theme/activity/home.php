<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="card rounded-0 mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p><b>ข้อมูลนักศึกษา</b></p>
                        </div>
                        <div class="col-md-12">
                            <p><b>รหัส</b> <?php echo $stu_code; ?></p>
                            <p><b>ชื่อ</b> <?php echo $stu_prefix; ?> <?php echo $stu_name; ?></p>
                            <p><b>นามสกุล</b> <?php echo $stu_lname; ?></p>
                            <p><b>คณะ</b> <?php echo $stu_detail['group_name']; ?></p>
                            <p><b>สาขา</b> <?php echo $stu_detail['branch_name']; ?></p>
                            <p><b>วุฒิการศึกษา</b> <?php echo $stu_detail['level_name']; ?></p>
                            <p><b>คะแนนพฤติกรรม</b> (<?php echo $stu_point_behavior; ?>)</p>
                            <p><b>หน่วยกิจกรรมสะสม</b> (<?php echo $stu_point_event; ?>/<?php echo $maxevent;?>)</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="<?php echo route('member/edit'); ?>" class="btn btn-outline-dark mb-3 w-100 rounded-0">แก้ไขข้อมูลส่วนตัว</a>
                        </div>
                        <div class="col-md-12">
                            <a href="<?php echo route('booking/booking'); ?>" class="btn btn-outline-dark mb-3 w-100 rounded-0">ตรวจสอบกิจกรรมที่ได้เข้าร่วม</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8">
            <div class="card rounded-0 mb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>ตรวจสอบกิจกรรม</h5>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <nav>
                                <div class="nav nav-tabs justify-content-end" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">กิจกรรมที่เข้าร่วม</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">สรุปรวมหน่วยกิจกรรมนักศึกษา</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade pt-5 show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>กิจกรรมที่เข้าร่วม</h5>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>ลำดับx</th>
                                                            <th>กิจกรรม</th>
                                                            <th>วันจัดกิจกรรม</th>
                                                            <th>หน่วยกิจกรรม</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $sum_unit = 0; $i=1;foreach($list_event_approve as $val){ 
                                                            $sum_unit += $val['event_unit'];
                                                            ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $val['event_name']; ?></td>
                                                            <td><?php echo date_f($val['event_date_start'],'Y-m-d'); ?></td>
                                                            <td><?php echo $val['event_unit'];//$sum_unit+=(float)$val['event_unit']; ?></td>
                                                        </tr>
                                                        <?php $i++;} ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="4" class="text-center">
                                                                <!-- รวมกิจกรรมบังคับ 0 ชั่วโมง รวมกิจกรรมเลือก 0 ชั่วโมง รวมกิจกรรมที่เข้าร่วมทั้งสิ้น 0 ชั่วโมง -->
                                                            </th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade pt-5" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>สรุปรวมหน่วยกิจกรรมนักศึกษา</h5>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th rowspan="2" class="align-middle text-center">ชั้นปีที่</th>
                                                            <th rowspan="2" class="align-middle text-center">ประเภทกิจกรรม</th>
                                                            <th colspan="2" class="text-center">สรุปสถานะกิจกรรม</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">กิจกรรมรวม</th>
                                                            <th class="text-center">สถานะกิจกรรม</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $sum_unit = 0;$sum_hour = 0; $i=1;
														foreach($sum_event_aprrove as $val2){ 
															$sum_unit += $val2['event_unit']; 
                                                            $sum_hour += $val2['event_hour']; 
                                                        ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $i; ?></td>
                                                            <td class="text-center"><?php echo $val2['event_type_name']; ?></td>
                                                            <td class="text-center"><?php echo $val2['event_unit']; ?></td>
                                                            <!-- <td class="text-center">ผ่าน</td> -->
                                                            <td class="text-center">
                                                            <?php if ($val2['event_unit']>=$maxhour) : ?>
                                                                <span class="text-success">ผ่าน</span>
                                                            <?php else: ?> 
                                                                <span class="text-danger">ไม่ผ่าน</span>
                                                            <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                        <?php $i++;} ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="2" class="text-right"><b>จำนวนทั้งหมด</b></td>
                                                            <td class="text-center"><b><?php echo number_format($sum_unit,2); ?> / <?php echo number_format($maxevent,2); ?></b></td>
                                                            <!-- <td>จำนวนรวมชั่วโมง</td> -->
                                                            <!-- <td class="text-center"><?php echo $sum_hour; ?></td> -->
                                                            <td class="text-center">
                                                                <?php if ($sum_unit>=$maxevent) { ?>
                                                                <b class="text-success">ผ่าน</b>
                                                                <?php } else { ?>
                                                                <b class="text-danger">ไม่ผ่าน</b>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#activity').addClass('active');
});
</script>