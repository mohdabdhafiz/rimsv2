<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
    
    public function index(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'URUSETIA' :
                $this->load->view('urusetia_na/peranan/senaraiPeranan', $data);
                break;
            default :
                redirect(base_url());
        }
    }

}

?>