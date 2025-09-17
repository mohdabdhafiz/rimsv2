<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
    <h1>RIMS@LPK</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('sentimen') ?>">RIMS@LPK</a></li>
            <li class="breadcrumb-item active">Senarai Laporan Persepsi Terhadap Kerajaan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tapis Maklumat Muat Turun</h5>
                <?= form_open('sentimen/prosesMuatTurunPilihan', ['class' => 'needs-validation', 'novalidate' => '']) ?>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
                    <!-- Tarikh Laporan Mula -->
                    <div class="col">
                        <div class="form-floating">
                            <input type="datetime-local" name="inputTarikhMula" id="inputTarikhMula" class="form-control <?= form_error('inputTarikhMula') ? 'is-invalid' : '' ?>" value="<?= set_value('inputTarikhMula') ?>" required>
                            <label for="inputTarikhMula">Tarikh Laporan Mula</label>
                            <div class="invalid-feedback">
                                <?= form_error('inputTarikhMula', '<span>', '</span>') ?: 'Sila pilih tarikh mula laporan.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- Tarikh Laporan Tamat -->
                    <div class="col">
                        <div class="form-floating">
                            <input type="datetime-local" name="inputTarikhTamat" id="inputTarikhTamat" class="form-control <?= form_error('inputTarikhTamat') ? 'is-invalid' : '' ?>" value="<?= set_value('inputTarikhTamat') ?>" required>
                            <label for="inputTarikhTamat">Tarikh Laporan Tamat</label>
                            <div class="invalid-feedback">
                                <?= form_error('inputTarikhTamat', '<span>', '</span>') ?: 'Sila pilih tarikh tamat laporan.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- Pelapor -->
                    <div class="col">
                        <div class="form-floating">
                            <select name="inputPelapor" id="inputPelapor" class="form-select <?= form_error('inputPelapor') ? 'is-invalid' : '' ?>" aria-label="Pelapor">
                                <option value="" <?= set_select('inputPelapor', '', TRUE) ?>>Semua</option>
                                <?php foreach ($senaraiPelapor as $pelapor): ?>
                                    <option value="<?= $pelapor->pelaporBil ?>" <?= set_select('inputPelapor', $pelapor->pelaporBil) ?>>
                                        <?= htmlspecialchars($pelapor->pelaporNama, ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputPelapor">Pelapor</label>
                            <div class="invalid-feedback">
                                <?= form_error('inputPelapor', '<span>', '</span>') ?: 'Sila pilih pelapor.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- Negeri -->
                    <div class="col">
                        <div class="form-floating">
                            <select name="inputNegeri" id="inputNegeri" class="form-select <?= form_error('inputNegeri') ? 'is-invalid' : '' ?>" aria-label="Negeri">
                                <option value="" <?= set_select('inputNegeri', '', TRUE) ?>>Semua</option>
                                <?php foreach ($senaraiNegeri as $negeri): ?>
                                    <option value="<?= $negeri->negeriBil ?>" <?= set_select('inputNegeri', $negeri->negeriNama) ?>>
                                        <?= htmlspecialchars($negeri->negeriNama, ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputNegeri">Negeri</label>
                            <div class="invalid-feedback">
                                <?= form_error('inputNegeri', '<span>', '</span>') ?: 'Sila pilih Negeri.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- Daerah -->
                    <div class="col">
                        <div class="form-floating">
                            <select name="inputDaerah" id="inputDaerah" class="form-select <?= form_error('inputDaerah') ? 'is-invalid' : '' ?>" aria-label="Daerah">
                                <option value="" <?= set_select('inputDaerah', '', TRUE) ?>>Semua</option>
                                <?php foreach ($senaraiDaerah as $daerah): ?>
                                    <option value="<?= $daerah->daerahBil ?>" <?= set_select('inputDaerah', $daerah->daerahBil) ?>>
                                        <?= htmlspecialchars($daerah->daerahNama, ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputDaerah">Daerah</label>
                            <div class="invalid-feedback">
                                <?= form_error('inputDaerah', '<span>', '</span>') ?: 'Sila pilih Daerah.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- Parlimen -->
                    <div class="col">
                        <div class="form-floating">
                            <select name="inputParlimen" id="inputParlimen" class="form-select <?= form_error('inputParlimen') ? 'is-invalid' : '' ?>" aria-label="Parlimen">
                                <option value="" <?= set_select('inputParlimen', '', TRUE) ?>>Semua</option>
                                <?php foreach ($senaraiParlimen as $parlimen): ?>
                                    <option value="<?= $parlimen->parlimenBil ?>" <?= set_select('inputParlimen', $parlimen->parlimenNama) ?>>
                                        <?= htmlspecialchars($parlimen->parlimenNama, ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputParlimen">Parlimen</label>
                            <div class="invalid-feedback">
                                <?= form_error('inputParlimen', '<span>', '</span>') ?: 'Sila pilih Parlimen.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- DUN -->
                    <div class="col">
                        <div class="form-floating">
                            <select name="inputDun" id="inputDun" class="form-select <?= form_error('inputDun') ? 'is-invalid' : '' ?>" aria-label="DUN">
                                <option value="" <?= set_select('inputDun', '', TRUE) ?>>Semua</option>
                                <?php foreach ($senaraiDun as $dun): ?>
                                    <option value="<?= $dun->dunBil ?>" <?= set_select('inputDun', $dun->dunNama) ?>>
                                        <?= htmlspecialchars($dun->dunNama, ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputDun">DUN</label>
                            <div class="invalid-feedback">
                                <?= form_error('inputDun', '<span>', '</span>') ?: 'Sila pilih DUN.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- KAWASAN -->
                    <div class="col">
                        <div class="form-floating">
                            <select name="inputKawasan" id="inputKawasan" class="form-select <?= form_error('inputKawasan') ? 'is-invalid' : '' ?>" aria-label="Kawasan">
                                <option value="" <?= set_select('inputKawasan', '', TRUE) ?>>Semua</option>
                                <?php foreach ($senaraiKawasan as $kawasan): ?>
                                    <option value="<?= $kawasan->nama ?>" <?= set_select('inputKawasan', $kawasan->nama) ?>>
                                        <?= htmlspecialchars($kawasan->nama, ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputKawasan">Kawasan</label>
                            <div class="invalid-feedback">
                                <?= form_error('inputKawasan', '<span>', '</span>') ?: 'Sila pilih kawasan.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- PEKERJAAN -->
                    <div class="col">
                        <div class="form-floating">
                            <select name="inputPekerjaan" id="inputPekerjaan" class="form-select <?= form_error('inputPekerjaan') ? 'is-invalid' : '' ?>" aria-label="Pekerjaan">
                                <option value="" <?= set_select('inputPekerjaan', '', TRUE) ?>>Semua</option>
                                <?php foreach ($senaraiPekerjaan as $pekerjaan): ?>
                                    <option value="<?= $pekerjaan->nama ?>" <?= set_select('inputPekerjaan', $pekerjaan->nama) ?>>
                                        <?= htmlspecialchars($pekerjaan->nama, ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputPekerjaan">Pekerjaan</label>
                            <div class="invalid-feedback">
                                <?= form_error('inputPekerjaan', '<span>', '</span>') ?: 'Sila pilih pekerjaan.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- UMUR -->
                    <div class="col">
                        <div class="form-floating">
                            <select name="inputUmur" id="inputUmur" class="form-select <?= form_error('inputUmur') ? 'is-invalid' : '' ?>" aria-label="Kategori Umur">
                                <option value="" <?= set_select('inputUmur', '', TRUE) ?>>Semua</option>
                                <?php foreach ($senaraiUmur as $umur): ?>
                                    <option value="<?= $umur->nama ?>" <?= set_select('inputUmur', $umur->nama) ?>>
                                        <?= htmlspecialchars($umur->nama, ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputUmur">Kategori Umur</label>
                            <div class="invalid-feedback">
                                <?= form_error('inputUmur', '<span>', '</span>') ?: 'Sila pilih kategori umur.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- KAUM -->
                    <div class="col">
                        <div class="form-floating">
                            <select name="inputKaum" id="inputKaum" class="form-select <?= form_error('inputKaum') ? 'is-invalid' : '' ?>" aria-label="Kaum">
                                <option value="" <?= set_select('inputKaum', '', TRUE) ?>>Semua</option>
                                <?php foreach ($senaraiKaum as $kaum): ?>
                                    <option value="<?= $kaum->nama ?>" <?= set_select('inputKaum', $kaum->nama) ?>>
                                        <?= htmlspecialchars($kaum->nama, ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputKaum">Kaum</label>
                            <div class="invalid-feedback">
                                <?= form_error('inputKaum', '<span>', '</span>') ?: 'Sila pilih kaum.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- JANTINA -->
                    <div class="col">
                        <div class="form-floating">
                            <select name="inputJantina" id="inputJantina" class="form-select <?= form_error('inputJantina') ? 'is-invalid' : '' ?>" aria-label="Jantina">
                                <option value="" <?= set_select('inputJantina', '', TRUE) ?>>Semua</option>
                                <?php foreach ($senaraiJantina as $jantina): ?>
                                    <option value="<?= $jantina->nama ?>" <?= set_select('inputJantina', $jantina->nama) ?>>
                                        <?= htmlspecialchars($jantina->nama, ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputJantina">Jantina</label>
                            <div class="invalid-feedback">
                                <?= form_error('inputJantina', '<span>', '</span>') ?: 'Sila pilih jantina.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- SENTIMEN -->
                    <div class="col">
                        <div class="form-floating">
                            <select name="inputSentimen" id="inputSentimen" class="form-select <?= form_error('inputSentimen') ? 'is-invalid' : '' ?>" aria-label="Sentimen">
                                <option value="" <?= set_select('inputSentimen', '', TRUE) ?>>Semua</option>
                                <?php foreach ($senaraiSentimen as $sentimen): ?>
                                    <option value="<?= $sentimen->nama ?>" <?= set_select('inputSentimen', $sentimen->nama) ?>>
                                        <?= htmlspecialchars($sentimen->nama, ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputSentimen">Sentimen</label>
                            <div class="invalid-feedback">
                                <?= form_error('inputSentimen', '<span>', '</span>') ?: 'Sila pilih sentimen.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col">
                        <div class="d-flex align-items-center h-100">
                            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-download"></i> Muat Turun</button>
                        </div>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </section>

</main>

<?php $this->load->view($footer); ?>
