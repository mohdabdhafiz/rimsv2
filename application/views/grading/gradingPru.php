<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('grading') ?>">Grading</a></li>
                <li class="breadcrumb-item active"><?= $pru->pilihanraya_nama ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title d-flex justify-content-between align-items-center">Senarai Grading <?= $pru->pilihanraya_nama ?> <a href="<?= site_url('grading/muatTurun/' . $pru->pilihanraya_bil) ?>" class="btn btn-sm btn-secondary text-white">Muat Turun</a></h5>
        <p>Jenis Pilihan Raya : <?= $pru->pilihanraya_jenis ?></p>
        <p>Tarikh Penamaan : <?= $pru->pilihanraya_penamaan_calon ?> | Tarikh Lock Status : <?= $pru->pilihanraya_lock_status ?></p>
        <?php
        // build a safe array of dates between start and end, skipping invalid or '0000-00-00' values
        $dates = array();
        $start = isset($pru->pilihanraya_penamaan_calon) ? $pru->pilihanraya_penamaan_calon : null;
        $end = isset($pru->pilihanraya_lock_status) ? $pru->pilihanraya_lock_status : null;
        if ($start && $end && $start !== '0000-00-00' && $end !== '0000-00-00' && strtotime($start) !== false && strtotime($end) !== false) {
            try {
                $startDt = new DateTime($start);
                $endDt = new DateTime($end);
                if ($startDt <= $endDt) {
                    for ($dt = clone $startDt; $dt <= $endDt; $dt->modify('+1 day')) {
                        $dates[] = $dt->format('Y-m-d');
                    }
                }
            } catch (Exception $e) {
                // invalid dates -> leave $dates empty so no columns are generated
            }
        }
        ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama <?= $pru->pilihanraya_jenis ?></th>
                        <?php foreach ($dates as $i): ?>
                        <th scope="col"><?= date('d M', strtotime($i)) ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $count = 1;
                    foreach($senaraiKerusi as $kerusi): ?>
                    <tr>
                        <td><?= $count++ ?></td>
                        <td><?= $kerusi->kerusiNama ?></td>
                        <?php foreach ($dates as $i): 
                            $prop = "grading_" . str_replace('-', '_', $i);
                            $val = isset($kerusi->{$prop}) ? $kerusi->{$prop} : '';
                        ?>
                        <td>
                            <?php if ($val === '' || $val === null || $val === 'BELUM DITETAPKAN'): ?>
                                <a href="<?= site_url("grading/kemaskiniGrading/kerusiBil={$kerusi->kerusiBil}&tarikh={$i}") ?>" class="btn btn-sm btn-primary kemaskini-btn" data-kerusi="<?= htmlspecialchars($kerusi->kerusiNama, ENT_QUOTES) ?>" data-date="<?= $i ?>">Kemaskini</a>
                            <?php else: ?>
                                <?= $val ?>
                            <?php endif; ?>
                        </td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>