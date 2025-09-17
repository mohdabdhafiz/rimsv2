<?php $this->load->view('data/program/nav'); ?>

<div class="p-3 mb-3">
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>STATUS</th>
                            <th>NOMBOR SIRI</th>
                            <th>NAMA PELAPOR</th>
                            <th>JAWATAN PELAPOR</th>
                            <th>PENEMPATAN PELAPOR</th>
                            <th>AKAUN PERANAN</th>
                            <th>NAMA PROGRAM</th>
                            <th>NEGERI</th>
                            <th>DAERAH</th>
                            <th>PARLIMEN</th>
                            <th>DUN</th>
                            <th>TARIKH</th>
                            <th>MASA</th>
                            <th>JUMLAH KHALAYAK</th>
                            <th>OPERASI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiProgram as $p): ?>
                        <tr>
                            <td><?= $p->program_status ?></td>
                            <td><?= $p->program_bil ?></td>
                            <td><?= $p->nama_penuh ?></td>
                            <td><?= $p->pekerjaan ?></td>
                            <td><?= $p->pengguna_tempat_tugas ?></td>
                            <td><?= $p->peranan_nama ?></td>
                            <td><?= $p->jt_nama ?></td>
                            <td><?= $p->nt_nama ?></td>
                            <td><?= $p->nama ?></td>
                            <td><?= $p->pt_nama ?></td>
                            <td><?= $p->dun_nama ?></td>
                            <?php
                            $tarikhProgram = "";
                            $masaProgram = "";
                            $tarikhProgram = date_format(date_create($p->program_tarikh_masa), 'Y-m-d');
                            $masaProgram = date_format(date_create($p->program_tarikh_masa), 'H:i:s');
                            ?>
                            <td><?= $tarikhProgram ?></td>
                            <td><?= $masaProgram ?></td>
                            <td><?= $p->program_khalayak ?></td>
                            <td>
                                <div class="row g-1">
                                    <div class="col-12">
                                        <a href="<?= site_url('program/bil/'.$p->program_bil) ?>" class="btn btn-outline-primary">
                                        <i class="bi bi-arrow-right-circle"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
</div>