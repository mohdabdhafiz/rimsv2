<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelabmalaysiaku extends CI_Controller {

    public function bilangan(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('peranan_model');
        $this->load->model('kelabmalaysiaku_model');
        $pengguna = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PKPM') !== FALSE){
          $sesi = 'PKPM';
        }
        switch($sesi){
          case 'PKPM' :
            $senaraiNegeri = $this->peranan_model->tugasNegeriPeranan($pengguna->pengguna_peranan_bil);
            $jumlahKelabmalaysiaku = $this->kelabmalaysiaku_model->bilanganKelabmalaysiakuNegeri($senaraiNegeri);
            echo $jumlahKelabmalaysiaku->jumlahKelabmalaysiaku;
            break;
          default :
            redirect(base_url());
        }
      }

    public function daftarAhli(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $kelabmalaysiakuBil = $this->input->post('inputKelabmalaysiaku');
        if(empty($kelabmalaysiakuBil)){
            redirect(base_url());
        }
        $this->load->model('kelabmalaysiaku_ahli_model');
        $sesi = 'US_PROGRAM';
        switch($sesi){
            case 'US_PROGRAM' :
                $entri = $this->kelabmalaysiaku_ahli_model->tambahAhliPost();
                if($entri){
                    redirect('kelabmalaysiaku/bil/'.$kelabmalaysiakuBil);
                }else{
                    echo "TERDAPAT MASALAH.";
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function senaraiAhli($kelabmalaysiakuBil){
        if(empty($kelabmalaysiakuBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('kelabmalaysiaku_model');
        $this->load->model('kelabmalaysiaku_ahli_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['kelabmalaysiaku'] = $this->kelabmalaysiaku_model->kelabmalaysiaku($kelabmalaysiakuBil);
        $sesi = 'US_PROGRAM';
        switch($sesi){
            case 'US_PROGRAM' :
                $data['senaraiAhli'] = $this->kelabmalaysiaku_ahli_model->senarai($kelabmalaysiakuBil);
                $this->load->view('us_program_na/kelabmalaysiaku/ahli/senaraiIkutKelabmalaysiaku', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function carian(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('negeri_model');
        $this->load->model('daerah_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $this->load->model('kelabmalaysiaku_model');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        switch($sesi){
            case 'URUSETIA' :
                $data['senaraiKelabmalaysiaku'] = $this->kelabmalaysiaku_model->keputusanCarian();
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $data['senaraiDaerah'] = $this->daerah_model->senarai();
                $data['senaraiParlimen'] = $this->parlimen_model->senarai();
                $data['senaraiDun'] = $this->dun_model->senarai();
                $this->load->view('urusetia_na/kelabmalaysiaku/keputusanCarian', $data);
                break;
            case 'PKPM' :
                $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiKelabmalaysiaku'] = $this->kelabmalaysiaku_model->senaraiKelabmalaysiaku($data['senaraiNegeri'], $data['senaraiDaerah'], $data['senaraiParlimen'], $data['senaraiDun']);
                $this->load->view('us_program_negeri_na/kelabmalaysiaku/keputusanCarian', $data);
                break;
            case 'NEGERI' :
                $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiKelabmalaysiaku'] = $this->kelabmalaysiaku_model->senaraiKelabmalaysiaku($data['senaraiNegeri'], $data['senaraiDaerah'], $data['senaraiParlimen'], $data['senaraiDun']);
                $this->load->view('negeri_na/kelabmalaysiaku/keputusanCarian', $data);
                break;
            case 'PPD' :
                $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiKelabmalaysiaku'] = $this->kelabmalaysiaku_model->senaraiKelabmalaysiaku($data['senaraiNegeri'], $data['senaraiDaerah'], $data['senaraiParlimen'], $data['senaraiDun']);
                $this->load->view('ppd_na/kelabmalaysiaku/keputusanCarian', $data);
                break;
            case 'US_PROGRAM' :
                $data['senaraiKelabmalaysiaku'] = $this->kelabmalaysiaku_model->keputusanCarian();
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $data['senaraiDaerah'] = $this->daerah_model->senarai();
                $data['senaraiParlimen'] = $this->parlimen_model->senarai();
                $data['senaraiDun'] = $this->dun_model->senarai();
                $this->load->view('us_program_na/kelabmalaysiaku/keputusanCarian', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function senarai(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('negeri_model');
        $this->load->model('daerah_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $this->load->model('kelabmalaysiaku_model');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        switch($sesi){
            case 'URUSETIA' :
                $data['senaraiKelabmalaysiaku'] = $this->kelabmalaysiaku_model->senaraiKelabmalaysiakuPenuh();
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $data['senaraiDaerah'] = $this->daerah_model->senarai();
                $data['senaraiParlimen'] = $this->parlimen_model->senarai();
                $data['senaraiDun'] = $this->dun_model->senarai();
                $this->load->view('urusetia_na/kelabmalaysiaku/senarai', $data);
                break;
            case 'PKPM' :
                $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiKelabmalaysiaku'] = $this->kelabmalaysiaku_model->senaraiKelabmalaysiaku($data['senaraiNegeri'], $data['senaraiDaerah'], $data['senaraiParlimen'], $data['senaraiDun']);
                $this->load->view('us_program_negeri_na/kelabmalaysiaku/senarai', $data);
                break;
            case 'NEGERI' :
                $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiKelabmalaysiaku'] = $this->kelabmalaysiaku_model->senaraiKelabmalaysiaku($data['senaraiNegeri'], $data['senaraiDaerah'], $data['senaraiParlimen'], $data['senaraiDun']);
                $this->load->view('negeri_na/kelabmalaysiaku/senarai', $data);
                break;
            case 'PPD' :
                $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiKelabmalaysiaku'] = $this->kelabmalaysiaku_model->senaraiKelabmalaysiaku($data['senaraiNegeri'], $data['senaraiDaerah'], $data['senaraiParlimen'], $data['senaraiDun']);
                $this->load->view('ppd_na/kelabmalaysiaku/senarai', $data);
                break;
            case 'US_PROGRAM' :
                $data['senaraiKelabmalaysiaku'] = $this->kelabmalaysiaku_model->senaraiKelabmalaysiakuPenuh();
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $data['senaraiDaerah'] = $this->daerah_model->senarai();
                $data['senaraiParlimen'] = $this->parlimen_model->senarai();
                $data['senaraiDun'] = $this->dun_model->senarai();
                $this->load->view('us_program_na/kelabmalaysiaku/senarai', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function padamBerjaya(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $sesi = 'US_PROGRAM';
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/kelabmalaysiaku/padamBerjaya', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function padamKelabmalaysiaku(){
        $kelabmalaysiakuBil = $this->input->post('inputKelabmalaysiakuBil');
        if(empty($kelabmalaysiakuBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $this->load->model('kelabmalaysiaku_model');
        $sesi = 'US_PROGRAM';
        switch($sesi){
            case 'US_PROGRAM':
                $aktiviti = $this->kelabmalaysiaku_model->padamKelabmalaysiaku($kelabmalaysiakuBil);
                if($aktiviti){
                    $this->padamBerjaya();
                }
                else{
                    echo "TERDAPAT MASALAH BERLAKU";
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function daftarKelabmalaysiakuDun(){
        $daerahBil = $this->input->post('inputDaerahBil');
        $parlimenBil = $this->input->post('inputParlimenBil');
        $dunBil = $this->input->post('inputDunBil');
        if(empty($daerahBil)){
            redirect(base_url());
        }
        if(empty($parlimenBil)){
            redirect(base_url());
        }
        if(empty($dunBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('dun_model');
        $this->load->model('daerah_model');
        $this->load->model('pengguna_model');
        $this->load->model('parlimen_model');
        $data['daerah'] = $this->daerah_model->daerah($daerahBil);
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimenBil);
        $data['dun'] = $this->dun_model->dun_bil($dunBil);
        $sesi = 'US_PROGRAM';
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/kelabmalaysiaku/daftarKelabmalaysiakuDun', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function pilihDun(){
        $daerahBil = $this->input->post('inputDaerahBil');
        $parlimenBil = $this->input->post('inputParlimenBil');
        if(empty($daerahBil)){
            redirect(base_url());
        }
        if(empty($parlimenBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('dun_model');
        $this->load->model('daerah_model');
        $this->load->model('pengguna_model');
        $this->load->model('parlimen_model');
        $data['daerah'] = $this->daerah_model->daerah($daerahBil);
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimenBil);
        $data['senaraiDun'] = $this->dun_model->dun_negeri($data['daerah']->nt_bil);
        $sesi = 'US_PROGRAM';
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/kelabmalaysiaku/senaraiDun', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function pilihParlimen($daerahBil){
        if(empty($daerahBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('daerah_model');
        $this->load->model('pengguna_model');
        $this->load->model('parlimen_model');
        $data['daerah'] = $this->daerah_model->daerah($daerahBil);
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['senaraiParlimen'] = $this->parlimen_model->parlimen_negeri($data['daerah']->nt_bil);
        $sesi = 'US_PROGRAM';
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/kelabmalaysiaku/senaraiParlimen', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function prosesAm(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $this->load->model('kelabmalaysiaku_model');
        $sesi = 'US_PROGRAM';
        switch($sesi){
            case 'US_PROGRAM' :
                $entri = $this->kelabmalaysiaku_model->kemaskiniAmPost();
                if($entri){
                    redirect('kelabmalaysiaku/bil/'.$this->input->post('inputKelabmalaysiakuBil'));
                }else{
                    redirect(base_url());
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function bil($kelabmalaysiakuBil){
        if(empty($kelabmalaysiakuBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('kelabmalaysiaku_model');
        $this->load->model('daerah_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $this->load->model('program_kelabmalaysiaku_model');
        $this->load->model('kelabmalaysiaku_ahli_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['kelabmalaysiaku'] = $this->kelabmalaysiaku_model->kelabmalaysiaku($kelabmalaysiakuBil);
        $negeriBil = $data['kelabmalaysiaku']->kelabmalaysiaku_negeri;
        $data['senaraiDaerah'] = $this->daerah_model->daerah_negeri($negeriBil);
        $data['senaraiParlimen'] = $this->parlimen_model->parlimen_negeri($negeriBil);
        $data['senaraiDun'] = $this->dun_model->dun_negeri($negeriBil);
        $data['senaraiProgram'] = $this->program_kelabmalaysiaku_model->libatProgram($kelabmalaysiakuBil);

        //RUMUSAN AHLI
        //1. BILANGAN AHLI MENGIKUT UMUR
        $data['senaraiUmur'] = $this->kelabmalaysiaku_ahli_model->bilanganAhliUmur($kelabmalaysiakuBil);
        //2. BILANGAN AHLI MENGIKUT JANTINA
        $data['senaraiJantina'] = $this->kelabmalaysiaku_ahli_model->bilanganAhliJantina($kelabmalaysiakuBil);
        //3. BILANGAN AHLI MENGIKUT KAUM
        $data['senaraiKaum'] = $this->kelabmalaysiaku_ahli_model->bilanganAhliKaum($kelabmalaysiakuBil);
        //4. BILANGAN AHLI MENGIKUT TINGKATAN
        $data['senaraiTingkatan'] = $this->kelabmalaysiaku_ahli_model->bilanganAhliTingkatan($kelabmalaysiakuBil);
        //5. BILANGAN AHLI KESELURUHAN
        $data['senaraiAhli'] = $this->kelabmalaysiaku_ahli_model->senarai($kelabmalaysiakuBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        switch($sesi){
            case "PPD" :
                $this->load->view('ppd_na/kelabmalaysiaku/kelabmalaysiaku', $data);
                break;
            case "US_PROGRAM" :
                $this->load->view('us_program_na/kelabmalaysiaku/kelabmalaysiaku', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function daftarKelabmalaysiaku(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $negeriBil = $this->input->post('inputNegeriBil');
        $daerahBil = $this->input->post('inputDaerahBil');
        $parlimenBil = $this->input->post('inputParlimenBil');
        $dunBil = $this->input->post('inputDunBil');
        $penggunaBil = $this->input->post('inputPenggunaBil');
        $nama = $this->input->post('inputNama');
        $this->load->model('kelabmalaysiaku_model');
        $sesi = 'US_PROGRAM';
        switch($sesi){
            case 'US_PROGRAM' :
                $entri = $this->kelabmalaysiaku_model->daftar($nama, $negeriBil, $daerahBil, $parlimenBil, $dunBil, $penggunaBil);
                redirect('kelabmalaysiaku/bil/'.$entri['last_id']);
                $this->daftar();
                break;
            default : 
                redirect(base_url());
        }
    }

    public function pilihDaerah($negeriBil){
        if(empty($negeriBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('daerah_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['senaraiDaerah'] = $this->daerah_model->daerah_negeri($negeriBil);
        $data['negeriBil'] = $negeriBil;
        $sesi = 'US_PROGRAM';
        switch($sesi){
            case "US_PROGRAM" :
                $this->load->view('us_program_na/kelabmalaysiaku/pilihDaerah', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function daftar(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('negeri_model');
        $this->load->model('peranan_model'); 
        $this->load->model('daerah_model');   
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $sesi = 'US_PROGRAM';
        switch($sesi){
            case 'PKPM' :
                $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
                $this->load->view('us_program_negeri_na/kelabmalaysiaku/pilihNegeri', $data);
                break;
            case 'NEGERI' :
                $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
                $this->load->view('negeri_na/kelabmalaysiaku/pilihNegeri', $data);
                break;
            case 'PPD' :
                $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $this->load->view('ppd_na/kelabmalaysiaku/pilihNegeri', $data);
                break;
            case "US_PROGRAM" :
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $this->load->view('us_program_na/kelabmalaysiaku/pilihNegeri', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function index(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('kelabmalaysiaku_model');
        $this->load->model('kelabmalaysiaku_ahli_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($sesi)){
            redirect(base_url());
        }
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        $data['rujukan'] = "NEGERI / DAERAH";
        switch($sesi){
            case 'PPD' :
                $data['header'] = "ppd_na/susunletak/atas";
                $data['navbar'] = "ppd_na/susunletak/navbar";
                $data['sidebar'] = "ppd_na/susunletak/sidebar";
                $data['footer'] = "ppd_na/susunletak/bawah";

                $this->load->model('daerah_model');
                $senaraiDaerah = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);

                $this->load->model('parlimen_model');
                $senaraiParlimen = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);

                $this->load->model('dun_model');
                $senaraiDun = $this->dun_model->senaraiTugasanDun($data['pengguna']->pengguna_peranan_bil);

                $data['rujukan'] = "DAERAH";
                $data['am'] = $this->kelabmalaysiaku_model->amUmumPpd($senaraiDaerah);
                $data['senaraiRumusan'] = $this->kelabmalaysiaku_model->senaraiRumusanUmumPpd($senaraiDaerah);

                $data['senaraiRumusanParlimen'] = $this->kelabmalaysiaku_model->senaraiRumusanParlimen($senaraiParlimen);
                $data['senaraiRumusanDun'] = $this->kelabmalaysiaku_model->senaraiRumusanDun($senaraiDun);

                $data['rumusanUmurAhli'] = $this->kelabmalaysiaku_ahli_model->rumusanUmurAhli();
                $data['rumusanJantinaAhli'] = $this->kelabmalaysiaku_ahli_model->rumusanJantinaAhli();
                $data['rumusanKaumAhli'] = $this->kelabmalaysiaku_ahli_model->rumusanKaumAhli();

                $this->load->view('kelabmalaysiaku/laman', $data);
                break;
            case "US_PROGRAM" :
                $data['am'] = $this->kelabmalaysiaku_model->amUmum();
                $data['senaraiRumusan'] = $this->kelabmalaysiaku_model->senaraiRumusanUmum();
                $data['rumusanUmurAhli'] = $this->kelabmalaysiaku_ahli_model->rumusanUmurAhli();
                $data['rumusanJantinaAhli'] = $this->kelabmalaysiaku_ahli_model->rumusanJantinaAhli();
                $data['rumusanKaumAhli'] = $this->kelabmalaysiaku_ahli_model->rumusanKaumAhli();
                $this->load->view('us_program_na/kelabmalaysiaku/laman', $data);
                break;
            case 'URUSETIA' :
                // Panggil data rumusan untuk papan pemuka
                $data['am'] = $this->kelabmalaysiaku_model->amUmum(); // kiraan kelab, sekolah, ahli
                $data['senaraiRumusan'] = $this->kelabmalaysiaku_model->senaraiRumusanUmum(); // pecahan ikut negeri
                
                // PANGGIL FUNGSI BAHARU untuk mendapatkan data mengikut daerah
                $data['rumusanDaerah'] = $this->kelabmalaysiaku_model->senaraiRumusanDaerah(10); // Ambil 10 daerah teratas

                // TAMBAHAN: Panggil data untuk 5 negeri teratas
                $data['negeriTeratas'] = $this->kelabmalaysiaku_model->senaraiRumusanUmum(5); // Menggunakan semula fungsi sedia ada dengan had 5

                // Muatkan paparan papan pemuka yang baharu
                $this->load->view('susunletak/atas', $data);
                $this->load->view('urusetia_na/kelabmalaysiaku/dashboard'); // Fail view baharu yang akan kita cipta
                $this->load->view('susunletak/bawah');
                break;
            default :
                redirect(base_url());
        }
    }

}