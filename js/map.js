const params = new URLSearchParams(window.location.search);
const id = params.get("id");

if (!id) {
    console.warn("ID tidak ditemukan");
}

// =============================
// CEK HALAMAN
// =============================
const isWisata = document.getElementById("sidebarLocation") !== null;
const isKuliner = document.getElementById("sidebarAlamat") !== null;

// =============================
// TENTUKAN API
// =============================
let apiUrl = "";
let type = "";

if (isWisata) {
    apiUrl = `http://localhost/wisata_sulut/api/get_detail_wisata.php?id=${id}`;
    type = "wisata";
} else if (isKuliner) {
    apiUrl = `http://localhost/wisata_sulut/api/get_detail_kuliner.php?id=${id}`;
    type = "kuliner";
} else {
    console.error("Halaman tidak dikenali");
}

// =============================
// FETCH DATA
// =============================
fetch(apiUrl)
    .then(res => res.json())
    .then(result => {

        if (!result.success) {
            alert(result.message || "Data tidak ditemukan");
            return;
        }

        const data = type === "wisata"
            ? result.data.wisata
            : result.data;

        // =============================
        // AMBIL KOORDINAT
        // =============================
        const lat = parseFloat(data.latitude);
        const lng = parseFloat(data.longitude);

        if (isNaN(lat) || isNaN(lng)) {
            console.warn("Koordinat tidak valid");
            return;
        }

        // =============================
        // MAP LEAFLET
        // =============================
        const map = L.map("mapContainer").setView([lat, lng], 14);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: "© OpenStreetMap"
        }).addTo(map);

        L.marker([lat, lng])
            .addTo(map)
            .bindPopup(data.name || "Lokasi")
            .openPopup();

        setTimeout(() => map.invalidateSize(), 200);
    })
    .catch(err => {
        console.error("MAP ERROR:", err);
    });
