<?php 
$this->load->view('us_program_negeri_na/susunletak/atas');
$this->load->view('us_program_negeri_na/susunletak/sidebar');
$this->load->view('us_program_negeri_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PERSONEL</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item">Penolong Pengarah, <?= $organisasi->jt_pejabat ?></li>
                <li class="breadcrumb-item active">Kemaskini Lantikan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->



    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
            <i class="bi bi-gear"></i>    
            Kemaskini Lantikan Penolong Pengarah <?= $organisasi->jt_pejabat ?></h1>
            <?php echo form_open('ketuaUnit/prosesLantikan'); ?>
                <?php if(empty($ketuaUnit)): ?>
                <div class="form-floating mb-3">
                    <select name="inputKetuaUnit" id="inputKetuaUnit" class="form-control" required>
                        <option value="">Sila Pilih..</option>
                        <?php foreach($senaraiAnggota as $anggota): ?>
                            <option value="<?= $anggota->bil ?>"><?= $anggota->nama_penuh ?>, <?= $anggota->pekerjaan ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="inputKetuaUnit" class="form-label">Pegawai:</label>
                </div>
                <?php else: ?>
                <div class="form-floating mb-3">
                    <select name="inputKetuaUnit" id="inputKetuaUnit" class="form-control" required>
                        <option value="">Sila Pilih..</option>
                        <?php foreach($senaraiAnggota as $anggota): ?>
                            <option <?php if($ketuaUnit->bil == $anggota->bil){ echo "selected"; } ?> value="<?= $anggota->bil ?>"><?= $anggota->nama_penuh ?>, <?= $anggota->pekerjaan ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="inputKetuaUnit" class="form-label">Pegawai:</label>
                </div>
                <?php endif; ?>
                <input type="hidden" name="inputPeranan" value="<?= $organisasi->peranan_bil ?>">
                <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                <input type="hidden" name="inputGelaranJawatan" value="Penolong Pengarah PKPM Negeri">
                <button type="submit" class="btn btn-outline-primary shadow-sm"><i class="bi bi-gear"></i> Kemaskini</button>
            </form>
        </div>
    </div>

    </section>


</main>

<?php $this->load->view('us_program_negeri_na/susunletak/bawah'); ?>
