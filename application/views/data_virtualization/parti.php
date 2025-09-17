<div class="p-2">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'INTEREST', 'title="INTEREST"'); ?> </li>
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'Data Virtualization'); ?> </li>
    <li class="breadcrumb-item active" aria-current="page">Senarai Parti Yang Bertanding</li>
  </ol>
</nav>
</div>

<div class="row">
    <?php if(empty($senarai_parti_calon)) { ?>

        <div class="col-12 mb-3">
            <div class="card p-3 pb-0 bg-info text-white text-center">
                <p>TIADA PENCALONAN DIBUAT</p>
            </div>
        </div>

        <?php }else{ ?>
    <div class="col-12 mb-3">
        <div class="card p-3">
            <h2>Senarai Parti Yang Bertanding</h2>
            <table class="table">
                <tr>
                    <th>NAMA PARTI</th>
                    <th>NAMA SINGKATAN</th>
                    <th>LOGO</th>
                    <th>BILANGAN KERUSI</th>
                </tr>
                <?php
                        foreach($senarai_parti_calon as $p):?>
                        <tr>
                            <td><?php echo $p->parti_nama; ?></td>
                            <td><?php echo $p->parti_singkatan; ?></td>
                            <td><?php echo base_url('assets/img/').$parti->logo($p->pencalonan_parti); ?></td>
                            <td><?php echo count($kira_parti_calon->kira_parti_calon($p->parti_bil,$this->session->userdata('pilihanraya_bil'))); ?></td>
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