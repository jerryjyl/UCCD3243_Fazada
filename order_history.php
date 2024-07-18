<?php 
    // Start session
    session_start();

    // Include database connection
    include_once 'database.php';
    include('header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Order History -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Order History (<?php echo $_SESSION['email']?>)</h2>
                <?php
                // Check if user is logged in
                if (!isset($_SESSION['user_id'])) {
                    // Redirect to login page if not logged in
                    header("Location: login.php");
                    exit();
                }

                // Fetch user's orders from the database
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT * FROM orders WHERE user_id = $user_id";
                $result = mysqli_query($con, $sql);

                // Check if there are any orders
                if (mysqli_num_rows($result) > 0) {
                    // Output order history
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='card mb-4'>";
                        echo "<div class='card-header'>";
                        echo "<h5 class='mb-0'>Order ID: {$row['order_id']}</h5>";
                        echo "</div>";
                        echo "<div class='card-body'>";
                        echo "<p><strong>Order Date & Time:</strong> {$row['orderDate']}</p>";
                        echo "<p><strong>Subtotal:</strong> $" . number_format($row['subtotal'], 2) . "</p>";
                        echo "<p><strong>Delivery Address:</strong> {$row['address']}</p>";
                        echo "<p><strong>Recipient Name:</strong> {$row['recipientName']}</p>";
                        echo "<p><strong>Contact Number:</strong> {$row['phone_no']}</p>";

                        // Fetch items bought in this order
                        $order_id = $row['order_id'];
                        $items_sql = "SELECT od.*, p.item_name, p.item_price, p.item_image 
                                      FROM order_details od 
                                      INNER JOIN product p ON od.item_id = p.item_id 
                                      WHERE od.order_id = $order_id";
                        $items_result = mysqli_query($con, $items_sql);

                        // Check if there are any items in this order
                        if (mysqli_num_rows($items_result) > 0) {
                            // Output items bought
                            while ($item_row = mysqli_fetch_assoc($items_result)) {
                                echo "<div class='row border-top py-3 mt-3'>";
                                echo "<div class='col-sm-2'>";
                                echo "<img src='{$item_row['item_image']}' style='height: 120px;' alt='{$item_row['item_name']}' class='img-fluid'>";
                                echo "</div>";
                                echo "<div class='col-sm-8'>";
                                echo "<h5 class='font-baloo font-size-20'>{$item_row['item_name']}</h5>";
                                echo "<small>Quantity: {$item_row['quantity']}</small>";
                                echo "</div>";
                                echo "<div class='col-sm-2 text-right'>";
                                echo "<div class='font-size-20 text-danger font-baloo'>";
                                echo "$<span class='product_price' data-id='{$item_row['item_id']}'>{$item_row['item_price']}</span>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p>No items found for this order.</p>";
                        }

                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    // No orders found for the user
                    echo "<p>No orders found for this user.</p>";
                }

                // Close database connection
                mysqli_close($con);
                ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('footer.php');?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
