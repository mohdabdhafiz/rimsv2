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
                <li class="breadcrumb-item"><a href="<?= site_url('lapis/statusPenghantaran') ?>">Status Penghantaran Laporan</a></li>
                <li class="breadcrumb-item active">Tapisan Laporan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


        <section class="section">

            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Maklumat telah diterima. Proses seterusnya akan ditapis oleh BGSPI JaPen.</h1>


    <div class="row g-3 mt-3">
        <div class="col-12">
            <?php echo anchor('lapis/statusPenghantaran/'.$klusterBil, 'Kembali', "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
    </div>


                </div>
            </div>
            


        </section>
    

</main>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>