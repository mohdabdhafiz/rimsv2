
        <div class="pagetitle">
            <h1>Kedudukan Pelapor</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Utama</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo site_url('lapis'); ?>">RIMS@LAPIS</a></li>
                    <li class="breadcrumb-item active">Kedudukan Pelapor</li>
                </ol>
            </nav>
        </div>
        
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">📊 Kedudukan Pelapor Mengikut Bilangan Laporan Bagi Tahun <?= date('Y') ?></h5>
                            <p>Senarai pelapor disusun mengikut jumlah laporan yang paling banyak direkodkan dalam sistem.</p>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col">Nama Pelapor</th>
                                        <th scope="col">Jawatan Pelapor</th>
                                        <th scope="col">Penempatan Pelapor</th>
                                        <th scope="col" class="text-center">Jumlah Laporan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($senarai_pelapor)): ?>
                                        <?php $bil = 1; ?>
                                        <?php for($i = 0; $i < count($senarai_pelapor); $i++): ?>
                                            <tr>
                                                <th scope="row" class="text-center"><?php echo $bil++; ?></th>
                                                <td id="<?= $senarai_pelapor[$i]['pelaporBil'] ?>"><?php echo htmlspecialchars($senarai_pelapor[$i]['pelaporNama'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($senarai_pelapor[$i]['pelaporJawatan'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($senarai_pelapor[$i]['pelaporPenempatan'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td class="text-center">
                                                    <span id="jumlahLaporan<?= $senarai_pelapor[$i]['pelaporBil'] ?>"><?= $senarai_pelapor[$i]['jumlahLaporan'] ?></span>
                                                </td>
                                            </tr>
                                        <?php endfor; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center">Tiada data laporan untuk dipaparkan.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            </div>
                    </div>

                </div>
            </div>
        </section>