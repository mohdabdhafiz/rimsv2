<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?= anchor(base_url(), 'RIMS (JaPen Negeri)') ?></li>
    <li class="breadcrumb-item"><?= anchor('lapis', 'RIMS@LAPIS') ?></li>
    <li class="breadcrumb-item active" aria-current="page">Senarai Kluster - Laporan Penuh</li>
  </ol>
</nav>

<?php $this->load->view('negeri/lapis/nav'); ?>

<div class="p-3 border rounded my-3">
    <p>
        <strong>Senarai Kluster</strong><br>
        <span class="small text-muted">Seramai <?= count($senaraiPelapor) ?> orang pelapor.</span>
    </p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover table-striped">
            <tr>
                <th>#</th>
                <th>Nama Kluster</th>
                <th>Bilangan Laporan Hari Ini (<?= date('m.d.Y') ?>)</th>
                <th>Bilangan Laporan Minggu Ini (Ke-<?= date('W') ?>)</th>
                <th>Bilangan Laporan Bulan Ini (<?= date('M') ?>)</th>
                <th>Bilangan Laporan Tahun Ini (<?= date('Y') ?>)</th>
            </tr>
            <?php
            $bilangan = 1;
            $jumlahLaporanKlusterHari = 0;
            $jumlahLaporanKlusterMinggu = 0;
            $jumlahLaporanKlusterBulan = 0;
            $jumlahLaporanKlusterTahun = 0;
            foreach($senarai_kluster as $kluster):
                $nama_kluster = $kluster->kit_shortform;
                $tahun = date("Y");
                $tarikh = date("Y-m-d");
                $bulan = $tarikh;
            ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?= anchor('lapis/kluster/'.$kluster->kit_bil, $kluster->kit_nama) ?></td>
                <td>
                    <?php
                    $jumlahLaporan = 0;
                    foreach($senaraiPelapor as $pelapor){
                        $pelapor_bil = $pelapor['bil'];
                        $senaraiLaporan = $dataKlusterIsu->hari_ini($nama_kluster, $pelapor_bil, $tahun, $tarikh);
                        if(!empty($senaraiLaporan)){
                            $bilanganLaporan = count($senaraiLaporan);
                            $jumlahLaporan = $jumlahLaporan + $bilanganLaporan;
                        }
                    }
                    echo $jumlahLaporan;
                    $jumlahLaporanKlusterHari = $jumlahLaporanKlusterHari + $jumlahLaporan;
                    ?>
                </td>
                <td>
                    <?php
                    $jumlahLaporan = 0;
                    $minggu = date('W');
                    foreach($senaraiPelapor as $pelapor){
                        $pelapor_bil = $pelapor['bil'];
                        $senaraiLaporan = $dataKlusterIsu->minggu_ini($nama_kluster, $pelapor_bil, $tahun, $minggu);
                        if(!empty($senaraiLaporan)){
                            $bilanganLaporan = count($senaraiLaporan);
                            $jumlahLaporan = $jumlahLaporan + $bilanganLaporan;
                        }
                    }
                    echo $jumlahLaporan;
                    $jumlahLaporanKlusterMinggu = $jumlahLaporanKlusterMinggu + $jumlahLaporan;
                    ?>
                </td>
                <td>
                    <?php
                    $jumlahLaporan = 0;
                    foreach($senaraiPelapor as $pelapor){
                        $pelapor_bil = $pelapor['bil'];
                        $senaraiLaporan = $dataKlusterIsu->bulan_ini($nama_kluster, $pelapor_bil, $tahun, $bulan);
                        if(!empty($senaraiLaporan)){
                            $bilanganLaporan = count($senaraiLaporan);
                            $jumlahLaporan = $jumlahLaporan + $bilanganLaporan;
                        }
                    }
                    echo $jumlahLaporan;
                    $jumlahLaporanKlusterBulan = $jumlahLaporanKlusterBulan + $jumlahLaporan;
                    ?>
                </td>
                <td>
                    <?php
                    $jumlahLaporan = 0;
                    foreach($senaraiPelapor as $pelapor){
                        $pelapor_bil = $pelapor['bil'];
                        $senaraiLaporan = $dataKlusterIsu->tahun_ini($nama_kluster, $pelapor_bil, $tahun);
                        if(!empty($senaraiLaporan)){
                            $bilanganLaporan = count($senaraiLaporan);
                            $jumlahLaporan = $jumlahLaporan + $bilanganLaporan;
                        }
                    }
                    echo $jumlahLaporan;
                    $jumlahLaporanKlusterTahun = $jumlahLaporanKlusterTahun + $jumlahLaporan;
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <th></th>
                <th></th>
                <th><?= $jumlahLaporanKlusterHari ?></th>
                <th><?= $jumlahLaporanKlusterMinggu ?></th>
                <th><?= $jumlahLaporanKlusterBulan ?></th>
                <th><?= $jumlahLaporanKlusterTahun ?></th>
            </tr>
        </table>
    </div>
</div>