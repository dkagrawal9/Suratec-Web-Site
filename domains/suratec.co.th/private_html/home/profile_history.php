<?php 
  require_once '../admin/library/connect.php';
  require_once '../admin/library/functions.php';
  checkMemUser($objConnect);
?>
<?php include 'header.php'
?>
<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

$id = $_SESSION['id_customer'];

?>

<?php include_once 'common.php'; ?>
<link rel="stylesheet" href="../admin/plugins/sweetalert2/dist/sweetalert2.min.css">
<script src="../admin/plugins/sweetalert2/dist/sweetalert2.min.js"></script>

<!-- datatables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.css"/>
<!-- datepicker -->
<link rel="stylesheet" href="../bootstrap-datepicker-custom/css/bootstrap-datepicker.min.css">
<style>
	.swal2-popup{
		font-size: 1rem;
	}	
	.slip {cursor: pointer;}
</style>
			<!-- Breadcrumbs -->
			<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?=$pic_header['value']?>)">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Bread Title -->
							<div class="bread-title">
								<h2><?php echo $lang['MENU_Order_history']?><!--Profile--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME']?><!--Home--></a></li>
								<li class="active"><a href="profile_history.php?profile=st"><i class="fa fa-clone"></i><?php echo $lang['MENU_Order_history']?><!--Profile--></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Breadcrumbs -->
<style>
	.pagination li a {
	top: 0px;
	right: -5px;	
	background: #f6f6f6;
	display: inline;
	width: 40px;
	height: 40px;
	line-height: 20px;
	font-size: 14px;
	color: #282828;
	text-align:center;
	border: 1px solid #e6e6e6;
	font-weight: 400;
	border-radius: 0%;
	border: avajowhite;
}
</style>
			<!-- Contact Us -->
			<section id="contact-us" class="contact-us section">
				<div class="container">
					<div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
				<div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
<!--							<th >ลำดับ</th>-->
                            <th >วันที่ทำรายการ</th>
                            <th >จำนวนเงิน</th>
                            <th >รหัสรายการ</th>
                            <th >รายละเอียด</th>
							<th >สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                </table>
				</div>
            </div>
            <div class="col-md-1"></div>
        </div>
				</div>		
			</section>
			<!--/ End Contact Us -->
			
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			<?php include 'footer_credit.php'?>	
		</div>
    </body>
</html>

<script src="../bootstrap-datepicker-custom/js/bootstrap-datepicker-custom.js"></script>
	<!-- datatables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.js"></script>

<script>
    var swal_success = '<?=lang('สำเร็จ', 'Successfully')?>';
    var swal_title_del = '<?=lang('ลบข้อมูล', 'Delete data')?>';
    var swal_text_del = '<?=lang('ใช่ หรือ ไม่?', 'Yes or No?')?>';
    var swal_cancel_del = '<?=lang('ยกเลิก', 'Cancel')?>';
    var swal_confirm_del = '<?=lang('ยืนยัน', 'Confirm')?>';
    var table;
    var items = [];

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'th',
        // thaiyear: true,
        autoclose: true
    });
        
</script>
<script type="text/javascript">
        $(document).ready(function(){
            
            var table = $('#myTable').DataTable( {
                "ajax": 'select-payment.php',
                "iDisplayLength" : 10,
                "columns": [
//					{
//						data: "id",
//						render: (data, type, row, meta) => {
//						return meta.row + 1;
//						}
//            		},
                    { "data": "order_datetime"},
                    { "data": "priceall" },
                    { "data": "id_order" },
					{ "data": "text_address"},
					{ "data": function (data, type, dataToSet) {
                        if(data.status == 'complete spending'){
                            return "<small class='label' style='font-size:15px; background-color: orange; color: white; padding: 5px; border-radius: 10px;'><?//=lang('ยังไม่ได้อ่าน','Have not read')?>รอการยืนยัน</small> ";
                        }else if (data.status == 'Wait shipping'){
                            return "<small class='label' style='font-size:15px; background-color: green; color: white; padding: 5px; border-radius: 10px;'><?//=lang('อ่านแล้ว','Read')?>รอจัดส่ง</small> <small data-id='"+data.id_order+"' class='label slip' style='font-size:15px; background-color: #33CCFF; color: white; padding: 5px; border-radius: 10px;'>ใบเสร็จ</small>";
                        }
						else{
							return "<small class='label' style='font-size:15px; background-color: red; color: white; padding: 5px; border-radius: 10px;'><?//=lang('อ่านแล้ว','Read')?>รอการชำระ</small>  ";
						}
                    } 
					}

                ],
				order: [[ 0, "desc" ]],
                language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Thai.json'
            	}

            });
//				$(document).on('click', '.write', function(event) {
//
//				var record = table.row($(this).parents('tr')).data();
//				// console.log(record);
//				window.open(`export_pdf.php?id=${record.rid}`, '_bank');	
//            });

			$(document).on('click', '.slip', function(event) {

				var record = $(this).attr("data-id");
				// console.log(record);
				window.open(`export_pdf.php?id=`+record, '_bank');	
           });
        });
    </script>
