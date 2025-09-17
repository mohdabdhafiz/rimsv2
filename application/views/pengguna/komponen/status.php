<div class="p-3 border rounded mb-3">
    <h1>Status Akaun</h1>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Bil</th>
                    <th>Nama</th>
                    <th>Jawatan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $bil = 1;
                foreach($senarai_anggota as $anggota): ?>
                <tr>
                    <td><?= $bil++ ?></td>
                    <td><?= $anggota->nama_penuh ?></td>
                    <td><?= $anggota->pekerjaan ?></td>
                    <td><?= $anggota->pengguna_status ?></td>
                </tr>
                <?php 
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
