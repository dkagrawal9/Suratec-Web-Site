<?php 
 require_once '../library/connect.php';
$strSQL = "SELECT * FROM article_catagory WHERE article_catagory.name_catagory LIKE '%".$_GET["page_titel"]."%'  LIMIT 1";
$objQuery = mysqli_query($objConnect,$strSQL);
?>
<table class="table_cat-sub" align="center">
	<?php
while ($objResult = mysqli_fetch_array($objQuery)) {
	?>
<tr>
              <td width="10%">
                <input type="checkbox" name="id_article-catagory" checked value="<?php echo $objResult["id_catagory"] ?>" class="css_data_item">
              </td>
              <td width="90%">
                <img src="../img/folder.png" width="15px" height="15px">&emsp;
                <?php echo lang($objResult["name_catagory"],$objResult['name_catagory_en']) ?>
              </td>
            </tr>                
<?php } ?>
</table>

                