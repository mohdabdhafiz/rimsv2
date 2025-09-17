<div class="d-flex justify-content-center align-items-center p-3" style="width: 100vw; height:100vh;">
    <div class="row g-1">
        <div class="col-12">
            <div class="p-3 border rounded d-flex justify-content-center align-items-center">
                <span><?= $pru->pilihanraya_singkatan ?></span>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="p-3 border rounded">
                <div class="row g-3">
                    <div class="col-12">
                        <span class="d-flex justify-content-center align-items-center">Kedudukan Parti</span>  
                    </div>
                    <?php foreach($senaraiParti as $parti): ?>
                    <div class="col">
                        <div class="p-3 border rounded d-flex justify-content-around align-items-center" style="<?= $parti->parti_warna ?>">
                            <span class="p-1"><?= $parti->parti_singkatan ?></span>
                            <span class="p-1">10</span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="p-3 border rounded">
                <div class="row g-3">
                    <div class="col-12">
                        <span class="d-flex justify-content-center align-items-center">Grading DUN</span>  
                    </div>
                    <div class="col d-flex align-self-stretch">
                        <div class="p-3 border rounded d-flex justify-content-around align-items-center w-100" style="">
                            <span class="p-1">Putih</span>
                            <span class="p-1">10</span>
                        </div>
                    </div>
                    <div class="col d-flex align-self-stretch">
                        <div class="p-3 border rounded d-flex justify-content-around align-items-center w-100" style="">
                            <span class="p-1">Kelabu Putih</span>
                            <span class="p-1">10</span>
                        </div>
                    </div>
                    <div class="col d-flex align-self-stretch">
                        <div class="p-3 border rounded d-flex justify-content-around align-items-center w-100" style="">
                            <span class="p-1">Kelabu Hitam</span>
                            <span class="p-1">10</span>
                        </div>
                    </div>
                    <div class="col d-flex align-self-stretch">
                        <div class="p-3 border rounded d-flex justify-content-around align-items-center w-100" style="">
                            <span class="p-1">Hitam</span>
                            <span class="p-1">10</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>