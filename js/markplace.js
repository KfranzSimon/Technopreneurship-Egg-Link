document.addEventListener("DOMContentLoaded", () => {

  const suppliers = [
    {
      name: "Farm Fresh Co.",
      eggType: "Grade A White Eggs",
      rating: 4.8,
      reviews: 124,
      distance: 2.3,
      price: 4.50,
      stock: 250,
      location: "Springfield, IL",
      img: "assets/egg1.jpg"
    },
    {
      name: "Valley Eggs",
      eggType: "Organic Brown Eggs",
      rating: 4.6,
      reviews: 89,
      distance: 3.8,
      price: 5.25,
      stock: 0,
      location: "Green Valley, IL",
      img: "assets/eggs2.jpg"
    }
  ];

  function displaySuppliers(list) {
    const container = document.getElementById("suppliersContainer");
    container.innerHTML = "";
    list.forEach(s => {
      const card = document.createElement("div");
      card.className = "supplier-card";
      const stockStatus = s.stock > 0 ? 
        `<span class="status-pill active-status">Available</span>` : 
        `<span class="status-pill out-status">Out of Stock</span>`;
      card.innerHTML = `
        <img src="${s.img}" alt="${s.name}" class="supplier-img">
        <h3>${s.name}</h3>
        <p>${s.eggType}</p>
        <p>⭐ ${s.rating} (${s.reviews}) • 📍 ${s.distance} km</p>
        <p>Price per tray: $${s.price.toFixed(2)}</p>
        <p>Location: ${s.location}</p>
        ${stockStatus}
        <div style="display:flex; gap: 10px; margin-top:10px;">
          <button onclick="alert('Contacting ${s.name}...')">Contact</button>
          <button onclick="alert('Details for ${s.name}...')">Details</button>
        </div>
      `;
      container.appendChild(card);
    });
  }

  displaySuppliers(suppliers);

  // Search
  const searchInput = document.getElementById("searchInput");
  searchInput.addEventListener("input", () => {
    const query = searchInput.value.toLowerCase();
    const filtered = suppliers.filter(s => 
      s.name.toLowerCase().includes(query) ||
      s.eggType.toLowerCase().includes(query) ||
      s.location.toLowerCase().includes(query)
    );
    displaySuppliers(filtered);
  });

  // Type filters
  const typeButtons = document.querySelectorAll(".type-filter");
  typeButtons.forEach(btn => {
    btn.addEventListener("click", () => {
      const type = btn.getAttribute("data-type");
      let filtered;
      if (type === "all") filtered = suppliers;
      else filtered = suppliers.filter(s => s.eggType.toLowerCase().includes(type));
      displaySuppliers(filtered);
    });
  });

  // Sort
  const sortSelect = document.getElementById("sortSelect");
  sortSelect.addEventListener("change", () => {
    let sorted = [...suppliers];
    if (sortSelect.value === "nearest") {
      sorted.sort((a,b) => a.distance - b.distance);
    } else if (sortSelect.value === "highest") {
      sorted.sort((a,b) => b.rating - a.rating);
    }
    displaySuppliers(sorted);
  });

});