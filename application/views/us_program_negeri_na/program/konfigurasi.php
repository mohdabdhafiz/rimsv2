<?php 
$this->load->view('us_program_negeri_na/susunletak/atas');
$this->load->view('us_program_negeri_na/susunletak/sidebar');
$this->load->view('us_program_negeri_na/susunletak/navbar');
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
                    <input type="text" name="input_no_ic" id="input_no_ic" class="form-control" placeholder="Nombor Kad Pengenalan" value="<?= $pengguna->pengguna_ic ?>" required>
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
                        <option value="Pegawai Penerangan Gred S44" <?php if($pengguna->pekerjaan == 'Pegawai Penerangan Gred S44') { echo "selected"; } ?>>Pegawai Penerangan Gred S44</option>
                        <option value="Pegawai Penerangan Gred S41" <?php if($pengguna->pekerjaan == 'Pegawai Penerangan Gred S41') { echo "selected"; } ?>>Pegawai Penerangan Gred S41</option>
                        <option value="Penolong Pegawai Penerangan Gred S40" <?php if($pengguna->pekerjaan == 'Penolong Pegawai Penerangan Gred S40') { echo "selected"; } ?>>Penolong Pegawai Penerangan Gred S40</option>
                        <option value="Penolong Pegawai Penerangan Gred S38" <?php if($pengguna->pekerjaan == 'Penolong Pegawai Penerangan Gred S38') { echo "selected"; } ?>>Penolong Pegawai Penerangan Gred S38</option>
                        <option value="Penolong Pegawai Penerangan Gred S32" <?php if($pengguna->pekerjaan == 'Penolong Pegawai Penerangan Gred S32') { echo "selected"; } ?>>Penolong Pegawai Penerangan Gred S32</option>
                        <option value="Penolong Pegawai Penerangan Gred S29" <?php if($pengguna->pekerjaan == 'Penolong Pegawai Penerangan Gred S29') { echo "selected"; } ?>>Penolong Pegawai Penerangan Gred S29</option>
                        <option value="Pembantu Penerangan Gred S28" <?php if($pengguna->pekerjaan == 'Pembantu Penerangan Gred S28') { echo "selected"; } ?>>Pembantu Penerangan Gred S28</option>
                        <option value="Pembantu Penerangan Gred S26" <?php if($pengguna->pekerjaan == 'Pembantu Penerangan Gred S26') { echo "selected"; } ?>>Pembantu Penerangan Gred S26</option>
                        <option value="Pembantu Penerangan Gred S22" <?php if($pengguna->pekerjaan == 'Pembantu Penerangan Gred S22') { echo "selected"; } ?>>Pembantu Penerangan Gred S22</option>
                        <option value="Pembantu Penerangan Gred S19" <?php if($pengguna->pekerjaan == 'Pembantu Penerangan Gred S19') { echo "selected"; } ?>>Pembantu Penerangan Gred S19</option>
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
                <button type="submit" class="btn btn-outline-primary shadow-sm"><i class="bi bi-gear"></i> Kemaskini</button>
            </form>
        </div>
    </div>

    </section>


</main>

<?php $this->load->view('us_program_negeri_na/susunletak/bawah'); ?>
