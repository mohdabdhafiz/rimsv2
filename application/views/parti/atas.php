<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INTEREST</title>
    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/rekabentuk.css'); ?>">

    <style>
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

</head>
<body class="center">
<div class="container-fluid">
    <div class="row g-3">
        <div class="col">
            <div class="p-3">
                <div class="text-center">
                    <?php echo anchor('utama', 'PARTI', "class='display-1 text-decoration-none text-dark'"); ?>
                </div>
                <div class="text-center mb-3">
                <p>INTEREST</p>
                <?php foreach($maklumat_pengguna as $pengguna): ?>
                <p class="small"><?php echo $pengguna->nama_penuh; ?><br>[ <?php echo $pengguna->peranan_nama; ?> ]</p>
                <?php endforeach; ?>
                <?php echo anchor('pengguna/logout', 'Log Keluar', "class='btn btn-info btn-sm text-white'"); ?>
                </div>  
                
                <div class="p-3 border rounded">