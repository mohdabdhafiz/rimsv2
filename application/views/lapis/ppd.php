<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'RIMS'); ?></li>
    <li class="breadcrumb-item"><?php echo anchor('lapis', 'RIMS@LAPIS'); ?></li>
    <li class="breadcrumb-item active" aria-current="page">Bilangan Laporan</li>
  </ol>
</nav>

<?php $this->load->view('lapis/nav'); ?>


<div class="row g-3 mb-3">
    <div class="col-12 col-lg-6">
        <div class="p-3 border rounded">
            <h2>Bilangan Laporan Bertarikh <?= date('d.m.Y') ?></h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th valign='middle' class='text-center'>#</th>
                            <th valign='middle' class='text-center'>Pelapor</th>
                            <?php
                            $jumlahIkutKluster = array();
                            foreach($senarai_kluster as $kluster): 
                                $jumlahIkutKluster[$kluster->kit_bil] = 0; ?>
                                <th valign='middle' class='text-center'><?= $kluster->kit_nama ?></th>
                            <?php endforeach; ?>
                            <th valign='middle' class='text-center bg-primary text-white'>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $bilangan = 1;
                        foreach($senarai_pelapor as $pelapor): ?>
                        <tr>
                        <tr>
                            <td valign='middle' class='text-center'><?= $bilangan++ ?></td>
                            <td valign='middle'><?= $pelapor->nama_penuh; ?></td>
                            <?php 
                            // Hari ini
                            $jumlah_kluster = 0;
                            foreach($senarai_kluster as $kluster): ?>
                            <td valign='middle' class='text-center'>
                                <?php
                                $nama_kluster = $kluster->kit_shortform;
                                $pelapor_bil = $pelapor->bil;
                                $tarikh = date('Y-m-d'); 
                                $tahun = date('Y');
                                $senarai_laporan = $data_laporan->hari_ini($nama_kluster, $pelapor_bil, $tahun, $tarikh);
                                if(!empty($senarai_laporan)){
                                    $jumlah_kluster = $jumlah_kluster + count($senarai_laporan);
                                    $jumlahIkutKluster[$kluster->kit_bil] = $jumlahIkutKluster[$kluster->kit_bil] + count($senarai_laporan);
                                    echo count($senarai_laporan);
                                }else{
                                    echo '0';
                                }
                                ?>
                            </td>
                            <?php endforeach; ?>
                            <td valign='middle' class='text-center bg-primary text-white'><?php echo $jumlah_kluster; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tfoot>
                            <tr>
                                <th colspan=2 valign='middle' class="text-center">JUMLAH</th>
                                <?php
                                $jumlahBesar = 0;
                            foreach($senarai_kluster as $kluster):  
                                $jumlahBesar = $jumlahBesar + $jumlahIkutKluster[$kluster->kit_bil]; ?>
                                <th valign='middle' class='text-center'><?= $jumlahIkutKluster[$kluster->kit_bil] ?></th>
                            <?php endforeach; ?>
                            <th valign='middle' class='text-center bg-primary text-white'><?= $jumlahBesar ?></th>
                            </tr>
                        </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="p-3 border rounded">
            <h2>Bilangan Laporan Minggu <?= date('W/Y') ?></h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th valign='middle' class='text-center'>#</th>
                            <th valign='middle' class='text-center'>Pelapor</th>
                            <?php
                            $jumlahIkutKluster = array();
                            foreach($senarai_kluster as $kluster): 
                                $jumlahIkutKluster[$kluster->kit_bil] = 0; ?>
                                <th valign='middle' class='text-center'><?= $kluster->kit_nama ?></th>
                            <?php endforeach; ?>
                            <th valign='middle' class='text-center bg-secondary text-white'>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $bilangan = 1;
                        foreach($senarai_pelapor as $pelapor): ?>
                        <tr>
                        <tr>
                            <td valign='middle' class='text-center'><?= $bilangan++ ?></td>
                            <td valign='middle'><?= $pelapor->nama_penuh; ?></td>
                            <?php 
                            // Hari ini
                            $jumlah_kluster = 0;
                            foreach($senarai_kluster as $kluster): ?>
                            <td valign='middle' class='text-center'>
                                <?php
                                $nama_kluster = $kluster->kit_shortform;
                                $pelapor_bil = $pelapor->bil;
                                $tarikh = date('Y-m-d'); 
                                $tahun = date('Y');
                                $minggu = date('W');
                                $bilanganLaporan = $data_laporan->minggu_ini($nama_kluster, $pelapor_bil, $tahun, $minggu);
                                if(!empty($bilanganLaporan)){
                                    $jumlah_kluster = $jumlah_kluster + $bilanganLaporan;
                                    $jumlahIkutKluster[$kluster->kit_bil] = $jumlahIkutKluster[$kluster->kit_bil] + $bilanganLaporan;
                                    echo $bilanganLaporan;
                                }else{
                                    echo '0';
                                }
                                ?>
                            </td>
                            <?php endforeach; ?>
                            <td valign='middle' class='text-center bg-secondary text-white'><?php echo $jumlah_kluster; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tfoot>
                            <tr>
                                <th colspan=2 valign='middle' class="text-center">JUMLAH</th>
                                <?php
                                $jumlahBesar = 0;
                            foreach($senarai_kluster as $kluster):  
                                $jumlahBesar = $jumlahBesar + $jumlahIkutKluster[$kluster->kit_bil]; ?>
                                <th valign='middle' class='text-center'><?= $jumlahIkutKluster[$kluster->kit_bil] ?></th>
                            <?php endforeach; ?>
                            <th valign='middle' class='text-center bg-secondary text-white'><?= $jumlahBesar ?></th>
                            </tr>
                        </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="p-3 border rounded">
            <h2>Bilangan Laporan Bulan <?= date('M Y') ?></h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th valign='middle' class='text-center'>#</th>
                            <th valign='middle' class='text-center'>Pelapor</th>
                            <?php
                            $jumlahIkutKluster = array();
                            foreach($senarai_kluster as $kluster): 
                                $jumlahIkutKluster[$kluster->kit_bil] = 0; ?>
                                <th valign='middle' class='text-center'><?= $kluster->kit_nama ?></th>
                            <?php endforeach; ?>
                            <th valign='middle' class='text-center bg-info text-black'>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $bilangan = 1;
                        foreach($senarai_pelapor as $pelapor): ?>
                        <tr>
                        <tr>
                            <td valign='middle' class='text-center'><?= $bilangan++ ?></td>
                            <td valign='middle'><?= $pelapor->nama_penuh; ?></td>
                            <?php 
                            // Hari ini
                            $jumlah_kluster = 0;
                            foreach($senarai_kluster as $kluster): ?>
                            <td valign='middle' class='text-center'>
                                <?php
                                $nama_kluster = $kluster->kit_shortform;
                                $pelapor_bil = $pelapor->bil;
                                $tarikh = date('Y-m-d'); 
                                $tahun = date('Y');
                                $senarai_laporan = $data_laporan->bulan_ini($nama_kluster, $pelapor_bil, $tahun, $tarikh);
                                if(!empty($senarai_laporan)){
                                    $jumlah_kluster = $jumlah_kluster + count($senarai_laporan);
                                    $jumlahIkutKluster[$kluster->kit_bil] = $jumlahIkutKluster[$kluster->kit_bil] + count($senarai_laporan);
                                    echo count($senarai_laporan);
                                }else{
                                    echo '0';
                                }
                                ?>
                            </td>
                            <?php endforeach; ?>
                            <td valign='middle' class='text-center bg-info text-black'><?php echo $jumlah_kluster; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tfoot>
                            <tr>
                                <th colspan=2 valign='middle' class="text-center">JUMLAH</th>
                                <?php
                                $jumlahBesar = 0;
                            foreach($senarai_kluster as $kluster):  
                                $jumlahBesar = $jumlahBesar + $jumlahIkutKluster[$kluster->kit_bil]; ?>
                                <th valign='middle' class='text-center'><?= $jumlahIkutKluster[$kluster->kit_bil] ?></th>
                            <?php endforeach; ?>
                            <th valign='middle' class='text-center bg-info text-black'><?= $jumlahBesar ?></th>
                            </tr>
                        </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="p-3 border rounded">
            <h2>Bilangan Laporan Tahun <?= date('Y') ?></h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th valign='middle' class='text-center'>#</th>
                            <th valign='middle' class='text-center'>Pelapor</th>
                            <?php
                            $jumlahIkutKluster = array();
                            foreach($senarai_kluster as $kluster): 
                                $jumlahIkutKluster[$kluster->kit_bil] = 0; ?>
                                <th valign='middle' class='text-center'><?= $kluster->kit_nama ?></th>
                            <?php endforeach; ?>
                            <th valign='middle' class='text-center bg-success text-white'>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $bilangan = 1;
                        foreach($senarai_pelapor as $pelapor): ?>
                        <tr>
                        <tr>
                            <td valign='middle' class='text-center'><?= $bilangan++ ?></td>
                            <td valign='middle'><?= $pelapor->nama_penuh; ?></td>
                            <?php 
                            // Hari ini
                            $jumlah_kluster = 0;
                            foreach($senarai_kluster as $kluster): ?>
                            <td valign='middle' class='text-center'>
                                <?php
                                $nama_kluster = $kluster->kit_shortform;
                                $pelapor_bil = $pelapor->bil;
                                $tarikh = date('Y-m-d'); 
                                $tahun = date('Y');
                                $senarai_laporan = $data_laporan->tahun_ini($nama_kluster, $pelapor_bil, $tahun);
                                if(!empty($senarai_laporan)){
                                    $jumlah_kluster = $jumlah_kluster + count($senarai_laporan);
                                    $jumlahIkutKluster[$kluster->kit_bil] = $jumlahIkutKluster[$kluster->kit_bil] + count($senarai_laporan);
                                    echo count($senarai_laporan);
                                }else{
                                    echo '0';
                                }
                                ?>
                            </td>
                            <?php endforeach; ?>
                            <td valign='middle' class='text-center bg-success text-white'><?php echo $jumlah_kluster; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tfoot>
                            <tr>
                                <th colspan=2 valign='middle' class="text-center">JUMLAH</th>
                                <?php
                                $jumlahBesar = 0;
                            foreach($senarai_kluster as $kluster):  
                                $jumlahBesar = $jumlahBesar + $jumlahIkutKluster[$kluster->kit_bil]; ?>
                                <th valign='middle' class='text-center'><?= $jumlahIkutKluster[$kluster->kit_bil] ?></th>
                            <?php endforeach; ?>
                            <th valign='middle' class='text-center bg-success text-white'><?= $jumlahBesar ?></th>
                            </tr>
                        </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
