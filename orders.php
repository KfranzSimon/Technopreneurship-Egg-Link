<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title ">EggLink Orders</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- Sidebar -->
<div class="sidebar">
  <div class="logo-area">
    <img src="assets/logo.png" alt="EggLink Logo" class="logo-img">
    <h1 style="color: black;">EggLink</h1>
  </div>

  <a href="index.php">Dashboard</a>
  <a href="listings.php">Listings</a>
  <a href="marketplace.php">Marketplace</a>
  <a href="messages.php">Messages</a>
  <a class="active" href="orders.php">Orders</a>
  <a href="notifications.php">Notifications</a>
  <a href="settings.php">Settings</a>

  <div class="sidebar-bottom">
    <a href="#" id="logout-btn" class="logout-btn">Logout</a>
  </div>
</div>

<!-- Main content -->
<div class="main">
  <h1>Orders</h1>
  <p>Manage your incoming and completed orders</p>

  <div class="order-stats" style="display:flex; gap:20px; margin-bottom:20px;">
    <div class="order-card">
      <p>Pending Orders</p>
      <h2>3</h2>
    </div>
    <div class="order-card">
      <p>Completed Orders</p>
      <h2>2</h2>
    </div>
    <div class="order-card">
      <p>Total Orders</p>
      <h2>6</h2>
    </div>
    <div class="order-card">
      <p>Total Revenue</p>
      <h2>$438.00</h2>
    </div>
  </div>

  <div class="orders-list">
    <!-- Single order card -->
    <div class="order-item" style="background:#fffdf9; border:1px solid #eee8dd; border-radius:12px; padding:20px; margin-bottom:15px; display:flex; justify-content:space-between; align-items:center;">
      <div>
        <h3>Order ORD-1234 <span class="status-pill active-status" style="font-size:14px; padding:4px 10px;">Pending</span></h3>
        <p>Grade A White Eggs</p>
        <p><strong>Buyer:</strong> Valley Mart</p>
        <p><strong>Order Date:</strong> 5/23/2026</p>
        <p><strong>Delivery Date:</strong> 5/25/2026</p>
        <p><strong>Location:</strong> Springfield, IL</p>
      </div>
      <div style="text-align:right;">
        <p style="font-weight:bold; font-size:18px;">$425.00</p>
        <p>100 trays</p>
        <div style="display:flex; flex-direction:column; gap:5px; margin-top:10px;">
          <button onclick="alert('Order Accepted')" style="background:#8f704f; color:white; border:none; padding:8px 12px; border-radius:8px; cursor:pointer;">Accept Order</button>
          <button onclick="alert('Order Declined')" style="background:white; color:#8f704f; border:1px solid #8f704f; padding:8px 12px; border-radius:8px; cursor:pointer;">Decline</button>
          <button onclick="alert('Viewing Details')" style="background:white; color:#8f704f; border:1px solid #8f704f; padding:8px 12px; border-radius:8px; cursor:pointer;">View Details</button>
        </div>
      </div>
    </div>
    <!-- Additional orders can be cloned similarly -->
  </div>
</div>
<script>
// Logout function for all pages
const logoutBtn = document.getElementById("logout-btn");
    if (logoutBtn) {
        logoutBtn.addEventListener("click", () => {
            // Remove login info from localStorage
            localStorage.removeItem("isLoggedIn");
            localStorage.removeItem("userEmail");
            // Redirect to login page
            window.location.href = "login.php";
            });
    };
</script>
</body>
</html>