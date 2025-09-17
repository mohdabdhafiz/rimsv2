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
                <li class="breadcrumb-item "><a href="<?= site_url('cpi/senarai_kluster_isu') ?>">Senarai Kluster Isu</a></li>
                <li class="breadcrumb-item active">Senarai Kategori Isu</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <a href="<?= site_url('cpi/senarai_kluster_isu') ?>" class="btn btn-outline-info mb-3 shadow-sm">Kembali Ke Senarai Kluster Isu</a>

    
    <section class="section">

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Senarai Kategori Isu Mengikut Kluster <?= $kluster->kit_nama ?></h1>
                <a href="<?= site_url('cpi/tambahKategori/'.$kluster->kit_bil) ?>" class="btn btn-outline-primary shadow-sm mb-3">Tambah Kategori Baharu Mengikut Kluster <?= $kluster->kit_nama ?></a>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>BIL</th>
                                <th>NAMA KATEGORI</th>
                                <th>DESKRIPSI</th>
                                <th>TAPISAN</th>
                                <th>KEMASKINI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($senaraiKategori as $sk): ?>
                            <tr>
                                <td><?= $sk->bil ?></td>
                                <td><?= $sk->nama ?></td>
                                <td><?= $sk->deskripsi ?></td>
                                <td><?= $sk->tapisan ?></td>
                                <td>
                                    <a href="<?= site_url('cpi/kemaskiniKategoriIsu/'.$sk->bil) ?>" class="btn btn-outline-primary shadow-sm">Kemaskini</a>
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


<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>d