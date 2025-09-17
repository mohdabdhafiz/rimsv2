<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pentadbir_kluster extends CI_Controller {

    public function dashboard($kluster_bil)
    {
        // Pastikan hanya URUSETIA atau Pentadbir Kluster yang betul boleh akses
        // ... (logik semakan peranan di sini) ...
		$sesi = strtoupper($this->session->userdata('peranan'));

        switch($sesi){
            case "LAPIS" : $role = 'us_lapis_na'; break;
            case "URUSETIA" : $role = 'urusetia_na'; break;
            default: redirect(base_url());
        }


        // 1. Muatkan model yang diperlukan
        $this->load->model('kluster_isu_model');
        $this->load->model('lapis2_model');

        // 2. Dapatkan data spesifik untuk kluster ini
        $data['nama_kluster'] = $this->kluster_isu_model->dapatkan_nama($kluster_bil); // Anda perlu cipta fungsi ini
        $data['senarai_laporan'] = $this->lapis2_model->laporan_mengikut_kluster($kluster_bil); // Anda perlu cipta fungsi ini
        // PANGGIL FUNGSI STATISTIK BAHARU
        $data['statistik'] = $this->lapis2_model->dapatkan_statistik_laporan_kluster($kluster_bil);
        // ... (dapatkan data statistik lain) ...

        // 3. Muatkan paparan papan pemuka Pentadbir Kluster
        $data['role_view_folder'] = $role; // Atau folder view yang sesuai
        $data['content_view'] = 'pentadbir_kluster/dashboard'; // Paparan yang kita rancang sebelum ini

        $this->load->view('templates/base_template', $data);
    }
}