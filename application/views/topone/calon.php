
    <div class="p-3 border rounded mb-3">
        <h1 class="display-1">SENARAI PILIHAN RAYA</h1>
        <?php $senarai_pilihanraya = $data_pilihanraya->papar_aktif(); ?>
        <div class="row g-3 mt-3">
            <div class="col-12 col-lg-3">
                <?php echo anchor(base_url(), 'LAMAN UTAMA', "class='btn btn-primary w-100'"); ?>
            </div>
            <?php foreach($senarai_pilihanraya as $pru): ?>
            <div class="col-12 col-lg-3">
                <?php echo anchor('laporan/topone/'.$pru->pilihanraya_bil, strtoupper($pru->pilihanraya_nama), "class='btn btn-primary w-100'"); ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
