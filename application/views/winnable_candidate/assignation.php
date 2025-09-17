<div class="container-fluid">
    <div class="p-3 border rounded mb-3">
        <h3>PROSES KERJA MODUL JANGKAAN CALON PARLIMEN PRU15</h3>
        <div class="row g-3 mt-3">
            <div class="col-12 col-lg-12">
                <?php echo anchor('winnable_candidate', 'Laman Utama', "class='btn btn-primary w-100'"); ?>
            </div>
        </div>
    </div>
    <?php echo validation_errors(); ?>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>NAMA PERANAN</th>
                <th>JABATAN</th>
                <th>NEGERI</th>
                <th>OPERASI</th>
            </tr>
            <?php foreach($senarai_peranan as $peranan): 
                $n = $data_wc_assign->assign($peranan->peranan_bil); ?>
                <?php echo form_open('winnable_candidate/proses_kerja'); ?>
                <tr>
                    <td><?php echo $peranan->peranan_nama; ?></td>
                    <td>
                        <select name="input_jabatan_bil" id="input_jabatan_bil" class="form-control">
                            <option value='0'>Sila Pilih</option>
                            <?php foreach($senarai_japen as $japen): ?>
                            <option value="<?php echo $japen->jt_bil; ?>" <?php if(!empty($n->wcat_negeri) && $n->wcat_jabatan_bil == $japen->jt_bil){ echo "selected"; } ?> ><?php echo $japen->jt_pejabat; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <select name="input_negeri" id="input_negeri" class="form-control">
                            <option value="0">Sila Pilih</option>
                            <?php foreach($senarai_negeri as $negeri): ?>
                                <option value="<?php echo $negeri->pt_negeri; ?>" <?php if(!empty($n->wcat_negeri) && $n->wcat_negeri == $negeri->pt_negeri){ echo "selected"; } ?> ><?php echo $negeri->pt_negeri; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <input type="hidden" name="input_peranan_bil" value="<?php echo $peranan->peranan_bil; ?>">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </td>
                </tr>
                </form>
            <?php endforeach; ?>
        </table>
    </div>
</div>