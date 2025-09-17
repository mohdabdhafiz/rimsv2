<div class="container">
    <div class="mb-3">
        <p class="text-center">Anda pasti untuk memadam maklumat ini?</p>
        <table class="table">
            <tr>
                <th>Nama Calon</th>
                <td><?php echo $calon->jdt_nama_penuh; ?></td>
            </tr>
            <tr>
                <th>Parti Calon</th>
                <td><?php $parti = $data_parti->parti($calon->jdt_parti_bil); echo $parti->parti_nama; ?></td>
            </tr>
            <tr>
                <th>DUN</th>
                <td><?php $dun = $data_dun->dun_bil($calon->jdt_dun_bil); echo $dun->dun_nama; ?></td>
            </tr>
        </table>
        <div class="row g-1">
            <div class="col">
                <?php echo form_open('dun/padam_jangkaan_calon'); ?>
                <input type="hidden" name="input_jdt_bil" value="<?php echo $calon->jdt_bil; ?>">
                <input type="hidden" name="input_foto_bil" value="<?php echo $calon->jdt_foto_bil; ?>">
                <input type="hidden" name="input_dun_bil" value="<?php echo $calon->jdt_dun_bil; ?>">
                <button type="submit" class="btn btn-danger w-100">Padam</button>
                </form>
            </div>
            <div class="col">
                <?php echo anchor('dun/kemaskini_jangkaan_dun/'.$calon->jdt_dun_bil, 'Kembali ke Kemaskini Maklumat Calon', "class='btn btn-primary w-100'"); ?>
            </div>
        </div>
    </div>
</div>