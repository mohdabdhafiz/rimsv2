<div class="p-3 border rounded mb-3">
    <h1>Senarai Akaun Pengguna Untuk Dipadam</h1>
    <div class="row g-3 mt-3">
        <div class="col-12 col-lg-12">
            <?php echo anchor(base_url(), 'Laman Utama', "class='btn btn-primary w-100'"); ?>
        </div>
    </div>
</div>

    <div class="table-responsive mb-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Bil</th>
                    <th>Nama</th>
                    <th>Jawatan</th>
                    <th>Penempatan</th>
                    <th>Operasi</th>
                </tr>
            </thead>
            <tbody>
                <?php $bilangan = 1;
                foreach($senarai_pengguna as $pengguna): ?>
                <tr>
                    <td><?= $bilangan++ ?></td>
                    <td><?= $pengguna->nama_penuh ?></td>
                    <td><?= $pengguna->pekerjaan ?></td>
                    <td><?= $pengguna->pengguna_tempat_tugas ?></td>
                    <td>
                        <?php echo form_open('pengguna/sah_padam'); ?>
                        <input type="hidden" name="input_bil" value="<?= $pengguna->bil ?>">
                        <button type="submit" class="btn btn-warning w-100">Sah</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
