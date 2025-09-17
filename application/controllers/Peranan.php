<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peranan extends CI_Controller {

    public function prosesDaftarPengguna(){
        $perananBil = $this->input->post('inputPeranan');
        if(empty($perananBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'URUSETIA' :
                $berjaya = FALSE;
                $ic = $this->input->post('inputNoIc');
                $noTel = $this->input->post('inputNoTel');
                $ada = $this->pengguna_model->semakan($ic, $noTel);
                if(empty($ada)){
                    $this->load->model('peranan_model');
                    $peranan = $this->peranan_model->peranan($perananBil);
                    $lastId = $this->pengguna_model->daftarIkutPeranan($peranan->peranan_bil, $peranan->peranan_nama);
                    if(!empty($lastId)){
                        $berjaya = TRUE;
                        $data['penggunaBerjaya'] = $this->pengguna_model->pengguna($lastId);
                    }
                }
                if($berjaya){
                    $this->load->view('urusetia_na/peranan/daftarPenggunaPerananBerjaya', $data);
                }else{
                    $this->load->model('peranan_model');
                    $data['peranan'] = $this->peranan_model->peranan($perananBil);
                    $this->load->view('urusetia_na/peranan/daftarPenggunaPerananTidakBerjaya', $data);
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function daftarPengguna($perananBil){
        if(empty($perananBil)){
            redirect(base_url());
        }
        $data['perananBil'] = $perananBil;
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'URUSETIA' :
                $this->load->model('peranan_model');
                $this->load->model('japen_model');
                $data['peranan'] = $this->peranan_model->peranan($perananBil);
                $data['senaraiPenempatan'] = $this->japen_model->senaraiPenempatan();
                $this->load->view('urusetia_na/peranan/daftarPenggunaPeranan', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function senaraiDun(){
        
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        switch($sesi){
            case 'URUSETIA' :
                
                //LOAD MODEL
                $this->load->model('peranan_model');

                //LOAD DATA
                $data['senaraiTugasDun'] = $this->peranan_model->senaraiPenuhTugasDun();

                //LOAD VIEW
                $this->load->view('urusetia_na/peranan/senaraiTugasDun', $data);

                break;
            default :
                redirect(base_url());
        }

    }

    public function senaraiParlimen(){
        
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        switch($sesi){
            case 'URUSETIA' :
                
                //LOAD MODEL
                $this->load->model('peranan_model');

                //LOAD DATA
                $data['senaraiTugasParlimen'] = $this->peranan_model->senaraiPenuhTugasParlimen();

                //LOAD VIEW
                $this->load->view('urusetia_na/peranan/senaraiTugasParlimen', $data);

                break;
            default :
                redirect(base_url());
        }

    }

    public function senaraiDaerah(){
        
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        switch($sesi){
            case 'URUSETIA' :
                
                //LOAD MODEL
                $this->load->model('peranan_model');

                //LOAD DATA
                $data['senaraiTugasDaerah'] = $this->peranan_model->senaraiPenuhTugasDaerah();

                //LOAD VIEW
                $this->load->view('urusetia_na/peranan/senaraiTugasDaerah', $data);

                break;
            default :
                redirect(base_url());
        }

    }

    public function padamTugasDun(){
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        switch($sesi){
            case 'URUSETIA' :
                
                //LOAD MODEL
                $this->load->model('peranan_model');

                //DELETE DATA
                $this->peranan_model->padamTugasDun();

                $this->senaraiDun();

                break;
            default :
                redirect(base_url());
        }
    }

    public function padamTugasParlimen(){
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        switch($sesi){
            case 'URUSETIA' :
                
                //LOAD MODEL
                $this->load->model('peranan_model');

                //DELETE DATA
                $this->peranan_model->padamTugasParlimen();

                $this->senaraiParlimen();

                break;
            default :
                redirect(base_url());
        }
    }

    public function padamTugasDaerah(){
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        switch($sesi){
            case 'URUSETIA' :
                
                //LOAD MODEL
                $this->load->model('peranan_model');

                //DELETE DATA
                $this->peranan_model->padamTugasDaerah();

                $this->senaraiDaerah();

                break;
            default :
                redirect(base_url());
        }
    }

    //DELETE NEGERI
    public function padamTugasNegeri(){
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        switch($sesi){
            case 'URUSETIA' :
                
                //LOAD MODEL
                $this->load->model('peranan_model');

                //DELETE DATA
                $this->peranan_model->padamTugasNegeri();

                $this->senaraiNegeri();

                break;
            default :
                redirect(base_url());
        }
    }

    public function senaraiNegeri(){
        
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        switch($sesi){
            case 'URUSETIA' :
                
                //LOAD MODEL
                $this->load->model('peranan_model');

                //LOAD DATA
                $data['senaraiTugasNegeri'] = $this->peranan_model->senaraiPenuhTugasNegeri();

                //LOAD VIEW
                $this->load->view('urusetia_na/peranan/senaraiTugasNegeri', $data);

                break;
            default :
                redirect(base_url());
        }

    }

    public function prosesTugasNegeri()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        switch($sesi){
            case 'URUSETIA' :
                    $this->load->model('peranan_model');
                    $this->peranan_model->setTugasanNegeri();
                    redirect('peranan/tambahPenugasanManual');
                break;
            default :
                redirect(base_url());
        }
    }

    public function prosesTugasDun()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        switch($sesi){
            case 'URUSETIA' :
                    $this->load->model('peranan_model');
                    $this->peranan_model->setTugasanDun();
                    redirect('peranan/tambahPenugasanManual');
                break;
            default :
                redirect(base_url());
        }
    }

    public function prosesTugasParlimen()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        switch($sesi){
            case 'URUSETIA' :
                    $this->load->model('peranan_model');
                    $this->peranan_model->setTugasanParlimen();
                    redirect('peranan/tambahPenugasanManual');
                break;
            default :
                redirect(base_url());
        }
    }

    public function prosesTugasDaerah()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        switch($sesi){
            case 'URUSETIA' :
                    $this->load->model('peranan_model');
                    $this->peranan_model->setTugasanDaerah();
                    redirect('peranan/tambahPenugasanManual');
                break;
            default :
                redirect(base_url());
        }
    }

    public function tambahPenugasanManual(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        switch($sesi){
            case 'URUSETIA' :
                    $this->load->model('pengguna_model');
                    $this->load->model('negeri_model');
                    $this->load->model('daerah_model');
                    $this->load->model('parlimen_model');
                    $this->load->model('dun_model');
                    $this->load->model('peranan_model');
                    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
                    $data['senaraiNegeri'] = $this->negeri_model->senarai();
                    $data['senaraiDaerah'] = $this->daerah_model->senarai();
                    $data['senaraiParlimen'] = $this->parlimen_model->senarai();
                    $data['senaraiDun'] = $this->dun_model->senarai();
                    $data['senaraiPeranan'] = $this->peranan_model->senarai();
                    $this->load->view('urusetia_na/peranan/tambahTugasanManual', $data); 
                break;
            default :
                redirect(base_url());
        }
    }

    public function peranan_bil($peranan_bil)
    {
        if(empty($peranan_bil)){
            redirect(base_url());
        }
        $this->load->model('peranan_model');
        $data['peranan'] = $this->peranan_model->peranan($peranan_bil);
        $data['senarai_daerah'] = $this->peranan_model->senarai_daerah($peranan_bil);
        $data['senarai_parlimen'] = $this->peranan_model->senarai_parlimen($peranan_bil);
        $data['senarai_dun'] = $this->peranan_model->senarai_dun($peranan_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('peranan/peranan_bil');
        $this->load->view('susunletak/bawah');
    }

    public function index()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if($sesi != "URUSETIA"){
            redirect(base_url());
        }
        $this->load->model('peranan_model');
        $this->load->model('pengguna_model');
        $data['senaraiPeranan'] = $this->peranan_model->senarai_peranan();
        $data['dataPengguna'] = $this->pengguna_model;
        $this->load->view('susunletak/atas');
        $this->load->view('peranan/utama', $data);
        $this->load->view('susunletak/bawah');
    }

    public function tambah_petugas($peranan_nama){

        $tmp_peranan = $this->session->userdata('peranan');
        if(empty($tmp_peranan)){
            redirect(base_url());
        }
        $peranan = strtolower($this->session->userdata('peranan'));
        $this->load->model('peranan_model');
        $nav = $peranan."_nav";
        $data['senarai_pegawai'] = $this->peranan_model->ikut_peranan($peranan_nama);
        $this->load->view('susunletak/atas');
        $this->load->view($peranan."/".$nav);
        $this->load->view('peranan/tambah_petugas', $data);
        $this->load->view('susunletak/bawah');
    }

    public function tambah_peranan_pengguna($perananBil)
    {
        if(strtoupper($this->session->userdata('peranan')) != "URUSETIA"){
            redirect(base_url());
        }
        $this->load->model('peranan_model');
        $this->load->model('pengguna_model');
        $data['peranan'] = $this->peranan_model->peranan($perananBil);
        $data['senaraiTiadaPeranan'] = $this->pengguna_model->tiadaPeranan();
        $this->load->view('susunletak/atas');
        $this->load->view('peranan/tambah_petugas', $data);
        $this->load->view('susunletak/bawah');
    }

    public function tambah()
    {
        if(strtoupper($this->session->userdata('peranan')) != "URUSETIA"){
            redirect(base_url());
        }
        $this->load->view('susunletak/atas');
        $this->load->view('peranan/tambah');
        $this->load->view('susunletak/bawah');
    }

    public function proses_tambah()
    {
        if(strtoupper($this->session->userdata('peranan')) != "URUSETIA"){
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->load->model('peranan_model');
        $this->form_validation->set_rules('peranan_nama', 'Nama Peranan', 'required');
        $this->form_validation->set_message('required', 'Wajib ada {field}');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        if($this->form_validation->run() === FALSE){
            $this->tambah();
        }else{
            $this->peranan_model->daftar();
            redirect('peranan', 'refresh');
        }
    }

    public function senarai_pengguna($perananBil)
    {
        $this->load->model('peranan_model');
        $this->load->model('pengguna_model');
        $data['peranan'] = $this->peranan_model->peranan($perananBil);
        $data['senaraiPengguna'] = $this->pengguna_model->peranan($perananBil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('peranan/senarai_pengguna');
        $this->load->view('susunletak/bawah');
    }

    public function calibrate_ppd(){
        $this->load->model('peranan_model');
        $this->load->model('pengguna_model');
        for($i = 1; $i < 160; $i++)
        {
            $nama = "ppd".$i;
            $ada = $this->peranan_model->ada($nama);
            $ada_pengguna = $this->pengguna_model->ada_pengguna($nama);
            if(!empty($ada))
            {
                echo "<p>$i = $ada->peranan_nama</p>";
                if(empty($ada_pengguna)){
                    $tambah = $this->pengguna_model->daftar_pengguna_manual(
                        $ada->peranan_nama,
                        $ada->peranan_nama,
                        $ada->peranan_nama,
                        $ada->peranan_bil,
                        $ada->peranan_nama
                    );
                }
                else
                {
                    echo "<p>Pengguna $i = $ada_pengguna->nama_penuh</p>";
                }
            }
            else
            {
                echo "<p>$i</p>";
                $tambah = $this->peranan_model->tambah_manual($nama);
            }
        }
    }

    public function calibrate_negeri(){
        $this->load->model('peranan_model');
        $this->load->model('pengguna_model');
        for($i = 1; $i < 16; $i++)
        {
            $nama = "negeri".$i;
            $ada = $this->peranan_model->ada($nama);
            $ada_pengguna = $this->pengguna_model->ada_pengguna($nama);
            if(!empty($ada))
            {
                echo "<p>$i = $ada->peranan_nama</p>";
                if(empty($ada_pengguna)){
                    $tambah = $this->pengguna_model->daftar_pengguna_manual(
                        $ada->peranan_nama,
                        $ada->peranan_nama,
                        $ada->peranan_nama,
                        $ada->peranan_bil,
                        $ada->peranan_nama
                    );
                }
                else
                {
                    echo "<p>Pengguna $i = $ada_pengguna->nama_penuh</p>";
                }
            }
            else
            {
                echo "<p>$i</p>";
                $tambah = $this->peranan_model->tambah_manual($nama);
            }
        }
    }

}