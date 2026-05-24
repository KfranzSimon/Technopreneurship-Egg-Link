<?php
session_start();
include 'php/connection.php';

// Check if user is logged in
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

// Get the listing ID from URL
$id = $_GET['id'] ?? 0;

// Fetch the listing
$stmt = $conn->prepare("SELECT * FROM listings WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$listing = $result->fetch_assoc();

// Handle form submission
if(isset($_POST['update_listing'])){
    $product_name = $_POST['product_name'];
    $egg_type = $_POST['egg_type'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE listings SET product_name=?, egg_type=?, price=?, stock=?, status=? WHERE id=? AND user_id=?");
    $stmt->bind_param("ssdisii", $product_name, $egg_type, $price, $stock, $status, $id, $_SESSION['user_id']);
    $stmt->execute();
    header("Location: listings.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Listing</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="main">
    <h1>Edit Listing</h1>
    <form method="post" style="max-width:400px; display:flex; flex-direction:column; gap:12px;">
        <label>Product Name</label>
        <input type="text" name="product_name" value="<?= htmlspecialchars($listing['product_name']) ?>" required>

        <label>Egg Type</label>
        <input type="text" name="egg_type" value="<?= htmlspecialchars($listing['egg_type']) ?>">

        <label>Price</label>
        <input type="number" step="0.01" name="price" value="<?= $listing['price'] ?>" required>

        <label>Stock</label>
        <input type="number" name="stock" value="<?= $listing['stock'] ?>" required>

        <label>Status</label>
        <select name="status">
            <option value="active" <?= $listing['status']=='active'?'selected':'' ?>>Active</option>
            <option value="paused" <?= $listing['status']=='paused'?'selected':'' ?>>Paused</option>
            <option value="out" <?= $listing['status']=='out'?'selected':'' ?>>Out of Stock</option>
        </select>

        <button type="submit" name="update_listing" style="padding:10px; background:#8f704f; color:white; border:none; border-radius:8px;">Save Changes</button>
        <a href="listings.php" style="padding:10px; display:inline-block; margin-top:8px;">Cancel</a>
    </form>
</div>

</body>
</html>