<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LPK</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('sentimen') ?>">RIMS@LPK</a></li>
                <li class="breadcrumb-item active">SENARAI LAPORAN PERSEPSI TERHADAP KERAJAAN</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <?php if(!empty($senaraiLks)): ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">SENARAI LAPORAN PERSEPSI TERHADAP KERAJAAN</h5>
            <div class="table-responsive">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Nombor Siri</th>
                            <th>Timestamp</th>
                            <th>e-Mel</th>
                            <th>Tarikh Laporan</th>
                            <th>Nama Pelapor</th>
                            <th>Nombor Telefon</th>
                            <th>Negeri</th>
                            <th>Daerah</th>
                            <th>Parlimen</th>
                            <th>DUN</th>
                            <th>Kawasan</th>
                            <th>Pekerjaan</th>
                            <th>Umur</th>
                            <th>Kaum</th>
                            <th>Jantina</th>
                            <th>Sentimen</th>
                            <th>Perkara</th>
                            <th>Ulasan</th>
                            <th>Status</th>
                            <th>Operasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiLks as $lks): ?>
                        <tr>
                            <td><?= $lks->lksBil ?></td>
                            <td><?= $lks->lksTimestamp ?></td>
                            <td><?= $lks->penggunaEmel ?></td>
                            <td><?= $lks->lksTarikhLaporan ?></td>
                            <td><?= $lks->penggunaNama ?></td>
                            <td><?= $lks->penggunaNoTel ?></td>
                            <td><?= $lks->negeriNama ?></td>
                            <td><?= $lks->daerahNama ?></td>
                            <td><?= $lks->parlimenNama ?></td>
                            <td><?= $lks->dunNama ?></td>
                            <td><?= $lks->lksKawasan ?></td>
                            <td><?= $lks->lksPekerjaan ?></td>
                            <td><?= $lks->lksUmur ?></td>
                            <td><?= $lks->lksKaum ?></td>
                            <td><?= $lks->lksJantina ?></td>
                            <td><?= $lks->lksSentimen ?></td>
                            <td><?= $lks->lksPerkara ?></td>
                            <td><?= $lks->lksUlasan ?></td>
                            <td><?= $lks->lksTapisan ?></td>
                            <td>
                                <div class="row g-1">
                                <?php
                                    if($lks->lksTapisan == 'Hantar'){ ?>
                                    <div class="col-auto">
                                        Sila tunggu tapisan dari BGSPI Putrajaya
                                        </div>
                                    <?php }
                                ?>
                                <?php if($lks->lksTapisan == 'Draf'): ?>
                                   
                                        <div class="col-auto">
                                            <a href="<?= site_url('sentimen/kemaskini/'.$lks->lksBil) ?>" class="btn btn-outline-primary shadow-sm">Kemaskini</a>
                                        </div>
                                    
                                <?php endif; ?>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-outline-danger shadow-sm" data-bs-toggle="modal" data-bs-target="#padamModal<?= $lks->lksBil ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                 </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="padamModal<?= $lks->lksBil ?>" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header bg-danger">
                      <h5 class="modal-title text-white">
                        <i class="bi bi-trash"></i>
                        Padam Laporan Khas Sentimen Siri : <?= $lks->lksBil ?>
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Adakah anda pasti untuk memadam maklumat ini?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">Batal</button>
                      <a href="<?= site_url('sentimen/padam/'.$lks->lksBil) ?>" class="btn btn-outline-danger shadow-sm">Padam</a>
                    </div>
                  </div>
                </div>
              </div><!-- End Extra Large Modal-->

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    </section>

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>