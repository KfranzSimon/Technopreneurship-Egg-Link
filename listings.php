<?php
 include 'php/connection.php';
 $querry = "SELECT * FROM listings";
 $result = mysqli_query($conn, $querry);


 $sql_total = "SELECT SUM(total_revenue) as total FROM listings";
 $result_total = mysqli_query($conn, $sql_total);
 $row_total = mysqli_fetch_assoc($result_total);
 $total_revenue = $row_total['total'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EggLink Listings</title>
<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="sidebar">
  <div class="logo-area">
    <img src="assets/logo.png" alt="EggLink Logo" class="logo-img">
    <h1 style="color: black;">EggLink</h1>
  </div>

  <a href="Index.php">Dashboard</a>
  <a class="active" href="listings.php">Listings</a>
  <a href="marketplace.php">Marketplace</a>
  <a href="messages.php">Messages <span id="msg-count">0</span></a>
  <a href="orders.php">Orders <span id="order-count">0</span></a>
  <a href="notifications.php">Notifications <span id="notif-count">0</span></a>
  <a href="settings.php">Settings</a>
  <a href="#" id="logout-btn" class="logout-btn">Logout</a>
</div>

<div class="main listings-page">

  <div class="page-header">
    <div>
      <h1>My Listings</h1>
      <p>Manage your egg supply listings</p>
    </div>

    <a href="create_listing.php" style="text-decoration: none" class="create-listing-btn" id="create-listing-btn">
      <span>+</span> Create Listing
    </a>
  </div>

  <div class="listing-stats">
    <div class="listing-stat-card">
      <p>Active Listings</p>
      <h2>2</h2>
    </div>

    <div class="listing-stat-card">
      <p>Total Views</p>
      <h2>371</h2>
    </div>

    <div class="listing-stat-card">
      <p>Total Orders</p>
      <h2>28</h2>
    </div>

    <div class="listing-stat-card">
      <p>Total Revenue</p>
      <h2>$<?= number_format($total_revenue, 2) ?></h2>
    </div>
  </div>

  <div class="listing-filters">
    <button class="filter-btn active" data-filter="all">All</button>
    <button class="filter-btn" data-filter="active">Active</button>
    <button class="filter-btn" data-filter="paused">Paused</button>
    <button class="filter-btn" data-filter="out">Out of Stock</button>
  </div>

  <div class="listing-table-card">
    <table class="listing-table">
      <thead>
        <tr>
          <th>Product</th>
          <th>Price</th>
          <th>Stock</th>
          <th>Status</th>
          <th>Performance</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody>
        <?php while($data = mysqli_fetch_assoc($result)){ ?>
        <tr data-status="<?= htmlspecialchars($data['status']) ?>">
          <td>
            <div class="product-info">
              <div class="egg-img egg-white"></div>
              <div>
                <h3><?= htmlspecialchars($data['product_name']) ?></h3>
                <p>ID: <?= htmlspecialchars($data['id']) ?></p>
              </div>
            </div>
          </td>

          <td>
            <h3>$<?= htmlspecialchars($data['price'], 2) ?></h3>
            <p>per tray</p>
          </td>

          <td>
            <h3><?= htmlspecialchars($data['stock']) ?> trays</h3>
          </td>

          <td>
            <?php 
            $statusclass = '';
            if($data['status'] == 'active')$statusclass = "active_status";
            elseif($data['status'] == 'paused')$statusclass = "paused_status";
            elseif($data['status'] == 'out')$statusclass = "out_status";
            ?>
            <span class="status-pill <?= $statusclass ?>">● <?= $data['status']; ?></span>
          </td>

          <td>
            <p>👁 <?= htmlspecialchars($data['total_views']) ?> views</p>
            <p>↗ $<?= htmlspecialchars($data['total_revenue']) ?> revenue</p>
          </td>

          <td>
            <div class="table-actions">
              <a href="edit_listing.php?id=<?= $data['id']; ?>" title="Edit">✎</a>
              <a href="toggle_listing.php?id=<?= $data['id']; ?>" title="Pause/Resume">⏻</a>
              <a href="delete_listing.php?id=<?= $data['id']; ?>" class="delete-action" title="Delete">🗑</a>
            </div>
          </td>
        </tr>
        <?php }?>
      </tbody>
    </table>
  </div>

</div>

<script src="js/app.js"></script>
</body>
</html>