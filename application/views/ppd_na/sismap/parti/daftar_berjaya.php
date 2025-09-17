<?php

$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/navbar');
$this->load->view('ppd_na/susunletak/sidebar');
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('sismap') ?>">RIMS@SISMAP</a></li>
                <li class="breadcrumb-item active">Parti</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

        <section class="section">

        <?php $this->load->view('ppd_na/sismap/parti/parti_nav'); ?>

        <div class="card">
            <div class="card-body">

            
        <div class="row">
<?php foreach($data_parti as $dp): ?>
    <div class="col-12">
        <p class="card-title">Data berjaya dimasukkan.</p>
        
        <table class="table border">
            <tr>
                <th>Nama Parti</th>
                <td><?php echo $dp->parti_nama; ?></td>
            </tr>
            <tr>
                <th>Singkatan Parti</th>
                <td><?php echo $dp->parti_singkatan; ?></td>
            </tr>
            <tr>
                <th>Dimasukkan Oleh</th>
                <td><?php echo $dp->nama_penuh; ?></td>
            </tr>
            <tr>
                <th>Waktu Muat Naik</th>
                <td><?php echo $dp->parti_waktu; ?></td>
            </tr>
        </table>
        
    </div>
    <?php endforeach; ?>


</div>
</div>
        </div>

        </section>
</main>
</div>
</div>

<?php
$this->load->view('ppd_na/susunletak/bawah');
?>