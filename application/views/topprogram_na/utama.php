<?php 
$this->load->view('topprogram_na/susunletak/atas');
$this->load->view('topprogram_na/susunletak/sidebar');
$this->load->view('topprogram_na/susunletak/navbar');
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
        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
            <div class="card">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <h1 class="card-title">Perancangan Program</h1>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <form action="">
                        
                    </form>
                </div>
            </div>
            <div id="perancanganProgram"></div>
        </div>
    </div>
        </div>
        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
            <div class="card">
        <div class="card-body">
            <h1 class="card-title">Pelaksanaan Program</h1>
            <div id="pelaksanaanProgram"></div>
        </div>
    </div>
        </div>
    </div>


    </section>

    <script>
        const perancanganProgram = document.getElementById('perancanganProgram');
        const pelaksanaanProgram = document.getElementById('pelaksanaanProgram');
        async function getPerancanganProgram()
        {
            const response = await fetch('<?php echo base_url(); ?>index.php/program/senaraiPerancanganProgram');
            const data = await response.text();
            perancanganProgram.innerHTML = data;
        }
        async function getPelaksanaanProgram()
        {
            const response = await fetch('<?php echo base_url(); ?>index.php/program/senaraiPelaksanaanProgram');
            const data = await response.text();
            pelaksanaanProgram.innerHTML = data;
        }
        setInterval(() => {
            getPerancanganProgram();
            getPelaksanaanProgram(); 
        }, 1000);
    </script>
</main>


<?php $this->load->view('topprogram_na/susunletak/bawah'); ?>