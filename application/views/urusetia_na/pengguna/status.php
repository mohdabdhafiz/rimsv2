<?php 
$this->load->view('ppd_mege/susunletak/atas');
$this->load->view('ppd_mege/susunletak/sidebar');
$this->load->view('ppd_mege/susunletak/navbar');
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">RIMS@PENGGUNA</h1>
                        <a href="<?= site_url('pengguna/tambah') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Tambah Pengguna</a>
                    </div>
    
                    
                    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="font-weight-bold text-primary m-0">Senarai Pengguna</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
    <table id="tableP" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jawatan</th>
                    <th>Nombor Telefon</th>
                    <th>e-Mel</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $bil = 1;
                foreach($senarai_anggota as $anggota): ?>
                <tr>
                    <td><?= $anggota->nama_penuh ?></td>
                    <td><?= $anggota->pekerjaan ?></td>
                    <td><?= $anggota->no_tel ?></td>
                    <td><?= $anggota->emel ?></td>
                    <td><?= $anggota->pengguna_status ?></td>
                    <td>
                    <button type="button" class="btn btn-circle btn-sm btn-primary shadow-sm mb-1" data-toggle="modal" data-target="#lihat<?= $anggota->bil ?>">
                        <i class='fas fa-search fa-sm text-white'></i>
                    </button>
                    <?= anchor('pengguna/kemaskini_maklumat/'.$anggota->bil, "<i class='fas fa-file fa-sm text-white'></i>", "class='btn btn-circle btn-sm btn-secondary shadow-sm mb-1'") ?>
                    <?= anchor('pengguna/padam_maklumat/'.$anggota->bil, "<i class='fas fa-trash fa-sm text-white'></i>", "class='btn btn-circle btn-sm btn-danger shadow-sm mb-1'") ?>
                    </td>
                </tr>
                <!-- Modal -->
                    <div class="modal fade" id="lihat<?= $anggota->bil ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Maklumat Pegawai</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center my-4 float-left">
                                <img src="https://cdn-icons-png.flaticon.com/512/25/25634.png"
                                class="rounded-circle" alt="example placeholder" style="max-width: 200px; max-height:200px;" />
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <p>
                                        <b class="text-primary">Nama</b>
                                        <br><?= $anggota->nama_penuh ?>
                                    </p>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <p>
                                        <b class="text-primary">Nombor Kad Pengenalan</b>
                                        <br><?= $anggota->pengguna_ic ?>
                                    </p>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <p>
                                        <b class="text-primary">Jawatan</b>
                                        <br><?= $anggota->pekerjaan ?>
                                    </p>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <p>
                                        <b class="text-primary">Tempat Bertugas</b>
                                        <br><?= $anggota->pengguna_tempat_tugas ?>
                                    </p>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <p>
                                        <b class="text-primary">Nombor Telefon</b>
                                        <br><?= $anggota->no_tel ?>
                                    </p>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <p>
                                        <b class="text-primary">e-Mel</b>
                                        <br><?= $anggota->emel ?>
                                    </p>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <p>
                                        <b class="text-primary">Status</b>
                                        <br><?= $anggota->pengguna_status ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                        </div>
                    </div>
                    </div>
                <?php 
                endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>




</div>


<?php $this->load->view('ppd_mege/susunletak/bawah'); ?>

<script>
    $(document).ready( function () {
        $('#tableP').DataTable();
    } );
</script>