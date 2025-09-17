<?php 
$this->load->view($header);
$this->load->view($navbar);
$this->load->view($sidebar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="<?= base_url() ?>">UTAMA</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="rounded shadow-sm mb-3 bg-light p-3">
        <div class="d-flex justify-content-start align-items-center">
            <div class="">
                <strong><?= strtoupper($pengguna->nama_penuh) ?></strong>
                <br><?= strtoupper($pengguna->pekerjaan) ?>
                <?php if(!empty($organisasi)): ?>
                    <br><?= strtoupper($organisasi->jt_pejabat) ?>
                <?php endif; ?>
                <?php if(empty($organisasi)): ?>
                    <br><?= strtoupper($pengguna->pengguna_tempat_tugas) ?>
                <?php endif; ?>
                <?php if(!empty($ppd)): ?>
                    <?php if($pengguna->bil == $ppd->bil): ?>
                        <br><em>Pegawai Penerangan Daerah / Menjalankan tugas sebagai Pegawai Penerangan Daerah</em>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">RIMS@PROGRAM</h5>                
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">BIL</th>
                            <th width="50%">TUGASAN</th>
                            <th class="text-center">BILANGAN LAPORAN</th>
                            <th class="text-center">TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td>Tambah program baharu</td>
                            <td class="text-center">Tidak Berkenaan</td>
                            <td class="text-center"><a href="<?= site_url('program/tambah') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-plus-circle"></i>
                            </a></td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>Melihat senarai laporan program yang telah dimasukkan</td>
                            <td class="text-center"><?= $bilanganLaporanSemua->bilanganLaporan ?></td>
                            <td class="text-center"><a href="<?= site_url('program/senarai') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-inboxes"></i>
                            </a></td>
                        </tr>
                        <?php if(!empty($ppd)): ?>
                            <?php if($ppd->p_anggota == $pengguna->bil): ?>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Mengesahkan maklumat program yang <strong>DIRANCANG</strong> untuk dihantar ke Penolong Pengarah PKPM Negeri.</td>
                                    <td class="text-center"><?= $bilanganLaporanPengesahanPPD->bilanganLaporan ?></td>
                                    <?php $sendStatus = bin2hex($bilanganLaporanPengesahanPPD->statusLaporan); ?>
                                    <td class="text-center"><a href="<?= site_url('program/senaraiIkutStatus/'.$sendStatus) ?>" class="btn btn-outline-primary shadow-sm">
                                        <i class="bi bi-gear-wide-connected"></i>
                                    </a></td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>Mengesahkan maklumat program yang <strong>TELAH DILAKSANAKAN</strong> untuk dihantar ke Penolong Pengarah PKPM Negeri.</td>
                                    <td class="text-center"><?= $bilanganLaporanLaksana->bilanganLaporan ?></td>
                                    <?php $sendStatus = bin2hex($bilanganLaporanLaksana->statusLaporan); ?>
                                    <td class="text-center"><a href="<?= site_url('program/senaraiIkutStatus/'.$sendStatus) ?>" class="btn btn-outline-primary shadow-sm">
                                        <i class="bi bi-gear-wide-connected"></i>
                                    </a></td>
                                </tr>
                            <?php endif; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

                <?php if(!empty($senaraiStatusLaporan)): ?>
                <p><strong>Laporan Mengikut Status</strong></p>
                    <div class="row g-3">
                        <?php
                        foreach($senaraiStatusLaporan as $status): 
                            $sendStatus = bin2hex($status->program_status);
                        ?>
                            <div class="col-12 col-lg-2 col-md-4 col-sm-6">
                                <div class="p-3 d-flex justify-content-center align-items-center">
                                    <div class="d-flex flex-column text-center">
                                        <em><?= $status->program_status ?></em>
                                        <span class="display-1 my-3"><?= $status->kiraanStatus ?></span>
                                        <a href="<?= site_url('program/senaraiIkutStatus/'.$sendStatus) ?>" class="btn btn-outline-primary shadow-sm">Lihat <i class="ms-3 bi bi-arrow-right-square"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                </div>
                <?php endif; ?>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">RIMS@KOMUNITI</h1>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">BIL</th>
                        <th width="50%">TUGASAN</th>
                        <th class="text-center">BILANGAN LAPORAN</th>
                        <th class="text-center">TINDAKAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Melihat senarai Komuniti yang telah didaftarkan</td>
                        <td class="text-center"><?= $bilanganKomuniti->bilangan ?></td>
                        <td class="text-center">
                        <a href="<?= site_url('komuniti/senarai') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-inboxes"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Mendaftar Komuniti baharu</td>
                        <td class="text-center">Tidak Berkenaan</td>
                        <td class="text-center">
                            <a href="<?= site_url('komuniti/daftar') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-node-plus"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td>Laporan Libat Urus Komuniti</td>
                        <td class="text-center"><?= $bilanganLibatUrus->bilanganLaporan ?></td>
                        <td class="text-center">
                            <a href="<?= site_url('komuniti/libatUrus') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-card-list"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">RIMS@KELABMALAYSIAKU</h1>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">BIL</th>
                        <th width="50%">TUGASAN</th>
                        <th class="text-center">BILANGAN LAPORAN</th>
                        <th class="text-center">TINDAKAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Melihat senarai Kelab Malaysiaku yang telah didaftarkan</td>
                        <td class="text-center"><?= $bilanganKelab ?></td>
                        <td class="text-center">
                        <a href="<?= site_url('kelabmalaysiaku/senarai') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-inboxes"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Menubuhkan Kelab Malaysiaku baharu</td>
                        <td class="text-center">Tidak Berkenaan</td>
                        <td class="text-center">
                            <a href="<?= site_url('kelabmalaysiaku/daftar') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-node-plus"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td>Mendaftarkan Ahli Kelab Malaysiaku baharu</td>
                        <td class="text-center"><?= $bilanganAhli ?></td>
                        <td class="text-center">
                        <a href="<?= site_url('kelabmalaysiaku/carian') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-person-plus"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">RIMS@LAPIS
            <span class="text-muted"> : LAPORAN ISU SETEMPAT</span>
            </h1>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">BIL</th>
                        <th width="50%">TUGASAN</th>
                        <th class="text-center">BILANGAN LAPORAN</th>
                        <th class="text-center">TINDAKAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Mengisi borang isu harian</td>
                        <td class="text-center">Tidak Berkenaan</td>
                        <td class="text-center">
                        <a href="<?= site_url('lapis/pilih_kluster') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-node-plus"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Melihat laporan bagi tahun <?= date('Y') ?></td>
                        <td class="text-center"><?= $bilanganLaporanLapis ?></td>
                        <td class="text-center">
                        <a href="<?= site_url('lapis') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-inboxes"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">RIMS@LPK
            <span class="text-muted"> : LAPORAN PERSEPSI TERHADAP KERAJAAN</span>
            </h1>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">BIL</th>
                        <th width="50%">TUGASAN</th>
                        <th class="text-center">BILANGAN LAPORAN</th>
                        <th class="text-center">TINDAKAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Mengisi Laporan Persepsi Terhadap Kerajaan terkini</td>
                        <td class="text-center">Tidak Berkenaan</td>
                        <td class="text-center">
                            <a href="<?= site_url('sentimen/borang') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-node-plus"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Melihat laporan</td>
                        <td class="text-center"><?= $bilanganLaporanLks ?></td>
                        <td class="text-center">
                        <a href="<?= site_url('sentimen/senarai') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-inboxes"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td>Melihat laporan organisasi</td>
                        <td class="text-center"><?= $bilanganPenuhLpk ?></td>
                        <td class="text-center">
                        <a href="<?= site_url('sentimen/mengikutSenaraiAnggota') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-inboxes"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">RIMS@OBP</h1>
                <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">BIL</th>
                        <th width="50%">TUGASAN</th>
                        <th class="text-center">BILANGAN LAPORAN</th>
                        <th class="text-center">TINDAKAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Menambah maklumat OBP</td>
                        <td class="text-center">Tidak Berkenaan</td>
                        <td class="text-center">
                            <a href="<?= site_url('obp/tambah') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-node-plus"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Melihat senarai OBP</td>
                        <td class="text-center"><?= $bilanganObp ?></td>
                        <td class="text-center">
                        <a href="<?= site_url('obp/senarai') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-inboxes"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">RIMS@SISMAP</h1>
            <h2 class="text-primary">PARLIMEN</h2>
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <tr>
                        <th class="text-center">BIL</th>
                        <th width="50%">TUGASAN</th>
                        <th class="text-center">BILANGAN LAPORAN</th>
                        <th class="text-center">TINDAKAN</th>
                    </tr>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Sila pastikan nama daerah mengundi dan bilangan pengundi mengikut data terakhir yang telah diedarkan oleh urus setia.</td>
                        <td class="text-center"><?= $bilanganDmParlimen ?></td>
                        <td class="text-center">
                            <a href="<?= site_url('parlimen/tambah_dm') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Memasukkan data Jangkaan Calon.</td>
                        <td class="text-center"><?= $bilanganJangkaanCalonParlimen ?></td>
                        <td class="text-center">
                            <a href="<?= site_url('winnable_candidate/daftar') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-plus-circle"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td>Mengemaskini maklumat Jangkaan Calon.</td>
                        <td class="text-center"><?= $bilanganJangkaanCalonParlimen ?></td>
                        <td class="text-center">
                            <?php foreach($senarai_tugas_parlimen as $parlimen): ?>
                                <a href="<?= site_url('winnable_candidate/kemaskini_parlimen/'.$parlimen->pt_bil) ?>" class="btn btn-outline-primary shadow-sm m-1"><i class="bi bi-gear-fill"></i> <?= strtoupper($parlimen->pt_nama) ?></a>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">4</td>
                        <td>Membuat rumusan kekuatan dan kelemahan Jangkaan Calon.</td>
                        <td class="text-center"><?= $bilanganJangkaanCalonParlimen ?></td>
                        <td class="text-center">
                            <?php foreach($senarai_tugas_parlimen as $parlimen): ?>
                                <a href="<?= site_url('winnable_candidate/kemaskini_parlimen/'.$parlimen->pt_bil) ?>" class="btn btn-outline-primary shadow-sm m-1"><i class="bi bi-gear-fill"></i> <?= strtoupper($parlimen->pt_nama) ?></a>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">5</td>
                        <td>Mengemaskini maklumat pencalonan pilihan raya.</td>
                        <td class="text-center"><?= $bilanganCalonPru ?></td>
                        <td class="text-center">
                            <a href="<?= site_url('pencalonan/senarai') ?>" class="btn btn-outline-primary shadow-sm m-1"><i class="bi bi-gear-fill"></i> Senarai Calon</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">RIMS@SISMAP</h1>
            <div class="row g-3">
            <?php if(!empty($senarai_tugas_parlimen)): ?>
                <div class="col-12 col-lg-6">
                <p><strong>Parlimen</strong></p>
                <ol>
                    <li class="mb-3">Mengemaskini maklumat pencalonan pilihan raya.<br />
                    <div class="row g-3">
                        <?php foreach($senarai_pru_parlimen as $p_parlimen): 
                        ?>
                            <div class="col-12 col-lg-6">
                                <?php echo anchor('pencalonan/maklumat_pencalonan/'.$p_parlimen->ppt_pilihanraya_bil, 'Senarai Pencalonan '.$p_parlimen->pilihanraya_nama, "class='btn btn-primary w-100 mt-1'"); ?>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </li>
                    <li class="mb-3">Membuat grading mengikut Daerah Mengundi. Culaan SISMAP.<br />
                        <div class="row g-3">
                        <?php 
                        if($konfigurasiGradingLama == 'BUKA'):
                        foreach($senarai_pru_parlimen as $p_parlimen): 
                        $pp2 = $data_pilihanraya->pilihanraya($p_parlimen);
                        ?>
                            <div class="col-12 col-lg-6">
                                <?php echo anchor('grading/pilihanraya/'.$pp2->pilihanraya_bil, 'Kemaskini Maklumat Grading '.$pp2->pilihanraya_nama, "class='btn btn-primary w-100 mt-1'"); ?>
                            </div>
                        <?php endforeach; 
                        endif;
                        ?>

                        <?php foreach($senaraiParlimenPilihanraya as $parlimen): ?>
                            <div class="col-12 col-lg-6">
                                <?= form_open('grading/parlimenPilihanraya') ?>
                                    <input type="hidden" name="inputParlimenBil" value="<?= $parlimen->tpt_parlimen_bil ?>">
                                    <input type="hidden" name="inputPilihanrayaBil" value="<?= $parlimen->ppt_pilihanraya_bil ?>">
                                    <button type="submit" class="btn btn-outline-primary shadow-sm">Kemaskini Grading Parlimen <?= $parlimen->pt_nama ?> untuk <?= $parlimen->pilihanraya_singkatan ?></button>
                                </form>
                            </div>
                        <?php endforeach; ?>

                        </div>
                    </li> 
                </ol>
                </div>
            <?php endif; ?>
            <?php if(!empty($senarai_tugas_dun)): ?>
                <div class="col-12 col-lg-6">
                <p><strong>DUN</strong></p>
                <ol>
                    <li class="mb-3">Sila pastikan nama daerah mengundi dan bilangan pengundi mengikut data terakhir yang telah diedarkan oleh urus setia.<br />
                    <div class="row g-3">
                    <div class="col-12 col-lg-12">
                    <?php echo anchor('dun/tambah_dm', 'Kemaskini Daerah Mengundi DUN', "class='btn btn-secondary w-100 mt-1'"); ?>
                    </div>
                    </div>
                    </li>
                    <li class="mb-3">Memasukkan data jangkaan calon DUN.<br />
                    <div class="row g-3">
                    <div class="col-12 col-lg-12">
                    <?php echo anchor('dun/tambah_jangkaan_calon', 'Tambah Jangkaan Calon DUN', "class='btn btn-secondary w-100 mt-1'"); ?>
                    </div>
                    </div>
                    </li>
                    <li class="mb-3">Mengemaskini maklumat jangkaan calon DUN.<br />
                    <div class="row g-3">
                    <?php foreach($senarai_tugas_dun as $tugas): 
                            $dun_nama = $data_dun->dun_bil($tugas->tdt_dun_bil)->dun_nama; 
                        ?>
                    <div class="col-12 col-lg-6">
                    <?php echo anchor('dun/kemaskini_jangkaan_dun/'.$tugas->tdt_dun_bil, 'Kemaskini Jangkaan Calon DUN '.$dun_nama, "class='btn btn-secondary w-100 mt-1'"); ?>
                    </div>
                    <?php endforeach; ?>
                    </div>
                    </li>
                    <li class="mb-3">Membuat rumusan kekuatan dan kelemahan calon.<br />
                    <div class="row g-3">
                    <?php foreach($senarai_tugas_dun as $tugas): 
                            $dun_nama = $data_dun->dun_bil($tugas->tdt_dun_bil)->dun_nama; 
                        ?>
                    <div class="col-12 col-lg-6">
                    <?php echo anchor('dun/kemaskini_jangkaan_dun/'.$tugas->tdt_dun_bil, 'Kemaskini Jangkaan Calon DUN '.$dun_nama, "class='btn btn-secondary w-100 mt-1'"); ?>
                    </div>
                    <?php endforeach; ?>
                    </div>
                    </li>
                    <li class="mb-3">Mengemaskini maklumat pencalonan pilihan raya.<br />
                    <div class="row g-3">
                        <?php foreach($senarai_pru_dun as $p_dun): 
                        ?>
                            <div class="col-12 col-lg-6">
                                <?php echo anchor('pencalonan/maklumat_pencalonan/'.$p_dun->pdt_pilihanraya_bil, 'Senarai Pencalonan '.$p_dun->pilihanraya_nama, "class='btn btn-secondary w-100 mt-1'"); ?>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </li>
                    <li class="mb-3">Membuat grading mengikut Daerah Mengundi. Culaan SISMAP.<br />
                        <div class="row g-3">
                        <?php 
                        if($konfigurasiGradingLama == 'BUKA'):
                        foreach($senarai_pru_dun as $p_dun): 
                        ?>
                            <div class="col-12 col-lg-6">
                                <?php echo anchor('grading/pilihanraya/'.$p_dun->pdt_pilihanraya_bil, 'Kemaskini Maklumat Grading '.$p_dun->pilihanraya_nama, "class='btn btn-secondary w-100 mt-1'"); ?>
                            </div>
                        <?php endforeach; 
                        endif; ?>

                        <?php foreach($senaraiDunPilihanraya as $dun): ?>
                            <div class="col-12 col-lg-6">
                                <?= form_open('grading/dunPilihanraya') ?>
                                    <input type="hidden" name="inputDunBil" value="<?= $dun->tdt_dun_bil ?>">
                                    <input type="hidden" name="inputPilihanrayaBil" value="<?= $dun->pdt_pilihanraya_bil ?>">
                                    <button type="submit" class="btn btn-outline-secondary shadow-sm">Kemaskini Grading DUN <?= $dun->dun_nama ?> untuk <?= $dun->pilihanraya_singkatan ?></button>
                                </form>
                            </div>
                        <?php endforeach; 
                        ?>

                        </div>
                    </li>
                </ol>
            </div>
            <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">RIMS@BENCANA</h1>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">BIL</th>
                        <th class="text-center">TUGASAN</th>
                        <th class="text-center">BILANGAN LAPORAN</th>
                        <th class="text-center">TINDAKAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td colspan=2>Mengisi borang laporan</td>
                        <td class="text-center">
                            <a href="<?= site_url('bencana/tambah') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-node-plus"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Melihat senarai laporan</td>
                        <td class="text-end"><?= $bilanganLaporanBencana ?></td>
                        <td class="text-center">
                        <a href="<?= site_url('bencana/senarai') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-inboxes"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="alert alert-success">
            Maklumat RIMS@BENCANA akan mula direkodkan pada <strong>28 NOVEMBER 2024 (RABU)</strong>.
            </div>
        </div>
    </div>


    </section>

</main>

<?php $this->load->view($footer); ?>