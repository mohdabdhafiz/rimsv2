<main id="main" class="main">
<div class="pagetitle">
    <h1>RIMS@PROGRAM - DATA SET</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('data') ?>">Utama</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url('data/naratifProgram') ?>">Naratif x Program</a></li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="p-3 border rounded mb-3 bg-white">
        <h2>Carian Data Set Naratif x Program</h2>
        <?= validation_errors() ?>
        <?= form_open('data/naratifProgram') ?>
        <div class="row g-3">
            <div class="col col-lg-6 d-flex align-items-stretch">
                <div class="d-flex flex-column w-100">
                    <div class="form-floating">
                        <input type="date" class="form-control" name="inputTarikhMula" value="<?= set_value("inputTarikhMula") ?>" required>
                        <label for="inputTarikhMula" class="form-label">Tarikh Mula:</label>
                    </div>
                </div>
            </div>
            <div class="col col-lg-6 d-flex align-items-stretch">
                <div class="d-flex flex-column w-100">
                    <div class="form-floating">
                        <input type="date" class="form-control" name="inputTarikhTamat" value="<?= set_value("inputTarikhTamat") ?>" required>
                        <label for="inputTarikhTamat" class="form-label">Tarikh Tamat:</label>
                    </div>
                </div>
            </div>
            <!-- Program -->
<div class="col col-lg-6 d-flex align-items-stretch">
    <div class="d-flex flex-column w-100">
        <div class="form-floating">
            <?php 
            $programOptions = array();
            foreach ($senaraiProgram as $program) {
                $programOptions[$program->jenisBil] = $program->jenisNama;
            }
            echo form_dropdown('inputProgram', 
                $programOptions, 
                set_value('inputProgram'), 
                ['class' => 'form-control', 'id' => 'inputProgram']
            ); 
            ?>
            <label for="inputProgram" class="form-label">Program:</label>
        </div>
    </div>
</div>

<!-- Negeri -->
<div class="col col-lg-6 d-flex align-items-stretch">
    <div class="d-flex flex-column w-100">
        <div class="form-floating">
            <?php 
            $negeriOptions = array('' => 'SEMUA');
            foreach ($senaraiNegeri as $negeri) {
                $negeriOptions[$negeri->negeriBil] = $negeri->negeriNama;
            }
            echo form_dropdown('inputNegeri', 
                $negeriOptions, 
                set_value('inputNegeri'), 
                ['class' => 'form-control', 'id' => 'inputNegeri']
            ); 
            ?>
            <label for="inputNegeri" class="form-label">Negeri:</label>
        </div>
    </div>
</div>


            <div class="col col-lg-12 d-flex align-items-stretch">
                <div class="d-flex flex-column w-100">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
            </div>
        </div>
        <?= form_close() ?>
    </div>

    <?php 
    if (!empty($senaraiPilihanProgram)): 
        foreach ($senaraiPilihanProgram as $pilihanProgram):        
    ?>
        <div class="p-3 border rounded bg-white mb-3">
            <h1>Senarai Naratif Mengikut Program <?= $pilihanProgram->jenisNama ?></h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Bil</th>
                            <th>Naratif</th>
                            <th>Bilangan Program</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pilihanProgram->dataHasilKeputusan)): ?>
                            <?php $count = 1; foreach ($pilihanProgram->dataHasilKeputusan as $keputusan): ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= $keputusan->naratifNama ?></td>
                                <td><?= $keputusan->programBilangan ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">Tiada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
        endforeach;
    endif; 
    ?>


    <div class="p-3 border rounded bg-white">
        <h3>Senarai Data Set</h3>
        <ol>
            <li><a href="<?= site_url('data/naratifProgram') ?>">Senarai Naratif dan Bilangan Program</a></li>
        </ol>
    </div>
</section>
</main>