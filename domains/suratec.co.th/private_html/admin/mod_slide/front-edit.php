<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);

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
           $sql_coupon = "SELECT * FROM `slide_catagory` WHERE  id_slide_catagory = '".$_GET["id"]."'";
 $query_coupon = mysqli_query($objConnect, $sql_coupon);
$result_coupon = mysqli_fetch_array($query_coupon);

 ?>        
 <br>
 
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="box box-warning box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">แก้ไข</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
<form class="frm_edit"  method="post" enctype="multipart/form-data" id="frm_edit">

                                           <input type="hidden" name="_method" value="edit"> 
                                            <input type="hidden" name="id" id="id" value="<?php echo $result_coupon["id_slide_catagory"] ?>">
                                              <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อไทย TH</label>

                                                <div class="col-sm-8">
                                                    <input type="text" name="name_th_edit" class="form-control" id="name_th_edit" autocomplete="off" value="<?php echo $result_coupon["name"] ?>" >
                                         
                                                   
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่ออังกฤษ EN</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="name_en_edit" id="name_en_edit" value="<?php echo $result_coupon["name_en"] ?>">
                                                </div>
                                            </div>
                                            
                                        
                                           
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
        
            
   <div class = "modal-footer">
        <button type="button" class="btn btn-success pull-right btnSendedit" id="btnSendedit" style="transition: 0.4s; margin-left: 5px;"> <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;บันทึก</button>
        <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               ปิด
            </button>
    </div>
                    
                </div>
               

<!-- end form -->

<!-- end form -->
 
  




</body>
</html>
