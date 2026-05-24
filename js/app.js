// Check login
if(localStorage.getItem("isLoggedIn") !== "true"){
    window.location.href = "login.html";
}

// Display user email
const userEmail = localStorage.getItem("userEmail") || "User";
console.log("Logged in as:", userEmail);

// Dynamic dashboard data
const dashboardData = {
  totalListings: 12,
  listingChange: "+2 this week",
  activeOrders: 8,
  pendingOrders: 3,
  totalRevenue: 2450,
  revenueChange: "+12% from last month",
  totalViews: 342,
  viewsChange: "+18% this week",
  messages: [
    {from: "Fresh Foods Co.", msg: "Inquiry about bulk pricing", time: "1 hour ago", status: "unread"},
    {from: "Valley Mart", msg: "Order confirmation", time: "2 hours ago", status: "read"},
    {from: "Farm Supplies Inc.", msg: "Request for new catalog", time: "3 hours ago", status: "unread"}
  ],
  recentActivity: [
    {text: "New order from Valley Mart - 50 trays of Grade A eggs", status: "pending", time: "5 mins ago"},
    {text: "Message from Fresh Foods Co. - Inquiry about bulk pricing", status: "unread", time: "1 hour ago"},
    {text: 'Listing "Organic Brown Eggs" updated', status: "success", time: "3 hours ago"}
  ]
};

// Update dashboard numbers
document.getElementById("total-listings").querySelector("h2").textContent = dashboardData.totalListings;
document.getElementById("listing-change").textContent = dashboardData.listingChange;
document.getElementById("active-orders").querySelector("h2").textContent = dashboardData.activeOrders;
document.getElementById("orders-pending").textContent = `${dashboardData.pendingOrders} pending`;
document.getElementById("total-revenue").querySelector("h2").textContent = `$${dashboardData.totalRevenue}`;
document.getElementById("revenue-change").textContent = dashboardData.revenueChange;
document.getElementById("total-views").querySelector("h2").textContent = dashboardData.totalViews;
document.getElementById("views-change").textContent = dashboardData.viewsChange;

// Notification counters
document.getElementById("msg-count").textContent = dashboardData.messages.filter(m => m.status==="unread").length;
document.getElementById("order-count").textContent = dashboardData.activeOrders;
document.getElementById("notif-count").textContent = dashboardData.recentActivity.length;

// Populate recent activity feed
const activityFeed = document.getElementById("activity-feed");
dashboardData.recentActivity.forEach(item => {
  const div = document.createElement("div");
  div.classList.add("activity-item");
  div.innerHTML = `<span>${item.text} (${item.time})</span><span class="status">${item.status}</span>`;
  activityFeed.appendChild(div);
});

// Messages dropdown
const messagesBtn = document.getElementById("messages-btn");
messagesBtn.addEventListener("click", () => {
  let dropdown = document.getElementById("messages-dropdown");
  if (!dropdown) {
    dropdown = document.createElement("div");
    dropdown.id = "messages-dropdown";
    dashboardData.messages.forEach(m => {
      const mDiv = document.createElement("div");
      mDiv.style.padding = "5px 0";
      mDiv.innerHTML = `<strong>${m.from}:</strong> ${m.msg} <em style="font-size:10px;">(${m.time})</em>`;
      dropdown.appendChild(mDiv);
    });
    document.body.appendChild(dropdown);
  }
  dropdown.style.display = dropdown.style.display==="block" ? "none" : "block";
  dropdown.style.top = messagesBtn.getBoundingClientRect().bottom + 5 + "px";
  dropdown.style.left = messagesBtn.getBoundingClientRect().left + "px";
});

const logoutBtn = document.getElementById("logout-btn");
if (logoutBtn) {
  logoutBtn.addEventListener("click", () => {
    localStorage.removeItem("isLoggedIn");
    localStorage.removeItem("userEmail");
    window.location.href = "login.html";
  });
}

// Example JS function to switch page content
function showPage(pageId) {
  const pages = ['dashboard', 'listings', 'marketplace', 'messages', 'orders', 'notifications'];
  pages.forEach(id => {
    document.getElementById(id).style.display = (id === pageId) ? 'block' : 'none';
  });
}

// Example: link clicks

