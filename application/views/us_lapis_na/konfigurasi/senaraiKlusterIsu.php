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
                <li class="breadcrumb-item active">Senarai Kluster Isu</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <a href="<?= site_url('cpi/kluster_isu') ?>" class="btn btn-outline-info mb-3 shadow-sm">Kembali Ke Konfigurasi</a>

    
    <section class="section">


        <div class="card">
            <div class="card-body">
            <h1 class="card-title">Senarai Kluster Isu</h1>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Bil</th>
                    <th>Kluster Isu</th>
                    <th>Deskripsi</th>
                    <th>Kemaskini</th>
                    <th>Kategori Isu</th>
                </tr>
            </thead>
            <tbody>
                <?php $bilangan = 1;
                foreach($senarai_kluster_isu as $ki): ?>
                <tr>
                    <td><?= $bilangan++ ?></td>
                    <td>
                        <?= $ki->kit_nama ?>
                    </td>
                    <td><?= $ki->kit_deskripsi ?></td>
                    <td>
                        <?php echo anchor('cpi/kemaskini_kluster/'.$ki->kit_bil, 'Kemaskini', "class='btn btn-outline-primary shadow-sm'"); ?>
                    </td>
                    <td>
                        <a href="<?= site_url('cpi/senaraiKategori/'.$ki->kit_bil); ?>" class="btn btn-outline-primary shadow-sm">Kategori Isu</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
            </div>
        </div>

    </section>

</main>


<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>