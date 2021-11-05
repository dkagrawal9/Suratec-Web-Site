<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);

$title = 'แก้ไขคูปอง';
?>
<style type="text/css">
   .select2-container--default .select2-selection--multiple .select2-selection__choice {

    background-color: #00c0ef !important;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px;
}
</style>

            <div class="row">
  


  <?php
           $sql_coupon = "SELECT coupon.customer, coupon.code,coupon.coupon_id,coupon.name,coupon.discount,coupon.quantity,coupon.start_date,coupon.end_date FROM `coupon` WHERE `delete_datetime` is null AND coupon_id = '".$_GET["id"]."'";
 $query_coupon = mysqli_query($objConnect, $sql_coupon);
$result_coupon = mysqli_fetch_array($query_coupon);

 ?>        
 
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="box box-warning box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">ข้อมูลคูปอง</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
<form class="frm_edit"  method="post" enctype="multipart/form-data" id="frm_edit">

                                           <input type="hidden" name="_method" value="edit"> 
                                            <input type="hidden" name="id" id="id" value="<?php echo $_GET["id"] ?>">
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อคูปอง</label>

                                                <div class="col-sm-8">
                                                    <input type="text" name="coubon_name_edit" class="form-control" id="coubon_name_edit" autocomplete="off"  value="<?php echo $result_coupon["name"] ?>">
                                         
                                                   
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">Coubon Code</label>

                                                <div class="col-sm-8">
                                                    <input type="text" name="coubon_code_edit" class="form-control" id="coubon_code_edit" autocomplete="off"  value="<?php echo $result_coupon["code"] ?>">
                                         
                                                   
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ส่วนลด (%)</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="discount_edit" id="discount_edit" value="<?php echo $result_coupon["discount"] ?>" onkeypress="return check_tel(event)">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">จำนวนคูปอง</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"  name="num_coubon_edit" id="num_coubon_edit" value="<?php echo $result_coupon["quantity"] ?>" onkeypress="return check_tel(event)">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">วันที่เริ่มต้น - วันที่สิ้นสุด</label>
                                                <input type="hidden" class="form-control"  name="s_date" id="s_date" value="<?php echo $result_coupon["start_date"] ?>">
                                                <input type="hidden" class="form-control"  name="e_date" id="e_date" value="<?php echo $result_coupon["end_date"] ?>">
                                                <div class="col-sm-8">
                                                    <div class='input-group date col-md-12' >
                                                        <input type='text' class="form-control" name="datetimepicker_edit" id='datetimepicker_edit'  />
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                    </div>
                                                 </div>
                                                
                                            </div>
                                            
                                             
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">รายการอีเมลล์</label>

                                                <div class="col-sm-8">
                                                   <?php 
// $objResult_provinces = substr($result_ream["team_provinces"], 0, -1);
 
//  $b = explode(",", $objResult_provinces);


   ?>              
                                        <!-- <select name="provinces" id="provinces" class="form-control">
                             
                                        </select> -->
<?php
$rest = array();
 $id_customer = $result_coupon["customer"];
  $id_customer = substr($id_customer, 0, -1);
 // echo $rest1;
 $rest1 = explode(",", $id_customer);
 for ($i=0; $i < count($rest1) ; $i++) { 
   if (!empty($rest1[$i])) {
   array_push($rest,$rest1[$i]);
 }else{
 
 }
 }


//  $sql1 = "SELECT member.id,member.email FROM `member` 
// LEFT JOIN coupon_detail ON member.id = coupon_detail.member_id
// WHERE coupon_detail.deleted_time IS null AND coupon_detail.coupon_id = '".$result_coupon["coupon_id"]."'";
//     $query1 = mysqli_query($objConnect,$sql1);
//      $nrow = mysqli_num_rows($query1);  
//    while ($result1 = mysqli_fetch_array($query1)) {
//       array_push($array_id,$result1["id"]);  

//     } 
    ?>
                                         <select class="form-control email_edit" multiple  name="email_edit[]" id="email_edit" style="width: 250px">
                                    <?php

                        
$sql = "SELECT mod_customer.id_customer,mod_customer.email FROM `mod_customer` WHERE `delete_datetime` IS null";
    $query = mysqli_query($objConnect,$sql);
   
  
 
 

 // $objResult_provinces = substr($result1["id"], 0, -1);
 
 // $b = explode(",", $array_id);

  while ($result = mysqli_fetch_array($query)) { 
?>


      
        <!--  <option value="<?php echo $result['id'] ?> " ><?php echo $result['name_th'] ?> <?php echo $id_provinces ?></option>  -->
         <option  value="<?php echo $result['id_customer'] ?>" 
          <?php   
          for($i = 0 ; $i < count($rest) ; $i++){
            $output ='';
            
             $ss=$rest[$i];
              if($result['id_customer'] == $ss){
                 $output.=' selected ';
              }else{
                 $output .='';
              }
               echo $output = $output;
            }
             ?> 
            
           ><?php echo $result['email'];  ?></option>
          
            
                               
 <?php   } 
?>
                                                    </select>
                                                                                                    </div>
                                            </div>
                                            
                                        
                                           
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
        
            
   <div class = "modal-footer">
        <button type="button" class="btn btn-success pull-right btnSendedit" id="btnSendedit" style="transition: 0.4s; margin-left: 5px;"> <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;บันทึก</button>
        <button type="button" class="btn btn-default pull-right btnSendClear" style="border:1px ; margin-left: 5px;" onclick="javascript:window.location.href = 'front-manage.php'; ">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;ยกเลิก
        </button>
    </div>
                    
                </div>
               

<!-- end form -->

<!-- end form -->
 
  

<script type="text/javascript">
    $('#email_edit').select2();
</script>
<script>
               function check_id(){
      var coubon_code = $('#coubon_code').val();
      var id = $('#id').val();
      $.ajax({
        url: "functions.php",
        type:"POST",
        data:{data:coubon_code,data_id:id,_method:"check_edit"},
        success:function(data){
          console.log(data);
          if(data.status==1) {
            alert("Coubon Code ซ้ำและยังไม่หมดอายุการใช้งาน  กรุณากรอกใหม่");
            document.getElementById('coubon_code').value=coubon_code;
            document.getElementById("coubon_code").focus();

          }          
          else{
           
          } 
        }
      })
}
        $(function () {
            $('#search').on('click',function () {
                var drp = $('#datetimepicker_edit').data('daterangepicker');

                openWindowWithPost('download-report.php',$('#datetimepicker_edit').val());
            });

            function openWindowWithPost(url, date) {



                var form = document.createElement("form");
                form.target = "_blank";
                form.method = "POST";
                form.action = url;
                form.style.display = "none";

                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "date";
                input.value = date;
                form.appendChild(input);




                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);
            }
               var s_date = $('#s_date').val();
               var e_date = $('#e_date').val();
              
               s_date1  = s_date.split(' ');
               e_date1  = e_date.split(' ');
               s_date2  = s_date1[0];
               e_date2  = e_date1[0];
              

           
            moment.locale('th');
            $('#datetimepicker_edit').daterangepicker({
                "locale": {
                    "format": "YYYY/MM/DD"
                },
                alwaysShowCalendars: true,
                startDate: s_date2,
                endDate: e_date2,
                autoApply : true,
                ranges: {   
                    'วันที่กำหนดครั้งก่อน': [s_date2, e_date2],
                    'วันนี้': [moment(), moment()],
                    'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'พรุ่งนี้': [moment().add(1, 'days'), moment().add(1, 'days')],
                    '7 วันก่อน': [moment().subtract(6, 'days'), moment()],
                    '7 วันถัดไป': [moment().add(6, 'days'), moment().add(6, 'days')],
                    '30 วันก่อน': [moment().subtract(29, 'days'), moment()],
                    '30 วันถัดไป': [moment().add(29, 'days'), moment().add(29, 'days')],
                    'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
                    'เดือนที่ผ่านมา': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'เดือนถัดไป': [ moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
                }
            });
              
        });
    </script>
<script type="text/javascript">
 $('#table_team_edit').DataTable();
     $(function(){
       // เมื่อเปลี่ยนค่าของ select id เท่ากับ list1
     $("select#geographies").change(function(){  
         // ส่งค่า ตัวแปร list1 มีค่าเท่ากับค่าที่เลือก ส่งแบบ get ไปที่ไฟล์ data_for_list2.php
         $.get("functions.php?_method=geographies",{
             geographies:$(this).val()
         },function(data){ // คืนค่ากลับมา
            //alert(data);
                $("select#aria_geo").html(data);  // นำค่าที่ได้ไปใส่ใน select id เท่ากับ list2      
                $("select#aria_geo").trigger("change"); // อัพเดท list2 เพื่อให้ list2 ทำงานสำหรับรีเซ็ตค่า
         });
    });
// เมื่อเปลี่ยนค่าของ select id เท่ากับ list1
     $("select#aria_geo").change(function(){  
         // ส่งค่า ตัวแปร list1 มีค่าเท่ากับค่าที่เลือก ส่งแบบ get ไปที่ไฟล์ data_for_list2.php
         $.get("test1.php?_method=aria_geo",{
             aria_geo:$(this).val()
         },function(data){ // คืนค่ากลับมา
           // alert(data);
                $("select#provinces_edit").html(data);  // นำค่าที่ได้ไปใส่ใน select id เท่ากับ list2      
                $("select#provinces_edit").trigger("change"); // อัพเดท list2 เพื่อให้ list2 ทำงานสำหรับรีเซ็ตค่า
         });
    });
    // เมื่อเปลี่ยนค่าของ select id เท่ากับ list1
     $("select#head_team").change(function(){ 
        id_get = $('#id_get').val(); 
         // ส่งค่า ตัวแปร list1 มีค่าเท่ากับค่าที่เลือก ส่งแบบ get ไปที่ไฟล์ data_for_list2.php
         $.get("functions.php?_method=head_team&id_get="+id_get,{
             head_team:$(this).val(),
         },function(data){ // คืนค่ากลับมา
            //alert(data);
                $("select#em_team").html(data);  // นำค่าที่ได้ไปใส่ใน select id เท่ากับ list2      
                $("select#em_team").trigger("change"); // อัพเดท list2 เพื่อให้ list2 ทำงานสำหรับรีเซ็ตค่า
         });
    });

     

      $("select#em_team").change(function(){  
            // 
         
 
         // ส่งค่า ตัวแปร list1 มีค่าเท่ากับค่าที่เลือก ส่งแบบ get ไปที่ไฟล์ data_for_list2.php
         $.get("functions.php?_method=em_team",{
             em_team:$(this).val()
         },function(data){ // คืนค่ากลับมา
           // alert(data.name);
    
               document.getElementById('id_employee').value=data.id_employee;
               document.getElementById('name_em').value=data.name;
         });
       
    });

 });
  $("#modal_showdetail").on('hidden.bs.modal', function () {
    $(this).data('bs.modal', null);
  });
  $("#modal_showdetail").on('hidden.bs.modal', function () {
    $(this).data('bs.modal', null);
  });
</script>
<script type="text/javascript">
function check_tel(ele)
  {
  var vchar = String.fromCharCode(event.keyCode);
  if ((vchar<'0' || vchar>'9') ) return false;
  ele.onKeyPress=vchar;
  }
  function check_pass() {
    
  var username = document.getElementById("username");
  var x = document.getElementById("password");
  var x1 = document.getElementById("password1");
  if (x.value == x1.value ){
   username.value = username.value.toLowerCase();
   
  }else{
    alert("รหัสผ่านไม่ตรงกัน");
    username.value = username.value.toLowerCase();
    document.getElementById('password').value="";
    document.getElementById('password1').value="";
   
  }
 
}
// function check_pass()
//   {
//   password = $('#password').val();
//   password1 = $('#password1').val();
  
  

//   //$('#password1').val("รหัสผ่านไม่ตรงกัน");
//   }

function edit_row(r){
 var i = r.parentNode.parentNode.rowIndex;
 // count_rows = table.getElementsByTagName("tr").length;
  //fname_add_edit = tbody.getElementById("fname_add"+[i]).value();

    id_employee = $('#id_employee'+i).val();
    name_em = $('#name_em'+i).val();
  
    //tp = $('#tp'+i).val();

 $('#id_employee_edit').val(id_employee);
 $('#name_em_edit').val(name_em);
 $('#address_edit').val(address);
 $('#district_edit').val(district);
 $('#amphor_edit').val(amphor);
 $('#province_edit').val(province);
 $('#zipcode_edit').val(zipcode);
 $('#tp_edit').val(tp);
 $('#index_i').val(i);
            // show modal
 $('#myModal').modal('show')

        };

function del_row(r){
  var data = {
  sum_total_price: $('#numsum').val(),
    sum_total_cost: $('#total_cost').val(),
  } ;
     var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("myTable").deleteRow(i);

                 result1 = parseInt(data.sum_total_cost);

                document.getElementById('total_cost').value=result1-1;
}

function change_data() {

    var table = document.getElementById("myTable");
    fname_add = $('#fname_add_edit').val();
    lname_add = $('#lname_add_edit').val();
    address = $('#address_edit').val();
    district = $('#district_edit').val();
    amphor = $('#amphur_edit').val();
    province = $('#province_edit').val();
    zipcode = $('#zipcode_edit').val();
    tp = $('#tp_edit').val();
    index_i = $('#index_i').val();


 var data = {
  sum_total_cost: $('#total_cost').val(),
  } ;
                

    
    // if(fname_add == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่ชื่อ", "warning")
    //     return false;
    //   }
    //   if(lname_add == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่นามสกุล", "warning")
    //     return false;
    //   }
    // if(address == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่ที่อยู่", "warning")
    //     return false;
    //   }
    // if(district == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่ตำบล", "warning")
    //     return false;
    //   }
    // if(amphor == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่อำเภอ", "warning")
    //     return false;
    //   }
    // if(province == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่จังหวัด", "warning")
    //     return false;
    //   }
    // if(zipcode == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่รหัสไปรษณีย์", "warning")
    //     return false;
    //   }
    // if(tp == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่เบอร์โทร", "warning")
    //     return false;
    //   }

 document.getElementById("myTable").deleteRow(index_i);
    count_rows = table.getElementsByTagName("tr").length;

    var row = table.insertRow(count_rows);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
 
 
    cell1.innerHTML = fname_add+' '+lname_add;
    cell2.innerHTML = address+' '+district;
    cell3.innerHTML = amphor+' '+province+' '+zipcode;
    cell4.innerHTML = tp
    
    cell5.innerHTML = "<button style='background-color: white;' type='button' class='edit-catagory btn btn-default' onclick='del_row(this)'> <i class='fa fa-fw fa-trash'></i></button> <button style='background-color: white;' type='button' class='edit-catagory btn btn-default' onclick='edit_row(this)'> <i class='fa fa-edit'></i></button> ";

    cell6.innerHTML = "<input class='form-control ' TYPE=\'hidden\'  name='fname_add[]' id=\'fname_add"+index_i+"\' value=\'"+fname_add+"\'> <input class='form-control ' TYPE=\'hidden\'  name='lname_add[]' id=\'lname_add"+index_i+"\''  value=\'"+lname_add+"\'> <input class='form-control ' TYPE=\'hidden\'  name='address[]' id=\'address"+index_i+"\' value=\'"+address+"\'><input class='form-control ' TYPE=\'hidden\'  name='district[]' id=\'district"+index_i+"\' value=\'"+district+"\'><input class='form-control ' TYPE=\'hidden\'  name='amphor[]' id=\'amphor"+index_i+"\' value=\'"+amphor+"\'><input class='form-control ' TYPE=\'hidden\'  name='province[]' id=\'province"+index_i+"\' value=\'"+province+"\'><input class='form-control ' TYPE=\'hidden\'  name='zipcode[]' id=\'zipcode"+index_i+"\' value=\'"+zipcode+"\'><input class='form-control ' TYPE=\'hidden\'  name='tp[]' id=\'tp"+index_i+"\' value=\'"+tp+"\'>";
    
   

           $('#myModal').modal('hide');     
                
    }
function add_row() {

    var table = document.getElementById("myTable");
    id_employee = $('#id_employee').val();
    name_em = $('#name_em').val();
       total_cost = $('#total_cost').val();

 var data = {
  sum_total_cost: $('#total_cost').val(),
  } ;
                

    if(total_cost > 0){
        for (var i = 1; i <= total_cost; i++) {
            
       
         id_employee_i = $('#id_employee'+i).val();
        if(id_employee == id_employee_i){
        swal("คำเตือน", "มีลูกทีมคนนี้แล้ว", "warning")
        return false;
      } }
      }  
    if(id_employee == ""){
        swal("คำเตือน", "คุณยังไม่ได้เลือกลูกทีม", "warning")
        return false;
      }
     

    count_rows = table.getElementsByTagName("tr").length;

    var row = table.insertRow(count_rows);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
 
 
    cell1.innerHTML = count_rows;
    cell2.innerHTML = name_em;

    cell3.innerHTML = "<button style='background-color: white;' type='button' class='edit-catagory btn btn-default' onclick='del_row(this)'> <i class='fa fa-fw fa-trash'></i></button>  ";

    cell4.innerHTML = "<input class='form-control ' TYPE=\'hidden\'  name='id_employee[]' id=\'id_employee"+count_rows+"\' value=\'"+id_employee+"\'> <input class='form-control ' TYPE=\'hidden\'  name='name_em[]' id=\'name_em"+count_rows+"\''  value=\'"+name_em+"\'> ";
    
   

                 result1 = parseInt(data.sum_total_cost);
                document.getElementById('total_cost').value=result1+1;
                inputClear();
}



         function inputClear(){
            $('#fname_add').val('');
            $('#lname_add').val('');
            $('#address').val('');
            $('#district').val('');
            $('#amphor').val('');
            $('#province').val('');
            $('#zipcode').val('');
            $('#tp').val('');
        }

</script>
<script type="text/javascript">
// $(document).ready(function(){
//         $.Thailand({
//             $district: $('#district'), // input ของตำบล
//             $amphoe: $('#amphor'), // input ของอำเภอ
//             $province: $('#province'), // input ของจังหวัด
//             $zipcode: $('#zipcode'), // input ของรหัสไปรษณีย์
//         });
//         // $.Thailand_edit({
//         //     $district: $('#district_edit'), // input ของตำบล
//         //     $amphoe: $('#amphor_edit'), // input ของอำเภอ
//         //     $province: $('#province_edit'), // input ของจังหวัด
//         //     $zipcode: $('#zipcode_edit'), // input ของรหัสไปรษณีย์
//         // });
// })
    //------------------------------------------------------------ADD Customer--------------------------------------------------------------
       


    $(document).on('click', '#btnSendedit', function(){
      
        var formData = new FormData($('#frm_edit')[0]);
    id = $('#id').val();
    coubon_code_edit = $('#coubon_code_edit').val();
    coubon_name_edit = $('#coubon_name_edit').val();
    datetimepicker_edit = $('#datetimepicker_edit').val();
    num_coubon_edit = $('#num_coubon_edit').val();
    
  

    if(coubon_code_edit == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ coubon code", "warning")
        return false;
      }
    if(coubon_name_edit == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ชื่อคูปอง", "warning")
        return false;
      }
    
    
    if(datetimepicker_edit == ''){
        swal("คำเตือน", "คุณยังไม่ได้เลือกวันที่เริ่มต้น-วันที่สิ้นสุด", "warning")
        return false;
      }
    if(num_coubon_edit == ''){
        swal("คำเตือน", "คุณยังไม่ได้ใส่จำนวนคูปอง", "warning")
        return false;
      }
    
      $.ajax({
        url: "functions.php",
        type:"POST",
        data:{data:coubon_code_edit,data_id:id,_method:"check_edit",datetimepicker:datetimepicker_edit},
        success:function(data){
          console.log(data);
          if(data.status==1) {
            swal("คำเตือน", "Code Coupon นี้มีการใช้งานในช่วงระยะเวลาที่เลือกแล้ว  กรุณากรอกใหม่", "warning")
        return false;
             // alert("Coupon Code นี้มีการใช้งานในช่วงระยะเวลาที่เลือกแล้ว  กรุณากรอกใหม่");
            document.getElementById('coubon_code').value=coubon_code;
            document.getElementById("coubon_code").focus();

          }         
          else{
        swal({
            title: 'ยืนยัน?',
            text: "ยืนยันบันทึกการแก้ไขหรือไม่?",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
            return new Promise(function (resolve) {
            $.ajax({
            type: "POST",
            url: "functions.php",
            data: formData,
            processData: false,
            contentType: false
                  })

// in case of successfully understood ajax response
            .done(function (myAjaxJsonResponse) {
            console.log(myAjaxJsonResponse);
           // alert(myAjaxJsonResponse);
           $.ajax({
            type: "POST",
            url: "mail_to.php",
            data: formData,
            processData: false,
            contentType: false
                  })
  swal({
            title: 'สำเร็จ',
            text: "บันทึกการแก้ไขเรียบร้อยแล้ว?",
            type: 'success',
      
            confirmButtonColor: '#3085d6',
          
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
            return new Promise(function (resolve) {
          
             
         swal(window.location.href='front-manage.php?id='+id)
            //location.reload();
           
            .fail(function (erordata) {
// คือไม่สำรเ็จ
            console.log(erordata);
            swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
            })
          })
        },    
      })
            })
            .fail(function (erordata) {
// คือไม่สำรเ็จ
            console.log(erordata);
            swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
            })
          })
        },    
      })
        } 
        }
      })
    });



    $(document).on('click', '#del_team_member', function(){
    var id = $(this).attr('data-id');
   
        swal({
            title: 'ยืนยัน?',
            text: "ยืนยันการลบหรือไม่?",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
            return new Promise(function (resolve) {
            $.ajax({
            type: "POST",
            url: "functions.php?_method=del_team_member&id="+id,

             data: {id:id},
           
            processData: false,
            contentType: false
                  })

// in case of successfully understood ajax response
            .done(function (myAjaxJsonResponse) {
            console.log(myAjaxJsonResponse);
            //alert(myAjaxJsonResponse);
  swal({
            title: 'สำเร็จ',
            text: "ลบเรียบร้อยแล้ว?",
            type: 'success',
      
            confirmButtonColor: '#3085d6',
          
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
            return new Promise(function (resolve) {
           $.ajax({
            type: "POST",
            url: "front-edit.php?select=do",

             data: {id:id},
           
            processData: false,
            contentType: false
                  })
            // alert('การบันทึก');
         swal(window.location.href='front-edit.php')
            //location.reload();
           
            .fail(function (erordata) {
// คือไม่สำรเ็จ
            console.log(erordata);

            swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
            })
          })
        },    
      })
            })
            .fail(function (erordata) {
// คือไม่สำรเ็จ

            console.log(erordata);
            swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
            })
          })
        },    
      })
    });

</script>

</body>
</html>
