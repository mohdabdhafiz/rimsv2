<?php $this->load->view('cpi/kluster_isu/nav'); ?>

<div class="p-3 border rounded mb-3">
    <h1>Pengesahan Pemadaman Maklumat</h1>
    <p>Adakah anda pasti untuk memadam maklumat kluster isu : <strong><?= $kluster_isu->kit_nama ?></strong>?</p>
    <div class="row g-3 mt-3">
        <div class="col-12 col-lg-8">
            <?php echo form_open('cpi/padam_ki'); ?>
                <input type="hidden" name="input_bil" value="<?= $kluster_isu->kit_bil ?>">
                <button type="submit" class="btn btn-danger w-100">Padam</button>
            </form>
        </div>
        <div class="col-12 col-lg-4">
            <?php echo anchor('cpi/senarai_kluster_isu', 'Batal', "class='btn btn-secondary w-100'"); ?>
        </div>
    </div>
</div>