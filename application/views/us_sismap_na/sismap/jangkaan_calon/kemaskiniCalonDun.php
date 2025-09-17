<?php 
$this->load->view('us_sismap_na/susunletak/atas');
$this->load->view('us_sismap_na/susunletak/sidebar');
$this->load->view('us_sismap_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('winnable_candidate') ?>">Jangkaan Calon</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('winnable_candidate/negeri/'.$dun->nt_bil) ?>"><?= $dun->nt_nama ?></a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('winnable_candidate/dun/'.$dun->dun_bil) ?>"><?= $dun->dun_nama ?></a></li>
                <li class="breadcrumb-item active">Kemaskini Maklumat Jangkaan Calon DUN <?= $dun->dun_nama ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        
        <?php $this->load->view('us_sismap_na/sismap/jangkaan_calon/nav'); ?>

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Kemaskini Maklumat Jangkaan Calon DUN <?= $dun->dun_nama ?></h1>
                <?php echo validation_errors(); ?>
                <div class="row g-1">
                    <div class="col-auto col-lg-4">
                        <div class="text-center">
                            <?php $nama_foto = $data_foto->foto($calon->jdt_foto_bil); ?>
                            <img src="<?php echo base_url('assets/img/').$nama_foto->foto_nama; ?>" style="object-fit: cover; width: 200px; height: 200px; border-radius: 100%;"/>
                            <div class="p-3">
                    <?php echo form_open_multipart('foto/tukar_gambar_jdt');?>

                    <input type="file" name="input_userfile" class="form-control mb-3" accept="image/png, image/jpeg" />
                    <input type="hidden" name="input_foto_deskripsi" value="Gambar bagi <?php echo $calon->jdt_nama_penuh; ?>">
                    <input type="hidden" name="input_pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                    <input type="hidden" name="input_calon_bil" value="<?php echo $calon->jdt_bil; ?>">
                    <input type="hidden" name="inputDunBil" value="<?php echo $calon->jdt_dun_bil; ?>">

                    <input type="submit" value="Tukar Gambar" class="btn btn-outline-primary shadow-sm"/>

                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-auto col-lg-8">
                        <h2 class="card-title">Maklumat Am</h2>
                        <?php echo form_open('winnable_candidate/prosesKemaskiniCalonDun'); ?>
                            <div class="form-floating mb-3">
                                <textarea name="input_nama_penuh" id="input_nama_penuh" cols="30" rows="5" class="form-control" style="height:100px;"><?php echo $calon->jdt_nama_penuh; ?></textarea>
                                <label for="input_nama_penuh" class="form-label">Nama Penuh</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select name="input_parti_bil" id="input_parti_bil" class="form-control" aria-describedby="input_parti_bil_help">
                                    <option value="0">Sila Pilih</option>
                                    <?php foreach($senarai_parti as $parti): ?>
                                    <option value="<?php echo $parti->parti_bil; ?>" <?php if($calon->jdt_parti_bil == $parti->parti_bil){ echo "selected"; } ?>><?php echo $parti->parti_singkatan; ?> - <?php echo $parti->parti_nama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="input_parti_bil" class="form-label">Parti</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea name="input_jawatan_parti" id="input_nama_penuh" cols="30" rows="5" class="form-control" style="height: 100px;"><?php echo $calon->jdt_jawatan_parti; ?></textarea>
                                <label for="input_jawatan_parti" class="form-label">Jawatan Parti</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select name="input_kategori_umur" id="input_kategori_umur" class="form-control">
                    <option value="0">Sila Pilih</option>
                    <option value="18 - 24" <?php if($calon->jdt_kategori_umur == "18 - 24"){ echo "selected"; } ?>>18 - 24</option>
                    <option value="25 - 40" <?php if($calon->jdt_kategori_umur == "25 - 40"){ echo "selected"; } ?>>25 - 40</option>
                    <option value="41 - 60" <?php if($calon->jdt_kategori_umur == "41 - 60"){ echo "selected"; } ?>>41 - 60</option>
                    <option value="61 - 70" <?php if($calon->jdt_kategori_umur == "61 - 70"){ echo "selected"; } ?>>61 - 70</option>
                    <option value="71 - 80" <?php if($calon->jdt_kategori_umur == "71 - 80"){ echo "selected"; } ?>>71 - 80</option>
                    <option value="81 ke atas" <?php if($calon->jdt_kategori_umur == "81 ke atas"){ echo "selected"; } ?>>81 ke atas</option>
                </select>
                            <label for="input_kategori_umur" class="form-label">Kategori Umur</label>
                            </div>
                <div class="form-floating mb-3">
                    <select name="input_jantina" id="input_jantina" class="form-control">
                    <option value="0">Sila Pilih</option>
                    <option value="Lelaki" <?php if($calon->jdt_jantina == "Lelaki"){ echo "selected"; } ?>>Lelaki</option>
                    <option value="Perempuan" <?php if($calon->jdt_jantina == "Perempuan"){ echo "selected"; } ?>>Perempuan</option>
                </select>
                <label for="input_jantina" class="form-label">Jantina</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="input_kaum" id="input_kaum" class="form-control">
                    <option value="0">Sila Pilih</option>
                    <option value="Melayu" <?php if($calon->jdt_kaum == "Melayu"){ echo "selected"; } ?>>Melayu</option>
                    <option value="Cina" <?php if($calon->jdt_kaum == "Cina"){ echo "selected"; } ?>>Cina</option>
                    <option value="India" <?php if($calon->jdt_kaum == "India"){ echo "selected"; } ?>>India</option>
                    <option value="Bumiputera Islam Sabah (Lain-Lain Kaum)" <?php if($calon->jdt_kaum == "Bumiputera Islam Sabah (Lain-Lain Kaum)"){ echo "selected"; } ?>>Bumiputera Islam Sabah (Lain-Lain Kaum)</option>
                    <option value="Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)" <?php if($calon->jdt_kaum == "Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)"){ echo "selected"; } ?>>Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)</option>
                    <option value="Iban" <?php if($calon->jdt_kaum == "Iban"){ echo "selected"; } ?>>Iban</option>
                    <option value="Bidayuh" <?php if($calon->jdt_kaum == "Bidayuh"){ echo "selected"; } ?>>Bidayuh</option>
                    <option value="Melanau" <?php if($calon->jdt_kaum == "Melanau"){ echo "selected"; } ?>>Melanau</option>
                    <option value="Orang Ulu" <?php if($calon->jdt_kaum == "Orang Ulu"){ echo "selected"; } ?>>Orang Ulu</option>
                    <option value="Orang Asli" <?php if($calon->jdt_kaum == "Orang Asli"){ echo "selected"; } ?>>Orang Asli</option>
                    <option value="Punjabi" <?php if($calon->jdt_kaum == "Punjabi / Sikh"){ echo "selected"; } ?>>Punjabi / Sikh</option>
                    <option value="Lain-Lain Kaum" <?php if($calon->jdt_kaum == "Lain-Lain Kaum"){ echo "selected"; } ?>>Lain-Lain Kaum</option>
                </select>
                    <label for="input_kaum" class="form-label">Kaum</label>
                </div>
                        <div class="form-floating mb-3">
                            <select name="input_status_calon" id="input_status_calon" class="form-control">
                    <option value="0">Sila Pilih</option>
                    <option value="Penyandang" <?php if($calon->jdt_status_calon == "Penyandang"){ echo "selected"; } ?>>Penyandang</option>
                    <option value="Bukan Penyandang" <?php if($calon->jdt_status_calon == "Bukan Penyandang"){ echo "selected"; } ?>>Bukan Penyandang</option>
                </select>
                                        <label for="input_status_calon" class="form-label">Penyandang / Bukan Penyandang</label>
            </div>
                        <div class="form-floating mb-3">
                            <input type="hidden" name="input_dun_bil" value="<?php echo $calon->jdt_dun_bil; ?>">
                            <input type="hidden" name="input_pengguna_waktu" value="<?php echo date("Y-m-d H:i:s"); ?>">
                            <input type="hidden" name="input_jdt_bil" value="<?php echo $calon->jdt_bil; ?>">
                            <div class="d-flex justify-content-center align-items-stretch">
                                <div class="m-1">
                                    <button type="submit" class="btn btn-outline-primary">Simpan</button>
                                </div>
                                <div class="m-1">
                                    <?php echo anchor('winnable_candidate/verifyPadamDun/'.$calon->jdt_bil, 'Padam', "class='btn btn-outline-danger'"); ?>
                                </div>
                                <div class="m-1">
                                    <?php echo anchor('winnable_candidate/tambahanDun/'.$calon->jdt_bil, 'Kekuatan dan Kelemahan Calon', "class='btn btn-outline-secondary'"); ?>
                                </div>
                            </div>
                                    </div>
                    </form>
                    </div>


                </div>
            </div>
        </div>

    </section>


    </main>


<?php $this->load->view('us_sismap_na/susunletak/bawah'); ?>
