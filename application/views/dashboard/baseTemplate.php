<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

    <section class="section">

    <?php
    if(!empty($gunaView)){
        $this->load->view($gunaView);
    }
    ?>

    </section>


</main>


<?php $this->load->view($footer); ?>