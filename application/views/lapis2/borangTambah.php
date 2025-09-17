<div class="my-0">
        
        <div class="card shadow-lg">
            <div class="card-body p-4 p-md-5">
                <div class="border-bottom pb-3 mb-4">
                    <h1 class="card-title h2">Borang Laporan Isu Baharu</h1>
                    <p class="card-subtitle text-muted">Sila lengkapkan semua maklumat yang diperlukan di bawah.</p>
                </div>

                <!-- Formulir ini akan mengirim data ke controller Lapis2, method simpanLaporan -->
                <form id="laporanForm" action="<?php echo site_url('lapis2/simpanLaporan'); ?>" method="POST">
                    
                    <!-- Bahagian 1: Maklumat Asas Laporan -->
                    <div class="mb-5">
                        <h2 class="h4 border-bottom pb-2 mb-3">Maklumat Asas</h2>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="lapis_kluster_bil" class="form-label">Kluster Isu</label>
                                <select id="lapis_kluster_bil" name="lapis_kluster_bil" class="form-select" required>
                                    <option value="" selected disabled>-- Sila Pilih Kluster --</option>
                                    <?php if (!empty($senaraiKluster)): ?>
                                        <?php foreach ($senaraiKluster as $kluster): ?>
                                            <option value="<?php echo htmlspecialchars($kluster->kit_bil, ENT_QUOTES, 'UTF-8'); ?>">
                                                <?php echo htmlspecialchars($kluster->kit_nama, ENT_QUOTES, 'UTF-8'); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="lapis_tarikh_laporan" class="form-label">Tarikh Laporan</label>
                                <input type="date" id="lapis_tarikh_laporan" name="lapis_tarikh_laporan" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <!-- Bahagian 2: Maklumat Kawasan -->
                    <div class="mb-5">
                        <h2 class="h4 border-bottom pb-2 mb-3">Maklumat Kawasan</h2>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="lapis_negeri_bil" class="form-label">Negeri</label>
                                <select id="lapis_negeri_bil" name="lapis_negeri_bil" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Negeri --</option>
                                    <?php if (!empty($senaraiNegeri)): ?>
                                        <?php foreach ($senaraiNegeri as $negeri): ?>
                                            <option value="<?php echo htmlspecialchars($negeri->nt_bil, ENT_QUOTES, 'UTF-8'); ?>">
                                                <?php echo htmlspecialchars($negeri->nt_nama, ENT_QUOTES, 'UTF-8'); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                             <div class="col-md-6">
                                <label for="lapis_daerah_bil" class="form-label">Daerah</label>
                                <select id="lapis_daerah_bil" name="lapis_daerah_bil" class="form-select" required disabled>
                                    <option value="" selected disabled>-- Pilih Negeri Dahulu --</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="lapis_parlimen_bil" class="form-label">Parlimen</label>
                                <select id="lapis_parlimen_bil" name="lapis_parlimen_bil" class="form-select" disabled>
                                    <option value="" selected disabled>-- Pilih Negeri Dahulu --</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="lapis_dun_bil" class="form-label">DUN</label>
                                <select id="lapis_dun_bil" name="lapis_dun_bil" class="form-select" disabled>
                                    <option value="" selected disabled>-- Pilih Negeri Dahulu --</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="lapis_dm_bil" class="form-label">Daerah Mengundi (DM)</label>
                                <select id="lapis_dm_bil" name="lapis_dm_bil" class="form-select" disabled>
                                    <option value="" selected disabled>-- Pilih Parlimen Dahulu --</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="lapis_jenis_kawasan" class="form-label">Jenis Kawasan</label>
                                <select id="lapis_jenis_kawasan" name="lapis_jenis_kawasan" class="form-select" required>
                                    <option value="" selected disabled>-- Sila Pilih Jenis --</option>
                                    <option value="Bandar">Bandar</option>
                                    <option value="Pinggir Bandar">Pinggir Bandar</option>
                                    <option value="Luar Bandar">Luar Bandar</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Bahagian 3: Butiran Isu -->
                    <div class="mb-5">
                        <h2 class="h4 border-bottom pb-2 mb-3">Butiran Isu</h2>
                        <div class="mb-3">
                            <label for="lapis_tajuk_isu" class="form-label">Tajuk Isu</label>
                            <input type="text" id="lapis_tajuk_isu" name="lapis_tajuk_isu" class="form-control" placeholder="Contoh: Isu Bekalan Air Terputus" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="ringkasan-editor" class="form-label">Ringkasan Isu</label>
                            <textarea id="ringkasan-editor" name="lapis_ringkasan_isu"></textarea>
                        </div>
                         <div>
                            <label for="cadangan-editor" class="form-label">Cadangan Intervensi</label>
                            <textarea id="cadangan-editor" name="lapis_cadangan_intervensi"></textarea>
                        </div>

                    </div>

                    <!-- Bahagian 4: Lokasi -->
                    <div class="mb-4">
                        <h2 class="h4 border-bottom pb-2 mb-3">Lokasi Spesifik</h2>
                         <div class="mb-3">
                            <label for="lapis_lokasi" class="form-label">Nama Lokasi</label>
                            <div class="input-group">
                                <input type="text" id="lapis_lokasi" name="lapis_lokasi" class="form-control" placeholder="Contoh: Istana Kehakiman, Putrajaya" required>
                                <button class="btn btn-outline-secondary" type="button" id="searchLocationBtn">Cari</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-end gap-3">
                            <div class="flex-grow-1">
                                <label for="lapis_latitude" class="form-label">Latitude</label>
                                <input type="text" id="lapis_latitude" name="lapis_latitude" class="form-control" readonly>
                            </div>
                            <div class="flex-grow-1">
                                <label for="lapis_longitude" class="form-label">Longitude</label>
                                <input type="text" id="lapis_longitude" name="lapis_longitude" class="form-control" readonly>
                            </div>
                        </div>
                         <div id="locationStatus" class="form-text"></div>
                    </div>

                    <!-- Butang Hantar -->
                    <div class="mt-5 pt-4 border-top">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2">
                                Batal
                            </button>
                            <button type="submit" id="submitBtn" class="btn btn-primary">
                                Hantar Laporan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Memuatkan skrip TinyMCE dengan API Key anda -->
    <script src="https://cdn.tiny.cloud/1/rjhyhcgruycqzaozo2ccbxx2w2kls6e23txrzauv1j2edfr1/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        // Mengaktifkan editor TinyMCE
        tinymce.init({
            selector: '#ringkasan-editor, #cadangan-editor',
            plugins: 'lists link image table code help wordcount',
            toolbar: 'undo redo | blocks | bold italic | bullist numlist | link image | table | help',
            height: 250,
            menubar: false,
        });

        document.addEventListener('DOMContentLoaded', function() {
            
            const negeriSelect = document.getElementById('lapis_negeri_bil');
            const daerahSelect = document.getElementById('lapis_daerah_bil');
            const parlimenSelect = document.getElementById('lapis_parlimen_bil');
            const dunSelect = document.getElementById('lapis_dun_bil');
            const dmSelect = document.getElementById('lapis_dm_bil');
            const form = document.getElementById('laporanForm');

            // --- AJAX for Dependent Dropdowns ---
            negeriSelect.addEventListener('change', function() {
                const negeriId = this.value;

                daerahSelect.innerHTML = '<option value="" selected disabled>Memuatkan...</option>';
                daerahSelect.disabled = true;
                parlimenSelect.innerHTML = '<option value="" selected disabled>Memuatkan...</option>';
                parlimenSelect.disabled = true;
                dunSelect.innerHTML = '<option value="" selected disabled>Memuatkan...</option>';
                dunSelect.disabled = true;
                dmSelect.innerHTML = '<option value="" selected disabled>-- Pilih Parlimen Dahulu --</option>';
                dmSelect.disabled = true;

                if (!negeriId) return;

                // Fetch districts, parliaments, and DUNs
                fetch('<?php echo site_url("lapis2/dapatkan_daerah"); ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'negeri_bil=' + encodeURIComponent(negeriId)
                })
                .then(response => response.ok ? response.json() : Promise.reject('Error fetching districts'))
                .then(data => {
                    daerahSelect.innerHTML = '<option value="" selected disabled>-- Sila Pilih Daerah --</option>';
                    data.forEach(daerah => {
                        const option = document.createElement('option');
                        option.value = daerah.bil; 
                        option.textContent = daerah.nama;
                        daerahSelect.appendChild(option);
                    });
                    daerahSelect.disabled = false;
                });

                fetch('<?php echo site_url("lapis2/dapatkan_parlimen"); ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'negeri_bil=' + encodeURIComponent(negeriId)
                })
                .then(response => response.ok ? response.json() : Promise.reject('Error fetching parliaments'))
                .then(data => {
                    parlimenSelect.innerHTML = '<option value="" selected disabled>-- Sila Pilih Parlimen --</option>';
                    data.forEach(parlimen => {
                        const option = document.createElement('option');
                        option.value = parlimen.pt_bil; 
                        option.textContent = parlimen.pt_nama;
                        parlimenSelect.appendChild(option);
                    });
                    parlimenSelect.disabled = false;
                });

                fetch('<?php echo site_url("lapis2/dapatkan_dun"); ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'negeri_bil=' + encodeURIComponent(negeriId)
                })
                .then(response => response.ok ? response.json() : Promise.reject('Error fetching DUN'))
                .then(data => {
                    dunSelect.innerHTML = '<option value="" selected disabled>-- Sila Pilih DUN --</option>';
                    data.forEach(dun => {
                        const option = document.createElement('option');
                        option.value = dun.dun_bil; 
                        option.textContent = dun.dun_nama;
                        dunSelect.appendChild(option);
                    });
                    dunSelect.disabled = false;
                });
            });

            parlimenSelect.addEventListener('change', function() {
                const parlimenId = this.value;

                dmSelect.innerHTML = '<option value="" selected disabled>Memuatkan...</option>';
                dmSelect.disabled = true;

                if (!parlimenId) return;

                fetch('<?php echo site_url("lapis2/dapatkan_pdm"); ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'parlimen_bil=' + encodeURIComponent(parlimenId)
                })
                .then(response => response.ok ? response.json() : Promise.reject('Error fetching PDM'))
                .then(data => {
                    dmSelect.innerHTML = '<option value="" selected disabled>-- Sila Pilih DM --</option>';
                    data.forEach(pdm => {
                        const option = document.createElement('option');
                        option.value = pdm.ppt_bil; 
                        option.textContent = pdm.ppt_nama;
                        dmSelect.appendChild(option);
                    });
                    dmSelect.disabled = false;
                })
                .catch(error => {
                    console.error(error);
                    dmSelect.innerHTML = '<option value="" selected disabled>Gagal memuatkan data</option>';
                });
            });
            
            // --- KEMAS KINI DI SINI: Menyimpan kandungan TinyMCE sebelum borang dihantar ---
            form.addEventListener('submit', function(e) {
                // Panggil fungsi triggerSave() dari TinyMCE
                // Ini akan menyalin kandungan dari editor ke textarea asal.
                tinymce.triggerSave();
            });
            // --- TAMAT KEMAS KINI ---
            
            // --- Geolocation Logic ---
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
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data && data.length > 0) {
                            const firstResult = data[0];
                            latInput.value = parseFloat(firstResult.lat).toFixed(6);
                            lonInput.value = parseFloat(firstResult.lon).toFixed(6);
                            statusP.textContent = 'Lokasi dijumpai.';
                            statusP.className = 'form-text text-success';
                        } else {
                            statusP.textContent = 'Lokasi tidak dijumpai. Sila cuba nama yang lebih spesifik.';
                            statusP.className = 'form-text text-danger';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching geocoding data:', error);
                        statusP.textContent = 'Ralat berlaku semasa carian. Sila cuba lagi.';
                        statusP.className = 'form-text text-danger';
                    });
            });
        });
    </script>
</div>
