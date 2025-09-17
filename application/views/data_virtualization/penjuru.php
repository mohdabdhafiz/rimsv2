<div class="p-2">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'INTEREST', 'title="INTEREST"'); ?> </li>
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'Data Virtualization'); ?> </li>
    <li class="breadcrumb-item active" aria-current="page">Senarai Penjuru</li>
  </ol>
</nav>
</div>


<div class="row">
    
        
    <?php
    if(!empty($penjuru)) { ?>
    <div class="col-12 mb-3">
        <div class="card p-3">
            <h2>Senarai Penjuru</h2>
            <table class="table">
                <tr>
                    <th>BIL</th>
                    <th>BILANGAN PENJURU</th>
                    <th>BILANGAN DUN</th>
                    <th>PERATUSAN</th>
                </tr>
                <?php $count = 1; foreach($penjuru as $pen): 
                        if($pen['bilangan_dun']!=0 && $pen['bilangan_penjuru']!=0){?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $pen['bilangan_penjuru']; ?> PENJURU</td>
                            <td><?php echo $pen['bilangan_dun']; ?></td>
                            <td><?php echo $pen['peratusan']; ?>
                            </td>
                        </tr>
                        <?php }
                endforeach; ?>
            </table>
            <p>JUMLAH CALON = <?php echo $jumlah_calon; ?></p>
        </div>
    </div>
<?php }else{ ?>

    <div class="col-12 mb-3">
            <div class="card p-3 pb-0 bg-info text-white text-center">
                <p>TIADA PENCALONAN DIBUAT</p>
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