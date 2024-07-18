<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Custom CSS file link  -->
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php
        if (isset($_SESSION['email'])) {
            echo "<p>Welcome, " . $_SESSION['email']. "!</p>";
        } else {
            echo "<p>Please log in to proceed with checkout.</p>";
        }
    ?>
    <div class="container">
        <form id="checkout-form" action="handle_checkout.php" method="POST"> 
            <div class="row">
                <div class="col">
                    <h3 class="title">Payment</h3>
                    <div class="inputBox">
                        <span>Cardholder Name :</span>
                        <input type="text" name="card_name" placeholder="John Deo" required>
                    </div>
                    <div class="inputBox">
                        <span>Credit Card Number :</span>
                        <input type="text" name="card_number" placeholder="1111-2222-3333-4444" required>
                    </div>
                    <div class="inputBox">
                        <span>Expiry month :</span>
                        <select name="exp_month" required>
                            <option value="">Select Month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </div>
                    <div class="flex">
                        <div class="inputBox">
                            <span>Expiry year :</span>
                            <select name="exp_year" required>
                                <option value="">Select Year</option>
                                <?php
                                $currentYear = date('Y');
                                for ($i = $currentYear; $i <= $currentYear + 26; $i++) {
                                    echo "<option value=\"$i\">$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="inputBox">
                            <span>CVV :</span>
                            <input type="text" name="cvv" placeholder="123" maxlength="3" required>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit-payment" class="submit-btn">Submit Payment</button>
        </form>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var form = document.getElementById("checkout-form");

        form.addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent default form submission

            // Perform custom validation
            var errors = [];

            // Validate credit card number format
            var cardNumberInput = form.querySelector('input[name="card_number"]');
            var cardNumberRegex = /^\d{4}-\d{4}-\d{4}-\d{4}$/;
            if (!cardNumberRegex.test(cardNumberInput.value)) {
                errors.push("Please input a valid credit card number format (xxxx-xxxx-xxxx-xxxx).");
            }

            // Validate CVV format
            var cvvInput = form.querySelector('input[name="cvv"]');
            var cvvRegex = /^\d{3}$/;
            if (!cvvRegex.test(cvvInput.value)) {
                errors.push("Please input a valid CVV (3 digits).");
            }

            // Display error messages if any
            if (errors.length > 0) {
                alert(errors.join("\n"));
            } else {
                form.submit();
            }
        });
    });
</script>
</body>
</html>