<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencalonan extends CI_Controller {

    

    public function maklumat_pencalonan($pilihanraya_bil)
    {
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $perananBil = $this->session->userdata('peranan_bil');
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        //CONFIGURATION
        $data['konfigurasiPadam'] = 'BUKA';


        switch($sesi){
            case 'DATA' :
                $this->load->model('pilihanraya_model');
                $this->load->model('pencalonan_model');
                $this->load->model('pencalonan_parlimen_model');
                $this->load->model('parlimen_model');
                $this->load->model('dun_model');
                $data['pru'] = $this->pilihanraya_model->pilihanraya($pilihanraya_bil);
                if($data['pru']->pilihanraya_jenis == "PARLIMEN"){
                    $data['senaraiPencalonan'] = $this->pencalonan_parlimen_model->senaraiCalonPilihanraya($pilihanraya_bil);
                    $data['senaraiParlimen'] = $this->pilihanraya_model->senaraiParlimen($pilihanraya_bil);
                }
                if($data['pru']->pilihanraya_jenis == "DUN"){
                    $data['senaraiPencalonan'] = $this->pencalonan_model->senaraiCalonPilihanraya($pilihanraya_bil);
                    $data['senaraiDun'] = $this->pilihanraya_model->senaraiDun($pilihanraya_bil);
                }
                $data['header'] = 'us_sismap_na/susunletak/atas';
                $data['navbar'] = 'us_sismap_na/susunletak/navbar';
                $data['sidebar'] = 'us_sismap_na/susunletak/sidebar';
                $data['footer'] = 'us_sismap_na/susunletak/bawah';
                $this->load->view('sismap/pencalonan/senarai', $data);
                break;
            default :
                //redirect(base_url());
                $peranan = $this->session->userdata('peranan');
                if(empty($peranan))
                {
                    redirect(base_url());
                }
                $this->load->model('pilihanraya_model');
                $this->load->model('japen_model');
                $this->load->model('pengguna_model');
                $this->load->model('parlimen_model');
                $this->load->model('dun_model');
                $this->load->model('pencalonan_parlimen_model');
                $this->load->model('pencalonan_model');
                $this->load->model('parti_model');
                $this->load->model('pengundi_parlimen_model');
                $this->load->model('ahli_model');
                $this->load->model('foto_model');
                $data['data_foto'] = $this->foto_model;
                $data['data_ahli'] = $this->ahli_model;
                $data['data_parti'] = $this->parti_model;
                $data['pru'] = $this->pilihanraya_model->pilihanraya($pilihanraya_bil);
                $data['data_pilihanraya'] = $this->pilihanraya_model;
                $data['data_pru'] = $this->pilihanraya_model;
                $data['data_calon'] = $this->pencalonan_parlimen_model;
                $this->load->view('susunletak/atas', $data);
                if($data['pru']->pilihanraya_jenis == "PARLIMEN"){
                $data['data_calon'] = $this->pencalonan_parlimen_model;
                $data['data_parlimen'] = $this->parlimen_model;
                    $data['senarai_tugas_parlimen'] = $this->japen_model->senarai_tugas_parlimen($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
                    $this->load->view('calonpru/pilihanraya_parlimen', $data);
                }
                if($data['pru']->pilihanraya_jenis == "DUN"){
                $data['data_calon'] = $this->pencalonan_model;
                $data['data_dun'] = $this->dun_model;
                    $data['senarai_tugas_dun'] = $this->japen_model->senarai_tugas_dun($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
                    $this->load->view('calonpru/pilihanraya_dun', $data);
                }
                $this->load->view('susunletak/bawah');
        } 
    }

    public function index()
    {
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'DATA' :
                //LOAD MODEL PILIHAN RAYA
                $this->load->model('pilihanraya_model');    
                $data['senaraiPilihanraya'] = $this->pilihanraya_model->senarai();
                $data['header'] = 'us_sismap_na/susunletak/atas';
                $data['navbar'] = 'us_sismap_na/susunletak/navbar';
                $data['sidebar'] = 'us_sismap_na/susunletak/sidebar';
                $data['footer'] = 'us_sismap_na/susunletak/bawah';
                $this->load->view('sismap/pencalonan/pilihPru', $data);
                break;
            default:
                //redirect(base_url());
                $this->load->model('pencalonan_parlimen_model');
                $this->load->model('pencalonan_model');
                $this->load->model('ahli_model');
                $this->load->model('foto_model');
                $this->load->model('parti_model');
                $this->load->model('pilihanraya_model');
                $data['senaraiCalonParlimen'] = $this->pencalonan_parlimen_model->senaraiSemuaCalon();
                $data['senaraiCalonDun'] = $this->pencalonan_model->papar_semua();
                $data['dataAhli'] = $this->ahli_model;
                $data['dataFoto'] = $this->foto_model;
                $data['dataParti'] = $this->parti_model;
                $data['dataPilihanraya'] = $this->pilihanraya_model;
                $this->load->view('susunletak/atas', $data);
                $this->load->view('calonpru/laman');
                $this->load->view('susunletak/bawah');
        }


        
    }

    public function parlimen()
    {
        $this->load->model('pilihanraya_model');
        $this->load->model('parlimen_model');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('pengguna_model');
        $this->load->model('parti_model');
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->papar_aktif_jenis("Parlimen");
        $data['senarai_parti'] = $this->parti_model->senarai();
        $data['pengguna'] = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));
        $data['data_assign'] = $this->winnable_candidate_assign_model;
        $data['data_parlimen'] = $this->parlimen_model;
        $data['pru_latest'] = $this->pilihanraya_model->pilihanraya_parlimen_baru();
        $this->load->view('susunletak/atas', $data);
        $this->load->view('calonpru/calon_parlimen');
        $this->load->view('susunletak/bawah');
    }

    public function dun()
    {
        $this->load->model('pilihanraya_model');
        $this->load->model('parlimen_model');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('pengguna_model');
        $this->load->model('parti_model');
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->papar_aktif_jenis("Parlimen");
        $data['senarai_parti'] = $this->parti_model->senarai();
        $data['pengguna'] = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));
        $data['data_assign'] = $this->winnable_candidate_assign_model;
        $data['data_parlimen'] = $this->parlimen_model;
        $data['pru_latest'] = $this->pilihanraya_model->pilihanraya_parlimen_baru();
        $this->load->view('susunletak/atas', $data);
        $this->load->view('calonpru/calon_parlimen');
        $this->load->view('susunletak/bawah');
    }

    public function ikut_parlimen($parlimen_bil)
    {
        if(empty($parlimen_bil)){
            redirect(base_url());
        }
        $this->load->model('parlimen_model');
        $ada = $this->parlimen_model->parlimen($parlimen_bil);
        if(empty($ada)){
            redirect(base_url());
        }
        $data['parlimen_bil'] = $parlimen_bil;
        $this->load->model('pilihanraya_model');
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->parlimen_pr_aktif($parlimen_bil);
        $data['pru_latest'] = $this->pilihanraya_model->pilihanraya_parlimen_baru();
        $data['data_pilihanraya'] = $this->pilihanraya_model;
        $this->load->model('parlimen_model');
        $data['data_parlimen'] = $this->parlimen_model;
        $this->load->model('winnable_candidate_assign_model');
        $data['data_assign'] = $this->winnable_candidate_assign_model;
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));
        $this->load->model('parti_model');
        $data['senarai_parti'] = $this->parti_model->senarai();
        $this->load->view('susunletak/atas', $data);
        $this->load->view('calonpru/calon_ikut_parlimen');
        $this->load->view('susunletak/bawah');
    }

    public function ikut_dun($dun_bil)
    {
        if(empty($dun_bil)){
            redirect(base_url());
        }
        $this->load->model('dun_model');
        $ada = $this->dun_model->dun_bil($dun_bil);
        if(empty($ada)){
            redirect(base_url());
        }
        $data['dun_bil'] = $dun_bil;
        $this->load->model('pilihanraya_model');
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->dun_pr_aktif($dun_bil);
        $data['pru_latest'] = $this->pilihanraya_model->pilihanraya_dun_baru();
        $data['data_pilihanraya'] = $this->pilihanraya_model;
        $data['data_dun'] = $this->dun_model;
        $this->load->model('jangka_dun_model');
        $data['data_assign'] = $this->jangka_dun_model;
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));
        $this->load->model('parti_model');
        $data['senarai_parti'] = $this->parti_model->senarai();
        $this->load->view('susunletak/atas', $data);
        $this->load->view('calonpru/calon_ikut_dun');
        $this->load->view('susunletak/bawah');
    }

    public function daftar_parlimen($parlimenBil)
    {
        $this->load->model('parlimen_model');
        $this->load->model('parti_model');
        $data['senaraiParlimen'] = $this->parlimen_model->parlimen($parlimenBil);
        $data['parti'] = $this->parti_model;
        $data['negeri_bil'] = $this->session->userdata('negeri_bil');
        $data['negeri_nama'] = $this->session->userdata('negeri_nama');
        $this->load->view('susunletak/atas', $data);
        $this->load->view('parti/parti_parlimen');
        $this->load->view('susunletak/bawah');
    }

    public function proses_pencalonan_parlimen()
    {
        $this->load->library('form_validation');
        $parlimen_bil = $this->input->post('inputCalonParlimenBil');
        $pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
        $this->form_validation->set_rules('inputCalonAhliNama', 'Nama Calon', 'required', array(
            "required" => "<div class='alert alert-warning'>Sila penuhi maklumat nama calon.</div>"
        ));
        if($this->form_validation->run() === FALSE){
            $this->parlimen();
        }else{
            $this->load->model('pencalonan_parlimen_model');
            $this->load->model('ahli_model');
            $senaraiAhli = $this->ahli_model->daftar_ahli(
                $this->input->post('inputCalonFotoBil'),
                $this->input->post('inputCalonAhliNama'),
                $this->input->post('inputCalonAhliUmur'),
                $this->input->post('inputCalonAhliJantina'),
                $this->input->post('inputCalonAhliPendidikan'),
                $this->input->post('inputCalonPenggunaBil')
            );
            $ahliBil = $senaraiAhli['last_id'];
            $senaraiCalon = $this->pencalonan_parlimen_model->daftar_calon(
                $this->input->post('inputCalonParlimenBil'),
                $this->input->post('inputCalonParlimenNama'),
                $ahliBil,
                $this->input->post('inputCalonAhliNama'),
                $this->input->post('input_parti_bil'),
                $this->input->post('inputCalonPenggunaBil'),
                $this->input->post('inputCalonPenggunaNama'),
                $this->input->post('input_pilihanraya_bil')
            );
            $sesi = strtoupper($this->session->userdata('peranan'));
            if(strpos($sesi, 'PPD') !== FALSE){
                redirect('pencalonan/maklumat_pencalonan/'.$pilihanraya_bil, 'refresh');
            }else{
                redirect('parlimen/papar_parlimen/'.$parlimen_bil, 'refresh');
            }
        }
    }

    public function proses_pencalonan_dun()
    {
        $this->load->library('form_validation');
        $dun_bil = $this->input->post('inputCalonDUNBil');
        $pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
        $this->form_validation->set_rules('inputCalonAhliNama', 'Nama Calon', 'required', array(
            "required" => "<div class='alert alert-warning'>Sila penuhi maklumat nama calon.</div>"
        ));
        if($this->form_validation->run() === FALSE){
            $this->ikut_dun($dun_bil);
        }else{
            $this->load->model('pencalonan_model');
            $this->load->model('ahli_model');
            $senaraiAhli = $this->ahli_model->daftar_ahli(
                $this->input->post('inputCalonFotoBil'),
                $this->input->post('inputCalonAhliNama'),
                $this->input->post('inputCalonAhliUmur'),
                $this->input->post('inputCalonAhliJantina'),
                $this->input->post('inputCalonAhliPendidikan'),
                $this->input->post('inputCalonPenggunaBil')
            );
            $ahliBil = $senaraiAhli['last_id'];
            $senaraiCalon = $this->pencalonan_model->daftar_calon(
                $this->input->post('inputCalonDUNBil'),
                $ahliBil,
                $this->input->post('input_parti_bil'),
                $this->input->post('inputCalonPenggunaBil'),
                $this->input->post('inputCalonPenggunaNama'),
                $this->input->post('input_pilihanraya_bil')
            );
            $sesi = strtoupper($this->session->userdata('peranan'));
            if(strpos($sesi, 'PPD') !== FALSE){
                redirect('pencalonan/maklumat_pencalonan/'.$pilihanraya_bil, 'refresh');
            }else{
                redirect('dun/papar_dun/'.$dun_bil, 'refresh');
            }
        }
    }

    public function proses_parlimen()
    {
        $this->load->library('form_validation');
        $parlimenBil = $this->input->post('inputCalonParlimenBil');
        $this->form_validation->set_rules('inputCalonAhliNama', 'Nama Calon', 'required', array(
            "required" => "<div class='alert alert-warning'>Sila penuhi maklumat nama calon.</div>"
        ));
        $this->form_validation->set_rules('inputCalonAhliUmur', 'Umur Calon', 'required', array(
            "required" => "<div class='alert alert-warning'>Sila penuhi maklumat nama calon.</div>"
        ));
        if($this->form_validation->run() === FALSE)
        {
            $this->daftar_parlimen($parlimenBil);
        }
        else
        {
            $this->load->model('pencalonan_parlimen_model');
            $this->load->model('ahli_model');
            $senaraiAhli = $this->ahli_model->daftar_ahli(
                $this->input->post('inputCalonFotoBil'),
                $this->input->post('inputCalonAhliNama'),
                $this->input->post('inputCalonAhliUmur'),
                $this->input->post('inputCalonAhliJantina'),
                $this->input->post('inputCalonAhliPendidikan'),
                $this->input->post('inputCalonPenggunaBil')
            );
            $ahliBil = $senaraiAhli['last_id'];
            $senaraiCalon = $this->pencalonan_parlimen_model->daftar_calon(
                $this->input->post('inputCalonParlimenBil'),
                $this->input->post('inputCalonParlimenNama'),
                $ahliBil,
                $this->input->post('inputCalonAhliNama'),
                $this->input->post('inputCalonPartiBil'),
                $this->input->post('inputCalonPenggunaBil'),
                $this->input->post('inputCalonPenggunaNama'),
                $this->input->post('inputCalonPilihanrayaBil')
            );
            $this->load->view('susunletak/atas');
            $this->load->view('calonpru/berjaya');
            $this->load->view('susunletak/bawah');
        }
    }

    public function padam(){
        $this->load->model('pencalonan_model');
        $this->pencalonan_model->padam($this->input->post('pencalonan_bil'));
        redirect(base_url());
    }

    public function padam_calon_parlimen(){
        $this->load->model('pencalonan_parlimen_model');
        $pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
        $this->pencalonan_parlimen_model->padam();
        redirect('pencalonan/maklumat_pencalonan/'.$pilihanraya_bil, 'refresh');
    }

    public function padam_calon_dun(){
        $this->load->model('pencalonan_model');
        $pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
        $this->pencalonan_model->padam_calon();
        redirect('pencalonan/maklumat_pencalonan/'.$pilihanraya_bil, 'refresh');
    }

    public function senarai()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        switch($sesi){
            case 'PPD' :
                $this->load->model('parlimen_model');
                $this->load->model('pencalonan_parlimen_model');
                $this->load->model('pilihanraya_model');
                $senaraiParlimen = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiCalon'] = $this->pencalonan_parlimen_model->senarai($senaraiParlimen);
                $data['senaraiPilihanraya'] = $this->pilihanraya_model->senaraiPruParlimen($senaraiParlimen);
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $this->load->view('sismap/pencalonan/pru', $data);
                break;

            //UNTUK AKAUN NEGERI
            case 'NEGERI' :
                
                //LOAD MODEL
                $this->load->model('pilihanraya_model');

                //LOAD DATA
                $data['senaraiPilihanraya'] = $this->pilihanraya_model->senarai();

                $this->load->view('negeri_na/sismap/pencalonan/senaraiPilihanraya', $data);

                break;

            default:
                redirect(base_url());
        }
    }
        

    public function pilih_parti(){
        $tmp_dun_bil = $this->input->post('dun_bil');
        if(empty($tmp_dun_bil)){
            redirect(base_url());
        }else{
            $this->load->model('dun_model');
            $this->load->model('pengguna_model');
            $this->load->model('parti_model');
            $this->load->model('pencalonan_model');
            $data['parti'] = $this->parti_model;
            $dun_bil = $this->input->post('dun_bil');
            $data['pencalonan_dun'] = $this->pencalonan_model->papar_ikut_dun($dun_bil);
            $data['maklumat_pengguna'] = $this->pengguna_model->maklumat_pengguna($this->session->userdata('pengguna_bil'));
            $data['dun'] = $this->dun_model->papar($dun_bil);
            $data['senarai_parti'] = $this->parti_model->papar_semua();
            $this->load->view('parti/atas', $data);
            $this->load->view('parti/parti_pegawai_lapangan');
            $this->load->view('parti/bawah');
        }
    }

    public function pilihanraya($pruBil)
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }

        //LOAD MODEL
        $this->load->model('pengguna_model');
        $this->load->model('pilihanraya_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['pru'] = $this->pilihanraya_model->pilihanraya($pruBil);

        switch($sesi){

            //UNTUK AKAUN NEGERI
            case 'NEGERI' :
                
                //LOAD USER NEGERI
                $negeri = '';

                //LOAD MODEL
                $this->load->model('pilihanraya_model');

                //LOAD DATA

                $this->load->view('negeri_na/sismap/pencalonan/senarai', $data);

                break;
            default:
                redirect(base_url());
        }
    }

    public function calon_pru_dun()
    {
        redirect(base_url(), 'refresh');
    }

}