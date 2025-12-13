// wisata.js - Tourism Page Functionality

let currentWisataPage = 1;
let currentCategory = '';
let currentSearch = '';
const itemsPerPage = 9;

// Load wisata data
async function loadWisata(page = 1, category = '', search = '') {
    try {
        const params = new URLSearchParams({
            limit: itemsPerPage,
            offset: (page - 1) * itemsPerPage,
            category: category,
            search: search
        });
        
        const response = await fetch(`${API_BASE}get_wisata.php?${params}`);
        const data = await response.json();

        console.log("API Response:", data); // Debug

        // 🟢 Validasi sesuai API
        if (!data.success) {
            showToast('Gagal memuat data wisata', 'error');
            return;
        }      


        const wisataList = data.data;
        const total = data.pagination.total;
        const totalPages = data.pagination.pages;

        displayWisata(wisataList, totalPages);

    } catch (error) {
        console.error('Error loading wisata:', error);
        showToast('Terjadi kesalahan saat memuat data', 'error');
    }
}

// Display wisata cards
function displayWisata(wisataList, totalPages) {
    const container = document.getElementById('wisataGrid');
    const noResults = document.getElementById('noResults');

    if (!wisataList || wisataList.length === 0) {
        container.style.display = 'none';
        noResults.style.display = 'block';
        document.getElementById('pagination').innerHTML = '';
        return;
    }

    container.style.display = 'grid';
    noResults.style.display = 'none';

    container.innerHTML = wisataList.map(item => createWisataCard(item)).join('');

    // 🟢 Pagination fix
    if (totalPages > 1) {
        const paginationHtml = createPagination(
            currentWisataPage,
            totalPages,
            changePage
        );
        document.getElementById('pagination').innerHTML = paginationHtml;
    }
}

// Change page
function changePage(page) {
    currentWisataPage = page;
    loadWisata(page, currentCategory, currentSearch);
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Set category filter
function setCategory(category) {
    currentCategory = category;
    currentWisataPage = 1;
    if (document.getElementById('categoryFilter')) {
        document.getElementById('categoryFilter').value = category;
    }
    loadWisata(1, currentCategory, currentSearch);
}

// Initialize search and filter
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', debounce((e) => {
            currentSearch = e.target.value;
            currentWisataPage = 1;
            loadWisata(1, currentCategory, currentSearch);
        }, 500));
    }

    const categoryFilter = document.getElementById('categoryFilter');
    if (categoryFilter) {
        categoryFilter.addEventListener('change', (e) => {
            setCategory(e.target.value);
        });
    }

    // Load initial data
    const params = new URLSearchParams(window.location.search);
    const categoryParam = params.get('category');
    if (categoryParam) {
        setCategory(categoryParam);
    } else {
        loadWisata();
    }
});

// Wisata preview (homepage)
function loadWisataPreview() {
    const container = document.getElementById('wisataContainer');
    if (!container) return;

    fetch(`${API_BASE}get_wisata.php?limit=3&offset=0`)
        .then(res => res.json())
        .then(data => {
            if (data.status === "success" && data.data) {
                container.innerHTML = data.data
                    .slice(0, 3)
                    .map(item => createWisataCard(item))
                    .join('');
            }
        })
        .catch(err => console.error('Error loading preview:', err));
}

// ... kode sebelumnya (loadWisata, displayWisata, dll)

// Wisata preview (homepage)
function loadWisataPreview() {
    const container = document.getElementById('wisataContainer');
    if (!container) return;

    fetch(`${API_BASE}get_wisata.php?limit=3&offset=0`)
        .then(res => res.json())
        .then(data => {
            if (data.status === "success" && data.data) {
                container.innerHTML = data.data
                    .slice(0, 3)
                    .map(item => createWisataCard(item))
                    .join('');
            }
        })
        .catch(err => console.error('Error loading preview:', err));
}


// ✅ TAMBAHKAN KODE INI DI PALING BAWAH
function createPagination(current, total, callback) {
    let html = '';

    if (current > 1) {
        html += `<button class="page-btn" onclick="${callback.name}(${current - 1})">Prev</button>`;
    }

    for (let i = 1; i <= total; i++) {
        html += `
            <button class="page-btn ${i === current ? 'active' : ''}"
                onclick="${callback.name}(${i})">
                ${i}
            </button>
        `;
    }

    if (current < total) {
        html += `<button class="page-btn" onclick="${callback.name}(${current + 1})">Next</button>`;
    }

    return html;
}
