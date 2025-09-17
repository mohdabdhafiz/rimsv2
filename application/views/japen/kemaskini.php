<div class="p-3 border rounded mb-3">
    <h3>KEMASKINI MAKLUMAT JAPEN BAHAGIAN/NEGERI</h3>
    <div class="row g-3 mt-3">
        <div class="col">
            <?php echo anchor('japen', 'JaPen', "class='btn btn-primary w-100'"); ?>
        </div>
        <div class="col">
            <?php echo anchor('japen/tambah', 'Tambah Negeri/Bahagian', "class='btn btn-secondary w-100'"); ?>
        </div>
    </div>
</div>
<div class="p-3 border rounded mb-3">
    <p><strong>Kemaskini Maklumat <?php echo $japen->jt_pejabat; ?></strong></p>
    <?php echo validation_errors(); ?>
    <?php echo form_open('japen/proses_kemaskini'); ?>
        <div class="mb-3">
            <label for="inputPejabat" class="form-label">JaPen Bahagian/Negeri</label>
            <input type="text" name="inputPejabat" id="inputPejabat" value="<?php echo $japen->jt_pejabat; ?>" class="form-control" >
        </div>
        <div class="mb-3">
            <label for="inputNegeri" class="form-label">Negeri</label>
            <select name="inputNegeri" id="inputNegeri" class = "form-control">
                <?php foreach($senaraiNegeri as $negeri): ?>
                <option value="<?php echo $negeri; ?>" <?php
                if($japen->jt_negeri == $negeri){
                    echo "selected";
                }
                ?>><?php echo $negeri; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row g-3">
            <div class="col">
                <input type="hidden" name="inputJapenBil" value = "<?php echo $japen->jt_bil; ?>">
                <input type="hidden" name="inputPenggunaBil" value = "<?php echo $this->session->userdata('pengguna_bil'); ?>" >
                <input type="hidden" name="inputPenggunaNama" value = "<?php echo $this->session->userdata('pengguna_nama'); ?>" >
                <input type="hidden" name="inputTarikhMasa" value = "<?php date("Y-m-d H:i:s"); ?>" >
                <button type="submit" class = "btn btn-primary w-100">Kemaskini</button>
            </div>
            <div class="col">
                <button type="reset" class = "btn btn-secondary w-100">Set Semula</button>
            </div>
            <div class="col">
                <?php echo anchor('japen', 'JaPen', "class = 'btn btn-info w-100'"); ?>
            </div>
        </div>
    </form>
</div>
<div class="p-3 border rounded mb-3">
    <p>
        <strong>Anda pasti untuk memadam maklumat ini?</strong>
    </p>
    <?php echo form_open('japen/proses_padam'); ?>
    <input type="hidden" name="inputJapenBil" value="<?php echo $japen->jt_bil; ?>">
    <button type="submit" class="btn btn-danger w-100">Padam</button>
    </form>
</div>