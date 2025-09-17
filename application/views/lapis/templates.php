<?php
$this->load->view($header);
$this->load->view($navbar);
$this->load->view($sidebar);
?>
<main id="main" class="main">
    <section>

        <?php
        foreach($content as $c):
            $this->load->view($c);
        endforeach;
        ?>

    </section>
</main>



<?php
$this->load->view($footer);
?>