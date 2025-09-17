<div class="row g-3">
    <div class="col">
        <div class="p-3">
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'INTEREST'); ?> </li>
                    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'CARIAN DUN'); ?> </li>
                    <li class="breadcrumb-item active" aria-current="page">DUN</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col">
        <div class="p-3">
            <h2>CARIAN MENGIKUT DUN <small class='text-muted'>"<?php echo $this->input->post('dun_nama'); ?>"</small></h2>
            <div class="p-3 border rounded">
                <div class="row g-3">
                    <?php $i=0; foreach($dun as $d2){
                    foreach($d2 as $d){ ?>
                    <div class="col-4">
                        <div class="p-3 text-center border rounded bg-light">
                            <?php echo anchor('dun/papar_dun/'.$d->dun_bil, $d->dun_nama); ?><br>
                            (<?php echo $d->dun_negeri; ?>)
                        </div>
                    </div>
                    <?php } 
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>