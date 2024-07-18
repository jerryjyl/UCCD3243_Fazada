<?php
// Include authentication check to ensure the user is logged in
include("auth.php");
// Require the 'database.php' file which presumably contains the database connection logic
require('database.php');
include("staffHeader.php");

$status = "";

// Check if the form has been submitted
if(isset($_POST['update'])) {
    // Get data from the form
    $item_id = $_POST['item_id'];
    $item_type = $_POST['item_type'];
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $item_description = $_POST['item_description'];
    $item_image = $_POST['item_image'];
    $item_register = $_POST['item_register'];

    // Update the product record in the database
    $update = "UPDATE product SET 
               item_type='".$item_type."',
               item_name='".$item_name."', 
               item_price='".$item_price."', 
               item_description='".$item_description."',
               item_image='".$item_image."', 
               item_register='".$item_register."' 
               WHERE item_id='".$item_id."'";

    // Execute the update query, and handle any errors
    mysqli_query($con, $update) or die(mysqli_error($con));

    // Set a success message for display on the page
    $status = "Product Record Updated Successfully. </br></br>
               <a href='staffView.php'>View Updated Record</a>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Product Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border: 3px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        img {
            max-width: 200px;
            max-height: 200px;
            margin-bottom: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h1>Update Product Record</h1>

    <?php
    if(isset($_GET['id'])) {
        $item_id = $_GET['id'];
        $query = "SELECT * FROM product WHERE item_id='".$item_id."'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
    ?>
    <form name="form" method="post" action="">
        <input type="hidden" name="update" value="1" />
        <input name="item_id" type="hidden" value="<?php echo $row['item_id'];?>" />
        
        <!-- Limit item type options -->
        <p>
            <select name="item_type" required>
                <option value="Cable" <?php if($row['item_type'] == 'Cable') echo 'selected'; ?>>Cable</option>
                <option value="PowerBank" <?php if($row['item_type'] == 'PowerBank') echo 'selected'; ?>>PowerBank</option>
                <option value="Headphone" <?php if($row['item_type'] == 'Headphone') echo 'selected'; ?>>Headphone</option>
            </select>
        </p>
        
        <!-- Int input with RM format for price -->
        <p><input type="text" name="item_name" placeholder="Update Item Name" required value="<?php echo $row['item_name'];?>" /></p>
        <p><input type="text" name="item_price" placeholder="Update Item Price (RM)" pattern="[0-9]+(\.[0-9]{2})?" required value="<?php echo $row['item_price'];?>" /></p>
        
        <!-- Flexible textarea for item description -->
        <p><textarea name="item_description" placeholder="Update Item Description" required><?php echo $row['item_description'];?></textarea></p>
        
        <!-- Display image preview -->
        <p><input type="file" name="item_image" id="item_image" onchange="previewImage(event)" /></p>
        <p>
            <img id="itemImagePreview" src="<?php echo $row['item_image'];?>" alt="Item Image Preview" />
        </p>
        
        <!-- Hidden field for current item image -->
        <input type="hidden" name="item_image" value="<?php echo $row['item_image'];?>" />
        
        <!-- Hidden field for item registration date -->
        <input type="hidden" name="item_register" value="<?php echo $row['item_register'];?>" />
        
        <div class="form-group">
            <input type="submit" value="Update">
        </div>

        <?php 
        } else {
            echo "Product record not found.";
        }
    } else {
        echo "Item ID not provided.";
    }
    ?>

    <?php
    if (!empty($status)) {
        echo "<p>$status</p>";
    }
    ?>
    </form>
   

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('itemImagePreview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
