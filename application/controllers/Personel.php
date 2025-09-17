<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personel extends CI_Controller {

    public function setujuPertukaran(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($sesi)){
            redirect(base_url());
        }
        $this->load->model('pengguna_pertukaran_model');
        switch($sesi){
            case "URUSETIA" :
                //1. SEMAK SAMA ADA UPDATE PALING BARU
                $senaraiLatest = $this->pengguna_pertukaran_model->latest($this->input->post('inputAnggotaBil'), $this->input->post('inputPenggunaWaktu'));
                if(empty($senaraiLatest)){
                    $this->pengguna_pertukaran_model->tambahPertukaran();
                    $this->pengguna_model->tukarPenempatan();
                    redirect('personel/bil/'.$this->input->post('inputAnggotaBil'));
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function pertukaran(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($sesi)){
            redirect(base_url());
        }
        switch($sesi){
            case "URUSETIA" :
                $this->load->library('form_validation');

                $this->form_validation->set_rules('inputAnggotaBil', 'Pilihan Pegawai / Pengguna', 'required');
                $this->form_validation->set_rules('inputPerananBil', 'Piilihan Peranan', 'required');
            
                if ($this->form_validation->run() === FALSE)
                {
                $this->load->model('peranan_model');
                $data['senaraiPegawai'] = $this->pengguna_model->senarai_penuh_pelapor();
                $data['senaraiPeranan'] = $this->peranan_model->senarai();
                $this->load->view('susunletak/atas', $data);
                $this->load->view('personel/lamanPertukaran');
                $this->load->view('susunletak/bawah');
                }
                else
                {
                    $this->load->model('peranan_model');
                    $this->load->model('japen_model');
                    $this->load->model('pengguna_pertukaran_model');
                    $this->pengguna_pertukaran_model->update20241011();
                    $data['anggota'] = $this->pengguna_model->pengguna($this->input->post('inputAnggotaBil'));
                    $data['peranan'] = $this->peranan_model->peranan($this->input->post('inputPerananBil'));
                    $data['organisasi'] = $this->japen_model->organisasi($this->input->post('inputPerananBil'));
                    $this->load->view('susunletak/atas', $data);
                    $this->load->view('personel/prosesPertukaran');
                    $this->load->view('susunletak/bawah');
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function bil($personelBil){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('program_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['personel'] = $this->pengguna_model->pengguna($personelBil);
        $data['senaraiLaporanProgram'] = $this->program_model->senaraiLaporanPengguna($personelBil);
        if(empty($data['pengguna'])){
            redirect(base_url());
        }
        $nama = $data['personel']->nama_penuh;
        $noIC = $data['personel']->pengguna_ic;
        $noTel = $data['personel']->no_tel;
        $data['senaraiAkaunDuplicate'] = $this->pengguna_model->senaraiDuplicate($nama, $noIC, $noTel, $personelBil);
        switch($sesi){
            case "URUSETIA" :
                $data['header'] = "urusetia_na/susunletak/atas";
                $data['sidebar'] = "urusetia_na/susunletak/sidebar";
                $data['navbar'] = "urusetia_na/susunletak/navbar";
                $data['footer'] = "urusetia_na/susunletak/bawah";
                $this->load->view("personel/maklumat", $data);
                break;
            case "ADMIN" :
                $data['header'] = "admin_na/susunletak/atas";
                $data['sidebar'] = "admin_na/susunletak/sidebar";
                $data['navbar'] = "admin_na/susunletak/navbar";
                $data['footer'] = "admin_na/susunletak/bawah";
                $this->load->view("personel/maklumat", $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function keputusanCarian(){
        $carian = $this->input->post('inputCarian');
        if(empty($carian)){
            redirect("personel/carian");
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($data['pengguna'])){
            redirect(base_url());
        }
        $data['maklumatCarian'] = $carian;
        $data['senaraiPengguna'] = $this->pengguna_model->carianPenggunaNama($carian);
        switch($sesi){
            case "URUSETIA" :
                $data['header'] = "urusetia_na/susunletak/atas";
                $data['sidebar'] = "urusetia_na/susunletak/sidebar";
                $data['navbar'] = "urusetia_na/susunletak/navbar";
                $data['footer'] = "urusetia_na/susunletak/bawah";
                $this->load->view("personel/keputusanCarian", $data);
                break;
            case "ADMIN" :
                $data['header'] = "admin_na/susunletak/atas";
                $data['sidebar'] = "admin_na/susunletak/sidebar";
                $data['navbar'] = "admin_na/susunletak/navbar";
                $data['footer'] = "admin_na/susunletak/bawah";
                $this->load->view("personel/keputusanCarian", $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function carian(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['bilanganPengguna'] = count($this->pengguna_model->senarai());
        if(empty($data['pengguna'])){
            redirect(base_url());
        }
        switch($sesi){
            case "URUSETIA" :
                $data['header'] = "urusetia_na/susunletak/atas";
                $data['sidebar'] = "urusetia_na/susunletak/sidebar";
                $data['navbar'] = "urusetia_na/susunletak/navbar";
                $data['footer'] = "urusetia_na/susunletak/bawah";
                $this->load->view("personel/carian", $data);
                break;
            case "ADMIN" :
                $data['header'] = "admin_na/susunletak/atas";
                $data['sidebar'] = "admin_na/susunletak/sidebar";
                $data['navbar'] = "admin_na/susunletak/navbar";
                $data['footer'] = "admin_na/susunletak/bawah";
                $this->load->view("personel/carian", $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function tambahKategoriPeranan(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if($sesi = "US_PROGRAM" && ($data['pengguna']->pengguna_status == "" || strtoupper($data['pengguna']->pengguna_status) == "PENTADBIR")){
            $sesi = "US_PROGRAM_ADMIN";
        }
        $anggotaBil = $this->input->post('inputAnggotaBil');
        $anggota = $this->pengguna_model->pengguna($anggotaBil);
        if(empty($anggota)){
            redirect(base_url());
        }
        $pegawaiBil = $this->input->post('inputPegawaiBil');
        $this->load->model('kategori_peranan_model');
        if(!empty($pegawaiBil)){
            $pegawai = $this->pengguna_model->pengguna($pegawaiBil);
            if(empty($pegawai)){
                redirect("personel/setRole/".$anggotaBil);
            }
            $kategoriPeranan = $this->kategori_peranan_model->semakPerananAnggotaPegawai($anggotaBil, $pegawaiBil);
            if(!empty($kategoriPeranan)){
                redirect("personel/setRole/".$anggotaBil);
            }
        }
        $kategoriPerananNama = $this->input->post('inputKategori');
        if(empty($kategoriPeranan)){
            redirect("personel/setRole/".$anggotaBil);
        }
        $kategoriPerananSingle = $this->kategori_peranan_model->semakKategoriPerananSingle($anggotaBil, $kategoriPerananNama);
        if(!empty($kategoriPerananSingle)){
            redirect("personel/setRole/".$anggotaBil);
        }
        switch($sesi){
            case 'US_PROGRAM_ADMIN' : 

                break;
            case 'URUSETIA' :
                break;
            default : 
                redirect(base_url());
        }
    }

    public function setRole($anggotaBil){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if($sesi = "US_PROGRAM" && ($data['pengguna']->pengguna_status == "" || strtoupper($data['pengguna']->pengguna_status) == "PENTADBIR")){
            $sesi = "US_PROGRAM_ADMIN";
        }
        $data['anggota'] = $this->pengguna_model->pengguna($anggotaBil);
        $this->load->model('kategori_peranan_model');
        $data['senaraiKategoriPeranan'] = $this->kategori_peranan_model->senaraiPerananAnggota($anggotaBil);
        switch($sesi){
            case 'US_PROGRAM_ADMIN' : 
                $data['header'] = 'us_program_na/susunletak/atas';
                $data['sidebar'] = 'us_program_na/susunletak/sidebar';
                $data['navbar'] = 'us_program_na/susunletak/navbar';
                $data['footer'] = 'us_program_na/susunletak/bawah';
                $this->load->view('personel/setRole', $data);
                break;
            case 'URUSETIA' :
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
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }   
        switch($sesi){
            case 'NEGERI' :
                $this->load->view('negeri_na/personel/utama', $data);
                break;
            case 'URUSETIA' : 
                $data['bilanganAnggota'] = $this->pengguna_model->bilanganAnggota();
                $data['bilanganTadbir'] = $this->pengguna_model->bilanganTadbir();
                $data['jumlahAkaun'] = $this->pengguna_model->jumlahAkaun();
                $this->load->view('susunletak/atas', $data);
                $this->load->view('urusetia/personelUtama');
                $this->load->view('susunletak/bawah');
                break;
            default : 
                redirect(base_url());
        }
    }

    public function id($bil)
    {
        $this->load->view('susunletak/atas');
        $this->load->view('personel/id');
        $this->load->view('susunletak/bawah');
    }

}
?>