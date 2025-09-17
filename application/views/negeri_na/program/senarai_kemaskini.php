<div class="mb-1">
    <?php $this->load->view('negeri_na/program/nav'); ?>
</div>


<?php if(!empty($senaraiProgram)): ?>
<div class="p-3 border rounded mb-1">
    <p><strong>Senarai Penuh Program</strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-striped">
            <tr>
                <th>#</th>
                <th>Daerah</th>
                <th>Parlimen</th>
                <th>DUN</th>
                <th>Nama Program</th>
                <th>Tarikh dan Masa</th>
                <th>Tempat</th>
                <th>Jenis Program</th>
                <th>Dimasukkan pada</th>
                <th>Operasi</th>
            </tr>
            <?php
            $bilangan = 1;
            foreach($senaraiProgram as $program):
            ?>
            <tr>
                <td class="text-center"><?= $bilangan++ ?></td>
                <td><?= $program->namaDaerah ?></td>
                <td><?= $program->namaParlimen ?></td>
                <td><?= $program->namaDun ?></td>
                <td>
                    <?php 
                    echo $program->namaProgram;
                    //echo anchor('program/bil/'.$program->bilProgram, $program->namaProgram); 
                    ?>
                </td>
                <td><?= $program->pt_tarikhMasa ?></td>
                <td><?= $program->pt_tempat ?></td>
                <td><?= $program->jenisProgram ?></td>
                <td><?= $program->pt_penggunaWaktu ?></td>
                <td>
                    <div class="row g-1">
                        <div class="col-auto">
                            <?= anchor('program/bil/'.$program->bilProgram, 'Lihat', "class='btn btn-sm btn-outline-secondary'") ?>
                        </div>
                        <div class="col-auto">
                            <?= anchor('program/kemaskini/'.$program->bilProgram, 'Kemaskini', "class='btn btn-sm btn-outline-secondary'") ?>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php endif; ?>

<?php if(empty($senaraiProgram)): ?>
    <div class="alert alert-warning">
        Tiada laporan program didaftarkan.
    </div>
<?php endif; ?>