<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="assets/boostrap_jquery/css/bootstrap.min.css">
	<style type="text/css">
	    body {
	        width: 100%;
	        height: 100%;
	        margin: 0;
	        padding: 0;
	        background-color: #FAFAFA;
	        font: 12pt "Tahoma";
	    }
	    * {
	        box-sizing: border-box;
	        -moz-box-sizing: border-box;
	    }
	    .page {
	        width: 210mm;
	        min-height: 297mm;
	        padding: 10mm 20mm;
	        margin: 10mm auto;
	        border: 1px #D3D3D3 solid;
	        border-radius: 5px;
	        background: white;
	        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
	        position: relative;
	    }
	    .subpage {
	    	height: 100%;
	    }
	    @page {
	        size: A4;
	        margin: 0;
	    }
	    @media print {
	        html, body {
	            width: 210mm;
	            height: 297mm;        
	        }
	        .page {
	            margin: 0;
	            border: initial;
	            border-radius: initial;
	            width: initial;
	            min-height: initial;
	            box-shadow: initial;
	            background: initial;
	            page-break-after: always;
	        }
	    }
	</style>
</head>
<body>
    <div class="page">
        <div class="subpage">
        	<div class="float-right text-center" style="position: absolute; border: 1px solid #333; padding: 5px; right: 20mm;">
        		<p class="mb-0">ลำดับที่</p>
				<h4 class="mb-0"><?php echo $detail['take_event_no']; ?></h4>
        	</div>
        	<div class="row mb-3">
        		<div class="col-sm-12 text-center">
        			<img src="assets/images/logo.png" alt="" width="70" style="margin-bottom: 10px;">
        			<p>กองพัฒนานักศึกษา</p>
        			<p>มหาวิทยาลัยราชภัฏสวนสุนันทา</p>
        			<br>
        			<p><?php echo $detail['event_name']; ?></p>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-sm-3">
        			<p>รหัสนักศึกษา :</p>
        		</div>
        		<div class="col-sm-9">
        			<p><?php echo $stu_code; ?></p>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-sm-3">
        			<p>ชื่อ - นามสกุล :</p>
        		</div>
        		<div class="col-sm-9">
        			<p><?php echo $stu_prefix; ?> <?php echo $stu_name; ?></p>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-sm-3">
        			<p>โปรแกรม/สาขาวิชา :</p>
        		</div>
        		<div class="col-sm-9">
        			<p><?php echo $student_detail['branch_name']; ?></p>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-sm-3">
        			<p>คณะ/วิทยาลัย :</p>
        		</div>
        		<div class="col-sm-9">
        			<p><?php echo $student_detail['group_name']; ?></p>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-sm-3">
        			<p>ระดับการศึกษา :</p>
        		</div>
        		<div class="col-sm-9">
        			<p><?php echo $student_detail['level_name']; ?></p>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-sm-3">
        			<p>ศูนย์ให้การศึกษา :</p>
        		</div>
        		<div class="col-sm-9">
        			<p><?php echo $student_detail['center_name']; ?></p>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-sm-3">
        			<p>รายละเอียดการจอง :</p>
        		</div>
        		<div class="col-sm-9">
        			<p>
        				<?php echo $detail['event_name']; ?><br>
        				<?php echo $detail['event_detail']; ?><br>
        				ลำดับที่จอง : <?php echo $detail['take_event_no']; ?>
        			</p>
        		</div>
        	</div>

        	<div class="row mb-3">
        		<div class="col-sm-12 text-center">
        			<p>(วันที่พิมพ์ <?php echo date('d-m-Y H:i:s'); ?>)</p>
        		</div>
        		<div class="col-md-12">
        			<div class="card">
        				<div class="card-header bg-white">
    						<div class="row">
    							<div class="col-sm-2">
    								<img src="assets/images/logo.png" alt="" width="50">
    							</div>
    							<div class="col-md-10">
    								<p class="pt-2">
    									<?php echo $detail['event_name']; ?>
    								</p>
    							</div>
    						</div>
        				</div>
        				<div class="card-body">
        					<div class="row">
        						<div class="col-md-6">
        							<p class="mb-0">รหัสนักศึกษา <?php echo $stu_code; ?></p>
        							<p class="mb-0">สาขา <?php echo $student_detail['branch_name']; ?></p>
        							<p class="mb-0">คณะ <?php echo $student_detail['group_name']; ?></p>
        						</div>
        						<div class="col-md-6">
        							<p class="mb-0">วันนัด <?php echo date_f($detail['event_date_start'],'Y/m/d').(($detail['event_date_start']!=$detail['event_date_end'])?' - '.date_f($detail['event_date_end'],'Y/m/d'):''); ?></p>
        							<p class="mb-0">เวลา <?php echo date_f($detail['event_time_start'],'H:i').' - '.date_f($detail['event_time_end'],'H:i'); ?></p>
        						</div>
        					</div>
        				</div>
        				<div class="card-footer bg-white">
        					<div class="row">
        						<div class="col-md-12 text-center">
        							<p>
        								กองพัฒนานักศึกษา มหาวิทยาลัยราชภัฏสวนสุนันทา <br>
        								โทรศัพท์ 02-1601352-7 โทรสาร 02-1601353
        							</p>
        						</div>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        	<div class="row">
    			<div class="col-sm-9">
                    <?php echo $barcode; ?>
                    
    				<!-- <div class="card rounded-0">
    					<div class="card-body">
    						<div class="row">
    							<div class="col-sm-12 text-center">
    								<p class="mb-0"></p>
    							</div>
    						</div>
    					</div>
    				</div> -->
    			</div>
    			<div class="col-sm-3 text-right">
    				<!-- <img src="assets/images/barcode.jpg" alt="" class="w-100"> -->
                    <img src="qrcode/<?php echo $id_take_event;?>.png" alt="" class="w-100">
    			</div>
    		</div>
        </div>    
    </div>
</body>
</html>