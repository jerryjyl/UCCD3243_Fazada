<?php
//Include authentication check to ensure the user is logged in
include("auth.php");
ob_start();
//Require the 'database.php' file which presumably contains the database connection logic
require('database.php');
include("staffHeader.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Product Records</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 15px;
    }
        .insert-button {
            background-color: #ffc107;
            color: black;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .insert-button:hover {
            background-color: #ffb300;
        }
    table {
        width: 98%;
        border-collapse: collapse;
        margin:20px;
    }
    table th, table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }
    table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    table td img {
        max-width: 100px;
        max-height: 100px;
        vertical-align: middle;
    }
    .edit-delete-links a {
        display: inline-block;
        padding: 5px 10px;
        text-decoration: none;
        background-color: #4CAF50;
        color: white;
        border-radius: 3px;
        margin:1px;
    }
    .edit-delete-links a:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>
<!-- Navigation links for the Home Page, Insert New Product, and Logout -->
<div class="header">
        <h2>View Product Records</h2>
        <button class="insert-button" onclick="window.location.href='staffInsert.php'">Insert New Product</button>
    </div>



<!-- Table to display product records -->
<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Registration Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Initialize count for numbering rows
        $count = 1;
        // SQL query to select all records from the 'product' table ordered by item_id in descending order
        $sel_query = "SELECT * FROM product ORDER BY item_id DESC";
        // Execute the query and get the result set
        $result = mysqli_query($con, $sel_query);
       
        // Loop through each row in the result set
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <!-- Display each row in the table -->
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row["item_name"]; ?></td>
                <td><?php echo $row["item_price"]; ?></td>
                <td><?php echo $row["item_description"]; ?></td>
                <td><img src="<?php echo $row["item_image"]; ?>" alt="Product Image"></td>
                <td><?php echo $row["item_register"]; ?></td>
                <!-- Provide links to update and delete operations with corresponding item_id -->
                <td class="edit-delete-links">
                    <a href="staffUpdate.php?id=<?php echo $row["item_id"]; ?>">Edit</a>
                    <a href="staffDelete.php?id=<?php echo $row["item_id"]; ?>" 
                       onclick="return confirm('Are you sure you want to delete this product record?')">Delete</a>
                </td>
            </tr>
            <?php
            // Increment the count for the next row
            $count++;
        }
        ?>
    </tbody>
</table>
</body>
</html>
