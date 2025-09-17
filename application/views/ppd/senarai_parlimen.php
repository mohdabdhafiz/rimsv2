<div class="p-3 border rounded mb-3">
    <h1>SENARAI PARLIMEN</h1>
    <div class="row g-3 mt-3">
        <div class="col-12 col-lg-12">
            <?php echo anchor(base_url(), 'Laman Utama', "class='btn btn-primary w-100'"); ?>
        </div>
    </div>
</div>

<?php if(!empty($senarai_parlimen)){ ?>
<div class="p-3 border rounded mb-3">
    <h2>GRADING</h2>
    <p>Rumusan Grading</p>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="bg-secondary text-white">
                <tr>
                    <th>BIL</th>
                    <th>SENARAI PARLIMEN</th>
                    <th>GRADING</th>
                </tr>
            </thead>
            <tbody>
                <?php $bilangan = 1; 
                foreach($senarai_parlimen as $parlimen):
                ?>
                <tr>
                    <td><?= $bilangan++ ?></td>
                    <td><?= $parlimen->pt_nama ?></td>
                    <?php 
                    $grading = $data_harian->semasa_parlimen($parlimen->pt_bil); 
                    if(!empty($grading)){
                        $g = $grading->harian_parlimen_grading;
                        $w = $grading->harian_parlimen_color;
                    }else{
                        $g = "Belum Ditetapkan";
                        $w = "background-color:red; color:white;";
                    }
                    ?>
                    <td style="<?= $w ?>"><?php echo $g;
                    ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>