<h3>CARIAN MENGIKUT DUN <small class='text-muted'>"<?php echo $this->input->post('dun_nama'); ?>"</small></h3>
<div class="row g-3 mx-0">
    
    <?php $i=0; foreach($dun as $d2){
        foreach($d2 as $d){ ?>
    <div class="col-3 p-3 text-center">
        <?php echo anchor('dun/papar_dun/'.$d->dun_bil, $d->dun_nama, "class = 'col-auto'"); ?>
    </div>
<?php }

} ?>
</div>