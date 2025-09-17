<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PERSONEL</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('program') ?>">Laman</a></li>
                <li class="breadcrumb-item active">Kemaskini Maklumat Pegawai Penerangan Daerah (PPD)</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Kemaskini Maklumat Pegawai Penerangan Daerah (PPD)</h1>
            <?= form_open('ppd/prosesKemaskiniPpd') ?>
                <div class="form-floating mb-3">
                    <select name="inputPpd" id="inputPpd" class="form-control" required>
                        <option value="" <?php if($ppd->p_anggota == ""){ echo "selected"; } ?>>Sila Pilih..</option>
                        <?php foreach($senaraiAnggota as $anggota): ?>
                            <option value="<?= $anggota->bil ?>" <?php if($ppd->p_anggota == $anggota->bil){ echo "selected"; } ?>><?= strtoupper($anggota->nama_penuh) ?> (<?= strtoupper($anggota->pekerjaan) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                    <label for="inputPpd" class="form-label">Pilih Pegawai:</label>
                </div>
                <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                <input type="hidden" name="inputPeranan" value="<?= $pengguna->pengguna_peranan_bil ?>">
                <button class="submit btn btn-warning shadow-sm">
                    <i class="bi bi-gear"></i>
                    Kemaskini
                </button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Pegawai Penerangan Daerah (PPD)</h1>
            <div class="d-flex justify-content-center align-items-start">
            <table class="table table-borderless">
                <tr>
                    <th class="text-end">Nama</th>
                    <td class="text-start"><?= strtoupper($ppd->nama_penuh) ?></td>
                </tr>
                <tr>
                    <th class="text-end">Jawatan</th>
                    <td class="text-start"><?= strtoupper($ppd->pekerjaan) ?></td>
                </tr>
                <tr>
                    <th class="text-end">Tempat Bertugas</th>
                    <td class="text-start"><?= strtoupper($ppd->pengguna_tempat_tugas) ?></td>
                </tr>
                <tr>
                    <th class="text-end">Tarikh Kuatkuasa</th>
                    <td class="text-start"><?= strtoupper($ppd->p_tarikh_mula) ?></td>
                </tr>
            </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Pegawai Penerangan Daerah (PPD)</h1>
            <div class="table-responsive">
                <table class="table table-sm datatable">
                    <thead>
                        <tr>
                            <th>NO SIRI</th>
                            <th>NAMA</th>
                            <th>JAWATAN</th>
                            <th>TARIKH MULA KUATKUASA</th>
                            <th>TARIKH TAMAT KUATKUASA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiPpd as $p): ?>
                        <tr>
                            <td><?= $p->p_bil ?></td>
                            <td><?= strtoupper($p->nama_penuh) ?></td>
                            <td><?= strtoupper($p->pekerjaan) ?></td>
                            <td><?= $p->p_tarikh_mula ?></td>
                            <td><?= $p->p_tarikh_tamat ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>


</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>