// detail_kuliner.js - Detail Kuliner Functionality
let kulinerLat = 0;
let kulinerLng = 0;
let kulinerName = '';


const urlParams = new URLSearchParams(window.location.search);
const kulinerID = parseInt(urlParams.get('id')) || 0;

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    if (kulinerID <= 0) {
        showToast('ID kuliner tidak valid', 'error');
        setTimeout(() => window.location.href = 'kuliner.php', 2000);
        return;
    }
    
    loadKulinerDetail();
});

// Load kuliner detail
async function loadKulinerDetail() {
    try {
        const response = await fetch(`${API_BASE}get_detail_kuliner.php?id=${kulinerID}`);
        const data = await response.json();
        
        if (!data.success) {
            showToast('Kuliner tidak ditemukan', 'error');
            return;
        }
        
        displayKulinerDetail({
        kuliner: data.data.kuliner,
        gallery: data.data.gallery
});

    } catch (error) {
        console.error('Error loading detail:', error);
        showToast('Terjadi kesalahan saat memuat detail', 'error');
    }
}

// Display kuliner detail
function displayKulinerDetail(detail) {
    const { kuliner, gallery } = detail;
    
    // Store coordinates for map
    kulinerLat = parseFloat(kuliner.latitude) || 0;
    kulinerLng = parseFloat(kuliner.longitude) || 0;
    kulinerName = kuliner.name;
    
    // Header
    const setText = (id, value) => {
        const el = document.getElementById(id);
        if (el) el.textContent = value;
    };

    const setImage = (id, src, alt = '') => {
        const el = document.getElementById(id);
        if (el) {
            el.src = src;
            el.alt = alt;
        }
    };

    setText('detailTitle', kuliner.name);
    setText('detailAlamat', `📍 ${kuliner.alamat}`);
    setImage('detailImage', `img/kuliner/${kuliner.image}`, kuliner.name);
    setText('detailDescription', kuliner.description || 'Tidak ada deskripsi');

    setText('sidebarName', kuliner.name);
    setText('sidebarAlamat', kuliner.alamat);
    setText('latValue', kuliner.latitude);
    setText('lngValue', kuliner.longitude);
    ;

    // Gallery
    displayGallery(gallery);
    
    // Hide loading
    document.getElementById('detailLoading').style.display = 'none';
    document.getElementById('detailContent').style.display = 'block';
    document.getElementById('contentLoading').style.display = 'none';
    document.getElementById('contentDetail').style.display = 'block';
    
    // Initialize map
    // Initialize map (AMAN)
    if (!isNaN(kulinerLat) && !isNaN(kulinerLng)) {
        setTimeout(() => initLeaMap(kulinerLat, kulinerLng), 100);
    } else {
        console.warn("Koordinat kuliner tidak valid:", kulinerLat, kulinerLng);
        document.getElementById("mapContainer").innerHTML =
            "<p style='text-align:center;color:#999'>Lokasi tidak tersedia</p>";
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
        <div class="gallery-item" onclick="openModal('img/kuliner/${photo.image}')">
            <img src="img/kuliner/${photo.image}" alt="${photo.caption}" onerror="this.src='https://via.placeholder.com/200x200?text=No+Image'">
            <div style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.5); color: white; padding: 0.5rem; font-size: 0.9rem;">
                ${photo.caption || 'Foto'}
            </div>
        </div>
    `).join('');
}

// Initialize map (Leaflet Version)
function initLeaMap(lat, lng) {

    if (isNaN(lat) || isNaN(lng)) {
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

    // HAPUS MAP LAMA JIKA ADA
    if (window.kulinerMap) {
        window.kulinerMap.remove();
    }

    // BUAT MAP
    window.kulinerMap = L.map("leafletMap").setView([lat, lng], 14);

    // TILE LAYER (PAKAI window.kulinerMap)
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: "© OpenStreetMap"
    }).addTo(window.kulinerMap);

    // MARKER
    L.marker([lat, lng])
        .addTo(window.kulinerMap)
        .bindPopup("📍 Lokasi Kuliner")
        .openPopup();

    // PENTING!!!
    setTimeout(() => {
        window.kulinerMap.invalidateSize();
    }, 200);
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