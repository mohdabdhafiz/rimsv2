<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Negeri extends CI_Controller {

    public function tambah(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case "URUSETIA" :
                $this->load->view('urusetia_na/negeri/tambah', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function index(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case "URUSETIA" :
                $this->load->model('negeri_model');
                $data['senaraiNegeri'] = $this->negeri_model->senaraiNegeri();
                $this->load->view('urusetia_na/negeri/laman', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function bil($negeri_bil)
    {
        $this->load->model('negeri_model');
        $this->load->model('pilihanraya_model');
        $data['data_pr'] = $this->pilihanraya_model;
        $data['negeri'] = $this->negeri_model->negeri($negeri_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('top/negeri');
        $this->load->view('susunletak/bawah');
    }

}
?>