


<div class="row g-3">

<div class="col-12">
    <div class="p-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><?php echo anchor(base_url(), 'INTEREST', 'title="INTEREST"'); ?> </li>
                <li class="breadcrumb-item"><?php echo anchor(base_url(), 'Data Virtualization'); ?> </li>
                <li class="breadcrumb-item">DASHBOARD</li>
                <li class="breadcrumb-item active" aria-current="page">Senarai Keputusan Mengikut DUN</li>
            </ol>
        </nav>
    </div>
</div>

    <div class="col-12">
        <div class="p-3">
            <h1>Senarai Keputusan Mengikut DUN</h1>
            <div class="p-3 border rounded">
                <p class="small text-muted">Jumlah DUN : <?php echo $kira_dun; ?> DUN</p>
                <table class="table">
                    <tr>
                        <th>DUN</th>
                        <th>JANGKAAN JAPEN</th>
                        <th>KEPUTUSAN RASMI</th>
                    </tr>
                    <?php foreach($senarai_dun as $dun): ?>
                    <tr>
                        <td><?php echo $dun['nama_dun']; ?></td>
                        <td><?php echo $dun['parti_jangkaan_japen']; ?></td>
                        <td><?php echo $dun['parti_menang']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="p-3">
            <h3>Data Virtualization - PENAMAAN CALON</h3>
            <div class="p-3 border rounded">
            <ol>
                <li><?php echo anchor('data_virtualization/penjuru', 'Senarai Penjuru'); ?></li>
                <li><?php echo anchor('data_virtualization/parti', 'Parti Bertanding'); ?></li>
                <li><?php echo anchor('data_virtualization/julat', 'Julat Umur Calon'); ?></li>
                <li><?php echo anchor('data_virtualization/umur', 'Rumusan Umur Calon'); ?></li>
                <li><?php echo anchor('data_virtualization/jantina', 'Jantina Calon'); ?></li>
                <li><?php echo anchor('data_virtualization/senarai', 'Senarai Pencalonan'); ?></li>
            </ol>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="p-3">
            <h3>Data Virtualization - DASHBOARD</h3>
            <div class="p-3 border rounded">
                <ol>
                <li><?php echo anchor('data_virtualization/parti_bertanding', 'Senarai Parti Bertanding'); ?></li>
                <li><?php echo anchor('data_virtualization/keputusan_penuh', 'Keputusan Penuh'); ?></li>
                <li><?php echo anchor('data_virtualization/sismap_keputusan', 'SISMAP x Keputusan'); ?></li>
                <li><?php echo anchor('data_virtualization/perbandingan_jangkaan', 'Perbandingan Peratusan Jangkaan Keputusan Parti Majoriti'); ?></li>
                <li><?php echo anchor('data_virtualization/keputusan_dun', 'Senarai Keputusan Mengikut DUN'); ?></li>
                </ol>
            </div>
        </div>
    </div>


</div>