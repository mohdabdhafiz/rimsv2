<div class="pagetitle">
  <h1>Senarai Laporan RIMS@LAPIS 2.0</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
      <li class="breadcrumb-item">RIMS@LAPIS 2.0</li>
      <li class="breadcrumb-item active">Senarai Laporan</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <!-- Bahagian Carian -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Carian Laporan</h5>

                    <!-- Paparan Mesej Kejayaan (Flashdata) -->
                    <?php if ($this->session->flashdata('mesej_sukses')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $this->session->flashdata('mesej_sukses'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?= form_open("lapis2/senaraiLaporan", ["class" => "form-horizontal", "method" => "POST"]) ?>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Tarikh Mula</label>
                            <input type="date" name="inputTarikhMula" class="form-control" value="<?= isset($filters['tarikhMula']) ? htmlspecialchars($filters['tarikhMula'], ENT_QUOTES, 'UTF-8') : '' ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tarikh Akhir</label>
                            <input type="date" name="inputTarikhAkhir" class="form-control" value="<?= isset($filters['tarikhAkhir']) ? htmlspecialchars($filters['tarikhAkhir'], ENT_QUOTES, 'UTF-8') : '' ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="inputPelapor" class="form-label">Pelapor</label>
                            <select name="inputPelapor" id="inputPelapor" class="form-select">
                                <option value="">Semua Pelapor</option>
                                <?php if(!empty($senaraiPelapor)): foreach ($senaraiPelapor as $pelapor): ?>
                                    <option value="<?= $pelapor->bil ?>" <?= (isset($filters['pelapor']) && $filters['pelapor'] == $pelapor->bil) ? 'selected' : '' ?>><?= strtoupper($pelapor->nama_penuh) ?></option>
                                <?php endforeach; endif; ?>    
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputNegeri" class="form-label">Negeri</label>
                            <select name="inputNegeri" id="inputNegeri" class="form-select">
                                <option value="">Semua Negeri</option>
                                <?php if(!empty($senaraiNegeri)): foreach ($senaraiNegeri as $negeri): ?>
                                    <option value="<?= $negeri->nt_bil ?>" <?= (isset($filters['negeri']) && $filters['negeri'] == $negeri->nt_bil) ? 'selected' : '' ?>><?= strtoupper($negeri->nt_nama) ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <!-- KEMAS KINI DI SINI: Menambah dropdown baru -->
                        <div class="col-md-4">
                            <label for="inputDaerah" class="form-label">Daerah</label>
                            <select name="inputDaerah" id="inputDaerah" class="form-select" disabled>
                                <option value="">Semua Daerah</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputParlimen" class="form-label">Parlimen</label>
                            <select name="inputParlimen" id="inputParlimen" class="form-select" disabled>
                                <option value="">Semua Parlimen</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputDun" class="form-label">DUN</label>
                            <select name="inputDun" id="inputDun" class="form-select" disabled>
                                <option value="">Semua DUN</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputDm" class="form-label">Daerah Mengundi (DM)</label>
                            <select name="inputDm" id="inputDm" class="form-select" disabled>
                                <option value="">Semua DM</option>
                            </select>
                        </div>
                        <!-- TAMAT KEMAS KINI -->
                        <div class="col-md-4">
                            <label for="inputKluster" class="form-label">Kluster</label>
                            <select name="inputKluster" id="inputKluster" class="form-select">
                                <option value="">Semua Kluster</option>
                                <?php if(!empty($senaraiKluster)): foreach ($senaraiKluster as $kluster): ?>
                                    <option value="<?= $kluster->kit_bil ?>" <?= (isset($filters['kluster']) && $filters['kluster'] == $kluster->kit_bil) ? 'selected' : '' ?>><?= strtoupper($kluster->kit_nama) ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputStatus" class="form-label">Status</label>
                            <select name="inputStatus" id="inputStatus" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="Laporan Diterima" <?= (isset($filters['status']) && $filters['status'] == 'Laporan Diterima') ? 'selected' : '' ?>>Laporan Diterima</option>
                                <option value="Laporan Dipinda" <?= (isset($filters['status']) && $filters['status'] == 'Laporan Dipinda') ? 'selected' : '' ?>>Laporan Dipinda</option>
                                <option value="Laporan Ditolak" <?= (isset($filters['status']) && $filters['status'] == 'Laporan Ditolak') ? 'selected' : '' ?>>Laporan Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Mulakan Carian</button>
                        <a href="<?= site_url('lapis2/senaraiLaporan') ?>" class="btn btn-secondary">Set Semula</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>

            <!-- Jadual untuk memaparkan hasil carian -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Senarai Laporan</h5>
                    <div class="table-responsive">
                        <table id="laporanTable" class="table table-striped table-hover datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tarikh</th>
                                    <th>Tajuk Isu</th>
                                    <th>Pelapor</th>
                                    <th>Negeri</th>
                                    <th>Kluster</th>
                                    <th>Status</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($senarai_laporan)): ?>
                                    <?php foreach ($senarai_laporan as $index => $laporan): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= htmlspecialchars(date('d/m/Y', strtotime($laporan->lapis_tarikh_laporan)), ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?= htmlspecialchars($laporan->lapis_tajuk_isu, ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?= htmlspecialchars($laporan->lapis_pelapor_nama, ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?= htmlspecialchars($laporan->lapis_negeri_nama, ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?= htmlspecialchars($laporan->lapis_kluster_nama, ENT_QUOTES, 'UTF-8') ?></td>
                                            <td>
                                                <?php 
                                                    $status = $laporan->lapis_status;
                                                    $badge_class = 'bg-primary';
                                                    if ($status == 'Laporan Dipinda') $badge_class = 'bg-warning text-dark';
                                                    if ($status == 'Laporan Ditolak') $badge_class = 'bg-danger';
                                                ?>
                                                <span class="badge <?= $badge_class ?>"><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></span>
                                            </td>
                                            <td>
                                                <!-- KEMAS KINI DI SINI -->
                                                <a href="<?= site_url('lapis2/lihatLaporan/' . $laporan->lapis_bil) ?>" class="btn btn-sm btn-info">Lihat</a>
                                                <a href="<?= site_url('lapis2/kemaskiniLaporan/' . $laporan->lapis_bil) ?>" class="btn btn-sm btn-warning">Kemas Kini</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Tiada laporan dijumpai.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const negeriSelect = document.getElementById('inputNegeri');
    const daerahSelect = document.getElementById('inputDaerah');
    const parlimenSelect = document.getElementById('inputParlimen');
    const dunSelect = document.getElementById('inputDun');
    const dmSelect = document.getElementById('inputDm');

    // Fungsi untuk mengisi dan memilih dropdown
    function populateAndSelect(selectElement, url, body, selectedValue) {
        selectElement.innerHTML = '<option value="">Memuatkan...</option>';
        fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: body
        })
        .then(response => response.json())
        .then(data => {
            selectElement.innerHTML = `<option value="">Semua ${selectElement.id.replace('input', '')}</option>`;
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.bil || item.pt_bil || item.dun_bil || item.ppt_bil;
                option.textContent = (item.nama || item.pt_nama || item.dun_nama || item.ppt_nama).toUpperCase();
                if (option.value == selectedValue) {
                    option.selected = true;
                }
                selectElement.appendChild(option);
            });
            selectElement.disabled = false;
        });
    }

    // Periksa jika ada carian lama semasa halaman dimuatkan
    const initialNegeriId = '<?= isset($filters['negeri']) ? $filters['negeri'] : '' ?>';
    if (initialNegeriId) {
        populateAndSelect(daerahSelect, '<?= site_url("lapis2/dapatkan_daerah") ?>', 'negeri_bil=' + initialNegeriId, '<?= isset($filters['daerah']) ? $filters['daerah'] : '' ?>');
        populateAndSelect(parlimenSelect, '<?= site_url("lapis2/dapatkan_parlimen") ?>', 'negeri_bil=' + initialNegeriId, '<?= isset($filters['parlimen']) ? $filters['parlimen'] : '' ?>');
        populateAndSelect(dunSelect, '<?= site_url("lapis2/dapatkan_dun") ?>', 'negeri_bil=' + initialNegeriId, '<?= isset($filters['dun']) ? $filters['dun'] : '' ?>');
    }

    const initialParlimenId = '<?= isset($filters['parlimen']) ? $filters['parlimen'] : '' ?>';
    if (initialParlimenId) {
        populateAndSelect(dmSelect, '<?= site_url("lapis2/dapatkan_pdm") ?>', 'parlimen_bil=' + initialParlimenId, '<?= isset($filters['dm']) ? $filters['dm'] : '' ?>');
    }

    // Event listener untuk perubahan
    negeriSelect.addEventListener('change', function() {
        const negeriId = this.value;
        daerahSelect.disabled = !negeriId;
        parlimenSelect.disabled = !negeriId;
        dunSelect.disabled = !negeriId;
        dmSelect.disabled = true;
        if(negeriId) {
            populateAndSelect(daerahSelect, '<?= site_url("lapis2/dapatkan_daerah") ?>', 'negeri_bil=' + negeriId, '');
            populateAndSelect(parlimenSelect, '<?= site_url("lapis2/dapatkan_parlimen") ?>', 'negeri_bil=' + negeriId, '');
            populateAndSelect(dunSelect, '<?= site_url("lapis2/dapatkan_dun") ?>', 'negeri_bil=' + negeriId, '');
        }
    });

    parlimenSelect.addEventListener('change', function() {
        const parlimenId = this.value;
        dmSelect.disabled = !parlimenId;
        if(parlimenId) {
            populateAndSelect(dmSelect, '<?= site_url("lapis2/dapatkan_pdm") ?>', 'parlimen_bil=' + parlimenId, '');
        }
    });
});
</script>
