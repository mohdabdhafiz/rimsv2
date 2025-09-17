<?php 
$this->load->view('us_lapis_na/susunletak/atas');
$this->load->view('us_lapis_na/susunletak/sidebar');
$this->load->view('us_lapis_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS@LAPIS</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('cpi/kluster_isu') ?>">Konfigurasi</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('cpi/senarai_kluster_isu') ?>">Senarai Kluster Isu</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('cpi/senaraiKategori/'.$kategori->klusterBil) ?>">Senarai Kategori Isu Mengikut Kluster <?= $kategori->kit_nama ?></a></li>
                <li class="breadcrumb-item active">Kemaskini Kategori Isu - <?= $kategori->nama ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <a href="<?= site_url('cpi/senaraiKategori/'.$kategori->klusterBil) ?>" class="btn btn-outline-info mb-3 shadow-sm">Kembali Ke Senarai Kategori Isu Mengikut Kluster <?= $kategori->kit_nama ?></a>

    
    <section class="section">

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">
                    <i class="bi bi-gear-fill"></i>
                    Kemaskini Kategori Isu</h1>
                <div class="mb-3">
                    <strong>1) Nama Kategori Isu:</strong>
                    <br><?= $kategori->nama ?>
                </div>
                <?= form_open('cpi/prosesKemaskiniKategori') ?>
                    <div class="mb-3">
                        <label for="inputDeskripsi" class="form-label"><strong>2) Deskripsi Kategori Isu:</strong></label>
                        <textarea name="inputDeskripsi" id="inputDeskripsi" cols="30" rows="10" class="form-control" autofocus>
                            <?= $kategori->deskripsi ?>
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="inputTapisan" class="form-label"><strong>3) Status Kategori Isu:</strong></label>
                        <select name="inputTapisan" id="inputTapisan" class="form-control">
                            <option value="Aktif" <?php if($kategori->tapisan == 'Aktif'){ echo 'selected'; } ?>>Aktif</option>
                            <option value="Tutup" <?php if($kategori->tapisan == 'Tutup'){ echo 'selected'; } ?>>Tutup</option>
                        </select>
                    </div>
                    <input type="hidden" name="inputBil" value="<?= $kategori->bil ?>">
                    <div class="">
                        <button type="submit" class="btn btn-outline-primary shadow-sm w-100">
                            <i class="bi bi-gear-fill"></i>
                            Kemaskini</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="alert alert-danger">
            <h1 class="alert-heading">
                <i class="bi bi-trash"></i>
                PADAM MAKLUMAT</h1>
            Adakah anda pasti untuk memadam maklumat ini?
            <?= form_open("cpi/padamKategoriIsu") ?>
                <input type="hidden" name="inputBil" value="<?= $kategori->bil ?>">
                <div class="text-end">
                    <button type="submit" class="btn btn-outline-danger shadow-sm">
                        <i class="bi bi-trash"></i>
                        Padam</button>
                </div>
            </form>
        </div>


        

    </section>

</main>


<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>d