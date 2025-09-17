<?php 
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/sidebar');
$this->load->view('negeri_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PENGGUNA</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('pengguna/tambah') ?>">Daftar Pengguna</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">


    <div class="card">
            <div class="card-body">
                <h1 class="card-title">
                <i class="bi bi-person-plus"></i>    
                Tambah Akaun Pengguna</h1>
            <?php echo validation_errors(); ?>
            <?php echo form_open('pengguna/proses_tambah'); ?>
                <div class="form-floating mb-3">
                    <input type="text" name="input_nama_penuh" id="input_nama_penuh" class="form-control" placeholder="Nama Penuh" value="<?= set_value('input_nama_penuh'); ?>" required>
                    <label for="input_nama_penuh" class="form-label">Nama Penuh:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="input_no_ic" id="input_no_ic" class="form-control" placeholder="Nombor Kad Pengenalan" value="<?= set_value('input_no_ic'); ?>" required>
                    <label for="input_no_ic" class="form-label">Nombor Kad Pengenalan:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="input_no_tel" id="input_no_tel" class="form-control" placeholder="Nombor Telefon" value="<?= set_value('input_no_tel'); ?>" required>
                    <label for="input_no_tel" class="form-label">Nombor Telefon:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="input_emel" id="input_emel" class="form-control" placeholder="contoh@contoh.com" value="<?= set_value('input_emel'); ?>" required>
                    <label for="input_emel" class="form-label">e-Mel:</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="input_jawatan" id="input_jawatan" class="form-control" required>
                        <option value="">Sila pilih..</option>
                        <option value="Pegawai Penerangan Gred S54">Pegawai Penerangan Gred S54</option>
                        <option value="Pegawai Penerangan Gred S52">Pegawai Penerangan Gred S52</option>
                        <option value="Pegawai Penerangan Gred S48">Pegawai Penerangan Gred S48</option>
                        <option value="Pegawai Penerangan Gred S44">Pegawai Penerangan Gred S44</option>
                        <option value="Pegawai Penerangan Gred S41">Pegawai Penerangan Gred S41</option>
                        <option value="Penolong Pegawai Penerangan Gred S40">Penolong Pegawai Penerangan Gred S40</option>
                        <option value="Penolong Pegawai Penerangan Gred S38">Penolong Pegawai Penerangan Gred S38</option>
                        <option value="Penolong Pegawai Penerangan Gred S32">Penolong Pegawai Penerangan Gred S32</option>
                        <option value="Penolong Pegawai Penerangan Gred S29">Penolong Pegawai Penerangan Gred S29</option>
                        <option value="Pembantu Penerangan Gred S28">Pembantu Penerangan Gred S28</option>
                        <option value="Pembantu Penerangan Gred S26">Pembantu Penerangan Gred S26</option>
                        <option value="Pembantu Penerangan Gred S22">Pembantu Penerangan Gred S22</option>
                        <option value="Pembantu Penerangan Gred S19">Pembantu Penerangan Gred S19</option>
                    </select>
                    <label for="input_jawatan" class="form-label">Jawatan:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="input_tempat" id="input_tempat" placeholder="Tempat Bertugas" class="form-control" required>
                    <label for="input_tempat" class="form-label">Tempat Bertugas:</label>
                </div>
                <input type="hidden" name="input_pengguna_status" value="Baharu">
                <input type="hidden" name="input_peranan_bil" value="<?= $this->session->userdata('peranan_bil'); ?>">
                <input type="hidden" name="input_peranan_nama" value="<?= $this->session->userdata('peranan'); ?>">
                <button type="submit" class="btn btn-outline-primary shadow-sm">
                    <i class="bi bi-person-plus"></i>
                    Tambah Akaun Pegawai</button>
            </form>
            </div>
        </div>



    </section>


</main>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>