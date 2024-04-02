<?php
require_once 'db_connection.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>iShop Simple</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- alertify CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styleGo.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="box-shadow: 0px 5px 200px lightgray;">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mx-5">
                    <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4"> -->
                    <li class="nav-item"><a class="nav-link <?php if ($currentPage == 'index') {echo 'active';}?>"
                            aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link <?php if ($currentPage == 'about') {echo 'active';}?>"
                            href="#!">About</a></li>

                    <li class="nav-item"><a class="nav-link <?php if ($currentPage == 'contact') {echo 'active';}?>"
                            href="contact.php">Contact</a></li>
                    <?php
if (isset($_SESSION['user']['user_id'])) {?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php if (isset($_SESSION['user_id'])) {echo 'active';}?> "
                            id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img id="navProfileImage"
                                src="<?=(isset($_SESSION['user']['profile_image'])) ? 'images/profile_image/'.$_SESSION['user']['profile_image'] : "images/dummy_profile_image.png";?>"
                                alt="mdo" width="32" height="32" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="profile.php"><i class="fa-solid fa-user"></i> Profile</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="past_orders.php"><i class="fa-brands fa-first-order"></i>
                                    Orders</a>
                            </li>
                            <li><a class="dropdown-item" href="#!"><i class="fa-solid fa-gear"></i> Settings</a></li>
                            <li><a class="dropdown-item" href="logout.php"><i
                                        class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                        </ul>
                    </li>
                    <?php } else {?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == 'user') {echo 'active';}?>"
                            href="user.php">Register || Login </a>
                    </li>
                    <?php }?>
                </ul>
                <div class="btn-group me-4">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            id="notificationCount">
                            99+
                        </span>
                    </button>
                    <ul id="notificationDropdown" class="dropdown-menu">
                        <!-- Notifications will be dynamically added here using JavaScript -->
                    </ul>
                </div>
                <form class="d-flex ">
                    <button class="btn btn-outline-light" type="button" data-bs-toggle="modal"
                        data-bs-target="#cart_modal">
                        <i class="fa-solid fa-cart-arrow-down me-1 bg-dark text-white"></i>
                        <span class="text-white">Cart</span>
                        <span class="badge bg-light text-dark ms-1 rounded-pill" id="totalItemCount">0</span>
                    </button>
                </form>



            </div>
        </div>
    </nav>