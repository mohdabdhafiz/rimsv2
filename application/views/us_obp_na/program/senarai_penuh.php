<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Senarai Program</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">


<?php if(!empty($senaraiProgram)): ?>
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">   
            <h5 class="card-title">Senarai Pelaporan Program</h5>
            <?= anchor('program/tambah', 'Tambah', "class='btn btn-primary shadow-sm'") ?>
        </div>
    <div class="table-responsive">
        <table class="table table-hover table-striped datatable">
            <thead>
            <tr>
                <th>Parlimen</th>
                <th>DUN</th>
                <th>Nama Program</th>
                <th>Tarikh dan Masa</th>
                <th>Dimasukkan pada</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $bilangan = 1;
            foreach($senaraiProgram as $program):
            ?>
            <tr>
                <td><?= $program->namaParlimen ?></td>
                <td><?= $program->namaDun ?></td>
                <td>
                    <?php 
                    echo $program->jt_nama;
                    ?>
                </td>
                <td><?= $program->tarikh_masa_program ?></td>
                <td><?= $program->pengguna_waktu ?></td>
                <td>Status</td>
                <td>
                    <?= anchor('program/maklumat/'.$program->bilProgram, 'Previu', "class='btn btn-primary shadow-sm mb-1 w-100'") ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div>
</div>
<?php endif; ?>

<?php if(empty($senaraiProgram)): ?>
    <div class="alert alert-warning">
        Tiada laporan program didaftarkan.
    </div>
<?php endif; ?>

</section>


</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>