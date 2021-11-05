 <?php
 require_once '../library/connect.php';
  date_default_timezone_set("Asia/Bangkok");
   global $objConnect;
   global $date;
   $button_edit  = $_POST["button_edit"];
$button_del  = $_POST["button_del"];
$button_open   = $_POST["button_open"];
$input_read   = $_POST["input_read"];
   ?>
 <form action="" method="post" enctype="multipart/form-data" id="frmADD" class="upload-form-add">
                      <table id="table" class="table">
                        <thead>
                          <th>ลำดับ</th>
                          <th>คำถาม</th>
                          <th>คำตอบ</th>
                          <th>การจัดการ</th>
                        </thead>
                        <tbody >
    <?php
       $strSQL = "SELECT * FROM `faq` WHERE `del_flg` ='0' ORDER BY `order`";
       $query = mysqli_query($objConnect,$strSQL);
       $i = 1;
       while ($result = mysqli_fetch_array($query)) {
    ?>
                          <tr>
                            <td><?php echo $result["order"] ?><input type='hidden' name='id_faq[]' class='form-control' id='id_faq<?php echo $i ?>' autocomplete='off'  value="<?php echo $result["id"] ?>"></td>
                            <td>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <img src="../img/th-fl.png" width="30" >
                                </div>
                                <textarea type='text' name='ask[]' class='form-control' id='ask' style="width: 100%" rows="5"><?php echo $result["question"] ?></textarea>
                              </div>
                              
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <img src="../img/en-fl.jpg" width="30">
                                </div>
                                <textarea type='text' name='ask_en[]' class='form-control' id='ask_en' style="width: 100%" rows="5"><?php echo $result["question_en"] ?></textarea>
                              </div>
                              
                                                    
                                  
                            </td>
                            <td>

                              <div class="input-group">
                                <div class="input-group-addon">
                                  <img src="../img/th-fl.png" width="30" >
                                </div>
                                <textarea type='text' name='answer[]' class='form-control' id='ask' style="width: 100%" rows="5"><?php echo $result["answer"] ?></textarea>
                              </div>
                              
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <img src="../img/en-fl.jpg" width="30">
                                </div>
                                <textarea type='text' name='answer_en[]' class='form-control' id='answer_en' style="width: 100%" rows="5"><?php echo $result["answer_en"] ?></textarea>
                              </div>
                              
                            </td>
                            <!-- <td>
                              <div class='form-group'>
                                <label for='' class='col-sm-2 control-label'>คำถาม</label>
                                <div class='col-sm-10'>
                                  <input type='text' name='ask[]' class='form-control' id='ask' autocomplete='off'  value="<?php echo $result["question"] ?>">
                                </div>
                              </div>

                              <div class='form-group'>
                                <label for='' class='col-sm-4 control-label'>คำตอบ</label>
                                <div class='col-sm-8'>
                                  <input type='text' name='answer[]' class='form-control' id='ask' autocomplete='off'  value="<?php echo $result["answer"] ?>">
                                </div>
                              </div>
                             
                            </td> -->
                            <td><button style='background-color: white; display:<?php echo $button_del  ?> ' type='button' data-id='<?php echo $result["id"] ?>' class='edit-catagory btn btn-default' onclick='del_row(this)'> <i class='fa fa-fw fa-trash'></i></button></td>
                          </tr>
    <?php $i++; } ?>
                          
                        </tbody>
                      </table>
                      </form>

                      <script type="text/javascript">
                           var index;  // variable to set the selected row index
            function getSelectedRow()
            {

                var table = document.getElementById("table");
                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                        // clear the selected from the previous selected row
                        // the first time index is undefined
                        if(typeof index !== "undefined"){
                            table.rows[index].classList.toggle("selected");
                        }
                       
                        index = this.rowIndex;
                        this.classList.toggle("selected");


                    };
                }
                    
            }
  

            getSelectedRow();
            
            
            function upNdown(direction)
            {
                var rows = document.getElementById("table").rows,
                    parent = rows[index].parentNode;
                 if(direction === "up")
                 {
                     if(index > 1){
                        parent.insertBefore(rows[index],rows[index - 1]);
                        // when the row go up the index will be equal to index - 1
                        index--;
                    }
                 }
                 
                 if(direction === "down")
                 {
                     if(index < rows.length -1){
                        parent.insertBefore(rows[index + 1],rows[index]);
                        // when the row go down the index will be equal to index + 1
                        index++;
                    }
                 }
            }
                      </script>