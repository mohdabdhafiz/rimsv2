<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">RIMS@PENGGUNA</h1>
    </div>
    

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold m-0 text-primary">Kemaskini Maklumat Pengguna: <?= $pengguna->nama_penuh ?></h6>
        </div>
        <div class="card-body">
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
                <div class="form-floating mb-3">
                    <input type="text" name="input_tempat" id="input_tempat" class="form-control" value="<?= $pengguna->pengguna_tempat_tugas ?>" placeholder="Tempat Bertugas">
                    <label for="input_tempat" class="form-label">Tempat Bertugas:</label>
                </div>
                <input type="hidden" name="input_bil" value="<?= $pengguna->bil ?>">
                <input type="hidden" name="input_peranan_bil" value="<?= $this->session->userdata('peranan_bil') ?>">
                <input type="hidden" name="input_peranan_nama" value="<?= $this->session->userdata('peranan'); ?>">
                <input type="hidden" name="input_pengguna_status" value="<?= $pengguna->pengguna_status ?>">
                <button type="submit" class="btn btn-primary w-100">Kemaskini</button>
            </form>
        </div>
    </div>


</div>

<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>
