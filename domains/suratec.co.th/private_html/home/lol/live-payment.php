<?php

require_once '../../engine/lib/connect.php';

?>
<div class="container container-fluid text-center">
	<form id="frm">
    <div class="row content" >
		<!-- End col-sm-4 -->

         <div class="col-sm-7 box_shadow_m">
            <section style="border: chartreuse;">
				<h5 style="text-align: left;">รายการสั่งซื้อ</h5>
				<div style="overflow-x:auto;">
                <table id="example23" class="display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
                    <tr>
						<th style="text-align: center; width: 10%; background: #26c6da;"  >
                            รูป
                        </th>
                        <th style="text-align: center; width: 40%; background: #26c6da;"  >
                            คอร์ส
                        </th>
                        <th style="text-align: center; width: 20%; background: #26c6da;"  >
                            ราคา
                        </th>
                        <th style="text-align: center; width: 10%; background: #26c6da;"  >
                            จำนวน
                        </th>
                        <th style="text-align: center; width: 20%; background: #26c6da;" >
                            ยอดเงิน
                        </th>
                    </tr>
                    <tbody>
                <?php 
                      $id = explode(',',$_GET['id_course']);
					  //echo $id[0];			  
                      $data = "'".$id[0]."'";
                
                      for($i=1; count($id) > $i;$i++){
                        $data .=  ","."'".$id[$i]."'"; 
                      }
                
                      $qtyproduct = 0;
                      $priceall = 0;
                                                
                      $strSQL = "   SELECT course.name_th,course.name_en,course.price, course_images.directory,CONCAT(course_images.directory,course_images.name) as imgdata, 1 as qty
                                    FROM course   LEFT JOIN course_images
                                    ON course.id_course = course_images.id_course
                                    where   course.delete_datetime is NULL   and   course.id_course in($data)
                                    UNION  ALL
                                    SELECT webinar.name_th,webinar.name_en,webinar.price,webinar_images.directory,CONCAT(webinar_images.directory,webinar_images.name) as imgdata, 1 as qty
                                    FROM webinar   LEFT JOIN webinar_images
                                    ON webinar.id_webinar = webinar_images.id_webinar
                                    where   webinar.delete_datetime is NULL  and   webinar.id_webinar in($data) ";/*  */
                                $objQuery = $db->Query($strSQL);
                               // var_dump($strSQL);
                                while ($objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {

                                    $img_mi = $objResult['imgdata'];
                                    if ($img_mi == null || !@file_get_contents($img_mi, 0, null, 0, 1)) {
                                        $img_mi =  "../../images/no_image.jpg";
                                    } else {
                                        $img_mi =  $img_mi;
                                    } 


                                  

                                ?>
                    <tr>
						  <td style="text-align: left;">     
                          	<img src="<?= $img_mi; ?>" style="width: 100%;"> 
                          </td>	
                          <td style="text-align: left;">     
                          	<?= lang($objResult['name_th'],$objResult['name_en']) ?>
                          </td>
                          <td style="text-align: right;">
                          	฿ <?= number_format($objResult['price'],2)?>
                          </td>
                          <td style="text-align: right;">
                          	<?= $objResult['qty'] ?>
                          </td>
                          <td style="text-align: right;">
                          	฿ <?= number_format($objResult['price']*$objResult['qty'],2) ?>
                          </td>
                	</tr>
                <?php
					 $qtyproduct = $qtyproduct+$objResult['qty'];
					 $priceall = $priceall+ ($objResult['price']*$objResult['qty']);
                	}
                ?>
                	</tbody>
                </table>
				</div>
				<div style="overflow-x:auto;">
                <table style="width: 100%;" >
                    <tr>
                        <td style="width: 50%; padding: 0.75rem;">


                        </td>
                        <td style="width: 20%; text-align: right; padding: 0.75rem;">
                            รวมทั้งหมด
                        </td>
                        <td style="width: 10%; text-align: right; padding: 0.75rem;">
                            <label id="qtyproduct" name="qtyproduct" style="size: 15px;"><?= $qtyproduct; ?></label>
                        </td>
                        <td style="width: 20%; text-align: right; padding: 0.75rem;">
                            <label id="priceall" name="priceall" style="size: 15px;">฿ <?= number_format($priceall,2);?></label>
                            <input id="total" name="total" type="hidden" value="<?= $priceall; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input_p_m" style="background: #2699fb; color: #fff;">คูปองส่วนลด</span>
                                </div>
                                <input type="text" name="pong" id="pong" class="form-control input_p_m" placeholder="กรอกคูปองส่วนลด" required="" data-validation-required-message="This field is required" aria-invalid="false">
                              
                                <div class="input-group-append">
                                    <button type="button" onclick="checkpong();" class="btn input-group-text input_p_m" style="background: #ff6969; color: #fff;">ยืนยัน</span>
                                </div>
                            </div>
                        </td>
						<?php
							 $pongsa = $priceall + 0 ;
							 $sumtotal = $pongsa
						?>
                        <td style="width: 20%; text-align: right; padding: 0.75rem;">
                            มูลค่าส่วนลด
                        </td>
                        <td style="width: 10%; text-align: right; padding: 0.75rem;" >
                            <label id="pongsave" name="pongsave" style="size: 15px;"></label>
                            <input id="pongdata" name="pongdata" type="hidden">
                            <input id="pongid" name="pongid" type="hidden">
                            <input id="coupon_amount" name="coupon_amount" type="hidden">
                            
                        </td>

                        <td style="width: 20%; text-align: right; padding: 0.75rem;">
                            <label id="discount" name="discount" style="size: 15px;">฿ 0</label>
                            <input id="discountdata" name="discountdata" type="hidden" style="size: 15px;">
                            
                        </td>
                    </tr>
                    <tr>
                            <td>
                            </td>
                       	<td style="width: 20%; text-align: right; padding: 0.75rem;">
                            <label id="sumdata" name="sumdata" style="size: 15px;">ยอดสุทธิ</label>
                        </td>
                        <td style="width: 10%;" >

                        </td>
                        <td style="width: 20%; text-align: right; padding: 0.75rem;">
                            <label id="sumvalue" name="sumvalue" style="size: 15px;">฿ <?=number_format($sumtotal,2);?></label>
                        </td>
                    </tr>
                </table>
				</div>
            </section>

            <section style="border: chartreuse;">
                <div class="container-fluid text-center">    
                    <div class="row content" >
                        <div class="col-sm-12" >
                           <h5 style="text-align: left;">
                               การชำระเงิน
                           </h5>
                        </div>
                            <div class="col-sm-12" >
                                    <!-- <div>
                                    <input type="radio" id="payment1" name="payment" value="1"  checked>
                                    <label for="huey"></label>
                                    </div>
                                    <div>
                                        <input type="radio" id="payment2" name="payment" value="2" >
                                        <label for="huey"></label>
                                        </div>
                                    <div>
                                      <input type="radio" id="payment3" name="payment" value="3" >
                                        <label for="huey"></label>
                                      </div> -->
                                      <div>
                                        <!--<input type="radio" name="drone" class="drone" id="huey" value="huey" onclick='toggle("huey")' checked>
                                        <label for="huey">โอนเงินผ่านธนาคาร/PromptPay</label>
										<input type="radio" id="dewey" name="drone" class="drone" value="dewey" onclick='toggle("dewey")'>
                                        <label for="dewey">Cedit Card</label>
										<input type="radio" id="louie" name="drone" class="drone" value="louie" onclick='toggle("louie")'>
                                        <label for="louie">ใช้ตัวเงิน</label>-->
                                      </div>
										<input type="radio" onchange="document.getElementById('div1').style.display='block';document.getElementById('div2').style.display='none';document.getElementById('div3').style.display='none'" name="drone" class="radio1" value="1" id="huey"><label for="huey"> โอนเงินผ่านธนาคาร / PromptPay</label>

										<input type="radio" onchange=" document.getElementById('div2').style.display='block';document.getElementById('div1').style.display='none';document.getElementById('div3').style.display='none'" name="drone" class="radio2" value="2" id="dewey" style="display: none;" ><label style="display: none;" for="dewey"> Cedit Card</label>
								
										<input type="radio" onchange=" document.getElementById('div3').style.display='block';document.getElementById('div1').style.display='none';document.getElementById('div2').style.display='none'" name="drone" class="radio2" value="3" id="louie"><label for="louie"> ใช้ตัวเงิน</label>

                                      <!--<div>
                                        <input type="radio" id="dewey" name="drone" value="dewey">
                                        <label for="dewey">Cedit Card</label>
                                      </div>-->
                                      <!--<div>
                                        <input type="radio" id="louie" name="drone" value="louie">
                                        <label for="louie">ใช้ตัวเงิน</label>
                                      </div>-->
                            	</div>
						
						<div id="div1" class="col-md-12 div1 content" style="display: none;">
							<div class="row">	
						<?php
						  while ($img_pay = mysqli_fetch_array($query,MYSQLI_BOTH))
								{
						?>
						  <?php 
							$date_img_p = explode("-", $img_pay['update_datetime']);
						  ?> 
						<div class="col-md-6">	
							<div class="staff">
							<div class="text pt-3 text-center">
								<h3>เลขที่บัญชี : <?=$img_pay['account_number'];?></h3>
								<!--<span class="position mb-2">Denstist</span>-->
								<div class="faded">
									<span>ชื่อบัญชี : <?=$img_pay['name'];?> (สาขา<?=$img_pay['branch'];?>)</span>
	              				</div>
							</div>
							<div class="img-wrap d-flex align-items-stretch">
								<div class="img align-self-stretch" style="background-image: url('<?=$img_pay['qrcode_directory'];?><?=$img_pay['qrcode_image'];?>'); width: 100%;"></div>
							</div>
							</div>	
						</div>
					
						<?php } ?>	  
						</div>
						</div>
						</div>
                        <div>
                            
                        </div>
						<div id="div2" class="col-md-12 div2 content" style="display: none;">
							<div class="row">	
								<div class="col-md-12">
									<span>ประภทบัตรเครดิต</span>
									<input type="text" name="refno" value="">
									<span>ประภทบัตรเครดิต</span>
									<input type="text" name="refno" value="">
									<span>ประภทบัตรเครดิต</span>
									<input type="text" name="refno" value="">
									<span>ประภทบัตรเครดิต</span>
									<input type="text" name="refno" value="">
								</div>	
							</div>
						</div>
						<div id="div3" class="col-md-12 div3 content" style="display: none;">
							<div class="row">	
								<div class="col-md-12">
									ใช้ตั๋วเงิน
								</div>
                            </div>
						</div>	
				<button type="button" class="btn btn-primary" onclick="payment();" style="float: right; padding-left: 30px; padding-right: 30px;"><span>สั่งซื้อ</span> <i class="icofont icofont-check-circled"></i></button>
                    </div>
			 
            </section>
    	</div>
    </div>
	
	</form>
	<!--<form method="post" action="https://www.thaiepay.com/epaylink/payment.aspx">
                                <input type="text" name="refno" value="99999">
                                <input type="text" name="merchantid" value="">
                                <input type="text" name="customeremail" value="">
                                <input type="text" name="cc" value="00">
                                <input type="text" name="productdetail" value="Testing Product">
								<input type="hidden" name="returnurl" value="https://www.vao-ce.com/">
                                <input type="text" name="total" value="400">
                                <br>
                                <input type="submit" name="Submit" value="Comfirm Order">
    </form>-->
		

</div>









