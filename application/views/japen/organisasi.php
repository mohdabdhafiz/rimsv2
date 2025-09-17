<h3>Senarai Organisasi</h3>
<div class="p-3 border rounded mb-3 bg-white">
<div class="table-responsive">
    <table class="table datatable">
        <thead>
            <tr>
                <th>Nama Peranan</th>
                <th>Nama Organisasi</th>
                <th>Tarikh Kemaskini Terakhir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($senaraiOrganisasi as $organisasi): ?>
            <tr>
                <td><a href="<?= site_url("japen/perananBil/".$organisasi->perananBil) ?>"><?= $organisasi->perananNama ?></a></td>
                <td><?= $organisasi->organisasiNama ?></td>
                <td><?= $organisasi->organisasiWaktu ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>