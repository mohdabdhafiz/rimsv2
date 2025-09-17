<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PERSONEL</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('pengguna/status_tambah') ?>">Senarai Pengguna</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('personel/setRole/'.$anggota->bil) ?>"><?= strtoupper($anggota->nama_penuh) ?></a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="card-title">Kategori Peranan</h1>
                    <button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#kemaskiniPeranan">
                <i class="bi bi-plus"></i>
              </button>
                </div>
                <div class="row g-3">
                    <div class="col-12 col-lg-6 col-md-12 col-sm-12">
                        <div class="text-secondary">
                            Nama:
                        </div>
                        <div class="h4"><?= strtoupper($anggota->nama_penuh) ?></div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-12 col-sm-12">
                        <div class="text-secondary">
                            Jawatan:
                        </div>
                        <div class="h4"><?= strtoupper($anggota->pekerjaan) ?></div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-12 col-sm-12">
                        <div class="text-secondary">
                            Tempat Bertugas:
                        </div>
                        <div class="h4"><?= strtoupper($anggota->pengguna_tempat_tugas) ?></div>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Extra Large Modal -->
        

              <div class="modal fade" id="kemaskiniPeranan" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"><i class="bi bi-gear"></i> Kemaskini Peranan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('personel/tambahKategoriPeranan') ?>
                        <div class="mb-3">
                            <div class="text-secondary">Nama:</div>
                            <div class="h4"><?= strtoupper($anggota->nama_penuh) ?></div>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="inputKategori" id="inputKategori" class="form-control" required>
                                <option value="">Sila pilih..</option>
                                <option value="Pemantau">Pemantau</option>
                                <option value="Pengesah">Pengesah</option>
                                <option value="Pelapor">Pelapor</option>
                            </select>
                            <label for="inputKategori" class="form-label">Kategori Peranan:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="inputPengesah" id="inputPengesah" class="form-control">
                                <option value="">Sila pilih..</option>
                                <?php foreach($senaraiPengesah as $pengesah): ?>    
                                    <option value="<?= $pengesah->bil ?>"><?= $pengesah->nama_penuh ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputPengesah" class="form-label">Nama Pegawai Pengesah:</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="inputAnggotaBil" value="<?= $anggota->bil ?>">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Tambah Kategori Peranan</button>
                        </form>
                    </div>
                  </div>
                </div>
              </div><!-- End Extra Large Modal-->       
              
              <?php if(!empty($senaraiKategoriPeranan)): ?>
              <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Senarai Kategori Peranan</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Anggota</th>
                                    <th>Jawatan</th>
                                    <th>Tempat Bertugas</th>
                                    <th>Kategori Peranan</th>
                                    <th>Pegawai Pengesah</th>
                                    <th>Jawatan</th>
                                    <th>Tempat Bertugas</th>
                                    <th>Tarikh Mula Peranan</th>
                                    <th>Tarikh Tamat Peranan</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($senaraiKategoriPeranan as $peranan): ?>
                                <tr>
                                    <td><?= strtoupper($peranan->anggotaNama) ?></td>
                                    <td><?= strtoupper($peranan->anggotaJawatan) ?></td>
                                    <td><?= strtoupper($peranan->anggotaTempatBertugas) ?></td>
                                    <td><?= strtoupper($peranan->kategoriPeranan) ?></td>
                                    <td><?= strtoupper($peranan->pegawaiNama) ?></td>
                                    <td><?= strtoupper($peranan->pegawaiJawatan) ?></td>
                                    <td><?= strtoupper($peranan->pegawaiTempatBertugas) ?></td>
                                    <td><?= ($peranan->tarikhMula) ?></td>
                                    <td><?= ($peranan->tarikhTamat) ?></td>
                                    <td>
                                        <a href="<?= site_url('personel/kemaskiniRole/'.$peranan->perananBil) ?>" class="btn btn-outline-primary shadow-sm"></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
              <?php endif; ?>
        
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Nota Kategori Peranan</h1>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Peringkat</th>
                                <th>Jawatan</th>
                                <th>Kategori</th>
                                <th>Akses</th>
                                <th>Peranan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan=4>Ibu Pejabat</td>
                                <td>Pengarah dan Timbalan Pengarah BPKPM</td>
                                <td>Pemantau / Pengesah</td>
                                <td colspan=2>
                                    <ol>
                                        <li>Memantau Jadual Aktiviti</li>
                                        <li>Memantau pelaksanaan program/aktiviti</li>
                                        <li>Memantau perkembangan KPI dari semasa ke semasa</li>
                                    </ol>
                                </td>
                            </tr>
                            <tr>
                                <td>Penolong Pengarah BPKPM</td>
                                <td>Pengesah</td>
                                <td>
                                    <ol>
                                        <li>Pengesahan Laporan</li>
                                    </ol>
                                </td>
                                <td>
                                    <ol>
                                        <li>Mengesahkan data pelaksanaan program / aktiviti</li>
                                        <li>Memantau pelaksanaan program / aktiviti</li>
                                    </ol>
                                </td>
                            </tr>
                            <tr>
                                <td>Pembantu Penerangan / Penolong Pegawai Penerangan</td>
                                <td>Pelapor</td>
                                <td>
                                    <ol>
                                        <li>Mengisi dan menghantar laporan program</li>
                                    </ol>
                                </td>
                                <td>
                                    <ol>
                                        <li>Menyediakan data pelaksanaan program/aktiviti</li>
                                    </ol>
                                </td>
                            </tr>
                            <tr>
                                <td>Urus Setia (Unit Pelaporan)</td>
                                <td>Pentadbir</td>
                                <td>
                                    <ol>
                                        <li>Akses keseluruhan sistem</li>
                                    </ol>
                                </td>
                                <td>
                                    <ol>
                                        <li>Memantau semua perancangan dan laporan program</li>
                                        <li>Menganalisis maklumat yang diterima</li>
                                        <li>Menyediakan khidmat sokongan penggunaan sistem</li>
                                    </ol>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>


</main>


<?php $this->load->view($footer); ?>