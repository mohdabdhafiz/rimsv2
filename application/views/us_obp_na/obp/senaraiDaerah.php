<?php 
$this->load->view('us_obp_na/susunletak/atas');
$this->load->view('us_obp_na/susunletak/sidebar');
$this->load->view('us_obp_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@OBP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Senarai Negeri</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Senarai Daerah</h5>
            <div class="table-responsive">
                <table class="table table-hover datatable">
                    <thead>
                        <tr>
                            <th>Nama Daerah</th>
                            <th>Bilangan OBP</th>
                            <th>Operasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Daerah A</td>
                            <td>20</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </section>

</main>


<?php $this->load->view('us_obp_na/susunletak/bawah'); ?>