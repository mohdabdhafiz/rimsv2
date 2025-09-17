<div class="bg-white border rounded p-3">
    <h3 class="text-primary mb-3">Pilihan Perjumpaan</h3>
    <?= validation_errors() ?>
    <?= form_open('luk/pilihanPerjumpaan') ?>
    <div class="row g-3">
        <div class="col d-flex align-items-stretch">
            <div class="form-floating d-flex flex-column w-100">
                <select name="inputNama" id="inputNama" class="form-control" required>
                    <option value="">Sila Pilih..</option>
                    <?php foreach($senaraiPerjumpaan as $perjumpaan): ?>
                        <option value="<?= $perjumpaan->nama ?>"><?= $perjumpaan->nama ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputNama" class="form-label">Senarai Perjumpaan</label>
            </div>
        </div>
        <div class="col-12 d-flex align-items-stretch">
            <button type="submit" class="btn btn-outline-primary w-100 d-flex flex-column justify-content-center align-items-center">
                Cari
            </button>
        </div>
    </div>
    <?= form_close(); ?>
</div>

<div class="bg-white border rounded p-3 mt-3">
    <h2>Keputusan Pilihan Perjumpaan</h2>
    <div class="table-responsive mt-3">
        <table class="table datatable">
            <thead>
                <tr>
                    <th>Nombor Siri</th>
                    <th>Nama Perjumpaan</th>
                    <th>Tarikh Masa</th>
                    <th>Pelapor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($senaraiKeputusanPerjumpaan as $skp): ?>
                <tr>
                    <td><?= $skp->siri ?></td>
                    <td><a href="<?= site_url('luk/siri/'.$skp->siri) ?>"><?= $skp->nama ?></a></td>
                    <td><?= $skp->tarikhMasa ?></td>
                    <td><?= $skp->pelapor ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>