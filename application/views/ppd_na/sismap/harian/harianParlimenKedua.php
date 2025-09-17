<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('harian') ?>">Harian</a></li>
                <li class="breadcrumb-item active">Utama</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Grading <?= $parlimen->pt_nama ?> untuk <?= $pilihanraya->pilihanraya_singkatan ?></h5>
                <?= form_open('grading/binaParlimen') ?>
                <input type="hidden" name="inputPilihanrayaBil" value="<?= $pilihanraya->pilihanraya_bil ?>">
                <input type="hidden" name="inputParlimenBil" value="<?= $parlimen->pt_bil ?>">
                <button type="submit" class="btn btn-outline-primary shadow-sm">Tambah / Kemaskini</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless table-hover datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tarikh</th>
                            <th>Status</th>
                            <th>Calon / Parti Pilihan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $jumlah = 1;
                        foreach($senaraiHarian as $h): ?>
                        <tr>
                            <td><?= $jumlah++ ?></td>
                            <td><?= $h->harian_parlimen_tarikh ?></td>
                            <td>
                                <?php echo $h->harian_parlimen_grading; ?>
                            </td>
                            <td><?= $h->parti_nama ?> (<?= $h->parti_singkatan ?>)</td>
                            <td>
                                <a href="<?= site_url('grading/harianParlimen/'.$h->harian_parlimen_bil) ?>" class="btn btn-outline-primary shadow-sm">Lihat</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    


    </section>

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>