<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PERSONEL</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('pengguna') ?>">Laman</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('ppd') ?>">Laman PPN</a></li>
                <li class="breadcrumb-item active">Utama</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-3 col-md-4 col-sm-6">
            <a href="<?= site_url('ppn/daftarPpn') ?>" class="btn btn-primary shadow-sm w-100">Daftar PPN</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
                Daftar Pengarah Penerangan Negeri
            </h1>
            <p>Pastikan Pengguna belum mendaftar di dalam sistem ini.</p>

<?php echo validation_errors(); ?>

<?php echo form_open('ppn/prosesDaftar'); ?>

    <div class="mb-3">
        <label for="input_nama_penuh" class="form-label">Nama</label>
        <input type="text" name="input_nama_penuh" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="input_no_ic" class="form-label">Nombor Kad Pengenalan</label>
        <input type="text" name="input_no_ic" id="input_no_ic" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="input_no_tel" class="form-label">Nombor Telefon</label>
        <input type="text" name="input_no_tel" class="form-control" required/>
    </div>

    <div class="mb-3">
        <label for="input_emel" class="form-label">e-Mel</label>
        <input type="text" name="input_emel" id="input_emel" class="form-control" required>
    </div>

    <div class="form-floating mb-3">
        <select name="input_jawatan" id="input_jawatan" class="form-control" required>
            <option value="">Sila pilih..</option>
            <option value="Pegawai Penerangan Gred S54">Pegawai Penerangan Gred S54</option>
            <option value="Pegawai Penerangan Gred S52">Pegawai Penerangan Gred S52</option>
            <option value="Pegawai Penerangan Gred S48">Pegawai Penerangan Gred S48</option>
            <option value="Pegawai Penerangan Gred S44">Pegawai Penerangan Gred S44</option>
        </select>
        <label for="input_jawatan" class="form-label">Jawatan:</label>
    </div>
    
    <div class="form-floating mb-3">
        <select name="inputPeranan" id="inputPeranan" class="form-control" required>
            <option value="">Sila Pilih..</option>
            <?php foreach($senaraiKodPeranan as $peranan): ?>
                <option value="<?= $peranan->perananBil ?>"><?= $peranan->perananNama ?></option>
            <?php endforeach; ?>
        </select>
        <label for="inputPeranan" class="form-label">Senarai Kod Peranan</label>
    </div>

    <div class="form-floating mb-3">
        <select name="inputJapen" id="inputJapen" class="form-control" required>
            <option value="">Sila Pilih..</option>
            <?php foreach($senaraiJapen as $j): ?>
                <option value="<?= $j->japenBil ?>"><?= $j->japenNama ?></option>
            <?php endforeach; ?>
        </select>
        <label for="inputJapen" class="form-label">Senarai JAPEN</label>
    </div>

    <div class="mb-3">
        <input type="submit" name="submit" value="Daftar Pengguna" class="btn btn-outline-primary shadow-sm w-100"/>
    </div>
</form>
        </div>
    </div>

    </section>


</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>