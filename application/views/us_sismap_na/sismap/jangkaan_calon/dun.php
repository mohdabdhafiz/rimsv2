<?php 
$this->load->view('us_sismap_na/susunletak/atas');
$this->load->view('us_sismap_na/susunletak/sidebar');
$this->load->view('us_sismap_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('winnable_candidate') ?>">Jangkaan Calon</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('winnable_candidate/senarai_negeri') ?>">Senarai Negeri</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('winnable_candidate/negeri/'.$dun->nt_bil) ?>"><?= $dun->dun_negeri ?></a></li>
                <li class="breadcrumb-item active"><?= $dun->dun_nama ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        
        <?php $this->load->view('us_sismap_na/sismap/jangkaan_calon/nav'); ?>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="card-title">Senarai Jangkaan Calon DUN <?= $dun->dun_nama ?> (<?= count($senaraiCalon) ?>)</h1>
                    <a href="<?= site_url('winnable_candidate/kemaskini_dun/'.$dun->dun_bil) ?>" class="btn btn-outline-primary shadow-sm">Kemaskini Maklumat Jangkaan Calon</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>Gambar Calon</th>
                            <?php foreach($senaraiCalon as $calon): ?>
                            <td class="text-center">
                                <img src="<?php echo base_url('assets/img/').$dataFoto->foto($calon->jdt_foto_bil)->foto_nama; ?>" style="object-fit: cover;width: 200px;height: 200px; border-radius: 100%;"/>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <?php foreach($senaraiCalon as $calon): ?>
                            <td class="text-center">
                                <strong><?= $calon->jdt_nama_penuh ?></strong>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Parti</th>
                            <?php foreach($senaraiCalon as $calon): ?>
                            <td class="text-center">
                                <img src="<?php echo base_url('assets/img/').$dataFoto->foto($calon->parti_logo)->foto_nama; ?>" style="object-fit: contain; width: 50px;height: 50px; border-radius: 5%;"/>
                                <br><?= $calon->parti_nama ?> (<?= $calon->parti_singkatan ?>)
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Jawatan / Jawatan Parti</th>
                            <?php foreach($senaraiCalon as $calon): ?>
                            <td class="text-center">
                                <?= $calon->jdt_jawatan_parti ?>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Kategori Umur</th>
                            <?php foreach($senaraiCalon as $calon): ?>
                            <td class="text-center">
                                <?= $calon->jdt_kategori_umur ?>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Jantina</th>
                            <?php foreach($senaraiCalon as $calon): ?>
                            <td class="text-center">
                                <?= $calon->jdt_jantina ?>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Kaum</th>
                            <?php foreach($senaraiCalon as $calon): ?>
                            <td class="text-center">
                                <?= $calon->jdt_kaum ?>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Penyandang / Bukan Penyandang</th>
                            <?php foreach($senaraiCalon as $calon): ?>
                            <td class="text-center">
                                <?= $calon->jdt_status_calon ?>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Kemaskini (Maklumat Calon)</th>
                            <?php foreach($senaraiCalon as $calon):
                                $maklumatPenggunaCalon = $dataPengguna->pengguna($calon->jdt_pengguna_bil);
                                 ?>
                            <td class="text-center">
                            <?php if(!empty($maklumatPenggunaCalon)): ?>
                                <?= $maklumatPenggunaCalon->nama_penuh ?>
                                <br>
                                <?php endif; ?>
                                <?= $calon->jdt_pengguna_waktu ?>
                                
                            </td>
                            <?php 
                                
                            endforeach; ?>
                        </tr>
                        <tr>
                            <th>Kekuatan Calon</th>
                            <?php foreach($senaraiCalon as $calon): 
                                $senaraiKekuatan = $dataKuatLemah->kekuatan_calon($calon->jdt_bil, 'Kekuatan Calon');
                                 ?>
                            <td class="text-start">
                                <ol>
                                    <?php foreach($senaraiKekuatan as $kekuatan):
                                        $maklumatPengguna = $dataPengguna->pengguna($kekuatan->jdtt_pengguna_bil);
                                         ?>
                                    <li>
                                        
                                        <?= $kekuatan->jdtt_deskripsi ?>
                                        <br><em>Kemaskini: <?php if(!empty($maklumatPengguna)): ?>
                                            <?= $maklumatPengguna->nama_penuh ?>
                                            <?php endif; ?>, <?= $kekuatan->jdtt_pengguna_waktu ?></em>
                                    </li>
                                    <?php 
                                    endforeach; ?>
                                </ol>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Kelemahan Calon</th>
                            <?php foreach($senaraiCalon as $calon): 
                                $senaraiKelemahan = $dataKuatLemah->kekuatan_calon($calon->jdt_bil, 'Kelemahan Calon'); ?>
                            <td class="text-start">
                                <ol>
                                    <?php foreach($senaraiKelemahan as $kelemahan):
                                        $maklumatPengguna = $dataPengguna->pengguna($kelemahan->jdtt_pengguna_bil);
                                        
                                        ?>
                                    <li>
                                        <?= $kelemahan->jdtt_deskripsi ?>
                                        <br><em>Kemaskini: <?php if(!empty($maklumatPengguna)): ?>
                                            <?= $maklumatPengguna->nama_penuh ?>
                                            <?php endif; ?>
                                            , <?= $kelemahan->jdtt_pengguna_waktu ?></em>
                                    </li>
                                    <?php 
                                    
                                endforeach; ?>
                                </ol>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Operasi</th>
                            <?php foreach($senaraiCalon as $calon): ?>
                                <td>
                                    <div class="row g-1 d-flex justify-content-center">
                                        <div class="col-auto">
                                            <a href="<?= site_url('winnable_candidate/kemaskiniCalonDun/'.$calon->jdt_bil) ?>" class="btn btn-outline-primary shadow-sm">Kemaskini</a>
                                        </div>
                                    </div>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        

    </section>


    </main>


<?php $this->load->view('us_sismap_na/susunletak/bawah'); ?>
