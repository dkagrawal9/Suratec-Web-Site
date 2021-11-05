<?php
 require_once '../library/connect.php';

$record_per_page = 20;
$page = '';
$output = '';
if(isset($_POST["page"]))
{
  $page = $_POST["page"];
}
else
{
  $page = 1;
}

$start_from = ($page - 1)*$record_per_page;

$strSQL = "SELECT
    article.`id_article`,
    article.`name_article`,
    article.`image`,
    article.create_datetime
FROM
    `article`
    LEFT JOIN article_catagory ON article_catagory.id_catagory=article.id_catagory
WHERE
   article.`delete_datetime` IS NULL
   AND article_catagory.name_catagory LIKE '%บทความ%'";
if (isset($_POST["key_word"])&&$_POST["key_word"] != '') {
  $strSQL .= " AND `name_article` LIKE '%".$_POST["key_word"]."%'";
}
$objQuery = mysqli_query($objConnect,$strSQL) or die (mysqli_error());
$button_edit  = $_POST["button_edit"];
$button_del  = $_POST["button_del"];
$button_open   = $_POST["button_open"];
$input_read   = $_POST["input_read"];
?>

 <div style="overflow-x:auto;">
            <table class="table-article">
              <thead>
                    <tr>
                     <!--  <th style="text-align: center; min-width:50px; width:50px;"><input class="ClickCheckAll" type="checkbox" name="CheckAll" id="CheckAll" value="Y" onClick="ClickCheckAll(this);"></th>
                      <th colspan="2">'.lang('เลือกทั้งหมด','Select').'</th> -->
                      <th style="text-align: center; ">วันที่</th>
                      <th style="text-align: center; ">รูป</th>
                      <th style="text-align: center; ">หัวข้อบทความ</th>
                      <th style="text-align: center; ">จัดการ</th>
                    </tr>
                  </thead>
                  <tbody>
       <?php
        $i = $start_from;
        $start = $start_from+1;
        $num = 0;
while($objResult = mysqli_fetch_array($objQuery))
      {
        
        // if ($objResult['name_image']=='') {
        //   $img ="img/no_image.png";
        // }else{
        //   $img ="../../uploads/article/". $objResult['name_image'];
        // }
        $num++;
        $i++; 
        ?>
<tr class="show-tr">
             <!--  <td style="text-align: center;">
                  <input type="checkbox" class="checkbox_remove" name="Chk[]" id="Chk'.$num.'" value="'.$objResult['id_article'].'">
              </td> -->

               <td style="text-align: center;">
                <?php echo $objResult['create_datetime'] ?>
              </td>
              <td style="text-align: center;" width="50%">
                <?php
                if ($objResult['image']=='') { ?>
                  <img width="120" height="80" src="img/no_image.png"  >
                <?php }else{ ?>
                  <img width="120" height="80" src="../../uploads/mod_article/<?php echo $objResult['image'] ?>"  >
               <?php } ?>
              </td>
              <td  style="text-align: center;" width="30%">
                  <?php echo $objResult['name_article'] ?> 
              </td>
              <td style="text-align: center;">
               
                    <button type="button" class="btn btn-info opinion-article" data-id="<?php echo $objResult['id_article']?>">ความคิดเห็น</button>
                    <button style=" <?php echo $button_edit ?>" type="button" class="edit-article btn btn-warning" id="" data-id="<?php echo  $objResult['id_article'] ?>">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger delete-article" data-id="<?php echo $objResult['id_article'] ?>"><i class="fa fa-fw fa-trash"></i></button>
                    
               
              </td>

            </tr>
        
        
    <?php  }
        $page_query = "SELECT
    article.`id_article`,
    article.`name_article`,
    article.`image`,
    article.create_datetime
FROM
    `article`
    LEFT JOIN article_catagory ON article_catagory.id_catagory=article.id_catagory
WHERE
   article.`delete_datetime` IS NULL
   AND article_catagory.name_catagory LIKE '%บทความ%'";    
        if (isset($_POST["key_word"])&&$_POST["key_word"] != '') {
  $strSQL .= " AND `name_article` LIKE '%".$_POST["key_word"]."%'";
}  
        $page_result = mysqli_query($objConnect,$page_query);
        $total_records = mysqli_num_rows($page_result);
        $total_pages = ceil($total_records/$record_per_page);

        $Prev_Page = $page-1;
        $Next_Page = $page+1;

        if($Prev_Page == 0){
          $active_prev = "Disabled";
        }
        if($page == $total_pages){
          $active_next = "Disabled";
        }

$output .='</tbody>
          </table>
          </div>
          <input type="hidden" name="hdnCount" value="'.$num.'">
        </div>
        <div class="box-footer">';
        if($total_records > 0){
          $output .='
          <div class="row">
            <div class="col-sm-5">
              <font size="3">'.lang('หน้าเสริมที่','Article').' '.$start.' '.lang('ถึง','To').' '.$i.' '.lang('จากทั้งหมด','Result').' '.$total_records.'</font>
            </div>
            <div class="col-sm-7">
              <div class="btn-group" style="float:right; background-color:white;">
                <button type="button" class="btn btn-paginate previous btn-button pagination_link" id='.$Prev_Page.' '.$active_prev.'>'.lang('ก่อนหน้า','Prev').'</button>';
                for($a=1; $a<=$total_pages;$a++)
                {
                  if($a == $page ){
                    $class = "page-active";
                  }
                  else{
                    $class ="";
                  }
                  $output .= '<button type="button" class="btn btn-paginate btn-button pagination_link '.$class.'" id='.$a.'>'.$a.'</button>';
                }
  $output .='<button type="button" class="btn btn-paginate next btn-button pagination_link" id='.$Next_Page.' '.$active_next.'>'.lang('ถัดไป','Next').'</button>
              </div>
            </div>
          </div>
        </div>'; 
        }else{
          $output .=''.lang('ไม่มีข้อมูล','Data not found').'';
        }   
echo $output
?>


        <!--  
        <div align="center">
        <div class="btn-group">';

        for($a=1; $a<=$total_pages;$a++)
        {
          $output .= '<button type="button" class="btn btn-default btn-flat pagination_link" id='.$a.'>'.$a.'</button>';
        }  
$output .='</div></div></div>';       
echo $output;-->
<!-----------------------------------------------------------------for dev in future  -->
<!-- <td style="text-align: center;">
                  <input type="text" class="level_slide" style="width: 30px; border: 1px solid #ccc; text-align: center; border-radius: 4px; height: 30px;" value="'.$objResult["level"].'" data-id="'.$objResult['id_article'].'" onkeypress="return isNumber(event)" />
              </td>

    <th style="text-align: center;">ลำดับ</th>