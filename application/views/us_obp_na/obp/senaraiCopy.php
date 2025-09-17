<?php $this->load->view('susunletak/atas'); ?>
<div class="">
    <h6 class="display-6">Senarai Penuh OBP</h6>
<table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Negeri</th>
                                            <th>Daerah</th>
                                            <th>Parlimen</th>
                                            <th>DUN</th>
                                            <th>Nama</th>
                                            <th>Nombor Telefon</th>
                                            <th>Jawatan</th>
                                            <th>Alamat</th>
                                            <th>e-Mel</th>
                                            <th>Umur</th>
                                            <th>Jantina</th>
                                            <th>Kaum</th>
                                            <th>Pendaftar</th>
                                            <th>Tarikh Pendaftaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  
         foreach ($h as $row):  
          
            ?><tr>
                <td><?= $row->nt_nama ?></td>
                <td><?= $row->nama ?></td>
                <td><?= $row->pt_nama ?></td>
                <td><?= $row->dun_nama ?></td>
                                            <td><?php echo $row->obp_nama;?></td>
                                            <td><?= $row->obp_no_tel ?></td>
                                            <td><?php echo $row->obp_jawatan;?></td>
                                            <td><?= $row->obp_alamat ?></td>
                                            <td><?= $row->obp_email ?></td>
                                            <td><?= $row->obp_umur ?></td>
                                            <td><?= $row->obp_jantina ?></td>
                                            <td><?= $row->obp_kaum ?></td>
                                            <td><?= $row->nama_penuh ?></td>
                                            <td><?= $row->waktuPendaftaran ?></td>
                                        </tr>
                                        <?php 
         endforeach;
         ?>
                                    </tbody>
                                </table>
</div>
<?php $this->load->view('susunletak/bawah'); ?>