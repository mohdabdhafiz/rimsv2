<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item">Konfigurasi RIMS</li>
                <li class="breadcrumb-item active">Peranan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">
        <?php $this->load->view('urusetia_na/peranan/nav'); ?>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                <h1 class="card-title">Negeri</h1>
                <a href="<?= site_url('peranan/senaraiNegeri') ?>" class="btn btn-outline-primary shadow-sm">Senarai</a>
                </div>
                <?= form_open('peranan/prosesTugasNegeri') ?>
                <div class="form-floating mb-3">
                                        <select name="inputNegeri" id="inputNegeri" class="form-control">
                                            <option value="">Sila pilih Negeri</option>
                                            <?php foreach($senaraiNegeri as $negeri): ?>
                                            <option value="<?= $negeri->nt_bil ?>"><?= $negeri->nt_nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="inputNegeri">Negeri</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="inputPerananBil" id="inputPerananBil" class="form-control">
                                            <option value="">Sila pilih Peranan Akaun</option>
                                            <?php foreach($senaraiPeranan as $peranan): ?>
                                            <option value="<?= $peranan->peranan_bil ?>"><?= $peranan->peranan_nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="inputPerananBil">Akaun Peranan</label>
                                    </div>
                    <div class="mb-3 text-center">
                        <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                        <input type="hidden" name="inputPenggunaWaktu" value="<?= date('Y-m-d H:i:s') ?>">
                        <button type="submit" class="btn btn-outline-primary shadown-sm">Set Penetapan Negeri</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="card-title">Daerah</h1>
                <a href="<?= site_url('peranan/senaraiDaerah') ?>" class="btn btn-outline-primary shadow-sm">Senarai</a>
                </div>
                <?= form_open('peranan/prosesTugasDaerah') ?>
                <div class="form-floating mb-3">
                                        <select name="inputDaerah" id="inputDaerah" class="form-control">
                                            <option value="">Sila pilih Daerah</option>
                                            <?php foreach($senaraiDaerah as $daerah): ?>
                                            <option value="<?= $daerah->bil ?>"><?= $daerah->nt_nama ?> - <?= $daerah->nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="inputDaerah">Daerah</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="inputPerananBil" id="inputPerananBil" class="form-control">
                                            <option value="">Sila pilih Peranan Akaun</option>
                                            <?php foreach($senaraiPeranan as $peranan): ?>
                                            <option value="<?= $peranan->peranan_bil ?>"><?= $peranan->peranan_nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="inputPerananBil">Akaun Peranan</label>
                                    </div>
                    <div class="mb-3 text-center">
                        <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                        <button type="submit" class="btn btn-outline-primary shadown-sm">Set Penetapan Tugasan Daerah</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="card-title">Parlimen</h1>
                <a href="<?= site_url('peranan/senaraiParlimen') ?>" class="btn btn-outline-primary shadow-sm">Senarai</a>
                </div>
                <?= form_open('peranan/prosesTugasParlimen') ?>
                <div class="form-floating mb-3">
                                        <select name="inputParlimen" id="inputParlimen" class="form-control">
                                            <option value="">Sila pilih Parlimen</option>
                                            <?php foreach($senaraiParlimen as $parlimen): ?>
                                            <option value="<?= $parlimen->pt_bil ?>"><?= $parlimen->pt_negeri ?> - <?= $parlimen->pt_nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="inputParlimen">Parlimen</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="inputPerananBil" id="inputPerananBil" class="form-control">
                                            <option value="">Sila pilih Peranan Akaun</option>
                                            <?php foreach($senaraiPeranan as $peranan): ?>
                                            <option value="<?= $peranan->peranan_bil ?>"><?= $peranan->peranan_nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="inputPerananBil">Akaun Peranan</label>
                                    </div>
                    <div class="mb-3 text-center">
                        <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                        <input type="hidden" name="inputPenggunaWaktu" value="<?= date('Y-m-d H:i:s') ?>">
                        <button type="submit" class="btn btn-outline-primary shadown-sm">Set Penetapan Tugasan Parlimen</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="card-title">DUN</h1>
                <a href="<?= site_url('peranan/senaraiDun') ?>" class="btn btn-outline-primary shadow-sm">Senarai</a>
                </div>
                <?= form_open('peranan/prosesTugasDun') ?>
                <div class="form-floating mb-3">
                                        <select name="inputDun" id="inputDun" class="form-control">
                                            <option value="">Sila pilih DUN</option>
                                            <?php foreach($senaraiDun as $dun): ?>
                                            <option value="<?= $dun->dun_bil ?>"><?= $dun->dun_negeri ?> - <?= $dun->dun_nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="inputDun">DUN</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="inputPerananBil" id="inputPerananBil" class="form-control">
                                            <option value="">Sila pilih Peranan Akaun</option>
                                            <?php foreach($senaraiPeranan as $peranan): ?>
                                            <option value="<?= $peranan->peranan_bil ?>"><?= $peranan->peranan_nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="inputPerananBil">Akaun Peranan</label>
                                    </div>
                    <div class="mb-3 text-center">
                        <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                        <input type="hidden" name="inputPenggunaWaktu" value="<?= date('Y-m-d H:i:s') ?>">
                        <button type="submit" class="btn btn-outline-primary shadown-sm">Set Penetapan Tugasan DUN</button>
                    </div>
                </form>
            </div>
        </div>

    </section>

</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>