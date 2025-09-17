<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function senaraiIkutPruParti(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        switch($sesi){
            case 'TOPONE' :
                $pruBil = $this->input->post('inputPilihanrayaBil');
                $partiBil = $this->input->post('inputPartiBil');

                $this->load->model('pilihanraya_model');
                $this->load->model('parti_model');

                $data['pru'] = $this->pilihanraya_model->pilihanraya($pruBil);
                $data['parti'] = $this->parti_model->parti($partiBil);

                if($data['pru']->pilihanraya_jenis == 'PARLIMEN'){
                    $this->load->model('pencalonan_parlimen_model');
                    $data['senaraiCalon'] = $this->pencalonan_parlimen_model->papar_ikut_pilihanraya_parti($pruBil, $partiBil);
                }


                if($data['pru']->pilihanraya_jenis == 'DUN'){
                    $this->load->model('pencalonan_model');
                    $data['senaraiCalon'] = $this->pencalonan_model->papar_ikut_pilihanraya_parti($pruBil, $partiBil);
                }


                $this->load->view('susunletak/atas', $data);
                $this->load->view('calonpru/senaraiParti');
                $this->load->view('susunletak/bawah');
                break;
            default :
                redirect(base_url());
        }
        
    }

    public function rasmi(){
        $this->load->view('susunletak/atas');
        $this->load->view('data/rasmi');
        $this->load->view('susunletak/bawah');
    }

    public function jangkaan()
    {
        $this->load->view('susunletak/atas');
        $this->load->view('data/jangkaan');
        $this->load->view('susunletak/bawah');
    }

    public function maklumat_harian($harian_bil){
        $this->load->model('harian_parlimen_model');
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_parlimen_model');
        $harian = $this->harian_parlimen_model->harian($harian_bil);
        $data['pilihan_tarikh'] = $harian->harian_parlimen_tarikh;
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->papar($harian->harian_parlimen_pilihanraya);
        $data['data_harian_parlimen'] = $this->harian_parlimen_model;
        $data['data_pru'] = $this->pilihanraya_model;
        $data['data_calon_parlimen'] = $this->pencalonan_parlimen_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('data/negeri_grading');
        $this->load->view('susunletak/bawah');
    }

    public function maklumat_harian_dun($harian_bil){
        $this->load->model('harian_model');
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_model');
        $harian = $this->harian_model->harian($harian_bil);
        $data['pilihan_tarikh'] = $harian->harian_tarikh;
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->papar($harian->harian_pilihanraya);
        $data['data_harian_dun'] = $this->harian_model;
        $data['data_pru'] = $this->pilihanraya_model;
        $data['data_calon_dun'] = $this->pencalonan_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('data/negeri_grading');
        $this->load->view('susunletak/bawah');
    }

    public function keputusan_semasa(){
        $sesi = $this->session->userdata('peranan');
        if(strtoupper($sesi) != 'DATA'){
            redirect(base_url());
        }
        $this->load->model('pilihanraya_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $this->load->model('status_grading_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('pencalonan_model');
        $this->load->model('ahli_model');
        $this->load->model('parti_model');
        $this->load->model('foto_model');
        $senarai_pilihanraya = $this->pilihanraya_model->papar_aktif();
        $this->load->view('susunletak/atas');
        $this->load->view('data/nav');
        $data_parlimen['nomborBilangan'] = 0;
        $data_dun['nomborBilangan'] = 0;
        foreach($senarai_pilihanraya as $pru){
            if($pru->pilihanraya_jenis == 'PARLIMEN'){
                $data_parlimen['nomborBilangan']++;
                $data_parlimen['senarai_parlimen'] = $this->parlimen_model->senarai_parlimen_pilihanraya($pru->pilihanraya_bil);
                $data_parlimen['data_status'] = $this->status_grading_model;
                $data_parlimen['data_calon'] = $this->pencalonan_parlimen_model;
                $data_parlimen['data_ahli'] = $this->ahli_model;
                $data_parlimen['data_parti'] = $this->parti_model;
                $data_parlimen['data_foto'] = $this->foto_model;
                $data_parlimen['pru'] = $pru;
                $this->load->view('topone/rumusan_keputusan', $data_parlimen);
            }
            if($pru->pilihanraya_jenis == 'DUN'){
                $data_dun['nomborBilangan']++;
                $data_dun['senarai_dun'] = $this->dun_model->senarai_dun_pilihanraya($pru->pilihanraya_bil);
                $data_dun['data_status'] = $this->status_grading_model;
                $data_dun['data_calon'] = $this->pencalonan_model;
                $data_dun['data_ahli'] = $this->ahli_model;
                $data_dun['data_parti'] = $this->parti_model;
                $data_dun['data_foto'] = $this->foto_model;
                $data_dun['pru'] = $pru;
                $this->load->view('topone/rumusan_keputusan_dun', $data_dun);
            }
        }   
        $this->load->view('susunletak/bawah');
    }


    public function rumusan_etno_parti(){
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('pencalonan_model');
        $this->load->model('parti_model');
        $this->load->model('foto_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $senarai_pilihanraya = $this->pilihanraya_model->papar_aktif();
        $this->load->view('susunletak/atas');
        $this->load->view('topone/tajuk');
        foreach($senarai_pilihanraya as $pru){
            if($pru->pilihanraya_jenis == 'PARLIMEN'){
                $data_parlimen['pru'] = $this->pilihanraya_model->pilihanraya($pru->pilihanraya_bil);
                $data_parlimen['data_parti'] = $this->parti_model;
                $data_parlimen['data_foto'] = $this->foto_model;
                $data_parlimen['data_calon'] = $this->pencalonan_parlimen_model;
                $data_parlimen['data_parlimen'] = $this->parlimen_model;
                $data_parlimen['senarai_parti'] = $this->pencalonan_parlimen_model->senarai_parti_pilihanraya($pru->pilihanraya_bil);
                $data_parlimen['senarai_parlimen'] = $this->parlimen_model->senarai_parlimen_pilihanraya($pru->pilihanraya_bil);
                $this->load->view('topone/etno_parti', $data_parlimen);
            }
            if($pru->pilihanraya_jenis == 'DUN'){
                $data_dun['pru'] = $this->pilihanraya_model->pilihanraya($pru->pilihanraya_bil);
                $data_dun['data_parti'] = $this->parti_model;
                $data_dun['data_calon'] = $this->pencalonan_model;
                $data_dun['data_foto'] = $this->foto_model;
                $data_dun['data_dun'] = $this->dun_model;
                $data_dun['senarai_dun'] = $this->dun_model->senarai_dun_pilihanraya($pru->pilihanraya_bil);
                $data_dun['senarai_parti'] = $this->pencalonan_model->senarai_parti_pilihanraya($pru->pilihanraya_bil);
                $this->load->view('topone/etno_parti', $data_dun);
            }
        }
        $this->load->view('susunletak/bawah');
    }

    public function maklumat_parlimen_pru($parlimen_bil){
        $this->load->model('parlimen_model');
        $data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimen_bil);
    }

    public function maklumat_negeri_pru($negeri){
        $data['pilihanraya_bil'] = 16;
        $this->load->model('negeri_model');
        $data['negeri'] = $this->negeri_model->negeri($negeri);
        $this->load->model('parlimen_model');
        $data['senarai_parlimen'] = $this->parlimen_model->negeri($data['negeri']->nt_nama);
        $this->load->model('pencalonan_parlimen_model');
        $data['data_wc'] = $this->pencalonan_parlimen_model;
        $data['data_parlimen'] = $this->parlimen_model;
        $this->load->model('foto_model');
        $data['data_foto'] = $this->foto_model;
        $this->load->model('parti_model');
        $data['data_parti'] = $this->parti_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('topone/calon_negeri');
        $this->load->view('susunletak/bawah');
    }

    public function topone($pilihanraya_bil){
        if(empty($pilihanraya_bil)){
            redirect(base_url());
        }
		$this->load->model('pilihanraya_model');
        $data['pru'] = $this->pilihanraya_model->pilihanraya($pilihanraya_bil);
        $this->load->model('parti_model');
										$this->load->model('ahli_model');
										$this->load->model('foto_model');
                                        $this->load->model('negeri_model');
                                        $data['data_negeri'] = $this->negeri_model;
        if($data['pru']->pilihanraya_jenis == 'PARLIMEN'){
										$this->load->model('parlimen_model');
										$this->load->model('harian_parlimen_model');
										$this->load->model('pencalonan_parlimen_model');
										$data['data_foto'] = $this->foto_model;
										$data['data_ahli'] = $this->ahli_model;
										$data['data_pilihanraya'] = $this->pilihanraya_model;
										$data['ikut_grading'] = $this->harian_parlimen_model->rumusan_ikut_grading($pilihanraya_bil);
										$data['data_grading'] = $this->harian_parlimen_model;
										$data['data_parlimen'] = $this->parlimen_model;
										$data['data_parti'] = $this->parti_model;
										$data['data_wc'] = $this->pencalonan_parlimen_model;
										$data['senarai_calon'] = $this->pencalonan_parlimen_model->senaraiCalonPilihanraya($pilihanraya_bil);
										$data['rumusan_ikut_negeri'] = $this->pencalonan_parlimen_model->rumusan_ikut_negeri($pilihanraya_bil);
										$data['ikut_parti'] = $this->pencalonan_parlimen_model->rumusan_ikut_parti($pilihanraya_bil);
										$data['ikut_umur'] = $this->pencalonan_parlimen_model->rumusan_ikut_umur($pilihanraya_bil);
										$data['ikut_jantina'] = $this->pencalonan_parlimen_model->rumusan_ikut_jantina($pilihanraya_bil);
                                        $data['jumlah_calon'] = count($this->pencalonan_parlimen_model->papar_ikut_calon($pilihanraya_bil));
                                        $data['penjuru'] = $this->pencalonan_parlimen_model->penjuru($pilihanraya_bil);
                                        $data['calon_tua'] = $this->pencalonan_parlimen_model->calon_tua($pilihanraya_bil);
                                        $data['senarai_calon_tua'] = $this->pencalonan_parlimen_model->senarai_calon_tua($data['calon_tua']->ahli_umur, $data['pru']->pilihanraya_bil);
                                        $data['calon_muda'] = $this->pencalonan_parlimen_model->calon_muda($pilihanraya_bil);
                                        $data['senarai_calon_muda'] = $this->pencalonan_parlimen_model->senarai_calon_muda($data['calon_muda']->ahli_umur, $data['pru']->pilihanraya_bil);
        }
        if($data['pru']->pilihanraya_jenis == 'DUN'){
            $this->load->model('dun_model');
            $this->load->model('harian_model');
            $this->load->model('pencalonan_model');
            $data['data_foto'] = $this->foto_model;
            $data['data_ahli'] = $this->ahli_model;
            $data['data_pilihanraya'] = $this->pilihanraya_model;
            $data['ikut_grading'] = $this->harian_model->rumusan_ikut_grading($pilihanraya_bil);
            $data['data_grading'] = $this->harian_model;
            $data['data_dun'] = $this->dun_model;
            $data['data_parti'] = $this->parti_model;
            $data['data_wc'] = $this->pencalonan_model;
            $data['senarai_calon'] = $this->pencalonan_model->senaraiCalonPilihanraya($pilihanraya_bil);
            $data['rumusan_ikut_negeri'] = $this->pencalonan_model->rumusan_ikut_negeri($pilihanraya_bil);
            $data['ikut_parti'] = $this->pencalonan_model->rumusan_ikut_parti($pilihanraya_bil);
            $data['ikut_umur'] = $this->pencalonan_model->rumusan_ikut_umur($pilihanraya_bil);
            $data['ikut_jantina'] = $this->pencalonan_model->rumusan_ikut_jantina($pilihanraya_bil);
            $data['jumlah_calon'] = count($this->pencalonan_model->papar_ikut_calon($pilihanraya_bil));
            $data['penjuru'] = $this->pencalonan_model->penjuru($pilihanraya_bil);
            $data['calon_tua'] = $this->pencalonan_model->calon_tua($pilihanraya_bil);
            $data['senarai_calon_tua'] = $this->pencalonan_model->senarai_calon_tua($data['calon_tua']->ahli_umur, $data['pru']->pilihanraya_bil);
            $data['calon_muda'] = $this->pencalonan_model->calon_muda($pilihanraya_bil);
            $data['senarai_calon_muda'] = $this->pencalonan_model->senarai_calon_muda($data['calon_muda']->ahli_umur, $data['pru']->pilihanraya_bil);
}
										$this->load->view('susunletak/atas', $data);
										$this->load->view('topone/pencalonan');
										$this->load->view('susunletak/bawah');
    }

	public function index(){
        $this->load->model('jenis_model');
        $this->load->model('japen_model');
        $this->load->model('program_model');
        $this->load->model('kpi_model');
        $this->load->model('pilihanraya_model');
        $this->load->model('pengguna_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('pencalonan_model');
        $data['data_pencalonan_dun'] = $this->pencalonan_model;
        $data['data_pencalonan_parlimen'] = $this->pencalonan_parlimen_model;
        $data['data_pengguna'] = $this->pengguna_model;
        $data['data_pilihanraya'] = $this->pilihanraya_model; 
        $data['data_kpi'] = $this->kpi_model;
        $data['data_program'] = $this->program_model;
        $data['senarai_jabatan'] = $this->japen_model->senaraiJapen();
        $data['senarai_jenis_program'] = $this->jenis_model->semua();
        $data['tahun'] = date("Y");
        $this->load->view('susunletak/atas', $data);
        $this->load->view('laporan/ikut_tahun');
        $this->load->view('susunletak/bawah');
    }

    public function rumusan(){
        $tarikh_laporan = $this->input->post('tarikh_laporan');
        if(empty($tarikh_laporan))
        {
            redirect(base_url());
        }
        $tarikh = $this->input->post('tarikh_laporan');
        $data['tarikh'] = $tarikh;
        $this->load->model('pilihanraya_model');
        $data['pilihanraya'] = $this->pilihanraya_model->papar($this->session->userdata('pilihanraya_bil'));
        $this->load->model('harian_model');
        $this->load->model('pencalonan_model');
        $this->load->model('status_grading_model');
        $data['senarai_warna'] = $this->harian_model->senarai_warna($tarikh);
        $data['senarai_dun'] = $this->harian_model->senarai_dun($this->session->userdata('pilihanraya_bil'),$tarikh);
        $data['senarai_parti'] = $this->status_grading_model->senarai_parti($this->session->userdata('pilihanraya_bil'), $tarikh);
        $data['senarai_dun_menang'] = $this->status_grading_model->senarai_parti($this->session->userdata('pilihanraya_bil'), $tarikh);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('laporan/utama');
        $this->load->view('susunletak/bawah');
    }

    public function data_dun()
    {
        $peranan = $this->session->userdata('peranan');
        if(empty($peranan))
        {
            redirect(base_url(), 'refresh');
        }
        $data_tarikh = date_create($this->input->post('tarikh'));
        $data_tarikh = date_format($data_tarikh, 'Y-m-d');
        $this->load->model('dun_model');
        $senarai_dun = $this->dun_model->dun_grading($this->session->userdata('pilihanraya_bil'), $data_tarikh);
        $dun = array();
        foreach($senarai_dun as $d){
            $warna = "rgba(105, 105, 105, 1)";
            if($d->harian_grading == 'PUTIH'){
                $warna = "rgba(255, 255, 255, 1)";
            }
            if($d->harian_grading == 'KELABU PUTIH'){
                $warna = "rgba(190, 190, 190, 1)";
            }
            if($d->harian_grading == 'KELABU HITAM'){
                $warna = "rgba(105, 105, 105, 1)";
            }
            if($d->harian_grading == 'HITAM'){
                $warna = "rgba(0, 0, 0, 1)";
            }
            $dun[] = array(
                'grading' => $d->harian_grading,
                'warna' => $warna,
                'bilangan_dun' => $d->kira_dun
            );
        }
        echo json_encode($dun);
    }
	
    public function dun_putih()
    {
        $peranan = $this->session->userdata('peranan');
        if(empty($peranan))
        {
            redirect(base_url(), 'refresh');
        }
        $this->load->model('dun_model');
        $senarai_dun = $this->dun_model->dun_putih($this->session->userdata('pilihanraya_bil'), date('Y-m-d'));
        $dun = array();
        foreach($senarai_dun as $d){
            $dun[] = array(
                'dun_nama' => $d->dun_nama
            );
        }
        echo json_encode($dun);
    }

    public function data_parti()
    {
        $this->load->model('parti_model');
        $data_tarikh = date_create($this->input->post('tarikh'));
        $data_tarikh = date_format($data_tarikh, 'Y-m-d');
        $this->load->model('status_grading_model');
        $senarai_parti = $this->status_grading_model->senarai_parti($this->session->userdata('pilihanraya_bil'), $data_tarikh);
        $parti = array();
        $text = "";
        foreach($senarai_parti as $p){
            $count = 1;
            $color = explode(';', $p->parti_warna);
            foreach($color as $c)
            {
                if($count == 1)
                {
                    $bg = $c;
                }
                if($count == 2)
                {
                    $text = $c;
                }
                $count++;
            } 
            $count = 1;
            $bg2 = explode(':', $bg);
            foreach($bg2 as $c)
            {
                if($count == 1)
                {
                    $bg = $c;
                }
                if($count == 2)
                {
                    $text = $c;
                }
                $count++;
            } 
            $warna = $text;
                                    
            $parti[] = array(
                'nama_parti' => $p->parti_nama,
                'warna' => $warna,
                'bilangan_parti' => $p->kira_parti
            );
        }
        echo json_encode($parti);
    }

    public function pilihanraya($pilihanrayaBil){
        $this->load->model('pilihanraya_model');
        $this->load->model('harian_model');
        $this->load->model('pencalonan_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $this->load->model('parti_model');
        $this->load->model('ahli_model');
        $data['pilihanrayaBil'] = $pilihanrayaBil;
        $data['senaraiPilihanraya'] = $this->pilihanraya_model->papar($pilihanrayaBil);
        $data['senaraiPencalonanDUN'] = $this->pencalonan_model;
        $data['senaraiDUNPencalonan'] = $this->pencalonan_model->senaraiDUN($pilihanrayaBil);
        $data['dataDUN'] = $this->dun_model;
        $data['senaraiPencalonanParlimen'] = $this->pencalonan_parlimen_model;
        $data['senaraiParlimenPencalonan'] = $this->pencalonan_parlimen_model->senaraiParlimen($pilihanrayaBil);
        $data['dataParlimen'] = $this->parlimen_model;
        $data['dataHarian'] = $this->harian_model;
        $data['dataParti'] = $this->parti_model;
        $data['dataAhli'] = $this->ahli_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('laporan/pilihanraya');
        $this->load->view('susunletak/bawah');
    }


    /////KOMPONEN//////

    public function komp_rasmi(){
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('pencalonan_model');
        $this->load->model('parti_model');
        //$data['senarai_pilihanraya'] = $this->pilihanraya_model->selesai();
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->aktif();
        $data['data_parti'] = $this->parti_model;
        $data['data_calon_parlimen'] = $this->pencalonan_parlimen_model;
        $data['data_calon_dun'] = $this->pencalonan_model;
        $this->load->view('data/komponen/komp_rasmi', $data);
    }

    public function nav(){
        $this->load->view('data/nav');
    }

    public function senarai_jangkaan(){
        $this->load->model('negeri_model');
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('pencalonan_model');
        $this->load->model('parti_model');
        $data['data_parti'] = $this->parti_model;
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->aktif();
        $data['data_calon_parlimen'] = $this->pencalonan_parlimen_model;
        $data['data_calon_dun'] = $this->pencalonan_model;
        $this->load->view('data/komponen/jangkaan', $data);
    }


}