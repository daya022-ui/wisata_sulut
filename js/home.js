document.addEventListener('DOMContentLoaded', () => {
    loadHomeWisata();
    loadHomeKuliner();
    loadHomeBudaya();
});

/* =======================
   WISATA (API: data[])
======================= */
function loadHomeWisata() {
    const container = document.getElementById('wisataContainer');
    if (!container) return;

    fetch('api/get_wisata.php?limit=3')
        .then(res => res.json())
        .then(json => {
            if (!json.success || !Array.isArray(json.data)) {
                container.innerHTML = '<p>Gagal memuat wisata.</p>';
                return;
            }

            container.innerHTML = json.data.map(w => `
                <div class="card">
                    <img src="img/wisata/${w.image}" alt="${w.name}">
                    <div class="card-body">
                        <h3>${w.name}</h3>
                        <p>${w.location}</p>
                        <a href="detail_wisata.php?id=${w.id}" class="btn btn-sm">Detail</a>
                    </div>
                </div>
            `).join('');
        })
        .catch(() => {
            container.innerHTML = '<p>Gagal memuat wisata.</p>';
        });
}

/* =======================
   KULINER (API: data.data[])
======================= */
function loadHomeKuliner() {
    const container = document.getElementById('kulinerContainer');
    if (!container) return;

    fetch('api/get_kuliner.php?limit=4')
        .then(res => res.json())
        .then(json => {
            const data = json?.data?.data;
            if (!json.success || !Array.isArray(data)) {
                container.innerHTML = '<p>Gagal memuat kuliner.</p>';
                return;
            }

            container.innerHTML = data.map(k => `
                <div class="card horizontal">
                    <img src="img/kuliner/${k.image}" alt="${k.name}">
                    <div class="card-body">
                        <h3>${k.name}</h3>
                        <p>${k.alamat}</p>
                        <a href="detail_kuliner.php?id=${k.id}" class="btn btn-sm">Detail</a>
                    </div>
                </div>
            `).join('');
        })
        .catch(() => {
            container.innerHTML = '<p>Gagal memuat kuliner.</p>';
        });
}

/* =======================
   BUDAYA (API: data.data[])
======================= */
function loadHomeBudaya() {
    const container = document.getElementById('budayaContainer');
    if (!container) return;

    fetch('api/get_budaya.php?limit=3')
        .then(res => res.json())
        .then(json => {
            const data = json?.data?.data;
            if (!json.success || !Array.isArray(data)) {
                container.innerHTML = '<p>Gagal memuat budaya.</p>';
                return;
            }

            container.innerHTML = data.map(b => `
                <div class="card">
                    <img src="img/budaya/${b.image}" alt="${b.title}">
                    <div class="card-body">
                        <h3>${b.title}</h3>
                        <p>${b.preview}</p>
                        <a href="detail_budaya.php?id=${b.id}" class="btn btn-sm">Detail</a>
                    </div>
                </div>
            `).join('');
        })
        .catch(() => {
            container.innerHTML = '<p>Gagal memuat budaya.</p>';
        });
}
