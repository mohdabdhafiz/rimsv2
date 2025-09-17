<?php
class Scoresheet extends CI_Controller {

    public function negeri($negeri_bil)
    {
        $this->load->view('susunletak/atas');
        $this->load->view('susunletak/bawah');
    }

    public function parlimen($parlimen_bil)
    {
        $this->load->view('susunletak/atas');
        $this->load->view('susunletak/bawah');
    }

    public function pilihanraya($pilihanraya_bil){
        if(empty($pilihanraya_bil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, 'NEGERI') === FALSE){
            redirect(base_url());
        }
        $this->load->model('pilihanraya_model');
        $this->load->model('negeri_model');
        $data['data_negeri'] = $this->negeri_model;
        $data['pr'] = $this->pilihanraya_model->pilihanraya($pilihanraya_bil);
        $data['data_pilihanraya'] = $this->pilihanraya_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('scoresheet/negeri/pilihanraya_bil');
        $this->load->view('susunletak/bawah');
    }

    public function index()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $peranan_bil = $this->session->userdata('peranan_bil');
        if(empty($peranan_bil)){
            redirect(base_url());
        }
        if(empty($sesi)){
            redirect(base_url());
        }
        if(strpos($sesi, 'NEGERI') === FALSE){
            redirect(base_url());
        }   
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('pilihanraya_model');
        $negeri = $this->winnable_candidate_assign_model->assign($peranan_bil)->wcat_negeri;
        $senarai_pilihanraya = array();
        $senarai_pilihanraya_parlimen = $this->pilihanraya_model->pilihanraya_selesai_ikut_negeri_parlimen($negeri);
        $senarai_pilihanraya = array_merge($senarai_pilihanraya, $senarai_pilihanraya_parlimen);
        $senarai_pilihanraya_dun = $this->pilihanraya_model->pilihanraya_selesai_ikut_negeri_dun($negeri);
        $senarai_pilihanraya = array_merge($senarai_pilihanraya, $senarai_pilihanraya_dun);
        $data['senarai_pilihanraya'] = $senarai_pilihanraya;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('scoresheet/negeri/utama');
        $this->load->view('susunletak/bawah');
    }

}
?>