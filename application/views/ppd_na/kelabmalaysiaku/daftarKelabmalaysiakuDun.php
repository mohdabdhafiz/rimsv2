<?php 
$this->load->view('us_program_na/susunletak/atas');
$this->load->view('us_program_na/susunletak/sidebar');
$this->load->view('us_program_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@KELABMALAYSIAKU</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('kelabmalaysiaku/daftar') ?>"><?= $daerah->nt_nama ?></a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('kelabmalaysiaku/pilihDaerah/'.$daerah->nt_bil) ?>"><?= $daerah->nama ?></a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('kelabmalaysiaku/pilihParlimen/'.$daerah->bil) ?>"><?= $parlimen->pt_nama ?></a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('kelabmalaysiaku/pilihParlimen/'.$daerah->bil) ?>"><?= $dun->dun_nama ?></a></li>
                <li class="breadcrumb-item active"><i class="bi bi-plus"></i> Daftar Kelab Malaysiaku</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
                <i class="bi bi-plus"></i>
                Daftar Kelab Malaysiaku
            </h1>
            <?= form_open('kelabmalaysiaku/daftarKelabmalaysiaku') ?>
            <div class="form-floating mb-3">
                <input type="text" name="inputNama" id="inputNama" class="form-control" placeholder="1. Nama Kelab Malaysiaku" required>
                <label for="inputNama" class="form-label">1. Nama Kelab Malaysiaku</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="inputNegeriNama" id="inputNegeriNama" class="form-control" disabled value="<?= $daerah->nt_nama ?>">
                <label for="inputNegeriNama" class="form-label">2. Nama Negeri</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="inputDaerahNama" id="inputDaerahNama" disabled value="<?= $daerah->nama ?>" class="form-control">
                <label for="inputDaerahNama" class="form-label">3. Nama Daerah</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="inputParlimenNama" id="inputParlimenNama" class="form-control" disabled value="<?= $parlimen->pt_nama ?>">
                <label for="inputParlimenNama" class="form-label">4. Nama Parlimen</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="inputDunNama" id="inputDunNama" class="form-control" disabled value="<?= $dun->dun_nama ?>">
                <label for="inputDunNama" class="form-label">5. Nama DUN</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="inputNamaSekolah" id="inputNamaSekolah" placeholder="6. Nama Sekolah" class="form-control">
                <label for="inputNamaSekolah" class="form-label">6. Nama Sekolah</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="inputJenisSekolah" id="inputJenisSekolah" placeholder="7. Jenis Sekolah" class="form-control">
                <label for="inputJenisSekolah" class="form-label">7. Jenis Sekolah</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="inputNamaGuru" id="inputNamaGuru" placeholder="8. Nama Guru Penyelaras" class="form-control">
                <label for="inputNamaGuru" class="form-label">8. Nama Guru Penyelaras</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="inputJumlahAhli" id="inputJumlahAhli" placeholder="9. Jumlah Ahli Kelab" class="form-control">
                <label for="inputJumlahAhli" class="form-label">9. Jumlah Ahli Kelab</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="inputStatusKelab" id="inputStatusKelab" class="form-control" placeholder="10. Status Keaktifan Kelab">
                <label for="inputStatusKelab" class="form-label">10. Status Keaktifan Kelab</label>
            </div>
            <input type="hidden" name="inputDunBil" value="<?= $dun->dun_bil ?>">
            <input type="hidden" name="inputParlimenBil" value="<?= $parlimen->pt_bil ?>">
            <input type="hidden" name="inputDaerahBil" value="<?= $daerah->bil ?>">
            <input type="hidden" name="inputNegeriBil" value="<?= $daerah->nt_bil ?>">
            <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-plus"></i>
                Daftar
            </button>
            </form>
        </div>
    </div>

    </section>

</main>


<?php $this->load->view('us_program_na/susunletak/bawah'); ?>