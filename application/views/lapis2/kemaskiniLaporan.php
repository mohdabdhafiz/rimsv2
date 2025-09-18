<div class="pagetitle">
  <h1>Kemas Kini Laporan</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= site_url('lapis2/senaraiLaporan') ?>">Senarai Laporan</a></li>
      <li class="breadcrumb-item active">Kemas Kini Laporan #<?= $laporan->lapis_bil ?></li>
    </ol>
  </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Borang Kemas Kini Laporan</h5>

                    <form id="kemaskiniForm" action="<?= site_url('lapis2/prosesKemaskini') ?>" method="POST">
                        
                        <input type="hidden" name="lapis_bil" value="<?= $laporan->lapis_bil ?>">

                        <!-- Bahagian 1: Maklumat Asas -->
                        <h5 class="card-title mt-4">Maklumat Asas</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="lapis_kluster_bil" class="form-label">Kluster Isu</label>
                                <select name="lapis_kluster_bil" id="lapis_kluster_bil" class="form-select" required>
                                    <?php foreach($senaraiKluster as $kluster): ?>
                                        <!-- KEMAS KINI DI SINI: Menambah data-kluster-nama -->
                                        <option 
                                            value="<?= $kluster->kit_bil ?>" 
                                            data-kluster-nama="<?= htmlspecialchars(strtoupper($kluster->kit_nama), ENT_QUOTES, 'UTF-8') ?>"
                                            <?= ($kluster->kit_bil == $laporan->lapis_kluster_bil) ? 'selected' : '' ?>>
                                            <?= strtoupper($kluster->kit_nama) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="lapis_tarikh_laporan" class="form-label">Tarikh Laporan</label>
                                <input type="date" name="lapis_tarikh_laporan" class="form-control" value="<?= $laporan->lapis_tarikh_laporan ?>" required>
                            </div>
                        </div>

                        <!-- Bahagian 2: Maklumat Kawasan -->
                        <h5 class="card-title">Maklumat Kawasan</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="lapis_negeri_bil" class="form-label">Negeri</label>
                                <select name="lapis_negeri_bil" id="lapis_negeri_bil" class="form-select" required>
                                    <?php foreach($senaraiNegeri as $negeri): ?>
                                        <option value="<?= $negeri->nt_bil ?>" <?= ($negeri->nt_bil == $laporan->lapis_negeri_bil) ? 'selected' : '' ?>>
                                            <?= strtoupper($negeri->nt_nama) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="lapis_daerah_bil" class="form-label">Daerah</label>
                                <select name="lapis_daerah_bil" id="lapis_daerah_bil" class="form-select" required>
                                    <?php foreach($senaraiDaerah as $daerah): ?>
                                        <option value="<?= $daerah->bil ?>" <?= ($daerah->bil == $laporan->lapis_daerah_bil) ? 'selected' : '' ?>>
                                            <?= strtoupper($daerah->nama) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="lapis_parlimen_bil" class="form-label">Parlimen</label>
                                <select name="lapis_parlimen_bil" id="lapis_parlimen_bil" class="form-select">
                                     <?php foreach($senaraiParlimen as $parlimen): ?>
                                        <option value="<?= $parlimen->pt_bil ?>" <?= ($parlimen->pt_bil == $laporan->lapis_parlimen_bil) ? 'selected' : '' ?>>
                                            <?= strtoupper($parlimen->pt_nama) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="lapis_dun_bil" class="form-label">DUN</label>
                                <select name="lapis_dun_bil" id="lapis_dun_bil" class="form-select">
                                     <?php foreach($senaraiDun as $dun): ?>
                                        <option value="<?= $dun->dun_bil ?>" <?= ($dun->dun_bil == $laporan->lapis_dun_bil) ? 'selected' : '' ?>>
                                            <?= strtoupper($dun->dun_nama) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                             <div class="col-md-6">
                                <label for="lapis_dm_bil" class="form-label">Daerah Mengundi (DM)</label>
                                <select name="lapis_dm_bil" id="lapis_dm_bil" class="form-select">
                                     <?php foreach($senaraiDm as $dm): ?>
                                        <option value="<?= $dm->ppt_bil ?>" <?= ($dm->ppt_bil == $laporan->lapis_dm_bil) ? 'selected' : '' ?>>
                                            <?= strtoupper($dm->ppt_nama) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="lapis_jenis_kawasan" class="form-label">Jenis Kawasan</label>
                                <select name="lapis_jenis_kawasan" id="lapis_jenis_kawasan" class="form-select">
                                    <option value="Bandar" <?= ($laporan->lapis_jenis_kawasan == 'Bandar') ? 'selected' : '' ?>>Bandar</option>
                                    <option value="Pinggir Bandar" <?= ($laporan->lapis_jenis_kawasan == 'Pinggir Bandar') ? 'selected' : '' ?>>Pinggir Bandar</option>
                                    <option value="Luar Bandar" <?= ($laporan->lapis_jenis_kawasan == 'Luar Bandar') ? 'selected' : '' ?>>Luar Bandar</option>
                                </select>
                            </div>
                        </div>

                        <div id="bahagian-spesifik-kluster"></div>

                        <!-- Bahagian 3: Butiran Isu -->
                        <h5 class="card-title">Butiran Isu</h5>
                        <div class="row g-3 mb-4">
                             <div class="col-12">
                                <label for="lapis_tajuk_isu" class="form-label">Tajuk Isu</label>
                                <input type="text" name="lapis_tajuk_isu" class="form-control" value="<?= htmlspecialchars($laporan->lapis_tajuk_isu, ENT_QUOTES, 'UTF-8') ?>" required>
                            </div>
                            <div class="col-12">
                                <label for="ringkasan-editor-kemaskini" class="form-label">Ringkasan Isu</label>
                                <textarea id="ringkasan-editor-kemaskini" name="lapis_ringkasan_isu"><?= $laporan->lapis_ringkasan_isu ?></textarea>
                            </div>
                            <div class="col-12">
                                <label for="cadangan-editor-kemaskini" class="form-label">Cadangan Intervensi</label>
                                <textarea id="cadangan-editor-kemaskini" name="lapis_cadangan_intervensi"><?= $laporan->lapis_cadangan_intervensi ?></textarea>
                            </div>
                        </div>

                        <!-- KEMAS KINI DI SINI: Menambah Bahagian Lokasi -->
                        <h5 class="card-title">Lokasi Spesifik</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label for="lapis_lokasi" class="form-label">Nama Lokasi</label>
                                <div class="input-group">
                                    <input type="text" id="lapis_lokasi" name="lapis_lokasi" class="form-control" value="<?= htmlspecialchars($laporan->lapis_lokasi, ENT_QUOTES, 'UTF-8') ?>" placeholder="Contoh: Istana Kehakiman, Putrajaya" required>
                                    <button class="btn btn-outline-secondary" type="button" id="searchLocationBtn">Cari</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="lapis_latitude" class="form-label">Latitude</label>
                                <input type="text" id="lapis_latitude" name="lapis_latitude" class="form-control" value="<?= htmlspecialchars($laporan->lapis_latitude, ENT_QUOTES, 'UTF-8') ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="lapis_longitude" class="form-label">Longitude</label>
                                <input type="text" id="lapis_longitude" name="lapis_longitude" class="form-control" value="<?= htmlspecialchars($laporan->lapis_longitude, ENT_QUOTES, 'UTF-8') ?>" readonly>
                            </div>
                            <div class="col-12">
                                <div id="locationStatus" class="form-text"></div>
                            </div>
                        </div>
                        <!-- TAMAT KEMAS KINI -->

                        <!-- Bahagian 4: Status Laporan -->
                        <h5 class="card-title">Status Laporan</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="lapis_status" class="form-label">Status Laporan</label>
                                <select name="lapis_status" id="lapis_status" class="form-select" required>
                                    <option value="Laporan Diterima" <?= ($laporan->lapis_status == 'Laporan Diterima') ? 'selected' : '' ?>>Laporan Diterima</option>
                                    <option value="Laporan Dipinda" <?= ($laporan->lapis_status == 'Laporan Dipinda') ? 'selected' : '' ?>>Laporan Dipinda</option>
                                    <option value="Laporan Ditolak" <?= ($laporan->lapis_status == 'Laporan Ditolak') ? 'selected' : '' ?>>Laporan Ditolak</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Bahagian Ulasan (tersembunyi secara lalai) -->
                        <div id="ulasan-section" class="mb-4" style="display: none;">
                             <h5 class="card-title">Ulasan Penolakan</h5>
                             <p class="small text-muted">Pilih sebab mengapa laporan ini ditolak.</p>
                             <?php
                                $ulasan_sedia_ada = explode(', ', $laporan->lapis_ulasan_tolak);
                                $pilihan_ulasan = ['Bukan Isu', 'Tidak Relevan', 'Mengelirukan', 'Berulang'];
                             ?>
                             <?php foreach($pilihan_ulasan as $ulasan): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ulasan_tolak[]" value="<?= $ulasan ?>" id="ulasan_<?= str_replace(' ', '_', $ulasan) ?>"
                                        <?= in_array($ulasan, $ulasan_sedia_ada) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="ulasan_<?= str_replace(' ', '_', $ulasan) ?>">
                                        <?= $ulasan ?>
                                    </label>
                                </div>
                             <?php endforeach; ?>
                        </div>

                        <div class="text-center mt-4">
                            <a href="<?= site_url('lapis2/lihatLaporan/' . $laporan->lapis_bil) ?>" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Kemas Kini</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Memuatkan skrip TinyMCE dengan API Key anda -->
<script src="https://cdn.tiny.cloud/1/rjhyhcgruycqzaozo2ccbxx2w2kls6e23txrzauv1j2edfr1/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    // Mengaktifkan editor TinyMCE
    tinymce.init({
        selector: '#ringkasan-editor-kemaskini, #cadangan-editor-kemaskini',
        plugins: 'lists link image table code help wordcount',
        toolbar: 'undo redo | blocks | bold italic | bullist numlist | link image | table | help',
        height: 250,
        menubar: false,
    });

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('kemaskiniForm');
        form.addEventListener('submit', function(e) {
            tinymce.triggerSave();
        });
        
        const negeriSelect = document.getElementById('lapis_negeri_bil');
        const daerahSelect = document.getElementById('lapis_daerah_bil');
        const parlimenSelect = document.getElementById('lapis_parlimen_bil');
        const dunSelect = document.getElementById('lapis_dun_bil');
        const dmSelect = document.getElementById('lapis_dm_bil');
        const statusSelect = document.getElementById('lapis_status');
        const ulasanSection = document.getElementById('ulasan-section');

        

        function toggleUlasanSection() {
            if (statusSelect.value === 'Laporan Ditolak') {
                ulasanSection.style.display = 'block';
            } else {
                ulasanSection.style.display = 'none';
            }
        }

        // Panggil fungsi semasa halaman dimuatkan untuk set keadaan awal
        toggleUlasanSection();

        // Panggil fungsi setiap kali status ditukar
        statusSelect.addEventListener('change', toggleUlasanSection);

        negeriSelect.addEventListener('change', function() {
            const negeriId = this.value;

            daerahSelect.innerHTML = '<option value="">Memuatkan...</option>';
            parlimenSelect.innerHTML = '<option value="">Memuatkan...</option>';
            dunSelect.innerHTML = '<option value="">Memuatkan...</option>';
            dmSelect.innerHTML = '<option value="">-- Pilih Parlimen Dahulu --</option>';
            dmSelect.disabled = true;
            
            if (!negeriId) return;

            // Fetch districts, parliaments, and DUNs
            fetch('<?php echo site_url("lapis2/dapatkan_daerah"); ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'negeri_bil=' + encodeURIComponent(negeriId)
            })
            .then(response => response.json())
            .then(data => {
                daerahSelect.innerHTML = '<option value="">-- Sila Pilih --</option>';
                data.forEach(item => {
                    daerahSelect.innerHTML += `<option value="${item.bil}">${item.nama.toUpperCase()}</option>`;
                });
            });

            fetch('<?php echo site_url("lapis2/dapatkan_parlimen"); ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'negeri_bil=' + encodeURIComponent(negeriId)
            })
            .then(response => response.json())
            .then(data => {
                parlimenSelect.innerHTML = '<option value="">-- Sila Pilih --</option>';
                data.forEach(item => {
                    parlimenSelect.innerHTML += `<option value="${item.pt_bil}">${item.pt_nama.toUpperCase()}</option>`;
                });
            });

            fetch('<?php echo site_url("lapis2/dapatkan_dun"); ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'negeri_bil=' + encodeURIComponent(negeriId)
            })
            .then(response => response.json())
            .then(data => {
                dunSelect.innerHTML = '<option value="">-- Sila Pilih --</option>';
                data.forEach(item => {
                    dunSelect.innerHTML += `<option value="${item.dun_bil}">${item.dun_nama.toUpperCase()}</option>`;
                });
            });
        });

        parlimenSelect.addEventListener('change', function() {
            const parlimenId = this.value;

            dmSelect.innerHTML = '<option value="">Memuatkan...</option>';
            dmSelect.disabled = !parlimenId;

            if (!parlimenId) return;

            fetch('<?php echo site_url("lapis2/dapatkan_pdm"); ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'parlimen_bil=' + encodeURIComponent(parlimenId)
            })
            .then(response => response.json())
            .then(data => {
                dmSelect.innerHTML = '<option value="">-- Sila Pilih --</option>';
                data.forEach(item => {
                    dmSelect.innerHTML += `<option value="${item.ppt_bil}">${item.ppt_nama.toUpperCase()}</option>`;
                });
            });
        });
        // KEMAS KINI DI SINI: Menambah logik Geolocation
        const searchLocationBtn = document.getElementById('searchLocationBtn');
        const locationInput = document.getElementById('lapis_lokasi');
        const latInput = document.getElementById('lapis_latitude');
        const lonInput = document.getElementById('lapis_longitude');
        const statusP = document.getElementById('locationStatus');

        searchLocationBtn.addEventListener('click', () => {
            const address = locationInput.value.trim();
            if (!address) {
                statusP.textContent = 'Sila masukkan nama lokasi untuk carian.';
                statusP.className = 'form-text text-warning';
                return;
            }

            statusP.textContent = `Mencari "${address}"...`;
            statusP.className = 'form-text text-muted';

            const apiUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        const firstResult = data[0];
                        latInput.value = parseFloat(firstResult.lat).toFixed(6);
                        lonInput.value = parseFloat(firstResult.lon).toFixed(6);
                        statusP.textContent = 'Lokasi dijumpai.';
                        statusP.className = 'form-text text-success';
                    } else {
                        statusP.textContent = 'Lokasi tidak dijumpai.';
                        statusP.className = 'form-text text-danger';
                    }
                })
                .catch(error => {
                    console.error('Error fetching geocoding data:', error);
                    statusP.textContent = 'Ralat berlaku semasa carian.';
                    statusP.className = 'form-text text-danger';
                });
        });

        const klusterSelect = document.getElementById('lapis_kluster_bil');
        const bahagianSpesifik = document.getElementById('bahagian-spesifik-kluster');
        const laporanData = <?= json_encode($laporan ?? null) ?>;

        function muatkanBorangSpesifik() {
            // KEMAS KINI DI SINI: Menggunakan getAttribute untuk mendapatkan nama kluster
            const selectedOption = klusterSelect.options[klusterSelect.selectedIndex];
            const selectedKlusterNama = selectedOption.getAttribute('data-kluster-nama');
            
            bahagianSpesifik.innerHTML = ''; // Kosongkan bahagian

            // Bahagian Spesifik untuk EKONOMI
            if (selectedKlusterNama === 'EKONOMI') {
                const hargaNaik = laporanData && laporanData.lapis_ekonomi_harga_naik ? laporanData.lapis_ekonomi_harga_naik.split(', ') : [];
                const bekalanKurang = laporanData && laporanData.lapis_ekonomi_bekalan_kurang ? laporanData.lapis_ekonomi_bekalan_kurang.split(', ') : [];
                
                const senaraiHarga = ['Ayam', 'Telur Ayam', 'Minyak Masak Botol', 'Minyak Masak Paket', 'Sayur-sayuran', 'Ikan', 'Daging'];
                const senaraiBekalan = ['Ayam', 'Telur Ayam', 'Minyak Masak Paket', 'Gula', 'Tepung'];

                let html = `<h5 class="card-title">Butiran Kluster Ekonomi</h5>`;
                html += `<div class="row g-3">`;
                html += `<div class="col-md-6"><label class="form-label">Isu Kenaikan Harga:</label>`;
                senaraiHarga.forEach(item => {
                    html += `
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ekonomi_harga_naik[]" value="${item}" ${hargaNaik.includes(item) ? 'checked' : ''}>
                            <label class="form-check-label">${item}</label>
                        </div>
                    `;
                });
                html += `</div>`;

                html += `<div class="col-md-6"><label class="form-label">Isu Kekurangan Bekalan:</label>`;
                senaraiBekalan.forEach(item => {
                    html += `
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ekonomi_bekalan_kurang[]" value="${item}" ${bekalanKurang.includes(item) ? 'checked' : ''}>
                            <label class="form-check-label">${item}</label>
                        </div>
                    `;
                });
                html += `</div>`;
                html += `</div>`;

                bahagianSpesifik.innerHTML = html;
            }
            
            // ... (tambah 'else if' untuk kluster lain di sini)

        }

        klusterSelect.addEventListener('change', muatkanBorangSpesifik);
        muatkanBorangSpesifik(); // Panggil fungsi semasa halaman dimuatkan

        
    });
</script>
