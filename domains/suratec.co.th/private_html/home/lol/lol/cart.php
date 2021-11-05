<?php include 'header.php'
?>
<!--/ End Header -->

<!-- Breadcrumbs -->
<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?= $pic_header['value'] ?>)">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Bread Title -->
                <div class="bread-title">
                    <h2>รถเข็น<?//=$lang['MENU_ABOUT_US'];?><!--About Us--></h2>
                </div>
                <!-- Bread List -->
                <ul class="bread-list">
                    <li><a href="./?index=st"><i class="fa fa-home"></i><?= $lang['MENU_HOME']; ?><!--Home--></a></li>
                    <li class="active"><a href="about_us.php?about_us=st"><i class="fa fa-clone"></i>รถเข็น<?//=$lang['MENU_ABOUT_US'];?><!--About Us--></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--/ End Breadcrumbs -->

<!-- Shopping Cart -->
<?php

/*session_start();
if (isset($_POST['action']) && $_POST['action'] == "remove") {
    if (!empty($_SESSION["shopping_cart"])) {
        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            if ($_POST["code"] == $key) {
                unset($_SESSION["shopping_cart"][$key]);
            }
            if (empty($_SESSION["shopping_cart"]))
                unset($_SESSION["shopping_cart"]);
        }
    }
}

if (isset($_POST['action']) && $_POST['action'] == "change") {
    foreach ($_SESSION["shopping_cart"] as &$value) {
        if ($value['code'] === $_POST["code"]) {
            $value['quantity'] = $_POST["quantity"];
            break; // Stop the loop after we've found the product
        }
    }
}*/
?>

<section class="shopping-cart section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Shopping Summery -->
                <table class="table shopping-summery">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product</th>
                            <th>Description</th>
                            <th class="text-center">price</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Total</th> 
                            <th class="text-center"><i class="fa fa-trash-o"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $product_count_cart2 = 1;
                        if ($_SESSION["shopping_cart"] != NULL) {
                            foreach ($_SESSION["shopping_cart"] as $product) {
                                ?>
                                <tr>
                                    <td class="number" data-title="No"><?= $product_count_cart2 ?></td>
                                    <td class="product" data-title="Product"><a href="#"><img src="../uploads/product/<?php echo $product['image']; ?>" alt="Product"></a></td>
                                    <td class="product-des" data-title="Description">
                                        <p class="product-name"><a href="#"><?php echo $product["name"]; ?></a></p>
                                        <small><a href="#"><?php echo $product["detail"]; ?></a></small><br>
                                    </td>
                                    <td class="price" data-title="Price"><span><?php echo $product["price"]; ?></span></td>
                                    <td>
                                        <form method='post' action=''>
                                            <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                                            <input type='hidden' name='action' value="change" />
                                            <select name='quantity' class='quantity' onchange="this.form.submit()">
                                                <option <?php if ($product["quantity"] == 1) echo "selected"; ?> value="1">1</option>
                                                <option <?php if ($product["quantity"] == 2) echo "selected"; ?> value="2">2</option>
                                                <option <?php if ($product["quantity"] == 3) echo "selected"; ?> value="3">3</option>
                                                <option <?php if ($product["quantity"] == 4) echo "selected"; ?> value="4">4</option>
                                                <option <?php if ($product["quantity"] == 5) echo "selected"; ?> value="5">5</option>
                                            </select>
											<?//=$product["quantity"]++;?>
                                        </form>
                                    </td>
                                    <td class="total-amount" data-title="Total"><span><?php echo "฿" . $product["price"] * $product["quantity"]; ?></span></td>
                                    <td class="action" data-title="Remove">
                                        <form method='post' action=''>
                                            <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                                            <input type='hidden' name='action' value="remove" />
                                            <button type='submit' class='remove'><i class="fa fa-remove"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                $total_price += ($product["price"] * $product["quantity"]);
                                $product_count_cart2++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
                <?php
                if ($_SESSION["shopping_cart"] != NULL) {
                    
                } else {
                    echo '<center><<<<<<<< กรุณาเลือกสินค้า _>>>>>>>></center>';
                }
                ?>
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
                            <a href="http://localhost/suratec_m/home/shop-list.php" class="btn update animate">Update Cart</a>
                            <button class="btn clear animate">Clear Cart</button>
                        </div>
                    </div>
                </div>
                <!--/ End Shopping Button -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="cart-information">
                    <div class="row">
                        <div class="col-lg-8 col-md-4 col-12">
                            <!-- Cart Total -->
                            <div class="single-info cart-total">
                                <h4>Discount Code</h4>
                                <!-- Discount -->
                                <div class="single-info discount-main">
                                    <form action="#" class="discount-form">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="discount-coupon" placeholder="Apply Coupon"/>
                                            <button type="submit" class="btn animate">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <!--/ End Discount -->
                            </div>
                            <!--/ End Cart  Total -->
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <!-- Cart Total -->
                            <div class="single-info cart-total">
                                <h4>Shopping Cart Total</h4>
                                <div class="total-amount">
                                    <p>Sub Total: <span><?php echo "฿ " . $total_price; ?></span></p>
                                    <p>Grand Total: <span><?php echo "฿ " . $total_price; ?></span></p>
                                </div>
                                <button class="btn animate">Proceed to checkout</button>
                            </div>
                            <!--/ End Cart  Total -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Shopping Cart -->

<!-- Footer -->
<?php include 'footer.php' ?>
<!--/ End footer -->
<?php include 'footer_credit.php' ?>	
</div>
</body>
</html>