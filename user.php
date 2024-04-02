<?php
$currentPage = 'user';
require_once('header.php');
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    if ($token == 'logout') { ?>
        <script>
            cart = [];
            localStorage.setItem('cart', JSON.stringify(cart));
        </script>
<?php
    }
}
?>

<section class="py-0 mt-5 ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <?php
                if (isset($_GET['action'])) {
                    if ($_GET['action'] == "confirmReg") { ?>
                        <div class="alert alert-success my-4 p-3 d-flex justify-content-center fw-bolder">
                            <?= "Registration successful, you can login now!"; ?>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
        <div class="row bg-dark">
            <div class="card col-md-2 d-flex justify-content-center bg-dark text-white" style="transform: rotate(20deg); ; box-shadow: -25px -25px 500px goldenrod; z-index:0;font-family:impact;">
                <div class="col py-5 border border-1 px-1 my-2 ">
                    <img class="img-fluid" src="images/logo1.png" alt="">
                </div>
                <button type="button" class="btn btn-warning position-relative my-1">
                    Rated
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        1+
                    </span>
                </button>
                <p class="card text-dark p-1">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita,
                    eligendi?
                    consectetur adipisicing elit. Expedita, eligendi? consectetur adipisicing
                </p>
            </div>
            <div class="col-md-1"> </div>
            <div class="row col-md-8 d-flex justify-content-center p-4 m-4" style="background-image: url('images/open-book-open-book-frame-slides-backgrounds.png') ;  background-size: cover;">


                <div class="card col color-2  text-black  mt-5 ms-4  " style="opacity:0.8; ">

                    <!-- Include login.php -->
                    <?php include('login.php'); ?>
                </div>

                <div class="card col color-2  text-black  mt-5 " style=" opacity:0.8; ">
                    <!-- Include register.php -->
                    <?php include('register.php'); ?>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
require_once('footer.php');
?>