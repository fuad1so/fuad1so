<?php
$currentPage = 'profile';
require_once('header.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: user.php");
    exit();
}

// Fetch user details from the database based on the user ID stored in the session

$stmt = $pdo->prepare("SELECT username, email FROM user WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

?>

 
<div class="container-fluid bg-dark p-5">
  <main>
  

    <div class="row bg-dark my-2  d-flex justify-content-center">
 <!-- Payment form section -->
      <div class="card col-md-6 m-4 my-5 p-5 ">
        <form>
          <h4>Payment</h4> 
          <hr class="my-4">
          <div class="my-1">
            <div class="row">
              <div class="col-md-4">
                <div class="form-check">
                  <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                  <label class="form-check-label" for="credit">
                    Credit card </i> <i class="fa-brands fa-cc-mastercard fa-lg" style="color: #033180;" ></i>
                  </label>
                </div>
              </div>
              <div class="col-md-4"> 
                <div class="form-check">
                <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                <label class="form-check-label" for="debit">Debit card <i class="fa-brands fa-cc-visa fa-lg" style="color: #0d47ab;"></i></label>
                </div>
              </div>
              <div class="col-md-4">  
                <div class="form-check">
                <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
                <label class="form-check-label" for="paypal">PayPal <i class="fa-brands fa-cc-paypal fa-lg" style="color: #184aa0;"></i></label>
                </div>
              </div>
            </div>
          </div>
          <hr class="my-4">
          <div class="row">
            <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <label for="cc-name" class="form-label">Name on card</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>

              <div class="col-md-6">
                <label for="cc-number" class="form-label">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
              </div>
            </div>
            </div>

            <div class="col-md-12">
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="cc-expiration" class="form-label">Expiration</label>
                  <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                  <div class="invalid-feedback">
                    Expiration date required
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="cc-cvv" class="form-label">CVV</label>
                  <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                  <div class="invalid-feedback">
                    Security code required
                  </div>
                </div>
              </div>
            </div>
            <button class="w-100 btn btn-primary btn-md my-3" type="submit">Place Order </button>
          </div>
        </form>
      </div>

      
<!-- Mini card section -->
      <div class="card col-md-5 order-md-last bg-success  my-5 p-5">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-light">Your cart</span>
          <span class="badge bg-primary rounded-pill" id="totalItemCountMini">3</span>
        </h4>
        <ul class="list-group mb-3" id="checkoutMiniCartList">

        </ul>

        <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </form>
      </div>


    </div>
  </main>

</div>

<?php
    require_once('footer.php');
?>
<script src="js/checkout.js"></script>