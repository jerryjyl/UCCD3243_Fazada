<?php
  session_start();

  function retrieveUsernameId($con, $email) {

    // Prepare and execute the SQL query
    $query = "SELECT `username`, `user_id` FROM `user` WHERE `email` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query was successful and if a row was returned
    if ($result && $result->num_rows > 0) {
        // Fetch the username from the result
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $userId = $row['user_id'];

        // Set the username in the session variable
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $userId;
    }

    // Close the prepared statement and free up resources
    $stmt->close();
  }

  // Function to set cookie for remember me
  function setRememberMeCookie($email, $password) {
    $cookie_email_name = "remember_me_email";
    $cookie_password_name = "remember_me_password";
    // Set cookie for 30 days
    setcookie($cookie_email_name, $email, time() + (30 * 24 * 60 * 60), "/");
    setcookie($cookie_password_name, $password, time() + (30 * 24 * 60 * 60), "/");
  }

  // Function to unset remember me cookies
  function unsetRememberMeCookie() {
    $cookie_email_name = "remember_me_email";
    $cookie_password_name = "remember_me_password";
    // Unset cookies by setting their expiration time to the past
    setcookie($cookie_email_name, "", time() - 3600, "/");
    setcookie($cookie_password_name, "", time() - 3600, "/");
  }

  // Function to check if remember me cookies are set
  function isRememberMeSet() {
    return isset($_COOKIE['remember_me_email']) && isset($_COOKIE['remember_me_password']);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login to FAZADA</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="assets/login/images/icons/favicon.ico">
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

  <?php
    require('header2.php');
    require('database.php');

    if (isset($_POST['email'])){
      $email = stripslashes($_REQUEST['email']);
      $email = mysqli_real_escape_string($con,$email);
      $password = stripslashes($_REQUEST['password']);
      $password = mysqli_real_escape_string($con,$password);

      $query = "SELECT * 
          FROM `user` 
          WHERE email='$email'
          AND password='".md5($password)."'"
          ;
          $result = mysqli_query($con,$query) or die(mysqli_error($con));
          $rows = mysqli_num_rows($result);

        if ($rows==1) {
          // If remember me checkbox is checked, set the remember me cookie
          if (isset($_POST['remember-me'])) {
            setRememberMeCookie($email, $password);
          } else {
            // If remember me checkbox is not checked, unset the remember me cookie
            unsetRememberMeCookie();
          }
        
          retrieveUsernameId($con, $email);
          $_SESSION['email'] = $email;
      
          header("Location: index.php");
          exit();
        } else {
          echo "<div class='form'>
          <h3>Entered username/password is incorrect. Please try again.</h3>
          <br/>Click here to <a href='login.php'>Login</a></div>";
        }
    } else {
      // If remember me cookies are set, pre-fill the email and password fields
      if (isRememberMeSet()) {
        $email = $_COOKIE['remember_me_email'];
        $password = $_COOKIE['remember_me_password'];
        echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                  document.getElementById('emailField').value = '$email';
                  document.getElementById('passwordField').value = '$password';
              });
            </script>";
      }
  ?>

  <body>
    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100 p-t-50 p-b-90">
          <form class="login100-form validate-form flex-sb flex-w" action="" method="post" name="login">
            <span class="login100-form-title p-b-51">Welcome to FAZADA.com!</span>
            <div class="wrap-input100 validate-input m-b-16" data-validate="Email address is required">
              <input id="emailField" class="input100" type="text" name="email" placeholder="Email address" required>
              <span class="focus-input100"></span>
            </div>
            <div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
              <input id="passwordField" class="input100" type="password" name="password" placeholder="Password" required>
              <span class="focus-input100"></span>
            </div>
            <div class="flex-sb-m w-full p-t-3 p-b-24">
              <div class="contact100-form-checkbox">
                <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                <label class="label-checkbox100" for="ckb1">Remember me</label>
              </div>
              <div><a href="registration.php" class="txt1">New to FAZADA? Join us now!</a></div>
            </div>
            <div class="container-login100-form-btn m-t-17"><button class="login100-form-btn" name="submit" type="submit" value="Login">Login to FAZADA</button></div>
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
