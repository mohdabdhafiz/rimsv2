<h3>Padam Organisasi</h3>
<div class="p-3 border rounded mb-3 bg-white">
    <?= validation_errors() ?>
    <?= form_open("japen/padamOrganisasi/".$organisasi->organisasiBil); ?>
        <p>Anda pasti untuk memadam maklumat ini?</p>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>
                        <strong>Peranan</strong>
                        <br><?= $organisasi->perananNama ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Nama Organisasi</strong>
                        <br><?= $organisasi->japenNama ?>
                    </td>
                </tr>
            </table>
        </div>
        <input type="hidden" name="inputOrganisasiBil" value="<?= $organisasi->organisasiBil ?>">
        <input type="hidden" name="inputPerananBil" value="<?= $organisasi->perananBil ?>">
        <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
        <input type="hidden" name="inputPenggunaWaktu" value="<?= date("Y-m-d H:i:s") ?>">
        <button type="submit" class="btn btn-danger w-100">PADAM MAKLUMAT ORGANISASI</button>
    <?= form_close(); ?>
</div>