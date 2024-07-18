<?php
    session_start();
    require_once "database.php";
    require("functions.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['user_id'])) {
        // Check if subtotal is set and not empty
        if(isset($_POST['subtotal']) && !empty($_POST['subtotal'])) {
            // Retrieve user_id and subtotal from session and form data
            $user_id = $_SESSION['user_id'];
            $subtotal = $_POST['subtotal'];

            // Retrieve other form data
            $recipient_name = $_POST['recipient_name'];
            $recipient_phone = $_POST['contact_number'];
            $recipient_email = $_POST['recipient_email'];
            $recipient_address = $_POST['delivery_address'];

            // Get the current date and time
            $order_date = date('Y-m-d H:i:s');

            // Prepare and execute the query
            $query = "INSERT INTO orders (user_id, orderDate, subtotal, address, email, recipientName, phone_no) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($query);
            if (!$stmt) {
                die("Prepare failed: (" . $con->errno . ") " . $con->error);
            }
            $stmt->bind_param("isdssss", $user_id, $order_date, $subtotal, $recipient_address, $recipient_email, $recipient_name, $recipient_phone);
            $result = $stmt->execute();
            if (!$result) {
                die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }
            $stmt->close();

            // Retrieve the most recent order from the orders table
            $query = "SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1";
            $result = $con->query($query);
            if ($result && $result->num_rows > 0) {
                // Fetch the row
                $row = $result->fetch_assoc();
                // Store the relevant order information in the session
                $_SESSION['recent_order'] = $row;
            }

            // Delete cart by userId
            // $Cart->deleteCartByUserId($_SESSION['user_id']);

            // Redirect to checkout after successful insertion
            header("Location: checkout.php");
            exit();
        } else {
            echo "Subtotal is missing or empty.";
        }
    } else {
        echo "Invalid request or user not logged in!";
    }

?>
