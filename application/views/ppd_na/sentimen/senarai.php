<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard Laporan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('sentimen') ?>">RIMS@LPK</a></li>
                <li class="breadcrumb-item active">Senarai Laporan Persepsi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Laporan Table -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                             <h5 class="card-title">Senarai Laporan Persepsi Terhadap Kerajaan</h5>
                             <a href="<?= site_url('sentimen/borang') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Tambah Laporan Baru</a>
                        </div>
                       
                        <?php if(!empty($senaraiLks)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>Nombor Siri</th>
                                        <th>Tarikh Laporan</th>
                                        <th>Nama Pelapor</th>
                                        <th>Parlimen</th>
                                        <th>DUN</th>
                                        <th>Pekerjaan</th>
                                        <th>Umur</th>
                                        <th>Kaum</th>
                                        <th>Jantina</th>
                                        <th>Sentimen</th>
                                        <th>Perkara</th>
                                        <th>Ulasan</th>
                                        <th>Isu Positif</th>
                                        <th>Isu Neutral</th>
                                        <th>Isu Negatif</th>
                                        <th>Ulasan Sentimen Isu</th>
                                        <th>Operasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($senaraiLks as $lks): ?>
                                    <tr>
                                        <th scope="row"><a href="#">#<?= $lks->lksBil ?></a></th>
                                        <td><?= date('d M Y', strtotime($lks->lksTarikhLaporan)) ?></td>
                                        <td><?= htmlspecialchars($lks->penggunaNama, ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($lks->parlimenNama, ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($lks->dunNama, ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($lks->lksPekerjaan, ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($lks->lksUmur, ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($lks->lksKaum, ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($lks->lksJantina, ENT_QUOTES, 'UTF-8') ?></td>
                                        <td>
                                            <?php 
                                                $sentimentClass = '';
                                                if ($lks->lksSentimen == 'Positif') {
                                                    $sentimentClass = 'bg-success';
                                                } elseif ($lks->lksSentimen == 'Negatif') {
                                                    $sentimentClass = 'bg-danger';
                                                } elseif ($lks->lksSentimen == 'Neutral') {
                                                    $sentimentClass = 'bg-warning';
                                                }
                                            ?>
                                            <span class="badge <?= $sentimentClass ?>"><?= htmlspecialchars($lks->lksSentimen, ENT_QUOTES, 'UTF-8') ?></span>
                                        </td>
                                        <td class="text-primary"><?= htmlspecialchars($lks->lksPerkara, ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($lks->lksUlasan, ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($lks->lksIsuPositif, ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($lks->lksIsuNeutral, ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($lks->lksIsuNegatif, ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($lks->lksIsuAlasan, ENT_QUOTES, 'UTF-8') ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Operasi">
                                                <a href="<?= site_url('sentimen/papar/'.$lks->lksBil) ?>" class="btn btn-info btn-sm" title="Lihat Laporan Penuh"><i class="bi bi-eye-fill"></i></a>
                                                
                                                <?php if($lks->lksTapisan == 'Draf' || $lks->lksTapisan == 'Terima'): ?>
                                                    <a href="<?= site_url('sentimen/kemaskini/'.$lks->lksBil) ?>" class="btn btn-primary btn-sm" title="Kemaskini Laporan"><i class="bi bi-pencil-square"></i></a>
                                                <?php endif; ?>
                                                
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#padamModal<?= $lks->lksBil ?>" title="Padam Laporan">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal Padam untuk setiap item -->
                                    <div class="modal fade" id="padamModal<?= $lks->lksBil ?>" tabindex="-1" aria-labelledby="padamModalLabel<?= $lks->lksBil ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="padamModalLabel<?= $lks->lksBil ?>"><i class="bi bi-exclamation-triangle-fill text-danger"></i> Sahkan Padam Laporan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Adakah anda pasti untuk memadam laporan siri <strong>#<?= $lks->lksBil ?></strong> oleh <strong><?= htmlspecialchars($lks->penggunaNama, ENT_QUOTES, 'UTF-8') ?></strong>?</p>
                                                    <p class="text-danger">Tindakan ini tidak boleh diundur.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <a href="<?= site_url('sentimen/padam/'.$lks->lksBil) ?>" class="btn btn-danger">Ya, Padam</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                            <div class="alert alert-info mt-3" role="alert">
                                <h4 class="alert-heading">Tiada Laporan!</h4>
                                <p>Belum ada laporan persepsi yang direkodkan. Anda boleh mula dengan menekan butang 'Tambah Laporan Baru'.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div><!-- End Laporan Table -->

        </div>
    </section>

</main>

<?php $this->load->view('ppd_na/susunletak/bawah'); ?>

