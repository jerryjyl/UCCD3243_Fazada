<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Join FAZADA Now!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="assets/login/images/icons/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="assets/login/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
        <link rel="stylesheet" type="text/css" href="assets/login/vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="assets/login/vendor/css-hamburgers/hamburgers.min.css">
        <link rel="stylesheet" type="text/css" href="assets/login/vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" type="text/css" href="assets/login/vendor/select2/select2.min.css">
        <link rel="stylesheet" type="text/css" href="assets/login/vendor/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" type="text/css" href="assets/login/css/util.css">
        <link rel="stylesheet" type="text/css" href="assets/login/css/main.css">
        <meta name="robots" content="noindex, follow">
    </head>

    <body>
        <?php
            require('database.php');
            require('header2.php');

            if(isset($_POST['submit'])) {
                $email = stripslashes($_POST['email']);
                $email = mysqli_real_escape_string($con, $email); 
                $username = stripslashes($_POST['username']);
                $username = mysqli_real_escape_string($con, $username);
                $password = stripslashes($_POST['password']);
                $password = mysqli_real_escape_string($con, $password);
                $register_date = date("Y-m-d H:i:s");

                // Check if the email or username already exists in the database
                $query = "SELECT * FROM `user` WHERE email = '$email' OR username = '$username'";
                $result = mysqli_query($con, $query);
                $rows = mysqli_num_rows($result);

                if($rows > 0) {
                    // Email or username already exists, deny registration
                    echo "<div class='form'>
                        <h3>Registration failed. Email or username already exists.</h3>
                        <br/>Click here to <a href='login.php'>Login</a></div>";
                } else {
                    // Email and username do not exist, proceed with registration
                    $query = "INSERT INTO `user` (username, password, email, register_date)
                            VALUES ('$username', '".md5($password)."', '$email', '$register_date')";
                    $result = mysqli_query($con, $query);

                    if($result) {
                        // Registration successful
                        echo "<div class='form'>
                            <h3>You are registered successfully.</h3>
                            <br/>Click here to <a href='login.php'>Login</a></div>";
                    } else {
                        // Registration failed due to database error
                        echo "<div class='form'>
                            <h3>Registration failed due to a database error. Please try again later.</h3>
                            <br/>Click here to <a href='login.php'>Login</a></div>";
                    }
                }
            } else { 
        ?>

        <!-- HTML registration form -->
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100 p-t-50 p-b-90">
                    <form class="login100-form validate-form flex-sb flex-w" name="registration" action="" method="post">
                        <span class="login100-form-title p-b-51">Be a part of FAZADA!</span>
                        <div class="wrap-input100 validate-input m-b-16" data-validate="Username is required">
                            <input class="input100" type="text" name="username" placeholder="Username" required>
                            <span class="focus-input100"></span>
                        </div>
                        <div class="wrap-input100 validate-input m-b-16" data-validate="Email address is required">
                            <input class="input100" type="text" name="email" placeholder="Email address" required>
                            <span class="focus-input100"></span>
                        </div>
                        <div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
                            <input class="input100" type="password" name="password" placeholder="Password" required>
                            <span class="focus-input100"></span>
                        </div>
                        <div><a href="login.php" class="txt1">Already have an account?</a></div>
                        </div>
                        <div class="container-login100-form-btn m-t-17">
                            <button class="login100-form-btn" name="submit" type="submit" value="Register Now">Register Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="dropDownSelect1"></div>

        <script src="assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
        <script src="assets/login/vendor/animsition/js/animsition.min.js"></script>
        <script src="assets/login/vendor/bootstrap/js/popper.js"></script>
        <script src="assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/login/vendor/select2/select2.min.js"></script>
        <script src="assets/login/vendor/daterangepicker/moment.min.js"></script>
        <script src="assets/login/vendor/daterangepicker/daterangepicker.js"></script>
        <script src="assets/login/vendor/countdowntime/countdowntime.js"></script>
        <script src="assets/login/js/main.js"></script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-23581568-13');
        </script>
    </body>
<?php } ?>
</html>