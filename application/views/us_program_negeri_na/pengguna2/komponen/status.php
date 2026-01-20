

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="font-weight-bold text-primary m-0">Senarai Pengguna</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
    <table id="tableP" class="table">
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
</div>

<script>
    $(document).ready( function () {
    $('#tableP').DataTable();
} );
</script>
