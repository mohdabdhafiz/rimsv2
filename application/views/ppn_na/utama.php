<?php 
$this->load->view('ppn_na/susunletak/atas');
$this->load->view('ppn_na/susunletak/sidebar');
$this->load->view('ppn_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="<?= base_url() ?>">Utama</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Senarai Negeri</h1>
                    <?php foreach($senaraiNegeri as $negeri): ?>
                        <p><?= $negeri->nt_nama ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Perancangan Program</h1>
                    <h1 class="display-1" id="perancanganProgram">-</h1>
                    <div class="small text-muted">Bilangan Program</div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <span><em>Senarai Perancangan Program Hari Ini Dan Seterusnya</em></span>
                        <a href="<?= site_url('ppn/perancanganProgram') ?>" class="btn btn-outline-primary shadow-sm">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Pelaksanaan Program</h1>
                    <h1 class="display-1" id="pelaksanaanProgram">-</h1>
                    <div class="small text-muted">Bilangan Program</div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <span><em>Senarai Pelaksanaan Program <?= date("Y") ?> Dalam Negeri</em></span>
                        <a href="<?= site_url('ppn/pelaksanaanProgram') ?>" class="btn btn-outline-primary shadow-sm">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>


    </section>

</main>

<script>
    const perancanganProgram = document.getElementById('perancanganProgram');
    const pelaksanaanProgram = document.getElementById('pelaksanaanProgram');
    async function getPerancanganProgram()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/program/perancanganProgram');
        const data = await response.text();
        perancanganProgram.innerText = data;
    }
    async function getPelaksanaanProgram()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/program/pelaksanaanProgram');
        const data = await response.text();
        pelaksanaanProgram.innerText = data;
    }
    setInterval(() => {
        getPerancanganProgram();
        getPelaksanaanProgram(); 
    }, 1000);
</script>


<?php $this->load->view('ppn_na/susunletak/bawah'); ?>