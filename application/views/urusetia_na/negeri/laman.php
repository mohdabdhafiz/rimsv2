<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS - KONFIGURASI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">
                    <i class="bi bi-file-earmark-text"></i>
                    Senarai Negeri
                </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section bg-light">
        
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
            <h1 class="card-title">
                <i class="bi bi-file-earmark-text"></i>
                Senarai Negeri
            </h1>
            <a href="<?= site_url('negeri/tambah') ?>" class="btn btn-outline-primary shadow-sm">
                <i class="bi bi-plus"></i>
            </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Bil</th>
                            <th>Nama Negeri</th>
                            <th>Bendera</th>
                            <th>Operasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiNegeri as $negeri): ?>
                        <tr>
                            <td><?= $negeri->negeriBil ?></td>
                            <td><?= strtoupper($negeri->negeriNama) ?></td>
                            <td>
                                <img src="<?= base_url() ?>assets/bendera/<?= $negeri->negeriFail ?>" alt="<?= strtoupper($negeri->negeriNama) ?>" class="img-fluid" style="width:200px; height:auto; object-fit:cover;">
                            </td>
                            <td>
                                <div class="row g-1">
                                    <div class="col">
                                        <a href="<?= site_url('negeri/kemaskini/'.$negeri->negeriBil) ?>" class="btn btn-outline-primary shadow-sm">
                                            <i class="bi bi-gear filled"></i>
                                        </a>
                                    </div>
                                </div>
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


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>