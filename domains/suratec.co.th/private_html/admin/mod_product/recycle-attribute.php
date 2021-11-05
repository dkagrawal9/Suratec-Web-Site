 <?php
require_once '../library/connect.php';
 // echo "55555".$_POST['id'];
  $str_attr = "SELECT * FROM product_attribute WHERE id_product ='".$_POST['id']."'";
  $query_attr = mysqli_query($objConnect,$str_attr);
  $i = 0;
  $output = '';
  $output .= '<table class="table-attribute" id="table-attribute" width="100%">';
  $output .= '<tbody>';
  while($result_attr = mysqli_fetch_array($query_attr)){
  $i++;
      if($i > 1){
        $check_del = '';
      }else{
        $check_del = 'disabled';
      }
  $output .='
                        <tr>
                            <td>
                              <div style="width:100%; border-bottom:2px solid blue; margin-bottom:5px; font-size:16px;">แบบที่ '.$i.'</div>
                              สี
                              <div class="input-group" style="margin-bottom: 0; padding-bottom: 5px; width: 100%;">
                                <input type="text" name="color[]" class="form-control" style="border-radius: 2px;" value="'.$result_attr['color'].'">
                              </div>
                              ขนาด
                              <div class="input-group" style="margin-bottom: 0; padding-bottom: 5px; width: 100%;">  
                                <input type="text" name="size[]" class="form-control" style="border-radius: 2px;" value="'.$result_attr['size'].'">
                              </div>
                              รหัสสินค้า
                              <div class="input-group" style="margin-bottom: 0; width: 100%;">   
                                <input type="text" name="SKU[]" class="form-control" style="border-radius: 2px;" value="'.$result_attr['SKU_attr'].'">
                              </div>
                            </td>
                            <td>
                              <div style="margin-top:29px;">
                                ราคาขาย
                                <div class="input-group" style="margin-bottom: 0; padding-bottom: 5px;">                    
                                  <input type="text" name="price[]" class="form-control" style="border-radius: 2px;" value="'.$result_attr['price_attr'].'">
                                  <span class="input-group-addon">THB</span>
                                </div>
                                ราคาปกติ
                                <div class="input-group" style="margin-bottom: 0; padding-bottom: 5px;"> 
                                  <input type="text" name="normal[]" class="form-control" style="border-radius: 2px;" value="'.$result_attr['price_n_attr'].'">
                                  <span class="input-group-addon">THB</span>
                                </div>
                                รายละเอียดภาษาไทย
                                <div class="input-group" style="margin-bottom: 0; width:100%;"> 
                                  <input type="text" name="DET[]" class="form-control" style="border-radius: 2px;" value="'.$result_attr['DET_attr'].'">
                                </div>
                              </div>
                            </td>
                            <td>    
                              <div style="margin-top:29px;">
                                สต็อก
                                <div class="input-group" style="margin-bottom: 0; padding-bottom: 5px;">                    
                                  <input type="text" name="stock[]" class="form-control" style="border-radius: 2px;" value="'.$result_attr['stock_attr'].'">
                                  <span class="input-group-addon">U</span>
                                </div>
                                นำ้หนัก
                                <div class="input-group" style="margin-bottom: 5px;;"> 
                                  <input type="text" name="weight[]" class="form-control" style="border-radius: 2px;" value="'.$result_attr['weight_attr'].'">
                                  <span class="input-group-addon"> G </span>
                                </div>
                                รายละอียดภาษาอังกฤษ
                                <div class="input-group" style="margin-bottom: 0; width: 100%;">  
                                  <input type="text" name="DET_EN[]" class="form-control" style="border-radius: 2px; " value="'.$result_attr['DET_attr_en'].'">
                                </div>
                              </div>
                            </td>
                            <td height="50">
                              <button type="button" style="height: 30px !important; padding: 5px; margin-top:-3px;" class="btn btn-block del-attribute-recycle" '.$check_del.' data-id="'.$result_attr['id_attr'].'"><i class="glyphicon glyphicon-trash"></i></button>
                            </td>
                          </tr>';
  }
  echo $output;
  ?>
                            