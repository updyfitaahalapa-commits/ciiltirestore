// Mobile Menu Toggle
function toggleMobileMenu() {
    const dropdown = document.getElementById('headerDropdown');
    dropdown.classList.toggle('active');
}
// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('headerDropdown');
    const menuBtn = document.querySelector('.mobile-menu-btn');
    
    if (dropdown && dropdown.classList.contains('active')) {
        if (!dropdown.contains(event.target) && !menuBtn.contains(event.target)) {
            dropdown.classList.remove('active');
        }
    }
});

function redirectToLogin(packageId = '') {
    // If not logged in, we send them to login.php first
    // But we want them to go to checkout.php after login
    window.location.href = 'login.php' + (packageId ? '?package=' + packageId : '');
}

function selectPackage(uc) {
    const isCheckoutPage = window.location.pathname.includes('checkout.php');
    
    if (isCheckoutPage) {
        // Just update the dropdown if we are already on the checkout page
        const packageSelect = document.getElementById('package');
        if (packageSelect) {
            packageSelect.value = uc;
        }
    } else {
        // Redirect to checkout if we are on the home page
        window.location.href = 'checkout.php?package=' + uc;
    }
}

// Auto-select package from URL parameter
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const packageId = urlParams.get('package');
    if (packageId) {
        // Delay slightly to ensure elements are ready
        setTimeout(() => {
            selectPackage(packageId);
        }, 500);
    }
});

// Handle Order Form Submission
function handleOrderSubmit(event) {
    event.preventDefault();
    
    const playerId = document.getElementById('playerId').value;
    const packageValue = document.getElementById('package').value;
    const email = document.getElementById('email').value;
    
    // Here you can add PHP/AJAX submission
    console.log('Order Details:', {
        playerId: playerId,
        package: packageValue,
        email: email
    });
    
    // For now, just show an alert
    alert('Order submitted! This would process payment in a real application.\n\nPlayer ID: ' + playerId + '\nPackage: ' + packageValue + ' UC\nEmail: ' + email);
    
    // If you want to submit to PHP, uncomment this:
    // document.getElementById('orderForm').submit();
}

// Smooth Scrolling for Navigation Links
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

// Add animation on scroll (optional)
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe elements with animation class
document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('.package-card, .step');
    
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
});

// Shopping Cart Functionality (basic example)
let cartCount = 0;

function updateCart(action) {
    if (action === 'add') {
        cartCount++;
    } else if (action === 'remove' && cartCount > 0) {
        cartCount--;
    }
    
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = cartCount;
    }
}

// Close mobile menu when clicking outside
document.addEventListener('click', function(event) {
    const mobileNav = document.getElementById('mobileNav');
    const menuBtn = document.querySelector('.mobile-menu-btn');
    
    if (mobileNav && menuBtn) {
        if (!mobileNav.contains(event.target) && !menuBtn.contains(event.target)) {
            mobileNav.classList.remove('active');
        }
    }
});
