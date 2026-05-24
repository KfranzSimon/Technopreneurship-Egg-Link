// ===============================
// DASHBOARD & LISTINGS JS
// ===============================

// Check login
if(localStorage.getItem("isLoggedIn") !== "true"){
    window.location.href = "login.html";
}

// Display user email (optional, console log only)
const userEmail = localStorage.getItem("userEmail") || "User";
console.log("Logged in as:", userEmail);

// Dashboard data (for Index.html)
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

// Safely update dashboard numbers if on Index.html
if (document.getElementById("total-listings")) {
  document.getElementById("total-listings").querySelector("h2").textContent = dashboardData.totalListings;
  document.getElementById("listing-change").textContent = dashboardData.listingChange;
  document.getElementById("active-orders").querySelector("h2").textContent = dashboardData.activeOrders;
  document.getElementById("orders-pending").textContent = `${dashboardData.pendingOrders} pending`;
  document.getElementById("total-revenue").querySelector("h2").textContent = `$${dashboardData.totalRevenue}`;
  document.getElementById("revenue-change").textContent = dashboardData.revenueChange;
  document.getElementById("total-views").querySelector("h2").textContent = dashboardData.totalViews;
  document.getElementById("views-change").textContent = dashboardData.viewsChange;
}

// Safely populate recent activity feed
const activityFeed = document.getElementById("activity-feed");
if (activityFeed) {
  dashboardData.recentActivity.forEach(item => {
    const div = document.createElement("div");
    div.classList.add("activity-item");
    div.innerHTML = `<span>${item.text} (${item.time})</span><span class="status">${item.status}</span>`;
    activityFeed.appendChild(div);
  });
}

// Safely set up messages dropdown
const messagesBtn = document.getElementById("messages-btn");
if (messagesBtn) {
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

    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    dropdown.style.top = messagesBtn.getBoundingClientRect().bottom + 5 + "px";
    dropdown.style.left = messagesBtn.getBoundingClientRect().left + "px";
  });
}

// Logout button
const logoutBtn = document.getElementById("logout-btn");
if (logoutBtn) {
  logoutBtn.addEventListener("click", () => {
    localStorage.removeItem("isLoggedIn");
    localStorage.removeItem("userEmail");
    window.location.href = "login.html";
  });
}

// ===============================
// LISTINGS PAGE FUNCTIONS
// ===============================

const filterButtons = document.querySelectorAll(".filter-btn");
const listingRows = document.querySelectorAll(".listing-table tbody tr");

// Filter listings
filterButtons.forEach(button => {
  button.addEventListener("click", () => {
    filterButtons.forEach(btn => btn.classList.remove("active"));
    button.classList.add("active");

    const filter = button.getAttribute("data-filter");

    listingRows.forEach(row => {
      const status = row.getAttribute("data-status");

      if (filter === "all" || filter === status) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
});

// Update listing stats
function updateListingStats() {
  const rows = document.querySelectorAll(".listing-table tbody tr");

  let activeCount = 0;
  let totalViews = 0;
  let totalRevenue = 0;

  rows.forEach(row => {
    const status = row.getAttribute("data-status");

    if (status === "active") {
      activeCount++;
    }

    const performanceText = row.children[4].innerText;

    const viewsMatch = performanceText.match(/(\d+)\sviews/);
    const revenueMatch = performanceText.match(/\$([\d.]+)/);

    if (viewsMatch) {
      totalViews += Number(viewsMatch[1]);
    }

    if (revenueMatch) {
      totalRevenue += Number(revenueMatch[1]);
    }
  });

  const statCards = document.querySelectorAll(".listing-stat-card h2");

  if (statCards.length >= 4) {
    statCards[0].textContent = activeCount;
    statCards[1].textContent = totalViews;
    statCards[2].textContent = rows.length;
    statCards[3].textContent = "$" + totalRevenue.toFixed(2);
  }
}

// Edit listing
function editListing(row) {
  const productName = row.querySelector(".product-info h3").textContent;
  const currentPrice = row.children[1].querySelector("h3").textContent.replace("$", "");
  const currentStock = row.children[2].querySelector("h3").textContent.replace(" trays", "");

  const newName = prompt("Edit product name:", productName);
  const newPrice = prompt("Edit price:", currentPrice);
  const newStock = prompt("Edit stock:", currentStock);

  if (newName && newPrice && newStock !== null) {
    row.querySelector(".product-info h3").textContent = newName;
    row.children[1].querySelector("h3").textContent = "$" + Number(newPrice).toFixed(2);
    row.children[2].querySelector("h3").textContent = newStock + " trays";

    if (Number(newStock) <= 0) {
      setListingStatus(row, "out");
    }

    updateListingStats();
  }
}

// Pause or resume listing
function toggleListingStatus(row, button) {
  const currentStatus = row.getAttribute("data-status");

  if (currentStatus === "active") {
    setListingStatus(row, "paused");
    button.title = "Resume";
  } else if (currentStatus === "paused") {
    setListingStatus(row, "active");
    button.title = "Pause";
  } else if (currentStatus === "out") {
    alert("This listing is out of stock. Add stock first before activating it.");
  }

  updateListingStats();
}

// Set listing status
function setListingStatus(row, status) {
  const statusPill = row.querySelector(".status-pill");

  row.setAttribute("data-status", status);

  statusPill.className = "status-pill";

  if (status === "active") {
    statusPill.classList.add("active-status");
    statusPill.textContent = "● active";
  } else if (status === "paused") {
    statusPill.classList.add("paused-status");
    statusPill.textContent = "● paused";
  } else if (status === "out") {
    statusPill.classList.add("out-status");
    statusPill.textContent = "● out of stock";
  }
}

// Delete listing
function deleteListing(row) {
  const productName = row.querySelector(".product-info h3").textContent;

  const confirmDelete = confirm(`Are you sure you want to delete "${productName}"?`);

  if (confirmDelete) {
    row.remove();
    updateListingStats();
  }
}

// Make action buttons work
document.querySelectorAll(".listing-table tbody tr").forEach(row => {
  const buttons = row.querySelectorAll(".table-actions button");

  const editBtn = buttons[0];
  const pauseBtn = buttons[1];
  const deleteBtn = buttons[2];

  editBtn.addEventListener("click", () => {
    editListing(row);
  });

  pauseBtn.addEventListener("click", () => {
    toggleListingStatus(row, pauseBtn);
  });

  deleteBtn.addEventListener("click", () => {
    deleteListing(row);
  });
});

// Create listing button
const createListingBtn = document.getElementById("create-listing-btn");

if (createListingBtn) {
  createListingBtn.addEventListener("click", () => {
    alert("Create Listing form will open here.");
  });
}

updateListingStats();