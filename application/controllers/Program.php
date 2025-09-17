<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends CI_Controller {

  private function template($sesi){
    if(empty($sesi)){
      redirect(base_url());
    }
    switch($sesi){
      case "PPD" :
        $view = "ppd_na";
        break;
      case "US_PROGRAM" :
        $view = "us_program_na";
        break;
    }
    $template = [
      "header" => "$view/susunletak/atas",
      "sidebar" => "$view/susunletak/sidebar",
      "navbar" => "$view/susunletak/navbar",
      "footer" => "$view/susunletak/bawah",
    ];
    return $template;
  }

  private function pengguna(){
    $penggunaBil = $this->session->userdata("pengguna_bil");
    if(empty($penggunaBil)){
      redirect(base_url());
    }
    $this->load->model("pengguna_model");
    $pengguna = $this->pengguna_model->pengguna($penggunaBil);
    return $pengguna;
  }

  private function sesi(){
    $sesi = strtoupper($this->session->userdata("peranan"));
    if(empty($sesi)){
      redirect(base_url());
    }
    if(strpos($sesi, "PPD") !== FALSE){
      $sesi = "PPD";
    }
    return $sesi;
  }

  public function senaraiIndividu(){
    $sesi = $this->sesi();
    $data['pengguna'] = $this->pengguna();
    $data = array_merge($data, $this->template($sesi));
    $this->load->model("program_model");
    $data["senaraiProgram"] = $this->program_model->senaraiIndividu($data['pengguna']->bil);
    $data["gunaView"] = "laporan/senaraiLaporan";
    $this->load->view("baseTemplate", $data);
  }

  public function cetak($programBil){
    if(empty($programBil)){
      redirect(base_url());
    }
    $sesi = $this->sesi();
    $data['pengguna'] = $this->pengguna();
    $data = array_merge($data, $this->template($sesi));
    $this->load->model([
      "program_model", 
      "program_pengisian_model",
      "program_obp_model",
      "program_komuniti_model",
      "program_kelabmalaysiaku_model",
      "program_gambar_model",
      "program_keratan_akhbar_model",
      "program_pautan_model"
    ]);
    $data["program"] = $this->program_model->program2($programBil);
    $data["senaraiAktiviti"] = $this->program_pengisian_model->senaraipengisian($programBil);
    $data["senaraiObp"] = $this->program_obp_model->senaraiObp($programBil);
    $data["senaraiKomuniti"] = $this->program_komuniti_model->senarai($programBil);
    $data["senaraiKelabMalaysiaku"] = $this->program_kelabmalaysiaku_model->senarai($programBil);
    $data["senaraiGambar"] = $this->program_gambar_model->senaraiGambarIkutProgram($programBil);
    $data["senaraiKeratanAkhbar"] = $this->program_keratan_akhbar_model->senaraiKeratanAkhbarIkutProgram($programBil);
    $data["senaraiPautan"] = $this->program_pautan_model->senaraiPautanIkutProgram($programBil);
    $this->load->view("laporan/cetak/laporanProgram", $data);
  }

  public function tukarPelaporLaporan($programBil){
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('program_model');
    $this->load->model('pengguna_model');
    if(empty($programBil)){
      redirect(base_url());
    }
    $data['program'] = $this->program_model->program($programBil);
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    switch($sesi){
      case 'ADMIN':
        $data['header'] = "admin_na/susunletak/atas";
        $data['navbar'] = "admin_na/susunletak/navbar";
        $data['sidebar'] = "admin_na/susunletak/sidebar";
        $data['footer'] = "admin_na/susunletak/bawah";

        $data['senaraiPelapor'] = $this->pengguna_model->senaraiBukanAdmin();

        $data['statusPertukaran'] = FALSE;
        $tempProgramBil = $this->input->post("inputProgramBil");
        $tempPelaporLaporan = $this->input->post("inputPelaporLaporan");
        $tempPenggunaBil = $this->input->post("inputPenggunaBil");
        if(!empty($tempProgramBil) && !empty($tempPelaporLaporan)){
          $entri = $this->program_model->tukarPelaporLaporan($tempProgramBil, $tempPelaporLaporan);
          if($entri){
            $data['statusPertukaran'] = TRUE;
            $data['program'] = $this->program_model->program($programBil);

            $this->load->model("program_status_model");
            $statusDeskripsi = 'Perubahan Pelapor oleh pentadbir sistem RIMS';
            $this->program_status_model->tambahLog($tempPenggunaBil, $tempProgramBil, $data['program']->program_status, $statusDeskripsi);
          }
        }
        $this->load->view('program/tukarPelaporLaporan', $data);
        break;
      default :
        redirect(base_url());
    }
  }

  public function tukarStatusLaporan($programBil){
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('program_model');
    $this->load->model('pengguna_model');
    if(empty($programBil)){
      redirect(base_url());
    }
    $data['program'] = $this->program_model->program($programBil);
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    switch($sesi){
      case 'ADMIN':
        $data['header'] = "admin_na/susunletak/atas";
        $data['navbar'] = "admin_na/susunletak/navbar";
        $data['sidebar'] = "admin_na/susunletak/sidebar";
        $data['footer'] = "admin_na/susunletak/bawah";

        $data['statusPertukaran'] = FALSE;
        $tempProgramBil = $this->input->post("inputProgramBil");
        $tempProgramStatus = $this->input->post("inputStatus");
        $tempPenggunaBil = $this->input->post("inputPenggunaBil");
        $tempPenggunaWaktu = $this->input->post("inputPenggunaWaktu");
        if(!empty($tempProgramBil) && !empty($tempProgramStatus)){
          $entri = $this->program_model->tukarStatusLaporan($tempProgramBil, $tempProgramStatus);
          if($entri){
            $data['statusPertukaran'] = TRUE;
            $data['program'] = $this->program_model->program($programBil);

            $this->load->model("program_status_model");
            $statusDeskripsi = 'Perubahan Status oleh pentadbir sistem RIMS';
            $this->program_status_model->tambahLog($tempPenggunaBil, $tempProgramBil, $data['program']->program_status, $statusDeskripsi);
          }
        }
        $this->load->view('program/tukarStatusLaporan', $data);
        break;
      default :
        redirect(base_url());
    }
  }

  public function organisasiPelaporan(){
    $sesi = strtoupper($this->session->userdata('peranan'));
    if(empty($sesi)){
      redirect(base_url());
    }
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('peranan_model');
    $this->load->model('pengguna_model');
    $data['dataPeranan'] = $this->peranan_model;
    $data['senaraiIpn'] = $this->peranan_model->senaraiAkaunIpn();
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    switch($sesi){
      case 'US_PROGRAM' : 
        $data['header'] = "us_program_na/susunletak/atas";
        $data['sidebar'] = "us_program_na/susunletak/sidebar";
        $data['navbar'] = "us_program_na/susunletak/navbar";
        $data['footer'] = "us_program_na/susunletak/bawah";


        $this->load->view('program/organisasiPelaporan', $data);

        break;
    }
  }

  public function senaraiPelaksanaanProgram(){
    $sesi = strtoupper($this->session->userdata('peranan'));
    switch($sesi){
      case "TOPPROGRAM" :
        $this->load->view('topprogram_na/program/senaraiPelaksanaanProgram');
        break;
    }
  }

  public function senaraiPerancanganProgram(){
    $sesi = strtoupper($this->session->userdata('peranan'));
    switch($sesi){
      case "TOPPROGRAM" :
        $this->load->view('topprogram_na/program/senaraiPerancanganProgram');
        break;
    }
  }

  public function perancanganProgram(){
    $sesi = strtoupper($this->session->userdata('peranan'));
    if(empty($sesi)){
      redirect(base_url());
    }
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('pengguna_model');
    $this->load->model('peranan_model');
    $this->load->model('program_model');
    $pengguna = $this->pengguna_model->pengguna($penggunaBil);
    if(strpos($sesi, 'PPN') !== FALSE){
      $sesi = 'PPN';
    }
    switch($sesi){
      case 'TOPPROGRAM' :
        $this->load->model('negeri_model');
				$senaraiNegeri = $this->negeri_model->senarai();
        $tahun = date('Y');
        $jumlahProgram = $this->program_model->bilanganProgramNegeriRancang($senaraiNegeri, $tahun);
        echo $jumlahProgram->jumlahProgram;
        break;
      case 'PPN' :
				$senaraiNegeri = $this->peranan_model->tugasNegeriPeranan($pengguna->pengguna_peranan_bil);
        $tahun = date('Y');
        $jumlahProgram = $this->program_model->bilanganProgramNegeriRancang($senaraiNegeri, $tahun);
        echo $jumlahProgram->jumlahProgram;
        break;
      default :
        redirect(base_url());
    }
  }

  public function pelaksanaanProgram(){
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('pengguna_model');
    $this->load->model('peranan_model');
    $this->load->model('program_model');
    $pengguna = $this->pengguna_model->pengguna($penggunaBil);
    if(strpos($sesi, 'PPN') !== FALSE){
      $sesi = 'PPN';
    }
    switch($sesi){
      case 'TOPPROGRAM' :
        $this->load->model('negeri_model');
				$senaraiNegeri = $this->negeri_model->senarai();
        $tahun = date('Y');
        $jumlahProgram = $this->program_model->bilanganProgramNegeriLaksana($senaraiNegeri, $tahun);
        echo $jumlahProgram->jumlahProgram;
        break;
      case 'PPN' :
				$senaraiNegeri = $this->peranan_model->tugasNegeriPeranan($pengguna->pengguna_peranan_bil);
        $tahun = date('Y');
        $jumlahProgram = $this->program_model->bilanganProgramNegeriLaksana($senaraiNegeri, $tahun);
        echo $jumlahProgram->jumlahProgram;
        break;
      default :
        redirect(base_url());
    }
  }

  public function sahTiada(){
    $programBil = $this->input->post('inputProgram');
    if(empty($programBil)){
      redirect(base_url());
    }
    $penggunaBil = $this->input->post('inputPengguna');
    if(empty($penggunaBil)){
      redirect(base_url());
    }
    $tajukSemakan = $this->input->post('inputTajuk');
    if(empty($tajukSemakan)){
      redirect(base_url());
    }
    $segmen = $this->input->post('inputSegmen');
    $this->prosesSemakanLaporan($programBil, $tajukSemakan, $penggunaBil);
    redirect('program/bil/'.$programBil."#".$segmen);
  }

  private function tukarFalseSemakan($programBil, $tajukSemakan, $penggunaBil){
    $this->load->model('program_semakan_model');
    $semakanLaporan = $this->program_semakan_model->semakan($programBil, $tajukSemakan);
    if(!empty($semakanLaporan)){
      $this->program_semakan_model->tukarFalse($semakanLaporan->ps_bil, $penggunaBil);
    }
  }

  private function tambahStatusLaporan($penggunaBil, $programBil, $statusSemasa, $statusDeskripsi){
    $this->load->model('program_model');
    $this->load->model('program_status_model');
    $this->program_model->hantar($statusSemasa);
    $this->program_status_model->tambahLog($penggunaBil, $programBil, $statusSemasa, $statusDeskripsi);
  }

  public function sahSelesai(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $penggunaBil = $this->input->post('inputPengguna');
    if(empty($penggunaBil)){
      redirect(base_url());
    }
    $this->load->model('program_model');
    $this->load->model('program_status_model');
    $statusSemasa = 'Selesai';
    $this->program_model->hantar($statusSemasa);
    $statusDeskripsi = 'Laporan Selesai';
    $this->program_status_model->tambahLog($penggunaBil, $programBil, $statusSemasa, $statusDeskripsi);
    redirect('program/bil/'.$programBil);
  }

  public function sahHantarPPBPKPM(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $penggunaBil = $this->input->post('inputPengguna');
    if(empty($penggunaBil)){
      redirect(base_url());
    }
    $this->load->model('program_model');
    $this->load->model('program_status_model');
    $statusSemasa = 'Pengesahan Hantar PP BPKPM';
    $this->program_model->hantar($statusSemasa);
    $statusDeskripsi = 'Pengesahan Pelaksanaan Program oleh Anggota BPKPM';
    $this->program_status_model->tambahLog($penggunaBil, $programBil, $statusSemasa, $statusDeskripsi);
    redirect('program/bil/'.$programBil);
  }

  public function sahLaksanaHq(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $penggunaBil = $this->input->post('inputPengguna');
    if(empty($penggunaBil)){
      redirect(base_url());
    }
    $this->load->model('program_model');
    $this->load->model('program_status_model');
    $statusSemasa = 'Pengesahan Hantar BPKPM';
    $this->program_model->hantar($statusSemasa);
    $statusDeskripsi = 'Pengesahan Pelaksanaan Program oleh PP PKPM Negeri';
    $this->program_status_model->tambahLog($penggunaBil, $programBil, $statusSemasa, $statusDeskripsi);
    redirect('program/bil/'.$programBil);
  }

  public function sahLaksanaPPPKPM(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $penggunaBil = $this->input->post('inputPengguna');
    if(empty($penggunaBil)){
      redirect(base_url());
    }
    $this->load->model('program_model');
    $this->load->model('program_status_model');
    $statusSemasa = 'Pengesahan Hantar PP PKPM Negeri';
    $this->program_model->hantar($statusSemasa);
    $statusDeskripsi = 'Pengesahan Pelaksanaan Program oleh Anggota PKPM Negeri';
    $this->program_status_model->tambahLog($penggunaBil, $programBil, $statusSemasa, $statusDeskripsi);
    redirect('program/bil/'.$programBil);
  }

  public function sahLaksanaNegeri(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $penggunaBil = $this->input->post('inputPengguna');
    if(empty($penggunaBil)){
      redirect(base_url());
    }
    $this->load->model('program_model');
    $this->load->model('program_status_model');
    $statusSemasa = 'Pengesahan Hantar Negeri';
    $this->program_model->hantar($statusSemasa);
    $statusDeskripsi = 'Pengesahan Pelaksanaan Program oleh Pegawai Penerangan Daerah (PPD)';
    $this->program_status_model->tambahLog($penggunaBil, $programBil, $statusSemasa, $statusDeskripsi);
    redirect('program/bil/'.$programBil);
  }

  public function sahLaksanaPPD(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $penggunaBil = $this->input->post('inputPengguna');
    if(empty($penggunaBil)){
      redirect(base_url());
    }
    $this->load->model('program_model');
    $this->load->model('program_status_model');
    $statusSemasa = 'Pengesahan Hantar PPD';
    $this->program_model->hantar($statusSemasa);
    $statusDeskripsi = 'Pengesahan Pelaksanaan Program';
    $this->program_status_model->tambahLog($penggunaBil, $programBil, $statusSemasa, $statusDeskripsi);
    redirect('program/bil/'.$programBil);
  }

  public function pulangSemulaPelapor(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $this->load->model('program_model');
    $statusSemasa = "Jadual Aktiviti";
    $this->program_model->hantar($statusSemasa);
      $this->load->model('program_status_model');
      $penggunaBil = $this->input->post('inputPengguna');
      $statusDeskripsi = "Pemulangan Semula Laporan: ".$this->input->post('inputJustifikasi');
      $this->program_status_model->tambahLog($penggunaBil, $programBil, $statusSemasa, $statusDeskripsi);
      redirect('program/bil/'.$programBil);

  }

  public function sahRancangPPBPKPM(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $penggunaBil = $this->input->post('inputPengguna');
    if(empty($penggunaBil)){
      redirect(base_url());
    }
    $this->load->model('program_model');
    $this->load->model('program_status_model');
    $statusSemasa = 'Jadual Aktiviti';
    $this->program_model->hantar($statusSemasa);
    $statusDeskripsi = 'Pengesahan Perancangan Program';
    $this->program_status_model->tambahLog($penggunaBil, $programBil, $statusSemasa, $statusDeskripsi);
    redirect('program/bil/'.$programBil);
  }

  public function sahRancangBpkpm(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $penggunaBil = $this->input->post('inputPengguna');
    if(empty($penggunaBil)){
      redirect(base_url());
    }
    $this->load->model('program_model');
    $this->load->model('program_status_model');
    $statusSemasa = 'Pengesahan Perancangan PP BPKPM';
    $this->program_model->hantar($statusSemasa);
    $statusDeskripsi = 'Pengesahan untuk perancangan program oleh Penolong Pengarah BPKPM Ibu Pejabat';
    $this->program_status_model->tambahLog($penggunaBil, $programBil, $statusSemasa, $statusDeskripsi);
    redirect('program/bil/'.$programBil);
  }

  public function mengikutNegeri($sendStatus){
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('pengguna_model');
    $this->load->model('peranan_model');
    $this->load->model('program_model');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    switch($sesi){
      case 'US_PROGRAM' :
        $data['statusLaporan'] = hex2bin($sendStatus);
        $data['senaraiProgram'] = $this->program_model->rumusanPenganjurStatus($data['statusLaporan']);
        $data['dataProgram'] = $this->program_model;
        $this->load->view('us_program_na/program/rumusanProgram', $data);
        break;
      default :
        redirect(base_url());
    }
  }

  public function sahRancangHq(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $penggunaBil = $this->input->post('inputPengguna');
    if(empty($penggunaBil)){
      redirect(base_url());
    }
    $this->load->model('program_model');
    $this->load->model('program_status_model');
    $statusSemasa = 'Pengesahan Perancangan BPKPM';
    $this->program_model->hantar($statusSemasa);
    $statusDeskripsi = 'Pengesahan untuk perancangan program oleh BPKPM Ibu Pejabat';
    $this->program_status_model->tambahLog($penggunaBil, $programBil, $statusSemasa, $statusDeskripsi);
    redirect('program/bil/'.$programBil);
  }

  public function sahRancangPPPKPM(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $penggunaBil = $this->input->post('inputPengguna');
    if(empty($penggunaBil)){
      redirect(base_url());
    }
    $this->load->model('program_model');
    $this->load->model('program_status_model');
    $statusSemasa = 'Pengesahan Perancangan PP PKPM Negeri';
    $this->program_model->hantar($statusSemasa);
    $statusDeskripsi = 'Pengesahan untuk perancangan program oleh PP PKPM Negeri';
    $this->program_status_model->tambahLog($penggunaBil, $programBil, $statusSemasa, $statusDeskripsi);
    redirect('program/bil/'.$programBil);
  }

  public function mengikutDaerah($sendStatus){
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('pengguna_model');
    $this->load->model('peranan_model');
    $this->load->model('program_model');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    if(strpos($sesi, 'PKPM') !== FALSE){
      $sesi = 'PKPM';
    }
    switch($sesi){
      case 'PKPM' :
        $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
        $data['statusLaporan'] = hex2bin($sendStatus);
        $data['senaraiRumusan'] = $this->program_model->senaraiRumusanPpd($data['senaraiNegeri'], $data['statusLaporan']);
        $data['dataProgram'] = $this->program_model;
        $this->load->view('us_program_negeri_na/program/rumusanIkutDaerah', $data);
        break;
      default :
        redirect(base_url());
    }
  }

  public function senaraiIkutStatus($status){
    if(empty($status)){
      redirect(base_url());
    }
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('pengguna_model');
    $this->load->model('program_model');
    $this->load->model('jenis_model');
    $this->load->model('daerah_model');
    $this->load->model('parlimen_model');
    $this->load->model('dun_model');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    $status = hex2bin($status);
    $data['status'] = $status;
    if(strpos($sesi, 'PPD') !== FALSE){
      $sesi = 'PPD';
    }
    switch($sesi){
      case 'PPD' :
        $this->load->model('ppd_model');
        $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
        $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiStatus'] = $this->program_model->senaraiStatusIndividu($penggunaBil);
        $data['ppd'] = $this->ppd_model->ppd($data['pengguna']->pengguna_peranan_bil);
        if($data['ppd']->p_anggota == $data['pengguna']->bil){
          $data['senaraiProgram'] = $this->program_model->senaraiLaporanPpdIkutStatus($status, $data['pengguna']);
        }else{
          $data['senaraiProgram'] = $this->program_model->senaraiLaporanIndividuIkutStatus($status, $penggunaBil);
        }
        $this->load->view('ppd_na/program/ikutStatus', $data);
        break;
      default :
        redirect(base_url());
    }
  }

  public function muatTurunCarian(){
    $this->load->dbutil();
    $this->load->helper('file');
    $this->load->helper('download');
    $this->load->model('program_model');
    $this->load->model('pengguna_model');
    $this->load->model('daerah_model');
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $pengguna = $this->pengguna_model->pengguna($penggunaBil);
    if(strpos($sesi, 'PPD') !== FALSE){
      $sesi = 'PPD';
    }
    if(strpos($sesi, 'NEGERI') !== FALSE){
      $sesi = 'NEGERI';
    }
    if(strpos($sesi, 'PKPM') !== FALSE){
      $sesi = 'PKPM';
    }
    switch($sesi){
      case 'US_SISMAP' :
        $query = $this->program_model->kuiriSenaraiCarian(); // replace 'your_table' with your table name
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('senaraiProgram.csv', $data);
        break;
      case 'URUSETIA' :
        $query = $this->program_model->kuiriSenaraiCarian(); // replace 'your_table' with your table name
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('senaraiProgram.csv', $data);
        break;
      case 'PKPM' :
        $query = $this->program_model->kuiriSenaraiCarian(); // replace 'your_table' with your table name
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('senaraiProgram.csv', $data);
        break;
      case 'NEGERI' :
        $query = $this->program_model->kuiriSenaraiCarian(); // replace 'your_table' with your table name
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('senaraiProgram.csv', $data);
        break;
      case 'PPD' :
        $query = $this->program_model->kuiriSenaraiCarian(); // replace 'your_table' with your table name
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('senaraiProgram'.$pengguna->pengguna_peranan_bil.'.csv', $data);
        break;
      case 'US_PROGRAM' :
        $query = $this->program_model->kuiriSenaraiCarian(); // replace 'your_table' with your table name
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('senaraiProgramMengikutCarian.csv', $data);
        break;
      default :
          redirect(base_url());
      }
  }

  //KELAB MALAYSIAKU

  public function prosesKelab(){
    $programBil = $this->input->post('inputProgram');
    $penggunaBil = $this->input->post('inputPengguna');
    if(empty($programBil)){
      redirect(base_url());
    }
    $this->load->model('program_kelabmalaysiaku_model');
    $senaraiMaklumatTambahan = $this->program_kelabmalaysiaku_model->maklumatTambahan($programBil);
    if(empty($senaraiMaklumatTambahan)){
      $entri = $this->program_kelabmalaysiaku_model->tambahMaklumatTambahanPost();
    }else{
      $entri = $this->program_kelabmalaysiaku_model->kemaskiniMaklumatTambahanPost();
    }
    $senaraiKaum = $this->input->post('inputKaum');
    $bilMuridKaum = $this->input->post('inputMurid');
    if(!empty($bilMuridKaum)){
      $tempBil = count($bilMuridKaum);
      for($i = 0; $i < $tempBil; $i++){
          $namaKaum = $senaraiKaum[$i];
          $bilMurid = $bilMuridKaum[$i];
          $ada = $this->program_kelabmalaysiaku_model->senaraiKaumProgram($programBil, $namaKaum);
          if(empty($ada) && !empty($bilMurid)){
            $entri = $this->program_kelabmalaysiaku_model->tambahKaumProgram($programBil, $namaKaum, $bilMurid);
          }elseif(!empty($ada)){
            if($bilMurid == 0 || $bilMurid == '0' || empty($bilMurid)){
              $entri = $this->program_kelabmalaysiaku_model->padamKaumProgram($ada->mkpk_bil);
            }else{
              $entri = $this->program_kelabmalaysiaku_model->kemaskiniKaumProgram($ada->mkpk_bil, $bilMurid);
            }
          }
      }
    }
    $senaraiKelab = $this->input->post('inputKelab');
    $entri = $this->program_kelabmalaysiaku_model->padamKelabProgram($programBil);
    $bilKelab = count($senaraiKelab);
    if($bilKelab > 0){
      for($i = 0; $i < $bilKelab; $i++){
        $entri = $this->program_kelabmalaysiaku_model->tambahKelabProgram($programBil, $senaraiKelab[$i]);
      }
    }
    if($entri){
      $this->load->model('program_status_model');
      $status = $this->input->post('inputStatus');
        $statusDeskripsi = "Maklumat Penglibatan Kelab Malaysiaku telah dikemaskini";
        $this->program_status_model->tambahLog($penggunaBil, $programBil, $status, $statusDeskripsi);
      $setelahSelesaiProses = $this->program_kelabmalaysiaku_model->senarai($programBil);
      if(count($setelahSelesaiProses) > 0){
        $this->prosesSemakanLaporan($programBil, "BAHAGIAN G - PENGLIBATAN KELAB MALAYSIAKU", $penggunaBil);
      }
      if(empty($setelahSelesaiProses)){
        $this->tukarFalseSemakan($programBil, "BAHAGIAN G - PENGLIBATAN KELAB MALAYSIAKU", $penggunaBil);
      }
      redirect('program/bil/'.$programBil.'#g');
    }else{
      die("TERDAPAT MASALAH. SILA HUBUNGI URUS SETIA.");
    }
  }

  //PENERBITAN

  public function padamPenerbitanProgram(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $penerbitanBil = $this->input->post('inputpenerbitanBil');
    if(empty($penerbitanBil)){
      redirect('program/bil/'.$programBil."/#g");
    }
    $this->load->model('program_penerbitan_model');
    $entri = $this->program_penerbitan_model->padampenerbitanProgram($penerbitanBil);
    if($entri){
      $this->load->model('program_status_model');
      $penggunaBil = $this->input->post('inputPengguna');
      $tajuk = $this->input->post('inputTajuk');
      $status = $this->input->post('inputStatus');
      $statusDeskripsi = "Penerbitan Program: ".$tajuk." telah dipadam.";
      $this->program_status_model->tambahLog($penggunaBil, $programBil, $status, $statusDeskripsi);
      $setelahSelesaiProses = $this->program_penerbitan_model->senarai($programBil);
      if(empty($setelahSelesaiProses)){
        $this->tukarFalseSemakan($programBil, "BAHAGIAN I - EDARAN PENERBITAN", $penggunaBil);
      }
      redirect('program/bil/'.$programBil."/#g");
    }else{
      die('Terdapat masalah. Sila hubungi urus setia.');
    }
  }

  public function tambahPenerbitanProgram(){
    $tajuk = $this->input->post('inputpenerbitan');
    if(empty($tajuk)){
      redirect(base_url());
    }
    $programBil = $this->input->post('inputProgram');
    if(empty($programBil)){
      redirect(base_url());
    }
    $this->load->model('program_penerbitan_model');
    $ada = $this->program_penerbitan_model->ada($tajuk, $programBil);
    if(empty($ada)){
      $entri = $this->program_penerbitan_model->tambahpenerbitanPost();
      if($entri){
        $this->load->model('program_status_model');
        $penggunaBil = $this->input->post('inputPengguna');
        $status = $this->input->post('inputStatus');
        $statusDeskripsi = "Penerbitan Program telah ditambah: ".$tajuk;
        $this->program_status_model->tambahLog($penggunaBil, $programBil, $status, $statusDeskripsi);
        $this->prosesSemakanLaporan($programBil, "BAHAGIAN I - EDARAN PENERBITAN", $penggunaBil);
        redirect('program/bil/'.$programBil."#g");
      }else{
        die('Terdapat masalah');
      }
    }else{
      redirect('program/bil/'.$programBil."#g");
    }
  }

  //AGENSI

  public function padamAgensiProgram(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $agensiBil = $this->input->post('inputagensiBil');
    if(empty($agensiBil)){
      redirect('program/bil/'.$programBil."/#g");
    }
    $this->load->model('program_agensi_model');
    $entri = $this->program_agensi_model->padamagensiProgram($agensiBil);
    if($entri){
      $this->load->model('program_status_model');
      $penggunaBil = $this->input->post('inputPengguna');
      $tajuk = $this->input->post('inputTajuk');
      $status = $this->input->post('inputStatus');
      $statusDeskripsi = "Agensi Program: ".$tajuk." telah dipadam.";
      $this->program_status_model->tambahLog($penggunaBil, $programBil, $status, $statusDeskripsi);
      $setelahSelesaiProses = $this->program_agensi_model->senarai($programBil);
      if(empty($setelahSelesaiProses)){
        $this->tukarFalseSemakan($programBil, "BAHAGIAN H - KERJASAMA AGENSI LAIN", $penggunaBil);
      }
      redirect('program/bil/'.$programBil."/#g");
    }else{
      die('Terdapat masalah. Sila hubungi urus setia.');
    }
  }

  public function tambahAgensiProgram(){
    $tajuk = $this->input->post('inputagensi');
    if(empty($tajuk)){
      redirect(base_url());
    }
    $programBil = $this->input->post('inputProgram');
    if(empty($programBil)){
      redirect(base_url());
    }
    $this->load->model('program_agensi_model');
    $ada = $this->program_agensi_model->ada($tajuk, $programBil);
    if(empty($ada)){
      $entri = $this->program_agensi_model->tambahagensiPost();
      if($entri){
        $this->load->model('program_status_model');
        $penggunaBil = $this->input->post('inputPengguna');
        $status = $this->input->post('inputStatus');
        $statusDeskripsi = "Agensi Program telah ditambah: ".$tajuk;
        $this->program_status_model->tambahLog($penggunaBil, $programBil, $status, $statusDeskripsi);
        $this->prosesSemakanLaporan($programBil, "BAHAGIAN H - KERJASAMA AGENSI LAIN", $penggunaBil);
        redirect('program/bil/'.$programBil."#g");
      }else{
        die('Terdapat masalah');
      }
    }else{
      redirect('program/bil/'.$programBil."#g");
    }
  }

  //PENGISIAN

  public function padampengisianProgram(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $pengisianBil = $this->input->post('inputpengisianBil');
    if(empty($pengisianBil)){
      redirect('program/bil/'.$programBil."/#c");
    }
    $this->load->model('program_pengisian_model');
    $entri = $this->program_pengisian_model->padampengisianProgram($pengisianBil);
    if($entri){
      $this->load->model('program_status_model');
      $penggunaBil = $this->input->post('inputPengguna');
      $tajuk = $this->input->post('inputTajuk');
      $status = $this->input->post('inputStatus');
      $statusDeskripsi = "Pengisian Program: ".$tajuk." telah dipadam.";
      $this->program_status_model->tambahLog($penggunaBil, $programBil, $status, $statusDeskripsi);
      $senaraiPengisian = $this->program_pengisian_model->senaraipengisian($programBil);
      if(empty($senaraiPengisian)){
        $this->tukarFalseSemakan($programBil, 'BAHAGIAN C - PENGISIAN PROGRAM', $penggunaBil);
      }
      redirect('program/bil/'.$programBil."/#c");
    }else{
      die('Terdapat masalah. Sila hubungi urus setia.');
    }
  }

  public function tambahpengisianProgram(){
    $tajuk = $this->input->post('inputpengisian');
    if(empty($tajuk)){
      redirect(base_url());
    }
    $programBil = $this->input->post('inputProgram');
    if(empty($programBil)){
      redirect(base_url());
    }
    $penggunaBil = $this->input->post('inputPengguna');
    $this->load->model('program_pengisian_model');
    $ada = $this->program_pengisian_model->ada($tajuk, $programBil);
    $this->prosesSemakanLaporan($programBil, 'BAHAGIAN C - PENGISIAN PROGRAM', $penggunaBil);
    if(empty($ada)){
      $entri = $this->program_pengisian_model->tambahpengisianPost();
      if($entri){
        $this->load->model('program_status_model');
        $status = $this->input->post('inputStatus');
        $statusDeskripsi = "Pengisian Program telah ditambah: ".$tajuk;
        $this->program_status_model->tambahLog($penggunaBil, $programBil, $status, $statusDeskripsi);
        redirect('program/bil/'.$programBil."#c");
      }else{
        die('Terdapat masalah');
      }
    }else{
      redirect('program/bil/'.$programBil."#c");
    }
  }


  public function kuiriLaporan(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $this->load->model('program_model');
    $entri = $this->program_model->kuiriLaporanPost();
    if($entri){
      $this->load->model('program_status_model');
      $penggunaBil = $this->input->post('inputPengguna');
      $status = 'Kuiri';
      $statusDeskripsi = $this->input->post('inputJustifikasi');
      $this->program_status_model->tambahLog($penggunaBil, $programBil, $status, $statusDeskripsi);
      redirect('program/bil/'.$programBil);
    }else{
      die('Terdapat masalah berlaku. Sila rujuk urus setia RIMS.');
    }
  }

  public function batalLaporan(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $this->load->model('program_model');
    $entri = $this->program_model->batalLaporanPost();
    if($entri){
      $this->load->model('program_status_model');
      $penggunaBil = $this->input->post('inputPengguna');
      $status = 'Batal';
      $statusDeskripsi = $this->input->post('inputJustifikasi');
      $this->program_status_model->tambahLog($penggunaBil, $programBil, $status, $statusDeskripsi);
      redirect('program/bil/'.$programBil);
    }else{
      die('Terdapat masalah berlaku. Sila rujuk urus setia RIMS.');
    }
  }

  private function prosesPadamSemakan($programBil, $tajuk){
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('program_semakan_model');
    $semakan = $this->program_semakan_model->semakan($programBil, $tajuk);
    if(!empty($semakan) && $semakan->ps_isi == TRUE){
      $this->program_semakan_model->tukarFalse($semakan->ps_bil, $penggunaBil);
    }
  }

  public function padamKandunganProgram(){
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $kandunganBil = $this->input->post('inputKandunganBil');
    if(empty($kandunganBil)){
      redirect('program/bil/'.$programBil."/#b");
    }
    $this->load->model('program_kandungan_model');
    $entri = $this->program_kandungan_model->padamKandunganProgram($kandunganBil);
    if($entri){
      $this->load->model('program_status_model');
      $penggunaBil = $this->input->post('inputPengguna');
      $tajuk = $this->input->post('inputTajuk');
      $status = $this->input->post('inputStatus');
      $statusDeskripsi = "Tajuk Hebahan / Ceramah: ".$tajuk." telah dipadam.";
      $this->program_status_model->tambahLog($penggunaBil, $programBil, $status, $statusDeskripsi);
      $senaraiTajuk = $this->program_kandungan_model->senaraiTajuk($programBil);
      if(empty($senaraiTajuk)){
        $this->prosesPadamSemakan($programBil, 'BAHAGIAN B - TAJUK HEBAHAN / CERAMAH PROGRAM');
      }
      redirect('program/bil/'.$programBil."/#b");
    }else{
      die('Terdapat masalah. Sila hubungi urus setia.');
    }
  }

  public function tambahKandunganProgram(){
    $tajuk = $this->input->post('inputKandungan');
    if(empty($tajuk)){
      redirect(base_url());
    }
    $programBil = $this->input->post('inputProgram');
    if(empty($programBil)){
      redirect(base_url());
    }
    $this->load->model('program_kandungan_model');
    $ada = $this->program_kandungan_model->ada($tajuk, $programBil);
    if(empty($ada)){
      $entri = $this->program_kandungan_model->tambahKandunganPost();
      if($entri){
        $this->load->model('program_status_model');
        $penggunaBil = $this->input->post('inputPengguna');
        $status = $this->input->post('inputStatus');
        $statusDeskripsi = "Tajuk Hebahan / Ceramah telah ditambah: ".$tajuk;
        $this->program_status_model->tambahLog($penggunaBil, $programBil, $status, $statusDeskripsi);
        $this->prosesSemakanLaporan($programBil, 'BAHAGIAN B - TAJUK HEBAHAN / CERAMAH PROGRAM', $penggunaBil);
        redirect('program/bil/'.$programBil."#b");
      }else{
        die('Terdapat masalah');
      }
    }else{
      redirect('program/bil/'.$programBil."#b");
    }
  }

  public function muatTurun(){
    $this->load->dbutil();
    $this->load->helper('file');
    $this->load->helper('download');
    $this->load->model('program_model');
    $this->load->model('pengguna_model');
    $this->load->model('daerah_model');
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $pengguna = $this->pengguna_model->pengguna($penggunaBil);
    if(strpos($sesi, 'PPD') !== FALSE){
      $sesi = 'PPD';
    }
    if(strpos($sesi, 'NEGERI') !== FALSE){
      $sesi = 'NEGERI';
    }
    if(strpos($sesi, 'PKPM') !== FALSE){
      $sesi = 'PKPM';
    }
    switch($sesi){
      case 'US_SISMAP' :
        $query = $this->program_model->kuiriSenaraiDashboard(); // replace 'your_table' with your table name
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('senaraiProgram.csv', $data);
        break;
      case 'URUSETIA' :
        $query = $this->program_model->kuiriSenaraiDashboard(); // replace 'your_table' with your table name
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('senaraiProgram.csv', $data);
        break;
      case 'PKPM' :
        $this->load->model('peranan_model');
        $senaraiNegeri = $this->peranan_model->tugasNegeriPeranan($pengguna->pengguna_peranan_bil);
        $query = $this->program_model->kuiriSenaraiDashboardNegeri($senaraiNegeri); // replace 'your_table' with your table name
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('senaraiProgram.csv', $data);
        break;
      case 'NEGERI' :
        $query = $this->program_model->kuiriSenaraiDashboard(); // replace 'your_table' with your table name
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('senaraiProgram.csv', $data);
        break;
      case 'PPD' :
        $senaraiDaerah = $this->daerah_model->senaraiTugasanDaerah($pengguna->pengguna_peranan_bil);
        if($pengguna->pengguna_status == ""){
          $query = $this->program_model->kuiriSenaraiDashboardPpd($senaraiDaerah); // replace 'your_table' with your table name
        }else{
          $this->load->model('ppd_model');
          $ppd = $this->ppd_model->ppd($pengguna->pengguna_peranan_bil);
          if($ppd->p_anggota == $pengguna->bil){
            $query = $this->program_model->kuiriSenaraiDashboardPpd($senaraiDaerah);
          }else{
            $query = $this->program_model->kuiriDashboardIndividu($penggunaBil);
          }
        }
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('senaraiProgram'.$pengguna->pengguna_peranan_bil.'.csv', $data);
        break;
      case 'US_PROGRAM' :
        $query = $this->program_model->kuiriSenaraiDashboard(); // replace 'your_table' with your table name
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('senaraiProgram.csv', $data);
        break;
      default :
          redirect(base_url());
      }
  }

  public function bilangan(){
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('pengguna_model');
    $this->load->model('peranan_model');
    $this->load->model('program_model');
    $pengguna = $this->pengguna_model->pengguna($penggunaBil);
    if(strpos($sesi, 'PKPM') !== FALSE){
      $sesi = 'PKPM';
    }
    switch($sesi){
      case 'PKPM' :
				$senaraiNegeri = $this->peranan_model->tugasNegeriPeranan($pengguna->pengguna_peranan_bil);
        $tahun = date('Y');
        $jumlahProgram = $this->program_model->bilanganProgramNegeri($senaraiNegeri, $tahun);
        echo $jumlahProgram->jumlahProgram;
        break;
      default :
        redirect(base_url());
    }
  }

  public function keputusanCarian(){
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('pengguna_model');
    $this->load->model('program_model');
    $this->load->model('jenis_model');
    $this->load->model('negeri_model');
    $this->load->model('daerah_model');
    $this->load->model('parlimen_model');
    $this->load->model('dun_model');
    $this->load->model('peranan_model');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    if(strpos($sesi, 'PKPM') !== FALSE){
      $sesi = 'PKPM';
    }
    if(strpos($sesi, 'PPD') !== FALSE){
      $sesi = 'PPD';
    }
    if(strpos($sesi, 'PPN') !== FALSE){
      $sesi = 'PPN';
    }
    $data['programCarian'] = $this->input->post('inputJenis');
    $data['programNegeri'] = $this->input->post('inputNegeri');
    $data['programDaerah'] = $this->input->post('inputDaerah');
    $data['programParlimen'] = $this->input->post('inputParlimen');
    $data['programDun'] = $this->input->post('inputDun');
    $data['programStatus'] = $this->input->post('inputStatus');
    $data['programMula'] = $this->input->post('inputTarikhMula');
    $data['programTamat'] = $this->input->post('inputTarikhTamat');
    switch($sesi){
      case 'PPD' :
        $this->load->model('ppd_model');
        $this->load->model('senarai_kandungan_model');
        $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
        $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($data['pengguna']->pengguna_peranan_bil);
				$data['ppd'] = $this->ppd_model->ppd($data['pengguna']->pengguna_peranan_bil);
        if($data['ppd']->p_anggota == $data['pengguna']->bil){
          $data['senaraiStatus'] = $this->program_model->senaraiStatusPpd($data['pengguna']);
          $data['senaraiProgram'] = $this->program_model->keputusanCarianPpd($data['pengguna']->pengguna_peranan_bil);
      }else{
          $data['senaraiStatus'] = $this->program_model->senaraiStatusIndividu($penggunaBil);
          $data['senaraiProgram'] = $this->program_model->keputusanCarianIndividu($penggunaBil);
        }
        $data['senaraiNaratif'] = $this->senarai_kandungan_model->senarai();
        $this->load->view('ppd_na/program/keputusanCarian', $data);
        break;
      case 'PPN' :
        $data['senaraiProgram'] = $this->program_model->keputusanCarian();
        $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
        $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
        $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($data['senaraiNegeri']);
        $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($data['senaraiNegeri']);
        $data['senaraiStatus'] = $this->program_model->senaraiStatus();
        $this->load->view('ppn_na/program/keputusanCarian', $data);
        break;
      case 'PKPM' :
        $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiProgram'] = $this->program_model->keputusanCarianNegeri($data['senaraiNegeri']);
        $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
        $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
        $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($data['senaraiNegeri']);
        $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($data['senaraiNegeri']);
        $data['senaraiStatus'] = $this->program_model->senaraiStatus();
        $this->load->view('us_program_negeri_na/program/keputusanCarian', $data);
        break;
      case 'US_PROGRAM' : 
        $data['senaraiProgram'] = $this->program_model->keputusanCarian();
        $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
        $data['senaraiNegeri'] = $this->negeri_model->senarai();
        $data['senaraiDaerah'] = $this->daerah_model->senarai();
        $data['senaraiParlimen'] = $this->parlimen_model->senarai();
        $data['senaraiDun'] = $this->dun_model->senarai();
        $data['senaraiStatus'] = $this->program_model->senaraiStatus();
        $this->load->view('us_program_na/program/keputusanCarian', $data);
        break;
      default :
        redirect(base_url());
    }
  }

  public function prosesKomuniti(){
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    if(empty($sesi)){
      redirect(base_url());
    }
    $programBil = $this->input->post('inputProgram');
    if(empty($programBil)){
      redirect(base_url());
    }
    $entri = FALSE;
    $this->load->model('program_komuniti_model');
    $senaraiPilihanKomuniti = $this->input->post('inputKomuniti');
    $senaraiKehadiranKomuniti = $this->input->post('inputKehadiran');
    $senaraiKomunitiBil = $this->input->post('inputKomunitiBil');
    $statusProgram = $this->input->post('inputStatus');
    $senaraiKomunitiAda = $this->program_komuniti_model->senarai($programBil);
    $bilanganPilihanKomuniti = count($senaraiPilihanKomuniti);
    if($bilanganPilihanKomuniti == 0){
      $entri = $this->program_komuniti_model->padam($programBil);
      $this->tambahStatusLaporan($penggunaBil, $programBil, $statusProgram, 'Senarai Penglibatan Komuniti Telah Dipadam');
    }
    foreach($senaraiKomunitiAda as $k){
      $index = array_search($k->komuniti_program_bil, $senaraiPilihanKomuniti);
      if($index === FALSE){
        $entri = $this->program_komuniti_model->padamSatu($k->komuniti_program_bil);
        $this->tambahStatusLaporan($penggunaBil, $programBil, $statusProgram, 'Penglibatan Komuniti Telah Dipadam Kerana Tiada Pilihan Dibuat');
      }
    }
    for($y = 0; $y < $bilanganPilihanKomuniti; $y++){
      $i = array_search($senaraiPilihanKomuniti[$y], $senaraiKomunitiBil);
      if($i !== FALSE){
        $komunitiProgram = $this->program_komuniti_model->komunitiKehadiranProgram($programBil, $senaraiKomunitiBil[$i], $senaraiKehadiranKomuniti[$i]);
        if(empty($komunitiProgram)){
          $komunitiProgram = $this->program_komuniti_model->komunitiProgram($programBil, $senaraiKomunitiBil[$i]);
          if(empty($komunitiProgram)){
            $entri = $this->program_komuniti_model->tambahSatu($senaraiKomunitiBil[$i], $senaraiKehadiranKomuniti[$i], $programBil);
            $this->tambahStatusLaporan($penggunaBil, $programBil, $statusProgram, 'Penglibatan Komuniti Telah Ditambah');
          }else{
            if($senaraiKehadiranKomuniti[$i] == 0){
              $entri = $this->program_komuniti_model->padamSatu($komunitiProgram->komuniti_program_bil);
              $this->tambahStatusLaporan($penggunaBil, $programBil, $statusProgram, 'Penglibatan Komuniti Telah Dipadam');
            }else{
              $entri = $this->program_komuniti_model->kemaskiniBilanganKehadiran($senaraiKehadiranKomuniti[$i], $komunitiProgram->komuniti_program_bil);
              $this->tambahStatusLaporan($penggunaBil, $programBil, $statusProgram, 'Penglibatan Komuniti Telah Dikemaskini');
            }
          }
        }elseif(!empty($komunitiProgram) && $senaraiKehadiranKomuniti[$i] == 0){
          $entri = $this->program_komuniti_model->padamSatu($komunitiProgram->komuniti_program_bil);
          $this->tambahStatusLaporan($penggunaBil, $programBil, $statusProgram, 'Maklumat Komuniti telah dimasukkan dengan tiada bilangan kehadiran. Penglibatan Komuniti Telah Dipadam');
        }
      }
    }
    $setelahSelesaiProses = $this->program_komuniti_model->senarai($programBil);
    if(count($setelahSelesaiProses) > 0){
      $this->prosesSemakanLaporan($programBil, "BAHAGIAN E - PENGLIBATAN KOMUNITI", $penggunaBil);
    }
    if(empty($setelahSelesaiProses)){
      $this->tukarFalseSemakan($programBil, "BAHAGIAN E - PENGLIBATAN KOMUNITI", $penggunaBil);
    }
    redirect('program/bil/'.$programBil."#e");
  }

  //1. PROGRAM URL
    //1.1 ADD NEW URL
    public function prosesTambahPautan(){
      //1.1.1 INITIALIZATION
      $sesi = strtoupper($this->session->userdata('peranan'));
      $penggunaBil = $this->session->userdata('pengguna_bil');
      //1.1.2 PROGRAM BIL
      $programBil = $this->input->post('inputProgramBil');
      if(empty($programBil)){
        redirect(base_url());
      }
      //1.1.3 LOAD MODEL
      $this->load->model('program_pautan_model');
      //1.1.4 ACCORDINGLY -  SESI

          $addedData = $this->program_pautan_model->tambahPautan();
          //A.2 REDIRECT
          $this->prosesSemakanLaporan($programBil, "BAHAGIAN K - PAUTAN MEDIA SOSIAL / LIPUTAN MEDIA", $penggunaBil);
          redirect('program/bil/'.$programBil."#k");

    }
    //1.2 EDIT URL
    public function kemaskiniPautanProgram(){
      //1.2.1 INITIALIZATION
      $sesi = strtoupper($this->session->userdata('peranan'));
      $penggunaBil = $this->session->userdata('pengguna_bil');
      //1.2.2 PROGRAM BIL
      $programBil = $this->input->post('inputProgramBil');
      if(empty($programBil)){
        redirect(base_url());
      }
      //1.2.3 PAUTAN BIL
      $pautanBil = $this->input->post('inputPautanBil');
      if(empty($pautanBil)){
        redirect(base_url());
      }
      //1.2.4 LOAD MODEL
      $this->load->model('program_pautan_model');
      //1.2.5 ACCORDINGLY - SESI

          //A.1 KEMASKINI PAUTAN
          $this->program_pautan_model->kemaskiniPautan();
          //A.2 REDIRECT
          $this->prosesSemakanLaporan($programBil, "BAHAGIAN K - PAUTAN MEDIA SOSIAL / LIPUTAN MEDIA", $penggunaBil);
          redirect('program/bil/'.$programBil."#f");

    }
    //1.3 DELETE PAUTAN
    public function padamPautanProgram(){
      //1.3.1 INITIALIZATION
      $sesi = strtoupper($this->session->userdata('peranan'));
      $penggunaBil = $this->session->userdata('pengguna_bil');
    //1.3.2 PROGRAM BIL
      $programBil = $this->input->post('inputProgramBil');
      if(empty($programBil)){
        redirect(base_url());
      }
      //1.3.3 PAUTAN BIL
      $pautanBil = $this->input->post('inputPautanBil');
      if(empty($pautanBil)){
        redirect(base_url());
      }
      //1.3.4 LOAD MODEL
      $this->load->model('program_pautan_model');

          $this->program_pautan_model->padamPautan();
          //A.2 REDIRECT
          $this->tukarFalseSemakan($programBil, "BAHAGIAN K - PAUTAN MEDIA SOSIAL / LIPUTAN MEDIA", $penggunaBil);
          redirect('program/bil/'.$programBil."#f");

    }

  public function kemaskiniObp(){
    //INTIALIZATION
    $sesi = strtoupper($this->session->userdata('peranan'));
    if(empty($sesi)){
      redirect(base_url());
    }
    //CHECK IF PROGRAM BIL IS NOT EMPTY
    $programBil = $this->input->post('inputProgramBil');
    $penggunaBil = $this->input->post('inputPenggunaBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    //LOAD MODEL
    $this->load->model('program_obp_model');
    $this->load->model('obp_model');
    $this->load->model('program_model');
    $this->load->model('peranan_model');
    //LOAD DATA
    $program = $this->program_model->singleProgram($programBil);

        $this->program_obp_model->resetSenaraiObp($programBil);
        $senaraiObp = $this->input->post('inputObp');
        if(!empty($senaraiObp)){
          for($i = 0; $i < count($senaraiObp); $i++){
            $tempObp = explode("_", $senaraiObp[$i]);
            $obpBil = $tempObp[0];
            $obpPeranan = $tempObp[1];
              //$obp = $this->obp_model->exactObp($peranan->peranan_bil, $program->program_negeri, $program->program_daerah, $program->program_parlimen, $program->program_dun, $senaraiObp[$i]);
              $obp = $this->obp_model->obpBilPeranan($obpBil, $obpPeranan);
              if(!empty($obp)){
                $obpWujud = $this->program_obp_model->semak($programBil, $obp->obp_nama, $obp->obp_jawatan, $obp->obp_id);
                if(empty($obpWujud)){
                  $this->program_obp_model->tambahObp($programBil, $obp->obp_nama, $obp->obp_jawatan, $obp->obp_id, $penggunaBil);
                }
              }
          }
        }
        $setelahSelesaiProses = $this->program_obp_model->senaraiObp($programBil);
        if(count($setelahSelesaiProses) > 0){
          $this->prosesSemakanLaporan($programBil, "BAHAGIAN F - SENARAI OBP", $penggunaBil);
        }
        if(empty($setelahSelesaiProses)){
          $this->tukarFalseSemakan($programBil, "BAHAGIAN F - SENARAI OBP", $penggunaBil);
        }
        redirect('program/bil/'.$programBil."#f");

  }

  public function padamLokasi(){
    //INITIALIZATION
    $sesi = strtoupper($this->session->userdata('peranan'));
    //CHECK IF LOKASI BIL IS NOT EMPTY
    $lokasiBil = $this->input->post('inputLokasiBil');
    if(empty($lokasiBil)){
      redirect(base_url());
    }
    //CHECK IF PROGRAM BIL IS NOT EMTPY
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    //CHECK IF PENGGUNA BIL
    $penggunaBil = $this->input->post('inputPenggunaBil');
    if(empty($penggunaBil)){
      redirect(base_url());
    }
    //LOAD MODEL
    $this->load->model('program_lokasi_model');
    $this->load->model('program_status_model');
    $this->load->model('program_model');
    //ACCORDINGLY
        $program = $this->program_model->singleProgram($programBil);
        $this->program_lokasi_model->padamLokasi($programBil, $lokasiBil);
        //1. ADD STATUS
        $statusCode = $program->program_status;
        $statusDeskripsi = 'Memadam lokasi.';
        $this->program_status_model->tambahLog($penggunaBil, $programBil, $statusCode, $statusDeskripsi);
        $this->tukarFalseSemakan($programBil, "BAHAGIAN D - LOKASI PROGRAM", $penggunaBil);
        redirect('program/bil/'.$programBil."#d");

  }

  public function tambahLokasiProgram(){
    //INITIALIZATION
    $sesi = strtoupper($this->session->userdata('peranan'));
    //CHECK IF PROGRAM BIL IS EMPTY
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    //CHECK IF PENGGUNA BIL IS EMPTY
    $penggunaBil = $this->input->post('inputPenggunaBil');
    if(empty($penggunaBil)){
      redirect(base_url());
    }
    //LOAD MODEL
    $this->load->model('program_lokasi_model');
    $this->load->model('program_status_model');
    $this->load->model('program_model');

        $this->program_lokasi_model->tambahPost();
        //1. ADD STATUS - ADDING NEW LOCATION
    $program = $this->program_model->singleProgram($programBil);
    $statusCode = $program->program_status;
        $statusDeskripsi = 'Menambah lokasi baharu.';
        $this->program_status_model->tambahLog($penggunaBil, $programBil, $statusCode, $statusDeskripsi);
        $this->prosesSemakanLaporan($programBil, "BAHAGIAN D - LOKASI PROGRAM", $penggunaBil);
        redirect('program/bil/'.$programBil."#d");

  }

  private function prosesSemakanLaporan($programBil, $tajukSemakan, $penggunaBil){
    $this->load->model('program_semakan_model');
    $semakanLaporan = $this->program_semakan_model->semakan($programBil, $tajukSemakan);
    if(empty($semakanLaporan)){
      $this->program_semakan_model->tambah($programBil, $tajukSemakan, $penggunaBil);
    }elseif($semakanLaporan->ps_isi == FALSE){
      $this->program_semakan_model->selesai($semakanLaporan->ps_bil, $tajukSemakan, $penggunaBil);
    }
  }

  public function prosesKemaskiniA(){
    //INITIALIZATION
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    //LOAD MODEL
    $this->load->model('program_model');
    $this->load->model('pengguna_model');
    $this->load->model('program_status_model');
    //ACCORDINGLY
    $programBil = $this->input->post('inputProgramBil');
        if(empty($programBil)){
          redirect(base_url());
        }
        //GET PELAPOR VALUE
        $pelaporBil = $this->input->post('inputPelapor');
        if(empty($pelaporBil)){
          redirect(base_url());
        }
        $pelapor = $this->pengguna_model->pengguna($pelaporBil);
        $noTelPelapor = $pelapor->no_tel;
        //UPDATE VALUES
        $this->program_model->kemaskiniA($noTelPelapor);
        $tempProgram = $this->program_model->singleProgram($programBil);
        //UPDATE LOG
        $statusCode = $tempProgram->program_status;
        $statusDeskripsi = 'Kemaskini Maklumat Am Program';
        $this->program_status_model->tambahLog($pelaporBil, $programBil, $statusCode, $statusDeskripsi);
        //REDIRECT
        $this->prosesSemakanLaporan($programBil, 'BAHAGIAN A - MAKLUMAT AM PROGRAM', $penggunaBil);
        redirect('program/bil/'.$programBil."#a");
  }

  public function prosesTambahPost(){
    //INITIALIZATION
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    if(strpos($sesi, 'PPD') !== FALSE){
      $sesi = 'PPD';
    }

    //SET PKPM
    if(strpos($sesi, 'PKPM') !== FALSE){
      $sesi = 'PKPM';
    }
    if(strpos($sesi, 'NEGERI') !== FALSE){
      $sesi = 'NEGERI';
    }

    //LOAD MODEL
    $this->load->model('program_status_model');
    $this->load->model('pengguna_model');

    //LOAD DATA
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

    //ACCORDINGLY
    switch($sesi){
      case 'NEGERI' :
        //GET PELAPOR BIL
        $pelaporBil = $this->input->post('inputPelapor');
        //IF EMPTY PELAPORBIL REDIRECT
        if(empty($pelaporBil)){
          redirect(base_url());
        }
        //LOAD MODEL
        //1. PENGGUNA MODEL
        $this->load->model('pengguna_model');
        //2. PROGRAM MODEL
        $this->load->model('program_model');
        //GET PELAPOR BY PELAPORBIL
        $pelapor = $this->pengguna_model->pengguna($pelaporBil);
        //IF PELAPOR EMPTY REDIRECT
        if(empty($pelapor)){
          redirect(base_url());
        }
        //GET NOMBORTELEFON
        $nomborTelefon = $pelapor->no_tel;
        //IF NOMBORTELEFON EMPTY REDIRECT
        if(empty($nomborTelefon)){
          redirect(base_url());
        }
        //ENTER DATA AND RETRIEVE LATEST ID
        $idTerakhir = $this->program_model->tambahPostDrafNegeri($nomborTelefon);
        //IF EMPTY IDTERAKHIR REDIRECT
        if(empty($idTerakhir)){
          redirect(base_url());
        }
        //STATUS - DRAF 1 - LAPORAN DICIPTA
        $statusCode = 'Draf GSPI Negeri';
        $statusDeskripsi = 'Laporan dicipta';
        $programBil = $idTerakhir['last_id'];
        $this->program_status_model->tambahLog($pelaporBil, $programBil, $statusCode, $statusDeskripsi);
        //NEED TO REDIRECT BASE ON PROGRAMBIL
        redirect('program/bil/'.$programBil);
        break;
      case 'PPD' :
        //GET PELAPOR BIL
        $pelaporBil = $this->input->post('inputPelapor');
        //IF EMPTY PELAPORBIL REDIRECT
        if(empty($pelaporBil)){
          redirect(base_url());
        }
        //LOAD MODEL
        //1. PENGGUNA MODEL
        $this->load->model('pengguna_model');
        //2. PROGRAM MODEL
        $this->load->model('program_model');
        //GET PELAPOR BY PELAPORBIL
        $pelapor = $this->pengguna_model->pengguna($pelaporBil);
        //IF PELAPOR EMPTY REDIRECT
        if(empty($pelapor)){
          redirect(base_url());
        }
        //GET NOMBORTELEFON
        $nomborTelefon = $pelapor->no_tel;
        //IF NOMBORTELEFON EMPTY REDIRECT
        if(empty($nomborTelefon)){
          redirect(base_url());
        }
        //ENTER DATA AND RETRIEVE LATEST ID
        $idTerakhir = $this->program_model->tambahPostDraf($nomborTelefon);
        //IF EMPTY IDTERAKHIR REDIRECT
        if(empty($idTerakhir)){
          redirect(base_url());
        }
        //STATUS - DRAF 1 - LAPORAN DICIPTA
        $statusCode = 'Draf';
        $statusDeskripsi = 'Laporan dicipta';
        $programBil = $idTerakhir['last_id'];
        $senaraiNaratif = $this->input->post('inputNaratif');
        if(!empty($senaraiNaratif)){
          $this->load->model('program_kandungan_model');
          for($i = 0; $i < count($senaraiNaratif); $i++){
            $this->program_kandungan_model->tambahKandunganManual($programBil, $senaraiNaratif[$i], $pelaporBil);
          }
        }
        $this->program_status_model->tambahLog($pelaporBil, $programBil, $statusCode, $statusDeskripsi);
        $this->prosesSemakanLaporan($programBil, 'BAHAGIAN A - MAKLUMAT AM PROGRAM', $penggunaBil);
        //NEED TO REDIRECT BASE ON PROGRAMBIL
        redirect('program/bil/'.$programBil);
        break;
      case 'PKPM' :
        //GET PELAPOR BIL
        $pelaporBil = $this->input->post('inputPelapor');
        //IF EMPTY PELAPORBIL REDIRECT
        if(empty($pelaporBil)){
          redirect(base_url());
        }
        //LOAD MODEL
        //1. PENGGUNA MODEL
        $this->load->model('pengguna_model');
        //2. PROGRAM MODEL
        $this->load->model('program_model');
        //GET PELAPOR BY PELAPORBIL
        $pelapor = $this->pengguna_model->pengguna($pelaporBil);
        //IF PELAPOR EMPTY REDIRECT
        if(empty($pelapor)){
          redirect(base_url());
        }
        //GET NOMBORTELEFON
        $nomborTelefon = $pelapor->no_tel;
        //IF NOMBORTELEFON EMPTY REDIRECT
        if(empty($nomborTelefon)){
          redirect(base_url());
        }
        //ENTER DATA AND RETRIEVE LATEST ID
        $idTerakhir = $this->program_model->tambahPostDrafNegeri($nomborTelefon);
        //IF EMPTY IDTERAKHIR REDIRECT
        if(empty($idTerakhir)){
          redirect(base_url());
        }
        //STATUS - DRAF 1 - LAPORAN DICIPTA
        $statusCode = 'Draf Negeri';
        $statusDeskripsi = 'Laporan dicipta';
        $programBil = $idTerakhir['last_id'];
        $senaraiNaratif = $this->input->post('inputNaratif');
        if(!empty($senaraiNaratif)){
          $this->load->model('program_kandungan_model');
          for($i = 0; $i < count($senaraiNaratif); $i++){
            $this->program_kandungan_model->tambahKandunganManual($programBil, $senaraiNaratif[$i], $pelaporBil);
          }
        }
        $this->program_status_model->tambahLog($pelaporBil, $programBil, $statusCode, $statusDeskripsi);
        //NEED TO REDIRECT BASE ON PROGRAMBIL
        redirect('program/bil/'.$programBil);
        break;
      case 'US_PROGRAM' :
        //GET PELAPOR BIL
        $pelaporBil = $this->input->post('inputPelapor');
        //IF EMPTY PELAPORBIL REDIRECT
        if(empty($pelaporBil)){
          redirect(base_url());
        }
        //LOAD MODEL
        //1. PENGGUNA MODEL
        $this->load->model('pengguna_model');
        //2. PROGRAM MODEL
        $this->load->model('program_model');
        //GET PELAPOR BY PELAPORBIL
        $pelapor = $this->pengguna_model->pengguna($pelaporBil);
        //IF PELAPOR EMPTY REDIRECT
        if(empty($pelapor)){
          redirect(base_url());
        }
        //GET NOMBORTELEFON
        $nomborTelefon = $pelapor->no_tel;
        //IF NOMBORTELEFON EMPTY REDIRECT
        if(empty($nomborTelefon)){
          redirect(base_url());
        }
        //ENTER DATA AND RETRIEVE LATEST ID
        $idTerakhir = $this->program_model->tambahPost($nomborTelefon);
        //IF EMPTY IDTERAKHIR REDIRECT
        if(empty($idTerakhir)){
          redirect(base_url());
        }
        //STATUS - DRAF 1 - LAPORAN DICIPTA
        $statusCode = 'Jadual Aktiviti';
        $statusDeskripsi = 'Laporan dicipta';
        $programBil = $idTerakhir['last_id'];
        $this->program_status_model->tambahLog($data['pengguna']->bil, $programBil, $statusCode, $statusDeskripsi);
        //NEED TO REDIRECT BASE ON PROGRAMBIL
        redirect('program/bil/'.$programBil);
        break;
      default :
        redirect(base_url());
    }
  }

  public function getSenaraiProgram()
  {
    $sesi = strtoupper($this->session->userdata('peranan'));
    if(strpos($sesi, 'PPD') !== FALSE){
      $sesi = 'PPD';
    }
    if(strpos($sesi, 'NEGERI') !== FALSE){
      $sesi = 'NEGERI';
    }
    $this->load->model('program_model');
    switch($sesi){
      case 'PPD' :
        //IKUT PERANAN PPD
        $data['senaraiProgram'] = array();
        $this->load->view('ppd_na/program/komponen/senaraiProgram', $data);
        break;
      case 'NEGERI' :
        //IKUT AKAUN NEGERI
        $data['senaraiProgram'] = array();
        $this->load->view('negeri_na/program/komponen/senaraiProgram', $data);
        break;
      case 'URUSETIA' :
        //SEMUA
        $data['senaraiProgram'] = $this->program_model->senaraiPenuh();
        $this->load->view('urusetia_na/program/komponen/senaraiProgram', $data);
      case 'US_PROGRAM' :
        //SEMUA
        $data['senaraiProgram'] = $this->program_model->senaraiPenuh();
        $this->load->view('us_program_na/program/komponen/senaraiProgram', $data);
        break;
      default :
        redirect(base_url());
    }
  }

  //ALL
  //1. PROSES PADAM PROGRAM
  public function prosesPadamProgram()
  {
    //1.1 INITIALIZATION
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    //1.2 PROGRAM BIL
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    //1.3 APPROVAL
    $approval = $this->input->post('inputSetuju');
    if(empty($approval)){
      redirect('program/bil/'.$programBil);
    }
    //1.4 LOAD HELPER
    $this->load->helper('file');
    //1.5 LOAD MODEL
    $this->load->model('program_model');
    $this->load->model('gambar_model');
    $this->load->model('program_lokasi_model');
    $this->load->model('program_obp_model');
    $this->load->model('program_gambar_model');
    $this->load->model('program_pautan_model');
    $this->load->model('program_status_model');
    $this->load->model('pengguna_model');
    $this->load->model('program_kandungan_model');
    //1.6 LOAD DATA
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    //1.7 SWITCH - SESI

        //1.7.1.A PADAM PROGRAM
        $this->program_model->padamPost();
        //1.7.1.B PADAM LOKASI
        $this->program_lokasi_model->padamPost();
        //1.7.1.C PADAM SENARAI OBP
        $this->program_obp_model->padamPost();
        //1.7.1.D DELETE GAMBAR
          //i. LIST FILE
          $senaraiGambar = $this->program_gambar_model->senaraiGambarIkutProgram($programBil);
          //LOAD SENARAI GAMBAR
          foreach($senaraiGambar as $g):
          //ii. DELETE FILE
          $filePointer = './assets/img/gambarProgram/'.$g->gambar_program_nama_fail;
					if(file_exists($filePointer)){
						unlink($filePointer);
					}
          endforeach;
          //iii. DELETE ROWS DATABASE
          $this->program_gambar_model->padamPost();
        //1.7.1.E DELETE PAUTAN MEDIA SOSIAL
        $this->program_pautan_model->padamPost();
        //1.7.1.F PADAM STATUS LOG
        $this->program_status_model->padamPost();
        $this->program_kandungan_model->padamPost();
        //1.7.1.G VIEW
        switch($sesi){
          case 'PPD' :
            $this->load->view('ppd_na/program/successDelete', $data);
            break;
          case 'NEGERI' :
            $this->load->view('negeri_na/program/successDelete', $data);
            break;
          case 'PKPM' :
            $this->load->view('us_program_negeri_na/program/successDelete', $data);
            break;
          case 'URUSETIA' :
            $this->load->view('urusetia_na/program/successDelete', $data);
            break; 
          case 'US_SISMAP' :
            $this->load->view('us_sismap_na/program/successDelete', $data);
            break;
          default :
            $this->load->view('us_program_na/program/successDelete', $data);
            break;      
        }
    
  }

  public function padam($programBil)
  { 
    $sesi = strtoupper($this->session->userdata('peranan'));
    if(strpos($sesi, 'PPD') !== FALSE)
    {
      $sesi = 'PPD';
    }
    if(strpos($sesi, 'NEGERI') !== FALSE)
    {
      $sesi = 'NEGERI';
    }
    $this->load->model('program_model');
    $data['program'] = $this->program_model->programDetail($programBil);
    $this->load->view('susunletak/atas', $data);
    switch($sesi)
    {
      case 'URUSETIA' : $this->load->view('program/padam_program');
                        break;
      case 'PPD'  : $this->load->view('ppd/program/padam_program');
                    break;
      case 'NEGERI'  : $this->load->view('negeri/program/padam_program');
                    break;
      default : redirect(base_url());
    }
    
    $this->load->view('susunletak/bawah');
  }

  public function senarai_padam()
  {
    $sesi = strtoupper($this->session->userdata('peranan'));
    $perananBil = $this->session->userdata('peranan_bil');
    if(strpos($sesi, 'PPD') !== FALSE){
      $sesi = 'PPD';
    }
    if(strpos($sesi, 'NEGERI') !== FALSE)
    {
      $sesi = 'NEGERI';
      $this->load->model('winnable_candidate_assign_model');
      $this->load->model('pengguna_model');
      $namaNegeri = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
    }
    $this->load->model('program_model');
    
    $this->load->view('susunletak/atas');
    switch($sesi){
      case 'PPD'  : $data['senaraiProgram'] = $this->program_model->senaraiProgramPeranan($perananBil);
                    $this->load->view('ppd/program/senarai_padam', $data);
                    break;
      case 'NEGERI'  : $data['senaraiProgram'] = $this->program_model->senaraiProgramNegeri($namaNegeri);
                    $this->load->view('negeri/program/senarai_padam', $data);
                    break;
      default  : redirect(base_url());
    }
    $this->load->view('susunletak/bawah');
  }

  public function senarai_kemaskini()
  {
    $sesi = strtoupper($this->session->userdata('peranan'));
    $perananBil = $this->session->userdata('peranan_bil');
    if(strpos($sesi, 'PPD') !== FALSE){
      $sesi = 'PPD';
    }
    if(strpos($sesi, 'NEGERI') !== FALSE)
    {
      $sesi = 'NEGERI';
      $this->load->model('winnable_candidate_assign_model');
      $this->load->model('pengguna_model');
      $namaNegeri = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
    }
    $this->load->model('program_model');
    
    $this->load->view('susunletak/atas');
    switch($sesi){
      case 'PPD'  : $data['senaraiProgram'] = $this->program_model->senaraiProgramPeranan($perananBil);
                    $this->load->view('ppd/program/senarai_kemaskini', $data);
                    break;
      case 'NEGERI'  : $data['senaraiProgram'] = $this->program_model->senaraiProgramNegeri($namaNegeri);
                    $this->load->view('negeri/program/senarai_kemaskini', $data);
                    break;
      default  : redirect(base_url());
    }
    $this->load->view('susunletak/bawah');
  }

  public function senaraiDraf(){
    $sesi = strtoupper($this->session->userdata('peranan'));
    $perananBil = $this->session->userdata('peranan_bil');
    if(strpos($sesi, 'PPD') !== FALSE){
      $sesi = 'PPD';
    }
    $this->load->model('program_model');
    $this->load->model('pengguna_model');
    $this->load->model('jenis_model');
    $this->load->model('daerah_model');
    $this->load->model('parlimen_model');
    $this->load->model('dun_model');
    $this->load->model('negeri_model');
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    switch($sesi){
      case 'PPD' :
        $data['senaraiProgram'] = $this->program_model->senaraiDraf($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
        $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiStatus'] = $this->program_model->senaraiStatus();
        $this->load->view('ppd_na/program/senaraiDraf', $data);
        break;
      default  : redirect(base_url());
    }
  }

  public function senarai(){
    $sesi = strtoupper($this->session->userdata('peranan'));
    $perananBil = $this->session->userdata('peranan_bil');
    if(strpos($sesi, 'PPD') !== FALSE){
      $sesi = 'PPD';
    }
    if(strpos($sesi, 'NEGERI') !== FALSE){
      $sesi = 'NEGERI';
    }
    if(strpos($sesi, 'PKPM') !== FALSE){
      $sesi = 'PKPM';
    }
    if(strpos($sesi, 'PPN') !== FALSE){
      $sesi = 'PPN';
    }
    $this->load->model('program_model');
    $this->load->model('pengguna_model');
    $this->load->model('jenis_model');
    $this->load->model('daerah_model');
    $this->load->model('parlimen_model');
    $this->load->model('dun_model');
    $this->load->model('negeri_model');
    $this->load->model('peranan_model');
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    switch($sesi){
      case 'PPN' :
        $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiProgram'] = $this->program_model->senaraiDashboardNegeri($data['senaraiNegeri']);
        $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
        $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
        $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($data['senaraiNegeri']);
        $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($data['senaraiNegeri']);
        $data['senaraiStatus'] = $this->program_model->senaraiStatus();
        $this->load->view('ppn_na/program/dashboard', $data);
        break;
      case 'PKPM' :
        $this->load->model('senarai_kandungan_model');
        $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiProgram'] = $this->program_model->senaraiDashboardNegeri($data['senaraiNegeri']);
        $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
        $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
        $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($data['senaraiNegeri']);
        $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($data['senaraiNegeri']);
        $data['senaraiStatus'] = $this->program_model->senaraiStatus();
        $data['senaraiNaratif'] = $this->senarai_kandungan_model->senarai();
        $this->load->view('us_program_negeri_na/program/dashboard', $data);
        break;
      case 'US_PROGRAM' :
        //$data['senaraiProgram'] = $this->program_model->senaraiDashboard();
        $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
        $data['senaraiNegeri'] = $this->negeri_model->senarai();
        $data['senaraiDaerah'] = $this->daerah_model->senarai();
        $data['senaraiParlimen'] = $this->parlimen_model->senarai();
        $data['senaraiDun'] = $this->dun_model->senarai();
        $data['senaraiStatus'] = $this->program_model->senaraiStatus();
        $this->load->view('us_program_na/program/dashboard', $data);
        break;
      case 'DATA' :
        $data['senaraiProgram'] = $this->program_model->senaraiDashboard();
        $this->load->view('susunletak/atas', $data);
        $this->load->view('data/program/senaraiPenuh');
        $this->load->view('susunletak/bawah');
        break;
      case 'PPD' :
        $this->load->model('ppd_model');
        $this->load->model('senarai_kandungan_model');
				$data['ppd'] = $this->ppd_model->ppd($data['pengguna']->pengguna_peranan_bil);
        if(empty($data['pengguna']->pengguna_status)){
          $senaraiPelapor = $this->pengguna_model->senarai_pelapor($data['pengguna']->pengguna_peranan_bil);
        }else{
          $senaraiPelapor = array($data['pengguna']);
          if($data['ppd']->p_anggota == $data['pengguna']->bil){
            $data['senaraiProgram'] = $this->program_model->senaraiProgramPpd($data['pengguna']);
            $data['senaraiStatus'] = $this->program_model->senaraiStatusPpd($data['pengguna']);
          }else{
            $data['senaraiProgram'] = $this->program_model->senaraiProgramPelapor($senaraiPelapor);
            $data['senaraiStatus'] = $this->program_model->senaraiStatusIndividu($penggunaBil);
          }
        }
        $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
        $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiNaratif'] = $this->senarai_kandungan_model->senarai();
        $this->load->view('ppd_na/program/dashboard', $data);
        break;
      case 'US_PROGRAM2' :
        $data['senaraiProgram'] = $this->program_model->senaraiDashboard();
        $this->load->view('us_program_na/program/dashboard', $data);
        break;
      case 'NEGERI'  :
        $this->load->view('negeri_na/program/dashboard', $data);
        break;
      default  : redirect(base_url());
    }
  }

   public function index()
   {
      $sesi = strtoupper($this->session->userdata('peranan'));
      $this->load->helper('url');
     $this->load->library('form_validation');
     $this->load->model('program_model');
     $this->load->model('jenis_model');
     $this->load->model('gambar_model');
     $this->load->model('daerah_model');
     $this->load->model('parlimen_model');
     $this->load->model('dun_model');
     $this->load->model('winnable_candidate_assign_model');
     $this->load->model('pengguna_model');
     $this->load->model('negeri_model');
     $this->load->model('peranan_model');
     //$data['senaraiProgram'] = $this->program_model->semua();
     $data['dataJenis'] = $this->jenis_model;
     $data['dataGambar'] = $this->gambar_model;
     if(strpos($sesi, 'PPD') !== FALSE){
      $sesi = 'PPD';
     }
     if(strpos($sesi, 'NEGERI') !== FALSE){
      $sesi = 'NEGERI';
     }
     //SET PKPM
     if(strpos($sesi, 'PKPM') !== FALSE){
      $sesi = 'PKPM';
     }
     $penggunaBil = $this->session->userdata('pengguna_bil');
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
     switch($sesi){
      case 'DATA' :
        $this->load->view('us_sismap_na/program/laman', $data);
        break;
      //PKPM untuk negeri
      case 'PKPM' :
        $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
        $senaraiAnggota = $this->pengguna_model->senaraiAnggotaNegeri($data['senaraiNegeri']);
        //$data['senaraiRumusanProgram'] = $this->program_model->senaraiRumusanProgramNegeri($data['senaraiNegeri']);
        $data['senaraiRumusanProgram'] = $this->program_model->senaraiRumusanAnggota($senaraiAnggota);
        $this->load->view('us_program_negeri_na/program/laman', $data);
        break;
      case 'PKPMX' :
        //LOAD MODEL
        //PERANAN MODEL
        $this->load->model('peranan_model');
        //GET SENARAI NEGERI
        $senaraiNegeri = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
        //GET SENARAI_PROGRAM USING NEGERI
        $data['senaraiProgram'] = $this->program_model->senaraiDashboardNegeri($senaraiNegeri);
        $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
        $data['senaraiNegeri'] = $senaraiNegeri;
        $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($senaraiNegeri);
        $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($senaraiNegeri);
        $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($senaraiNegeri);
        $data['senaraiStatus'] = $this->program_model->senaraiStatus();
        $this->load->view('us_program_negeri_na/program/dashboard', $data);
        break;
      //FOR HEADQUATERS
      case 'US_PROGRAM' : 
        $tahun = date("Y");
        $data['senaraiRumusanProgram'] = $this->program_model->senaraiRumusanProgram($tahun);


        $data['header'] = 'us_program_na/susunletak/atas';
        $data['sidebar'] = 'us_program_na/susunletak/sidebar';
        $data['navbar'] = 'us_program_na/susunletak/navbar';
        $data['footer'] = 'us_program_na/susunletak/bawah';
        $this->load->view('program/dashboard', $data);
        break;
      case 'US_PROGRAMX' : 
        $data['senaraiProgram'] = $this->program_model->senaraiDashboard();
        $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
        $data['senaraiNegeri'] = $this->negeri_model->senarai();
        $data['senaraiDaerah'] = $this->daerah_model->senarai();
        $data['senaraiParlimen'] = $this->parlimen_model->senarai();
        $data['senaraiDun'] = $this->dun_model->senarai();
        $data['senaraiStatus'] = $this->program_model->senaraiStatus();
        $this->load->view('us_program_na/program/dashboard', $data);
        break;
      case 'URUSETIA':
        $this->load->library('pagination');

        $search = $this->input->get('search');
        $config['base_url'] = base_url('nama_controller/index'); // ganti dengan nama controller
        $config['total_rows'] = $this->program_model->kiraJumlah($search);
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';

        // Bootstrap pagination styling
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';

        $this->pagination->initialize($config);
        $page = ($this->input->get('page')) ? $this->input->get('page') : 0;

        $data['senaraiProgram'] = $this->program_model->senaraiDashboardBerhalaman($config['per_page'], $page, $search);
        $data['pagination'] = $this->pagination->create_links();
        $data['search'] = $search;

        if ($this->input->is_ajax_request()) {
            $this->load->view('urusetia_na/program/ajax_list', $data); // view untuk AJAX sahaja
        } else {
            $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
            $data['senaraiNegeri'] = $this->negeri_model->senarai();
            $data['senaraiDaerah'] = $this->daerah_model->senarai();
            $data['senaraiParlimen'] = $this->parlimen_model->senarai();
            $data['senaraiDun'] = $this->dun_model->senarai();
            $data['senaraiStatus'] = $this->program_model->senaraiStatus();

            $this->load->view('urusetia_na/program/dashboard', $data);
        }
        break;

      case 'URUSETIA1' :
        $data['senaraiProgram'] = $this->program_model->senaraiDashboard();
        $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
        $data['senaraiNegeri'] = $this->negeri_model->senarai();
        $data['senaraiDaerah'] = $this->daerah_model->senarai();
        $data['senaraiParlimen'] = $this->parlimen_model->senarai();
        $data['senaraiDun'] = $this->dun_model->senarai();
        $data['senaraiStatus'] = $this->program_model->senaraiStatus();
        $this->load->view('urusetia_na/program/dashboard', $data);
        break;
     case 'PPD' :
        $senaraiPelapor = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiProgram'] = $this->program_model->senaraiProgramPelapor($senaraiPelapor);
        $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
        $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiStatus'] = $this->program_model->senaraiStatus();
        $this->load->view('ppd_na/program/dashboard', $data);
        break;
     case 'NEGERI':
        $senaraiPelapor = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiRumusanProgram'] = $this->program_model->senaraiRumusanProgramGspiNegeri($senaraiPelapor);
        //$data['senaraiRumusanProgram'] = $this->program_model->senaraiRumusanPelapor($data['senaraiNegeri']);
        $this->load->view('negeri_na/program/laman', $data);
      break;
      case 'NEGERI1'  : 
     $this->load->view('susunletak/atas', $data);
     $negeri = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
                    $data['senaraiProgram'] = $this->program_model->senaraiProgramNegeri($negeri);
                    $data['senaraiJenisProgramDaerah'] = $this->program_model->senaraiJenisProgramDaerahNegeri($negeri);
                    $data['senaraiDaerah'] = $this->daerah_model->senaraiDaerahNegeri($negeri);
                    $data['senaraiJenisProgramParlimen'] = $this->program_model->senaraiJenisProgramParlimenNegeri($negeri);
                    $data['senaraiParlimen'] = $this->parlimen_model->negeri($negeri);
                    $data['senaraiJenisProgramDun'] = $this->program_model->senaraiJenisProgramDunNegeri($negeri);
                    $data['senaraiDun'] = $this->dun_model->ikut_negeri($negeri);
                    $data['dataProgram'] = $this->program_model;
                    $this->load->view('negeri/program/laman', $data);
     $this->load->view('susunletak/bawah');
     break;
      default : redirect(base_url());
     }
   }

                    
   public function proses_tambah()
   {
    $sesi = strtoupper($this->session->userdata('peranan'));
    if(strpos($sesi, 'PPD') !== FALSE){
      $sesi = 'PPD';
    }
    if(strpos($sesi, 'NEGERI') !== FALSE)
    {
      $sesi = 'NEGERI';
      $this->load->model('winnable_candidate_assign_model');
      $this->load->model('pengguna_model');
      $namaNegeri = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
    }
     $this->load->helper('url');
     $this->load->helper('form');
     $this->load->library('form_validation');

     $this->form_validation->set_rules('inputDaerah', 'Daerah', 'required');
     $this->form_validation->set_rules('inputNamaProgram', 'Nama Program', 'required');
     $this->form_validation->set_rules('inputJenisBil', 'Jenis Program', 'required');

    $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
    $this->form_validation->set_message('required', 'Sila penuhi ruangan {field}');

     if($this->form_validation->run() === FALSE)
     {
       $this->tambah();
     }
     else
     {
       $this->load->model('program_model');
       $maklumatProgram = $this->program_model->tambah();
       $data['senaraiProgram'] = $this->program_model->program($maklumatProgram['last_id']);
       switch($sesi){
        case 'US_PROGRAM' :
          $this->senaraiProgram();
          break;
        case 'PPD'  : 
       $this->load->view('susunletak/atas', $data);
          $this->load->view('ppd/program/maklumat_program');
          $this->load->view('susunletak/bawah');
        break;
        case 'NEGERI'  : 
          $this->load->view('susunletak/atas', $data);
          $this->load->view('negeri/program/maklumat_program');
          $this->load->view('susunletak/bawah');
          break;
        case 'URUSETIA' : 
          $this->load->view('susunletak/atas', $data);
          $this->load->view('program/maklumat_program');
          $this->load->view('susunletak/bawah');
          break;
        default : redirect(base_url());
       }
     }
   }

	public function tambah()
	{
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $perananBil = $this->session->userdata('peranan_bil');
    $this->load->model('pengguna_model');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    if(strpos($sesi, 'PPD') !== FALSE){
      $sesi = 'PPD';
    }
    if(strpos($sesi, 'NEGERI') !== FALSE)
    {
      $sesi = 'NEGERI';
      $this->load->model('winnable_candidate_assign_model');
      $namaNegeri = $this->winnable_candidate_assign_model->assign($perananBil)->wcat_negeri;
    }
    //3. SET PKPM
    if(strpos($sesi, 'PKPM') !== FALSE){
      $sesi = 'PKPM';
    }
		$this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->model('jenis_model');
    $this->load->model('japen_model');
    $this->load->model('negeri_model');
    $this->load->model('daerah_model');
    $this->load->model('parlimen_model');
    $this->load->model('dun_model');
    $this->load->model('peranan_model');
    $data['senarai_penganjur'] = $this->japen_model->senaraiJapen();
    // 2. Senarai Jenis Program
    $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
    switch($sesi){
      case 'PPD' :
        $this->load->model('senarai_kandungan_model');
        if(empty($data['pengguna']->pengguna_status)){
          $data['senaraiPelapor'] = $this->pengguna_model->senarai_pelapor($data['pengguna']->pengguna_peranan_bil);
        }else{
          $data['senaraiPelapor'] = array($data['pengguna']);
        }
        $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiNaratif'] = $this->senarai_kandungan_model->senarai();
        $this->load->view('ppd_na/program/tambah', $data);
        break;
      case 'PKPM' :
        // LOAD MODEL
        // 1. PERANAN
        $this->load->model('peranan_model');
        // 2. SENARAI KANDUNGAN
        $this->load->model('senarai_kandungan_model');
        // GET SENARAI NEGERI
        $senaraiNegeri = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
        // 1. Senarai Pelapor - Mengikut Negeri
        //$data['senaraiPelapor'] = $this->pengguna_model->penggunaSenaraiNegeri($senaraiNegeri);
        if(empty($data['pengguna']->pengguna_status)){
          $data['senaraiPelapor'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
        }else{
          $data['senaraiPelapor'] = array($data['pengguna']);
        }
        // 2. Senarai Negeri - Mengikut Negeri
        $data['senaraiNegeri'] = $senaraiNegeri;
        // 3. Senarai Daerah - Mengikut Negeri
        $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($senaraiNegeri);
        // 4. Senarai Parlimen - Mengikut Negeri
        $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($senaraiNegeri);
        // 5. Senarai DUN - Mengikut Negeri
        $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($senaraiNegeri);
        // 6. Senarai Naratif
        $data['senaraiNaratif'] = $this->senarai_kandungan_model->senarai();
        $this->load->view('us_program_negeri_na/program/tambah', $data);
        break;
      case 'US_PROGRAM' :
        // 1. Senarai Pelapor - Semua
        //$data['senaraiPelapor'] = $this->pengguna_model->senarai_penuh_pelapor();
        // 1a. Guna akaun u_program
        $data['senaraiPelapor'] = $this->pengguna_model->senarai_pelapor($data['pengguna']->pengguna_peranan_bil);
        //$data['senaraiPelapor'] = array($data['pengguna']);
        // 3. Senarai Negeri - Semua
        $data['senaraiNegeri'] = $this->negeri_model->senarai();
        // 4. Senarai Daerah - Semua
        $data['senaraiDaerah'] = $this->daerah_model->senarai();
        // 5. Senarai Parlimen - Semua
        $data['senaraiParlimen'] = $this->parlimen_model->senarai();
        // 6. Senarai DUN - Semua
        $data['senaraiDun'] = $this->dun_model->senarai();
        $this->load->view('us_program_na/program/tambah', $data);
        break;
      case 'URUSETIA' : 
		$this->load->view('susunletak/atas', $data);
    $this->load->view('program/tambah_program');
		$this->load->view('susunletak/bawah');
    break;
      case 'PPD2'      : $perananBil = $this->session->userdata('peranan_bil');
                        $this->load->model('daerah_model');
                        $this->load->model('parlimen_model');
                        $this->load->model('dun_model');
                        $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($perananBil);
                        $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($perananBil);
                        $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($perananBil);
                        
		$this->load->view('susunletak/atas', $data);
    $this->load->view('ppd/program/tambah', $data);
		$this->load->view('susunletak/bawah');
    break;
    case 'NEGERI' :
        $data['senaraiNegeri'] = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiDaerah'] = $this->daerah_model->senaraiDaerahNegeri($namaNegeri);
        $data['senaraiParlimen'] = $this->parlimen_model->negeri($namaNegeri);
        $data['senaraiDun'] = $this->dun_model->ikut_negeri($namaNegeri);
        if(empty($data['pengguna']->pengguna_status)){
          $data['senaraiPelapor'] = $this->pengguna_model->senarai_pelapor($data['pengguna']->pengguna_peranan_bil);
        }else{
          $data['senaraiPelapor'] = array($data['pengguna']);
        }
        $this->load->view('negeri_na/program/tambah', $data);
      break;
      case 'NEGERI2'      : $this->load->model('daerah_model');
                        $this->load->model('parlimen_model');
                        $this->load->model('dun_model');
                        $data['senaraiDaerah'] = $this->daerah_model->senaraiDaerahNegeri($namaNegeri);
                        $data['senaraiParlimen'] = $this->parlimen_model->negeri($namaNegeri);
                        $data['senaraiDun'] = $this->dun_model->ikut_negeri($namaNegeri);
                        
		$this->load->view('susunletak/atas', $data);
    $this->load->view('negeri/program/tambah', $data);
		$this->load->view('susunletak/bawah');
    break;
      default         : redirect(base_url());
    }
	}

  public function proses_kemaskini()
  {
    $programBil = $this->input->post('inputProgramBil');
    if(empty($programBil)){
      redirect(base_url());
    }
    $this->load->helper('url');
     $this->load->helper('form');
     $this->load->library('form_validation');

     $this->form_validation->set_rules('inputNamaProgram', 'Nama Program', 'required');

     if($this->form_validation->run() === FALSE)
     {
       $this->kemaskini($programBil);
     }
     else
     {
       $this->load->model('program_model');
       $this->program_model->kemaskini();
       $this->kemaskini($programBil);
     }
  }

  public function kemaskini($programBil)
  { 
    $sesi = strtoupper($this->session->userdata('peranan'));
    if(strpos($sesi, 'PPD') !== FALSE)
    {
      $sesi = 'PPD';
    }
    if(strpos($sesi, 'NEGERI') !== FALSE)
    {
      $sesi = 'NEGERI';
      $this->load->model('winnable_candidate_assign_model');
      $this->load->model('pengguna_model');
      $namaNegeri = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
    }
    $perananBil = $this->session->userdata('peranan_bil');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->model('program_model');
    $this->load->model('jenis_model');
    $this->load->model('japen_model');
    $data['senarai_penganjur'] = $this->japen_model->senaraiJapen();
    $data['program'] = $this->program_model->programDetail($programBil);
    $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
    $this->load->view('susunletak/atas', $data);
    switch($sesi)
    {
      case 'URUSETIA' : $this->load->view('program/kemaskini_program');
                        break;
      case 'PPD'  : $this->load->model('daerah_model');
      $this->load->model('parlimen_model');
      $this->load->model('dun_model');
      $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($perananBil);
      $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($perananBil);
      $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($perananBil);
      $this->load->view('ppd/program/kemaskini_program', $data);
                    break;
      case 'NEGERI'  : $this->load->model('daerah_model');
      $this->load->model('parlimen_model');
      $this->load->model('dun_model');
      $data['senaraiDaerah'] = $this->daerah_model->senaraiDaerahNegeri($namaNegeri);
      $data['senaraiParlimen'] = $this->parlimen_model->negeri($namaNegeri);
      $data['senaraiDun'] = $this->dun_model->ikut_negeri($namaNegeri);
      $this->load->view('negeri/program/kemaskini_program', $data);
                    break;
      default : redirect(base_url());
    }
    
    $this->load->view('susunletak/bawah');
  }

  public function bil($bil)
  {
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    if(strpos($sesi, 'PPN') !== FALSE)
    {
      $sesi = 'PPN';
    }
    if(strpos($sesi, 'PPD') !== FALSE)
    {
      $sesi = 'PPD';
    }
    if(strpos($sesi, 'NEGERI') !== FALSE)
    {
      $sesi = 'NEGERI';
      $this->load->model('winnable_candidate_assign_model');
      $this->load->model('pengguna_model');
      $namaNegeri = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
    }
    if(strpos($sesi, 'PKPM') !== FALSE){
      $sesi = 'PKPM';
    }

    //LOAD HELPER
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->helper('file');

    //LOAD MODEL
    $this->load->model('pengguna_model');
    $this->load->model('program_model');
    $this->load->model('program_lokasi_model');
    $this->load->model('program_obp_model');
    $this->load->model('gambar_model');
    $this->load->model('jenis_model');
    $this->load->model('negeri_model');
    $this->load->model('daerah_model');
    $this->load->model('parlimen_model');
    $this->load->model('dun_model');
    $this->load->model('obp_model');
    $this->load->model('peranan_model');
    $this->load->model('program_gambar_model');
    $this->load->model('program_pautan_model');
    $this->load->model('program_status_model');
    $this->load->model('program_komuniti_model');
    $this->load->model('program_kelabmalaysiaku_model');
    $this->load->model('program_keratan_akhbar_model');
    $this->load->model('komuniti_model');
    $this->load->model('kelabmalaysiaku_model');
    $this->load->model('senarai_kandungan_model');
    $this->load->model('senarai_pengisian_model');
    $this->load->model('program_kandungan_model');
    $this->load->model('program_pengisian_model');
    $this->load->model('senarai_agensi_model');
    $this->load->model('program_agensi_model');
    $this->load->model('senarai_penerbitan_model');
    $this->load->model('program_penerbitan_model');
    $this->load->model('program_semakan_model');
    //LOAD DATA
    //1. RELATED TO DEFAULT PENGGUNA
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    //2. RELATED TO PROGRAM
    $data['senaraiProgram'] = $this->program_model->manyProgram($bil);
    $data['senaraiLokasi'] = $this->program_lokasi_model->senaraiLokasi($bil);
    $data['senaraiObp'] = $this->program_obp_model->senaraiObp($bil);
    //3. Senarai Jenis Program
    $data['senaraiJenis'] = $this->jenis_model->semuaAktif();
    //4. SENARAI GAMBAR PROGRAM
    $data['senaraiGambar'] = $this->program_gambar_model->senaraiGambarIkutProgram($bil);
    
    //SYARAT GAMBAR
    $bilanganGambar = 1;
    if(count($data['senaraiGambar']) >= $bilanganGambar){
      foreach($data['senaraiGambar'] as $g){
        $url = base_url('assets/img/gambarProgram/').$g->gambar_program_nama_fail;
        $headers = get_headers($url, 1);
        //if(strpos($headers['Content-Type'], 'video/') !== FALSE){
          $this->prosesSemakanLaporan($bil, "BAHAGIAN J - LAPORAN GAMBAR", $penggunaBil);
          //DO NOTHING
        //}
      }
    }
    if(count($data['senaraiGambar']) < $bilanganGambar){
      $this->tukarFalseSemakan($bil, "BAHAGIAN J - LAPORAN GAMBAR", $penggunaBil);
    }
    

    //5. SENARAI PAUTAN PROGRAM
    $data['senaraiPautan'] = $this->program_pautan_model->senaraiPautanIkutProgram($bil);
    //6. STATUS LAPORAN
      //6.1 STATUS SEMASA
      $data['statusLaporan'] = $this->program_status_model->statusSemasa($bil);
      //6.2 SENARAI STATUS
      $data['senaraiStatus'] = $this->program_status_model->senaraiStatusIkutProgram($bil);
    //7. SENARAI KOMUNITI
    $data['senaraiKomuniti'] = $this->program_komuniti_model->senarai($bil);
    $data['senaraiKandungan'] = $this->senarai_kandungan_model->senarai();
    $data['senaraiPengisianProgram'] = $this->senarai_pengisian_model->senarai();
    $data['senaraiTajuk'] = $this->program_kandungan_model->senaraiTajuk($bil);
    $data['senaraiPengisian'] = $this->program_pengisian_model->senaraipengisian($bil);
    $data['senaraiKelab'] = $this->program_kelabmalaysiaku_model->senarai($bil);
    $data['senaraiAgensiProgram'] = $this->senarai_agensi_model->senarai();
    $data['senaraiAgensi'] = $this->program_agensi_model->senaraiagensi($bil);
    $data['senaraiPenerbitanProgram'] = $this->senarai_penerbitan_model->senarai();
    $data['senaraiPenerbitan'] = $this->program_penerbitan_model->senaraipenerbitan($bil);
    $data['senaraiKaumBorang'] = array(
      "Melayu",
      "Cina",
      "India",
      "Lain-Lain Kaum"
    );
    $data['senaraiMaklumatTambahanKelabMalaysiaku'] = $this->program_kelabmalaysiaku_model->maklumatTambahan($bil);
    $data['senaraiKaumKelabMalaysiaku'] = $this->program_kelabmalaysiaku_model->senaraiKaumProgramSemua($bil);
    $data['senaraiKeratanAkhbar'] = $this->program_keratan_akhbar_model->senaraiKeratanAkhbarIkutProgram($bil);

    if(count($data['senaraiTajuk']) > 0){
      $this->prosesSemakanLaporan($bil, "BAHAGIAN B - TAJUK HEBAHAN / CERAMAH PROGRAM", $data["pengguna"]->bil);
    }else{
      $this->tukarFalseSemakan($bil, "BAHAGIAN B - TAJUK HEBAHAN / CERAMAH PROGRAM", $data["pengguna"]->bil);
    }
    
    //ACCORDINGLY
    switch($sesi)
    {
      case 'ADMIN' :
        $data['header'] = "admin_na/susunletak/atas";
        $data['navbar'] = "admin_na/susunletak/navbar";
        $data['sidebar'] = "admin_na/susunletak/sidebar";
        $data['footer'] = "admin_na/susunletak/bawah";
        $this->load->view('program/bil', $data);
        break;
      case 'TOPPROGRAM' :
        $this->load->model('ketua_unit_model');
        //LOAD DATA
        // 1. Senarai Pelapor - NEGERI
        //$data['senaraiPelapor'] = $this->pengguna_model->senarai_penuh_pelapor();
        // 3. Senarai Negeri - Semua
        $data['senaraiNegeri'] = $this->negeri_model->senarai();
        // 1a. Guna akaun u_program
        $data['senaraiPelapor'] = $this->pengguna_model->senarai();
        // 4. Senarai Daerah - Semua
        $data['senaraiDaerah'] = $this->daerah_model->senarai();
        // 5. Senarai Parlimen - Semua
        $data['senaraiParlimen'] = $this->parlimen_model->senarai();
        // 6. Senarai DUN - Semua
        $data['senaraiDun'] = $this->dun_model->senarai();

        // 7. Untuk kegunaan bahagian C - Senarai OBP
        $data['dataObp'] = $this->obp_model;
        $data['senaraiPeranan'] = $this->peranan_model->senarai();
        $data['senaraiPilihanKomuniti'] = $this->komuniti_model->senaraiIkutNamaNegeri($data['senaraiNegeri']);
        $data['senaraiPilihanKelab'] = $this->kelabmalaysiaku_model->senaraiIkutNamaNegeri($data['senaraiNegeri']);
        //AKAUN PENOLONG PENGARAH PKPM NEGERI
        //$data['akaunPp'] = $this->ketua_unit_model->ketuaUnit($data['pengguna']->pengguna_peranan_bil);

        //LOAD VIEW
        $this->load->view('ppkpm_na/program/program', $data);
        break;
      case 'PPN' :
        $this->load->model('ketua_unit_model');
        //LOAD DATA
        // 1. Senarai Pelapor - NEGERI
        //$data['senaraiPelapor'] = $this->pengguna_model->senarai_penuh_pelapor();
        // 3. Senarai Negeri - Semua
        $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
        // 1a. Guna akaun u_program
        $data['senaraiPelapor'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
        // 4. Senarai Daerah - Semua
        $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
        // 5. Senarai Parlimen - Semua
        $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($data['senaraiNegeri']);
        // 6. Senarai DUN - Semua
        $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($data['senaraiNegeri']);

        // 7. Untuk kegunaan bahagian C - Senarai OBP
        $data['dataObp'] = $this->obp_model;
        $data['senaraiPeranan'] = $this->peranan_model->senarai();
        $data['senaraiPilihanKomuniti'] = $this->komuniti_model->senaraiIkutNamaNegeri($data['senaraiNegeri']);
        $data['senaraiPilihanKelab'] = $this->kelabmalaysiaku_model->senaraiIkutNamaNegeri($data['senaraiNegeri']);
        //AKAUN PENOLONG PENGARAH PKPM NEGERI
        $data['akaunPp'] = $this->ketua_unit_model->ketuaUnit($data['pengguna']->pengguna_peranan_bil);

        //LOAD VIEW
        $this->load->view('ppn_na/program/program', $data);
        break;
      case 'PPD' :
        $data['semakanLaporan'] = $this->program_semakan_model->semakanLaporan($bil);
        $data['bolehKemaskini'] = FALSE;
        $semakPeranan = $this->program_model->semakanPpd($bil, $data['pengguna']->pengguna_peranan_bil);
        if(!empty($semakPeranan)){
          $data['bolehKemaskini'] = TRUE;
        }
        $semakPelapor = $this->program_model->semakanPengguna($bil, $data['pengguna']->bil);
        if(!empty($semakPelapor)){
          $data['bolehKemaskini'] = TRUE;
        }
        //LOAD DATA
        if(empty($data['pengguna']->pengguna_status)){
          $data['senaraiPelapor'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
        }else{
          $this->load->model('ppd_model');
          $data['senaraiPelapor'] = array($data['pengguna']);
          $data['akaunPpd'] = $this->ppd_model->akaunPpd($data['pengguna']);
          if(!empty($data['akaunPpd'])){
            if($data['akaunPpd']->bil == $data['pengguna']->bil){
              $data['senaraiPelapor'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
            }
          }
        }
        $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($data['pengguna']->pengguna_peranan_bil);

        // 7. Untuk kegunaan bahagian C - Senarai OBP
        $data['dataObp'] = $this->obp_model;
        $data['senaraiPeranan'] = $this->peranan_model->senarai();
        
        // SENARAI PILIHAN KOMUNITI
        // MENGIKUT DAERAH SAHAJA
        // $data['senaraiPilihanKomuniti'] = $this->komuniti_model->senaraiIkutDaerah($data['senaraiDaerah']);
        // MENGIKUT DAERAH, PARLIMEN DAN DUN
        $data['senaraiPilihanKomuniti'] = $this->komuniti_model->senaraiDaerahParlimenDun($data['senaraiDaerah'], $data['senaraiParlimen'], $data['senaraiDun']);
        $data['senaraiPilihanKelab'] = $this->kelabmalaysiaku_model->senaraiIkutDaerah($data['senaraiDaerah']);
        if(!$data['bolehKemaskini']){
          redirect(base_url());
        }
        //LOAD VIEW
        $this->load->view('ppd_na/program/program', $data);
        break;
      case 'PKPM' :
        $this->load->model('ketua_unit_model');
        //LOAD DATA
        // 1. Senarai Pelapor - NEGERI
        //$data['senaraiPelapor'] = $this->pengguna_model->senarai_penuh_pelapor();
        // 3. Senarai Negeri - Semua
        $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
        // 1a. Guna akaun u_program
        $data['senaraiPelapor'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
        // 4. Senarai Daerah - Semua
        $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
        // 5. Senarai Parlimen - Semua
        $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($data['senaraiNegeri']);
        // 6. Senarai DUN - Semua
        $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($data['senaraiNegeri']);

        // 7. Untuk kegunaan bahagian C - Senarai OBP
        $data['dataObp'] = $this->obp_model;
        $data['senaraiPeranan'] = $this->peranan_model->senarai();
        $data['senaraiPilihanKomuniti'] = $this->komuniti_model->senaraiIkutNamaNegeri($data['senaraiNegeri']);
        $data['senaraiPilihanKelab'] = $this->kelabmalaysiaku_model->senaraiIkutNamaNegeri($data['senaraiNegeri']);
        //AKAUN PENOLONG PENGARAH PKPM NEGERI
        $data['akaunPp'] = $this->ketua_unit_model->ketuaUnit($data['pengguna']->pengguna_peranan_bil);
        //LOAD VIEW
        $this->load->view('us_program_negeri_na/program/program', $data);
        break;
      case 'US_PROGRAM' :
        $this->load->model('ketua_unit_model');
        //LOAD DATA
        // 1. Senarai Pelapor - Semua
        //$data['senaraiPelapor'] = $this->pengguna_model->senarai_penuh_pelapor();
        // 1a. Guna akaun u_program
        //$data['senaraiPelapor'] = $this->pengguna_model->senarai_penuh_pelapor();
        $data['senaraiPelapor'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
        // 3. Senarai Negeri - Semua
        $data['senaraiNegeri'] = $this->negeri_model->senarai();
        // 4. Senarai Daerah - Semua
        $data['senaraiDaerah'] = $this->daerah_model->senarai();
        // 5. Senarai Parlimen - Semua
        $data['senaraiParlimen'] = $this->parlimen_model->senarai();
        // 6. Senarai DUN - Semua
        $data['senaraiDun'] = $this->dun_model->senarai();

        // 7. Untuk kegunaan bahagian C - Senarai OBP
        $data['dataObp'] = $this->obp_model;
        $data['senaraiPeranan'] = $this->peranan_model->senarai();
        $data['senaraiPilihanKomuniti'] = $this->komuniti_model->senaraiIkutNama();
        $data['senaraiPilihanKelab'] = $this->kelabmalaysiaku_model->senaraiIkutNama();

        $data['akaunKu'] = $this->ketua_unit_model->ketuaUnit($data['pengguna']->pengguna_peranan_bil);

        //LOAD VIEW
        $this->load->view('us_program_na/program/program', $data);
        break;
      case 'URUSETIA' : 
        $data['senaraiPelapor'] = $this->pengguna_model->senarai_penuh_pelapor();
        $data['senaraiNegeri'] = $this->negeri_model->senarai();
        $data['senaraiDaerah'] = $this->daerah_model->senarai();
        $data['senaraiParlimen'] = $this->parlimen_model->senarai();
        $data['senaraiDun'] = $this->dun_model->senarai();
        $data['dataObp'] = $this->obp_model;
        $data['senaraiPeranan'] = $this->peranan_model->senarai();
        $data['senaraiPilihanKomuniti'] = $this->komuniti_model->senaraiIkutNama();
        $this->load->view('urusetia_na/program/program', $data);
        break;
      case 'NEGERI'      : 
        $this->load->model('ketua_unit_model');
        //LOAD DATA
        // 1. Senarai Pelapor - NEGERI
        //$data['senaraiPelapor'] = $this->pengguna_model->senarai_penuh_pelapor();
        // 3. Senarai Negeri - Semua
        $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
        // 1a. Guna akaun u_program
        $data['senaraiPelapor'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
        // 4. Senarai Daerah - Semua
        $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
        // 5. Senarai Parlimen - Semua
        $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($data['senaraiNegeri']);
        // 6. Senarai DUN - Semua
        $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($data['senaraiNegeri']);

        // 7. Untuk kegunaan bahagian C - Senarai OBP
        $data['dataObp'] = $this->obp_model;
        $data['senaraiPeranan'] = $this->peranan_model->senarai();
        $data['senaraiPilihanKomuniti'] = $this->komuniti_model->senaraiIkutNamaNegeri($data['senaraiNegeri']);
        $data['senaraiPilihanKelab'] = $this->kelabmalaysiaku_model->senaraiIkutNamaNegeri($data['senaraiNegeri']);
        //AKAUN PENOLONG PENGARAH PKPM NEGERI
        $data['akaunPp'] = $this->ketua_unit_model->ketuaUnit($data['pengguna']->pengguna_peranan_bil);

        //LOAD VIEW
        $this->load->view('negeri_na/program/program', $data);
        break;
      default : redirect(base_url());
    }
  }

  public function tambah_gambar()
  {
    $this->load->helper('url');
    $this->load->helper('form');
    $bil=$this->input->post('inputBilProgram');
    $filename = "program".$bil."_";
                $config['upload_path'] = './assets/';
                $config['allowed_types'] = '*';
        				$config['file_name'] = $filename;
        				$config['overwrite'] = FALSE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->bil($bil);

                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $this->load->model('gambar_model');
                        $this->load->model('program_model');
                        $this->gambar_model->tambahGambar($this->upload->data('file_name'), $bil);
                        $data['program'] = $this->program_model->programDetail($bil);
                        $this->load->view('susunletak/atas', $data);
                        $this->load->view('program/berjaya_upload');
                        $this->load->view('susunletak/bawah');
                }
 }

    public function padam_gambar($gambarBil)
    {
      $this->load->helper('url');
      $this->load->helper('file');
      $this->load->model('gambar_model');
      $gambar = $this->gambar_model->gambar($gambarBil);
      $programBil = $gambar->gt_bilProgram;
      $namaFail = $gambar->gt_nama;
      $this->gambar_model->padam($gambarBil);
      delete_files("./assets/".$namaFail);
      redirect('program/bil/'.$programBil);
    }

    public function recap()
    {
      $this->load->helper('url');
      $this->load->model('program_model');
      $this->load->model('gambar_model');
      $data['dataProgram'] = $this->program_model;
      $data['dataGambar'] = $this->gambar_model;
      $this->load->view('susunletak/atas', $data);
      $this->load->view('program/recap');
      $this->load->view('susunletak/bawah');
    }

    //X - PENGHANTARAN LAPORAN

    public function sahPpd(){
      //1. CHECK LAPORAN BIL
      $programBil = $this->input->post('inputProgramBil');
      if(empty($programBil)){
        redirect(base_url());
      }
      //2. LOAD MODEL
      $this->load->model('program_model');
      $this->load->model('program_status_model');
      //3. LOAD ACTIVITY
      $statusSemasa = 'Pengesahan Perancangan Negeri';
      $this->program_model->hantar($statusSemasa);
        //3.1 INITIALIZATION
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $statusDeskripsi = 'Pengesahan untuk perancangan program';
      $this->program_status_model->tambahLog($penggunaBil, $programBil, $statusSemasa, $statusDeskripsi);
      redirect('program/bil/'.$programBil);
    }

    public function hantarPpd(){
      //1. CHECK LAPORAN BIL
      $programBil = $this->input->post('inputProgramBil');
      if(empty($programBil)){
        redirect(base_url());
      }
      //2. LOAD MODEL
      $this->load->model('program_model');
      $this->load->model('program_status_model');
      //3. LOAD ACTIVITY
      $changeStatus = 'Pengesahan Perancangan PPD';
      $this->program_model->hantar($changeStatus);
        //3.1 INITIALIZATION
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $status = $changeStatus;
        $statusDeskripsi = 'Penghantaran untuk Pengesahan PPD';
      $this->program_status_model->tambahLog($penggunaBil, $programBil, $status, $statusDeskripsi);
      redirect('program/bil/'.$programBil);
    }

    public function hantarLaporan(){
      //1. CHECK LAPORAN BIL
      $programBil = $this->input->post('inputProgramBil');
      if(empty($programBil)){
        redirect(base_url());
      }
      //2. LOAD MODEL
      $this->load->model('program_model');
      $this->load->model('program_status_model');
      //3. LOAD ACTIVITY
      $this->program_model->hantarLaporan();
        //3.1 INITIALIZATION
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $status = 'Hantar';
        $statusDeskripsi = 'Penghantaran pertama kepada BPKPM';
      $this->program_status_model->tambahLog($penggunaBil, $programBil, $status, $statusDeskripsi);
      redirect('program/bil/'.$programBil);
    }

}
