<main id="main" class="main">

    <div class="pagetitle">
        <h1>Papan Pemuka Utama (RIMS@LAPIS)</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS@LAPIS</a></li>
                <li class="breadcrumb-item active">Utama</li>
            </ol>
        </nav>
    </div><section class="section dashboard">
        <div class="row g-3">

            <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100 text-center shadow-sm">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title mb-4">Bilangan Pelapor</h5>
            
            <div class="my-auto">
                <div class="icon-circle bg-primary d-inline-flex align-items-center justify-content-center">
                    <i class="bi bi-people text-white h2 mb-0"></i>
                </div>
                <p class="text-muted">Jumlah Pelapor Aktif</p>
            </div>
            
            <div class="mt-auto">
                <a href="<?= site_url('pengguna/senarai_pelapor') ?>" class="btn btn-outline-primary">Lihat Senarai Pelapor</a>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100 text-center shadow-sm">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title mb-4">Bilangan Kluster Isu</h5>

            <div class="my-auto">
                <div class="icon-circle bg-success d-inline-flex align-items-center justify-content-center">
                    <i class="bi bi-tags text-white h2 mb-0"></i>
                </div>
                <p class="text-muted">Kluster Isu Utama</p>
            </div>

            <div class="mt-auto">
                <a href="<?= site_url('cpi/senarai_kluster_isu') ?>" class="btn btn-outline-success">Lihat Senarai Kluster</a>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-12 mb-4">
    <div class="card h-100 text-center shadow-sm">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title mb-4">Laporan LPK</h5>
            
            <div class="my-auto">
                <div class="icon-circle bg-info d-inline-flex align-items-center justify-content-center">
                    <i class="bi bi-flag text-white h2 mb-0"></i>
                </div>
                <p class="text-muted">Laporan Diterima Hari Ini</p>
            </div>
            
            <div class="mt-auto">
                <a href="<?= site_url('sentimen') ?>" class="btn btn-info">Buka Papan Pemuka</a>
                <a href="<?= site_url('sentimen/carian') ?>" class="btn btn-outline-secondary">Carian</a>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
    }
</style>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">RIMS@LAPIS - Carian</h5>
                            <a href="<?= site_url('lapis/carianTerperinci') ?>" class="btn btn-primary btn-sm"><i class="bi bi-search-heart"></i> Carian Terperinci</a>
                        </div>

                        <?= form_open('lapis/carian', ['class' => 'row g-3 mt-1']) ?>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-floating">
                                        <select name="inputKluster" id="inputKluster" class="form-control" required>
                                            <option value="">Sila pilih Kluster</option>
                                            <?php foreach($senarai_kluster as $kluster): ?>
                                            <option value="<?= $kluster->kit_bil ?>"><?= $kluster->kit_nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="inputKluster">Kluster</label>
                    </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-floating">
                                        <select name="inputNegeriBil" id="inputNegeriBil" class="form-control">
                                            <option value="">Sila pilih..</option>
                                            <?php foreach($senarai_negeri as $negeri): ?>
                                            <option value="<?= $negeri->nt_bil ?>"><?= $negeri->nt_nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="inputNegeriBil">Negeri</label>
                    </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-floating">
                        <input type="date" name="inputTarikhMula" id="inputTarikhMula" required class="form-control">
                        <label for="inputTarikhMula" class="form-label">Tarikh Mula</label>
                    </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-floating">
                        <input type="date" name="inputTarikhTamat" id="inputTarikhTamat" class="form-control" required>
                        <label for="inputTarikhTamat" class="form-label">Tarikh Tamat</label>
                    </div>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary">Cari Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
            
    </section>

</main>