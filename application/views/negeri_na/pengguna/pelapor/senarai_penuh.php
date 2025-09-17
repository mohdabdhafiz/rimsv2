<?php 
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/sidebar');
$this->load->view('negeri_na/susunletak/navbar');
?>

<div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">RIMS@PENGGUNA</h1>
    </div>

 


        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Senarai Pelapor Keseluruhan</h1>
                <div class="table-responsive mt-3">
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama</th>
                                <th>Jawatan</th>
                                <th>Penempatan</th>
                                <th>Nombor Telefon</th>
                                <th>e-Mel</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $bilangan = 1;
                            $senarai_pelapor = $data_pengguna->pelapor_negeri($negeri);
                            foreach($senarai_pelapor as $pelapor): ?>
                            <tr>
                                <td><?= $bilangan++ ?></td>
                                <td><?= $pelapor->nama_penuh ?></td>
                                <td><?= $pelapor->pekerjaan ?></td>
                                <td><?= $pelapor->pengguna_tempat_tugas ?></td>
                                <td><?= $pelapor->no_tel ?></td>
                                <td><?= $pelapor->emel ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        

        



</div>

<?php $this->load->view('negeri_na/susunletak/bawah'); ?>



