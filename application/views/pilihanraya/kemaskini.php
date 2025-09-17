<div class="row">

<?php
if(empty($pilihanraya2)){
    redirect(base_url());   
}

foreach($pilihanraya2 as $pru): ?>
    <div class="col">
        <h1>Kemaskini Maklumat Pilihan Raya</h1>
        <small class="text-muted">Nombor Siri: <?php echo $pru->pilihanraya_bil; ?></small>
        <h2><?php echo $pru->pilihanraya_nama; ?></h2>
        
        <?php echo form_open('pilihanraya/update'); ?>
            <div class="form-group row mb-3">
                <label for="pilihanraya_nama" class="col-sm-2 col-form-label">Nama Pilihan Raya</label>
                <div class="col-sm-10">
                    <input type="text" name="pilihanraya_nama" id="pilihanraya_nama" class="form-control" value="<?php echo $pru->pilihanraya_nama; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="pilihanraya_singkatan" class="col-sm-2 col-form-label">Singkatan Nama Pilihan Raya</label>
                <div class="col-sm-10">
                    <input type="text" name="pilihanraya_singkatan" id="pilihanraya_singkatan" class="form-control" value="<?php echo $pru->pilihanraya_singkatan; ?>">
                </div>
            </div>
            <input type="hidden" name="pilihanraya_bil" value="<?php echo $pru->pilihanraya_bil; ?>">
            <button type="submit" class="btn btn-outline-info">KEMASKINI MAKLUMAT</button>
        </form>
    </div>
<?php endforeach; ?>


</div>