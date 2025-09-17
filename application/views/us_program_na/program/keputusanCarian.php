<?php 
$this->load->view('us_program_na/susunletak/atas');
$this->load->view('us_program_na/susunletak/sidebar');
$this->load->view('us_program_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('program') ?>">RIMS@PROGRAM</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('program/keputusanCarian') ?>">KEPUTUSAN CARIAN</a></li>
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
                <table class="table table-bordered table-hover table-striped datatable">
                    <thead>
                        <tr>
                            <th>NOMBOR SIRI</th>
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
                            <td><?= $program->programBil ?></td>
                            <td><a href="<?= site_url('program/bil/'.$program->programBil) ?>"><?= strtoupper($program->programNama) ?></a></td>
                            <td><?= strtoupper($program->negeriNama) ?></td>
                            <td>DAERAH</td>
                            <td>PARLIMEN</td>
                            <td>DUN</td>
                            <td>STATUS</td>
                            <td>PELAPOR</td>
                            <td>NOTEL PELAPOR</td>
                            <td>TARIKH DAN MASA PROGRAM</td>
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