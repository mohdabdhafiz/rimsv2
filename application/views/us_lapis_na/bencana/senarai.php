<?php 
$this->load->view('us_lapis_na/susunletak/atas');
$this->load->view('us_lapis_na/susunletak/sidebar');
$this->load->view('us_lapis_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@BENCANA</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('bencana') ?>">RIMS@BENCANA</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('bencana/senarai') ?>">Senarai Laporan</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
                <i class="bi bi-list"></i>
                Senarai Laporan
            </h1>
            <div class="table-responsive">
                <table id="tableSenarai" class="table table-sm table-bordered table-hover datatable">
                    <thead>
                        <tr>
                            <th>LAPORAN</th>
                            <th>TARIKH LAPORAN</th>
                            <th>PELAPOR</th>
                            <th>NEGERI</th>
                            <th>DAERAH</th>
                            <th>SITUASI SEMASA</th>
                            <th>BILANGAN PPS</th>
                            <th>JUMLAH MANGSA</th>
                            <th>BILANGAN KEMATIAN</th>
                            <th>BILANGAN HILANG</th>
                            <th>REAKSI RAKYAT TERHADAP PENGURUSAN BANJIR</th>
                            <th>ULASAN REAKSI (NEUTRAL / NEGATIF)</th>
                            <th>LOKASI</th>
                            <th>CADANGAN INTERVENSI</th>
                            <th>RUMUSAN</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiLaporan as $laporan): ?>
                        <tr>
                            <td><a href="<?= site_url('bencana/bil/'.$laporan->bencana_bil) ?>" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-briefcase"></i>
                            </a></td>
                            <td><?= $laporan->bencana_tarikh_laporan ?></td>
                            <td><?= $laporan->nama_penuh ?></td>
                            <td>
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="<?php echo base_url('assets/bendera/').$laporan->nt_nama_fail; ?>" alt="<?= $laporan->nt_nama ?>" class="img-fluid" style="object-fit:cover; max-width:40px; max-height:40px;">
                                    <span class="mx-2"><?= $laporan->nt_nama ?></span>
                                </div>
                            </td>
                            <td><?= $laporan->nama ?></td>
                            <td><?= $laporan->bencana_situasi ?></td>
                            <td><?= $laporan->bencana_pps ?></td>
                            <td><?= $laporan->bencana_mangsa ?></td>
                            <td><?= $laporan->bencana_kematian ?></td>
                            <td><?= $laporan->bencana_hilang ?></td>
                            <td><?= $laporan->bencana_reaksi ?></td>
                            <td><?= $laporan->bencana_ulasan_reaksi ?></td>
                            <td><?= $laporan->bencana_lokasi ?></td>
                            <td><?= $laporan->bencana_intervensi ?></td>
                            <td><?= $laporan->bencana_rumusan ?></td>
                            <td><?= $laporan->bencana_status ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    </section>

</main>


<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>
