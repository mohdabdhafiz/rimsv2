<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerancanganProgram extends CI_Controller {

    public function tambah(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('negeri_model');
        $this->load->model('daerah_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $this->load->model('jenis_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'DATA' :
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $data['senaraiDaerah'] = $this->daerah_model->senarai();
                $data['senaraiParlimen'] = $this->parlimen_model->senarai();
                $data['senaraiDun'] = $this->dun_model->senarai();
                $data['senaraiProgram'] = $this->jenis_model->senarai();
                $data['senaraiPejabat'] = $this->pengguna_model->senaraiPejabat();
                $this->load->view('us_sismap_na/program/perancangan/tambah', $data);
                break;
            default :
                redirect(base_url());
        }
    }
    
    public function senarai(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('perancangan_program_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'DATA' :
                $data['senaraiProgram'] = $this->perancangan_program_model->senaraiGSPI();
                $this->load->view('us_sismap_na/program/perancangan/senarai', $data);
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
            case 'DATA' :
                $this->load->view('us_sismap_na/program/perancangan/laman', $data);
                break;
            default :
                redirect(base_url());
        }
    }

}

?>