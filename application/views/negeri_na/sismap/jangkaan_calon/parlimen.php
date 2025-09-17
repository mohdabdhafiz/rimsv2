<?php 
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/sidebar');
$this->load->view('negeri_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('winnable_candidate') ?>">Jangkaan Calon</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('winnable_candidate/negeri/'.$parlimen->nt_bil) ?>"><?= $parlimen->nt_nama ?></a></li>
                <li class="breadcrumb-item active"><?= $parlimen->pt_nama ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        
        <?php $this->load->view('negeri_na/sismap/jangkaan_calon/nav'); ?>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="card-title">Senarai Jangkaan Calon Parlimen <?= $parlimen->pt_nama ?> (<?= count($senaraiCalon) ?>)</h1>
                    <a href="<?= site_url('winnable_candidate/kemaskini_parlimen/'.$parlimen->pt_bil) ?>" class="btn btn-outline-primary shadow-sm">Kemaskini Maklumat Jangkaan Calon</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>Gambar Calon</th>
                            <?php foreach($senaraiCalon as $calon): ?>
                            <td class="text-center">
                                <img src="<?php echo base_url('assets/img/').$dataFoto->foto($calon->wct_foto_bil)->foto_nama; ?>" style="object-fit: cover;width: 200px;height: 200px; border-radius: 100%;"/>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <?php foreach($senaraiCalon as $calon): ?>
                            <td class="text-center">
                                <strong><?= $calon->wct_nama_penuh ?></strong>
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
                                <?= $calon->wct_jawatan_parti ?>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Kategori Umur</th>
                            <?php foreach($senaraiCalon as $calon): ?>
                            <td class="text-center">
                                <?= $calon->wct_kategori_umur ?>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Jantina</th>
                            <?php foreach($senaraiCalon as $calon): ?>
                            <td class="text-center">
                                <?= $calon->wct_jantina ?>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Kaum</th>
                            <?php foreach($senaraiCalon as $calon): ?>
                            <td class="text-center">
                                <?= $calon->wct_kaum ?>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Penyandang / Bukan Penyandang</th>
                            <?php foreach($senaraiCalon as $calon): ?>
                            <td class="text-center">
                                <?= $calon->wct_status_calon ?>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Kemaskini (Maklumat Calon)</th>
                            <?php foreach($senaraiCalon as $calon): ?>
                            <td class="text-center">
                                <?= $calon->nama_penuh ?>
                                <br><?= $calon->wct_pengguna_waktu ?>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Kekuatan Calon</th>
                            <?php foreach($senaraiCalon as $calon): 
                                $senaraiKekuatan = $dataKuatLemah->kekuatan_calon($calon->wct_bil, 'Kekuatan Calon'); ?>
                            <td class="text-start">
                                <ol>
                                    <?php foreach($senaraiKekuatan as $kekuatan): ?>
                                    <li>
                                        <?= $kekuatan->wctm_deskripsi ?>
                                        <br><em>Kemaskini: <?= $kekuatan->nama_penuh ?>, <?= $kekuatan->wctm_pengguna_waktu ?></em>
                                    </li>
                                    <?php endforeach; ?>
                                </ol>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Kelemahan Calon</th>
                            <?php foreach($senaraiCalon as $calon): 
                                $senaraiKelemahan = $dataKuatLemah->kekuatan_calon($calon->wct_bil, 'Kelemahan Calon'); ?>
                            <td class="text-start">
                                <ol>
                                    <?php foreach($senaraiKelemahan as $kelemahan): ?>
                                    <li>
                                        <?= $kelemahan->wctm_deskripsi ?>
                                        <br><em>Kemaskini: <?= $kelemahan->nama_penuh ?>, <?= $kelemahan->wctm_pengguna_waktu ?></em>
                                    </li>
                                    <?php endforeach; ?>
                                </ol>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        

    </section>


    </main>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>
