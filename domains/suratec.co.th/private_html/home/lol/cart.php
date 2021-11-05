<?php

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}


if (isset($_GET['id_product'])) {
    $id_product = $_GET['id_product'];
} else {
    $id_product = 1;
}

?>
<?php 
  require_once '../admin/library/connect.php';
  require_once '../admin/library/functions.php';
  checkMemUser($objConnect);
?>
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
<div id="live-order" >

</div>	
<!--/ End Shopping Cart -->

<!-- Footer -->
<?php include 'footer.php' ?>
<!--/ End footer -->
<?php include 'footer_credit.php' ?>	
</div>
</body>
</html>
<script>

$(document).ready(function() {

    // alert(getCookie());
   // Swal.fire('Any fool can use a computer')

  
    if(getlocalname() != undefined){
      //  alert(getlocalname());
         cok = getlocalname();
    //   alert(cok[1])
         if(cok != ''){
          
         
            var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("live-order").innerHTML = this.responseText;

                        }
                    }
                    xmlhttp.open("GET", "live-order.php?id_product="+cok, true);
                    xmlhttp.send();
         }
    }
  //  var table;
});

function deleteproduct(id){
    delete_Cart(id);

    //    alert(cok[1])
          
    if(getlocalname() != undefined){
      ///  alert(getlocalname());
         cok = getlocalname();
    //   alert(cok[1])
         if(cok != ''){
          
         
            var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("live-order").innerHTML = this.responseText;

                        }
                    }
                    xmlhttp.open("GET", "live-order.php?id_product="+cok, true);
                    xmlhttp.send();
         }
        }else{
            location.reload();

         }
}

</script>