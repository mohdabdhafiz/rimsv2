<div class="p-3 border rounded d-flex flex-column w-100">
    <p><strong>Konfigurasi RIMS</strong></p>

    <div class="row g-3 mt-auto">

        <div class="col-12 col-lg-4 d-flex align-items-stretch">
            <div class="p-3 border rounded w-100 d-flex flex-column">
                <p><strong>Daerah</strong></p>
                <div class="row g-3 mt-auto">
                    <div class="col-12 col-lg-6 d-flex align-items-stretch">
                        <?php echo anchor('konfigurasi/daerah', 'Maklumat Asas Daerah', "class='btn btn-sm btn-outline-warning w-100'"); ?>
                    </div>
                    <div class="col-12 col-lg-6 d-flex align-items-stretch">
                        <?php echo anchor('konfigurasi/tugas_daerah', 'Penepatan Penugasan Daerah', "class='btn btn-sm btn-outline-warning w-100'"); ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-lg-4 d-flex align-items-stretch">
            <div class="p-3 border rounded w-100 d-flex flex-column">
                <p><strong>Parlimen</strong></p>
                <div class="row g-3 mt-auto">
                    <div class="col-12 col-lg-6 d-flex align-items-stretch">
                        <?php echo anchor('konfigurasi/parlimen', 'Maklumat Asas Parlimen', "class='btn btn-sm btn-outline-warning w-100'"); ?>
                    </div>
                    <div class="col-12 col-lg-6 d-flex align-items-stretch">
                        <?php echo anchor('konfigurasi/tugas_parlimen', 'Penepatan Penugasan Parlimen', "class='btn btn-sm btn-outline-warning w-100'"); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4 d-flex align-items-stretch">
            <div class="p-3 border rounded w-100 d-flex flex-column">
                <p><strong>DUN</strong></p>
                <div class="row g-3 mt-auto">
                    <div class="col-12 col-lg-6 d-flex align-items-stretch">
                        <?php echo anchor('konfigurasi/dun', 'Maklumat Asas DUN', "class='btn btn-sm btn-outline-warning w-100'"); ?>
                    </div>
                    <div class="col-12 col-lg-6 d-flex align-items-stretch">
                        <?php echo anchor('konfigurasi/tugas_dun', 'Penepatan Penugasan DUN', "class='btn btn-sm btn-outline-warning w-100'"); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>