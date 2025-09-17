<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PERSONEL</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url("personel") ?>">Personel</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url("personel/carian") ?>">Carian</a></li>
                <li class="breadcrumb-item active"><?= $maklumatCarian ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <a href="<?= site_url('personel/carian') ?>" class="btn btn-outline-info shadow-sm mb-3"><i class="bi bi-caret-left"></i> Kembali</a>

    <?php if(!empty($senaraiPengguna)): ?>
    <div class="card">
        <div class="card-body">
            <h1 class="card-title"><i class="bi bi-file-earmark-person"></i> Keputusan Carian Personel RIMS</h1>
            <p>Bilangan Keputusan Carian Personel RIMS : <?= count($senaraiPengguna) ?></p>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombor Siri</th>
                            <th>Nama Penuh</th>
                            <th>Jawatan</th>
                            <th>Tempat Bertugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiPengguna as $maklumatPengguna): ?>
                        <tr>
                            <td><?= $maklumatPengguna->penggunaBil ?></td>
                            <td><a href="<?= site_url("personel/bil/".$maklumatPengguna->penggunaBil) ?>"><?= $maklumatPengguna->penggunaNama ?></a></td>
                            <td><?= $maklumatPengguna->penggunaJawatan ?></td>
                            <td><?= $maklumatPengguna->penggunaPenempatan ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(empty($senaraiPengguna)): ?>
        <div class="alert alert-warning">
            <h1>Keputusan Carian</h1>
            <p>Tiada maklumat ditemui.</p>
        </div>
    <?php endif; ?>

    </section>

</main>

<?php $this->load->view($footer); ?>