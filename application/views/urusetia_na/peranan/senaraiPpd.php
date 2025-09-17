<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main bg-white">

<div class="pagetitle">
        <h1>RIMS - Senarai Pegawai Penerangan Daerah</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Senarai Pegawai Penerangan Daerah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">
        
    <h1 class="display-1">Pegawai Penerangan Daerah</h1>

    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>JENIS AKAUN</th>
                <th>ORGANISASI</th>
                <th>PEGAWAI PENERANGAN DAERAH</th>
                <th>SENARAI NEGERI</th>
                <th>SENARAI DAERAH</th>
                <th>SENARAI PARLIMEN</th>
                <th>SENARAI DUN</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($senaraiPpd as $p): ?>
            <tr>
                <td><?= $p->peranan_nama ?></td>
                <td><?= $p->namaOrganisasi ?></td>
                <td><?= $p->namaPpd ?></td>
                <td><?= $p->senaraiNegeri ?></td>
                <td><?= $p->senaraiDaerah ?></td>
                <td><?= $p->senaraiParlimen ?></td>
                <td><?= $p->senaraiDun ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    </section>

</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>