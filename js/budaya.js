// budaya.js - Culture Page Functionality

let currentBudayaPage = 1;
let currentBudayaCategory = '';
let currentBudayaSearch = '';
const budayaItemsPerPage = 9;

// Load budaya data
async function loadBudaya(page = 1, category = '', search = '') {
    try {
        const params = new URLSearchParams({
            limit: budayaItemsPerPage,
            offset: (page - 1) * budayaItemsPerPage,
            category: category,
            search: search
        });
        
        const response = await fetch(`${API_BASE}get_budaya.php?${params}`);
        const data = await response.json();
        
        if (!data.success) {
            showToast('Gagal memuat data budaya', 'error');
            return;
        }
        
        displayBudaya(data.data, data.pagination);
    } catch (error) {
        console.error('Error loading budaya:', error);
        showToast('Terjadi kesalahan saat memuat data', 'error');
    }
}

// Display budaya cards
function displayBudaya(budayaList, pagination) {
    const container = document.getElementById('budayaGrid');
    const noResults = document.getElementById('noResults');
    
    if (!budayaList || budayaList.length === 0) {
        container.style.display = 'none';
        noResults.style.display = 'block';
        document.getElementById('pagination').innerHTML = '';
        return;
    }
    
    container.style.display = 'grid';
    noResults.style.display = 'none';
    
    container.innerHTML = budayaList.map(item => createBudayaCard(item)).join('');
    
    // Update pagination
    if (pagination.pages > 1) {
        const paginationHtml = createPagination(
            currentBudayaPage, 
            pagination.pages, 
            changeBudayaPage
        );
        document.getElementById('pagination').innerHTML = paginationHtml;
    }
}

// Change page
function changeBudayaPage(page) {
    currentBudayaPage = page;
    loadBudaya(page, currentBudayaCategory, currentBudayaSearch);
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Set category
function setCategory(category) {
    currentBudayaCategory = category;
    currentBudayaPage = 1;
    if (document.getElementById('categoryFilter')) {
        document.getElementById('categoryFilter').value = category;
    }
    loadBudaya(1, category, currentBudayaSearch);
}

// Initialize search and filter
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', debounce((e) => {
            currentBudayaSearch = e.target.value;
            currentBudayaPage = 1;
            loadBudaya(1, currentBudayaCategory, currentBudayaSearch);
        }, 500));
    }
    
    const categoryFilter = document.getElementById('categoryFilter');
    if (categoryFilter) {
        categoryFilter.addEventListener('change', (e) => {
            setCategory(e.target.value);
        });
    }
    
    const params = new URLSearchParams(window.location.search);
    const categoryParam = params.get('category');
    if (categoryParam) {
        setCategory(categoryParam);
    } else {
        loadBudaya();
    }
});

// Load budaya preview on homepage
function loadBudayaPreview() {
    const container = document.getElementById('budayaContainer');
    if (!container) return;
    
    fetch(`${API_BASE}get_budaya.php?limit=3&offset=0`)
        .then(res => res.json())
        .then(data => {
            if (data.success && data.data) {
                container.innerHTML = data.data
                    .slice(0, 3)
                    .map(item => createBudayaCard(item))
                    .join('');
            }
        })
        .catch(err => console.error('Error loading preview:', err));
}