<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parlimen extends CI_Controller {

    public function bil($parlimenBil){
        $this->load->model('parlimen_model');
        $data['parlimen'] = $this->parlimen_model->parlimen2($parlimenBil);
        if(empty($data['parlimen'])){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($data['pengguna'])){
            redirect(base_url());
        }
        switch($sesi){
            case 'URUSETIA' :
                $data['header'] = 'urusetia_na/susunletak/atas';
                $data['sidebar'] = 'urusetia_na/susunletak/sidebar';
                $data['navbar'] = 'urusetia_na/susunletak/navbar';
                $data['footer'] = 'urusetia_na/susunletak/bawah';
                $this->load->view('parlimen/parlimen', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function negeri($negeriBil){
        $this->load->model('negeri_model');
        $data['negeri'] = $this->negeri_model->negeri($negeriBil);
        if(empty($data['negeri'])){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($data['pengguna'])){
            redirect(base_url());
        }
        $this->load->model('parlimen_model');
        switch($sesi){
            case 'URUSETIA' :
                $data['parlimenSenarai'] = $this->parlimen_model->parlimenNegeriSenarai($negeriBil);
                $data['header'] = 'urusetia_na/susunletak/atas';
                $data['sidebar'] = 'urusetia_na/susunletak/sidebar';
                $data['navbar'] = 'urusetia_na/susunletak/navbar';
                $data['footer'] = 'urusetia_na/susunletak/bawah';
                $this->load->view('parlimen/parlimenNegeriSenarai', $data);
                break;
            default :
                redirect(base_url());
        }
    }

	public function index()
	{
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('negeri_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $this->load->model('parlimen_model');
                $data['header'] = 'negeri_na/susunletak/atas';
                $data['sidebar'] = 'negeri_na/susunletak/sidebar';
                $data['navbar'] = 'negeri_na/susunletak/navbar';
                $data['footer'] = 'negeri_na/susunletak/bawah';
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiParlimen'] = $this->parlimen_model->senaraiParlimenNegeri($senaraiNegeri);
                $this->load->view('parlimen/utamaNegeri', $data);
                break;
            case 'URUSETIA' :
                $data['negeriParlimenSenarai'] = $this->negeri_model->bilanganParlimenSenarai();
                $data['header'] = 'urusetia_na/susunletak/atas';
                $data['sidebar'] = 'urusetia_na/susunletak/sidebar';
                $data['navbar'] = 'urusetia_na/susunletak/navbar';
                $data['footer'] = 'urusetia_na/susunletak/bawah';
                $this->load->view('parlimen/utama', $data);
                break;
            default :
                redirect(base_url());
        }
        
	}

    public function daftar()
    {
        $this->load->library('form_validation');
        $data['senaraiNegeri'] = array(
            'Perlis',
            'Kedah',
            'Kelantan',
            'Terengganu',
            'Pulau Pinang',
            'Perak',
            'Pahang',
            'Selangor',
            'Wilayah Persekutuan Kuala Lumpur',
            'Wilayah Persekutuan Putrajaya',
            'Negeri Sembilan',
            'Melaka',
            'Johor',
            'Wilayah Persekutuan Labuan',
            'Sabah',
            'Sarawak'
        );
        $this->load->model('parlimen_model');
        $data['parlimen'] = $this->parlimen_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('parlimen/daftar');
        $this->load->view('susunletak/bawah');
    }

    public function proses_daftar()
    {
        $this->load->library('form_validation');
        $this->load->model('parlimen_model');
        $this->form_validation->set_rules('inputParlimenNama', 'Nama Parlimen', 'required', array(
            "required" => "<div class='alert alert-warning'>Sila masukkan nama parlimen.</div>"
        ));
        if($this->form_validation->run() === FALSE)
        {
            $this->daftar();
        }
        else{
            $parlimenBaru = $this->parlimen_model->daftar();
            $data['parlimenBaru'] = $this->parlimen_model->parlimen($parlimenBaru['last_id']);
            $data['senaraiNegeri'] = array(
                'Perlis',
                'Kedah',
                'Kelantan',
                'Terengganu',
                'Pulau Pinang',
                'Perak',
                'Pahang',
                'Selangor',
                'Wilayah Persekutuan Kuala Lumpur',
                'Wilayah Persekutuan Putrajaya',
                'Negeri Sembilan',
                'Melaka',
                'Johor',
                'Wilayah Persekutuan Labuan',
                'Sabah',
                'Sarawak'
            );
            $data['parlimen'] = $this->parlimen_model;
            $this->load->view('susunletak/atas', $data);
            $this->load->view('urusetia/urusetia_nav');
            $this->load->view('parlimen/berjaya');
            $this->load->view('parlimen/daftar');
            $this->load->view('susunletak/bawah');
        }
    }

    public function senarai()
    {
        $this->load->model('parlimen_model');
        $data['parlimen'] = $this->parlimen_model;
        $data['senaraiNegeri'] = array(
            'Perlis',
            'Kedah',
            'Kelantan',
            'Terengganu',
            'Pulau Pinang',
            'Perak',
            'Pahang',
            'Selangor',
            'Wilayah Persekutuan Kuala Lumpur',
            'Wilayah Persekutuan Putrajaya',
            'Negeri Sembilan',
            'Melaka',
            'Johor',
            'Wilayah Persekutuan Labuan',
            'Sabah',
            'Sarawak'
        );
        $this->load->view('susunletak/atas', $data);
        $this->load->view('parlimen/senarai');
        $this->load->view('susunletak/bawah');
    }

    public function padam()
    {
        $parlimenID = $this->input->post('inputParlimenBil');
        $penggunaID = $this->input->post('inputPenggunaBil');
        $this->load->model('parlimen_model');
        $this->parlimen_model->padam($parlimenID);
        $this->senarai();
    }

    public function kemaskini($id)
    {
        $this->load->model('parlimen_model');
        $data['parlimen'] = $this->parlimen_model->parlimen($id);
        $data['senaraiNegeri'] = array(
            'Perlis',
            'Kedah',
            'Kelantan',
            'Terengganu',
            'Pulau Pinang',
            'Perak',
            'Pahang',
            'Selangor',
            'Wilayah Persekutuan Kuala Lumpur',
            'Wilayah Persekutuan Putrajaya',
            'Negeri Sembilan',
            'Melaka',
            'Johor',
            'Wilayah Persekutuan Labuan',
            'Sabah',
            'Sarawak'
        );
        $this->load->view('susunletak/atas', $data);
        $this->load->view('parlimen/kemaskini');
        $this->load->view('susunletak/bawah');
    }

    public function proses_kemaskini()
    {
        $parlimenID = $this->input->post('inputParlimenBil');
        $this->load->library('form_validation');
        $this->load->model('parlimen_model');
        $this->form_validation->set_rules('inputParlimenNama', 'Nama Parlimen', 'required', array(
            "required" => "<div class='alert alert-warning'>Sila masukkan nama parlimen.</div>"
        ));
        if($this->form_validation->run() === FALSE)
        {
            $this->kemaskini($parlimenID);
        }
        else{
            $this->parlimen_model->kemaskini($parlimenID);
            $this->kemaskini($parlimenID);
        }
    }

    public function papar_parlimen($id)
    {  
        $this->load->model('parlimen_model');
        $this->load->model('pengundi_parlimen_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('ahli_model');
        $this->load->model('parti_model');
        $this->load->model('harian_parlimen_model');
        $this->load->model('winnable_candidate_parlimen_model');
        $this->load->model('foto_model');
        $this->load->model('pilihanraya_model');
        $data['data_foto'] = $this->foto_model;
        $data['data_wc'] = $this->winnable_candidate_parlimen_model;
        $data['data_grading'] = $this->harian_parlimen_model;
        $data['parlimen'] = $this->parlimen_model->parlimen($id);
        $data['pilihanraya_singkatan'] = $this->session->userdata('pilihanraya_singkatan');
        $data['pilihanrayaBil'] = $this->session->userdata('pilihanraya_bil');
        $data['data_pru'] = $this->pilihanraya_model;
        $data['negeri_bil'] = $this->session->userdata('negeri_bil');
        $data['negeri_nama'] = $this->session->userdata('negeri_nama');
        $data['pengundiParlimen'] = $this->pengundi_parlimen_model;
        $data['maklumatCalon'] = $this->pencalonan_parlimen_model;
        $data['dataAhli'] = $this->ahli_model;
        $data['dataParti'] = $this->parti_model;
        $this->load->view('pegawai_lapangan/atas', $data);
		$this->load->view('pegawai_lapangan/parlimen');
		$this->load->view('pegawai_lapangan/bawah');
    }

    public function keluar_mengundi()
    {
        $parlimenID = $this->input->post('inputParlimenBil');
        if($this->input->post('inputJumlahPengundi') == 0){
            $this->papar_parlimen($parlimenID);
        }else{
            $this->load->model('pengundi_parlimen_model');
            $lastID = $this->pengundi_parlimen_model->daftar();
            $this->papar_parlimen($parlimenID);
        }
    }

    public function kemaskini_pengundi()
    {
        $parlimenID = $this->input->post('inputParlimenBil');
        $this->load->model('pengundi_parlimen_model');
        $this->pengundi_parlimen_model->setJumlahPengundi();
        $this->papar_parlimen($parlimenID);
    }

    public function padam_calon()
    {
        $parlimenID = $this->input->post('inputParlimenBil');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('ahli_model');
        $this->pencalonan_parlimen_model->padam();
        $this->ahli_model->padam($this->input->post('inputCalonAhliBil'));
        $this->papar_parlimen($parlimenID);
    }

    public function dm($parlimen_bil)
    {
        $this->load->library('form_validation');
        $this->load->model('parlimen_model');
        $this->load->model('pdm_model');
        $this->load->model('japen_model');
        $this->load->model('pengguna_model');
        $data['data_pdm'] = $this->pdm_model;
        $data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimen_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('pdm/parlimen');
        $this->load->view('susunletak/bawah');
    }

    public function tambah_dm(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'PPD' :
                $this->load->model('parlimen_model');
                $this->load->model('pdm_model');
                $data['data_pdm'] = $this->pdm_model;
                $data['senarai_parlimen'] = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $this->load->view('sismap/dm/tambahDm', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function tambah_dm2()
    {
        $this->load->library('form_validation');
        $this->load->model('parlimen_model');
        $this->load->model('pdm_model');
        $this->load->model('japen_model');
        $this->load->model('pengguna_model');
        $data['data_pdm'] = $this->pdm_model;
        $data['senarai_parlimen'] = $this->parlimen_model->semuaParlimen();
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, 'PPD') !== FALSE){

            $data['senarai_parlimen'] = $this->japen_model->senarai_tugas_parlimen($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
        }
        $this->load->view('susunletak/atas', $data);
        $this->load->view('pdm/tambah');
        $this->load->view('susunletak/bawah');
    }

    public function proses_tambah_dm()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_nama_dm', 'Daerah Mengundi', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila penuhi ruangan {field}');
        if($this->form_validation->run() === FALSE)
        {
            if(strpos($sesi, "NEGERI") !== FALSE || strpos($sesi, "PPD") !== FALSE){
                $this->tambah_dm();
            }else{
                $parlimen_bil = $this->input->post('input_parlimen_bil');
                $this->dm($parlimen_bil);
            }
        }else{
            $this->load->model('pdm_model');
            $tmp_nama_pdm = $this->input->post('input_nama_dm');
            $tmp_parlimen_bil = $this->input->post('input_parlimen_bil');
            $tmp_bilangan_pengundi = $this->input->post('input_bilangan_pengundi');
            $ada = $this->pdm_model->semak_pdm_parlimen($tmp_parlimen_bil, $tmp_nama_pdm);
            if(empty($ada)){
                $this->pdm_model->tambah_pdm_parlimen($tmp_nama_pdm, $tmp_parlimen_bil, $tmp_bilangan_pengundi);
            }   
            if(strpos($sesi, "NEGERI") !== FALSE || strpos($sesi, "PPD") !== FALSE){
                redirect('parlimen/tambah_dm', 'refresh');
            }else{
                $parlimen_bil = $this->input->post('input_parlimen_bil');
                redirect('parlimen/dm/'.$parlimen_bil, 'refresh');
            }
        }
    }

    public function proses_kemaskini_pdm()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_nama_dm', 'Daerah Mengundi', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila penuhi ruangan {field}');
        if($this->form_validation->run() === FALSE){
            if(strpos($sesi, "NEGERI") !== FALSE || strpos($sesi, "PPD") !== FALSE){
                $this->tambah_dm();
            }else{
                $parlimen_bil = $this->input->post('input_parlimen_bil');
                $this->dm($parlimen_bil);
            }
        }
        else
        {
            $this->load->model('pdm_model');
            $tmp_nama_pdm = $this->input->post('input_nama_dm');
            $tmp_pdm_bil = $this->input->post('input_dm_bil');
            $tmp_bilangan_pengundi = $this->input->post('input_bilangan_pengundi');
            $this->pdm_model->kemaskini($tmp_pdm_bil, $tmp_nama_pdm, $tmp_bilangan_pengundi);
            if(strpos($sesi, "NEGERI") !== FALSE || strpos($sesi, "PPD") !== FALSE){
                redirect('parlimen/tambah_dm', 'refresh');
            }else{
                $parlimen_bil = $this->input->post('input_parlimen_bil');
                redirect('parlimen/dm/'.$parlimen_bil, 'refresh');
            }
        }
    }

    public function proses_padam_pdm()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_dm_bil', 'ID Daerah Mengundi', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Tiada maklumat {field}. SILA LOGIN SEMULA.');
        if($this->form_validation->run() === FALSE){
            if(strpos($sesi, "NEGERI") !== FALSE || strpos($sesi, "PPD") !== FALSE){
                $this->tambah_dm();
            }else{
                $parlimen_bil = $this->input->post('input_parlimen_bil');
                redirect('parlimen/dm/'.$parlimen_bil, 'refresh');
            }
        }
        else
        {
            $this->load->model('pdm_model');
            $tmp_pdm_bil = $this->input->post('input_dm_bil');
            $this->pdm_model->padam($tmp_pdm_bil);
            if(strpos($sesi, "NEGERI") !== FALSE || strpos($sesi, "PPD") !== FALSE){
                redirect('parlimen/tambah_dm', 'refresh');
            }else{
                $parlimen_bil = $this->input->post('input_parlimen_bil');
                redirect('parlimen/dm/'.$parlimen_bil, 'refresh');
            }
        }
    }

}