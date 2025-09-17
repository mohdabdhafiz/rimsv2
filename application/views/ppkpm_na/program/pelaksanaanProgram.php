<?php 
$this->load->view('ppn_na/susunletak/atas');
$this->load->view('ppn_na/susunletak/sidebar');
$this->load->view('ppn_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url("ppn/pelaksanaanProgram") ?>">Pelaksanaan Program</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Senarai Pelaksanaan Program</h1>
                <p>Senarai program yang telah dilaksanakan/dijalankan oleh keseluruhan anggota JaPen mengikut negeri.</p>
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Nombor Siri</th>
                                <th>Nama Program</th>
                                <th>Tarikh Program</th>
                                <th>Tempat Program</th>
                                <th>Negeri</th>
                                <th>Daerah</th>
                                <th>Parlimen</th>
                                <th>DUN</th>
                                <th>Urus Setia</th>
                                <th>Tindakan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($senaraiProgram as $program): ?>
                            <tr>
                                <td><?= $program->programBil ?></td>
                                <td><?= $program->namaProgram ?></td>
                                <td><?= $program->tarikhMasaProgram ?></td>
                                <td><?= $program->tempatProgram ?></td>
                                <td><?= $program->namaNegeri ?></td>
                                <td><?= $program->namaDaerah ?></td>
                                <td><?= $program->namaParlimen ?></td>
                                <td><?= $program->namaDun ?></td>
                                <td><?= $program->urusSetia ?></td>
                                <td>
                                    <a href="<?= site_url("program/bil/".$program->programBil) ?>" class="btn btn-outline-primary shadow-sm">
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
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


<?php $this->load->view('ppn_na/susunletak/bawah'); ?>