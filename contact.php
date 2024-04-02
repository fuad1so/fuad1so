<?php
$currentPage = 'contact';
require_once 'header.php';
?>

<section class="py-5 brand-stamp">
    <div class="container">
        <h2 class="text-center mb-4 text-white mt-5">Contact us</h2>
        <div class="row">
            <div class="card col-md-2 d-flex justify-content-center bg-dark text-white"
                style="transform: rotate(25deg); opacity:0.5; box-shadow: -25px -25px 500px goldenrod; z-index:100;font-family:impact;">
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

                </p>
            </div>
            <!-- address section  -->
            <div class="col-md-5 p-2">
                <!-- Address  -->
                <div class="card shadow p-5">
                    <img src="images/elatt.png" class="card-img-top border border-1 rounded-3 border-dark shadow-lg"
                        alt="...">
                    <div class="card-body">
                        <address class="mt-2">
                            <h5 class="card-title">London Office</h5>
                            ELATT
                            260 Kingsland Rd,
                            London E8 4DG,
                            United Kingdom
                        </address>

                    </div>
                </div>
            </div>
            <!-- form section   -->
            <div class="col-md-5 p-2">
                <div class="card shadow p-5">
                    <div id="validationAlert" class="alert alert-danger" style="display: none;"></div>
                    <div id="confirmation" class="alert alert-success" style="display: none;">
                        Your message has been sent successfully!
                    </div>
                    <form id="contactForm" method="post">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" placeholder="John Doe" id="name" name="name"
                                    value="<?php echo isset($name) ? $name : ''; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="john@xyz.com" id="email"
                                    name="email" value="<?php echo isset($email) ? $email : ''; ?>">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" placeholder="Enter a subject line" id="subject"
                                    name="subject" value="<?php echo isset($subject) ? $subject : ''; ?>">
                            </div>
                            <div class="col-md-12">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" placeholder="Your message"
                                    rows="5"><?php echo isset($message) ? $message : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="card col-md-12 mt-5 ">
                <!-- Google Map -->
                <div class="card shadow" id="googleMap">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2481.6776829347436!2d-0.07895142337813739!3d51.53747137182009!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761c95df549f8f%3A0xdaef08babe092a09!2sSoda%20Studios%2C%20260%20Kingsland%20Rd%2C%20London%20E8%204DG%2C%20UK!5e0!3m2!1sen!2sbd!4v1701618896735!5m2!1sen!2sbd"
                        width="100%" height="200px" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div>
            </div>

        </div>
    </div>

</section>


<?php
require_once 'footer.php';
?>

<script src="js/contact.js"></script>