<div class="container-fluid mb-3">
    <h1>PENETAPAN PENUGASAN DUN</h1>
    <div class="p-3 border rounded">
        <?php echo form_open('japen/proses_sempadan_dun'); ?>
            <div class="mb-3">
                <label for="input_peranan_bil" class="form-label">1) Pilih Akaun :</label>
                <select name="input_peranan_bil" id="input_peranan_bil" class = "form-control">
                    <option value="">Sila Pilih..</option>
                    <?php foreach($senarai_peranan as $peranan): 
                        if(strpos($peranan->peranan_nama, "ppd") !== FALSE){?>
                        <option value="<?php echo $peranan->peranan_bil; ?>"><?php echo $peranan->peranan_nama; ?></option>
                    <?php } 
                    endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <div class="row g-3">
                    <label for="input_dun" class="form-label">2) Pilih DUN :</label>
                    <?php foreach($senarai_dun as $dun): ?>
                        <div class="col-6 col-lg-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="input_dun[]" value="<?php echo $dun->dun_bil; ?>" id="input_dun[]">
                                <label class="form-check-label" for="input_dun[]">
                                    <?php echo $dun->dun_nama; ?>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan</button>
        </form>
    </div>
</div>