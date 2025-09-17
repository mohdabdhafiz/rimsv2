<?php 
// Load views for header, sidebar, and navbar
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('winnable_candidate') ?>">JANGKAAN CALON</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('winnable_candidate/daftar') ?>">TAMBAH JANGKAAN CALON PARLIMEN</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Jangkaan Calon Parlimen</h1>
                <div class="p-3 border rounded mb-3">
                    <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <?= form_open('winnable_candidate/proses_daftar'); ?>
                        <div class="mb-3">
                            <div class="row g-3">
                                <label class="form-label"><strong>1) Pilih Parlimen :</strong></label> 
                                <?php foreach($senarai_parlimen as $parlimen): ?>
                                    <div class="col-12 col-lg-3 col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="input_parlimen_bil" id="input_parlimen_bil<?= $parlimen->pt_bil; ?>" <?= set_radio('input_parlimen_bil', $parlimen->pt_bil); ?> value="<?= $parlimen->pt_bil; ?>">
                                            <label class="form-check-label" for="input_parlimen_bil<?= $parlimen->pt_bil; ?>">
                                                <?= htmlspecialchars($parlimen->pt_nama); ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="input_nama_penuh" class="form-label"><strong>2) Masukkan Nama Penuh Calon :</strong></label>
                            <input type="text" name="input_nama_penuh" id="input_nama_penuh" class="form-control" value="<?= set_value('input_nama_penuh'); ?>">
                        </div>
                        
                        <div class="mb-3">
                            <div class="row g-3">
                                <label class="form-label"><strong>3) Pilih Parti :</strong></label> 
                                <?php foreach($senarai_parti as $parti): ?>
                                    <div class="col-12 col-lg-4 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="input_parti_bil" id="input_parti_bil<?= $parti->parti_bil; ?>" <?= set_radio('input_parti_bil', $parti->parti_bil); ?> value="<?= $parti->parti_bil; ?>">
                                            <label class="form-check-label" for="input_parti_bil<?= $parti->parti_bil; ?>">
                                                <?= htmlspecialchars($parti->parti_singkatan); ?> - <?= htmlspecialchars($parti->parti_nama); ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <small id="input_parti_bil_help" class="form-text text-muted">Sila hubungi urus setia jika parti yang hendak dipilih tiada dalam senarai.</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="input_jawatan_parti" class="form-label"><strong>4) Masukkan Jawatan Dalam Parti :</strong></label>
                            <input type="text" name="input_jawatan_parti" id="input_jawatan_parti" class="form-control" value="<?= set_value('input_jawatan_parti'); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="input_kategori_umur" class="form-label"><strong>5) Pilih Kategori Umur :</strong></label>
                            <select name="input_kategori_umur" id="input_kategori_umur" class="form-control">
                                <option value="0">Sila Pilih</option>
                                <option value="18 - 24" <?= set_select('input_kategori_umur', '18 - 24'); ?>>18 - 24</option>
                                <option value="25 - 40" <?= set_select('input_kategori_umur', '25 - 40'); ?>>25 - 40</option>
                                <option value="41 - 60" <?= set_select('input_kategori_umur', '41 - 60'); ?>>41 - 60</option>
                                <option value="61 - 70" <?= set_select('input_kategori_umur', '61 - 70'); ?>>61 - 70</option>
                                <option value="71 - 80" <?= set_select('input_kategori_umur', '71 - 80'); ?>>71 - 80</option>
                                <option value="81 ke atas" <?= set_select('input_kategori_umur', '81 ke atas'); ?>>81 ke atas</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="input_jantina" class="form-label"><strong>6) Pilih Jantina :</strong></label>
                            <select name="input_jantina" id="input_jantina" class="form-control">
                                <option value="0">Sila Pilih</option>
                                <option value="Lelaki" <?= set_select('input_jantina', 'Lelaki'); ?>>Lelaki</option>
                                <option value="Perempuan" <?= set_select('input_jantina', 'Perempuan'); ?>>Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="input_kaum" class="form-label"><strong>7) Pilih Kaum :</strong></label>
                            <select name="input_kaum" id="input_kaum" class="form-control">
                                <option value="0">Sila Pilih</option>
                                <option value="Melayu" <?= set_select('input_kaum', 'Melayu'); ?>>Melayu</option>
                                <option value="Cina" <?= set_select('input_kaum', 'Cina'); ?>>Cina</option>
                                <option value="India" <?= set_select('input_kaum', 'India'); ?>>India</option>
                                <option value="Bumiputera Islam Sabah (Lain-Lain Kaum)" <?= set_select('input_kaum', 'Bumiputera Islam Sabah (Lain-Lain Kaum)'); ?>>Bumiputera Islam Sabah (Lain-Lain Kaum)</option>
                                <option value="Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)" <?= set_select('input_kaum', 'Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)'); ?>>Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)</option>
                                <option value="Iban" <?= set_select('input_kaum', 'Iban'); ?>>Iban</option>
                                <option value="Bidayuh" <?= set_select('input_kaum', 'Bidayuh'); ?>>Bidayuh</option>
                                <option value="Melanau" <?= set_select('input_kaum', 'Melanau'); ?>>Melanau</option>
                                <option value="Orang Ulu" <?= set_select('input_kaum', 'Orang Ulu'); ?>>Orang Ulu</option>
                                <option value="Orang Asli" <?= set_select('input_kaum', 'Orang Asli'); ?>>Orang Asli</option>
                                <option value="Punjabi" <?= set_select('input_kaum', 'Punjabi'); ?>>Punjabi / Sikh</option>
                                <option value="Lain-Lain Kaum" <?= set_select('input_kaum', 'Lain-Lain Kaum'); ?>>Lain-Lain Kaum</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="input_status_calon" class="form-label"><strong>8) Adakah Calon Merupakan Penyandang Parlimen?</strong></label>
                            <select name="input_status_calon" id="input_status_calon" class="form-control">
                                <option value="0">Sila Pilih</option>
                                <option value="Penyandang" <?= set_select('input_status_calon', 'Penyandang'); ?>>Ya</option>
                                <option value="Bukan Penyandang" <?= set_select('input_status_calon', 'Bukan Penyandang'); ?>>Tidak</option>
                            </select>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <div class="">
                                <button type="reset" class="btn btn-secondary w-100">Set Semula</button>
                            </div>
                            <div class="">
                                <input type="hidden" name="input_foto_bil" value="5">
                                <input type="hidden" name="input_pengguna_bil" value="<?= $this->session->userdata('pengguna_bil'); ?>">
                                <input type="hidden" name="input_pengguna_waktu" value="<?= date("Y-m-d H:i:s"); ?>">
                                <button type="submit" class="btn btn-primary w-100">Tambah Calon</button>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php $this->load->view($footer); ?>
