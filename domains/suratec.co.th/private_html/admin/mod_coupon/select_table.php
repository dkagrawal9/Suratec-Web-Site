<?php
//session_start();
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);

if($_GET['do']=='select_table' && isset($_GET['do'])){
	select_table();

	exit;
}
?>
<?php
function select_table(){ 


global $objConnect; 
$button_edit  = $_POST["button_edit"];
$button_del  = $_POST["button_del"];
$button_open   = $_POST["button_open"];
$input_read   = $_POST["input_read"];


?>
 <form id="frm_table"  method="post">
 <input type="hidden" name="_method" value="delmull">
 
 <div class="box-body" id="div_table">
                                            <table class="table" id="table_team">
                                               <thead>
                                        <th>ชื่อคูปอง</th>
                                        <th>Code coupon</th>
                                        <th>ส่วนลด (%)</th>
                                        <th>วันที่เริ่มต้น</th>
                                        <th>วันที่สิ้นสุด</th>
                                        <th>จำนวนคูปอง</th>
                                        <th>จำนวนการใช้งาน</th>
                                        <th>จัดการ</th>
                                               </thead>
                                                   <tbody>
        <?php
         $sql_coupon = "SELECT coupon.code,coupon.coupon_id,coupon.name,coupon.discount,coupon.quantity,coupon.start_date,coupon.end_date FROM `coupon` WHERE `delete_datetime` is null";
          if (isset($_POST["datetimepicker"])&& $_POST["datetimepicker"] != '') {
            $datetimepicker = explode("-", $_POST['datetimepicker']);
              $sql_coupon .= " AND `start_date`>= '".$datetimepicker[0]." 00:00:00' AND `end_date` <= '".$datetimepicker[1]." 23:59:59'";
          }
           if (isset($_POST["key_search"])&& $_POST["key_search"] != '') {
              $sql_coupon .= " AND `name` LIKE '%".$_POST["key_search"]."%' OR `code` LIKE '%".$_POST["key_search"]."%'";
          }
 $query_coupon = mysqli_query($objConnect, $sql_coupon);
 $i = 1 ;
 while ($result_coupon = mysqli_fetch_array($query_coupon)) {
        ?>
                                        <tr>
                                            <td><?php echo $result_coupon["name"] ?></td>
                                            <td><?php echo $result_coupon["code"] ?></td>
                                            <td><?php echo $result_coupon["discount"] ?></td>
                                            <td><?php echo $result_coupon["start_date"] ?></td>
                                            <td><?php echo $result_coupon["end_date"] ?></td>
                                            <td><?php echo $result_coupon["quantity"] ?></td>
         <?php
         $sql_couponed = "SELECT COUNT(`id`) quantity_ed  FROM `coupon_history` WHERE `coupon_id`='".$result_coupon['coupon_id']."' AND `deleted_time` IS null";
         
 $query_couponed = mysqli_query($objConnect, $sql_couponed);
$result_couponed = mysqli_fetch_array($query_couponed);
        ?>
                                            <td><?php echo $result_couponed["quantity_ed"] ?></td>
                                            <td>
                    <a style="<?php echo $input_read  ?>"  href="t1.php?id_da=<?php echo $result_coupon['coupon_id'] ?>" class="show-product btn btn-Primary"   data-toggle="modal" data-target="#modal_showdetail">
                        <i class="fa fa-fw fa-eye"></i>
                    </a>
                    <?php
                    $date = date("Y-m-d H:i:s");
                    if ($result_coupon['start_date']>=$date ) {
                     
                    ?>
                    <a  style="<?php echo $button_edit   ?>" class="edit-product btn btn-Warning"  href="front_edit.php?id=<?php echo $result_coupon['coupon_id'] ?>&select=do"  data-toggle="modal" data-target="#modal_edit"  >
               
                        <i class="fa fa-edit"></i></a>
                        

                    <button style="<?php echo $button_del   ?>" type="button" class="btn btn-Danger " id="delete_team" data-id="<?php echo $result_coupon['coupon_id'] ?>"><i class="fa fa-remove"></i></button>
                <?php } ?>
                                            </td>
                                        </tr>
<?php  $i++; } ?>
                                    </tbody>
                                           </table>
                                            
                                             
                                         </div>
                            </form>                         

<?php } ?>
