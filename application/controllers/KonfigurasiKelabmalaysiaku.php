<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KonfigurasiKelabmalaysiaku extends CI_Controller {

    public function index(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case "US_PROGRAM" :
                $this->load->view('us_program_na/konfigurasiKelabmalaysiaku/laman', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function daftar(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case "US_PROGRAM" :
                $this->load->view('us_program_na/konfigurasiKelabmalaysiaku/daftar', $data);
                break;
            default :
                redirect(base_url());
        }
    }
}
?>