<?php
session_start();

include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Checkout</title>
    <style>
        /* CSS for formatting the message */
        .message {
            font-size: 24px;
            font-weight: bold;
            color: #000000;
            margin-top: 20px; 
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
        if (!isset($_SESSION['email'])) {
            echo "<p>Please log in to proceed with the order.</p>";
            exit(); // Exit if user is not logged in
        }
    ?>

    <div class="container py-5">
        <div class="message">
            <?php if (isset($_SESSION['email'])) echo $_SESSION['email'] ?>, you're one step away from securing your order!
        </div>

        <section id="order-information" class="py-3 mb-5">
            <div class="container-fluid w-75">
                <h5 class="font-baloo font-size-20">Order Information</h5>
                <form id="order-form" action="handle_order.php" method="POST" onsubmit="return validateForm()"> 
                    <div class="row border-top py-3 mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient_name">Full Name of Recipient</label>
                                <input type="text" class="form-control" id="recipient_name" 
                                name="recipient_name" placeholder="John Doe" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient_email">Recipient's Email Address</label>
                                <input type="email" class="form-control" id="recipient_email" 
                                name="recipient_email" placeholder="johndoe33567@xymail.com" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_no">Contact Number</label>
                                <input type="text" class="form-control" id="contact_no" 
                                name="contact_number" placeholder="012-3456789" required>
                            </div>
                            <div class="form-group">
                                <label for="delivery_address">Delivery Address</label>
                                <input type="text" class="form-control" id="delivery_address" 
                                name="delivery_address" placeholder="22-3A-02, Jalan Pelangi, 12345 Skudai, Johor" required>
                            </div>
                            <!-- Hidden input field to pass subtotal to handle_order.php -->
                            <input type="hidden" name="subtotal" value="<?php echo isset($_POST['subtotal']) ? $_POST['subtotal'] : 0; ?>">
                        </div>
                    </div>
                    <button type="submit" name="place-order" class="submit-btn">Place Order</button>
                </form>
            </div>
        </section>
    </div>

    <?php
        include ('footer.php');
    ?>

    <script>
        function validateForm() {
            var phoneInput = document.getElementById('contact_no');
            var phoneRegex = /^\d{3}-\d{7}$|^\d{3}-\d{8}$/; // xxx-xxxxxxx or xxx-xxxxxxxx format
            if (!phoneRegex.test(phoneInput.value)) {
                alert("Please enter a valid phone number in the format xxx-xxxxxxx or xxx-xxxxxxxx.");
                return false;
            }

            var emailInput = document.getElementById('recipient_email');
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Email format regex
            if (!emailRegex.test(emailInput.value)) {
                alert("Please enter a valid email address.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>

