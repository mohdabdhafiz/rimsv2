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
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item">RIM@PERSONEL</li>
                <li class="breadcrumb-item active">Senarai Pengguna Lain</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="alert alert-warning">
      <h1 class="alert-heading">Maklumat Mengikut Kad Pengenalan</h1>
      Maklumat Kad Pengenalan telah WUJUD.
    </div>

<div class="card">
  <div class="card-body">
    <h1 class="card-title">Senarai Pengguna Lain</h1>
    <div class="table-responsive">
      <table class="table datatable">
        <thead>
          <tr>
            <th>Peranan</th>
            <th>Nama</th>
            <th>Nombor Kad Pengenalan</th>
            <th>Nombor Telefon</th>
            <th>e-Mel</th>
            <th>Jawatan</th>
            <th>Penempatan</th>
            <th>Tarikh Pendaftaran</th>
            <th>Operasi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($senaraiPenggunaLain as $p): ?>
          <tr>
            <td><?= strtoupper($p->pengguna_peranan_nama) ?></td>
            <td><?= strtoupper($p->nama_penuh) ?></td>
            <td><?= strtoupper($p->pengguna_ic) ?></td>
            <td><?= strtoupper($p->no_tel) ?></td>
            <td><?= $p->emel ?></td>
            <td><?= strtoupper($p->pekerjaan) ?></td>
            <td><?= strtoupper($p->pengguna_tempat_tugas) ?></td>
            <td><?= $p->pengguna_waktu ?></td>
            <td>
            <div class="row g-1">
        <div class="col">
        <?php echo anchor('pengguna/kemaskini/'.$p->bil, 'Kemaskini', "class = 'btn btn-outline-primary shadow-sm w-100'"); ?>
        </div>
      </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

    </section>

</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>