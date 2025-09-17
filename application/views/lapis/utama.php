<style>
/* Gaya yang sama seperti sebelum ini */
.card-gradient { color: white; transition: all 0.3s ease-in-out; }
.card-gradient:hover { transform: translateY(-5px); box-shadow: 0 8px 25px -5px rgba(0,0,0,0.2); }
.bg-gradient-primary { background: linear-gradient(45deg, #4e73df, #224abe); }
.bg-gradient-danger { background: linear-gradient(45deg, #e74a3b, #be2617); }
.card-gradient .card-body i { opacity: 0.3; font-size: 3.5rem; }
/* Gaya baharu untuk Kad Tindakan */
.action-card { text-decoration: none; }
.action-card .card { transition: all 0.3s ease-in-out; border-left-width: 4px; }
.action-card .card:hover { transform: scale(1.03); box-shadow: 0 4px 20px -5px rgba(0,0,0,0.15); background-color: #f8f9fa; }
</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Papan Pemuka RIMS@LAPIS</h1>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-6">
        <div class="card card-gradient bg-gradient-primary shadow-sm border-0 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase">Jumlah Laporan Diterima</h6>
                    <h2 class="display-5 fw-bold"><?= $bilanganLapis['jumlah_laporan'] ?? '0' ?></h2>
                </div>
                <i class="bi bi-journal-text"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-gradient bg-gradient-danger shadow-sm border-0 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase">Laporan Ditolak</h6>
                    <h2 class="display-5 fw-bold"><?= $bilanganLapis['laporan_ditolak'] ?? '0' ?></h2>
                </div>
                <i class="bi bi-journal-x"></i>
            </div>
        </div>
    </div>
</div>

<div class="mb-5">
    <h4 class="mb-3">Hab Tindakan Utama</h4>
    <div class="row g-4">
        <div class="col-lg-4 col-md-6">
            <a href="<?= site_url("lapis/carianTerperinci") ?>" class="action-card">
                <div class="card shadow-sm border-start border-primary h-100">
                    <div class="card-body text-center">
                        <i class='bx bx-search-alt display-4 text-primary mb-2'></i>
                        <h5 class="card-title fw-bold">Carian Terperinci</h5>
                        <p class="card-text small text-muted">Cari laporan menggunakan pelbagai tapisan.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6">
            <a href="<?= site_url("lapis/listArkib") ?>" class="action-card">
                <div class="card shadow-sm border-start border-success h-100">
                    <div class="card-body text-center">
                        <i class='bx bx-archive display-4 text-success mb-2'></i>
                        <h5 class="card-title fw-bold">Arkib Laporan</h5>
                        <p class="card-text small text-muted">Akses dan semak laporan-laporan lepas.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6">
             <a href="#" class="action-card" data-bs-toggle="modal" data-bs-target="#muatTurunModal">
                <div class="card shadow-sm border-start border-warning h-100">
                    <div class="card-body text-center">
                        <i class='bx bxs-download display-4 text-warning mb-2'></i>
                        <h5 class="card-title fw-bold">Muat Turun Laporan</h5>
                        <p class="card-text small text-muted">Jana dan muat turun laporan terperinci.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm h-100">
            <div class="card-header"><strong>Taburan Laporan Mengikut Kluster</strong></div>
            <div class="card-body"><canvas id="klusterBarChart"></canvas></div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-header"><strong>Laporan Terkini</strong></div>
            <div class="list-group list-group-flush">
                <?php if (!empty($bilanganLapis['laporan_terkini'])): ?>
                    <?php foreach ($bilanganLapis['laporan_terkini'] as $laporan): ?>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 fw-bold"><?= htmlspecialchars(mb_strimwidth($laporan->lapis_tajuk_isu, 0, 40, "...")) ?></h6>
                            </div>
                            <p class="mb-1 small text-muted">Kluster: <?= htmlspecialchars($laporan->lapis_kluster_nama) ?></p>
                            <small>Oleh: <?= htmlspecialchars($laporan->lapis_pelapor_nama) ?> | <?= date('d M Y', strtotime($laporan->lapis_tarikh_laporan)) ?></small>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="list-group-item text-center text-muted">Tiada laporan terkini.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="muatTurunModal" tabindex="-1" aria-labelledby="muatTurunModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="muatTurunModalLabel">Muat Turun Laporan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?= form_open("lapis/muatTurun") ?>
      <div class="modal-body">
        <p>Sila tetapkan parameter untuk muat turun laporan.</p>
        <div class="mb-3">
            <label class="form-label">Tahun</label>
            <input type="number" class="form-control" name="inputTahun" value="<?= date("Y") ?>">
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Muat Turun</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    if (typeof Chart !== 'undefined') {
        const ctx = document.getElementById('klusterBarChart').getContext('2d');
        const klusterBarChart = new Chart(ctx, { /* ... konfigurasi carta sama seperti sebelum ini ... */ });
    }
});
</script>