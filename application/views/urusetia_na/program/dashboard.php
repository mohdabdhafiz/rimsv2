<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    
    <?php $this->load->view('urusetia_na/carian'); ?>
    

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Senarai Program Tahun <?= date('Y') ?></h5>
                <div class="btn-group" role="group" aria-label="Operasi Senarai Laporan">
                    <a href="<?= site_url('program/muatTurun') ?>" class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Muat Turun Senarai Program">
                        <i class="bi bi-save2"></i>
                    </a>
                    <a href="<?= site_url('program/tambah') ?>" class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tambah Program">
                        <i class="bi bi-calendar2-plus"></i>
                    </a>
                </div>
            </div>
            <!-- Borang Carian -->
            <form id="searchForm" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari program..." value="<?= html_escape($search) ?>">
                <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
            </form>

            <!-- Tempat Untuk Papar Senarai Program Secara AJAX -->
            <div id="programList">
            <?php $this->load->view('urusetia_na/program/ajax_list'); ?>
            </div>

            <!-- AJAX Script -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
            $(document).ready(function(){

                // Carian
                $('#searchForm').on('submit', function(e){
                    e.preventDefault();
                    loadData(0);
                });

                // Pagination Klik
                $(document).on('click', '.pagination a', function(e){
                    e.preventDefault();
                    let page = $(this).attr('href').split('page=')[1];
                    loadData(page);
                });

                function loadData(page){
                    let search = $('input[name="search"]').val();
                    $.ajax({
                        url: "<?= base_url('program') ?>",
                        type: "GET",
                        data: { search: search, page: page },
                        success: function(response){
                            $('#programList').html(response);
                        }
                    });
                }

            });
            </script>

        </div>
    </div>

    </section>

</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>
