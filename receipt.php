<?php
$currentPage = 'receipt';
require_once 'header.php';

if (!isset($_SESSION['user'])) {
    header("Location: user.php");
    exit();
} else {
    $user_id = $_SESSION['user']['user_id'];
    
}

if(isset($_SESSION['last_order_id'])){
    $last_order_id = $_SESSION['last_order_id'];
}

// We delete localstorage cart first

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'confirm_order') {?>
     <!-- We delete localstorage cart -->
        <script>
        cart = [];
        localStorage.setItem('cart', JSON.stringify(cart));
       </script>
    <?php
}
}

// We delete the database cart item  for the user
$deleteSql = "DELETE FROM cart WHERE user_id = ?";
$deleteStmt = $pdo->prepare($deleteSql);
$deleteStmt->execute([$user_id]);

// Now let's take the $last_order_id and use it to print receipt
    $order_details = [];
    $stmt = $pdo->prepare("SELECT DISTINCT `user`.`user_id`,`user`.`username`, `user`.`email`,
    `order_line`.`product_id`, `product`.`product_name`, `product`.`product_price`,`order_line`.`quantity`,
    `order`.`order_id`, `order`.`order_date`
    FROM `user`, `product`, `order`, `order_line` 
    WHERE `order`.`order_id`= `order_line`.`order_id`
    AND `order`.`user_id` = `user`.`user_id`
    AND `order_line`.`product_id`= `product`.`product_id`
    AND `order`.`order_id` = ?;");
    $stmt->execute([$last_order_id]);
    if ($stmt->rowCount() > 0) {
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $order_details[] = $row;
        }
        
    } else {
        $order_details = "no_order_with_id";
    }

$subtotal = 0;
foreach($order_details as $item ){
    $total_amount = get_total($item['quantity'], $item['product_price']);
    $subtotal += $total_amount;
}

$total_after_discount  =  apply_discount($subtotal,10);
$discount_amount = $subtotal - $total_after_discount;
$grand_total = add_vat($total_after_discount,20);
$vat_amount = $grand_total-$total_after_discount;


function get_total($quantity, $price){
    $total_amount = $quantity * $price;
    return $total_amount;
}

function add_vat($total_amount,$percentage){
    $percentage = $percentage /100;
    return $total_amount + ($total_amount * $percentage );
}

function apply_discount($total_amount, $percentage){
    $percentage = $percentage /100;
    return $total_amount - ($total_amount * $percentage );
}


?>

<div class="container my-5">
    <div class="row  my-2  d-flex justify-content-center">
        <!-- Confirm order section -->
        <div class="col-md-12">
            <?php
                if (isset($_GET['action'])):
                    if ($_GET['action'] == "confirm_order"): ?>
                        <div class="alert alert-success my-4 p-3 d-flex justify-content-center fw-bolder">
                            <?="Your order has been placed successfully! <a href='index.php' class='ms-1'> Continue shopping</a>";?>
                        </div>
                        <?php
                    endif;
                endif;
            ?>


        </div>

    </div>
        <!-- Receipt -->

    <div id="printPDF"> <!-- pdf pint area -->
        <div class="row d-flex justify-content-center">
        
            <div class="col-md-12 text-center">
                <h1>Order Receipt</h1>
            </div>
            <div class="col-md-6 ">
                <div class="card shadow">
                 
                        <table class="table table-striped table-hover table-borderless table-primary align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">Customer Details</th>
                                    <th class="text-center">Order Details</th>
                                </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                <tr>
                                    <td>
                                        <p><strong>Name : </strong><?=$item['username'];?></p>
                                        <p><strong>Email: </strong><?=$item['email'];?></p>
                                    </td>
                                    <td> 
                                        <p><strong>Order ID :</strong> <?=$item['order_id'];?></p>
                         
                                        <p><strong>Order Date :</strong> <?=date( 'D, F jS, Y', strtotime( $item['order_date']))?> </p>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <caption class="text-center mt-3" ><h4>Products Details</h4></caption>
                                </tfoot>
                        </table>
                 
                    
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th class="text-center">Price</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- php foreach -->
                        <?php foreach($order_details as $item ):?>
                            <tr>
                                <td class="col-md-9"><em><?=$item['product_name'];?></em></h4></td>
                                <td class="col-md-1 text-center"> <?=$item['quantity'];?></td>
                                <td class="col-md-1 text-center"><?="£".$item['product_price'];?></td>
                                <td class="col-md-1 text-end"><?="£".get_total($item['quantity'],$item['product_price'] )?></td>
                            </tr>
                          
                            <?php endforeach; ?>  
                        <!-- php end foreach   -->
                            <tr>
                                <td class="text-end" colspan="3" >
                                    <p><strong>Subtotal : </strong></p>
                                    <p><strong>10% Discount : </strong></p>
                                    <p><strong>Total before VAT : </strong></p>
                                    <p><strong>VAT 20% : </strong></p>
                                </td>
                                <td class="text-end">
                                    <p><strong><?= "£".round($subtotal,2)?></strong></p>
                                    <p><strong><i class="fa-solid fa-circle-minus" style="color: #f04242;"></i> <?="£".round($discount_amount,2) ;?></strong></p>
                                    <p><strong><?="£".round($total_after_discount,2);?></strong></p>
                                    <p><strong><i class="fa-solid fa-circle-plus" style="color: #36a108;"></i> <?="£".round($vat_amount,2)?></strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-end" colspan="3">
                                <h4><strong>Grand Total: </strong></h4></td>
                                <td class="text-end text-danger"><h4><strong><?="£".round($grand_total,2);?></strong></h4></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end of pdf print area -->
    <div class="row d-flex justify-content-center my-3">
        <div class="col-md-6 d-flex justify-content-end">
            <button type="button" class="btn btn-success btn-lg btn-block" onclick="printDiv('printPDF')">
                        Print PDF
            </button>
        </div>
    </div>
</div>

<script>
    function printDiv(divId) {
     var printContents = document.getElementById("printPDF").innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}
</script>



<?php
require_once 'footer.php';
?>
<script src="js/checkout.js"></script>