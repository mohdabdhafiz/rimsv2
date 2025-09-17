<div class="p-2">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'INTEREST', 'title="INTEREST"'); ?> </li>
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'Data Virtualization'); ?> </li>
    <li class="breadcrumb-item active" aria-current="page">Rumusan Umur Calon</li>
  </ol>
</nav>
</div>

<div class="row">

    <?php if(empty($kira_parti_calon->papar_umur_tua($pilihanraya_bil)) && empty($kira_parti_calon->papar_umur_muda($pilihanraya_bil))) { ?>
        <div class="col-12 mb-3">
            <div class="card p-3 pb-0 bg-info text-white text-center">
                <p>TIADA PENCALONAN DIBUAT</p>
            </div>
        </div>
        <?php }else{ ?>

    <div class="col-12 mb-3">
        <div class="card p-3">
            <h2>Rumusan Umur Calon Tertua</h2>
            <table class="table">
                <tr>
                    <th>DUN</th>
                    <th>GAMBAR</th>
                    <th>UMUR</th>
                    <th>PARTI</th>
                </tr>
                <?php foreach($kira_parti_calon->papar_umur_tua($pilihanraya_bil) as $u_tua): ?>
                        <tr>
                            <td><?php echo strtoupper($u_tua->dun_nama); ?></td>
                            <td><?php echo base_url('assets/img/').$u_tua->foto_nama; ?></td>
                            <td><?php echo $u_tua->ahli_umur; ?> TAHUN</td>
                            <td><?php echo $u_tua->parti_nama; ?> (<?php echo $u_tua->parti_singkatan; ?>)</td>
                        </tr>
                        <?php 
                endforeach; ?>
            </table>
        </div>
    </div>

    <div class="col-12 mb-3">
        <div class="card p-3">
            <h2>Rumusan Umur Calon Termuda</h2>
            <table class="table">
                <tr>
                    <th>DUN</th>
                    <th>GAMBAR</th>
                    <th>UMUR</th>
                    <th>PARTI</th>
                </tr>
                <?php foreach($kira_parti_calon->papar_umur_muda($pilihanraya_bil) as $u_muda): ?>
                        <tr>
                            <td><?php echo strtoupper($u_muda->dun_nama); ?></td>
                            <td><?php echo base_url('assets/img/').$u_muda->foto_nama; ?></td>
                            <td><?php echo $u_muda->ahli_umur; ?> TAHUN</td>
                            <td><?php echo $u_muda->parti_nama; ?> (<?php echo $u_muda->parti_singkatan; ?>)</td>
                        </tr>
                        <?php 
                endforeach; ?>
            </table>
        </div>
    </div>

    <?php } ?>

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