<?php
session_start();
// include header.php file
include ('header.php');
?>

<?php

    /*  include products */
    include ('Template/_products.php');
    /*  include products */

    /*  include top sale section */
    include ('Template/_top-sale.php');
    /*  include top sale section */

    /*  include all products section */
    include ('Template/_all-products.php');
    /*  include all products section */
?>

<?php
// include footer.php file
include ('footer.php');
?>

