<div class="row g-3">
    <div class="col">
        <div class="p-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'INTEREST'); ?> </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Virtualization</li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="row g-3">
    <div class="col">
        <div class="p-3">
            <h1>Data Virtualization</h1>
            <div class="p-3 border rounded">
                <div class="row g-3">
                    
                    <div class="col">
                        <div class="p-3">
                            <h2>Senarai Data Virtualization</h2>
                            <div class="row">
                                <div class="col">
                                    <div class="p-3 border rounded text-center">
                                        <?php echo anchor('data_virtualization/pilih/1', 'Data Virtualization - Hari Penamaan Calon Pilihan Raya DUN Negeri Johor', "target='blank'"); ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="p-3 border rounded text-center">
                                        <?php echo anchor('data_virtualization/pilih/2', 'Data Virtualization - Hari Pembuangan Undi Pilihan Raya DUN Negeri Johor', "target='blank'"); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <h2>Data Virtualization - Hari Penamaan Calon Pilihan Raya DUN Negeri Johor</h2>
                            <div class="p-3 border rounded">
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

                    <div class="col">
                        <div class="p-3">
                            <h2>Data Virtualization - Hari Pembuangan Undi Pilihan Raya DUN Johor</h2>
                            <div class="p-3 border rounded">
                                <ol>
                                    <li><?php echo anchor('data_virtualization/parti_bertanding', 'Senarai Parti Bertanding'); ?></li>
                                    <li><?php echo anchor('data_virtualization/keputusan_penuh', 'Keputusan Penuh'); ?></li>
                                    <li><?php echo anchor('data_virtualization/sismap_keputusan', 'SISMAP x Keputusan'); ?></li>
                                    <li><?php echo anchor('data_virtualization/perbandingan_jangkaan', 'Perbandingan Peratusan Jangkaan Keputusan Parti Majoriti'); ?></li>
                                    <li><?php echo anchor('data_virtualization/keputusan_dun', 'Senarai Keputusan Mengikut DUN'); ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>