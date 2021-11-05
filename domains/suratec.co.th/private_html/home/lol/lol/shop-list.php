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
                    <h2>สินค้า<?//=$lang['MENU_ABOUT_US'];?><!--About Us--></h2>
                </div>
                <!-- Bread List -->
                <ul class="bread-list">
                    <li><a href="./?index=st"><i class="fa fa-home"></i><?= $lang['MENU_HOME']; ?><!--Home--></a></li>
                    <li class="active"><a href="about_us.php?about_us=st"><i class="fa fa-clone"></i>สินค้า<?//=$lang['MENU_ABOUT_US'];?><!--About Us--></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--/ End Breadcrumbs -->

<section class="shop list section">
    <div class="container">
        <div class="row"> 


            <div class="col-lg-12 col-12">
                <div class="product-main">
                    <div class="row">
                        <div class="col-12">
                            <!-- Shop Top -->
                            <div class="shop-top">
                                <div class="shop-shorter">	
                                    <div class="single-shorter">
                                        <label>Show:</label>
                                        <select>
                                            <option selected="selected">09</option>
                                            <option>15</option>
                                            <option>25</option>
                                            <option>30</option>
                                        </select>
                                    </div>
                                    <div class="single-shorter">
                                        <label>Sort By:</label>
                                        <select>
                                            <option selected="selected">Name</option>
                                            <option>Price</option>
                                            <option>Size</option>
                                        </select>
                                    </div>
                                </div>
                                <ul class="view-mode">
                                    <li><a href="shop-grid.php?shop=st"><i class="fa fa-th-large" style="padding-top: 10px;"></i></a></li>
                                    <li class="active"><a href="shop-list.php?shop=st"><i class="fa fa-th-list" style="padding-top: 10px;"></i></a></li>
                                </ul>
                            </div>
                            <!--/ End Shop Top -->
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $sqlimg = "SELECT * FROM `product` LEFT JOIN product_image ON product.id_product = product_image.id_product where product.delete_datetime is null ";
                        $resultimg = mysqli_query($objConnect, $sqlimg);
                        while ($img = mysqli_fetch_array($resultimg, MYSQLI_BOTH)) {
                            ?>
                            <form method='post' action=''>
                                <input type="hidden" name="code" value="<?= $img['id_product'] ?>">
                                <div class="col-12">
                                    <!-- Single Product -->
                                    <div class="single-product">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-12">
                                                <!-- Product Head -->
                                                <div class="product-head overlay">
                                                    <img src="../uploads/product/<?= $img['name_image'] ?>" alt="#" width="100%" height="100%">
                                                    <div class="product-overlay">
                                                        <a href="#" class="btn wishlist" title="add to Wishlist"><i class="fa fa-heart"></i></a>
                                                        <a href="shop-single.html" class="btn view"><i class="fa fa-link"></i></a>
                                                    </div>
                                                </div>
                                                <!--/ End Product Head -->
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-12">
                                                <!-- Product Meta -->
                                                <div class="product-meta">
                                                    <div class="price">
                                                        <p>฿ <span><?= $img['tmp_price'] ?></span></p>
                                                    </div>
                                                    <h4><a href="#"><?= $img['name_product'] ?></a></h4>                
                                                    <p><?= $img['detail_product'] ?></p>
                                                    <button type="submit" class="btn"><i class="fa fa-shopping-basket"></i>Add to cart</button>
                                                </div>
                                                <!--/ End Product Meta -->
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Single Product -->
                                </div>
                            </form>
                            <?php
                        }
                        ?>  

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- Pagination -->
                            <div class="pagination-main">
                                <ul class="pagination">
                                    <li class="prev"><a href="#" style="padding-top: 13px;"><i class="fa fa-angle-double-left"></i></a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li class="next"><a href="#" style="padding-top: 13px;"><i class="fa fa-angle-double-right"></i></a></li>
                                </ul>
                            </div>
                            <!--/ End Pagination -->
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>


<!-- Footer -->
<?php include 'footer.php' ?>
<!--/ End footer -->
<?php include 'footer_credit.php' ?>	
</div>
</body>
</html>