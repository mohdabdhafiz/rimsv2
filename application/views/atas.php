<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SISTEM LESTARI PENGUNDI (SLP)</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Attendance Agent System" name="keywords">
    <meta content="Attendance Agent System" name="description">

    <!-- Favicon -->
    <link href="<?php echo base_url(); ?>assets/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    
    <link href="<?php echo base_url(); ?>assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

    <!-- CHARTJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3/dist/chart.min.js"></script>
</head>

<body>
    <?php 
    $pengguna = $this->session->userdata('pengguna_bil');
    if(!empty($pengguna)){
    ?>
    <!-- Navbar Start -->
    <div class="container-fluid sticky-top bg-dark bg-light-radial shadow-sm px-5 pe-lg-0">
        <nav class="navbar navbar-expand-lg bg-dark bg-light-radial navbar-dark py-3 py-lg-0">
            <a href="<?php echo base_url(); ?>" class="navbar-brand">
                <h1 class="m-0 display-4 text-uppercase text-white"><i class="bi text-primary me-2"></i>SLP</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <?php echo anchor('pengundi/putih', 'PENGUNDI PUTIH', "class='nav-item nav-link'"); ?>
                    <a href="<?php echo base_url(); ?>" class="nav-item nav-link">Parlimen</a>
                    <a href="<?php echo base_url(); ?>" class="nav-item nav-link">DUN</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Ahli</a>
                        <div class="dropdown-menu m-0">
                            <a href="<?php echo base_url(); ?>" class="dropdown-item">Pusat</a>
                            <a href="<?php echo base_url(); ?>" class="dropdown-item">Bahagian</a>
                            <a href="<?php echo base_url(); ?>" class="dropdown-item">Cawangan</a>
                            <a href="<?php echo base_url(); ?>" class="dropdown-item">Parlimen</a>
                            <a href="<?php echo base_url(); ?>" class="dropdown-item">DUN</a>
                        </div>
                    </div>
                    <?php echo anchor('pengguna/log_keluar', 'LOG KELUAR <i class="bi bi-arrow-right"></i>', "class='nav-item nav-link bg-primary text-white px-5 ms-3  d-lg-block'"); ?>
                </div>
            </div>
        </nav>
    </div>
    <?php } ?>
    <!-- Navbar End -->