<?php 
$this->load->view('us_program_na/susunletak/atas');
$this->load->view('us_program_na/susunletak/sidebar');
$this->load->view('us_program_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM - KONFIGURASI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('konfigurasi') ?>">Konfigurasi</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('jenis') ?>">Jenis Program</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">SENARAI JENIS PROGRAM</h1>
            <ol>
                <li>Berikut adalah jenis-jenis program untuk kegunaan pelaporan RIMS@PROGRAM.</li>
                <li>Pengemaskinian maklumat ini akan mengubah semua laporan-laporan yang melibatkan pemilihan jenis-jenis tersebut.</li>
                <li>Untuk pengemaskinian untuk maklumat yang telah digunakan, dicadangkan untuk menambah jenis program baharu berbanding program yang sedia ada.</li>
                <li>Sila rujuk urus setia untuk maklumat lanjut.</li>
            </ol>
            <?php if($senaraiJenis){ ?>
<div class="table-responsive">
  <table class="table table-hover table-bordered">
    <thead>
    <tr class="bg-warning">
      <th>Jenis Program</th>
      <th>Status</th>
      <th class="text-center">Bilangan Program</th>
      <th>Tarikh Dimasukkan</th>
      <th>Tindakan</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($senaraiJenis as $jenis): ?>
      <tr>
        <td><?php echo strtoupper($jenis->jt_nama); ?></td>
        <td><?= strtoupper($jenis->jt_aktif) ?></td>
        <td class="text-center
        <?php if($jenis->programBilangan > 0): ?>
        bg-success text-white
        <?php endif; ?>"
        >
          <?= $jenis->programBilangan ?>
        </td>
        <td><?= strtoupper($jenis->jt_tarikhMasa) ?></td>
        <td>
            <span data-bs-toggle = "modal" data-bs-target = "#kemaskini<?= $jenis->jt_bil ?>">
                <button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Kemaskini">
                    <i class="bi bi-gear"></i>
                </button>
            </span>
            <span data-bs-toggle = "modal" data-bs-target = "#padam<?= $jenis->jt_bil ?>">
                <button type="button" class="btn btn-outline-danger shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Padam">
                    <i class="bi bi-trash"></i>
                </button>
            </span>
        </td>
      </tr>
      <div class="modal fade" id="kemaskini<?= $jenis->jt_bil ?>" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-gear"></i>
                        Kemaskini Maklumat Jenis Program
                    </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('jenis/kemaskini') ?>
                      <div class="form-floating mb-3">
                        <input type="text" name="inputNama" id="inputNama" class="form-control" placeholder="Nama Jenis Program" value="<?= $jenis->jt_nama ?>" required>
                        <label for="inputNama" class="form-label">Nama Jenis Program</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input type="text" name="inputPeruntukan" id="inputPeruntukan" class="form-control" placeholder="Peruntukan Program" value="<?= $jenis->jt_peruntukan ?>" required>
                        <label for="inputPeruntukan" class="form-label">Peruntukan Program</label>
                      </div>
                      <div class="form-floating mb-3">
                        <select name="inputAktif" id="inputAktif" class="form-control" required>x
                          <option value="" <?php if($jenis->jt_aktif == ""){ echo "selected"; } ?>>Sila Pilih..</option>
                          <option value="Aktif" <?php if($jenis->jt_aktif == "Aktif"){ echo "selected"; } ?>>AKTIF</option>
                          <option value="Tidak Aktif" <?php if($jenis->jt_aktif == "Tidak Aktif"){ echo "selected"; } ?>>TIDAK AKTIF</option>
                        </select>
                        <label for="inputAktif" class="form-label">Status Keaktifan Program</label>
                      </div>
                        <ol>
                            <li>Diingatkan bahawa perubahan pada maklumat ini akan mengubah maklumat di dalam laporan-laporan yang telah dihantar.</li>
                            <li>Sila rujuk urus setia untuk maklumat lanjut.</li>
                        </ol>
                    </div>
                    <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                    <input type="hidden" name="inputBil" value="<?= $jenis->jt_bil ?>">
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-octagon"></i>
                        Batal
                      </button>
                      <button type="submit" class="btn btn-outline-primary shadow-sm">
                        <i class="bi bi-gear"></i>
                        Kemaskini
                      </button>
                        </form>
                    </div>
                  </div>
                </div>
              </div><!-- End Large Modal-->

              <div class="modal fade" id="padam<?= $jenis->jt_bil ?>" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content border-danger">
                    <div class="modal-header text-white bg-danger">
                      <h5 class="modal-title ">
                        <i class="bi bi-trash"></i>
                        PADAM MAKLUMAT JENIS PROGRAM
                    </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <span class="text-danger">ADAKAH ANDA PASTI UNTUK MEMADAM MAKLUMAT <strong><?= strtoupper($jenis->jt_nama) ?></strong>?</span>
                      <?php if($jenis->programBilangan > 0): ?>
                        <br><span><strong>Diingatkan bahawa terdapat <?= $jenis->programBilangan ?> laporan berkait dengan jenis program ini.</strong></span>
                      <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                    <?= form_open('jenis/padam') ?>
                    <input type="hidden" name="inputJenisBil" value="<?= $jenis->jt_bil ?>">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-octagon"></i>
                        Batal
                      </button>
                      <button type="submit" class="btn btn-outline-danger shadow-sm">
                        <i class="bi bi-trash"></i>
                        Padam
                      </button>
                        </form>
                    </div>
                  </div>
                </div>
              </div><!-- End Large Modal-->

    <?php endforeach; ?>
    </tbody>
  </table>

</div>
<?php } else { ?>
<div class="alert alert-warning">
  Tiada program yang direkodkan.
</div>
  <?php } ?>
        </div>
    </div>


    </section>

</main>


<?php $this->load->view('us_program_na/susunletak/bawah'); ?>