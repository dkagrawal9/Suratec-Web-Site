
<div class="col-lg-12 col-md-12 col-sm-12">
    <br>
</div>
<div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="box box-success box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">เพิ่มที่อยู่ใหม่</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <form id="frmData">
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อ</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="fname">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">นามสกุล</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="lname">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ที่อยู่</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="address">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ตำบล</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control " id="district" name="district" placeholder="ตำบล">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">อำเภอ</label>

                                                <div class="col-sm-8">
                                                   <input type="text" class="form-control " id="amphor" name="amphur" placeholder="อำเภอ">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">จังหวัด</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control " id="province" name="province" placeholder="จังหวัด">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">รหัสไปรษณีย์</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control " id="zipcode" name="postalcode" placeholder="รหัสไปรษณีย์">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">เบอร์โทร</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"  name="telephone" id="telephone">
                                                </div>
                                            </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
        <div class = "modal-footer">
            <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               ยกเลิก
            </button>
            <div class="text-center">
                            <button type="button" class="btn btn-sm btn-info" onclick="fnc_send()">
                                <i class="fa fa-plus"></i>&nbsp;เพิ่มรายการ
                            </button>
            </div>
         </div>


         <script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- date-range-picker -->
<script src="../bower_components/moment/min/moment-with-locales.min.js"></script>
<!-- thailand -->
<script src="js/jquery.Thailand.min.js"></script>
<script src="js/JQL.min.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script src="js/zip.js"></script>
<!-- PACE -->
<script src="../bower_components/PACE/pace.min.js"></script>
<script src="js/timer.js"></script>

<link rel="stylesheet" href="css/ui-bootstrap-csp.css">
<!-- <script src="js/sweetalert2.all.min.js"></script> -->
<script src="js/up_pre.js"></script>

<script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
        $.Thailand({
            $district: $('#district'), // input ของตำบล
            $amphoe: $('#amphor'), // input ของอำเภอ
            $province: $('#province'), // input ของจังหวัด
            $zipcode: $('#zipcode'), // input ของรหัสไปรษณีย์
        });
})

function fnc_send() {
            // console.log($("#product_id").find(":selected").text());
            if (!validate_fromdata("frmData")) {
                var data = {
                    data_id: id++,
                    fname: $('#fname').val(),
                    lname: $('#lname').val(),
                    address: $('#address').val(),
                    district: $('#district').val(),
                    amphur: $('#amphur').val(),
                    province: $('#province').val(),
                    amphur: $('#zipcode').val(),
                    province: $('#telephone').val(),
                    // expire_date: $('#expire_date').val()
                } ;// create array
                // console.log("create array", data);

                items.push(data); // push array 
                // console.log("push array", items);

                inputClear();
                reload_datatable()
                // document.getElementById('numsum').value=data.total_price;
                // //var sum = (data.sum_total_price+data.total_price)
                //  result = parseInt(data.total_price);
                //  result1 = parseInt(data.sum_total_cost);

                //  // result2 = parseInt(data.sum_total_cost);
                // var sum = result1+result;
                // document.getElementById('total_cost').value=sum;
                //  result = parseInt(data.sum_total_price);
                //  result1 = parseInt(data.total_price);
                // var sum = result+result1;
            }
        }
</script>
