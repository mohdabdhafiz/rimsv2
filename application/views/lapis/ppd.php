
    <div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><?php echo anchor(base_url(), 'RIMS'); ?></li>
                <li class="breadcrumb-item"><?php echo anchor('lapis', 'RIMS@LAPIS'); ?></li>
                <li class="breadcrumb-item active">LAPORAN ISU SETEMPAT (LAPIS)</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                <?php echo $this->session->flashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row">

            <div class="col-lg-6">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title text-primary"><i class="bi bi-calendar-date me-2"></i>Laporan Bertarikh <span>| <?= date('d.m.Y') ?></span></h5>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Pelapor</th>
                                        <?php
                                        $jumlahIkutKluster = array();
                                        foreach($senarai_kluster as $kluster): 
                                            $jumlahIkutKluster[$kluster->kit_bil] = 0; ?>
                                            <th class="text-center"><?= $kluster->kit_nama ?></th>
                                        <?php endforeach; ?>
                                        <th class="text-center bg-primary text-white">Jum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $bilangan = 1;
                                    foreach($senarai_pelapor as $pelapor): ?>
                                    <tr>
                                        <td class="text-center"><?= $bilangan++ ?></td>
                                        <td><?= $pelapor->nama_penuh; ?></td>
                                        <?php 
                                        $jumlah_kluster = 0;
                                        foreach($senarai_kluster as $kluster): ?>
                                        <td class="text-center">
                                            <?php
                                            $nama_kluster = $kluster->kit_shortform;
                                            $pelapor_bil = $pelapor->bil;
                                            $tarikh = date('Y-m-d'); 
                                            $tahun = date('Y');
                                            $senarai_laporan = $data_laporan->hari_ini($nama_kluster, $pelapor_bil, $tahun, $tarikh);
                                            
                                            if(!empty($senarai_laporan)){
                                                $cnt = count($senarai_laporan);
                                                $jumlah_kluster += $cnt;
                                                $jumlahIkutKluster[$kluster->kit_bil] += $cnt;
                                                echo "<span class='badge bg-light text-dark border'>$cnt</span>";
                                            } else {
                                                echo "<span class='text-muted small'>-</span>";
                                            }
                                            ?>
                                        </td>
                                        <?php endforeach; ?>
                                        <td class="text-center bg-primary text-white fw-bold"><?= $jumlah_kluster; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="table-active fw-bold">
                                        <td colspan="2" class="text-end">JUMLAH BESAR</td>
                                        <?php
                                        $jumlahBesar = 0;
                                        foreach($senarai_kluster as $kluster):  
                                            $jumlahBesar += $jumlahIkutKluster[$kluster->kit_bil]; ?>
                                            <td class="text-center"><?= $jumlahIkutKluster[$kluster->kit_bil] ?></td>
                                        <?php endforeach; ?>
                                        <td class="text-center bg-primary text-white"><?= $jumlahBesar ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title text-secondary"><i class="bi bi-calendar-week me-2"></i>Laporan Minggu <span>| <?= date('W/Y') ?></span></h5>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Pelapor</th>
                                        <?php
                                        $jumlahIkutKluster = array();
                                        foreach($senarai_kluster as $kluster): 
                                            $jumlahIkutKluster[$kluster->kit_bil] = 0; ?>
                                            <th class="text-center"><?= $kluster->kit_nama ?></th>
                                        <?php endforeach; ?>
                                        <th class="text-center bg-secondary text-white">Jum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $bilangan = 1;
                                    foreach($senarai_pelapor as $pelapor): ?>
                                    <tr>
                                        <td class="text-center"><?= $bilangan++ ?></td>
                                        <td><?= $pelapor->nama_penuh; ?></td>
                                        <?php 
                                        $jumlah_kluster = 0;
                                        foreach($senarai_kluster as $kluster): ?>
                                        <td class="text-center">
                                            <?php
                                            $nama_kluster = $kluster->kit_shortform;
                                            $pelapor_bil = $pelapor->bil;
                                            $tahun = date('Y');
                                            $minggu = date('W');
                                            $bilanganLaporan = $data_laporan->minggu_ini($nama_kluster, $pelapor_bil, $tahun, $minggu);
                                            
                                            if(!empty($bilanganLaporan)){
                                                $jumlah_kluster += $bilanganLaporan;
                                                $jumlahIkutKluster[$kluster->kit_bil] += $bilanganLaporan;
                                                echo "<span class='badge bg-light text-dark border'>$bilanganLaporan</span>";
                                            } else {
                                                echo "<span class='text-muted small'>-</span>";
                                            }
                                            ?>
                                        </td>
                                        <?php endforeach; ?>
                                        <td class="text-center bg-secondary text-white fw-bold"><?= $jumlah_kluster; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="table-active fw-bold">
                                        <td colspan="2" class="text-end">JUMLAH BESAR</td>
                                        <?php
                                        $jumlahBesar = 0;
                                        foreach($senarai_kluster as $kluster):  
                                            $jumlahBesar += $jumlahIkutKluster[$kluster->kit_bil]; ?>
                                            <td class="text-center"><?= $jumlahIkutKluster[$kluster->kit_bil] ?></td>
                                        <?php endforeach; ?>
                                        <td class="text-center bg-secondary text-white"><?= $jumlahBesar ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title text-info"><i class="bi bi-calendar-month me-2"></i>Laporan Bulan <span>| <?= date('M Y') ?></span></h5>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Pelapor</th>
                                        <?php
                                        $jumlahIkutKluster = array();
                                        foreach($senarai_kluster as $kluster): 
                                            $jumlahIkutKluster[$kluster->kit_bil] = 0; ?>
                                            <th class="text-center"><?= $kluster->kit_nama ?></th>
                                        <?php endforeach; ?>
                                        <th class="text-center bg-info text-dark">Jum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $bilangan = 1;
                                    foreach($senarai_pelapor as $pelapor): ?>
                                    <tr>
                                        <td class="text-center"><?= $bilangan++ ?></td>
                                        <td><?= $pelapor->nama_penuh; ?></td>
                                        <?php 
                                        $jumlah_kluster = 0;
                                        foreach($senarai_kluster as $kluster): ?>
                                        <td class="text-center">
                                            <?php
                                            $nama_kluster = $kluster->kit_shortform;
                                            $pelapor_bil = $pelapor->bil;
                                            $tarikh = date('Y-m-d'); 
                                            $tahun = date('Y');
                                            $senarai_laporan = $data_laporan->bulan_ini($nama_kluster, $pelapor_bil, $tahun, $tarikh);
                                            
                                            if(!empty($senarai_laporan)){
                                                $cnt = count($senarai_laporan);
                                                $jumlah_kluster += $cnt;
                                                $jumlahIkutKluster[$kluster->kit_bil] += $cnt;
                                                echo "<span class='badge bg-light text-dark border'>$cnt</span>";
                                            } else {
                                                echo "<span class='text-muted small'>-</span>";
                                            }
                                            ?>
                                        </td>
                                        <?php endforeach; ?>
                                        <td class="text-center bg-info text-dark fw-bold"><?= $jumlah_kluster; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="table-active fw-bold">
                                        <td colspan="2" class="text-end">JUMLAH BESAR</td>
                                        <?php
                                        $jumlahBesar = 0;
                                        foreach($senarai_kluster as $kluster):  
                                            $jumlahBesar += $jumlahIkutKluster[$kluster->kit_bil]; ?>
                                            <td class="text-center"><?= $jumlahIkutKluster[$kluster->kit_bil] ?></td>
                                        <?php endforeach; ?>
                                        <td class="text-center bg-info text-dark"><?= $jumlahBesar ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title text-success"><i class="bi bi-calendar-check me-2"></i>Laporan Tahun <span>| <?= date('Y') ?></span></h5>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Pelapor</th>
                                        <?php
                                        $jumlahIkutKluster = array();
                                        foreach($senarai_kluster as $kluster): 
                                            $jumlahIkutKluster[$kluster->kit_bil] = 0; ?>
                                            <th class="text-center"><?= $kluster->kit_nama ?></th>
                                        <?php endforeach; ?>
                                        <th class="text-center bg-success text-white">Jum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $bilangan = 1;
                                    foreach($senarai_pelapor as $pelapor): ?>
                                    <tr>
                                        <td class="text-center"><?= $bilangan++ ?></td>
                                        <td><?= $pelapor->nama_penuh; ?></td>
                                        <?php 
                                        $jumlah_kluster = 0;
                                        foreach($senarai_kluster as $kluster): ?>
                                        <td class="text-center">
                                            <?php
                                            $nama_kluster = $kluster->kit_shortform;
                                            $pelapor_bil = $pelapor->bil;
                                            $tahun = date('Y');
                                            $senarai_laporan = $data_laporan->tahun_ini($nama_kluster, $pelapor_bil, $tahun);
                                            
                                            if(!empty($senarai_laporan)){
                                                $cnt = count($senarai_laporan);
                                                $jumlah_kluster += $cnt;
                                                $jumlahIkutKluster[$kluster->kit_bil] += $cnt;
                                                echo "<span class='badge bg-light text-dark border'>$cnt</span>";
                                            } else {
                                                echo "<span class='text-muted small'>-</span>";
                                            }
                                            ?>
                                        </td>
                                        <?php endforeach; ?>
                                        <td class="text-center bg-success text-white fw-bold"><?= $jumlah_kluster; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="table-active fw-bold">
                                        <td colspan="2" class="text-end">JUMLAH BESAR</td>
                                        <?php
                                        $jumlahBesar = 0;
                                        foreach($senarai_kluster as $kluster):  
                                            $jumlahBesar += $jumlahIkutKluster[$kluster->kit_bil]; ?>
                                            <td class="text-center"><?= $jumlahIkutKluster[$kluster->kit_bil] ?></td>
                                        <?php endforeach; ?>
                                        <td class="text-center bg-success text-white"><?= $jumlahBesar ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div> </section>
