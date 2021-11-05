
<?php
 require_once '../library/connect.php';
       $strSQL_cat = "SELECT * FROM article_catagory";
                    $objQuery_cat = mysqli_query($objConnect,$strSQL_cat);
                    $output = '';
                    $output .='<table class="table_cat-sub" align="center">';
                                      
                    while ($objResult_cat = mysqli_fetch_array($objQuery_cat)) {
                        $check = '';
                      if($_POST['id'] == $objResult_cat['id_catagory']){
                        $check = "checked";
                      }
                    $output .= '<tr>
                                  <td width="10%">
                                    <input type="checkbox" name="id_article-catagory" value="'.$objResult_cat["id_catagory"].'" class="css_data_item" '.$check.'>
                                  </td>
                                  <td width="90%">
                                    <img src="../img/folder.png" width="15px" height="15px">&emsp;'.lang($objResult_cat["name_catagory"],$objResult_cat['name_catagory_en']).'
                                  </td>
                                </tr>';   
                       }
                    $output .='</table>';
                    echo $output;
                   ?>