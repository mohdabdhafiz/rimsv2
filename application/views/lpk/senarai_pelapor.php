

    <div class="pagetitle">
        <h1>Papan Pemuka Sentimen</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('sentimen/urus_tadbir') ?>">Utama</a></li>
                <li class="breadcrumb-item active">Analisis Isu & Sentimen</li>
            </ol>
        </nav>
    </div>


<section>

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Senarai Pelapor Isu & Sentimen</h5>   
                    <p>Bilangan Pelapor: <?= count($senarai_pelapor); ?></p>
                    <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Pelapor</th>
                                <th scope="col">Jawatan Pelapor</th>
                                <th scope="col">Penempatan Pelapor</th>
                                <th scope="col">Nombor Telefon Pelapor</th>
                                <th scope="col">Bilangan Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                            foreach($senarai_pelapor as $pelapor) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $pelapor->nama_pelapor; ?></td>
                                <td><?= $pelapor->jawatan_pelapor; ?></td>
                                <td><?= $pelapor->penempatan_pelapor; ?></td>
                                <td><?= $pelapor->no_tel_pelapor; ?></td>
                                <td><?= $pelapor->jumlah_isu; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>   
                    <p>Bilangan Laporan ini dibuat mengikut bilangan laporan berdasarkan negeri laporan ini.</p>
                </div>
            </div>

        </div>
    </div>

</section>
