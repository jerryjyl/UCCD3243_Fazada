<?php
session_start();
require_once "database.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['email'])) {
    // Fetch the order_id from the database
    $query_order_id = "SELECT MAX(order_id) AS max_order_id FROM orders"; // Assuming order_id is an auto-incremented primary key
    $result_order_id = $con->query($query_order_id);
    if ($result_order_id && $row_order_id = $result_order_id->fetch_assoc()) {
        $order_id = $row_order_id['max_order_id'];
    } else {
        die("Failed to fetch order_id from database.");
    }

    $card_name = $_POST['card_name'];
    $card_number = $_POST['card_number'];
    $exp_month = $_POST['exp_month'];
    $exp_year = $_POST['exp_year'];
    $cvv = $_POST['cvv'];

    $query_payment = "INSERT INTO payment (order_id, card_name, card_number, card_exp_month, card_exp_year, cvv) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_payment = $con->prepare($query_payment);
    if (!$stmt_payment) {
        die("Prepare failed: (" . $con->errno . ") " . $con->error);
    }
    $stmt_payment->bind_param("isssis", $order_id, $card_name, $card_number, $exp_month, $exp_year, $cvv);
    $result_payment = $stmt_payment->execute();
    if (!$result_payment) {
        die("Execute failed: (" . $stmt_payment->errno . ") " . $stmt_payment->error);
    }
    $stmt_payment->close();

    // Insert cart item details into each order
    if (isset($_SESSION['recent_order']) && isset($_SESSION['user_id'])) {
        // Retrieve order_id from $_SESSION['recent_order'] and user_id from $_SESSION['user_id']
        $order_id = $_SESSION['recent_order']['order_id'];
        $user_id = $_SESSION['user_id'];
    
        // Retrieve items purchased by the user from the cart table
        $query_cart = "SELECT * FROM `cart` WHERE user_id = ?";
        $stmt_cart = $con->prepare($query_cart);
        $stmt_cart->bind_param("i", $user_id);
        $stmt_cart->execute();
        $result_cart = $stmt_cart->get_result();
    
        // Insert records into the order_details table
        while ($row_cart = $result_cart->fetch_assoc()) {
            $item_id = $row_cart['item_id'];
    
            // Retrieve unitPrice from the product table
            $query_product = "SELECT item_price FROM `product` WHERE item_id = ?";
            $stmt_product = $con->prepare($query_product);
            $stmt_product->bind_param("i", $item_id);
            $stmt_product->execute();
            $result_product = $stmt_product->get_result();
            $row_product = $result_product->fetch_assoc();
    
            $quantity = 1; // Assuming quantity is always 1 for each item
            $unitPrice = $row_product['item_price'];
    
            // Insert record into order_details table
            $query_insert = "INSERT INTO order_details (order_id, item_id, quantity, unitPrice, user_id) VALUES (?, ?, ?, ?, ?)";
            $stmt_insert = $con->prepare($query_insert);
            $stmt_insert->bind_param("iiidi", $order_id, $item_id, $quantity, $unitPrice, $user_id);
            $stmt_insert->execute();
        }
    } else echo "Error: Order information not found in session.";

    // Now clear the cart items associated with the user
    $user_id = $_SESSION['user_id'];
    $query_clear_cart = "DELETE FROM cart WHERE user_id = ?";
    $stmt_clear_cart = $con->prepare($query_clear_cart);
    if (!$stmt_clear_cart) {
        die("Prepare failed: (" . $con->errno . ") " . $con->error);
    }
    $stmt_clear_cart->bind_param("i", $user_id);
    $result_clear_cart = $stmt_clear_cart->execute();
    if (!$result_clear_cart) {
        die("Execute failed: (" . $stmt_clear_cart->errno . ") " . $stmt_clear_cart->error);
    }
    $stmt_clear_cart->close();

    echo "<script>alert('Payment successful! Your order has been placed. Please allow 1-2 days time for us to verify your payment.');
        window.location.href='index.php';</script>";
    exit();
    
} else {
    echo "Invalid request or user not logged in!";
}
?>
