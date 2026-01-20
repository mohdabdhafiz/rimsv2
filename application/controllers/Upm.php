<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upm extends CI_Controller {

    private function template($sesi){
        $sesi = strtoupper($sesi);
        switch($sesi){
            case 'UPM' :
                $view = "upm";
                break;
            default :
                redirect(base_url());
        }
        $template = [
            "header" => "$view/susunletak/atas",
            "sidebar" => "$view/susunletak/sidebar",
            "navbar" => "$view/susunletak/navbar",
            "footer" => "$view/susunletak/bawah"
        ];
        return $template;
    }

    private function pengguna(){
        $penggunaBil = $this->session->userdata("pengguna_bil");
        $this->load->model("pengguna_model");
        $pengguna = $this->pengguna_model->pengguna($penggunaBil);
        return $pengguna;
    }

    private function sesi(){
        $sesi = strtoupper($this->session->userdata("peranan"));
        if(empty($sesi)){
            redirect(base_url());
        }
        if(strpos($sesi, 'PPD') !== false){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'NEGERI') !== false){
            $sesi = 'NEGERI';
        }
        return $sesi;
    }

    public function __construct()
    {
        parent::__construct();
        // Load necessary models, libraries, etc.
    }

    public function index()
    {
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $data['gunaView'] = ["upm/utama"];
        $this->load->view("baseTemplate", $data);
    }

}