<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clr extends CI_Controller {

    public function negeriSentimenJantina(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $this->load->model('sentimen_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $rumusanJantina = $this->sentimen_model->rumusanJantina($senaraiNegeri);
                header('Content-Type: application/json');
                echo json_encode($rumusanJantina);
                break;
            default :
                redirect(base_url());
        }
    }

    public function negeriSentimenKaum(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $this->load->model('sentimen_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $rumusanKaum = $this->sentimen_model->rumusanKaum($senaraiNegeri);
                header('Content-Type: application/json');
                echo json_encode($rumusanKaum);
                break;
            default :
                redirect(base_url());
        }
    }

    public function negeriSentimenUmur(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $this->load->model('sentimen_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $rumusanUmur = $this->sentimen_model->rumusanUmur($senaraiNegeri);
                header('Content-Type: application/json');
                echo json_encode($rumusanUmur);
                break;
            default :
                redirect(base_url());
        }
    }

    public function negeriSentimenPekerjaan(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $this->load->model('sentimen_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $rumusanPekerjaan = $this->sentimen_model->rumusanPekerjaan($senaraiNegeri);
                header('Content-Type: application/json');
                echo json_encode($rumusanPekerjaan);
                break;
            default :
                redirect(base_url());
        }
    }

    public function negeriSentimenKawasan(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $this->load->model('sentimen_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $rumusanKawasan = $this->sentimen_model->rumusanKawasan($senaraiNegeri);
                header('Content-Type: application/json');
                echo json_encode($rumusanKawasan);
                break;
            default :
                redirect(base_url());
        }
    }

    public function negeriSentimenDun(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $this->load->model('sentimen_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $rumusanDun = $this->sentimen_model->rumusanDun($senaraiNegeri);
                header('Content-Type: application/json');
                echo json_encode($rumusanDun);
                break;
            default :
                redirect(base_url());
        }
    }

    public function negeriSentimenParlimen(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $this->load->model('sentimen_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $rumusanParlimen = $this->sentimen_model->rumusanParlimen($senaraiNegeri);
                header('Content-Type: application/json');
                echo json_encode($rumusanParlimen);
                break;
            default :
                redirect(base_url());
        }
    }

    public function negeriSentimenDaerah(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $this->load->model('sentimen_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $rumusanDaerah = $this->sentimen_model->rumusanDaerah($senaraiNegeri);
                header('Content-Type: application/json');
                echo json_encode($rumusanDaerah);
                break;
            default :
                redirect(base_url());
        }
    }

    public function negeriSentimenNegeri(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $this->load->model('sentimen_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $rumusanNegeri = $this->sentimen_model->rumusanNegeri($senaraiNegeri);
                header('Content-Type: application/json');
                echo json_encode($rumusanNegeri);
                break;
            case 'PPD' :
                $this->load->view('ppd_na/sentimen/utama', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function negeriSentimenOrganisasi(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $this->load->model('sentimen_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $rumusanOrganisasi = $this->sentimen_model->rumusanOrganisasi($senaraiNegeri);
                header('Content-Type: application/json');
                echo json_encode($rumusanOrganisasi);
                break;
            default :
                redirect(base_url());
        }
    }

    public function negeriSentimenPelapor(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $this->load->model('sentimen_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $rumusanPelapor = $this->sentimen_model->rumusanPelapor($senaraiNegeri);
                header('Content-Type: application/json');
                echo json_encode($rumusanPelapor);
                break;
            default :
                redirect(base_url());
        }
    }

    public function negeriSentimenMingguan(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $this->load->model('sentimen_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $rumusanMingguan = $this->sentimen_model->rumusanMingguan($senaraiNegeri);
                header('Content-Type: application/json');
                echo json_encode($rumusanMingguan);
                break;
            default :
                redirect(base_url());
        }
    }

}