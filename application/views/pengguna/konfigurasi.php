<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PERSONEL</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Kemaskini Maklumat Pengguna</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->



    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
            <i class="bi bi-gear"></i>    
            Kemaskini Maklumat Pengguna</h1>
            <?php echo validation_errors(); ?>
            <?php echo form_open('pengguna/proses_kemaskini'); ?>
                <div class="form-floating mb-3">
                    <input type="text" name="input_nama_penuh" id="input_nama_penuh" class="form-control" placeholder="Nama Penuh" value="<?= $pengguna->nama_penuh ?>" autofocus required>
                    <label for="input_nama_penuh" class="form-label">Nama Penuh:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" id="input_no_ic" class="form-control" placeholder="Nombor Kad Pengenalan" value="<?= $pengguna->pengguna_ic ?>" disabled>
                    <input type="hidden" name="input_no_ic" value="<?= $pengguna->pengguna_ic ?>">
                    <label for="input_no_ic" class="form-label">Nombor Kad Pengenalan:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="input_no_tel" id="input_no_tel" class="form-control" value="<?= $pengguna->no_tel ?>" placeholder="Nombor Telefon" required>
                    <label for="input_no_tel" class="form-label">Nombor Telefon:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="input_emel" id="input_emel" class="form-control" value="<?= $pengguna->emel ?>" placeholder="e-Mel">
                    <label for="input_emel" class="form-label">e-Mel:</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-control" name="input_jawatan" id="input_jawatan">
                        <option value="">Sila pilih..</option>
                        <option value="Pegawai Penerangan Gred S10" <?php if($pengguna->pekerjaan == 'Pegawai Penerangan Gred S10') { echo "selected"; } ?>>Pegawai Penerangan Gred S44/S10</option>
                        <option value="Pegawai Penerangan Gred S9" <?php if($pengguna->pekerjaan == 'Pegawai Penerangan Gred S9') { echo "selected"; } ?>>Pegawai Penerangan Gred S41/S9</option>
                        <option value="Penolong Pegawai Penerangan Gred S8" <?php if($pengguna->pekerjaan == 'Penolong Pegawai Penerangan Gred S8') { echo "selected"; } ?>>Penolong Pegawai Penerangan Gred S40/S8</option>
                        <option value="Penolong Pegawai Penerangan Gred S7" <?php if($pengguna->pekerjaan == 'Penolong Pegawai Penerangan Gred S7') { echo "selected"; } ?>>Penolong Pegawai Penerangan Gred S38/S7</option>
                        <option value="Penolong Pegawai Penerangan Gred S6" <?php if($pengguna->pekerjaan == 'Penolong Pegawai Penerangan Gred S6') { echo "selected"; } ?>>Penolong Pegawai Penerangan Gred S32/S6</option>
                        <option value="Penolong Pegawai Penerangan Gred S5" <?php if($pengguna->pekerjaan == 'Penolong Pegawai Penerangan Gred S5') { echo "selected"; } ?>>Penolong Pegawai Penerangan Gred S29/S5</option>
                        <option value="Pembantu Penerangan Gred S4" <?php if($pengguna->pekerjaan == 'Pembantu Penerangan Gred S4') { echo "selected"; } ?>>Pembantu Penerangan Gred S28/S4</option>
                        <option value="Pembantu Penerangan Gred S3" <?php if($pengguna->pekerjaan == 'Pembantu Penerangan Gred S3') { echo "selected"; } ?>>Pembantu Penerangan Gred S26/S3</option>
                        <option value="Pembantu Penerangan Gred S2" <?php if($pengguna->pekerjaan == 'Pembantu Penerangan Gred S2') { echo "selected"; } ?>>Pembantu Penerangan Gred S22/S2</option>
                        <option value="Pembantu Penerangan Gred S1" <?php if($pengguna->pekerjaan == 'Pembantu Penerangan Gred S1') { echo "selected"; } ?>>Pembantu Penerangan Gred S19/S1</option>
                    </select>
                    <label for="input_jawatan" class="form-label">Jawatan:</label>
                </div>
                <?php if(!empty($organisasi)): ?>
                    <div class="form-floating mb-3">
                    <input type="text" id="input_tempat" class="form-control" value="<?= $organisasi->jt_pejabat ?>" placeholder="Tempat Bertugas" disabled>
                    <label for="input_tempat" class="form-label">Tempat Bertugas:</label>
                </div>
                <input type="hidden" name="input_tempat" value="<?= $organisasi->jt_pejabat ?>">
                <?php endif; ?>
                <?php if(empty($organisasi)): ?>
                <div class="form-floating mb-3">
                    <input type="text" name="input_tempat" id="input_tempat" class="form-control" value="<?= $pengguna->pengguna_tempat_tugas ?>" placeholder="Tempat Bertugas">
                    <label for="input_tempat" class="form-label">Tempat Bertugas:</label>
                </div>
                <?php endif; ?>
                <input type="hidden" name="input_bil" value="<?= $pengguna->bil ?>">
                <input type="hidden" name="input_peranan_bil" value="<?= $this->session->userdata('peranan_bil') ?>">
                <input type="hidden" name="input_peranan_nama" value="<?= $this->session->userdata('peranan'); ?>">
                <input type="hidden" name="input_pengguna_status" value="<?= $pengguna->pengguna_status ?>">
                <button type="submit" class="btn btn-outline-primary shadow-sm w-100"><i class="bi bi-gear"></i> Kemaskini</button>
            </form>
        </div>
    </div>

    </section>


</main>

<?php $this->load->view($footer); ?>
