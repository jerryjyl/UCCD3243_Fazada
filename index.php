<?php
    
    include ('auth.php');
    ob_start();
    
    // include header.php file
    include ('header.php');
?>

<?php

    /*  include banner area  */
        include ('Template/_banner-area.php');
    /*  include banner area  */

    /*  include top sale section */
        include ('Template/_top-sale.php');
    /*  include top sale section */

    /*  include special price section  */
         include ('Template/_all-products.php');
    /*  include special price section  */
?>


<?php
// include footer.php file
include ('footer.php');
?>