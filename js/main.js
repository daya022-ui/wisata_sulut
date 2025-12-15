// main.js - Utility Functions

const API_BASE = './api/';

// Toast Notification
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'slideInUp 0.4s ease-out reverse';
        setTimeout(() => toast.remove(), 400);
    }, 3000);
}

// Format Date
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
}

// Format Currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    }).format(amount);
}

// Create Star Rating
function createStarRating(rating, size = 'normal') {
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        if (i <= Math.round(rating)) {
            stars += '<span class="star">★</span>';
        } else {
            stars += '<span style="color: #ccc;">★</span>';
        }
    }
    return stars;
}

// Create Card HTML
function createWisataCard(item) {
    const avgRating = item.avg_rating || 0;
    const reviewCount = item.review_count || 0;
    
    return `
        <div class="card fade-in" onclick="window.location.href='detail.php?id=${item.id}'">
            <img src="img/wisata/${item.image}" alt="${item.name}" class="card-img" onerror="this.src='https://via.placeholder.com/300x250?text=No+Image'">
            <div class="card-body">
                <span class="card-badge">${item.category || 'Umum'}</span>
                <h3 class="card-title">${item.name}</h3>
                <p class="card-text">${item.description.substring(0, 100)}...</p>
                <div class="card-footer">
                    <div>
                        <div class="card-rating">${createStarRating(avgRating)}</div>
                        <small style="color: var(--text-light);">${reviewCount} review</small>
                    </div>
                    <small style="color: var(--text-light);">📍 ${item.location}</small>
                </div>
            </div>
        </div>
    `;
}

// Create Kuliner Card HTML
function createKulinerCard(item) {
    return `
        <div class="card fade-in"
             onclick="window.location.href='detail_kuliner.php?id=${item.id}'">
            <img src="img/kuliner/${item.image}" alt="${item.name}" class="card-img"
                 onerror="this.src='https://via.placeholder.com/300x250?text=No+Image'">
            <div class="card-body">
                <h3 class="card-title">${item.name}</h3>
                <p class="card-text">${item.description.substring(0, 100)}...</p>
                <div class="card-footer">
                    <small style="color: var(--text-light);">🏪 Restoran</small>
                    <small style="color: var(--text-light);">📍 ${item.alamat}</small>
                </div>
            </div>
        </div>
    `;
}


// Create Budaya Card HTML
function createBudayaCard(item) {
    return `
        <div class="card fade-in">
            <img 
                src="img/budaya/${item.image}" 
                alt="${item.title}" 
                class="card-img"
                onerror="this.src='https://via.placeholder.com/300x250?text=No+Image'"
            >

            <div class="card-body">
                <span class="card-badge">${item.category || 'Budaya'}</span>
                <h3 class="card-title">${item.title}</h3>

                <p class="card-text">
                    ${item.content || 'Deskripsi budaya belum tersedia.'}
                </p>
            </div>
        </div>
    `;
}



function createPagination(current, total, callback) {
    let html = '';

    // Tombol Previous
    if (current > 1) {
        html += `<button class="page-btn" onclick="${callback.name}(${current - 1})">Prev</button>`;
    }

    // Nomor halaman
    for (let i = 1; i <= total; i++) {
        html += `
            <button class="page-btn ${i === current ? 'active' : ''}"
                onclick="${callback.name}(${i})">
                ${i}
            </button>
        `;
    }

    // Tombol Next
    if (current < total) {
        html += `<button class="page-btn" onclick="${callback.name}(${current + 1})">Next</button>`;
    }

    return html;
}


// Debounce function
function debounce(func, delay) {
    let timeoutId;
    return function (...args) {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => func(...args), delay);
    };
}

// Set active nav item
function setActiveNav(href) {
    document.querySelectorAll('.nav-item a').forEach(link => {
        link.classList.remove('active');
    });
    document.querySelectorAll(`.nav-item a[href="${href}"]`).forEach(link => {
        link.classList.add('active');
    });
}

// Smooth scroll
function smoothScroll(target) {
    const element = document.querySelector(target);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
}

// Loading Animation
const createLoadingAnimation = () => {
    return `
        <style>
            @keyframes loading {
                0% { background-position: 200% 0; }
                100% { background-position: -200% 0; }
            }
        </style>
    `;
};

// Check if element is in viewport
function isElementInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Lazy load images
document.addEventListener('DOMContentLoaded', () => {
    const images = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                observer.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
});

// Set current page
let currentPage = 1;

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    // Get current page from URL
    const params = new URLSearchParams(window.location.search);
    currentPage = parseInt(params.get('page')) || 1;
});