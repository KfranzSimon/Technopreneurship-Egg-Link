<?php
session_start();
include 'php/connection.php';

// Check if user is logged in
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$error = '';
$success = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $product_name = $_POST['product_name'];
    $egg_type = $_POST['egg_type'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $status = $_POST['status'];
    $user_id = $_SESSION['user_id'];

    if($product_name != '' && $price != '' && $stock != ''){
        $stmt = $conn->prepare("INSERT INTO listings (user_id, product_name, egg_type, price, stock, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdis", $user_id, $product_name, $egg_type, $price, $stock, $status);
        if($stmt->execute()){
            $success = "Listing created successfully!";
        } else {
            $error = "Error inserting listing: " . $conn->error;
        }
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Listing</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="main" style="padding:40px;">
    <h1>Create New Listing</h1>
    <?php if($error){ echo "<p style='color:red;'>$error</p>"; } ?>
    <?php if($success){ echo "<p style='color:green;'>$success</p>"; } ?>

    <form method="post" style="max-width:400px; display:flex; flex-direction:column; gap:12px;">
        <label>Product Name</label>
        <input type="text" name="product_name" required>

        <label>Egg Type</label>
        <input type="text" name="egg_type">

        <label>Price per tray</label>
        <input type="number" step="0.01" name="price" required>

        <label>Stock (number of trays)</label>
        <input type="number" name="stock" required>

        <label>Status</label>
        <select name="status" required>
            <option value="active">Active</option>
            <option value="paused">Paused</option>
            <option value="out">Out of Stock</option>
        </select>

        <button type="submit" style="padding:10px; background:#8f704f; color:white; border:none; border-radius:8px; cursor:pointer;">Create Listing</button>
        <a href="listings.php" style="margin-top:8px; display:inline-block;">Cancel</a>
    </form>
</div>

</body>
</html>