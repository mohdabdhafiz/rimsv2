<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS - KONFIGURASI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">
                    <i class="bi bi-file-earmark-text"></i>
                    Senarai Parlimen
                </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">
        
    <div class="card">
<div class="p-3 border rounded mt-3">
    <h1>Parlimen</h1>
    <div class="row g-3">
        <div class="col">
            <?php echo anchor('parlimen/daftar', 'Daftar Parlimen Baru', "class = 'btn btn-primary mt-2 w-100'"); ?>
        </div>
    </div>
</div>
<div class="row g-3 mt-3">
    <div class="col col-lg-12">
        <div class="p-3 border rounded shadow">
            <h2>Senarai Parlimen Mengikut Negeri</h2>
        <div class="row g-3 mt-3">
            <?php foreach($senaraiNegeri as $negeri): ?>
            <div class="col col-lg-4">
                <table class="table table-bordered">
                    <tr>
                        <th style="width:30%" class="bg-warning">Negeri</th>
                        <td><?php echo $negeri; ?></td>
                    </tr>
                    <tr>
                        <th class="bg-warning">Bilangan Parlimen</th>
                        <td><?php $bilParlimen = count($parlimen->paparIkutNegeri($negeri)); echo $bilParlimen; ?></td>
                    </tr>
                </table>
            </div>
            <?php endforeach; ?>
        </div>
            <?php echo anchor('parlimen/senarai', 'Senarai Keseluruhan Parlimen', "class = 'btn btn-secondary w-100'"); ?>
        </div>
        
    </div>
</div>

    </section>

</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>