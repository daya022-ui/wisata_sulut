// detail.js - Detail Page Functionality

let selectedRating = 0;
const urlParams = new URLSearchParams(window.location.search);
const wisataId = parseInt(urlParams.get('id')) || 0;

// Get wisata ID from URL
document.addEventListener('DOMContentLoaded', () => {
    if (wisataId <= 0) {
        showToast('ID destinasi tidak valid', 'error');
        setTimeout(() => window.location.href = 'wisata.php', 2000);
        return;
    }
    
    loadWisataDetail();
    setupRatingInput();
});

// Load wisata detail
async function loadWisataDetail() {
    try {
        const response = await fetch(`${API_BASE}get_detail_wisata.php?id=${wisataId}`);
        const data = await response.json();

        
        if (!data.success) {
            showToast('Destinasi tidak ditemukan', 'error');
            return;
        }
        
        displayWisataDetail(data.data);
    } catch (error) {
        console.error('Error loading detail:', error);
        showToast('Terjadi kesalahan saat memuat detail', 'error');
    }
}

// Display wisata detail
function displayWisataDetail(detail) {
    const { wisata, gallery, reviews, statistics } = detail;
    
    // Header
    document.getElementById('detailTitle').textContent = wisata.name
    document.getElementById('detailLocation').textContent = `📍 ${wisata.location}`;
    document.getElementById('detailImage').src = `img/wisata/${wisata.image}`;
    document.getElementById('detailImage').alt = wisata.name;
    
    // Content
    document.getElementById('detailDescription').textContent = wisata.description;
    document.getElementById('sidebarLocation').textContent = wisata.location;
    document.getElementById('sidebarCategory').textContent = wisata.category || 'Umum';
    
    // Rating
    const avgRating = statistics.avg_rating || 0;
    const reviewCount = statistics.total_reviews || 0;
    document.getElementById('sidebarRating').innerHTML = `
        ${createStarRating(avgRating)} ${avgRating.toFixed(1)} / 5
    `;
    document.getElementById('sidebarReviews').textContent = `${reviewCount} review`;
    
    // Gallery
    displayGallery(gallery);
    
    // Reviews
    displayReviews(reviews);
    
    // Hide loading
    document.getElementById('detailLoading').style.display = 'none';
    document.getElementById('detailContent').style.display = 'block';
    document.getElementById('contentLoading').style.display = 'none';
    document.getElementById('contentDetail').style.display = 'block';
    
    // Initialize map
    if (wisata.latitude && wisata.longitude) {
        initLeaMap(parseFloat(wisata.latitude), parseFloat(wisata.longitude));
    } else {
        console.warn("Latitude/Longitude tidak ditemukan!");
    }


}

// Display gallery
function displayGallery(gallery) {
    const container = document.getElementById('galleryContainer');
    
    if (!gallery || gallery.length === 0) {
        container.innerHTML = '<p style="text-align: center; color: var(--text-light); grid-column: 1/-1;">Tidak ada foto galeri</p>';
        return;
    }
    
    container.innerHTML = gallery.map(photo => `
        <div class="gallery-item" onclick="openModal('img/wisata/${photo.image}')">
            <img src="img/wisata/${photo.image}" alt="${photo.caption}" onerror="this.src='https://via.placeholder.com/200x200?text=No+Image'">
            <div style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.5); color: white; padding: 0.5rem; font-size: 0.9rem;">
                ${photo.caption || 'Foto'}
            </div>
        </div>
    `).join('');
}

// Display reviews
function displayReviews(reviews) {
    const container = document.getElementById('reviewsList');
    
    if (!reviews || reviews.length === 0) {
        container.innerHTML = '<p style="text-align: center; color: var(--text-light);">Belum ada review. Jadilah yang pertama!</p>';
        return;
    }
    
    container.innerHTML = reviews.map(review => `
        <div class="review-item">
            <div class="review-header">
                <div>
                    <div class="review-author">${review.name}</div>
                    <div class="review-date">${formatDate(review.created_at)}</div>
                </div>
                <div class="review-rating">${createStarRating(review.rating)}</div>
            </div>
            <div class="review-text">${review.comment}</div>
        </div>
    `).join('');
}

// Setup rating input
function setupRatingInput() {
    const stars = document.querySelectorAll('.rating-star');
    
    stars.forEach(star => {
        star.addEventListener('click', () => {
            selectedRating = parseInt(star.dataset.rating);
            stars.forEach(s => {
                s.classList.remove('active');
                if (parseInt(s.dataset.rating) <= selectedRating) {
                    s.classList.add('active');
                }
            });
        });
        
        star.addEventListener('mouseover', () => {
            stars.forEach(s => {
                s.style.opacity = parseInt(s.dataset.rating) <= parseInt(star.dataset.rating) ? '1' : '0.5';
            });
        });
    });
    
    document.getElementById('ratingInput').addEventListener('mouseleave', () => {
        stars.forEach(s => {
            s.style.opacity = '1';
        });
    });
}

function selectRating(rating) {
    selectedRating = rating;
    const stars = document.querySelectorAll('.rating-star');
    stars.forEach((star, index) => {
        if (index < rating) {
            star.style.color = '#fbbf24'; // Kuning
        } else {
            star.style.color = '#cbd5e1'; // Abu-abu
        }
    });
}

// Submit review
async function submitReview() {
    const name = document.getElementById('reviewName').value.trim();
    const email = document.getElementById('reviewEmail').value.trim();
    const comment = document.getElementById('reviewComment').value.trim();
    
    // Validation
    if (!name) {
        showToast('Nama tidak boleh kosong', 'error');
        return;
    }
    
    if (!email || !email.includes('@')) {
        showToast('Email tidak valid', 'error');
        return;
    }
    
    if (selectedRating === 0) {
        showToast('Pilih rating terlebih dahulu', 'error');
        return;
    }
    
    if (!comment || comment.length < 10) {
        showToast('Komentar minimal 10 karakter', 'error');
        return;
    }
    
    try {
        const response = await fetch(`${API_BASE}add_review.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                wisata_id: wisataId,
                name: name,
                email: email,
                rating: selectedRating,
                comment: comment
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            showToast('Review berhasil dikirim!', 'success');
            // Clear form
            document.getElementById('reviewName').value = '';
            document.getElementById('reviewEmail').value = '';
            document.getElementById('reviewComment').value = '';
            selectedRating = 0;
            document.querySelectorAll('.rating-star').forEach(s => s.classList.remove('active'));
            
            // Reload reviews
            loadWisataDetail();
        } else {
            showToast(data.message || 'Gagal mengirim review', 'error');
        }
    } catch (error) {
        console.error('Error submitting review:', error);
        showToast('Terjadi kesalahan saat mengirim review', 'error');
    }
}

// Initialize map (Leaflet Version)
function initLeaMap(lat, lng) {

    if (!lat || !lng || isNaN(lat) || isNaN(lng)) {
        console.error("Koordinat tidak valid:", lat, lng);
        return;
    }

    const mapContainer = document.getElementById("mapContainer");
    mapContainer.innerHTML = "";

    const mapDiv = document.createElement("div");
    mapDiv.id = "leafletMap";
    mapDiv.style.width = "100%";
    mapDiv.style.height = "100%";
    mapDiv.style.borderRadius = "12px";

    mapContainer.appendChild(mapDiv);

    const map = L.map("leafletMap").setView([lat, lng], 14);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19
    }).addTo(map);

    L.marker([lat, lng]).addTo(map)
        .bindPopup("Lokasi Wisata")
        .openPopup();
}


// Open image modal
function openModal(imageSrc) {
    const modal = document.createElement('div');
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.9);
        z-index: 3000;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease-out;
    `;
    
    modal.innerHTML = `
        <div style="position: relative; max-width: 90%; max-height: 90%;">
            <img src="${imageSrc}" style="max-width: 100%; max-height: 100%; border-radius: 12px;">
            <button onclick="this.parentElement.parentElement.remove()" style="
                position: absolute;
                top: -40px;
                right: 0;
                background: white;
                border: none;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                font-size: 24px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
            ">×</button>
        </div>
    `;
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.remove();
    });
    
    document.body.appendChild(modal);
}