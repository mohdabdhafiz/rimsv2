<div class="p-3 rounded border mb-3">
    <h3>Senarai Kluster Isu</h3>
    <div class="row g-3 mt-3">
        <div class="col-12 col-lg-3 col-md-4">
            <?php echo anchor(base_url(), 'Laman Utama', "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
        <div class="col-12 col-lg-3 col-md-4">
            <?php echo anchor('cpi/kluster_isu', 'Kluster Isu', "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
        <div class="col-12 col-lg-3 col-md-4">
            <?php echo anchor('cpi/senarai_kluster_isu', 'Senarai Kluster Isu', "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
        <div class="col-12 col-lg-3 col-md-4">
            <?php echo anchor('cpi/tambah_kluster_isu', 'Tambah Kluster Isu Baharu', "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
    </div>
</div>

<div class="p-3 border rounded mb-3">
    <h4>Kluster Isu</h4>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Bil</th>
                    <th>Kluster Isu</th>
                    <th>Deskripsi</th>
                    <th>Operasi</th>
                </tr>
            </thead>
            <tbody>
                <?php $bilangan = 1;
                foreach($senarai_kluster_isu as $ki): ?>
                <tr>
                    <td><?= $bilangan++ ?></td>
                    <td>
                        <?= $ki->kit_nama ?>
                    </td>
                    <td><?= $ki->kit_deskripsi ?></td>
                    <td>
                        <div class="row g-3">
                            <div class="col-12 col-lg-6">
                                <?php echo anchor('cpi/kemaskini_kluster/'.$ki->kit_bil, 'Kemaskini', "class='btn btn-outline-primary w-100'"); ?>
                            </div>
                            <div class="col-12 col-lg-6">
                                <?php echo anchor('cpi/padam_kluster/'.$ki->kit_bil, 'Padam', "class='btn btn-outline-danger w-100'"); ?>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>