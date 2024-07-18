<?php

// require MySQL Connection
require ('database/DBController.php');

// require Product Class
require ('database/Product.php');

// require Cart Class
require ('database/Cart.php');

// require User Class
require ('database/User.php');

// require Order Class
require ('database/Order.php');

//require Staff Class
require ('database/Staff.php');


// Check if $db is not already defined
if (!isset($db)) {
    // DBController object
    $db = new DBController();
}

if (!isset($product)) {
    // Product object
    global $product;
    $product = new Product($db);
    $product_shuffle = $product->getData();
}

if (!isset($Cart)) {
    // Cart object
    global $Cart;
    $Cart = new Cart($db );
}

if (!isset($user)) {
    // User object
    global $user;
    $user = new User($db);
}

if (!isset($Order)) {
    // Order object
    global $Order;
    $Order = new Order($db);
}

if (!isset($staff)) {
    // Staff object
    global $staff;
    $staff = new Staff($db);
}
