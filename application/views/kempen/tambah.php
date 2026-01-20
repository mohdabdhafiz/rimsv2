
    <div class="pagetitle">
        <h1>Tambah Laporan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">UTAMA</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url("kempen") ?>">LAPORAN AKTIVITI KEMPEN</a></li>
                <li class="breadcrumb-item active">Tambah Laporan</li>
            </ol>
        </nav>
    </div><section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Borang Laporan Aktiviti Kempen</h5>

                        <?php if($this->session->flashdata("mesej")): ?>
                        <?= $this->session->flashdata("mesej") ?>
                        <?php endif; ?>

                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                        <form class="row g-3" action="<?= site_url('kempen/simpan') ?>" method="post" enctype="multipart/form-data">

                        <div class="col-md-4">
                                <label for="inputPru" class="form-label">Pilihan Raya Umum</label>
                                <select class="form-select" id="inputPru" name="inputPru" required>
                                    <option value="">Sila Pilih...</option>
                                    <?php foreach($senaraiPruAktif as $pru): ?>
                                    <option value="<?= $pru->pruBil ?>"><?= htmlspecialchars($pru->pruNama) ?></option>
                                    <?php endforeach; ?>
                                </select>
                        </div>

                            <div class="col-md-4">
                                <label for="tarikh" class="form-label">Tarikh</label>
                                <input type="date" class="form-control" id="tarikh" name="tarikh" required>
                            </div>

                            <div class="col-md-4">
                                <label for="masa" class="form-label">Masa</label>
                                <input type="time" class="form-control" id="masa" name="masa" required>
                            </div>

                            <div class="col-12">
                                <label for="inputPdm_search" class="form-label">Daerah Mengundi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                    <input type="search" id="inputPdm_search" class="form-control" placeholder="Cari Daerah..." aria-label="Cari Daerah">
                                </div>
                                <div id="inputPdm_container" class="mb-2 row g-3">
                                    <?php foreach($senaraiPdm as $index => $pdm): ?>
                                    <div class="col-12 col-sm-6 col-md-2">
                                        <label class="form-check p-3 border rounded w-100 d-flex align-items-center cursor-pointer" for="inputPdm_<?= $pdm->dmBil ?>">
                                            <input class="form-check-input me-2" type="radio" name="inputPdm" id="inputPdm_<?= $pdm->dmBil ?>" value="<?= $pdm->dmBil ?>" <?= $index === 0 ? 'required' : '' ?>>
                                            <span class="flex-grow-1"><?= $pdm->dmNama ?></span>
                                        </label>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <div id="inputPdm_noresults" class="form-text text-muted" style="display:none;">Tiada padanan.</div>
                            </div>
                            
                            <div class="col-12">
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                            </div>
                            
                            <div class="col-12">
                                <label for="inputParti_search" class="form-label">Parti</label>
                                <input type="text" id="inputParti_search" class="form-control mb-2" placeholder="Cari Parti..." />
                                <div id="inputParti_container" class="mb-2 row g-3">
                                    <?php foreach($senaraiParti as $index => $parti): ?>
                                    <div class="col-12 col-sm-6 col-md-2">
                                        <label class="form-check p-3 border rounded w-100 d-flex flex-column align-items-center cursor-pointer" for="inputParti_<?= $parti->partiBil ?>" style="<?= htmlspecialchars($parti->partiWarna) ?>">
                                            <img src="<?= base_url('assets/img/').$parti->partiLogo ?>" alt="<?= htmlspecialchars($parti->partiNama) ?>" style="object-fit:contain; width:100%; max-height:60px" class="mb-2" />
                                            <span class="fw-bold text-center"><?= $parti->partiNama ?></span>
                                            <input class="form-check-input mt-3" type="radio" name="inputParti" id="inputParti_<?= $parti->partiBil ?>" value="<?= $parti->partiBil ?>" <?= $index === 0 ? 'required' : '' ?>>
                                        </label>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <div id="inputParti_noresults" class="form-text text-muted" style="display:none;">Tiada padanan.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="aktiviti" class="form-label">Aktiviti</label>
                                <input type="text" class="form-control" id="aktiviti" name="aktiviti" required>
                            </div>

                            <div class="col-md-6">
                                <label for="inputJenisAktiviti" class="form-label">Jenis Aktiviti</label>
                                <select class="form-select" id="inputJenisAktiviti" name="inputJenisAktiviti">
                                    <option value="">Sila Pilih...</option>
                                    <option value="Ceramah">Ceramah</option>
                                    <option value="Walkabout">Walkabout</option>
                                    <option value="Lawatan Rumah Ke Rumah">Lawatan Rumah Ke Rumah</option>
                                    <option value="Santai">Santai</option>
                                    <option value="Ramah Mesra">Ramah Mesra</option>
                                    <option value="Sidang Media">Sidang Media</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="calon_parti" class="form-label">Pemimpin Yang Hadir</label>
                                <textarea name="calon_parti" id="calon_parti" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="inputIsuBerbangkit" class="form-label">Senarai Isu Berbangkit</label>
                                <textarea name="inputIsuBerbangkit" id="inputIsuBerbangkit" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="inputGambar" class="form-label">Gambar</label>
                                <input type="file" name="inputGambar[]" id="inputGambar" class="form-control" accept="image/*" multiple>
                            </div>

                            <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                            <input type="hidden" name="inputTarikhCipta" value="<?= date("Y-m-d H:i:s") ?>">
                            <input type="hidden" name="inputPuncaDmDun" value="<?= $inputPuncaDmDun ?>">
                            
                            <div class="col-12 text-start">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>

                        </form></div><script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var input = document.getElementById('inputPdm_search');
                        var container = document.getElementById('inputPdm_container');
                        var itemCols = Array.from(container.querySelectorAll('.col-12'));
                        var noresults = document.getElementById('inputPdm_noresults');

                        // helper to update visual state of selected item
                        function updateSelectedStyles() {
                            itemCols.forEach(function(col) {
                                var label = col.querySelector('.form-check');
                                var radio = col.querySelector('input[type="radio"]');
                                if (radio && radio.checked) {
                                    label.classList.add('border-primary', 'shadow-sm');
                                } else {
                                    label.classList.remove('border-primary', 'shadow-sm');
                                }
                            });
                        }

                        // initial style update (for required first item)
                        if (document.querySelector('input[name="inputPdm"]:checked')) {
                             updateSelectedStyles();
                        }

                        // when any radio changes, refresh styles
                        container.addEventListener('change', function(e) {
                            if (e.target && e.target.matches('input[type="radio"]')) {
                                updateSelectedStyles();
                            }
                        });

                        // filter logic
                        input.addEventListener('input', function() {
                            var q = this.value.trim().toLowerCase();
                            var anyVisible = false;

                            itemCols.forEach(function(col) {
                                var labelText = col.querySelector('label').textContent.toLowerCase();
                                var match = q === '' || labelText.indexOf(q) !== -1;
                                col.style.display = match ? '' : 'none';

                                if (!match) {
                                    var radio = col.querySelector('input[type="radio"]');
                                    if (radio && radio.checked) {
                                        radio.checked = false;
                                    }
                                } else {
                                    anyVisible = true;
                                }
                            });

                            noresults.style.display = anyVisible ? 'none' : '';
                            updateSelectedStyles();
                        });

                        // allow clicking the whole label/card to toggle selection and update styles
                        itemCols.forEach(function(col) {
                            var label = col.querySelector('.form-check');
                            label.addEventListener('click', function(e) {
                                // normal label behavior will check the radio; just ensure styles update after event
                                setTimeout(updateSelectedStyles, 10);
                            });
                        });
                    });
                    </script>
                    
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var input = document.getElementById('inputParti_search');
                        var container = document.getElementById('inputParti_container');
                        var itemCols = Array.from(container.querySelectorAll('.col-12'));
                        var noresults = document.getElementById('inputParti_noresults');

                        function updateSelectedStyles() {
                            itemCols.forEach(function(col) {
                                var label = col.querySelector('.form-check');
                                var radio = col.querySelector('input[type="radio"]');
                                if (radio && radio.checked) {
                                    label.classList.add('border-primary', 'shadow-sm');
                                } else {
                                    label.classList.remove('border-primary', 'shadow-sm');
                                }
                            });
                        }

                        // initial update
                        if (document.querySelector('input[name="inputParti"]:checked')) {
                            updateSelectedStyles();
                        }

                        // update on change
                        container.addEventListener('change', function(e) {
                            if (e.target && e.target.matches('input[type="radio"]')) {
                                updateSelectedStyles();
                            }
                        });

                        // filter logic
                        input.addEventListener('input', function() {
                            var q = this.value.trim().toLowerCase();
                            var anyVisible = false;

                            itemCols.forEach(function(col) {
                                var label = col.querySelector('label');
                                var labelText = label ? label.textContent.toLowerCase() : '';
                                var match = q === '' || labelText.indexOf(q) !== -1;
                                col.style.display = match ? '' : 'none';

                                if (!match) {
                                    var radio = col.querySelector('input[type="radio"]');
                                    if (radio && radio.checked) radio.checked = false;
                                } else {
                                    anyVisible = true;
                                }
                            });

                            noresults.style.display = anyVisible ? 'none' : '';
                            updateSelectedStyles();
                        });

                        // ensure clicking updates styles (after native radio check)
                        itemCols.forEach(function(col) {
                            var label = col.querySelector('.form-check');
                            if (label) {
                                label.addEventListener('click', function() {
                                    setTimeout(updateSelectedStyles, 10);
                                });
                            }
                        });
                    });
                    </script>

                </div></div>
        </div>
    </section>
