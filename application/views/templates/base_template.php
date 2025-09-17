<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * =================================================================================
 * BASE TEMPLATE UNIVERSAL - EDISI NICEADMIN
 * =================================================================================
 * Controller akan menghantar nama folder view untuk peranan semasa
 * melalui pembolehubah $role_view_folder (cth: 'urusetia_na', 'ppd_na').
 */

// Tentukan laluan asas untuk templat peranan semasa
$template_path = isset($role_view_folder) ? $role_view_folder . '/susunletak/' : 'urusetia_na/susunletak/';

// 1. Memuatkan Header NiceAdmin
$this->load->view($template_path . 'atas', $this);

// 2. Memuatkan Sidebar NiceAdmin
$this->load->view($template_path . 'sidebar', $this);

// 3. Memuatkan Navbar NiceAdmin (jika ada)
// Sesetengah templat NiceAdmin meletakkan navbar di dalam fail 'atas.php'
if (file_exists(APPPATH . 'views/' . $template_path . 'navbar.php')) {
    $this->load->view('templates/susunletak/navbar', $this);
}
?>
<title><?= isset($page_title) ? $page_title . ' - ' : '' ?>RIMS</title>
<main id="main" class="main">

    <?php
    // 4. Memuatkan Kandungan Halaman Dinamik
    if (isset($content_view) && !empty($content_view)) {
        $this->load->view($content_view, $this);
    } else {
        echo "<div class='alert alert-danger'>Ralat: Fail kandungan (content_view) tidak ditetapkan.</div>";
    }
    ?>

</main><?php
// 5. Memuatkan Footer NiceAdmin
$this->load->view($template_path . 'bawah', $this);
?>