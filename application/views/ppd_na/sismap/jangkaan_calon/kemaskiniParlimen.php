<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('winnable_candidate') ?>">Jangkaan Calon</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('winnable_candidate/negeri/'.$parlimen->nt_bil) ?>"><?= $parlimen->nt_nama ?></a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('winnable_candidate/parlimen/'.$parlimen->pt_bil) ?>"><?= $parlimen->pt_nama ?></a></li>
                <li class="breadcrumb-item active">Kemaskini Maklumat Jangkaan Calon Parlimen <?= $parlimen->pt_nama ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        
        <?php $this->load->view('ppd_na/sismap/jangkaan_calon/nav'); ?>

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Kemaskini Maklumat Jangkaan Calon Parlimen <?= $parlimen->pt_nama ?></h1>

    <?php echo validation_errors(); ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr class="bg-secondary text-white">
                <th>GAMBAR</th>
                <th>NAMA CALON</th>
                <th>PARTI CALON</th>
                <th>JAWATAN DALAM PARTI</th>
                <th>KATEGORI UMUR</th>
                <th>JANTINA</th>
                <th>KAUM</th>
                <th>PENYANDANG</th>
                <th>OPERASI</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($senarai_calon as $calon): ?>
                <tr>
                    <td class="text-center">
                        <?php $nama_foto = $data_foto->foto($calon->wct_foto_bil); ?>
                        <img src="<?php echo base_url('assets/img/').$nama_foto->foto_nama; ?>" style="object-fit: cover;width: 100px;height: 100px; border-radius: 100%;"/>
            <div class="p-3">
                <?php echo form_open_multipart('foto/tukar_gambar_wct');?>

                <input type="file" name="input_userfile" size="20" class="form-control-file" />

                <br /><br />
                <input type="hidden" name="input_foto_deskripsi" value="Gambar bagi <?php echo $calon->wct_nama_penuh; ?>">
                <input type="hidden" name="input_pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                <input type="hidden" name="input_wct_bil" value="<?php echo $calon->wct_bil; ?>">

                <input type="submit" value="Tukar Gambar" class="btn btn-outline-primary"/>

                </form>
            </div>
                    </td>
                    <?php echo form_open('winnable_candidate/proses_kemaskini'); ?>
                        <td>
                            <textarea name="input_nama_penuh" id="input_nama_penuh" cols="30" rows="5" class="form-control"><?php echo $calon->wct_nama_penuh; ?></textarea>
                        <td>
                            <select name="input_parti_bil" id="input_parti_bil" class="form-control" aria-describedby="input_parti_bil_help">
                                <option value="0">Sila Pilih</option>
                                <?php foreach($senarai_parti as $parti): ?>
                                <option value="<?php echo $parti->parti_bil; ?>" <?php if($calon->wct_parti_bil == $parti->parti_bil){ echo "selected"; } ?>><?php echo $parti->parti_singkatan; ?> - <?php echo $parti->parti_nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                        <textarea name="input_jawatan_parti" id="input_nama_penuh" cols="30" rows="5" class="form-control"><?php echo $calon->wct_jawatan_parti; ?></textarea>
                        </td>
                        <td><select name="input_kategori_umur" id="input_kategori_umur" class="form-control">
                    <option value="0">Sila Pilih</option>
                    <option value="18 - 24" <?php if($calon->wct_kategori_umur == "18 - 24"){ echo "selected"; } ?>>18 - 24</option>
                    <option value="25 - 40" <?php if($calon->wct_kategori_umur == "25 - 40"){ echo "selected"; } ?>>25 - 40</option>
                    <option value="41 - 60" <?php if($calon->wct_kategori_umur == "41 - 60"){ echo "selected"; } ?>>41 - 60</option>
                    <option value="61 - 70" <?php if($calon->wct_kategori_umur == "61 - 70"){ echo "selected"; } ?>>61 - 70</option>
                    <option value="71 - 80" <?php if($calon->wct_kategori_umur == "71 - 80"){ echo "selected"; } ?>>71 - 80</option>
                    <option value="81 ke atas" <?php if($calon->wct_kategori_umur == "81 ke atas"){ echo "selected"; } ?>>81 ke atas</option>
                </select></td>
                <td><select name="input_jantina" id="input_jantina" class="form-control">
                    <option value="0">Sila Pilih</option>
                    <option value="Lelaki" <?php if($calon->wct_jantina == "Lelaki"){ echo "selected"; } ?>>Lelaki</option>
                    <option value="Perempuan" <?php if($calon->wct_jantina == "Perempuan"){ echo "selected"; } ?>>Perempuan</option>
                </select></td>
                <td><select name="input_kaum" id="input_kaum" class="form-control">
                    <option value="0">Sila Pilih</option>
                    <option value="Melayu" <?php if($calon->wct_kaum == "Melayu"){ echo "selected"; } ?>>Melayu</option>
                    <option value="Cina" <?php if($calon->wct_kaum == "Cina"){ echo "selected"; } ?>>Cina</option>
                    <option value="India" <?php if($calon->wct_kaum == "India"){ echo "selected"; } ?>>India</option>
                    <option value="Bumiputera Islam Sabah (Lain-Lain Kaum)" <?php if($calon->wct_kaum == "Bumiputera Islam Sabah (Lain-Lain Kaum)"){ echo "selected"; } ?>>Bumiputera Islam Sabah (Lain-Lain Kaum)</option>
                    <option value="Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)" <?php if($calon->wct_kaum == "Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)"){ echo "selected"; } ?>>Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)</option>
                    <option value="Iban" <?php if($calon->wct_kaum == "Iban"){ echo "selected"; } ?>>Iban</option>
                    <option value="Bidayuh" <?php if($calon->wct_kaum == "Bidayuh"){ echo "selected"; } ?>>Bidayuh</option>
                    <option value="Melanau" <?php if($calon->wct_kaum == "Melanau"){ echo "selected"; } ?>>Melanau</option>
                    <option value="Orang Ulu" <?php if($calon->wct_kaum == "Orang Ulu"){ echo "selected"; } ?>>Orang Ulu</option>
                    <option value="Orang Asli" <?php if($calon->wct_kaum == "Orang Asli"){ echo "selected"; } ?>>Orang Asli</option>
                    <option value="Punjabi" <?php if($calon->wct_kaum == "Punjabi / Sikh"){ echo "selected"; } ?>>Punjabi / Sikh</option>
                    <option value="Lain-Lain Kaum" <?php if($calon->wct_kaum == "Lain-Lain Kaum"){ echo "selected"; } ?>>Lain-Lain Kaum</option>
                </select></td>
                        <td><select name="input_status_calon" id="input_status_calon" class="form-control">
                    <option value="0">Sila Pilih</option>
                    <option value="Penyandang" <?php if($calon->wct_status_calon == "Penyandang"){ echo "selected"; } ?>>Penyandang</option>
                    <option value="Bukan Penyandang" <?php if($calon->wct_status_calon == "Bukan Penyandang"){ echo "selected"; } ?>>Bukan Penyandang</option>
                </select></td>
                        <td>
                            <input type="hidden" name="input_parlimen_bil" value="<?php echo $calon->wct_parlimen_bil; ?>">
                            <input type="hidden" name="input_pengguna_waktu" value="<?php echo date("Y-m-d H:i:s"); ?>">
                            <input type="hidden" name="input_wct_bil" value="<?php echo $calon->wct_bil; ?>">
                            <div class="row g-1">
                                <div class="col">
                                    <button type="submit" class="btn btn-outline-primary w-100">Simpan</button>
                                </div>
                                <div class="col">
                                    <?php echo anchor('winnable_candidate/verify_padam/'.$calon->wct_bil, 'Padam', "class='btn btn-outline-danger w-100'"); ?>
                                </div>
                                <div class="col">
                                    <?php echo anchor('winnable_candidate/tambahan/'.$calon->wct_bil, 'Kekuatan dan Kelemahan Calon', "class='btn btn-outline-secondary w-100'"); ?>
                                </div>
                            </div>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
            </div>
        </div>

    </section>


    </main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>
