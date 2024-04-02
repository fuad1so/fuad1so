<?php
$currentPage = 'profile';
require_once 'header.php';

if (!isset($_SESSION['user'])) {
    header("Location: user.php");
    exit();
}

// File upload process
$user = $_SESSION['user']; ?>





<section class="py-4">
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 ">


                <div class="card col-md-10 mt-3 border-light border-5 shadow-lg">
                    <div class="d-flex justify-content-center">
                        <img id="profileImage" src="<?= (isset($user['profile_image'])) ? 'images/profile_image/' . $user['profile_image'] : "images/profile_image/dummy_profile_image.png"; ?>" class="img-thumbnail" alt="profile image">
                    </div>

                    <div class="card-body">
                        <a href="#" class="d-flex justify-content-center mb-3" id="changeProfileImageLink">Change
                            image</a>
                        <div class="card fade-in bg-warning shadow-lg my-3" id="imageUploadSection">
                            <div class="m-3 rounded-3 shadow-lg">
                                <form id="fileUploadForm">
                                    <label for="formFile" class="form-label  p-3 m-0  shadow-lg rounded-top  bg-dark text-white d-flex justify-content-center" id="message"> Upload Image</label>

                                    <div class="input-group">
                                        <!-- <input type="file" class="form-control rounded-0" name="upload_file" id="formFile" aria-describedby="inputGroupFileAddon04" aria-label="Upload"> -->

                                        <input type="file" class="form-control rounded-0" id="fileInput" name="fileInput" accept=".png, .jpg, .jpeg, .svg">
                                        <button type="submit" class="btn btn-primary rounded-0">Upload</button>
                                        <!-- <input type="submit" class="btn btn-primary rounded-0" name="upload" value="Upload" id="uploadFileBtn"> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                        <h2>Welcome, <?= htmlspecialchars($user['username']) ?>!</h2>
                        <p>Email: <?= htmlspecialchars($user['email']) ?></p>


                        <div class="d-flex justify-content-start">
                            <a href="logout.php" class="btn btn-danger">Logout</a>
                        </div>

                    </div>
                </div>
                <!-- https://i.pravatar.cc/300 random image API -->
                <!-- https://robohash.org/mail@ashallendesign.co.uk robot -->

            </div>
            <div class="card col-md-2 d-flex justify-content-center bg-dark text-white" style="transform: rotate(25deg); opacity:0.5; box-shadow: -25px -25px 500px goldenrod; z-index:100;font-family:impact;">
                <!-- <h1 class="py-5 border border-1 px-1 my-2 ">iShop</h1> -->

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

        </div>
    </div>

    <?php

    require_once 'footer.php';
    ?>

    <script src="js/profile.js"></script>