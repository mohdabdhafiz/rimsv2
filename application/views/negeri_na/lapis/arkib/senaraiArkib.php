<?php
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/navbar');
$this->load->view('negeri_na/susunletak/sidebar');
?>


<main id="main" class="main">


    <div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">RIMS@LAPIS</li>
                <li class="breadcrumb-item active">Senarai Arkib</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


        <section class="section">

            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">
                        <i class="bi bi-archive"></i>
                        Senarai Arkib
                    </h1>
                    <p class="small text-muted">Senarai Arkib ini mengikut tarikh penghantaran laporan (timestamp).</p>
                    <div class="row g-3">
                    <?php 
                    $tahunMula = 2022;
                    $tahunTamat = date('Y');
                    for($i = $tahunTamat; $i > $tahunMula; $i--):
                    ?>
                        <a href="<?= site_url('lapis/arkibYear/'.$i) ?>" class="col-auto">
                            <div class="p-3 border rounded d-flex justify-content-center align-items-center">
                                <h1 class="display-1"><?= $i ?></h1>
                            </div>
                        </a>
                    <?php endfor; ?>
                    </div>
                </div>
            </div>
            


        </section>
    

</main>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>