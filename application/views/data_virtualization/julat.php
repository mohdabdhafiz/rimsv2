<div class="p-2">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'INTEREST', 'title="INTEREST"'); ?> </li>
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'Data Virtualization'); ?> </li>
    <li class="breadcrumb-item active" aria-current="page">Julat Umur Calon</li>
  </ol>
</nav>
</div>

<div class="row">
    <div class="col-12 mb-3">
        <div class="card p-3">
            <h2>Julat Umur Calon</h2>
            <table class="table">
                <tr>
                    <th>KATERGORI UMUR</th>
                    <th>BILANGAN CALON</th>
                    <th>PERATUSAN</th>
                </tr>
                <?php foreach($julat_umur as $j): ?>
                        <tr>
                            <td><?php echo $j['deskripsi_1']; ?></td>
                            <td><?php echo $j['bil_calon']; ?></td>
                            <td><?php echo $j['peratus']; ?></td>
                        </tr>
                        <?php 
                endforeach; ?>
            </table>
        </div>
    </div>

    <div class="col mb-3">
        <div class="card p-3">
            <h3>Data Virtualization</h3>
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