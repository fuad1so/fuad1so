<?php

require_once 'db_connection.php';
$currentPage = 'index';
require_once 'header.php';
?>


<!-- Header-->
<header class="bg-primary pt-4   ">
    <div class="container px-1 px-lg-5 my-5">
        <div class="row ">
            <div class="col-md-3  d-flex justify-content-center"></div>
            <div class="col-md-3  d-flex justify-content-center p-0 m-0">
                <img class="img-fluid" src="images/bookShop.png" alt="">
            </div>
            <div class="col-md-4 position-relative">
                <h1 class="display-4 text-center fw-bolder text-white pt-5 m-0">NovelNest</h1>
                <p class="lead fw-normal text-center text-white-50 mb-0">🍃 any novel you need just one click🍃
                </p>
            </div>

        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div id="products" class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">


        </div>
    </div>
</section>



<?php
require_once 'footer.php';
?>