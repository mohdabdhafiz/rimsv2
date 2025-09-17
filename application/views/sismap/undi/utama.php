<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">HARI PEMBUANGAN UNDI</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="mb-3">
        <p>ANALISA</p>
        <ol>
            <li>Peratusan Keluar Mengundi</li>
            <li>Peratusan Keluar Mengundi Mengikut DUN / Parlimen</li>
            <li>Jangkaan Keputusan</li>
            <li>Keputusan Rasmi</li>
            <li>Jumlah Ditandingi dan Dimenangi oleh Parti Kerajaan</li>
            <li>Jumlah Ditandingi dan Dimenangi oleh Parti Komponen Kerajaan</li>
            <li>Jumlah Ditandingi dan Dimenangi oleh Parti Komponen Pembangkang</li>
            <li>Analisa Mengikut Jantina</li>
            <li>Jumlah Undi Mengikut Parti</li>
            <li>Senarai Keputusan Rasmi</li>
            <li>Analisa Ketetapan Keseluruhan</li>
            <li>Analisa Ketetapan Mengikut Negeri</li>
            <li>Analisa Ketetapan Mengikut Parlimen</li>
            <li>Analisa Ketetapan Mengikut DUN</li>
            <li>Status Grading</li>
        </ol>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Pilihan Raya</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>PRU</th>
                            <th class="text-center">Parlimen / DUN</th>
                            <th class="text-center">Tahun</th>
                            <th class="text-center">Tarikh Hari Penamaan Calon</th>
                            <th class="text-center">Tarikh Lock Status</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiPru as $pru): ?>
                        <tr>
                            <td><?= $pru->pruNama ?> (<?= $pru->pruSingkatan ?>)</td>
                            <td class="text-center"><?= $pru->pruJenis ?></td>
                            <td class="text-center"><?= $pru->pruTahun ?></td>
                            <td class="text-center"><?= $pru->pruPenamaanCalon ?></td>
                            <td class="text-center"><?= $pru->pruLockStatus ?></td>
                            <td class="text-center
                            <?php if($pru->pruStatus == 'AKTIF'){ echo "bg-success text-white"; } ?>
                            "><?= $pru->pruStatus ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    </section>


    </main>


<?php $this->load->view($footer); ?>
