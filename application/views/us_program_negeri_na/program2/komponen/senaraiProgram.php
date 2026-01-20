<div class="table-responsive">
        <table id="tSenarai" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>Negeri</th>
                <th>Parlimen</th>
                <th>DUN</th>
                <th>Nama Program</th>
                <th>Tarikh dan Masa</th>
                <th>Dimasukkan pada</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Negeri</td>
                <td>Parlimen</td>
                <td>DUN</td>
                <td>Nama Program</td>
                <td>Tarikh dan Masa</td>
                <td>Dimasukkan pada</td>
                <td>Status</td>
                <td></td>
                </tr>
            <?php
            $bilangan = 1;
            foreach($senaraiProgram as $program):
            ?>
            <tr>
                <td>Negeri</td>
                <td><?= $program->namaParlimen ?></td>
                <td><?= $program->namaDun ?></td>
                <td>
                    <?php 
                    echo $program->jt_nama;
                    ?>
                </td>
                <td><?= $program->tarikh_masa_program ?></td>
                <td><?= $program->pengguna_waktu ?></td>
                <td>Status</td>
                <td>
                    <?= anchor('program/maklumat/'.$program->bilProgram, 'Previu', "class='btn btn-primary shadow-sm mb-1 w-100'") ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>