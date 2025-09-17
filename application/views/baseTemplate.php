<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

    <section class="section">

    <?php
        foreach($gunaView as $c):
            $this->load->view($c);
        endforeach;
        ?>

    </section>


</main>


<?php $this->load->view($footer); ?>