<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Pilihan Raya</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        
        <?php $this->load->view('urusetia_na/sismap/jangkaan_calon/nav'); ?>

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Tambah Jangkaan Calon DUN</h1>
                <?php echo validation_errors(); ?>
        <?php echo form_open('dun/proses_jangkaan_calon'); ?>
            <div class="mb-3">
                <p><strong>1) Pilih DUN :</strong></p>
                <?php foreach($senaraiNegeri as $negeri): ?>
                <div class="row g-3 border rounded mx-1 mt-1">
                    <label class="form-label mt-1"><strong><?= $negeri->nt_nama ?></strong></label> 
                        <?php 
                            $senarai_dun = $dataDun->dun_negeri($negeri->nt_bil);
                            foreach($senarai_dun as $dun): ?>
                    <div class="col-12 col-lg-3 col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="input_dun_bil" id="input_dun_bil.<?php echo $dun->dun_bil; ?>" <?php if($dun->dun_bil == set_value('input_dun_bil')){ echo "checked"; } ?> value="<?php echo $dun->dun_bil; ?>">
                            <label class="form-check-label" for="input_dun_bil.<?php echo $dun->dun_bil; ?>">
                                <?php echo $dun->dun_nama; ?>
                            </label>
                        </div>
                    </div>
                            <?php endforeach; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="mb-3">
                <label for="input_nama_penuh" class="form-label"><strong>2) Masukkan Nama Penuh Calon :</strong></label>
                <input type="text" name="input_nama_penuh" id="input_nama_penuh" class="form-control" value="<?php echo set_value('input_nama_penuh'); ?>">
            </div>
            <div class="mb-3">
                <div class="row g-3">
                    <label class="form-label"><strong>3) Pilih Parti :</strong></label> 
                    <?php foreach($senarai_parti as $parti): ?>
                    <div class="col-12 col-lg-4 col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="input_parti_bil" id="input_parti_bil.<?php echo $parti->parti_bil; ?>" <?php if($parti->parti_bil == set_value('input_parti_bil')){ echo "checked"; } ?> value="<?php echo $parti->parti_bil; ?>">
                            <label class="form-check-label" for="input_parti_bil.<?php echo $parti->parti_bil; ?>">
                                <?php echo $parti->parti_singkatan; ?> - <?php echo $parti->parti_nama; ?>
                            </label>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <small id="input_parti_bil_help" class="form-text text-muted">Sila hubungi urus setia jika parti yang hendak dipilih tiada dalam senarai.</small>
                </div>
            </div>
            <div class="mb-3">
                <label for="input_jawatan_parti" class="form-label"><strong>4) Masukkan Jawatan Dalam Parti :</strong></label>
                <input type="text" name="input_jawatan_parti" id="input_jawatan_parti" class="form-control" value="<?php echo set_value('input_jawatan_parti'); ?>">
            </div>
            <div class="mb-3">
                <label for="input_kategori_umur" class="form-label"><strong>5) Pilih Kategori Umur :</strong></label>
                <select name="input_kategori_umur" id="input_kategori_umur" class="form-control">
                    <option value="0">Sila Pilih</option>
                    <option value="18 - 24" <?php if(set_value('input_kategori_umur') == "18 - 24"){ echo "selected"; } ?>>18 - 24</option>
                    <option value="25 - 40" <?php if(set_value('input_kategori_umur') == "25 - 40"){ echo "selected"; } ?>>25 - 40</option>
                    <option value="41 - 60" <?php if(set_value('input_kategori_umur') == "41 - 60"){ echo "selected"; } ?>>41 - 60</option>
                    <option value="61 - 70" <?php if(set_value('input_kategori_umur') == "61 - 70"){ echo "selected"; } ?>>61 - 70</option>
                    <option value="71 - 80" <?php if(set_value('input_kategori_umur') == "71 - 80"){ echo "selected"; } ?>>71 - 80</option>
                    <option value="81 ke atas" <?php if(set_value('input_kategori_umur') == "81 ke atas"){ echo "selected"; } ?>>81 ke atas</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="input_jantina" class="form-label"><strong>6) Pilih Jantina :</strong></label>
                <select name="input_jantina" id="input_jantina" class="form-control">
                    <option value="0">Sila Pilih</option>
                    <option value="Lelaki" <?php if(set_value('input_jantina') == "Lelaki"){ echo "selected"; } ?>>Lelaki</option>
                    <option value="Perempuan" <?php if(set_value('input_jantina') == "Perempuan"){ echo "selected"; } ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="input_kaum" class="form-label"><strong>7) Pilih Kaum :</strong></label>
                <select name="input_kaum" id="input_kaum" class="form-control">
                    <option value="0">Sila Pilih</option>
                    <option value="Melayu" <?php if(set_value('input_kaum') == "Melayu"){ echo "selected"; } ?>>Melayu</option>
                    <option value="Cina" <?php if(set_value('input_kaum') == "Cina"){ echo "selected"; } ?>>Cina</option>
                    <option value="India" <?php if(set_value('input_kaum') == "India"){ echo "selected"; } ?>>India</option>
                    <option value="Bumiputera Islam Sabah (Lain-Lain Kaum)" <?php if(set_value('input_kaum') == "Bumiputera Islam Sabah (Lain-Lain Kaum)"){ echo "selected"; } ?>>Bumiputera Islam Sabah (Lain-Lain Kaum)</option>
                    <option value="Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)" <?php if(set_value('input_kaum') == "Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)"){ echo "selected"; } ?>>Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)</option>
                    <option value="Iban" <?php if(set_value('input_kaum') == "Iban"){ echo "selected"; } ?>>Iban</option>
                    <option value="Bidayuh" <?php if(set_value('input_kaum') == "Bidayuh"){ echo "selected"; } ?>>Bidayuh</option>
                    <option value="Melanau" <?php if(set_value('input_kaum') == "Melanau"){ echo "selected"; } ?>>Melanau</option>
                    <option value="Orang Ulu" <?php if(set_value('input_kaum') == "Orang Ulu"){ echo "selected"; } ?>>Orang Ulu</option>
                    <option value="Orang Asli" <?php if(set_value('input_kaum') == "Orang Asli"){ echo "selected"; } ?>>Orang Asli</option>
                    <option value="Punjabi" <?php if(set_value('input_kaum') == "Punjabi"){ echo "selected"; } ?>>Punjabi / Sikh</option>
                    <option value="Lain-Lain Kaum" <?php if(set_value('input_kaum') == "Lain-Lain Kaum"){ echo "selected"; } ?>>Lain-Lain Kaum</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="input_status_calon" class="form-label"><strong>8) Adakah Calon Merupakan Penyandang DUN?</strong></label>
                <select name="input_status_calon" id="input_status_calon" class="form-control">
                    <option value="0">Sila Pilih</option>
                    <option value="Penyandang" <?php if(set_value('input_status_calon') == "Penyandang"){ echo "selected"; } ?>>Ya</option>
                    <option value="Bukan Penyandang" <?php if(set_value('input_status_calon') == "Bukan Penyandang"){ echo "selected"; } ?>>Tidak</option>
                </select>
            </div>
            
                    <div class="text-center">
                        <input type="hidden" name="input_foto_bil" value="5">
                        <input type="hidden" name="input_pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                        <input type="hidden" name="input_pengguna_waktu" value="<?php echo date("Y-m-d H:i:s"); ?>">
                        <button type="submit" class="btn btn-outline-primary shadow-sm">Tambah Calon</button>
                    </div>
               
        </form>
        </div>
    </div>

    </section>


    </main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>
