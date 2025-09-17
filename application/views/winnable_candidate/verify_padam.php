<div class="container">
    <div class="mb-3">
        <p class="text-center">Anda pasti untuk memadam maklumat ini?</p>
        <table class="table">
            <tr>
                <th>Nama Calon</th>
                <td><?php echo $calon->wct_nama_penuh; ?></td>
            </tr>
            <tr>
                <th>Parti Calon</th>
                <td><?php $parti = $data_parti->parti($calon->wct_parti_bil); echo $parti->parti_nama; ?></td>
            </tr>
            <tr>
                <th>Parlimen</th>
                <td><?php $parlimen = $data_parlimen->parlimen_bil($calon->wct_parlimen_bil); echo $parlimen->pt_nama; ?></td>
            </tr>
        </table>
        <div class="row g-1">
            <div class="col">
                <?php echo form_open('winnable_candidate/padam'); ?>
                <input type="hidden" name="input_wct_bil" value="<?php echo $calon->wct_bil; ?>">
                <input type="hidden" name="input_foto_bil" value="<?php echo $calon->wct_foto_bil; ?>">
                <input type="hidden" name="input_parlimen_bil" value="<?php echo $calon->wct_parlimen_bil; ?>">
                <button type="submit" class="btn btn-danger w-100">Padam</button>
                </form>
            </div>
            <div class="col">
                <?php echo anchor('winnable_candidate/kemaskini_parlimen/'.$calon->wct_parlimen_bil, 'Kembali ke Kemaskini Maklumat Calon', "class='btn btn-primary w-100'"); ?>
            </div>
        </div>
    </div>
</div>