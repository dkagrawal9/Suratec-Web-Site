<?php
 require_once '../library/connect.php';    
 // header('Content-Type: application/json');
  ?>
 <div class="modal-body">

        <form action="" method="post" id="confirm_frm">
          <input type="hidden" name="_method" id="_method" value="CONFIRM_ORDER">
<?php
$sql = "SELECT * FROM `article_opinion` WHERE `id` = '".$_POST["id"]."'";
$query = mysqli_query($objConnect,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
 ?>
       <div class="product_img_st">
        <div id="path_slip"  >
         
        </div>
        <br>
    <div class="col-md-12" >
        <div  >
            <label class="col-md-4">วันที่ - เวลา</label>
            <div class="col-md-8">
                <input type="text" name="date_pay" id="date_pay" class="form-control" value="<?php echo $result["date_action"] ?>" readonly>
            </div>
            
        </div>
        <div  >
            <label class="col-md-4">IP</label>
            <div class="col-md-8">
                <input type="text" name="price_in" id="price_in" class="form-control" value="<?php echo $result["ip"] ?>" readonly>
            </div>
            
        </div>
        <div  >
            <label class="col-md-4">ความคิดเห็น</label>
            <div class="col-md-8" style="height: 250px; overflow: auto;">
                <?php echo $result["message"] ?>
            </div>
            
        </div>
    </div>
       

</form>

      </div>
     <div class="modal-footer"  >     
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

      </div>