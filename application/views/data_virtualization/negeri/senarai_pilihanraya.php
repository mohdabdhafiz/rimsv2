<?php
        $senaraiPilihanrayaParlimen = $data_pr->pilihanraya_aktif_ikut_negeri_parlimen($negeri->nt_nama);
        $senaraiPilihanrayaDun = $data_pr->pilihanraya_aktif_ikut_negeri_dun($negeri->nt_nama);
    ?>
    <?php if(!empty($senaraiPilihanrayaDun) || !empty($senaraiPilihanrayaParlimen)): ?>

<div class="p-3 border rounded mb-3">
    <p>
        <strong>Senarai Pilihan Raya</strong><br>
        <span class="text-muted small">Senarai Pilihan Raya mengikut penglibatan Parlimen / DUN bagi Negeri <?= $negeri->nt_nama ?></span>
    </p>
    
    <p>
        <strong>Status AKTIF</strong><br>
        <span class="small text-muted">Senarai Pilihan Raya yang sedang berlangsung.</span>
    </p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-striped">
            <tr>
                <th>#</th>
                <th>Nama Pilihan Raya</th>
                <th>Tarikh Penamaan Calon</th>
                <th>Tarikh Lock Status</th>
                <th>Jenis Pilihan Raya</th>
            </tr>
            <?php
            $bilangan = 1;
            foreach($senaraiPilihanrayaParlimen as $prParlimen): 
            ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><a href="<?= base_url() ?>index.php/pilihanraya/bil/<?= $prParlimen->pilihanraya_bil ?>"><?= $prParlimen->pilihanraya_nama ?></a></td>
                <td><?= $prParlimen->pilihanraya_penamaan_calon ?></td>
                <td><?= $prParlimen->pilihanraya_lock_status ?></td>
                <td><?= $prParlimen->pilihanraya_jenis ?></td>
            </tr>
            <?php endforeach; ?>

            <?php
            foreach($senaraiPilihanrayaDun as $prDun): 
            ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><a href="<?= base_url() ?>index.php/pilihanraya/bil/<?= $prDun->pilihanraya_bil ?>"><?= $prDun->pilihanraya_nama ?></a></td>
                <td><?= $prDun->pilihanraya_penamaan_calon ?></td>
                <td><?= $prDun->pilihanraya_lock_status ?></td>
                <td><?= $prDun->pilihanraya_jenis ?></td>
            </tr>
            <?php endforeach; ?>

        </table>
    </div>
</div>

<?php endif; ?>
