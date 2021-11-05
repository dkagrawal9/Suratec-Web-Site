<?php
require_once '../library/connect.php';
?><table class="table table-striped table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th><?=lang('วันที่','Date')?></th>
                                        <th><?=lang('ผู้ติดต่อ','Communicant')?></th>
                                        <th><?=lang('เบอร์โทร','Number Phone')?></th>
                                        <th><?=lang('อีเมลล์','E-mail')?></th>
                                        <th><?=lang('เรื่อง','Subject')?></th>
                                        <th><?=lang('สถานะ','Status')?></th>
                                        <th><?=lang('ควบคุม','Control')?></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$str ='' ;
$str .= "SELECT * FROM mod_contact WHERE 1";
if (isset($_POST['datetimepicker']) && $_POST['datetimepicker'] !='') {
    $date_exp = explode("-", $_POST['datetimepicker']);
$str .= "  AND (`send_datetime` BETWEEN '".$date_exp[0]." 00:00:00' and '".$date_exp[1]." 23:59:59')";
}
if (isset($_POST['key_search']) && $_POST['key_search'] !='') {
$str .= "  AND (`name` LIKE '%".$_POST['key_search']."%' OR  `email` LIKE '%".$_POST['key_search']."%'   OR  `subject` LIKE '%".$_POST['key_search']."%'  )";
}
if (isset($_POST['status_search']) && $_POST['status_search'] !='***') {
$str .= "  AND (`status` = '".$_POST['status_search']."' )";
}
// echo $str;
    $resultArray = array();
    $query = mysqli_query($objConnect,$str);
    while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
        ?>
        <tr>
            <td><?php echo $result["send_datetime"]?></td>
            <td><?php echo $result["name"]?></td>
            <td><?php echo $result["tel"]?></td>
            <td><?php echo $result["email"]?></td>
            <td><?php echo $result["subject"]?></td>
            <td>
                <?php 
                    if($result["status"] =='0'){ ?>
                            <small class='label bg-orange' style='font-size:12px;'><?=lang('รอดำเนินการ','Pending...')?></small>
                      <?php  }else{ ?>
                            <small class='label bg-green' style='font-size:12px;'><?=lang('ตอบกลับแล้ว','Replied')?></small>
                      <?php  }
                ?>
                       
            </td>
            <td>
                 <div class='btn-group'>
                        <button class='btn btn-default btn-sm read' data-id='<?php echo $result["id_mail"] ?>'><i class='fa fa-eye'></i></button>
                        <button class='btn btn-default btn-sm reply' data-id='<?php echo $result["email"] ?>' message='<?php echo $result["message"] ?>' subject='<?php echo $result["subject"] ?>' name_to='<?php echo $result["name"] ?>' tel='<?php echo $result["tel"] ?>' id_mail='<?php echo $result["id_mail"] ?>'  data-toggle='tooltip' data-container='body' data-original-title='Reply'><i class='fa fa-reply'></i></button>
                 </div>
            </td>
        </tr>
    <?php } ?>
                                </tbody>
                            </table>