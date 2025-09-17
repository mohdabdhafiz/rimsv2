<?php 
$this->load->view('us_program_negeri_na/susunletak/atas');
$this->load->view('us_program_negeri_na/susunletak/sidebar');
$this->load->view('us_program_negeri_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PERSONEL</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('pengguna') ?>">Senarai Pengguna</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">


    <div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
        <h1 class="card-title">Bilangan Anggota Mengikut Senarai Jawatan</h1>
        <a href="<?= site_url('pengguna/tambah') ?>" class="btn btn-outline-primary shadow-sm"><i class="bi bi-person-plus"></i></a>
        </div>
                    <div class="table-responsive">
                        <table id="penggunaJawatan" class="table">
                            <thead>
                                <tr>
                                    <th>Nama Perjawatan</th>
                                    <th>Bilangan Pengguna (Orang)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $jumlah = 0;
                                foreach($senaraiPerjawatan as $jawatan): ?>
                                <tr>
                                    <td><?= $jawatan->pekerjaan ?></td>
                                    <td>
                                        <?php 
                                            echo $jawatan->jumlahAnggota; 
                                            $jumlah = $jumlah + $jawatan->jumlahAnggota;
                                        ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Jumlah</th>
                                    <th><?= $jumlah ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
</div>

<div class="card">
    <div class="card-body">
        <h1 class="card-title">Bilangan Anggota Daerah Mengikut Senarai Jawatan</h1>
                    <div class="table-responsive">
                        <table id="penggunaJawatan" class="table">
                            <thead>
                                <tr>
                                    <th>Nama Perjawatan</th>
                                    <th>Bilangan Pengguna (Orang)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $jumlah = 0;
                                foreach($senaraiPerjawatanDaerah as $jawatan): ?>
                                <tr>
                                    <td><?= $jawatan->pekerjaan ?></td>
                                    <td>
                                        <?php 
                                            echo $jawatan->jumlahAnggota; 
                                            $jumlah = $jumlah + $jawatan->jumlahAnggota;
                                        ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Jumlah</th>
                                    <th><?= $jumlah ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
</div>



    </section>


</main>

<?php $this->load->view('us_program_negeri_na/susunletak/bawah'); ?>


