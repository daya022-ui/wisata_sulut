// kuliner.js - Culinary Page Functionality

let currentKulinerPage = 1;
let currentKulinerSearch = '';
const kulinerItemsPerPage = 8;

// Load kuliner data
async function loadKuliner(page = 1, search = '') {
    try {
        const params = new URLSearchParams({
            limit: kulinerItemsPerPage,
            offset: (page - 1) * kulinerItemsPerPage,
            search: search
        });
        
        const response = await fetch(`${API_BASE}get_kuliner.php?${params}`);
        const data = await response.json();
        
        if (!data.success || !data.data) {
            showToast('Gagal memuat data kuliner', 'error');
            return;
        }

        // versi baru API:
        // data.data = { data: [...], pagination: {...} }
        const kulinerList = data.data.data;
        const pagination = data.data.pagination;

        displayKuliner(kulinerList, pagination);
            } catch (error) {
        console.error('Error loading kuliner:', error);
        showToast('Terjadi kesalahan saat memuat data', 'error');
    }
}

// Display kuliner cards
function displayKuliner(kulinerList, pagination) {
    const container = document.getElementById('kulinerGrid');
    const noResults = document.getElementById('noResults');
    
    if (!kulinerList || kulinerList.length === 0) {
        container.style.display = 'none';
        noResults.style.display = 'block';
        document.getElementById('pagination').innerHTML = '';
        return;
    }
    
    container.style.display = 'grid';
    noResults.style.display = 'none';
    
    container.innerHTML = kulinerList.map(item => createKulinerCard(item)).join('');
    
    // Update pagination
    if (pagination.pages > 1) {
        const paginationHtml = createPagination(
            currentKulinerPage, 
            pagination.pages, 
            changeKulinerPage
        );
        document.getElementById('pagination').innerHTML = paginationHtml;
    }
}

// Change page
function changeKulinerPage(page) {
    currentKulinerPage = page;
    loadKuliner(page, currentKulinerSearch);
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Initialize search
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', debounce((e) => {
            currentKulinerSearch = e.target.value;
            currentKulinerPage = 1;
            loadKuliner(1, currentKulinerSearch);
        }, 500));
    }
    
    loadKuliner();
});

// Load kuliner preview on homepage
function loadKulinerPreview() {
    const container = document.getElementById('kulinerContainer');
    if (!container) return;
    
    fetch(`${API_BASE}get_kuliner.php?limit=2&offset=0`)
        .then(res => res.json())
        .then(data => {
            if (data.success && data.data && data.data.data) {
                container.innerHTML = data.data.data
                    .slice(0, 2)
                    .map(item => createKulinerCard(item))
                    .join('');
            }
        })
        .catch(err => console.error('Error loading preview:', err));
}

function loadKulinerPreview() {
    const container = document.getElementById('kulinerContainer');
    if (!container) return;
    
    fetch(`${API_BASE}get_kuliner.php?limit=2&offset=0`)
        .then(res => res.json())
        .then(data => {
            if (data.success && data.data && data.data.data) {
                container.innerHTML = data.data.data
                    .slice(0, 2)
                    .map(item => createKulinerCard(item))
                    .join('');
            }
        })
        .catch(err => console.error('Error loading preview:', err));
}

