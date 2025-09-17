<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'INTEGRASI21', 'title="INTEGRASI21"'); ?> </li>
    <li class="breadcrumb-item"><?php echo anchor('foto', 'Foto', 'title="Foto"'); ?> </li>
    <li class="breadcrumb-item active" aria-current="page">Arkib Foto</li>
  </ol>
</nav>

<h1>Arkib Foto</h1>

<div class="row">

    <?php foreach($semua_foto AS $sf): ?>

    <div class="col-sm-2">
        <div class="card">
            <img class="card-img-top rounded" src="<?php echo base_url('assets/img/').$sf->foto_nama; ?>" alt="<?php echo $sf->foto_bil; ?>" style="object-fit: cover;width: 100%;height: 300px">
            <div class="card-body">
                <p class="card-text"><?php echo $sf->foto_deskripsi; ?></p>
            <p class="card-text">
                <small class="text-muted">Muat naik oleh <?php echo $sf->nama_penuh; ?> pada <?php echo $sf->foto_waktu; ?></small>
             </p>
            <?php echo anchor('foto/padam_foto/'.$sf->foto_bil, 'PADAM '.$sf->foto_bil, array('class' => 'btn btn-primary btn-sm')); ?>
        </div>
        </div>
    </div>

    <?php endforeach; ?>

</div>