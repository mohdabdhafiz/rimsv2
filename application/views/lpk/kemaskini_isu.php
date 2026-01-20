<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Kemaskini Isu</h1> 
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url('sentimen'); ?>">Sentimen</a></li> 
        <li class="breadcrumb-item active">Kemaskini Isu</li>
      </ol>
    </nav>
  </div><section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Borang Kemaskini Isu</h5>

            <form action="<?php echo site_url('sentimen/prosesKemaskiniIsu'); ?>" method="POST">

              <input type="hidden" name="id_isu" value="<?= $isu->sit_bil; ?>">

              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">


              <div class="row mb-3">
                <div class="col-lg-3 col-md-4 fw-bold">Isu Bil:</div>
                <div class="col-lg-9 col-md-8">
                  <?= $isu->sit_bil; ?>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-lg-3 col-md-4 fw-bold">Dicipta Pada:</div>
                <div class="col-lg-9 col-md-8">
                  <?= $isu->sit_tarikh_dibina; ?>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-lg-3 col-md-4 fw-bold">Dicipta Oleh:</div>
                <div class="col-lg-9 col-md-8">
                  <?= $isu->pengguna_nama; ?>
                </div>
              </div>

              <hr>

              <div class="row mb-3">
                <label for="sit_isu" class="col-lg-3 col-md-4 col-form-label fw-bold">Isu Tajuk:</label>
                <div class="col-lg-9 col-md-8">
                  <input type="text" class="form-control" id="sit_isu" name="sit_isu" 
                         value="<?= htmlspecialchars($isu->sit_isu); ?>" required>
                </div>
              </div>

              <div class="row mb-3">
                <label for="sit_keterangan" class="col-lg-3 col-md-4 col-form-label fw-bold">Huraian / Keterangan:</label>
                <div class="col-lg-9 col-md-8">
                  <textarea class="form-control" id="sit_keterangan" name="sit_keterangan" 
                            style="height: 150px" required><?= htmlspecialchars($isu->sit_keterangan); ?></textarea>
                </div>
              </div>

              <div class="row mb-3">
                <label for="sit_aktif" class="col-lg-3 col-md-4 col-form-label fw-bold">Status:</label>
                <div class="col-lg-9 col-md-8">
                  <select name="sit_aktif" id="sit_aktif" class="form-control">
                    <option value="YA" <?= $isu->sit_aktif == 'YA' ? 'selected' : ''; ?>>Aktif</option>
                    <option value="TIDAK" <?= $isu->sit_aktif == 'TIDAK' ? 'selected' : ''; ?>>Tidak Aktif</option>
                  </select>
                </div>
              </div>
              
              <hr>
              
              <div class="text-start mt-4 d-flex justify-content-between">
                
                <a href="<?php echo site_url('sentimen/urus_tadbir'); ?>" class="btn btn-secondary">
                  <i class="bi bi-arrow-left"></i> Kembali
                </a>
                
                <button type="submit" class="btn btn-primary">
                  <i class="bi bi-save"></i> Kemaskini Maklumat
                </button>

              </div>

            </form></div>
        </div>

      </div>
    </div>
  </section>

</main>

<?php $this->load->view($footer); ?>