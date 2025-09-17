<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">RIMS@LAPIS</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

<?php $this->load->view('ppd_na/lapis/nav'); ?>

<div class="card">
    <div class="card-body">
<div class="row g-3 my-1">
    <div class="col-12 col-lg-6">
        <div class="p-3 border rounded text-center">
            <h4 class="text-success">Bilangan Pelapor</h4>
            <h1 class="display-1"><?= $bilangan_pelapor ?></h1>
            <?php echo anchor('pengguna/senarai_pelapor', 'Senarai Pelapor', "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="p-3 border rounded text-center">
            <h4 class="text-success">Bilangan Kluster Isu</h4>
            <h1 class="display-1"><?= $bilangan_kluster_isu ?></h1>
            <?php echo anchor('cpi/senarai_kluster_isu', 'Senarai Kluster Isu', "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
    </div>
</div>
</div>
</div>


<div class="card">
    <div class="card-body">
<div class="row g-3">
    <div class="col-12">
        <div class="">
            <p class="card-title"><strong>Bilangan Laporan Hari Ini (<?= date("d.m.Y") ?>)</strong></p>
            <div class="row g-3 mb-3">
                <?php 
                $jumlah_keseluruhan = 0;
                foreach($senarai_kluster as $kluster): ?>
                <div class="col-12 col-lg-3">
                    <div class="p-3 border rounded text-center">
                        <h3><?= $kluster->kit_nama ?></h3>
                        <?php 
                        $bilangan_laporan = 0;
                        $bilangan_laporan_terima = 0;
                        $senarai_pelapor = $data_pengguna->senarai_penuh_pelapor();
                        foreach($senarai_pelapor as $pelapor){
                            $senarai_laporan = $data_isu->hari_ini($kluster->kit_shortform, $pelapor->bil, date('Y'), date('Y-m-d'));
                            if(!empty($senarai_laporan)){
                                $bilangan_laporan = $bilangan_laporan + count($senarai_laporan);
                            }
                        }
                        ?>
                        <h1 class="display-1">
                            <?= $bilangan_laporan ?>
                            <?php $jumlah_keseluruhan = $jumlah_keseluruhan + $bilangan_laporan; ?>
                        </h1>
                        <?php echo anchor('lapis/laporan_hari_ini/'.$kluster->kit_bil, 'Laporan '.$kluster->kit_nama, "class='btn btn-sm btn-outline-success w-100'"); ?>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="col-12 col-lg-3">
                    <div class="p-3 border rounded text-center h-100 bg-light">
                        <h3>Jumlah Keseluruhan</h3>
                        <h1 class="display-1 text-success">
                            <?= $jumlah_keseluruhan ?>
                        </h1>
                    </div>
                </div>
            </div>

            <?php
            $namaNegeri = array();
            foreach($senarai_negeri as $negeri){
                $namaNegeri[] = $negeri->nt_nama;
            }
            array_multisort($namaNegeri, SORT_ASC, $senarai_negeri);
            ?>

            <p>
                <span class="card-title"><strong>Bilangan Laporan Mengikut Negeri (<?= date('d.m.Y') ?>)</strong></span> <br>
                <span class="small text-muted">Jumlah penghantaran laporan tanpa mengikut status.</span>
            </p>

            <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th valign="middle" class="text-center"></th>
                            <th valign="middle">Negeri</th>
                            <?php foreach($senarai_kluster as $kluster): ?>
                            <th valign="middle" class="text-center"><?= $kluster->kit_nama ?></th>
                            <?php endforeach; ?>
                            <th valign='middle' class='text-center'>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $bilangan = 1; 
                        foreach($senarai_negeri as $negeri): 
                            $jumlah_laporan_negeri = 0;
                            ?>
                        <tr>
                            <td valign="middle" class="text-center"><?= $bilangan++ ?></td>
                            <td valign="middle"><?= $negeri->nt_nama; ?></td>
                            <?php 
                            $senarai_pelapor_negeri = $data_pengguna->pelapor_negeri($negeri->nt_nama);
                            foreach($senarai_kluster as $kluster): 
                                $jumlah_kluster = 0;
                                foreach($senarai_pelapor_negeri as $pelapor){
                                    $bil_laporan = $data_isu->hari_ini($kluster->kit_shortform, $pelapor->bil, date("Y"), date('Y-m-d'));
                                    if(!empty($bil_laporan)){
                                        $jumlah_kluster = $jumlah_kluster + count($bil_laporan);
                                    }
                                }
                                ?>
                                <td valign="middle" class="text-center"><?= $jumlah_kluster ?>
                                
                                </td>
                            <?php 
                            $jumlah_laporan_negeri = $jumlah_laporan_negeri + $jumlah_kluster;
                            endforeach; ?>
                            <td valign='middle' class='text-center'>
                                <?= $jumlah_laporan_negeri ?>
                                
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>
    </div>

    </section>

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>