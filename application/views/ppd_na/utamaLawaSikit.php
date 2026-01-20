<?php 
$this->load->view($header);
$this->load->view($navbar);
$this->load->view($sidebar);
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard Utama RIMS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">
                <div class="row">

                    <div class="col-12">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Selamat Datang</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= strtoupper($pengguna->nama_penuh) ?></h6>
                                        <span class="text-muted small pt-2">
                                            <?= strtoupper($pengguna->pekerjaan) ?>
                                            <?php if(!empty($organisasi)): ?>
                                                | <?= strtoupper($organisasi->jt_pejabat) ?>
                                            <?php else: ?>
                                                | <?= strtoupper($pengguna->pengguna_tempat_tugas) ?>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($senaraiStatusLaporan)): ?>
                        <?php foreach($senaraiStatusLaporan as $status): 
                            $sendStatus = bin2hex($status->program_status);
                        ?>
                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Laporan <span>| <?= $status->program_status ?></span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-journal-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $status->kiraanStatus ?></h6>
                                            <a href="<?= site_url('program/senaraiIkutStatus/'.$sendStatus) ?>" class="text-muted small pt-2">Lihat Laporan <i class="bi bi-arrow-right-circle"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#program-tab">RIMS@PROGRAM</button>
                            </li>
                             <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#sismap-tab">RIMS@SISMAP</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#komuniti-tab">RIMS@KOMUNITI</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#kelab-tab">RIMS@KELABMALAYSIAKU</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#lapis-tab">RIMS@LAPIS</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#lpk-tab">RIMS@LPK</button>
                            </li>
                             <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#obp-tab">RIMS@OBP</button>
                            </li>
                             <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#bencana-tab">RIMS@BENCANA</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-3">
                            
                            <div class="tab-pane fade show active" id="program-tab">
                                <h5 class="card-title">Tugasan Modul Program</h5>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">BIL</th>
                                            <th>TUGASAN</th>
                                            <th class="text-center" style="width: 15%;">BILANGAN</th>
                                            <th class="text-center" style="width: 15%;">TINDAKAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Tambah program baharu</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center"><a href="<?= site_url('program/tambah') ?>" class="btn btn-success btn-sm"><i class="bi bi-plus-circle me-1"></i> Tambah</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Melihat senarai laporan program yang telah dimasukkan</td>
                                            <td class="text-center"><span class="badge bg-primary rounded-pill"><?= $bilanganLaporanSemua->bilanganLaporan ?></span></td>
                                            <td class="text-center"><a href="<?= site_url('program/senarai') ?>" class="btn btn-primary btn-sm"><i class="bi bi-list-ul me-1"></i> Senarai</a></td>
                                        </tr>
                                        <?php if(!empty($ppd) && $ppd->p_anggota == $pengguna->bil): ?>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Mengesahkan program <strong>DIRANCANG</strong></td>
                                            <td class="text-center"><span class="badge bg-warning rounded-pill"><?= $bilanganLaporanPengesahanPPD->bilanganLaporan ?></span></td>
                                            <td class="text-center"><a href="<?= site_url('program/senaraiIkutStatus/'.bin2hex($bilanganLaporanPengesahanPPD->statusLaporan)) ?>" class="btn btn-warning btn-sm"><i class="bi bi-check2-square me-1"></i> Sahkan</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td>Mengesahkan program <strong>TELAH DILAKSANAKAN</strong></td>
                                            <td class="text-center"><span class="badge bg-warning rounded-pill"><?= $bilanganLaporanLaksana->bilanganLaporan ?></span></td>
                                            <td class="text-center"><a href="<?= site_url('program/senaraiIkutStatus/'.bin2hex($bilanganLaporanLaksana->statusLaporan)) ?>" class="btn btn-warning btn-sm"><i class="bi bi-check2-square me-1"></i> Sahkan</a></td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="sismap-tab">
                                <h5 class="card-title">Tugasan Modul Sistem Maklumat Pilihan Raya (SISMAP)</h5>
                                <div class="accordion" id="accordionSismap">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingParlimen">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseParlimen" aria-expanded="true" aria-controls="collapseParlimen">
                                                Tugasan Parlimen
                                            </button>
                                        </h2>
                                        <div id="collapseParlimen" class="accordion-collapse collapse show" aria-labelledby="headingParlimen" data-bs-parent="#accordionSismap">
                                            <div class="accordion-body">
                                                <ol>
                                                    <li class="mb-3">Sila pastikan nama daerah mengundi dan bilangan pengundi. <br>
                                                        <a href="<?= site_url('parlimen/tambah_dm') ?>" class="btn btn-outline-primary btn-sm mt-2"><i class="bi bi-gear-fill me-1"></i> Kemaskini Data</a>
                                                    </li>
                                                    <li class="mb-3">Memasukkan data Jangkaan Calon. <br>
                                                        <a href="<?= site_url('winnable_candidate/daftar') ?>" class="btn btn-outline-primary btn-sm mt-2"><i class="bi bi-plus-circle me-1"></i> Tambah Jangkaan</a>
                                                    </li>
                                                    <li class="mb-3">Mengemaskini maklumat & rumusan Jangkaan Calon. <br>
                                                        <?php foreach($senarai_tugas_parlimen as $parlimen): ?>
                                                            <a href="<?= site_url('winnable_candidate/kemaskini_parlimen/'.$parlimen->pt_bil) ?>" class="btn btn-outline-primary btn-sm mt-2"><i class="bi bi-pencil-square me-1"></i> <?= strtoupper($parlimen->pt_nama) ?></a>
                                                        <?php endforeach; ?>
                                                    </li>
                                                    <li class="mb-3">Mengemaskini maklumat pencalonan pilihan raya. <br>
                                                        <a href="<?= site_url('pencalonan/senarai') ?>" class="btn btn-outline-primary btn-sm mt-2"><i class="bi bi-card-list me-1"></i> Senarai Calon</a>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(!empty($senarai_tugas_dun)): ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingDun">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDun" aria-expanded="false" aria-controls="collapseDun">
                                                Tugasan DUN
                                            </button>
                                        </h2>
                                        <div id="collapseDun" class="accordion-collapse collapse" aria-labelledby="headingDun" data-bs-parent="#accordionSismap">
                                            <div class="accordion-body">
                                                <ol>
                                                     <li class="mb-3">Pastikan nama daerah mengundi & bilangan pengundi. <br>
                                                        <?php echo anchor('dun/tambah_dm', '<i class="bi bi-gear-fill me-1"></i> Kemaskini Daerah Mengundi DUN', "class='btn btn-outline-secondary btn-sm mt-2'"); ?>
                                                     </li>
                                                     <li class="mb-3">Memasukkan data jangkaan calon DUN. <br>
                                                         <?php echo anchor('dun/tambah_jangkaan_calon', '<i class="bi bi-plus-circle me-1"></i> Tambah Jangkaan Calon DUN', "class='btn btn-outline-secondary btn-sm mt-2'"); ?>
                                                     </li>
                                                     <li class="mb-3">Mengemaskini maklumat & rumusan calon DUN. <br>
                                                         <?php foreach($senarai_tugas_dun as $tugas): 
                                                             $dun_nama = $data_dun->dun_bil($tugas->tdt_dun_bil)->dun_nama; 
                                                         ?>
                                                             <?php echo anchor('dun/kemaskini_jangkaan_dun/'.$tugas->tdt_dun_bil, '<i class="bi bi-pencil-square me-1"></i> Kemaskini Jangkaan Calon DUN '.$dun_nama, "class='btn btn-outline-secondary btn-sm mt-2 me-1'"); ?>
                                                         <?php endforeach; ?>
                                                     </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                             <div class="tab-pane fade" id="komuniti-tab">
                               <h5 class="card-title">Tugasan Modul Komuniti</h5>
                                <table class="table table-hover">
                                     <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">BIL</th>
                                            <th>TUGASAN</th>
                                            <th class="text-center" style="width: 15%;">BILANGAN</th>
                                            <th class="text-center" style="width: 20%;">TINDAKAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Mendaftar Komuniti baharu</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center"><a href="<?= site_url('komuniti/daftar') ?>" class="btn btn-success btn-sm"><i class="bi bi-plus-circle me-1"></i> Daftar Komuniti</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Melihat senarai Komuniti yang telah didaftarkan</td>
                                            <td class="text-center"><span class="badge bg-primary rounded-pill"><?= $bilanganKomuniti->bilangan ?></span></td>
                                            <td class="text-center"><a href="<?= site_url('komuniti/senarai') ?>" class="btn btn-primary btn-sm"><i class="bi bi-list-ul me-1"></i> Senarai Komuniti</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Laporan Libat Urus Komuniti</td>
                                            <td class="text-center"><span class="badge bg-info rounded-pill"><?= $bilanganLibatUrus->bilanganLaporan ?></span></td>
                                            <td class="text-center"><a href="<?= site_url('komuniti/libatUrus') ?>" class="btn btn-info text-white btn-sm"><i class="bi bi-card-list me-1"></i> Laporan Libat Urus</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="kelab-tab">
                                <h5 class="card-title">Tugasan Modul Kelab Malaysiaku</h5>
                                <table class="table table-hover">
                                     <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">BIL</th>
                                            <th>TUGASAN</th>
                                            <th class="text-center" style="width: 15%;">BILANGAN</th>
                                            <th class="text-center" style="width: 20%;">TINDAKAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Menubuhkan Kelab Malaysiaku baharu</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center"><a href="<?= site_url('kelabmalaysiaku/daftar') ?>" class="btn btn-success btn-sm"><i class="bi bi-plus-circle me-1"></i> Tubuhkan Kelab</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Melihat senarai Kelab Malaysiaku</td>
                                            <td class="text-center"><span class="badge bg-primary rounded-pill"><?= $bilanganKelab ?></span></td>
                                            <td class="text-center"><a href="<?= site_url('kelabmalaysiaku/senarai') ?>" class="btn btn-primary btn-sm"><i class="bi bi-list-ul me-1"></i> Senarai Kelab</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Mendaftarkan Ahli Kelab Malaysiaku baharu</td>
                                            <td class="text-center"><span class="badge bg-info rounded-pill"><?= $bilanganAhli ?></span></td>
                                            <td class="text-center"><a href="<?= site_url('kelabmalaysiaku/carian') ?>" class="btn btn-info text-white btn-sm"><i class="bi bi-person-plus me-1"></i> Daftar Ahli</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="lapis-tab">
                               <h5 class="card-title">Tugasan Modul Laporan Isu Setempat (LAPIS)</h5>
                                <table class="table table-hover">
                                     <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">BIL</th>
                                            <th>TUGASAN</th>
                                            <th class="text-center" style="width: 15%;">BILANGAN</th>
                                            <th class="text-center" style="width: 20%;">TINDAKAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Mengisi borang isu harian</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center"><a href="<?= site_url('lapis/pilih_kluster') ?>" class="btn btn-success btn-sm"><i class="bi bi-plus-circle me-1"></i> Lapor Isu</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Melihat laporan bagi tahun <?= date('Y') ?></td>
                                            <td class="text-center"><span class="badge bg-primary rounded-pill"><?= $bilanganLaporanLapis ?></span></td>
                                            <td class="text-center"><a href="<?= site_url('lapis') ?>" class="btn btn-primary btn-sm"><i class="bi bi-list-ul me-1"></i> Lihat Laporan</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="lpk-tab">
                                <h5 class="card-title">Tugasan Modul Laporan Persepsi Terhadap Kerajaan (LPK)</h5>
                                <table class="table table-hover">
                                     <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">BIL</th>
                                            <th>TUGASAN</th>
                                            <th class="text-center" style="width: 15%;">BILANGAN</th>
                                            <th class="text-center" style="width: 20%;">TINDAKAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Mengisi Laporan Persepsi Terhadap Kerajaan terkini</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center"><a href="<?= site_url('sentimen/borang') ?>" class="btn btn-success btn-sm"><i class="bi bi-plus-circle me-1"></i> Isi Laporan</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Melihat laporan peribadi</td>
                                            <td class="text-center"><span class="badge bg-primary rounded-pill"><?= $bilanganLaporanLks ?></span></td>
                                            <td class="text-center"><a href="<?= site_url('sentimen/senarai') ?>" class="btn btn-primary btn-sm"><i class="bi bi-file-person me-1"></i> Laporan Saya</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Melihat laporan organisasi</td>
                                            <td class="text-center"><span class="badge bg-info rounded-pill"><?= $bilanganPenuhLpk ?></span></td>
                                            <td class="text-center"><a href="<?= site_url('sentimen/mengikutSenaraiAnggota') ?>" class="btn btn-info text-white btn-sm"><i class="bi bi-building me-1"></i> Laporan Organisasi</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                             <div class="tab-pane fade" id="obp-tab">
                               <h5 class="card-title">Tugasan Modul Orang Berpengaruh (OBP)</h5>
                               <table class="table table-hover">
                                    <thead>
                                       <tr>
                                           <th class="text-center" style="width: 5%;">BIL</th>
                                           <th>TUGASAN</th>
                                           <th class="text-center" style="width: 15%;">BILANGAN</th>
                                           <th class="text-center" style="width: 20%;">TINDAKAN</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <tr>
                                           <td class="text-center">1</td>
                                           <td>Menambah maklumat OBP</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center"><a href="<?= site_url('obp/tambah') ?>" class="btn btn-success btn-sm"><i class="bi bi-plus-circle me-1"></i> Tambah OBP</a></td>
                                       </tr>
                                       <tr>
                                           <td class="text-center">2</td>
                                           <td>Melihat senarai OBP</td>
                                           <td class="text-center"><span class="badge bg-primary rounded-pill"><?= $bilanganObp ?></span></td>
                                           <td class="text-center"><a href="<?= site_url('obp/senarai') ?>" class="btn btn-primary btn-sm"><i class="bi bi-list-ul me-1"></i> Senarai OBP</a></td>
                                       </tr>
                                   </tbody>
                               </table>
                            </div>
                             <div class="tab-pane fade" id="bencana-tab">
                                <h5 class="card-title">Tugasan Modul Bencana</h5>
                                <div class="alert alert-info d-flex align-items-center" role="alert">
                                  <i class="bi bi-info-circle-fill flex-shrink-0 me-2"></i>
                                  <div>
                                    Maklumat RIMS@BENCANA akan mula direkodkan pada <strong>28 NOVEMBER 2024 (RABU)</strong>.
                                  </div>
                                </div>
                                <table class="table table-hover">
                                     <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">BIL</th>
                                            <th>TUGASAN</th>
                                            <th class="text-center" style="width: 15%;">BILANGAN</th>
                                            <th class="text-center" style="width: 20%;">TINDAKAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Mengisi borang laporan</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center"><a href="<?= site_url('bencana/tambah') ?>" class="btn btn-success btn-sm"><i class="bi bi-plus-circle me-1"></i> Lapor Bencana</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Melihat senarai laporan</td>
                                            <td class="text-center"><span class="badge bg-primary rounded-pill"><?= $bilanganLaporanBencana ?></span></td>
                                            <td class="text-center"><a href="<?= site_url('bencana/senarai') ?>" class="btn btn-primary btn-sm"><i class="bi bi-list-ul me-1"></i> Senarai Laporan</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            </div></div>
                </div>
            </div> </div>
    </section>

</main><?php $this->load->view($footer); ?>