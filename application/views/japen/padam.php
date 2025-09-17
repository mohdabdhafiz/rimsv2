<div class="p-3 border rounded mb-3">
    <p>
        <strong>Anda pasti untuk memadam maklumat <?php echo $japen->jt_pejabat; ?> ini?</strong>
    </p>
    <p>Nota: Maklumat ini didaftarkan oleh <?php echo $japen->jt_pengguna_nama; ?> pada <?php echo $japen->jt_tarikh_masuk; ?></p>
    <div class="row g-3">
        <div class="col">
            <?php echo form_open('japen/proses_padam'); ?>
            <input type="hidden" name="inputJapenBil" value="<?php echo $japen->jt_bil; ?>">
            <button type="submit" class="btn btn-danger w-100">Padam</button>
            </form>
        </div>
        <div class="col">
            <?php echo anchor('japen', 'JaPen', "class='btn btn-primary w-100'"); ?>
        </div>
    </div>
</div>