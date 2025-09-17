<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIMS - Reporting and Issues Management Systems</title>
    <link rel="stylesheet" href="<?php echo base_url('css/rekabentuk.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container-fluid mb-2">
    <nav class="navbar navbar-light navbar-expand-md">
        <a href="<?php echo base_url(); ?>" class="navbar-brand">RIMS</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse justify-content-between" id="navbar">
            <div class="navbar-nav"></div>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="#" class="nav-link">ID: <?php echo strtoupper($this->session->userdata('pengguna_nama')); ?></a></li>
                <li class="nav-item"><?php echo anchor('pengguna/logout', 'LOG KELUAR', "class='btn btn-warning w-100 nav-link'"); ?></li>
            </ul>
        </div>
    </nav>
    </div>
    