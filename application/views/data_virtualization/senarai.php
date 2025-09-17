<div class="p-2">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'INTEREST', 'title="INTEREST"'); ?> </li>
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'Data Virtualization'); ?> </li>
    <li class="breadcrumb-item active" aria-current="page">Senarai Pencalonan</li>
  </ol>
</nav>
</div>

<div class="row">

<?php if(empty($senarai_dun->dun_pilihanraya($pilihanraya_bil))) { ?>
        <div class="col-12 mb-3">
            <div class="card p-3 pb-0 bg-info text-white text-center">
                <p>TIADA PENCALONAN DIBUAT</p>
            </div>
        </div>
        <?php }else{ ?>


    <div class="col-12 mb-3">
        <div class="card p-3">
            <h2>Senarai Pencalonan</h2>
            <table class="table">
                <tr>
                    <th>DUN</th>
                    <th>SENARAI CALON</th>
                </tr>
                <?php foreach($senarai_dun->dun_pilihanraya($pilihanraya_bil) as $dun): ?>
                <tr>
                    <td><?php echo strtoupper($dun->dun_nama); ?></td>
                    <td><?php 
                     
                            $string_text = "<table>";
                            foreach($senarai_dun->papar_ikut_dun($dun->dun_bil) as $calon){
                                $string_text .= "<tr><td>"; 
                                $img_src = base_url('assets/img/').$parti->logo($calon->pencalonan_parti);
                                $string_text .= "<img src='$img_src' style='object-fit: contain;width: 50px;height: 50px' />"; 
                                $string_text .= "</td><td>";
                                $string_text .= strtoupper($calon->ahli_nama);
                                $string_text .= "<br /><small>";
                                $string_text .= strtoupper($calon->parti_nama)." (".strtoupper($calon->parti_singkatan).")";
                                $string_text .= "</small></td></tr>"; 
                                 ?>
                            <?php } 
                            $string_text .= "</table>"; 
                            echo htmlentities($string_text);?>
                    </td>
                </tr>
                <?php endforeach; ?>
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