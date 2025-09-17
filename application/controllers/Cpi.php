<?php

class Cpi extends CI_Controller {

    //PRIVATE FUNCTION

    private function templates($sesi){
        $templates = [
            "header" => $sesi."/susunletak/atas",
            "sidebar" => $sesi."/susunletak/sidebar",
            "navbar" => $sesi."/susunletak/navbar",
            "footer" => $sesi."/susunletak/bawah"
        ];
        return $templates;
    }

    private function pengguna(){
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(empty($penggunaBil)){
            redirect(base_url());
        }
        $this->load->model("pengguna_model");
        $pengguna = $this->pengguna_model->pengguna($penggunaBil);
        return $pengguna;
    }

    private function sesi(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(empty($sesi)){
            redirect(base_url());
        }
        switch($sesi){
            case "URUSETIA" : 
                $sesi = "urusetia_na";
                break;
            case "LAPIS":
                $sesi = 'us_lapis_na';
                break;
            default :
                redirect(base_url());
        }
        return $sesi;
    }

    //PUBLIC FUNCTION

    public function lapis2(){
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();

        switch($sesi){
            case "us_lapis_na" :
            case "urusetia_na" :
                redirect("lapis2");
                break;
        }

        redirect(base_url());
    }

    public function padamKategori(){
        
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        
        //ACCORDINGLY
        switch($sesi){
            case 'LAPIS' :
                //LOAD MODEL
                $this->load->model('lapis_kategori_model');
                //LOAD FUNCTION
                $this->lapis_kategori_model->padamKlusterIsu();
                redirect('cpi/senarai');
                break;
            default :
                redirect(base_url());
        }
    }

    public function prosesKemaskiniKategori(){
        
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $bil = $this->input->post('inputBil');
        if(empty($bil)){
            redirect(base_url());
        }
        
        //ACCORDINGLY
        switch($sesi){
            case 'LAPIS' :
                //LOAD MODEL
                $this->load->model('lapis_kategori_model');
                //LOAD FUNCTION
                $this->lapis_kategori_model->kemaskiniSenarai();
                redirect('cpi/kemaskiniKategoriIsu/'.$bil);
                break;
            default :
                redirect(base_url());
        }
    }

    public function kemaskiniKategoriIsu($kategoriBil){
        //CHECK IF NOT EMPTY PARAMETERS
        if(empty($kategoriBil)){
            redirect(base_url());
        }

        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');
        $this->load->model('lapis_kategori_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['kategori'] = $this->lapis_kategori_model->kategori($kategoriBil);

        //CHECK IF EXISTS
        if(empty($data['kategori'])){
            redirect(base_url());
        }

        //ACCORDINGLY
        switch($sesi){
            case 'LAPIS' :
                //LOAD VIEW
                $this->load->view('us_lapis_na/konfigurasi/kemaskiniKategori', $data);
                break;
            default : 
                redirect(base_url());
        }
    }

    public function prosesTambahKategori(){
        //INTIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));

        //GET IMPORTANT VALUES
        $klusterBil = $this->input->post('inputKlusterBil');
        $namaKategoriIsu = $this->input->post('inputNama');

        //ACCORDINGLY
        switch($sesi){
            case 'LAPIS' :
                $this->load->library('form_validation');
                $this->form_validation->set_rules('inputNama', 'Nama Kategori Isu', 'required');
                if($this->form_validation->run() == FALSE){
                    redirect('cpi/tambahKategori/'.$klusterBil, 'refresh');
                }else{
                    $this->load->model('lapis_kategori_model');
                    $kategori = $this->lapis_kategori_model->semakanNama($namaKategoriIsu, $klusterBil);
                    if(empty($kategori)){
                        $this->lapis_kategori_model->tambahPost();
                    }
                    redirect('cpi/senaraiKategori/'.$klusterBil, 'refresh');
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function tambahKategori($klusterBil){
        
        //CHECK NOT EMPTY PARAMETERS
        if(empty($klusterBil)){
            redirect(base_url());
        }

        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');
        $this->load->model('kluster_isu_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['kluster'] = $this->kluster_isu_model->papar($klusterBil);

        //CHECK VALUES NOT EMPTY
        if(empty($data['kluster'])){
            redirect(base_url());
        }

        if(empty($data['pengguna'])){
            redirect(base_url());
        }

        //ACCORDINGLY
        switch($sesi){
            case 'LAPIS' :
                //LOAD VIEW
                $this->load->view('us_lapis_na/konfigurasi/tambahKategori', $data);
                break;
            default :
                redirect(base_url());
        }

    }

    public function senaraiKategori($klusterBil){

        //CHECK NOT EMTPY PARAMETERS
        if(empty($klusterBil)){
            redirect(base_url());
        }

        //INTIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');
        $this->load->model('kluster_isu_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['kluster'] = $this->kluster_isu_model->papar($klusterBil);


        //ACCORDINGLY
        switch($sesi){
            case 'LAPIS' :
                //LOAD MODEL
                $this->load->model('lapis_kategori_model');

                //LOAD DATA
                $data['senaraiKategori'] = $this->lapis_kategori_model->senaraiIkutKluster($klusterBil);

                //LOAD VIEW
                $this->load->view('us_lapis_na/konfigurasi/senaraiKategoriIsu', $data);
                break;
            default : 
                redirect(base_url());
        }
    }

    public function analisis()
    {
        $this->load->model('kluster_isu_model');
        $this->load->model('pengguna_model');
        $this->load->model('negeri_model');
        $data['senarai_negeri'] = $this->negeri_model->senarai();
        $data['senarai_pelapor'] = $this->pengguna_model->senarai_penuh_pelapor();
        $data['senarai_kluster'] = $this->kluster_isu_model->senarai();
        $data['data_kluster'] = $this->kluster_isu_model;
        $data['data_pengguna'] = $this->pengguna_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('cpi/analisis/utama');
        $this->load->view('susunletak/bawah');
    }

    public function proses_kemaskini_ki()
    {
        $bil = $this->input->post('input_bil');
        if(empty($bil)){
            redirect(base_url());
        }
        $this->load->model('kluster_isu_model');
        $this->kluster_isu_model->kemaskini();
        redirect('cpi/senarai_kluster_isu', 'refresh');
    }

    public function kemaskini_kluster($bil)
    {
        if(empty($bil)){
            redirect(base_url());
        }
        $this->load->model('kluster_isu_model');
        $data['kluster_isu'] = $this->kluster_isu_model->papar($bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('cpi/kluster_isu/kemaskini_ki');
        $this->load->view('susunletak/bawah');
    }

    public function padam_ki()
    {
        $bil = $this->input->post('input_bil');
        if(empty($bil)){
            redirect(base_url());
        }
        $this->load->model('kluster_isu_model');
        $this->kluster_isu_model->padam_ki();
        redirect('cpi/senarai_kluster_isu', 'refresh');
    }

    public function padam_kluster($bil)
    {
        $this->load->model('kluster_isu_model');
        $data['kluster_isu'] = $this->kluster_isu_model->papar($bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('cpi/kluster_isu/verify_padam');
        $this->load->view('susunletak/bawah');
    }

    public function proses_tambah_kluster_isu()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_nama', 'Nama Kluster Isu', 'required');
        $this->form_validation->set_rules('input_shortform', 'Nama Singkatan Kluster Isu', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila penuhkan maklumat di ruangan {field}');
        if($this->form_validation->run() === FALSE)
        {
            $this->tambah_kluster_isu();
        }
        else
        {
            $this->load->model('kluster_isu_model');
            $this->kluster_isu_model->tambah_kluster_isu();
            $this->senarai_kluster_isu();       
        }
    }

    public function tambah_kluster_isu()
    {
        $this->load->library('form_validation');
        $this->load->view('susunletak/atas');
        $this->load->view('cpi/kluster_isu/tambah');
        $this->load->view('susunletak/bawah');
    }

    public function senarai_kluster_isu()
    {
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        //ACCORDINGLY
        switch($sesi){
            case 'LAPIS2' :
                $this->load->model('kluster_isu_model');
                $data['senarai_kluster_isu'] = $this->kluster_isu_model->senarai();
                $this->load->view('susunletak/atas', $data);
                $this->load->view('cpi/kluster_isu/senarai');
                $this->load->view('susunletak/bawah');
                break;
            case 'LAPIS' : 
                //LOAD MODEL
                $this->load->model('kluster_isu_model');

                //LOAD DATA
                $data['senarai_kluster_isu'] = $this->kluster_isu_model->senarai();

                //LOAD VIEW
                $this->load->view('us_lapis_na/konfigurasi/senaraiKlusterIsu', $data);
                break;
            default : 
                redirect(base_url());
        }
        
    }

    public function kluster_isu()
    {
        $this->load->view('susunletak/atas');
        $this->load->view('cpi/kluster_isu/utama');
        $this->load->view('susunletak/bawah');
    }

}

?>