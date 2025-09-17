
    <div class="row g-3 mb-3">
        <?php foreach($senarai_pilihanraya as $pru): ?>
        <div class="col-12 col-lg-6 d-flex align-items-stretch">
            <div class="p-3 border rounded w-100 d-flex flex-column">
                <h5 class="display-5 mb-3"><?= strtoupper($pru->pilihanraya_nama) ?></h5>
                <div class="mt-auto">
                    <div class="row g-3">
                        <div class="col-12 col-lg-4 d-flex align-self-stretch">
                            <?php echo anchor('laporan/topone/'.$pru->pilihanraya_bil, 'RUMUSAN', "class='btn btn-primary w-100 d-flex align-items-center justify-content-center'"); ?>
                        </div>
                        <div class="col-12 col-lg-4 d-flex align-self-stretch">
                            <a href="<?= site_url('undi/statusKeluarMengundi/'.$pru->pilihanraya_bil) ?>" class="btn btn-primary w-100">STATUS KELUAR MENGUNDI</a>
                        </div>
                        <div class="col-12 col-lg-4 d-flex align-self-stretch">
                            <?php echo anchor('data_virtualization/keputusan_pilihanraya/'.$pru->pilihanraya_bil, 'KEPUTUSAN SEMASA', "class='btn btn-primary w-100 d-flex justify-content-center align-items-center'"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
