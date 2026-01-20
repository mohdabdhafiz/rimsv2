<div class="mb-3">
    <h1>RIMS@LAPIS</h1>
</div>

<div class="mb-3">
    <h2>PAPARAN UMUM</h2>
</div>

<div class="row g-3 mb-3">
    <div class="col-lg col-12 d-flex align-items-stretch justify-content-center">
        <a href="<?= site_url("lapis/carianTerperinci") ?>" class="btn btn-primary text-start p-3 w-100">
            <h2>#1</h2>
            <h3>CARIAN TERPERINCI</h3>
            <p>Link ini digunakan untuk mencari laporan.</p>
        </a>
    </div>
    <div class="col-lg col-12 d-flex align-items-stretch justify-content-center">
        <a href="<?= site_url("lapis/tahunA") ?>" class="btn btn-primary text-start p-3 w-100">
            <h2>#2</h2>
            <h3>ARKIB 1</h3>
            <p>Link ini digunakan untuk melihat laporan.</p>
            <p>tahunA</p>
        </a>
    </div>
    <div class="col-lg col-12 d-flex align-items-stretch justify-content-center">
        <a href="<?= site_url("lapis/listArkib") ?>" class="btn btn-primary text-start p-3 w-100">
            <h2>#3</h2>
            <h3>ARKIB 3</h3>
            <p>Link ini digunakan untuk melihat laporan.</p>
            <p>listArkib</p>
        </a>
    </div>
</div>

<div class="mb-3">
    <h2>PAPARAN BER-PARAMETER</h2>
</div>

<div class="row g-3 mb-3">
    <div class="col-lg col-12 d-flex align-items-stretch justify-content-center">
        <a href="<?= site_url("lapis/laporanTolak/1") ?>" class="btn btn-secondary text-start p-3 w-100">
            <h2>#1</h2>
            <h3>LAPORAN DITOLAK</h3>
            <p>Link ini digunakan untuk senarai laporan yang telah ditolak.</p>
            <p>Memerlukan parameter: klusterBil (Nombor Siri bagi Kluster).</p>
        </a>
    </div>
    <div class="col-lg col-12 d-flex align-items-stretch justify-content-center">
        <a href="<?= site_url("lapis/arkibYear/".(date("Y")-1)) ?>" class="btn btn-secondary text-start p-3 w-100">
            <h2>#2</h2>
            <h3>ARKIB 2 MENGIKUT TAHUN</h3>
            <p>Link ini digunakan untuk melihat laporan mengikut tahun.</p>
            <p>Memerlukan parameter: tahun (Pilihan tahun untuk laporan).</p>
        </a>
    </div>
    <div class="col-lg col-12 d-flex align-items-stretch justify-content-center">
        <a href="<?= site_url("lapis/borangIsu/1") ?>" class="btn btn-secondary text-start p-3 w-100">
            <h2>#3</h2>
            <h3>BORANG ISU</h3>
            <p>Link ini digunakan untuk melihat laporan mengikut tahun.</p>
            <p>Memerlukan parameter: klusterBil (Nombor Siri bagi Kluster).</p>
        </a>
    </div>
</div>

<div class="mb-3">
    <h2>PAPARAN HANTARAN MENGGUNAKAN FORM (POST)</h2>
</div>

<div class="row g-3 mb-3">
    <div class="col-lg col-12 d-flex align-items-stretch justify-content-center">
        <?= form_open("lapis/muatTurun", "class='w-100'") ?>
        <input type="hidden" name="inputNegeri" value="1">
        <input type="hidden" name="inputKluster" value="1">
        <input type="hidden" name="inputTahun" value="<?= date("Y") ?>">
        <button type="submit" class="btn btn-success text-start p-3 w-100">
            <h2>#1</h2>
            <h3>CARIAN MUAT TURUN TERPERINCI</h3>
            <p>Link ini digunakan untuk mencari laporan.</p>
            <p>Input: inputNegeri, inputKluster, inputTahun</p>
        </button>
        <?= form_close(); ?>
    </div>
    <div class="col-lg col-12 d-flex align-items-stretch justify-content-center">
        <?= form_open("lapis/carianStatusPenghantaran", "class='w-100'") ?>
        <input type="hidden" name="carianStatusPenghantaran" value="1">
        <input type="hidden" name="inputTarikhMula" value="">
        <input type="hidden" name="inputTahun" value="<?= date("Y") ?>">
        <button type="submit" class="btn btn-success text-start p-3 w-100">
            <h2>#1</h2>
            <h3>CARIAN MUAT TURUN TERPERINCI</h3>
            <p>Link ini digunakan untuk mencari laporan.</p>
            <p>Input: inputNegeri, inputKluster, inputTahun</p>
        </button>
        <?= form_close(); ?>
    </div>
</div>


