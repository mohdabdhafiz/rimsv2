
<div class="p-3 border rounded shadow my-3">
    <h1>Senarai Keseluruhan Parlimen</h1>
    <small class="text-muted">Bahagian-Bahagian Pilihan Raya Persekutuan Bagi Negeri-Negeri Tanah Melayu, Sabah dan Sarawak</small>
    <div class="row g-3 mt-3">
        <div class="col col-sm-12 col-md-6">
            <?php echo anchor('parlimen', 'Laman Utama Parlimen', "class='btn btn-primary w-100'"); ?>
        </div>
        <div class="col col-sm-12 col-md-6">
            <?php echo anchor('parlimen/daftar', 'Daftar Parlimen Baru', "class = 'btn btn-secondary w-100'"); ?>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    <?php foreach($senaraiNegeri as $negeri): ?>

        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="p-3 rounded border shadow">
        <h2><?php echo $negeri; ?></h2>
        <p class = "text-muted">Bilangan Parlimen / Bahagian Pilihan Raya Persekutuan: <?php echo count($parlimen->paparIkutNegeri($negeri)); ?></p>
        <div class="row g-3">
            <?php foreach($parlimen->paparIkutNegeri($negeri) as $p): ?>
            <div class="col col-sm-12 col-md-6">
                <div class="p-3 border rounded">
                <h3><?php echo $p->pt_nama; ?></h3>
                <div class="row g-3 mt-3">
                    <div class="col-12 col-lg-12">
                        <?php echo anchor('parlimen/kemaskini/'.$p->pt_bil, 'Kemaskini Maklumat Parlimen', "class = 'btn btn-warning w-100'"); ?>
                    </div>
                    <div class="col-12 col-lg-12">
                        <?php echo form_open('parlimen/padam'); ?>
                            <input type="hidden" name="inputParlimenBil" value="<?php echo $p->pt_bil; ?>">
                            <input type="hidden" name="inputPenggunaBil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                            <button type="submit" class="btn btn-danger w-100">Padam Maklumat Parlimen</button>
                        </form>
                    </div>
                </div>
                

                </div>
            </div>
            <?php endforeach; ?>
        </div>
        </div>
        </div>
    <?php endforeach; ?>
    </div>
