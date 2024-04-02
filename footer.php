    <!-- Modal -->

    <div class="modal fade" id="cart_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="modalTitle">
                        Your Shopping Cart
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <!-- <span aria-hidden="true">&times;</span> -->
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <!-- <h5>Cart</h5> -->
                            <ul id="cart" class="list-group">
                                <!-- Cart items will be displayed here -->
                            </ul>

                        </div>
                    </div>
                    <div class="d-flex justify-content-end my-3">
                        <h5>Total: £<span class="price text-success" id="totalPrice">0.00</span></h5>

                    </div>

                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-danger" id="clearCart">Clear Cart</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="checkout.php" class="btn btn-success" id="btnCheckOut">Checkout</a>
                    <div class="d-flex justify-content-start">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->


    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">
                Copyright &copy; NovelNest.com <?php echo date("Y"); ?></p>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <!-- alertify js -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!-- Core theme JS-->
    <script type="text/javascript">
var user_id = <?php 
            if(isset($_SESSION['user_id'])){
                echo json_encode($_SESSION['user_id']) ;
            } else {
                echo json_encode("") ;
            }
            ?>;
    </script>
    <!-- Notification Script -->
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const notifications = ['Class at 9:30AM', 'Meeting at 2PM', 'Processing your order...'];
    document.getElementById("notificationCount").innerHTML = notifications.length

    const notificationDropdown = document.getElementById('notificationDropdown');

    notifications.forEach((notification, index) => {
        const listItem = document.createElement('li');
        const link = document.createElement('a');
        link.classList.add('dropdown-item');
        link.href = '#'; // You can set the href attribute to a relevant URL if needed
        link.textContent = notification;
        listItem.appendChild(link);
        notificationDropdown.appendChild(listItem);
    });
});
    </script>


    <script src="js/cart.js"></script>

    <!-- <script src="js/form-validation.js"></script> -->

    </body>

    </html>