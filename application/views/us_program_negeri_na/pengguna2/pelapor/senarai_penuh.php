<?php $this->load->view('cpi/nav'); ?>

<div class="p-3 border rounded mb-3">
    <h2>Senarai Penuh Pelapor</h2>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Nama Penuh</th>
                    <th>Jawatan</th>
                    <th>Penempatan</th>
                    <th>Negeri</th>
                    <th>Nombor Telefon</th>
                    <th>e-Mel</th>
                </tr>
            </thead>
            <tbody>
                <?php $bilangan = 1;
                foreach($senarai_pelapor as $pelapor): ?>
                <tr>
                    <td><?= $bilangan++ ?></td>
                    <td><?= $pelapor->bil ?></td>
                    <td><?= $pelapor->nama_penuh ?></td>
                    <td><?= $pelapor->pekerjaan ?></td>
                    <td><?= $pelapor->pengguna_tempat_tugas ?></td>
                    <?php 
                        $nama_negeri = 'Belum Ditetapkan';
                        $negeri = $data_peranan->negeri_dun($pelapor->pengguna_peranan_bil);
                        if(!empty($negeri)){
                            $nama_negeri = $negeri->dun_negeri;
                        }else{
                            $negeri_parlimen = $data_peranan->negeri_parlimen($pelapor->pengguna_peranan_bil);
                            if(!empty($negeri_parlimen)){
                                $nama_negeri = $negeri_parlimen->pt_negeri;
                            }
                        }
                    ?>
                    <td <?php if($nama_negeri == 'Belum Ditetapkan'): ?> style="background-color:red; color:white;" <?php endif; ?>>
                        <?php 
                        echo $nama_negeri;
                        ?>
                    </td>
                    <td><?= $pelapor->no_tel ?></td>
                    <td><?= $pelapor->emel ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>