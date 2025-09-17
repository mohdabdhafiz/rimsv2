<div class="row g-2">
    <div class="col-12">
    <h1 class="text-center"><?php echo $tajuk; ?></h1>
                <div class="p-3   text-center">
                    <p class="display-6" style="<?php echo $warna_parti; ?>"><?php echo strtoupper($nama_parti); ?></p>
                    <p class="display-1 bg-warning" id="bilangan_kerusi"><?php echo $bilangan_kerusi; ?></p>
                    <div class="bg-light p-2"><p id="" class='mb-0'><?php echo $status_kerusi; ?></p></div>
                </div>
    </div>
    <div class="col-12">
        <div class="row g-1">
            <?php foreach($parti_kerusi as $pk): ?>
            <div class="col-6">
                <div class="p-3 border rounded">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-auto">
                        <img src="<?php echo base_url('assets/img/').$parti_detail->logo($pk['parti_bil']); ?>" class="img-fluid rounded" style="object-fit: contain;width: 100px;height: 100px"/>
                    </div>
                    <div class="col-auto">
                        <div class="display-5"><?php echo $pk['bilangan_kerusi']; ?></div>
                    </div>
                </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
     






                
     