// Initialize and add the map
function initMap() {
    // The location of Uluru
    var russia = { lat: 3.51602, lng: -2.1969 };
    // The map, centered at Uluru
    var map = new google.maps.Map(
        document.getElementById('map'), { zoom: 20, center: russia });
    // The marker, positioned at Uluru
    var marker = new google.maps.Marker({ position: russia, map: map });
}


// toggle menu
var MenuItems = document.getElementById("menu-items");

MenuItems.style.maxHeight = "0px";

function menutoggle(){
    if(MenuItems.style.maxHeight == "0"){
        MenuItems.style.maxHeight = "200px";
    } else {
        MenuItems.style.maxHeight = "0px";
    }
}

// script.js

function searchProducts() {
    // Get the search term from the input field
    let searchTerm = document.getElementById('searchInput').value.toLowerCase();
    
    // Get all product items
    let products = document.querySelectorAll('.product-item');
    
    // Loop through all products and check if the name matches the search term
    products.forEach(function(product) {
        let productName = product.getAttribute('data-name').toLowerCase();
        
        // If the product name contains the search term, show it, otherwise hide it
        if (productName.includes(searchTerm)) {
            product.style.display = 'block';  // Show the product
        } else {
            product.style.display = 'none';  // Hide the product
        }
    });
}


