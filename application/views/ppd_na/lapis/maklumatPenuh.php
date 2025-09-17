<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Senarai Penuh LAPIS</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="p-3 border rounded mb-3 bg-white shadow-sm">
    <h2 class="display-6">Senarai Penuh Laporan</h2>
    <p class="small text-muted">Senarai penuh laporan yang telah dihantar. Berikut adalah pilihan senarai kluster isu.</p>
</div>

<div class="p-3 border rounded mb-3 bg-white shadow-sm">
    <h2 class="display-6">Carian</h2>
    <div class="row g-3">
        <?= form_open('lapis/carian') ?>
            <div class="form-floating mb-3">
                <select name="inputKluster" id="inputKluster" class="form-control" required>
                    <option value="">Sila Pilih..</option>
                    <?php foreach($senarai_kluster as $kluster): ?>
                        <option value="<?= $kluster->kit_bil ?>"><?= $kluster->kit_nama ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputKluster" class="form-label">Kluster:</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="inputTahun" id="inputTahun" placeholder="Tahun:" class="form-control" required>
                <label for="inputTahun" class="form-label">Tahun:</label>
            </div>
            <button type="submit" class="btn btn-outline-success shadow-sm w-100">Cari</button>
        </form>
    </div>
</div>

<div class="row g-3 mb-3">
    <?php foreach($senarai_kluster as $kluster): ?>
        <div class="col-12 col-lg-4 d-flex align-item-stretch">
            <div class="p-3 border rounded w-100 d-flex flex-column bg-white shadow-sm">
                <div>
            <h2 class="display-6"><?= $kluster->kit_nama ?></h2>
            <p><?= $kluster->kit_deskripsi ?></p>
            </div>
            <div class="mt-auto">
            <?php echo anchor('lapis/penuh/'.$kluster->kit_shortform, 'Pilih Kluster Isu', "class='btn btn-sm btn-outline-success w-100'"); ?>
            </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

    </section>

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>