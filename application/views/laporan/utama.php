<div class="my-3 text-end">
    <p><strong>SULIT</strong></p>
</div>
<div class="mb-3 text-center">
    <p>Sila pastikan persekitaran anda yang sesuai untuk memaparkan maklumat-maklumat laporan ini.</p>
</div>

<?php if($senaraiParlimenPencalonan){ 
    ?>
<div class="mb-3">
    
        
        
            <div class="p-3 border rounded shadow">
                <table class="table table-border table-hover">
                    <tr>
                        <th>NEGERI</th>
                        <th>PARLIMEN</th>
                    </tr>
                    <?php foreach($senaraiParlimenPencalonan as $parlimen): 
                        $maklumatParlimen = $dataParlimen->parlimen($parlimen->pencalonan_parlimen_parlimenBil);
                        foreach($maklumatParlimen as $p):
                    ?>
                    <tr>
                        <td><p><?php echo $p->pt_negeri; ?></p></td>
                        <td><p><?php echo $p->pt_nama; ?></p>
                        <ul>
                        <?php
                        $senaraiCalon = $senaraiPencalonanParlimen->senaraiCalon($p->pt_bil, $pilihanrayaBil); 
                        foreach($senaraiCalon as $calon): ?>
                        <li><?php echo $calon->pencalonan_parlimen_ahliNama; ?>, <?php
                        $senaraiParti = $dataParti->papar($calon->pencalonan_parlimen_partiBil);
                        foreach($senaraiParti as $parti){
                            echo $parti->parti_nama;
                        } ?></li>
                            <?php endforeach; ?>
                            </ul>
                        </td>
                    </tr>
                    <?php endforeach; 
                endforeach; ?>
                </table>
            
            </div>
        
        
</div>
<?php } ?>

<?php if($senaraiDUNPencalonan){ 
    ?>
<div class="mb-3">
    
        
        
            <div class="p-3 border rounded shadow">
                <table class="table table-border table-hover">
                    <tr>
                        <th>NEGERI</th>
                        <th>DUN</th>
                    </tr>
                    <?php foreach($senaraiDUNPencalonan as $dun): 
                        $maklumatDUN = $dataDUN->papar($dun->pencalonan_dun);
                        foreach($maklumatDUN as $d):
                    ?>
                    <tr>
                        <td><p><?php echo $d->dun_negeri; ?></p></td>
                        <td><p><?php echo $d->dun_nama; ?></p>
                        <ul>
                        <?php
                        $senaraiCalon = $senaraiPencalonanDUN->senaraiCalon($d->dun_bil, $pilihanrayaBil); 
                        foreach($senaraiCalon as $calon): ?>
                        <li><?php
                        $senaraiAhli = $dataAhli->papar($calon->pencalonan_ahli);
                        foreach($senaraiAhli as $ahli){
                            echo $ahli->ahli_nama;
                        } ?>, <?php
                        $senaraiParti = $dataParti->papar($calon->pencalonan_parti);
                        foreach($senaraiParti as $parti){
                            echo $parti->parti_nama;
                        } ?></li>
                            <?php endforeach; ?>
                            </ul>
                        </td>
                    </tr>
                    <?php endforeach; 
                endforeach; ?>
                </table>
            
            </div>
        
        
</div>
<?php } ?>


