<?php 
$this->load->view('us_program_negeri_na/susunletak/atas');
$this->load->view('us_program_negeri_na/susunletak/sidebar');
$this->load->view('us_program_negeri_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>BAHAGIAN / CAWANGAN PERKHIDMATAN KOMUNIKASI DAN PEMBANGUNAN MASYARAKAT</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card rounded">
                <div href="<?= site_url('program') ?>" class="card-body">
                    <h1 class="card-title">Negeri</h1>
                    <div class="row g-3">
                        <?php foreach($senaraiNegeri as $negeri): ?>
                            <?php if(count($senaraiNegeri) <= 1): ?>
                        <div class="col-12">
                            <?php endif; ?>
                            <?php if(count($senaraiNegeri) > 1): ?>
                        <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                            <?php endif; ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <h1 class="display-4"><?= $negeri->nt_nama ?></h1>
                                <img src="<?php echo base_url('assets/bendera/').$negeri->nt_nama_fail; ?>" alt="<?= $negeri->nt_nama ?>" class="img-fluid" style="object-fit:cover; width:200px; height:100px;">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

    <div class="row g-3">
        <div class="col-12 col-lg-3 col-md-6 col-sm-12">
            <div class="card rounded">
                <a href="<?= site_url('program') ?>" class="card-body">
                    <h1 class="card-title">RIMS@PROGRAM</h1>
                    <div class="text-center">
                        <h2 class="display-5" id="bilanganProgram">0</h2>
                        <p class="small text-muted">Bilangan Program Tahun <?= date('Y') ?></p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-lg-3 col-md-6 col-sm-12">
            <div class="card rounded">
                <a href="<?= site_url('komuniti') ?>" class="card-body">
                    <h1 class="card-title">RIMS@KOMUNITI</h1>
                    <div class="text-center">
                        <h2 class="display-5" id="bilanganKomuniti">0</h2>
                        <p class="small text-muted">Bilangan Komuniti</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-lg-3 col-md-6 col-sm-12">
            <div class="card rounded">
                <a href="<?= site_url('obp') ?>" class="card-body">
                    <h1 class="card-title">RIMS@OBP</h1>
                    <div class="text-center">
                        <h2 class="display-5" id="bilanganObp">0</h2>
                        <p class="small text-muted">Bilangan OBP</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-lg-3 col-md-6 col-sm-12">
            <div class="card rounded">
                <a href="<?= site_url('pengguna') ?>" class="card-body">
                    <h1 class="card-title">RIMS@PERSONEL</h1>
                    <div class="text-center">
                        <h2 class="display-5" id="bilanganPengguna">0</h2>
                        <p class="small text-muted">Bilangan Pengguna</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    </section>

</main>

<script>
    const bilanganProgram = document.getElementById('bilanganProgram');
    const bilanganKomuniti = document.getElementById('bilanganKomuniti');
    const bilanganObp = document.getElementById('bilanganObp');
    const bilanganPengguna = document.getElementById('bilanganPengguna');
    async function getBilanganProgram()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/program/bilangan');
        const data = await response.text();
        bilanganProgram.innerText = data;
    }
    async function getBilanganKomuniti()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/komuniti/bilangan');
        const data = await response.text();
        bilanganKomuniti.innerText = data;
    }
    async function getBilanganObp()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/obp/bilangan');
        const data = await response.text();
        bilanganObp.innerText = data;
    }
    async function getBilanganPengguna()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/pengguna/bilangan');
        const data = await response.text();
        bilanganPengguna.innerText = data;
    }
    setInterval(() => {
        getBilanganProgram();
        getBilanganKomuniti();   
        getBilanganObp();
        getBilanganPengguna();
    }, 1000);
</script>


<?php $this->load->view('us_program_negeri_na/susunletak/bawah'); ?>