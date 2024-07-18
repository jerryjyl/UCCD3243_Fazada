<?php
include("auth.php");
require('database.php');
include("staffHeader.php");

$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $item_type = $_POST['item_type'];
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $item_description = $_POST['item_description'];
    $item_register = date("Y-m-d H:i:s"); // Get the current date and time

    // File Upload Section
    $targetDirectory = "uploads/";
    $targetFileName = $targetDirectory . basename($_FILES["item_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFileName, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["item_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $status = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["item_image"]["size"] > 500000) {
        $status = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $status = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $status = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $targetFileName)) {
            // Insert product details into the database
            $insertQuery = "INSERT INTO product (item_type, item_name, item_price, item_description, item_image, item_register) 
                            VALUES ('$item_type', '$item_name', '$item_price', '$item_description', '$targetFileName', '$item_register')";
            mysqli_query($con, $insertQuery) or die(mysqli_error($con));
            $status = "Product inserted successfully.";
        } else {
            $status = "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert New Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            color: #555;
        }
        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        input[type="file"] {
            cursor: pointer;
        }
        input[type="text"]:focus,
        input[type="file"]:focus,
        textarea:focus {
            outline: none;
            border-color: #66afe9;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .preview-image {
            max-width: 100%;
            margin-top: 10px;
            border-radius: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Insert New Product</h1>
        <form enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="item_type">Item Type:</label>
            <select name="item_type" id="item_type" required>
                <option value="Cable">Cable</option>
                <option value="PowerBank">PowerBank</option>
                <option value="Headphone">Headphone</option>
            </select>
            
            <label for="item_name">Item Name:</label>
            <input type="text" name="item_name" required>
            
            <label for="item_price">Item Price (RM):</label>
            <input type="double" name="item_price" step="0.01" min="0" required>
            
            <label for="item_description">Item Description:</label>
            <textarea name="item_description" rows="4" style="resize: vertical;" required></textarea>
            
            <label for="item_image">Item Image:</label>
            <input type="file" name="item_image" id="item_image" required onchange="previewImage(event)">
            
            <div id="imagePreview"></div>
            
            <div>
            <input type="submit" name="submit" value="Submit">
            <button  class="btn btn-warning" onclick="window.location.href='staffView.php'">Back to View page</button>
            </div>
        </form>
            
        <!-- Display status message (success or other messages) -->
        <p style="color:#008000;"><?php echo $status; ?></p>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('imagePreview');
                output.innerHTML = '<img src="' + reader.result + '" class="preview-image">';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
