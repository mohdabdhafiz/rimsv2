<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KEDUDUKAN TERKINI <?= $pru->pruSingkatan ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        html, body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: #f8f9fa;
        }
        .dashboard-container {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .card-stat {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .card-stat:hover {
            transform: translateY(-5px);
        }
        .stat-icon {
            font-size: 2rem;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="bg-light border-bottom shadow-sm">
            <div class="container-fluid p-4">
            <div class="row align-items-center">
            <div class="col-md-8">
            <h1 class="mb-2" style="font-size: 2.5rem; font-weight: 700; color: #2c3e50;">
                <?= $pru->pruNama ?>
            </h1>
            <p class="mb-0 text-muted" style="font-size: 1.1rem;">
                <i class="bi bi-info-circle me-2"></i><?= $pru->pruJenis ?>
            </p>
            </div>
            <div class="col-md-4 text-end">
            <span class="badge bg-primary" style="font-size: 1rem; padding: 0.5rem 1rem;">
                Kedudukan Terkini
            </span>
            <div id="liveDateTime" class="mt-2" style="font-size: 0.9rem; color: #666;"></div>
            </div>
            </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="container-fluid p-4" style="flex-grow: 1; overflow-y: auto;">
    <div class="row">
        
        <div class="col-1" style="overflow-y: auto; max-height: calc(100vh - 200px);">
            <div class="row">
            <?php foreach($senaraiParti as $parti): ?>
            <div class="col-12 mb-3"> <div class="card text-center" style="width: 5rem;"> <div class="card-body p-2">
                    <img src="<?= base_url('assets/img/').$parti->partiLogo ?>" alt="<?= $parti->partiNama ?>" class="img-fluid mb-2" style="max-height: 40px;">
                    <h6 class="card-title mb-0" style="font-size: 0.8rem;"><?= $parti->partiSingkatan ?></h6>
                    <span class="badge bg-secondary" style="font-size: 0.75rem;"><?= $parti->bilanganCalon ?> Calon</span>
                </div>
                </div>
            </div>
            <?php endforeach; ?>
            </div>
        </div>

        <div class="col-10">
            <h5><i class="bi bi-person-check-fill"></i> Culaan Kerusi <?= date('Y-m-d') ?></h5>
            <hr>
            <div class="row" id="senaraiKerusiContainer">
                </div>
        </div>

        <div class="col-1">
            <div class="mb-3" id="kedudukanPartiContainer">
                </div>
            
            <div id="kedudukanGradingContainer">
                 </div>
        </div>

    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    /**
     * Fungsi Utama: Memuatkan data dari server.
     */
    function loadData() {
        var xhr = new XMLHttpRequest();
        
        // PASTIKAN ANDA ADA CONTROLLER/FUNGSI INI: 'dashboard/fetch_election_data'
        // Ia perlu memulangkan JSON cth: { senaraiKerusi: [...], kedudukanParti: [...] }
        xhr.open('GET', '<?php echo base_url("dashboard/fetch_data/").$pru->pruBil; ?>', true);
        
        xhr.onload = function() {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                
                // Panggil fungsi render baharu
                renderSenaraiKerusi(data.senaraiKerusi);
                renderKedudukanParti(data.kedudukanParti);
                renderKedudukanGrading(data.kedudukanGrading); // Anda boleh tambah ini
            }
        };
        xhr.send();
    }

    /**
     * Fungsi Render Baharu 1: Memaparkan senarai kerusi di lajur tengah.
     * INI HANYALAH CONTOH - Sila ubah suai berdasarkan data JSON anda.
     */
    function renderSenaraiKerusi(kerusiList) {
        var container = document.getElementById('senaraiKerusiContainer');
        if (!container || !kerusiList) return; // Berhenti jika container tiada

        var html = '';
        for (var i = 0; i < kerusiList.length; i++) {
            var kerusi = kerusiList[i];
            
            
            // Contoh binaan kad. Anda mesti sesuaikannya.
            html += `
                <div class="col-md-4 mb-3">
                    <div class="card card-stat">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">${kerusi.kerusiNama}</h6>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">${kerusi.calonNama}</h5>
                            <p class="card-text mb-1">
                                <img src="<?= base_url('assets/img/') ?>${kerusi.partiLogo}" style="height: 20px; width: 20px; margin-right: 5px;">
                                ${kerusi.partiNama}
                            </p>
                            <p class="text-muted">Majoriti: <strong class="text-dark">${kerusi.statusGrading}</strong></p>
                        </div>
                    </div>
                </div>
            `;
        }
        container.innerHTML = html;
    }

    /**
     * Fungsi Render Baharu 2: Memaparkan kedudukan parti di lajur kanan.
     * INI HANYALAH CONTOH - Sila ubah suai berdasarkan data JSON anda.
     */
    function renderKedudukanParti(partiList) {
        var container = document.getElementById('kedudukanPartiContainer');
        if (!container || !partiList) return; // Berhenti jika container tiada

        var html = '<h6 class="text-muted mb-2">Status Parti</h6>';
        html += '<ul class="list-group list-group-flush">';
        
        for (var i = 0; i < partiList.length; i++) {
            var parti = partiList[i];
            html += `
                <li class="list-group-item d-flex justify-content-between align-items-center p-1" style="font-size: 0.8rem;">
                    <span>
                        <img src="<?= base_url('assets/img/') ?>${parti.partiLogo}" style="height: 15px; width: 15px; margin-right: 3px;">
                        ${parti.partiSingkatan}
                    </span>
                    <span class="badge bg-primary rounded-pill">${parti.jumlahMenang}</span>
                </li>
            `;
        }
        
        html += '</ul>';
        container.innerHTML = html;
    }

    /**
     * Fungsi Render Baharu 3: Memaparkan kedudukan grading di lajur kanan.
     * INI HANYALAH CONTOH - Sila ubah suai berdasarkan data JSON anda.
     */
    function renderKedudukanGrading(gradingList) {
        var container = document.getElementById('kedudukanGradingContainer');
        if (!container || !gradingList) return; // Berhenti jika container tiada

        var html = '<h6 class="text-muted mb-2">Status Parti</h6>';
        html += '<ul class="list-group list-group-flush">';
        
        for (var i = 0; i < gradingList.length; i++) {
            var grading = gradingList[i];
            html += `
                <li class="list-group-item d-flex justify-content-between align-items-center p-1" style="font-size: 0.8rem;">
                    <span>
                        <img src="${grading.logo}" style="height: 15px; width: 15px; margin-right: 3px;">
                        ${grading.singkatan}
                    </span>
                    <span class="badge bg-primary rounded-pill">${grading.jumlahMenang}</span>
                </li>
            `;
        }
        
        html += '</ul>';
        container.innerHTML = html;
    }

    /**
     * Fungsi Utiliti: Mengemas kini jam 'live'.
     */
    function updateDateTime() {
        var now = new Date();
        var options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric', 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit' 
        };
        var el = document.getElementById('liveDateTime');
        if (el) {
            el.innerHTML = now.toLocaleString('ms-MY', options);
        }
    }

    // --- PENGURUSAN MUKTAMAD ---
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Muatkan data & jam serta-merta
        loadData();
        updateDateTime();

        // 2. Set 'auto-refresh'
        setInterval(loadData, 30000); // Muat semula data setiap 30 saat
        setInterval(updateDateTime, 1000); // Kemas kini jam setiap 1 saat
    });
</script>
</body>
</html>
