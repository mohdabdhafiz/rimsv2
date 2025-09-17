<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('program') ?>">RIMS@PROGRAM</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('jit') ?>">JIT</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('jit/carian') ?>">CARIAN TERPERINCI</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">JAPEN ON MOBILE INTERGRATION (JIT)</h1>
            <hr>
            <div class="row g-3">
                <div class="col-12 col-lg-6 col-md-6 col-sm-6">
                    <a href="<?= site_url('jit') ?>" class="btn btn-primary shadow-sm w-100">Laman Utama</a>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-6">
                    <a href="<?= site_url('jit/carian') ?>" class="btn btn-primary shadow-sm w-100">Carian Terperinci</a>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Carian</h1>
            <?= form_open('jit/keputusanCarian') ?>
            <div class="row g-3 mb-3">
                <div class="col-12 col-lg-12 col-md-6 col-sm-12">
                    <div class="p-3 border rounded">
                        <label for="inputJenisBil" class="form-label">1. Nama Program</label>
                        <select name="inputJenisBil" id="inputJenisBil" class="form-control">
                            <option value="">SEMUA</option>
                            <?php foreach($senaraiProgram as $program): ?>
                                <option value="<?= $program->jenisBil ?>"><?= strtoupper($program->jenisNama) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="p-3 border rounded">
                        <label for="inputTajukHebahan" class="form-label">2. Tajuk Hebahan</label>
                        <select name="inputTajukHebahan" id="inputTajukHebahan" class="form-control">
                            <option value="">SILA PILIH..</option>
                            <?php foreach($senaraiHebahan as $hebahan): ?>
                                <option value="<?= $hebahan->hebahanNama ?>"><?= strtoupper($hebahan->hebahanNama) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="p-3 border rounded">
                        <label for="inputTarikhMula" class="form-label">3. Tarikh Mula</label>
                        <input type="date" name="inputTarikhMula" id="inputTarikhMula" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="p-3 border rounded">
                        <label for="inputTarikhTamat" class="form-label">4. Tarikh Tamat</label>
                        <input type="date" name="inputTarikhTamat" id="inputTarikhTamat" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="p-3 border rounded">
                        <label for="inputNegeriBil" class="form-label">5. Negeri</label>
                        <select name="inputNegeriBil" id="inputNegeriBil" class="form-control">
                            <option value="">SEMUA</option>
                            <?php foreach($senaraiNegeri as $negeri): ?>
                                <option value="<?= $negeri->nt_bil ?>"><?= strtoupper($negeri->nt_nama) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary shadow-sm w-100">Cari dan Muat Turun</button>
            </form>
        </div>
    </div>



    </section>


</main>


<?php $this->load->view($footer); ?>