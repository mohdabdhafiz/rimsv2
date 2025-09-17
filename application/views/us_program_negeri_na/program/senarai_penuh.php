<?php 
$this->load->view('us_program_negeri_na/susunletak/atas');
$this->load->view('us_program_negeri_na/susunletak/sidebar');
$this->load->view('us_program_negeri_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Senarai Pelaporan Program</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">   
            <h5 class="card-title">Senarai Pelaporan Program</h5>
            <?= anchor('program/tambah', 'Tambah', "class='btn btn-primary shadow-sm'") ?>
        </div>
    <div id="tableSenaraiProgram"></div>
    </div>
</div>




</section>


</main>

<script>
    const senaraiProgram = document.getElementById('tableSenaraiProgram');
    async function getSenaraiProgram()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/program/getSenaraiProgram');
        const data = await response.text();
        senaraiProgram.innerHTML = data;
        document.getElementById('tSenarai').classList.add('datatable');    
    }
    getSenaraiProgram();
</script>


<?php $this->load->view('us_program_negeri_na/susunletak/bawah'); ?>