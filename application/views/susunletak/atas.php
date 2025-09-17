<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIMS - Reporting and Issues Management Systems</title>
    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/rekabentuk.css'); ?>">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- include icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- include summernote css/js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

</head>
<body>
    <div class="container-fluid">
    
    <?php
    if(empty($pilihanraya)){
      $nama="";
    }else{
    foreach($pilihanraya as $pru){
  $nama = $pru->pilihanraya_nama;
}
} ?>

<nav class="navbar navbar-light justify-content-between">
  <a class="navbar-brand" href="<?php echo base_url(); ?>">RIMS</a>
  <div class="d-flex justify-content-between align-item-center">
  <span class="navbar-text">
      <?php echo $nama; ?>
    </span>
    <?php echo anchor('pengguna/logout','Log Keluar', "class='btn btn-warning'"); ?>
  </div>
</nav>
</div>

<div class="container-fluid">

