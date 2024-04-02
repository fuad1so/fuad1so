<?php
require_once('db_connection.php');
$session = session_id();

$user_id = "";
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}

$action = $_GET["action"];


if ($action === "get_products") {
    // Step 1: Get products
    $products = [];

    $stmt = $pdo->prepare("SELECT * FROM product");
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $products[] = $row;
        }
    
        echo json_encode($products);
    }

} elseif ($action === "update_cart") {
    // Step 3: Update cart in the database
    $data = file_get_contents("php://input");
    $cart = json_decode($data, true);

//    print_r($cart);

    // Delete existing cart for the user's session
  
    $deleteSql = "DELETE FROM cart WHERE user_id = ?";
    $deleteStmt = $pdo->prepare($deleteSql);
    $deleteStmt->execute([$user_id]);
  

    // Insert the updated cart
    foreach ($cart as $item) {
        $productId = $item["product_id"];
        $quantity = $item["quantity"];
        $insertSql = "INSERT INTO cart (product_id, user_id, quantity, user_session) VALUES (?, ?, ?, ?)";
        $insertStmt = $pdo->prepare($insertSql);
        $insertStmt->execute([$productId, $user_id, $quantity, $session]);
        // $insertStmt->execute();
    }

    echo "Cart updated successfully.";
}  
/*
elseif($action === "get_products_cart"){
    // Step 1: Get products & cart both // not used
    $products_cart = [];
    $sql = "SELECT * FROM products, cart WHERE products.product_id = cart.product_id";
    $result = $pdo->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products_cart[] = $row;
        }
    }
    echo json_encode($products_cart);
} */

elseif($action === "get_previous_cart"){
    // Step 1: Get products & cart
    $previous_cart_product = [];
    $sql = "SELECT cart.product_id,  product.product_name, 
    product.product_price,product.product_image, cart.quantity 
   FROM cart, 
    product WHERE cart.product_id = product.product_id
    AND cart.user_id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);

    if ($stmt->rowCount() > 0) {
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $previous_cart_product[] = $row;
        }
        echo json_encode($previous_cart_product);
    } else {
        echo json_encode("no_cart_in_db");
    }
    
 
}


?>
