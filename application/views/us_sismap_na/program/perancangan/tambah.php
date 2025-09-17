<?php 
$this->load->view('us_sismap_na/susunletak/atas');
$this->load->view('us_sismap_na/susunletak/sidebar');
$this->load->view('us_sismap_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM - PERANCANGAN</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('perancanganProgram') ?>">RIMS@PROGRAM</a></li>
                <li class="breadcrumb-item active">Perancangan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Operasi</h1>
    <?php $this->load->view('us_sismap_na/program/perancangan/nav'); ?>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Tambah Perancangan Program</h1>
            <?= form_open('perancanganProgram/prosesTambah') ?>
                <div class="form-floating mb-3">
                    <select name="inputNegeri" id="inputNegeri" class="form-control" required>
                        <option value="">Sila Pilih</option>
                        <?php foreach($senaraiNegeri as $negeri): ?>
                            <option value="<?= $negeri->nt_nama ?>"><?= $negeri->nt_nama ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="inputNegeri" class="form-label">Negeri:</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="inputDaerah" id="inputDaerah" class="form-control" required>
                        <option value="">Sila Pilih..</option>
                        <?php foreach($senaraiDaerah as $daerah): ?>
                            <option value="<?= $daerah->nama ?>"><?= $daerah->nt_nama ?> - <?= $daerah->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="inputDaerah" class="form-label">Daerah:</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="inputParlimen" id="inputParlimen" class="form-control">
                        <option value="">Sila Pilih..</option>
                        <?php foreach($senaraiParlimen as $parlimen): ?>
                            <option value="<?= $parlimen->pt_nama ?>"><?= $parlimen->nt_nama ?> - <?= $parlimen->pt_nama ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="inputParlimen" class="form-label">Parlimen:</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="inputDun" id="inputDun" class="form-control">
                        <option value="">Sila Pilih..</option>
                        <?php foreach($senaraiDun as $dun): ?>
                            <option value="<?= $dun->dun_nama ?>"><?= $dun->nt_nama ?> - <?= $dun->dun_nama ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="inputDun" class="form-label">DUN:</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="inputProgram" id="inputProgram" class="form-control">
                        <option value="">Sila Pilih..</option>
                        <?php foreach($senaraiProgram as $program): ?>
                            <option value="<?= $program->jt_nama ?>"><?= $program->jt_nama ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="inputProgram" class="form-label">Program:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" name="inputTarikh" id="inputTarikh" class="form-control" placeholder="Tarikh:">
                    <label for="inputTarikh" class="form-label">Tarikh:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="inputLokasi" id="inputLokasi" placeholder="Lokasi:" class="form-control">
                    <label for="inputLokasi" class="form-label">Lokasi:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="inputPerasmi" id="inputPerasmi" placeholder="Perasmi:" class="form-control">
                    <label for="inputPerasmi" class="form-label">Perasmi:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="inputKaedah" id="inputKaedah" placeholder="Kaedah Perlaksanaan:" class="form-control">
                    <label for="inputKaedah" class="form-label">Kaedah Perlaksanaan:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="inputPeserta" id="inputPeserta" placeholder="Bilangan Peserta:" class="form-control">
                    <label for="inputPeserta" class="form-label">Bilangan Peserta:</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="inputUrusetia" id="inputUrusetia" class="form-control">
                        <option value="">Sila Pilih..</option>
                        <?php foreach($senaraiPejabat as $pejabat): ?>
                            <option value="<?= $pejabat->pengguna_tempat_tugas ?>"><?= $pejabat->pengguna_tempat_tugas ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="inputUrusetia" class="form-label">Urus Setia:</label>
                </div>
                <button type="submit" class="btn btn-outline-primary w-100 shadow-sm">Tambah Perancangan Program</button>
            </form>
        </div>
    </div>


    </section>

</main>


<?php $this->load->view('us_sismap_na/susunletak/bawah'); ?>