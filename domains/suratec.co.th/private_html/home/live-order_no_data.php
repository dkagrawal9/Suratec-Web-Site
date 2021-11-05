<?php include_once 'common.php'; ?>
<section class="section" style="padding: 40px 0;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Shopping Summery -->
				<div style="overflow-x:auto;">
                <table class="table shopping-summery">
                    <thead>
                        <tr>
                            <th style="background: #1BBC9B; color: #FFFFFF"> <?=$lang['MENU_images'];?><!-- pic--></th>
                            <th style="background: #1BBC9B; color: #FFFFFF"> <?=$lang['MENU_Shop'];?><!--Product--></th>
                            <th style="background: #1BBC9B; color: #FFFFFF"> <?=$lang['MENU_search8'];?><!--price--></th>
                            <th style="background: #1BBC9B; color: #FFFFFF"> <?=$lang['MENU_number'];?><!--Qty--></th>
                            <th style="background: #1BBC9B; color: #FFFFFF"> <?=$lang['MENU_total_price'];?><!--Total--></th> 
                            <th style="background: #1BBC9B; color: #FFFFFF"><i class="fa fa-trash-o"></i></th>
                        </tr>
                    </thead>
                    <tbody>
						

    	<tr>
         	<td class="product">
  
        	</td>
         	<td style="text-align: left;">
           
          </td>	
          <td style="text-align: left;">
          
          </td>
          <td style="text-align: left;">

          </td>

          <td style="text-align: left;">
          
          </td>
		
          <td style="width: 70px;" >
              
          </td>
</tr>

<tr>
    <td></td>
    <td></td>
	<td style="text-align: right;"><i class="icofont icofont-info-circle icofont-2x" style="color: #00A9E8;"></i> <?=$lang['MENU_no_data'];?></td>
    <td style="text-align: left;" ></td>
    <td style="text-align: left;" ></td>
    <td></td>
</tr>
                    </tbody>
                </table>
				</div>
                <!--/ End Shopping Summery -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Shopping Button -->
                <div class="shopping-button">
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-12 text-left">

                        </div>
                        <div class="col-lg-5 col-md-5 col-12 text-right">
                            <a href="shop-list.php?shop_m=st" class="btn update animate" style="background: coral;"><?=$lang['MENU_add_products'];?></a>
                            <!--<button onclick="deleteproductall()" class="btn clear animate">เคลียร์สินค้าทั้งหมด</button>-->
                        </div>
                    </div>
                </div>
                <!--/ End Shopping Button -->
            </div>
        </div>
        
    </div>
</section>	