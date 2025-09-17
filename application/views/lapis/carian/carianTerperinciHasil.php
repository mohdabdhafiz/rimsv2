<?php if(!empty($hasilCarian)): ?>
<div class="card">
    <div class="card-body">
        <h1 class="card-title">Hasil Carian</h1>
        <div class="table-responsive">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Kluster</th>
                        <th>Timestamp</th>
                        <th>Pelapor</th>
                        <th>Negeri</th>
                        <th>Daerah</th>
                        <th>Parlimen</th>
                        <th>DUN</th>
                        <th>Jenis Kawasan</th>
                        <th>Isu</th>
                        <th>Ringkasan Isu</th>
                        <th>Lokasi Isu</th>
                        <th>Cadangan Intervensi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($hasilCarian as $hc): ?>
                    <tr>
                        <td><?= $hc->klusterNama ?></td>
                        <td><?= $hc->laporanTimestamp ?></td>
                        <td><?= $hc->pelaporNama ?></td>
                        <td><?= $hc->negeriNama ?></td>
                        <td><?= $hc->daerahNama ?></td>
                        <td><?= $hc->parlimenNama ?></td>
                        <td><?= $hc->dunNama ?></td>
                        <td><?= $hc->laporanKawasan ?></td>
                        <td><?= $hc->laporanIsu ?></td>
                        <td><?= $hc->laporanRingkasanIsu ?></td>
                        <td><?= $hc->laporanLokasi ?></td>
                        <td><?= $hc->laporanIntervensi ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>