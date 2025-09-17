<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Japen extends CI_Controller {

    public function padamOrganisasi($organisasiBil){
        if(empty($organisasiBil)){
            redirect(base_url());
        }
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $this->load->library("form_validation");
        $this->load->model("japen_model");
        $this->form_validation->set_rules('inputOrganisasiBil', 'Organisasi', 'required');
        $data['organisasi'] = $this->japen_model->organisasiBil($organisasiBil);
        if($this->form_validation->run() !== FALSE){
            $inputOrganisasiBil = $this->input->post("inputOrganisasiBil");
            $inputPerananBil = $this->input->post("inputPerananBil");
            $organisasi = $this->japen_model->organisasiBil($inputOrganisasiBil);
            if($organisasi){
                $this->japen_model->padamOrganisasi($organisasi->organisasiBil);
                redirect("japen/perananBil/".$inputPerananBil);

            }
        }
        $data['gunaView'] = "japen/padamOrganisasi";
        $this->load->view("baseTemplate", $data);
    }

    public function tambahMaklumatPerananBil($perananBil){
        if(empty($perananBil)){
            redirect(base_url());
        }
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $this->load->library("form_validation");
        $this->load->model("japen_model");
        $data['organisasi'] = $this->japen_model->perananBil($perananBil);
        $this->form_validation->set_rules('inputJapenNama', 'Nama Organisasi', 'required');
        if($this->form_validation->run() !== FALSE){
            $inputJapenNama = $this->input->post("inputJapenNama");
            $inputPerananBil = $this->input->post("inputPerananBil");
            $inputPenggunaBil = $this->input->post("inputPenggunaBil");
            $inputPenggunaWaktu = $this->input->post("inputPenggunaWaktu");
            $tempJapen = $this->japen_model->semakJapenNama($inputJapenNama);
            if($tempJapen){
                $inputJapenBil = $tempJapen->japenBil;
            }else{
                $entriJapen = $this->japen_model->tambahBaharu($inputJapenNama, $inputPenggunaBil);
                $inputJapenBil = $entriJapen;
            }
            $tempOrganisasi = $this->japen_model->semakOrganisasiPerananBil($inputJapenBil, $inputPerananBil);
            if(empty($tempOrganisasi)){
                $this->japen_model->tambahOrganisasiPeranan($inputJapenBil, $inputPerananBil, $inputPenggunaBil, $inputPenggunaWaktu);
            }
            redirect("japen/perananBil/".$perananBil);
        }
        $data['gunaView'] = "japen/tambahMaklumatPerananBil";
        $this->load->view("baseTemplate", $data);
    }

    public function perananBil($perananBil){
        if(empty($perananBil)){
            redirect(base_url());
        }
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $this->load->model("japen_model");
        $data['peranan'] = $this->japen_model->perananBil($perananBil);
        $data['senaraiOrganisasi'] = $this->japen_model->senaraiOrganisasiPerananBil($perananBil);
        $data['gunaView'] = "peranan/perananJapen";
        $this->load->view("baseTemplate", $data);
    }

    public function organisasi(){
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $this->load->model("japen_model");
        $data["senaraiOrganisasi"] = $this->japen_model->rumusanOrganisasi();
        $data['gunaView'] = "japen/organisasi";
        $this->load->view("baseTemplate", $data);
    }

    private function sesi(){
        $sesi = strtoupper($this->session->userdata("peranan"));
        switch($sesi){
            case "URUSETIA" : 
            case "ADMIN" : 
                break;
            default : 
                redirect(base_url());
        }
        return $sesi;
    }

    public function pilihan_calon_dun()
    {
        $calon_bil = $this->input->post('input_calon_bil');
        $dun_bil = $this->input->post('input_dun_bil');
        if(empty($calon_bil)){
            redirect(base_url());
        }
        if(empty($dun_bil)){
            redirect(base_url());
        }
        $this->load->model('pencalonan_model');
        $this->pencalonan_model->pilih_jangkaan();
        redirect('perumus/maklumat_dun/'.$dun_bil);
    }

    public function set_semula_dun()
    {
        $dun_bil = $this->input->post('input_dun_bil');
        $pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
        if(empty($dun_bil)){
            redirect(base_url());
        }
        if(empty($pilihanraya_bil)){
            redirect(base_url());
        }
        $this->load->model('pencalonan_model');
        $this->pencalonan_model->kosongkan_jangkaan();
        redirect('perumus/maklumat_dun/'.$dun_bil);
    }

    public function pilihan_calon_parlimen()
    {
        $calon_bil = $this->input->post('input_calon_bil');
        $parlimen_bil = $this->input->post('input_parlimen_bil');
        if(empty($calon_bil)){
            redirect(base_url());
        }
        if(empty($parlimen_bil)){
            redirect(base_url());
        }
        $this->load->model('pencalonan_parlimen_model');
        $this->pencalonan_parlimen_model->pilih_jangkaan();
        redirect('perumus/maklumat_parlimen/'.$parlimen_bil);
    }

    public function set_semula_parlimen()
    {
        $parlimen_bil = $this->input->post('input_parlimen_bil');
        $pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
        if(empty($parlimen_bil)){
            redirect(base_url());
        }
        if(empty($pilihanraya_bil)){
            redirect(base_url());
        }
        $this->load->model('pencalonan_parlimen_model');
        $this->pencalonan_parlimen_model->kosongkan_jangkaan();
        redirect('perumus/maklumat_parlimen/'.$parlimen_bil);
    }

    public function tukar()
    {
        $this->load->model('harian_parlimen_model');
        $jangkaan_keluar = $this->input->post('input_jangkaan_keluar_mengundi');
        $this->harian_parlimen_model->tukar_jangkaan($jangkaan_keluar);
        echo anchor(base_url(), 'DONE');
    }

    public function senarai_pengguna_rims(){
        $this->load->model('pengguna_model');
        $data['senarai_pengguna'] = $this->pengguna_model->papar_semua();
        $this->load->view('susunletak/atas', $data);
        $this->load->view('japen/link');
        $this->load->view('japen/pengguna');
        $this->load->view('susunletak/bawah');
    }

    private function template($sesi){
        switch($sesi){
            case "URUSETIA":
                $view = "urusetia_na";
                break;
            default:
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


    public function index()
	{
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $this->load->model('japen_model');
        $data['senaraiPejabat'] = $this->japen_model->senaraiJapen();
        $data['gunaView'] = "japen/utama";
        $this->load->view("baseTemplate", $data);
	}

    public function tambah()
    {
        $this->load->library('form_validation');
        $this->load->model('japen_model');
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
        $data['senaraiPejabat'] = $this->japen_model->senaraiJapen();
		$this->load->view('susunletak/atas', $data);
		$this->load->view('japen/tambah');
		$this->load->view('susunletak/bawah');
    }

    public function proses_tambah()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('inputPejabat', 'Bahagian / Negeri', 'required|is_unique[japen_tb.jt_pejabat]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-warning w-100">', '</div>');
        if($this->form_validation->run() === FALSE)
        {
            $this->tambah();
        }else{
            $this->load->model('japen_model');
            $this->japen_model->tambah();
            $this->load->view('susunletak/atas');
            $this->load->view('japen/tambah_berjaya');
            $this->load->view('susunletak/bawah');
        } 
    }

    public function kemaskini($japen_bil)
    {
        $this->load->library('form_validation');
        $this->load->model('japen_model');
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
        $data['japen'] = $this->japen_model->japen($japen_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('japen/kemaskini');
        $this->load->view('susunletak/bawah');
    }

    public function proses_kemaskini()
    {
        $this->load->library('form_validation');
        $this->load->model('japen_model');
        $this->form_validation->set_rules('inputPejabat', 'Bahagian / Negeri', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-warning w-100">', '</div>');
        $japen_bil = $this->input->post('inputJapenBil');
        if($this->form_validation->run() === FALSE)
        {
            $this->kemaskini($japen_bil);
        }else{
            $this->load->model('japen_model');
            $this->japen_model->kemaskini();
            $this->kemaskini($japen_bil);
        } 
    }

    public function proses_padam()
    {
        $this->load->model('japen_model');
        $this->japen_model->padam();
        $this->load->view('susunletak/atas');
        $this->load->view('japen/padam_berjaya');
        $this->load->view('susunletak/bawah');
    }

    public function padam($japen_bil)
    {
        $this->load->model('japen_model');
        $data['japen'] = $this->japen_model->japen($japen_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('japen/padam');
        $this->load->view('susunletak/bawah');
    }

    public function susun_sempadan_parlimen()
    {
        $this->load->model('peranan_model');
        $this->load->model('parlimen_model');
        $negeri = $this->session->userdata('negeri');
        $data['senarai_peranan'] = $this->peranan_model->senarai_peranan();
        $data['senarai_parlimen'] = $this->parlimen_model->paparIkutNegeri($negeri);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('tugasan/parlimen');
        $this->load->view('susunletak/bawah');
    }

    public function proses_sempadan_parlimen()
    {
        $tmp_peranan = $this->input->post('input_peranan_bil');
        if($tmp_peranan == ""){
            redirect(base_url());
        }
        $this->load->model('japen_model');
        $pengguna_bil = $this->session->userdata('pengguna_bil');
        $tmp_parlimen = $this->input->post('input_parlimen');
        if(!empty($tmp_parlimen))
        {  
            $bil = count($tmp_parlimen);
            for($i = 0; $i < $bil; $i++){
                $waktu = date('Y-m-d H:i:s');
                $ada = $this->japen_model->semak_tugas_parlimen($tmp_parlimen[$i]);
                if(empty($ada)){
                    $this->japen_model->tugasan_parlimen($tmp_peranan, $tmp_parlimen[$i], $waktu, $pengguna_bil);            
                }
            }
            redirect(base_url());
        }else{
            redirect(base_url());
        }
    }

    public function susun_sempadan_dun()
    {
        $this->load->model('peranan_model');
        $this->load->model('dun_model');
        $negeri = $this->session->userdata('negeri');
        $data['senarai_peranan'] = $this->peranan_model->senarai_peranan();
        $data['senarai_dun'] = $this->dun_model->ikut_negeri($negeri);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('tugasan/dun');
        $this->load->view('susunletak/bawah');
    }

    public function proses_sempadan_dun()
    {
        $tmp_peranan = $this->input->post('input_peranan_bil');
        if($tmp_peranan == ""){
            redirect(base_url());
        }
        $this->load->model('japen_model');
        $pengguna_bil = $this->session->userdata('pengguna_bil');
        $tmp_dun = $this->input->post('input_dun');
        if(!empty($tmp_dun))
        {  
            $bil = count($tmp_dun);
            for($i = 0; $i < $bil; $i++){
                $waktu = date('Y-m-d H:i:s');
                $ada = $this->japen_model->semak_tugas_dun($tmp_dun[$i]);
                if(!$ada){
                    $this->japen_model->tugasan_dun($tmp_peranan, $tmp_dun[$i], $waktu, $pengguna_bil);
                }
            }
            redirect(base_url());
        }else{
            redirect(base_url());
        }
    }

    public function gugur()
    {
        $tmp_bil = $this->input->post('input_tugas_parlimen_bil');
        if(empty($tmp_bil)){
            redirect(base_url());
        }
        $this->load->model('japen_model');
        $this->japen_model->ubah_tugas_parlimen();
        redirect(base_url());
    }

    public function gugur_dun()
    {
        $tmp_bil = $this->input->post('input_tugas_dun_bil');
        if(empty($tmp_bil)){
            redirect(base_url());
        }
        $this->load->model('japen_model');
        $this->japen_model->ubah_tugas_dun();
        redirect(base_url());
    }

}