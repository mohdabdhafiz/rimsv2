<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ahli extends CI_Controller {

    public function tukar_parti()
    {
        $jenis = $this->input->post('input_pilihanraya_jenis');
        $ahli_bil = $this->input->post('input_ahli_bil');
        $pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
        if(empty($jenis)){
            redirect(base_url());
        }
        if(empty($ahli_bil)){
            redirect(base_url());
        }
        if(empty($pilihanraya_bil)){
            redirect(base_url());
        }
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('pencalonan_model');
        if($jenis == 'PARLIMEN'){
            $this->pencalonan_parlimen_model->tukar_parti();
        }
        if($jenis == 'DUN'){
            $this->pencalonan_model->tukar_parti();
        }
        redirect('pencalonan/maklumat_pencalonan/'.$pilihanraya_bil, 'refresh');
    }

    public function proses_maklumat()
    {
        $ahliBil = $this->input->post('input_ahli_bil');
        if(empty($ahliBil)){
            redirect(base_url());
        }
        $this->load->model('ahli_model');
        $this->ahli_model->kemaskini();
        $ahli_bil = $this->input->post('input_ahli_bil');
        redirect('ahli/id/'.$ahli_bil, 'refresh');
    }

    public function index()
    {
        redirect(base_url());
    }

    public function daftar()
    {   

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('ahli_model');
        

        $data['title'] = 'Daftar Calon';

        $this->form_validation->set_rules('ahli_nama', 'Nama Calon', 'required');
        $this->form_validation->set_rules('ahli_umur', 'Umur Calon', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->model('parti_model');
            $data['senarai_parti'] = $this->parti_model->papar_semua();
            

            $this->load->view('susunletak/atas', $data);
            $this->load->view('calonpru/daftar', $data);
            $this->load->view('susunletak/bawah');

        }
        else
        {
            $insert = $this->ahli_model->daftar();
            $data['data_parti'] = $this->ahli_model->papar($insert['last_id']);
            $data['daftar'] = $this->load->view('calonpru/daftar', $data, TRUE);
            $data['title'] = 'Daftar Parti';
            $this->load->view('calonpru/berjaya');
        }
    }

    public function daftar_calon($dun_bil){
        $peranan = $this->session->userdata('peranan');
        if(empty($peranan)){
            redirect(base_url());
        }
        $peranan = strtoupper($this->session->userdata('peranan'));
        $this->load->model('pilihanraya_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['dun_bil'] = $dun_bil;
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('ahli_model');
        $this->load->model('pencalonan_model');
        $this->load->model('dun_model');
        $data['dun'] = $this->dun_model->papar($dun_bil);
        

        $data['title'] = 'Daftar Pencalonan';

        $this->form_validation->set_rules('ahli_nama', 'Nama Calon', 'required');
        $this->form_validation->set_rules('ahli_umur', 'Umur Calon', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->model('parti_model');
            $data['senarai_parti'] = $this->parti_model->papar_semua();
            
            switch($peranan){
                case "PEGAWAI LAPANGAN" : 
                    $tmp_dun_bil = $this->input->post('dun_bil');
                    $tmp_parti_bil = $this->input->post('parti_bil');
                    if(empty($tmp_dun_bil) && $tmp_parti_bil){
                        redirect(base_url());
                    }else{
                        $data['list_data']['dun_bil'] = $this->input->post('dun_bil');
                        $data['list_data']['parti_bil'] = $this->input->post('parti_bil');
                    }
                    $this->load->model('pengguna_model');
                    $data['maklumat_pengguna'] = $this->pengguna_model->maklumat_pengguna($this->session->userdata('pengguna_bil'));
                    $this->load->view('calonpru/atas', $data);
                    $this->load->view('calonpru/daftar');
                    $this->load->view('parti/bawah');
                    break;
                
                default:
                $this->load->view('susunletak/atas', $data);
                $this->load->view('calonpru/daftar', $data);
                $this->load->view('susunletak/bawah');
            }

        }
        else
        {
            date_default_timezone_set('Asia/Kuala_Lumpur');
            $this->load->model('status_grading_model');
            $this->load->model('harian_model');
            $insert = $this->ahli_model->daftar();
            $pencalonan_insert = $this->pencalonan_model->daftar($insert['last_id']);
            $data['data_calon'] = $this->pencalonan_model->papar($pencalonan_insert['last_id']);
            foreach($data['data_calon'] as $c){
                $dun_bil = $c->pencalonan_dun;
            }
            $senaraiPilihanraya = $data['pilihanraya'];
            foreach($senaraiPilihanraya as $pr)
            { 
                $tarikhMula = new DateTime($pr->pilihanraya_penamaan_calon);
                $tarikhTamat = new DateTime($pr->pilihanraya_lock_status);
            }
            for($i = $tarikhMula; $i <= $tarikhTamat; $i->modify('+1 day')){
                $peratus = 0;
                $statusCreated = $this->status_grading_model->cipta(
                    $pencalonan_insert['last_id'],
                    $peratus,
                    $i->format("Y-m-d")
                );
                $senaraiHarian = $this->harian_model->calibrate($pilihanraya_bil, $dun_bil, $i->format("Y-m-d"));
            }
            redirect('dun/papar_dun/'.$dun_bil);
        }
    }

    public function id($ahli_bil){
        $this->load->model('pilihanraya_model');
        $this->load->model('ahli_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('pencalonan_model');
        $this->load->model('parti_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['senarai_ahli'] = $this->ahli_model->papar($ahli_bil);
        $data['senarai_parti_ahli'] = $this->ahli_model->parti_ahli($ahli_bil);
        $data['senarai_pilihanraya'] = $this->ahli_model->pilihanraya_ahli($ahli_bil);
        $data['pilihanraya_parlimen_aktif'] = $this->pencalonan_parlimen_model->pr_ahli_aktif($ahli_bil);
        $data['pilihanraya_dun_aktif'] = $this->pencalonan_model->pr_ahli_aktif($ahli_bil);
        $data['senarai_parti'] = $this->parti_model->senarai();
        $this->load->view('susunletak/atas', $data);
        $this->load->view('calonpru/papar_ahli');
        $this->load->view('susunletak/bawah');
    }

    public function tambah_gambar($ahli_bil){
        
    }

    public function daftar_parlimen()
    {
        $this->load->model('parlimen_model');
        $this->load->model('parti_model');
        $parlimenID = $this->input->post('inputParlimenBil');
        $data['senaraiParlimen'] = $this->parlimen_model->parlimen($parlimenID);
        $partiID = $this->input->post('inputPartiBil');
        $data['senaraiParti'] = $this->parti_model->papar($partiID);
        $this->load->view('pegawai_lapangan/atas', $data);
        $this->load->view('calonpru/daftar_parlimen');
        $this->load->view('pegawai_lapangan/bawah');
    }



}