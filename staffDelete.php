<?php
// Require the 'database.php' file which presumably contains the database connection logic
require('database.php');


// Check if the 'id' parameter is provided in the GET request
if(isset($_GET['id'])) {
    // Get the 'id' parameter from the GET request
    $id = $_GET['id'];

    // Query to delete the product record with the given 'id'
    $query = "DELETE FROM product WHERE item_id=$id";

    // Execute the delete query, and handle any errors
    if($con) {
        $result = mysqli_query($con, $query);
        if($result) {
            $status = "Product deleted successfully.";
        } else {
            $status = "Error deleting product: " . mysqli_error($con);
        }
    } else {
        $status = "Database connection error.";
    }
} else {
    // If 'id' parameter is not provided in the GET request
    $status = "Product ID not provided.";
}

// Redirect to the 'view.php' page after deletion, regardless of success or failure
header("Location: staffView.php?status=" . urlencode($status));
exit();
?>
