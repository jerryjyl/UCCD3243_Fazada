<?php
    session_start();
    ob_start();
    
    // include header.php file
    include('header.php');
?>

<?php

    /*  include cart items if it is not empty */
        count($product->getData('cart')) ? include ('Template/_cart-template.php') :  include ('Template/notFound/_cart_notFound.php');
    /*  include cart items if it is not empty */

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


