<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EggLink Settings</title>
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
  <a href="orders.php">Orders</a>
  <a href="notifications.php">Notifications</a>
  <a class="active" href="settings.php">Settings</a>

  <div class="sidebar-bottom">
    <a href="#" id="logout-btn" class="logout-btn">Logout</a>
  </div>
</div>

<!-- Main content -->
<div class="main">
  <h1>Settings</h1>
  <p>Manage your account settings and preferences</p>

  <div class="settings-page" style="display:flex; gap:20px;">

    <!-- Sidebar for settings tabs -->
    <div class="settings-sidebar" style="flex:1; max-width:200px;">
      <button class="settings-tab active" onclick="showTab('profile')">Profile Settings</button>
      <button class="settings-tab" onclick="showTab('security')">Security</button>
      <button class="settings-tab" onclick="showTab('notifications')">Notifications</button>
      <button class="settings-tab" onclick="showTab('billing')">Billing</button>
    </div>

    <!-- Settings content -->
    <div class="settings-content" style="flex:2; background:#fffdf9; border:1px solid #eee8dd; border-radius:12px; padding:20px;">
      
      <!-- Profile Settings -->
      <div id="profile" class="tab-content">
        <h3>Personal Information</h3>
        <p><strong>Profile Photo</strong></p>
        <div style="display:flex; gap:10px; align-items:center; margin-bottom:10px;">
          <div style="width:60px; height:60px; border-radius:50%; background:#ebe8e2; display:flex; align-items:center; justify-content:center; font-size:24px;">👤</div>
          <button style="background:#8f704f; color:white; border:none; padding:8px 12px; border-radius:8px; cursor:pointer;">Upload Photo</button>
          <button style="background:white; border:1px solid #8f704f; padding:8px 12px; border-radius:8px; cursor:pointer;">Remove</button>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:10px;">
          <input type="text" placeholder="Full Name" value="John Supplier" style="padding:10px; border-radius:8px; border:1px solid #ddd;">
          <input type="text" placeholder="Business Name" value="Farm Fresh Co." style="padding:10px; border-radius:8px; border:1px solid #ddd;">
        </div>
        <input type="email" placeholder="Email Address" value="john@farmfresh.com" style="padding:10px; border-radius:8px; border:1px solid #ddd; width:100%; margin-bottom:10px;">
        <input type="text" placeholder="Phone Number" value="+1 (555) 123-4567" style="padding:10px; border-radius:8px; border:1px solid #ddd; width:100%; margin-bottom:10px;">
        <input type="text" placeholder="Location" value="Springfield, IL" style="padding:10px; border-radius:8px; border:1px solid #ddd; width:100%; margin-bottom:10px;">
        <textarea placeholder="Bio" style="padding:10px; border-radius:8px; border:1px solid #ddd; width:100%; height:100px;">Family-owned farm providing fresh, high-quality eggs for over 20 years.</textarea>
        <div style="margin-top:15px; display:flex; gap:10px;">
          <button style="background:white; border:1px solid #8f704f; border-radius:8px; padding:8px 12px; cursor:pointer;">Cancel</button>
          <button style="background:#8f704f; color:white; border:none; border-radius:8px; padding:8px 12px; cursor:pointer;">Save Changes</button>
        </div>
      </div>

      <!-- Security Tab (hidden by default) -->
      <div id="security" class="tab-content" style="display:none;">
        <h3>Security</h3>
        <p>Change password, enable two-factor authentication, etc.</p>
      </div>

      <!-- Notifications Tab -->
      <div id="notifications" class="tab-content" style="display:none;">
        <h3>Notifications</h3>
        <p>Manage email and push notification preferences.</p>
      </div>

      <!-- Billing Tab -->
      <div id="billing" class="tab-content" style="display:none;">
        <h3>Billing</h3>
        <p>Manage your payment methods and invoices.</p>
      </div>

    </div>

  </div>
</div>

<script>
function showTab(tabId) {
  const tabs = document.querySelectorAll('.tab-content');
  tabs.forEach(tab => tab.style.display = 'none');

  const tabButtons = document.querySelectorAll('.settings-tab');
  tabButtons.forEach(btn => btn.classList.remove('active'));

  document.getElementById(tabId).style.display = 'block';
  event.currentTarget.classList.add('active');
}
</script>
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