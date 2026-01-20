<div class="pagetitle">
    <h1>RIMS@SISMAP</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">UTAMA</a></li>
            <li class="breadcrumb-item active">
                <i class="bi bi-file-earmark-text"></i>
                LAPORAN AKTIVITI KEMPEN
            </li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<hr>

<div class="row g-3">
    <div class="col-12 col-lg-6">
        <a href="<?= site_url('kempen/tambah') ?>" class="btn btn-primary w-100">
            <i class="bi bi-plus-circle"></i> Tambah Laporan Aktiviti Kempen
        </a>
    </div>
    <div class="col-12 col-lg-6">
        <a href="<?= site_url('kempen/muatTurunSenarai') ?>" class="btn btn-success w-100">
            <i class="bi bi-download"></i> Muat Turun Senarai
        </a>
    </div>
</div>

<hr>

<div class="card">
    <div class="card-body">
        <h1 class="card-title">Senarai Aktiviti Kempen Lapangan Parti</h1>
        <?php if($this->session->flashdata("mesej")): ?>
        <?= $this->session->flashdata("mesej") ?>
        <?php endif; ?>
        <p>Tarikh : <?= date("d F Y", strtotime("-1 day")) ?> - <?= date("d F Y") ?> | Bilangan Program : <?= count($senaraiKempen) ?></p>
        <?php if(count($senaraiKempen) == 0): ?>
            <div class="alert alert-warning">
                Tiada rekod aktiviti kempen untuk dipaparkan.
            </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th class="text-center">BIL</th>
                        <th>PRU</th>
                        <th>TARIKH</th>
                        <th>MASA</th>
                        <th>NAMA DM</th>
                        <th>NAMA TEMPAT</th>
                        <th>JENIS PROGRAM</th>
                        <th>TAJUK PROGRAM</th>
                        <th>PARTI</th>
                        <th>PEMIMPIN YANG HADIR</th>
                        <th>GAMBAR</th>
                        <th>PELAPOR</th>
                        <th>TINDAKAN</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php foreach($senaraiKempen as $kempen): ?>
                <tr>
                    <td class="text-center"><?= $kempen->kempenBil ?></td>
                    <td><?= $kempen->kempenPruSingkatan ?></td>
                    <td><?= $kempen->kempenTarikh ?></td>
                    <td><?= $kempen->kempenMasa ?></td>
                    <td><?= $kempen->dmNama ?></td>
                    <td><?= $kempen->kempenLokasi ?></td>
                    <td><?= $kempen->kempenJenisAktiviti ?></td>
                    <td><?= $kempen->kempenAktiviti ?></td>
                    <td><?= $kempen->partiSingkatan ?></td>
                    <td><?= $kempen->kempenPemimpinHadir ?></td>
                    <td>
                        <div class="row">
                            <?php foreach($senaraiGambarKempen as $gambar): ?>
                                <?php if($gambar->kempenBil == $kempen->kempenBil): ?>
                                <div class="col-12 col-md-3 mb-2">
                                    <img 
                                        src="<?= base_url("assets/img/aktivitiKempen/{$gambar->gambarFail}") ?>" 
                                        alt="<?= htmlspecialchars($gambar->gambarDeskripsi) ?>" 
                                        class="img-fluid rounded" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#gambarModal"
                                        style="cursor: pointer;"
                                    >
                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </td>
                    <td><?= $kempen->kempenPelapor ?></td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $kempen->kempenBil ?>">
                            <i class="bi bi-pencil-square"></i> Ubah
                        </button>

                        <!-- Modal Ubah -->
                        <div class="modal fade" id="ubahModal<?= $kempen->kempenBil ?>" tabindex="-1" aria-labelledby="ubahModalLabel<?= $kempen->kempenBil ?>" aria-hidden="true">
                          <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                              <form action="<?= site_url("kempen/ubah/{$kempen->kempenBil}") ?>" method="post">
                                <input type="hidden" name="kempenBil" value="<?= $kempen->kempenBil ?>">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="ubahModalLabel<?= $kempen->kempenBil ?>">Ubah Aktiviti Kempen #<?= $kempen->kempenBil ?></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-info" role="alert">
                                        <i class="bi bi-info-circle"></i> <strong>Nota:</strong> Bagi perubahan Parti, DUN dan Daerah Mengundi (DM), sila padam dan buat semula rekod tersebut.
                                    </div>
                                    <div class="mb-3">
                                    <label class="form-label">Tarikh</label>
                                    <input type="date" name="kempenTarikh" class="form-control" value="<?= htmlspecialchars($kempen->kempenTarikh) ?>">
                                    </div>
                                  <div class="mb-3">
                                    <label class="form-label">Masa</label>
                                    <input type="time" name="kempenMasa" class="form-control" value="<?= htmlspecialchars($kempen->kempenMasa) ?>">
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Lokasi / Nama DM</label>
                                    <input type="text" name="kempenLokasi" class="form-control" value="<?= htmlspecialchars($kempen->kempenLokasi) ?>">
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Jenis Program</label>
                                    <select class="form-select" id="kempenJenisAktiviti" name="kempenJenisAktiviti">
                                        <option value="" <?php if($kempen->kempenJenisAktiviti == "") echo "selected"; ?>>Sila Pilih...</option>
                                        <option value="Ceramah" <?php if($kempen->kempenJenisAktiviti == "Ceramah") echo "selected"; ?>>Ceramah</option>
                                        <option value="Walkabout" <?php if($kempen->kempenJenisAktiviti == "Walkabout") echo "selected"; ?>>Walkabout</option>
                                        <option value="Lawatan Rumah Ke Rumah" <?php if($kempen->kempenJenisAktiviti == "Lawatan Rumah Ke Rumah") echo "selected"; ?>>Lawatan Rumah Ke Rumah</option>
                                        <option value="Santai" <?php if($kempen->kempenJenisAktiviti == "Santai") echo "selected"; ?>>Santai</option>
                                        <option value="Ramah Mesra" <?php if($kempen->kempenJenisAktiviti == "Ramah Mesra") echo "selected"; ?>>Ramah Mesra</option>
                                        <option value="Sidang Media" <?php if($kempen->kempenJenisAktiviti == "Sidang Media") echo "selected"; ?>>Sidang Media</option>
                                    </select>
                                </div>
                                  <div class="mb-3">
                                    <label class="form-label">Tajuk Program</label>
                                    <input type="text" name="kempenAktiviti" class="form-control" value="<?= htmlspecialchars($kempen->kempenAktiviti) ?>">
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Pemimpin Yang Hadir</label>
                                    <textarea name="kempenPemimpinHadir" id="kempenPemimpinHadir" class="form-control" rows="3"><?= htmlspecialchars($kempen->kempenPemimpinHadir) ?></textarea>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Isu / Perkara Dibangkitkan</label>
                                    <textarea name="kempenIsuDibangkitkan" class="form-control" rows="3"><?= htmlspecialchars($kempen->kempen_pru_perkara_berbangkit) ?></textarea>
                                </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <button type="button" class="btn btn-warning btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#ubahGambarModal<?= $kempen->kempenBil ?>">
                            <i class="bi bi-pencil-square"></i> Ubah Gambar
                        </button>

                        <!-- Modal Ubah -->
                        <div class="modal fade" id="ubahGambarModal<?= $kempen->kempenBil ?>" tabindex="-1" aria-labelledby="ubahGambarModalLabel<?= $kempen->kempenBil ?>" aria-hidden="true">
                          <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ubahGambarModalLabel<?= $kempen->kempenBil ?>">Ubah Gambar Aktiviti Kempen #<?= $kempen->kempenBil ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                <form action="<?= site_url("kempen/ubahGambar/{$kempen->kempenBil}") ?>" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="kempenBil" value="<?= $kempen->kempenBil ?>">
                                    
                                        <div class="mb-3">
                                            <label class="form-label">Muat Naik Gambar Baru</label>
                                            <input type="file" name="gambarFail[]" class="form-control" multiple>
                                        </div>
                                </form>
                                <div class="row g-3">
                                    <?php foreach($senaraiGambarKempen as $gambar): ?>
                                    <?php if($gambar->kempenBil == $kempen->kempenBil): ?>
                                    <div class="col-12 col-md-3 mb-2">
                                        <img 
                                            src="<?= base_url("assets/img/aktivitiKempen/{$gambar->gambarFail}") ?>" 
                                            alt="<?= htmlspecialchars($gambar->gambarDeskripsi) ?>" 
                                            class="img-fluid rounded" 
                                        >
                                        <form action="<?= site_url("kempen/hapusGambar/{$gambar->gambarBil}/{$kempen->kempenBil}") ?>" method="post" onsubmit="return confirm('Adakah anda pasti untuk menghapuskan gambar ini?');">
                                            <button type="submit" class="btn btn-danger btn-sm w-100 mt-1">
                                                <i class="bi bi-trash"></i> Hapus Gambar
                                            </button>
                                        </form>
                                    </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </div>
                            </div>
                                    </div>
                          </div>
                        </div>
                        
                        <a href="<?= site_url("kempen/hapus/{$kempen->kempenBil}") ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Adakah anda pasti untuk menghapuskan rekod ini?');">
                            <i class="bi bi-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>

    <div class="modal fade" id="gambarModal" tabindex="-1" aria-labelledby="gambarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="gambarModalLabel">Pratonton Imej</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <img src="" id="imgModalGambar" class="img-fluid" alt="">
        </div>
        </div>
    </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Dapatkan rujukan kepada modal
    var gambarModal = document.getElementById('gambarModal');
    
    // Pastikan modal itu wujud sebelum menambah 'listener'
    if (gambarModal) {
        // Dengar apabila modal ini akan dipaparkan
        gambarModal.addEventListener('show.bs.modal', function (event) {
            
            // Dapatkan elemen yang mencetuskan modal (imej yang anda klik)
            var triggerImage = event.relatedTarget;
            
            // Dapatkan 'src' dan 'alt' dari imej yang dicetuskan
            var imgSrc = triggerImage.getAttribute('src');
            var imgAlt = triggerImage.getAttribute('alt');
            
            // Cari elemen <img> dan tajuk di dalam modal
            var modalImage = document.getElementById('imgModalGambar');
            var modalTitle = document.getElementById('gambarModalLabel');
            
            // Tetapkan 'src' dan 'alt' imej modal
            modalImage.src = imgSrc;
            modalImage.alt = imgAlt;
            
            // Tetapkan tajuk modal menggunakan teks 'alt'
            modalTitle.textContent = imgAlt;
        });
    }
});
</script>