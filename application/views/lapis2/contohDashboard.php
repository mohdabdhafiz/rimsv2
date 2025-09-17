<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papan Pemuka Analisis Laporan (LAPIS)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/customParseFormat.js"></script>
    <!-- Chosen Palette: Calm Harmony -->
    <!-- Application Structure Plan: Papan pemuka interaktif satu halaman (SPA) ini direka untuk memudahkan penerokaan data laporan yang kompleks. Strukturnya bermula dengan penapis global (Kluster, Negeri, Julat Tarikh) di bahagian atas untuk kawalan menyeluruh. Di bawahnya, terdapat kad metrik utama (KPI) untuk memberikan gambaran pantas. Kandungan utama disusun dalam antara muka tab untuk memisahkan pandangan yang berbeza tanpa memuat semula halaman: 'Papan Pemuka' untuk visualisasi data agregat (carta tren dan taburan), 'Senarai Laporan' untuk data terperinci dalam jadual yang boleh diisih dan dicari, dan 'Peta Taburan' untuk analisis geografi. Pendekatan ini dipilih kerana ia menyokong aliran kerja pengguna yang bermula dari gambaran besar (KPI dan carta), bergerak ke analisis terperinci (jadual), dan akhirnya ke konteks spatial (peta), semuanya dalam satu paparan yang koheren dan interaktif. -->
    <!-- Visualization & Content Choices: [Laporan Mengikut Bulan -> Goal:Change -> Bar Chart -> Interaktif (hover), Kemas kini dengan penapis -> Justifikasi: Memaparkan tren bulanan dengan jelas; Laporan Mengikut Kluster -> Goal:Compare -> Donut Chart -> Interaktif (hover), Kemas kini dengan penapis -> Justifikasi: Menunjukkan pecahan mengikut kategori dengan berkesan; Laporan Mengikut Negeri -> Goal:Compare -> Horizontal Bar Chart -> Interaktif (hover), Kemas kini dengan penapis -> Justifikasi: Sesuai untuk membandingkan kategori dengan label panjang; Senarai Laporan -> Goal:Organize -> Jadual HTML Boleh Isih/Cari -> Klik baris untuk modal -> Justifikasi: Membolehkan pengguna melihat data mentah dan butiran; Peta Taburan -> Goal:Relationships -> Scatter Plot (Longitude vs Latitude) -> Klik titik untuk modal -> Justifikasi: Memvisualkan kluster geografi tanpa memerlukan SVG atau imej peta luaran, mematuhi kekangan teknikal.] -->
    <!-- CONFIRMATION: NO SVG graphics used. NO Mermaid JS used. -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        .chart-container {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            height: 350px;
            max-height: 400px;
        }
        @media (min-width: 768px) {
            .chart-container {
                height: 400px;
            }
        }
        .modal-bg {
            background-color: rgba(0,0,0,0.5);
        }
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: #3b82f6; /* blue-500 */
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-stone-100 text-stone-800">

    <div class="loading-overlay" id="loading-overlay">
        <div class="spinner"></div>
    </div>

    <div class="container mx-auto p-4 md:p-6 lg:p-8">
        <header class="mb-6">
            <h1 class="text-4xl font-bold text-stone-900">Papan Pemuka Analisis Laporan</h1>
            <p class="text-stone-600 mt-1">Analisis interaktif data dari sistem LAPIS.</p>
        </header>

        <!-- Filters Section -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <h2 class="text-lg font-semibold mb-3 text-stone-700">Penapis Data</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="filter-kluster" class="block text-sm font-medium text-stone-600">Kluster</label>
                    <select id="filter-kluster" class="mt-1 block w-full rounded-md border-stone-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="all">Semua Kluster</option>
                    </select>
                </div>
                <div>
                    <label for="filter-negeri" class="block text-sm font-medium text-stone-600">Negeri</label>
                    <select id="filter-negeri" class="mt-1 block w-full rounded-md border-stone-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="all">Semua Negeri</option>
                    </select>
                </div>
                <div>
                    <label for="filter-date-start" class="block text-sm font-medium text-stone-600">Tarikh Mula</label>
                    <input type="date" id="filter-date-start" class="mt-1 block w-full rounded-md border-stone-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="filter-date-end" class="block text-sm font-medium text-stone-600">Tarikh Akhir</label>
                    <input type="date" id="filter-date-end" class="mt-1 block w-full rounded-md border-stone-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                 <div class="lg:col-span-4 flex justify-end">
                    <button id="reset-filters" class="px-4 py-2 bg-stone-600 text-white rounded-md hover:bg-stone-700 transition-colors text-sm">Set Semula</button>
                </div>
            </div>
        </div>

        <!-- KPIs Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-5 rounded-lg shadow-sm flex flex-col justify-between">
                <h3 class="text-sm font-medium text-stone-500">Jumlah Laporan</h3>
                <p id="kpi-total" class="text-3xl font-bold text-blue-600">0</p>
            </div>
            <div class="bg-white p-5 rounded-lg shadow-sm flex flex-col justify-between">
                <h3 class="text-sm font-medium text-stone-500">Laporan Bulan Ini</h3>
                <p id="kpi-this-month" class="text-3xl font-bold text-blue-600">0</p>
            </div>
            <div class="bg-white p-5 rounded-lg shadow-sm flex flex-col justify-between">
                <h3 class="text-sm font-medium text-stone-500">Kluster Paling Aktif</h3>
                <p id="kpi-top-cluster" class="text-xl font-bold text-blue-600">-</p>
            </div>
            <div class="bg-white p-5 rounded-lg shadow-sm flex flex-col justify-between">
                <h3 class="text-sm font-medium text-stone-500">Negeri Teratas</h3>
                <p id="kpi-top-state" class="text-xl font-bold text-blue-600">-</p>
            </div>
        </div>

        <!-- Main Content with Tabs -->
        <div>
            <div class="border-b border-stone-200">
                <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                    <button id="tab-dashboard" class="tab-button border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Papan Pemuka</button>
                    <button id="tab-list" class="tab-button border-transparent text-stone-500 hover:text-stone-700 hover:border-stone-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Senarai Laporan</button>
                    <button id="tab-map" class="tab-button border-transparent text-stone-500 hover:text-stone-700 hover:border-stone-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Peta Taburan</button>
                </nav>
            </div>

            <div id="content-dashboard" class="tab-content mt-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white p-5 rounded-lg shadow-sm">
                        <h3 class="font-semibold mb-1 text-stone-700">Tren Laporan Bulanan</h3>
                        <p class="text-sm text-stone-500 mb-4">Visualisasi ini menunjukkan jumlah laporan yang diterima setiap bulan, membolehkan anda mengenal pasti musim atau tempoh paling aktif.</p>
                        <div class="chart-container"><canvas id="monthlyReportsChart"></canvas></div>
                    </div>
                    <div class="bg-white p-5 rounded-lg shadow-sm">
                        <h3 class="font-semibold mb-1 text-stone-700">Pecahan Laporan Mengikut Kluster</h3>
                        <p class="text-sm text-stone-500 mb-4">Carta ini memaparkan peratusan sumbangan laporan dari setiap kluster. Gerakkan tetikus ke atas setiap segmen untuk melihat butiran.</p>
                         <div class="chart-container"><canvas id="clusterDistributionChart"></canvas></div>
                    </div>
                    <div class="bg-white p-5 rounded-lg shadow-sm lg:col-span-2">
                        <h3 class="font-semibold mb-1 text-stone-700">Taburan Laporan Mengikut Negeri</h3>
                         <p class="text-sm text-stone-500 mb-4">Bandingkan jumlah laporan yang diterima dari setiap negeri untuk mengenal pasti kawasan yang paling banyak melaporkan isu.</p>
                        <div class="chart-container"><canvas id="stateDistributionChart"></canvas></div>
                    </div>
                </div>
            </div>

            <div id="content-list" class="tab-content mt-6 hidden">
                 <div class="bg-white p-5 rounded-lg shadow-sm">
                    <h3 class="font-semibold mb-1 text-stone-700">Senarai Laporan Terperinci</h3>
                    <p class="text-sm text-stone-500 mb-4">Jadual ini menyenaraikan semua laporan berdasarkan penapis yang anda pilih. Anda boleh mencari tajuk isu atau mengisih jadual dengan mengklik pada tajuk lajur.</p>
                    <input type="text" id="search-table" placeholder="Cari tajuk isu..." class="mb-4 block w-full md:w-1/3 rounded-md border-stone-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-stone-200">
                            <thead class="bg-stone-50">
                                <tr>
                                    <th scope="col" class="table-header px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase tracking-wider cursor-pointer" data-sort="lapis_bil">ID Laporan ⇅</th>
                                    <th scope="col" class="table-header px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase tracking-wider cursor-pointer" data-sort="lapis_tarikh_laporan">Tarikh ⇅</th>
                                    <th scope="col" class="table-header px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase tracking-wider cursor-pointer" data-sort="lapis_tajuk_isu">Tajuk Isu ⇅</th>
                                    <th scope="col" class="table-header px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase tracking-wider cursor-pointer" data-sort="lapis_kluster_nama">Kluster ⇅</th>
                                    <th scope="col" class="table-header px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase tracking-wider cursor-pointer" data-sort="lapis_negeri_nama">Negeri ⇅</th>
                                </tr>
                            </thead>
                            <tbody id="report-table-body" class="bg-white divide-y divide-stone-200">
                                <!-- Rows will be inserted by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                 </div>
            </div>

            <div id="content-map" class="tab-content mt-6 hidden">
                <div class="bg-white p-5 rounded-lg shadow-sm">
                    <h3 class="font-semibold mb-1 text-stone-700">Peta Taburan Geografi Laporan</h3>
                    <p class="text-sm text-stone-500 mb-4">Setiap titik pada plot ini mewakili satu laporan. Gunakan visualisasi ini untuk mengenal pasti kluster atau kelompok laporan secara geografi. Klik pada mana-mana titik untuk melihat butiran laporan tersebut.</p>
                    <div class="chart-container"><canvas id="mapScatterChart"></canvas></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Report Details -->
    <div id="report-modal" class="fixed inset-0 z-50 overflow-y-auto modal-bg items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-xl m-4 md:m-8 lg:m-16 max-w-2xl w-full mx-auto">
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <h2 class="text-2xl font-bold text-stone-800" id="modal-title">Butiran Laporan</h2>
                    <button id="close-modal" class="text-stone-500 hover:text-stone-800 text-2xl">&times;</button>
                </div>
                <div id="modal-content" class="mt-4 space-y-3 text-sm text-stone-600">
                    <!-- Modal content will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <script>
        dayjs.extend(dayjs_plugin_customParseFormat);

        document.addEventListener('DOMContentLoaded', function () {
            // Simulated Data (will be replaced by API fetch in a real scenario)
            // This data is generated to simulate a larger dataset for demonstration purposes.
            let allData = [];
            const generateMockData = (numRecords) => {
                const clusters = ["Ekonomi", "Sosial", "Keselamatan", "Alam Sekitar", "Infrastruktur"];
                const states = ["Selangor", "Johor", "Pulau Pinang", "Kedah", "Kuala Lumpur", "Sabah", "Sarawak", "Perak", "Pahang", "Terengganu", "Kelantan", "Negeri Sembilan", "Melaka", "Perlis"];
                const reporters = ["Ahmad Kassim", "Siti Nurhaliza", "Muthu Samy", "Lee Wei", "Fatimah Ali", "Ravi Kumar", "Chen Long", "Nurul Huda"];
                const issueTitles = [
                    "Kenaikan Harga Makanan", "Kesesakan Lalu Lintas", "Kekurangan Peluang Pekerjaan",
                    "Masalah Pecah Rumah", "Masalah Sampah Tidak Dikutip", "Penipuan Siber (Scam)",
                    "Keselamatan Sempadan", "Pengangguran Belia", "Pencemaran Udara",
                    "Jalan Rosak", "Bekalan Air Terganggu", "Banjir Kilat",
                    "Jenayah Siber", "Kesihatan Awam", "Pengangkutan Awam"
                ];
                const issueSummaries = [
                    "Harga barang keperluan asas meningkat mendadak.", "Jalan utama sesak setiap hari, menjejaskan produktiviti.",
                    "Graduan sukar mendapat pekerjaan selepas tamat pengajian.", "Kadar pecah rumah di kawasan perumahan semakin membimbangkan.",
                    "Sistem kutipan sampah tidak cekap, menyebabkan longgokan sampah.", "Warga emas menjadi mangsa penipuan pelaburan dalam talian.",
                    "Pencerobohan pendatang tanpa izin di kawasan sempadan.", "Belia menghadapi cabaran besar dalam pasaran kerja.",
                    "Kualiti udara menurun akibat pembakaran terbuka.", "Jalan berlubang dan tidak diselenggara dengan baik.",
                    "Gangguan bekalan air yang kerap di beberapa kawasan.", "Banjir berlaku secara tiba-tiba selepas hujan lebat.",
                    "Peningkatan kes penipuan dalam talian dan pancingan data.", "Perkhidmatan kesihatan awam memerlukan penambahbaikan.",
                    "Sistem pengangkutan awam tidak efisien dan tidak selesa."
                ];
                const interventions = [
                    "Pemantauan harga oleh KPDNHEP.", "Kajian semula sistem trafik dan penambahbaikan infrastruktur jalan.",
                    "Program latihan kemahiran dan insentif pekerjaan.", "Rondaan polis lebih kerap dan penglibatan komuniti.",
                    "Tambah kekerapan kutipan sampah dan kempen kesedaran.", "Kempen kesedaran anti-scam dan kerjasama dengan pihak bank.",
                    "Perketatkan kawalan sempadan dan penggunaan teknologi.", "Jarmian kerjaya dan insentif majikan.",
                    "Penguatkuasaan undang-undang terhadap pembakaran terbuka.", "Penyelenggaraan jalan secara berkala.",
                    "Penambahbaikan infrastruktur bekalan air.", "Sistem amaran awal banjir dan pengurusan saliran.",
                    "Pendidikan keselamatan siber dan penguatkuasaan undang-undang.", "Peningkatan fasiliti dan kakitangan hospital.",
                    "Penambahbaikan jadual dan kualiti perkhidmatan pengangkutan awam."
                ];
                const dmNames = ["Petaling Jaya", "Iskandar Puteri", "George Town", "Klang", "Alor Setar", "Kajang", "Tawau", "Kuala Lumpur", "Ipoh", "Kuantan", "Kota Bharu", "Seremban", "Melaka", "Kangar"];
                const locations = ["Taman Maju", "Bandar Indah", "Kampung Sejahtera", "Pusat Bandar", "Pinggir Bandar", "Kawasan Perindustrian"];
                const areaTypes = ["Bandar", "Luar Bandar", "Sempadan", "Pesisir Pantai"];

                for (let i = 1; i <= numRecords; i++) {
                    const cluster = clusters[Math.floor(Math.random() * clusters.length)];
                    const state = states[Math.floor(Math.random() * states.length)];
                    const reporter = reporters[Math.floor(Math.random() * reporters.length)];
                    const issueTitle = issueTitles[Math.floor(Math.random() * issueTitles.length)];
                    const issueSummary = issueSummaries[Math.floor(Math.random() * issueSummaries.length)];
                    const intervention = interventions[Math.floor(Math.random() * interventions.length)];
                    const dm = dmNames[Math.floor(Math.random() * dmNames.length)];
                    const location = locations[Math.floor(Math.random() * locations.length)];
                    const areaType = areaTypes[Math.floor(Math.random() * areaTypes.length)];

                    const randomDate = dayjs('2025-01-01').add(Math.floor(Math.random() * 365), 'day');
                    const randomTime = `${Math.floor(Math.random() * 24).toString().padStart(2, '0')}:${Math.floor(Math.random() * 60).toString().padStart(2, '0')}:00`;

                    allData.push({
                        lapis_bil: 1000 + i,
                        lapis_kluster_bil: clusters.indexOf(cluster) + 1,
                        lapis_kluster_nama: cluster,
                        lapis_tarikh_laporan_dibina: randomDate.format('YYYY-MM-DD HH:mm:ss'),
                        lapis_tarikh_laporan: randomDate.format('YYYY-MM-DD'),
                        lapis_pelapor_bil: reporters.indexOf(reporter) + 1,
                        lapis_pelapor_nama: reporter,
                        lapis_negeri_bil: states.indexOf(state) + 1,
                        lapis_negeri_nama: state,
                        lapis_daerah_bil: Math.floor(Math.random() * 100) + 1,
                        lapis_daerah_nama: dm.replace(' Jaya', ''), // Simple mock for district
                        lapis_parlimen_bil: Math.floor(Math.random() * 200) + 1,
                        lapis_parlimen_nama: state.substring(0, 3) + ' Parlimen ' + Math.floor(Math.random() * 5 + 1),
                        lapis_dun_bil: Math.floor(Math.random() * 300) + 1,
                        lapis_dun_nama: state.substring(0, 3) + ' DUN ' + Math.floor(Math.random() * 5 + 1),
                        lapis_dm_bil: Math.floor(Math.random() * 1000) + 1,
                        lapis_dm_nama: dm,
                        lapis_jenis_kawasan: areaType,
                        lapis_tajuk_isu: issueTitle,
                        lapis_ringkasan_isu: issueSummary,
                        lapis_lokasi: location,
                        lapis_latitude: (Math.random() * 5 + 1).toFixed(4), // Realistic Malaysian lat range approx 1-7
                        lapis_longitude: (Math.random() * 10 + 100).toFixed(4), // Realistic Malaysian long range approx 100-110
                        lapis_cadangan_intervensi: intervention,
                        lapis_waktu: `${randomDate.format('YYYY-MM-DD')} ${randomTime}`
                    });
                }
            };

            const chartColors = {
                blue: 'rgba(59, 130, 246, 0.7)',
                stone: 'rgba(120, 113, 108, 0.7)',
                red: 'rgba(239, 68, 68, 0.7)',
                green: 'rgba(34, 197, 94, 0.7)',
                yellow: 'rgba(234, 179, 8, 0.7)',
                purple: 'rgba(139, 92, 246, 0.7)',
                orange: 'rgba(249, 115, 22, 0.7)',
                teal: 'rgba(20, 184, 166, 0.7)',
                pink: 'rgba(236, 72, 153, 0.7)',
                cyan: 'rgba(6, 182, 212, 0.7)'
            };
            const availableColors = Object.values(chartColors);
            
            let charts = {};
            let currentSort = { key: 'lapis_bil', order: 'asc' };
            let filteredAndSortedData = []; // To hold the currently filtered and sorted data

            async function init() {
                showLoading();
                generateMockData(20000); // Generate 20,000 records for simulation
                await simulateApiFetch(); // Simulate API call delay
                populateFilters();
                initCharts();
                setupEventListeners();
                updateDashboard();
                hideLoading();
            }

            function showLoading() {
                document.getElementById('loading-overlay').classList.remove('hidden');
            }

            function hideLoading() {
                document.getElementById('loading-overlay').classList.add('hidden');
            }

            async function simulateApiFetch() {
                // Simulate network delay
                return new Promise(resolve => setTimeout(resolve, 1000)); 
            }

            function populateFilters() {
                // Get unique values from allData
                const clusters = [...new Set(allData.map(item => item.lapis_kluster_nama))].sort();
                const states = [...new Set(allData.map(item => item.lapis_negeri_nama))].sort();
                
                const klusterSelect = document.getElementById('filter-kluster');
                klusterSelect.innerHTML = '<option value="all">Semua Kluster</option>'; // Reset
                clusters.forEach(c => klusterSelect.innerHTML += `<option value="${c}">${c}</option>`);

                const negeriSelect = document.getElementById('filter-negeri');
                negeriSelect.innerHTML = '<option value="all">Semua Negeri</option>'; // Reset
                states.forEach(s => negeriSelect.innerHTML += `<option value="${s}">${s}</option>`);
            }

            function initCharts() {
                charts.monthly = new Chart(document.getElementById('monthlyReportsChart').getContext('2d'), { type: 'bar', options: getChartOptions('Laporan Bulanan') });
                charts.cluster = new Chart(document.getElementById('clusterDistributionChart').getContext('2d'), { type: 'doughnut', options: getChartOptions('Taburan Kluster') });
                charts.state = new Chart(document.getElementById('stateDistributionChart').getContext('2d'), { type: 'bar', options: {...getChartOptions('Taburan Negeri'), indexAxis: 'y' } });
                charts.map = new Chart(document.getElementById('mapScatterChart').getContext('2d'), { type: 'scatter', options: getMapChartOptions('Taburan Geografi') });
            }

            function getChartOptions(title) {
                return {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: title.includes('Taburan') }, 
                        title: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += context.parsed.y;
                                    }
                                    return label;
                                },
                                title: function(context) {
                                    if (context[0] && context[0].label) {
                                        const originalLabel = context[0].label;
                                        if (originalLabel.length > 16) {
                                            const words = originalLabel.split(' ');
                                            let wrappedLabel = [];
                                            let currentLine = '';
                                            for (let i = 0; i < words.length; i++) {
                                                if ((currentLine + words[i]).length <= 16) {
                                                    currentLine += (currentLine ? ' ' : '') + words[i];
                                                } else {
                                                    wrappedLabel.push(currentLine);
                                                    currentLine = words[i];
                                                }
                                            }
                                            wrappedLabel.push(currentLine);
                                            return wrappedLabel;
                                        }
                                    }
                                    return context[0].label;
                                }
                            }
                        }
                    },
                     scales: {
                        x: { ticks: { font: { size: 10 } } },
                        y: { ticks: { font: { size: 10 } } }
                    },
                    layout: { padding: 10 }
                };
            }

            function getMapChartOptions(title) {
                 return {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const point = context.raw;
                                    return `${point.lapis_tajuk_isu} (${point.lapis_negeri_nama})`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: { title: { display: true, text: 'Longitude' }, ticks: { font: { size: 10 } } },
                        y: { title: { display: true, text: 'Latitude' }, ticks: { font: { size: 10 } } }
                    },
                    onClick: (event, elements) => {
                        if (elements.length > 0) {
                            const chartElement = elements[0];
                            const data = charts.map.data.datasets[chartElement.datasetIndex].data[chartElement.index];
                            openModal(data);
                        }
                    }
                };
            }


            function setupEventListeners() {
                document.getElementById('filter-kluster').addEventListener('change', updateDashboard);
                document.getElementById('filter-negeri').addEventListener('change', updateDashboard);
                document.getElementById('filter-date-start').addEventListener('change', updateDashboard);
                document.getElementById('filter-date-end').addEventListener('change', updateDashboard);
                document.getElementById('reset-filters').addEventListener('click', () => {
                    document.getElementById('filter-kluster').value = 'all';
                    document.getElementById('filter-negeri').value = 'all';
                    document.getElementById('filter-date-start').value = '';
                    document.getElementById('filter-date-end').value = '';
                    updateDashboard();
                });
                
                document.querySelectorAll('.tab-button').forEach(button => {
                    button.addEventListener('click', function() {
                        document.querySelectorAll('.tab-button').forEach(btn => {
                            btn.classList.remove('border-blue-500', 'text-blue-600');
                            btn.classList.add('border-transparent', 'text-stone-500', 'hover:text-stone-700', 'hover:border-stone-300');
                        });
                        this.classList.add('border-blue-500', 'text-blue-600');
                        this.classList.remove('border-transparent', 'text-stone-500');

                        document.querySelectorAll('.tab-content').forEach(content => {
                            content.classList.add('hidden');
                        });
                        document.getElementById('content-' + this.id.split('-')[1]).classList.remove('hidden');
                    });
                });

                document.getElementById('search-table').addEventListener('input', (e) => updateTable(filteredAndSortedData, e.target.value));

                document.querySelectorAll('.table-header').forEach(header => {
                    header.addEventListener('click', () => {
                        const sortKey = header.dataset.sort;
                        if (currentSort.key === sortKey) {
                            currentSort.order = currentSort.order === 'asc' ? 'desc' : 'asc';
                        } else {
                            currentSort.key = sortKey;
                            currentSort.order = 'asc';
                        }
                        updateTable(getFilteredData(), document.getElementById('search-table').value);
                    });
                });

                document.getElementById('close-modal').addEventListener('click', closeModal);
                document.getElementById('report-modal').addEventListener('click', (e) => {
                    if (e.target.id === 'report-modal') closeModal();
                });
            }

            function getFilteredData() {
                const kluster = document.getElementById('filter-kluster').value;
                const negeri = document.getElementById('filter-negeri').value;
                const startDate = document.getElementById('filter-date-start').value;
                const endDate = document.getElementById('filter-date-end').value;

                return allData.filter(item => {
                    const itemDate = dayjs(item.lapis_tarikh_laporan, "YYYY-MM-DD");
                    const start = startDate ? dayjs(startDate) : null;
                    const end = endDate ? dayjs(endDate) : null;

                    const klusterMatch = kluster === 'all' || item.lapis_kluster_nama === kluster;
                    const negeriMatch = negeri === 'all' || item.lapis_negeri_nama === negeri;
                    const dateMatch = (!start || itemDate.isAfter(start.subtract(1, 'day'))) && (!end || itemDate.isBefore(end.add(1, 'day')));
                    
                    return klusterMatch && negeriMatch && dateMatch;
                });
            }
            
            function updateDashboard() {
                showLoading(); // Show loading indicator before processing
                setTimeout(() => { // Simulate processing delay for large datasets
                    const data = getFilteredData();
                    filteredAndSortedData = [...data]; // Store for table filtering/sorting
                    updateKPIs(data);
                    updateMonthlyChart(data);
                    updateClusterChart(data);
                    updateStateChart(data);
                    updateTable(data, document.getElementById('search-table').value);
                    updateMapChart(data);
                    hideLoading(); // Hide loading indicator after processing
                }, 100); // Small delay to show loading indicator
            }
            
            function updateKPIs(data) {
                document.getElementById('kpi-total').textContent = data.length;

                const thisMonthReports = data.filter(item => dayjs(item.lapis_tarikh_laporan).isSame(dayjs(), 'month')).length;
                document.getElementById('kpi-this-month').textContent = thisMonthReports;

                const clusterCounts = data.reduce((acc, item) => {
                    acc[item.lapis_kluster_nama] = (acc[item.lapis_kluster_nama] || 0) + 1;
                    return acc;
                }, {});
                const topCluster = Object.entries(clusterCounts).sort((a, b) => b[1] - a[1])[0];
                document.getElementById('kpi-top-cluster').textContent = topCluster ? topCluster[0] : '-';
                
                const stateCounts = data.reduce((acc, item) => {
                    acc[item.lapis_negeri_nama] = (acc[item.lapis_negeri_nama] || 0) + 1;
                    return acc;
                }, {});
                const topState = Object.entries(stateCounts).sort((a, b) => b[1] - a[1])[0];
                document.getElementById('kpi-top-state').textContent = topState ? topState[0] : '-';
            }

            function updateMonthlyChart(data) {
                const monthlyData = data.reduce((acc, item) => {
                    const month = dayjs(item.lapis_tarikh_laporan).format('YYYY-MM');
                    acc[month] = (acc[month] || 0) + 1;
                    return acc;
                }, {});

                const sortedMonths = Object.keys(monthlyData).sort();
                const labels = sortedMonths.map(month => dayjs(month).format('MMM YYYY'));
                const values = sortedMonths.map(month => monthlyData[month]);

                charts.monthly.data = {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Laporan',
                        data: values,
                        backgroundColor: availableColors[0],
                        borderColor: availableColors[0].replace('0.7', '1'),
                        borderWidth: 1
                    }]
                };
                charts.monthly.update();
            }

            function updateClusterChart(data) {
                const clusterCounts = data.reduce((acc, item) => {
                    acc[item.lapis_kluster_nama] = (acc[item.lapis_kluster_nama] || 0) + 1;
                    return acc;
                }, {});

                charts.cluster.data = {
                    labels: Object.keys(clusterCounts),
                    datasets: [{
                        data: Object.values(clusterCounts),
                        backgroundColor: availableColors.slice(0, Object.keys(clusterCounts).length),
                        hoverOffset: 4
                    }]
                };
                charts.cluster.update();
            }

            function updateStateChart(data) {
                const stateCounts = data.reduce((acc, item) => {
                    acc[item.lapis_negeri_nama] = (acc[item.lapis_negeri_nama] || 0) + 1;
                    return acc;
                }, {});
                
                const sortedStates = Object.entries(stateCounts).sort((a,b) => a[1] - b[1]);

                charts.state.data = {
                    labels: sortedStates.map(s => s[0]),
                    datasets: [{
                        label: 'Jumlah Laporan',
                        data: sortedStates.map(s => s[1]),
                        backgroundColor: availableColors[2]
                    }]
                };
                charts.state.update();
            }
            
            function updateMapChart(data) {
                const mapData = data.filter(item => item.lapis_latitude && item.lapis_longitude).map(item => ({
                    ...item,
                    x: parseFloat(item.lapis_longitude), // Ensure numeric for chart
                    y: parseFloat(item.lapis_latitude)   // Ensure numeric for chart
                }));
                
                charts.map.data = {
                    datasets: [{
                        label: 'Lokasi Laporan',
                        data: mapData,
                        backgroundColor: availableColors[3],
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                };
                charts.map.update();
            }

            function updateTable(data, searchTerm) {
                const tableBody = document.getElementById('report-table-body');
                tableBody.innerHTML = '';
                
                let displayData = [...data]; // Use a copy to avoid modifying the original filtered data
                if (searchTerm) {
                    displayData = displayData.filter(item => item.lapis_tajuk_isu.toLowerCase().includes(searchTerm.toLowerCase()));
                }
                
                displayData.sort((a, b) => {
                    const keyA = typeof a[currentSort.key] === 'string' ? a[currentSort.key].toLowerCase() : a[currentSort.key];
                    const keyB = typeof b[currentSort.key] === 'string' ? b[currentSort.key].toLowerCase() : b[currentSort.key];
                    if (keyA < keyB) return currentSort.order === 'asc' ? -1 : 1;
                    if (keyA > keyB) return currentSort.order === 'asc' ? 1 : -1;
                    return 0;
                });
                
                // Limit the number of rows displayed in the table for performance
                const displayLimit = 500; // Display max 500 rows
                if (displayData.length > displayLimit) {
                    displayData = displayData.slice(0, displayLimit);
                    // Optionally add a message indicating data truncation
                    const row = document.createElement('tr');
                    row.innerHTML = `<td colspan="5" class="text-center py-2 text-stone-500">Memaparkan ${displayLimit} laporan pertama. Sila gunakan penapis untuk melihat lebih banyak.</td>`;
                    tableBody.appendChild(row);
                }

                if (displayData.length === 0) {
                     tableBody.innerHTML = `<tr><td colspan="5" class="text-center py-4 text-stone-500">Tiada laporan ditemui.</td></tr>`;
                     return;
                }

                displayData.forEach(item => {
                    const row = document.createElement('tr');
                    row.className = "hover:bg-stone-50 cursor-pointer";
                    row.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-stone-900">${item.lapis_bil}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-500">${item.lapis_tarikh_laporan}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-500">${item.lapis_tajuk_isu}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-500">${item.lapis_kluster_nama}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-500">${item.lapis_negeri_nama}</td>
                    `;
                    row.addEventListener('click', () => openModal(item));
                    tableBody.appendChild(row);
                });
            }

            function openModal(item) {
                document.getElementById('modal-title').textContent = `Laporan #${item.lapis_bil}: ${item.lapis_tajuk_isu}`;
                const content = document.getElementById('modal-content');
                content.innerHTML = `
                    <p><strong>Pelapor:</strong> ${item.lapis_pelapor_nama}</p>
                    <p><strong>Kluster:</strong> ${item.lapis_kluster_nama}</p>
                    <p><strong>Tarikh Laporan:</strong> ${dayjs(item.lapis_tarikh_laporan).format('DD MMM YYYY')}</p>
                    <hr class="my-2">
                    <p><strong>Lokasi:</strong> ${item.lapis_lokasi}, ${item.lapis_dm_nama}, ${item.lapis_daerah_nama}, ${item.lapis_negeri_nama}</p>
                    <p><strong>Parlimen/DUN:</strong> ${item.lapis_parlimen_nama} / ${item.lapis_dun_nama}</p>
                    <p><strong>Koordinat:</strong> ${item.lapis_latitude}, ${item.lapis_longitude}</p>
                    <hr class="my-2">
                    <p><strong>Ringkasan Isu:</strong></p>
                    <p class="pl-2">${item.lapis_ringkasan_isu}</p>
                    <p class="mt-2"><strong>Cadangan Intervensi:</strong></p>
                    <p class="pl-2">${item.lapis_cadangan_intervensi}</p>
                `;
                document.getElementById('report-modal').classList.remove('hidden');
                document.getElementById('report-modal').classList.add('flex');
            }

            function closeModal() {
                 document.getElementById('report-modal').classList.add('hidden');
                 document.getElementById('report-modal').classList.remove('flex');
            }

            init();
        });
    </script>
</body>
</html>
