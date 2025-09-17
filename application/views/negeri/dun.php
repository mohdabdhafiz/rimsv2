<div class="container-fluid mb-3">
    <div class="p-3 border rounded mb-3">
    <h1>SENARAI DUN <?php echo strtoupper($negeri->nt_nama); ?></h1>
    <div class="row g-3 mt-3">
        <div class="col-12 col-lg-12">
            <?php echo anchor('dun','DUN', "class='btn btn-outline-primary w-100'"); ?>
        </div>
    </div>
    </div>
    <div class="mb-3 p-3 border rounded">
        <?php echo form_open('dun/tambah_negeri'); ?>
            <h2>TAMBAH DUN</h2>
            <div class="mb-3">
                <label for="dun_nama" class="form-label">NAMA DUN:</label>
                <input type="text" name="dun_nama" id="dun_nama" class="form-control">
            </div>
            <div class="mb-3">
                <input type="hidden" name="dun_negeri" value="<?php echo $negeri->nt_nama; ?>">
                <input type="hidden" name="input_dun_waktu" value="<?php echo date("Y-m-d H:i:s"); ?>">
                <input type="hidden" name="input_negeri_bil" value="<?php echo $negeri->nt_bil; ?>">
                <input type="hidden" name="dun_pengguna" value="<?php echo $this->session->userdata("pengguna_bil"); ?>">
                <button type="submit" class="btn btn-primary w-100">TAMBAH DUN</button>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr class="bg-secondary text-white">
                <th class="text-center">BIL</th>
                <th>NAMA DUN</th>
                <th>OPERASI</th>
            </tr>
            <?php $count = 1; foreach($senarai_dun as $dun): ?>
            <tr>
                <td class="text-center"><?php echo $count++; ?></td>
                <td><?php echo $dun->dun_nama; ?></td>
                <td><?php echo form_open('dun/proses_padam'); ?>
                    <input type="hidden" name="input_dun_bil" value="<?php echo $dun->dun_bil; ?>">
                    <input type="hidden" name="input_negeri_bil" value="<?php echo $negeri->nt_bil; ?>">
                    <button type="submit" class="btn btn-danger w-100">Padam</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>