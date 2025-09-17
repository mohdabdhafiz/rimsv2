<?php
class Daerah extends CI_Controller {

    public function negeri($negeriBil)
    {
        if(empty($negeriBil)){
            redirect(base_url());
        }
        $this->load->model('negeri_model');
        $this->load->model('daerah_model');
        $data['senaraiDaerah'] = $this->daerah_model->daerah_negeri($negeriBil);
        $data['negeri'] = $this->negeri_model->negeri($negeriBil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('urusetia/daerah/negeri');
        $this->load->view('susunletak/bawah');
    }

    public function index(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        switch($sesi){
            case 'URUSETIA' :
                $this->load->model('negeri_model');
                $this->load->model('daerah_model');
                $this->load->model('parlimen_model');
                $this->load->model('dun_model');
                $data['dataDun'] = $this->dun_model;
                $data['dataParlimen'] = $this->parlimen_model;
                $data['dataDaerah'] = $this->daerah_model;
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $this->load->view('susunletak/atas', $data);
                $this->load->view('urusetia/daerah/utama');
                $this->load->view('susunletak/bawah');
                break;
            case 'NEGERI' :
                $this->load->model('daerah_model');
                $this->load->model('negeri_model');
                $data['header'] = 'negeri_na/susunletak/atas';
                $data['navbar'] = 'negeri_na/susunletak/navbar';
                $data['sidebar'] = 'negeri_na/susunletak/sidebar';
                $data['footer'] = 'negeri_na/susunletak/bawah';
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->senaraiDaerah($senaraiNegeri);
                $this->load->view('daerah/utama', $data);
                break;
            default : 
                redirect(base_url());
        }
        
    }

}
?>