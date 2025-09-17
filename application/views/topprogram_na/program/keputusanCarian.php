<?php 
$this->load->view('us_program_na/susunletak/atas');
$this->load->view('us_program_na/susunletak/sidebar');
$this->load->view('us_program_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@KOMUNITI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('program/keputusanCarian') ?>">Hasil Carian</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">


    <?php $this->load->view('us_program_na/carian'); ?>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
            <h1 class="card-title">
                <i class="bi bi-search"></i>
                Keputusan Carian
            </h1>
                <?= form_open('program/muatTurunCarian') ?>
                <input type="hidden" name="inputJenis" value="<?= $programCarian ?>">
                <input type="hidden" name="inputNegeri" value="<?= $programNegeri ?>">
                <input type="hidden" name="inputDaerah" value="<?= $programDaerah ?>">
                <input type="hidden" name="inputParlimen" value="<?= $programParlimen ?>">
                <input type="hidden" name="inputDun" value="<?= $programDun ?>">
                <input type="hidden" name="inputStatus" value="<?= $programStatus ?>">
                <input type="hidden" name="inputTarikhMula" value="<?= $programMula ?>">
                <input type="hidden" name="inputTarikhTamat" value="<?= $programTamat ?>">
                <button type="submit" class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Muat Turun Senarai">
                    <i class="bi bi-download"></i>
                </button>
                </form>
            </div>
            <p>Terdapat <?= count($senaraiProgram) ?> program mengikut carian yang telah dibuat</p>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>BIL</th>
                            <th>NAMA PROGRAM</th>
                            <th>NEGERI</th>
                            <th>DAERAH</th>
                            <th>PARLIMEN</th>
                            <th>DUN</th>
                            <th>STATUS LAPORAN</th>
                            <th>NAMA PELAPOR</th>
                            <th>NOMBOR TELEFON PELAPOR</th>
                            <th>TARIKH PROGRAM</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiProgram as $program): ?>
                        <tr>
                            <td><?= $program->program_bil ?></td>
                            <td><a href="<?= site_url('program/bil/'.$program->program_bil) ?>"><?= $program->jt_nama ?></a></td>
                            <td><?= $program->nt_nama ?></td>
                            <td><?= $program->nama ?></td>
                            <td><?= $program->pt_nama ?></td>
                            <td><?= $program->dun_nama ?></td>
                            <td><?= $program->program_status ?></td>
                            <td><?= $program->nama_penuh ?></td>
                            <td><?= $program->no_tel ?></td>
                            <td><?= $program->program_tarikh_masa ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    </section>


</main>


<?php $this->load->view('us_program_na/susunletak/bawah'); ?>