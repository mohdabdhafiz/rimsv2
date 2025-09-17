<?php foreach($pilihanraya2 as $p): ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><?php echo anchor('pilihanraya', "<i class='bx bxs-city'></i> Pilihan Raya", "class='text-decoration-none'"); ?></li>
          <li class="breadcrumb-item active" aria-current="page"><i class='bx bxs-select-multiple'></i> <?php echo $p->pilihanraya_nama; ?></li>
        </ol>
      </nav>
<div class="row mb-3">

    <div class="col">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="p-3 border rounded">
                <p class="text-center">ANDA PASTI UNTUK MEMADAM MAKLUMAT PILIHANRAYA INI?</p>
                <p class="text-muted">Maklumat Pilihan Raya:</p>
                <dl class="row">
                    
                    <dt class="col-sm-3">Nama Pilihan Raya</dt>
                    <dd class="col-sm-9"><?php echo strtoupper($p->pilihanraya_nama); ?></dd>

                    <dt class="col-sm-3">Nama Singkatan Pilihan Raya</dt>
                    <dd class="col-sm-9"><?php echo $p->pilihanraya_singkatan; ?></dd>

                </dl>
                <div class="btn-group">
                <?php echo anchor('pilihanraya/setuju_padam/'.$p->pilihanraya_bil, 'SETUJU', array('class' => 'btn btn-sm btn-danger'));
                echo anchor('pilihanraya/info/'.$p->pilihanraya_bil, 'BATAL', array('class' => 'btn btn-sm btn-outline-primary')); ?>
                </div>
                </div>
            </div>
        </div>

    </div>

</div>

<?php endforeach; ?>