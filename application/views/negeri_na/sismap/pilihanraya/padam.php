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
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Pilihan Raya</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        
<?php foreach($pilihanraya2 as $p): ?>
        <div class="card">
            <div class="card-body">
            <div class="row d-flex justify-content-center">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="p-3">
                <p class="text-center card-title">ANDA PASTI UNTUK MEMADAM MAKLUMAT PILIHANRAYA INI?</p>
                <p class="text-muted">Maklumat Pilihan Raya:</p>
                <dl class="row">
                    
                    <dt class="col-sm-3">Nama Pilihan Raya</dt>
                    <dd class="col-sm-9"><?php echo strtoupper($p->pilihanraya_nama); ?></dd>

                    <dt class="col-sm-3">Nama Singkatan Pilihan Raya</dt>
                    <dd class="col-sm-9"><?php echo $p->pilihanraya_singkatan; ?></dd>

                </dl>
                <div class="btn-group">
                <?php echo anchor('pilihanraya/setuju_padam/'.$p->pilihanraya_bil, 'SETUJU', array('class' => 'btn btn-sm btn-danger'));
                echo anchor('pilihanraya/info/'.$p->pilihanraya_bil, 'BATAL', array('class' => 'btn btn-sm btn-outline-primary')); ?>
                </div>
                </div>
            </div>
        </div>
            </div>
        </div>
        <?php endforeach; ?>

    </section>


    </main>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>
