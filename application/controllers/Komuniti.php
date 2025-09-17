<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komuniti extends CI_Controller {

    public function libatUrusBil($libatUrusBil){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        switch($sesi){
            case 'PPD' :
                $this->load->model('komuniti_libaturus_model');
                $data['laporan'] = $this->komuniti_libaturus_model->laporan($libatUrusBil);
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $this->load->view('komuniti/libatUrus/laporan', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function senaraiLibatUrusPelapor(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        switch($sesi){
            case 'ADMIN' :
                $data['header'] = 'admin_na/susunletak/atas';
                $data['navbar'] = 'admin_na/susunletak/navbar';
                $data['sidebar'] = 'admin_na/susunletak/sidebar';
                $data['footer'] = 'admin_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/senarai', $data);
                break;
            case 'URUSETIA' :
                $data['header'] = 'urusetia_na/susunletak/atas';
                $data['navbar'] = 'urusetia_na/susunletak/navbar';
                $data['sidebar'] = 'urusetia_na/susunletak/sidebar';
                $data['footer'] = 'urusetia_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/senarai', $data);
                break;
            case 'KP' :
                $data['header'] = 'kp_na/susunletak/atas';
                $data['navbar'] = 'kp_na/susunletak/navbar';
                $data['sidebar'] = 'kp_na/susunletak/sidebar';
                $data['footer'] = 'kp_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/senarai', $data);
                break;
            case 'US_PROGRAM' :
                $data['header'] = 'us_program_na/susunletak/atas';
                $data['navbar'] = 'us_program_na/susunletak/navbar';
                $data['sidebar'] = 'us_program_na/susunletak/sidebar';
                $data['footer'] = 'us_program_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/senarai', $data);
                break;
            case 'PPN' :
                $data['header'] = 'ppn_na/susunletak/atas';
                $data['navbar'] = 'ppn_na/susunletak/navbar';
                $data['sidebar'] = 'ppn_na/susunletak/sidebar';
                $data['footer'] = 'ppn_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/senarai', $data);
                break;
            case 'PKPM':
                $data['header'] = 'us_program_negeri_na/susunletak/atas';
                $data['navbar'] = 'us_program_negeri_na/susunletak/navbar';
                $data['sidebar'] = 'us_program_negeri_na/susunletak/sidebar';
                $data['footer'] = 'us_program_negeri_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/senarai', $data);
                break;
            case 'PPD' :
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');

                //PPD
                $this->load->model('ppd_model');
                $ppd = $this->ppd_model->ppd($data['pengguna']->pengguna_peranan_bil);
                if($ppd->bil !== $data['pengguna']->bil){
                    redirect(base_url());
                }
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporanPelapor($data['pengguna']->pengguna_peranan_bil);

                $this->load->view('komuniti/libatUrus/senaraiPelapor', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function padamLaporanLibatUrus($libatUrusBil){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($sesi)){
            redirect(base_url());
        }
        $this->load->model('komuniti_libaturus_model');
        $libatUrus = $this->komuniti_libaturus_model->laporan($libatUrusBil);
        if($libatUrus->libatUrusPelapor == $data['pengguna']->bil){
            $senaraiGambar = $this->komuniti_libaturus_model->senaraiGambar($libatUrusBil);
            if($senaraiGambar){
                foreach($senaraiGambar as $gambar){
                    $path =  './assets/img/gambarKomuniti/' . $gambar->gambarNama;
                    if(file_exists($path)){
                        unlink($path);
                    }
                    $this->komuniti_libaturus_model->padamGambar($gambar->gambarBil);
                }
            }
            $this->komuniti_libaturus_model->buangSemuaTerlibat($libatUrusBil);
            $this->komuniti_libaturus_model->padamLaporan($libatUrusBil);
        }
        redirect('komuniti/senaraiLibatUrus');
    }

    public function prosesKemaskiniUmum(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($sesi)){
            redirect(base_url());
        }
        $libatUrusBil = $this->input->post('inputLibatUrusBil');
        $this->load->model('komuniti_libaturus_model');
        $this->komuniti_libaturus_model->kemaskini();
        redirect('komuniti/laporanLibatUrus/'.$libatUrusBil);
    }

    public function padamGambarLibatUrus(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($sesi)){
            redirect(base_url());
        }
        $gambarBil = $this->input->post('inputLibatUrusGambarBil');
        $libatUrusBil = $this->input->post('inputLibatUrusBil');
        if(empty($gambarBil)){
            redirect(base_url());
        }
        $this->load->model('komuniti_libaturus_model');
        $gambar = $this->komuniti_libaturus_model->gambar($gambarBil);
        if($gambar){
            $path =  './assets/img/gambarKomuniti/' . $gambar->komuniti_libat_urus_gambar_nama;
            if(file_exists($path)){
                unlink($path);
            }
            $this->komuniti_libaturus_model->padamGambar($gambar->komuniti_libat_urus_gambar_bil);
        }
        redirect('komuniti/laporanLibatUrus/'.$libatUrusBil);
    }

    public function prosesTambahSemua(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($sesi)){
            redirect(base_url());
        }

        //UMUM
        $this->load->model('komuniti_libaturus_model');
        $libatUrusNama = $this->input->post('inputTajukPerjumpaan');
        $libatUrusTarikhMasa = $this->input->post('inputTarikhMasa');
        $libatUrusKehadiran = $this->input->post('inputKehadiran');
        $libatUrusLokasi = $this->input->post('inputLokasi');
        $libatUrusCatatan = $this->input->post('inputCatatan');
        $penggunaNama = $data['pengguna']->nama_penuh;
        $penggunaJawatan = $data['pengguna']->pekerjaan;
        $penggunaNoTel = $data['pengguna']->no_tel;
        $penggunaPenempatan = $data['pengguna']->pengguna_tempat_tugas;
        $lastEntri = $this->komuniti_libaturus_model->tambah($penggunaPenempatan, $libatUrusNama, $libatUrusTarikhMasa, $libatUrusKehadiran, $libatUrusCatatan, $penggunaBil, $penggunaNama, $penggunaJawatan, $penggunaNoTel, $libatUrusLokasi);
        if(!empty($lastEntri)){
            //KOMUNITI
            $this->load->model('komuniti_model');
            $senaraiKomunitiBil = $this->input->post('inputKomunitiBil');
            $libatUrusBil = $lastEntri;
            $libatUrus = $this->komuniti_libaturus_model->laporan($libatUrusBil);
            $this->komuniti_libaturus_model->buangSemuaTerlibat($libatUrusBil);
            if (!empty($senaraiKomunitiBil)) { 
                foreach ($senaraiKomunitiBil as $komunitiBil) { 
                    $km = $this->komuniti_model->komuniti($komunitiBil);
                    $this->komuniti_libaturus_model->tambahKomunitiTerlibat($km, $libatUrus, $data['pengguna']);
                } 
            }
            //GAMBAR
            $this->load->library('upload');
            $files = $_FILES; 
            $libatUrusBil = $lastEntri;
            $count = count($_FILES['inputGambar']['name']); 
            for ($i = 0; $i < $count; $i++) { 
                $_FILES['gambar']['name'] = $files['inputGambar']['name'][$i]; 
                $_FILES['gambar']['type'] = $files['inputGambar']['type'][$i]; 
                $_FILES['gambar']['tmp_name'] = $files['inputGambar']['tmp_name'][$i];
                $_FILES['gambar']['error'] = $files['inputGambar']['error'][$i];
                $_FILES['gambar']['size'] = $files['inputGambar']['size'][$i]; 
                $namaFailBaru = date("Y") . $lastEntri . $i . "GAMBARKOMUNITI";
                $this->upload->initialize($this->set_upload_options($namaFailBaru)); 
                if ($this->upload->do_upload('gambar')) { 
                    $uploadData = $this->upload->data(); 
                    $gambarNama = $uploadData['file_name'];
                    $libatUrusBil = $lastEntri;
                    $penggunaNama = $data['pengguna']->nama_penuh;
                    $penggunaJawatan = $data['pengguna']->pekerjaan;
                    $penggunaNoTel = $data['pengguna']->no_tel;
                    $this->komuniti_libaturus_model->tambahGambar($gambarNama, $libatUrusBil, $penggunaBil, $penggunaNama, $penggunaJawatan, $penggunaNoTel);
                } 
            } 
        }
        redirect('komuniti/laporanLibatUrus/'.$libatUrusBil);
    }

    public function prosesGambarLibatUrus() { 
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($sesi)){
            redirect(base_url());
        }
        $this->load->library('upload');
        $this->load->model('komuniti_libaturus_model');
        $files = $_FILES; 
        $libatUrusBil = $this->input->post('inputLibatUrusBil');
        $count = count($_FILES['inputGambar']['name']); 
        for ($i = 0; $i < $count; $i++) { 
            $_FILES['gambar']['name'] = $files['inputGambar']['name'][$i]; 
            $_FILES['gambar']['type'] = $files['inputGambar']['type'][$i]; 
            $_FILES['gambar']['tmp_name'] = $files['inputGambar']['tmp_name'][$i];
            $_FILES['gambar']['error'] = $files['inputGambar']['error'][$i];
            $_FILES['gambar']['size'] = $files['inputGambar']['size'][$i]; 
            $namaFailBaru = date("Y") . $libatUrusBil . $i . "GAMBARKOMUNITI";
            $this->upload->initialize($this->set_upload_options($namaFailBaru)); 
            if ($this->upload->do_upload('gambar')) { 
                $uploadData = $this->upload->data(); 
                $gambarNama = $uploadData['file_name'];
                $penggunaNama = $data['pengguna']->nama_penuh;
                $penggunaJawatan = $data['pengguna']->pekerjaan;
                $penggunaNoTel = $data['pengguna']->no_tel;
                $this->komuniti_libaturus_model->tambahGambar($gambarNama, $libatUrusBil, $penggunaBil, $penggunaNama, $penggunaJawatan, $penggunaNoTel);
            } 
        } 
        redirect('komuniti/laporanLibatUrus/'.$libatUrusBil);
    } 

    private function set_upload_options($namaFailBaru) { 
        $config = array(); 
        $config['upload_path'] = './assets/img/gambarKomuniti/'; 
        $config['allowed_types'] = '*'; 
        // Accept all file types 
        $config['max_size'] = '0';
        // No file size limit 
        $config['file_name'] = $namaFailBaru;
        $config['overwrite'] = FALSE; 
        return $config;
    }

    public function libatUrus(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        switch($sesi){
            case 'ADMIN' :
                $data['header'] = 'admin_na/susunletak/atas';
                $data['navbar'] = 'admin_na/susunletak/navbar';
                $data['sidebar'] = 'admin_na/susunletak/sidebar';
                $data['footer'] = 'admin_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');

                //PERUBAHAN SETIAP PERANAN
                $this->load->model('komuniti_libaturus_model');
                $data['senaraiKomunitiLibatUrus'] = $this->komuniti_libaturus_model->rumusanLibatUrus();

                $this->load->view('komuniti/libatUrus/laman', $data);
                break;
            case 'URUSETIA' :
                $data['header'] = 'urusetia_na/susunletak/atas';
                $data['navbar'] = 'urusetia_na/susunletak/navbar';
                $data['sidebar'] = 'urusetia_na/susunletak/sidebar';
                $data['footer'] = 'urusetia_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');

                //PERUBAHAN SETIAP PERANAN
                $this->load->model('komuniti_libaturus_model');
                $data['senaraiKomunitiLibatUrus'] = $this->komuniti_libaturus_model->rumusanLibatUrus();

                $this->load->view('komuniti/libatUrus/laman', $data);
                break;
            case 'KP' :
                $data['header'] = 'kp_na/susunletak/atas';
                $data['navbar'] = 'kp_na/susunletak/navbar';
                $data['sidebar'] = 'kp_na/susunletak/sidebar';
                $data['footer'] = 'kp_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');

                //PERUBAHAN SETIAP PERANAN
                $this->load->model('komuniti_libaturus_model');
                $data['senaraiKomunitiLibatUrus'] = $this->komuniti_libaturus_model->rumusanLibatUrus();

                $this->load->view('komuniti/libatUrus/laman', $data);
                break;
            case 'US_PROGRAM' :
                $data['header'] = 'us_program_na/susunletak/atas';
                $data['navbar'] = 'us_program_na/susunletak/navbar';
                $data['sidebar'] = 'us_program_na/susunletak/sidebar';
                $data['footer'] = 'us_program_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');

                //PERUBAHAN SETIAP PERANAN
                $this->load->model('komuniti_libaturus_model');
                $data['senaraiKomunitiLibatUrus'] = $this->komuniti_libaturus_model->rumusanLibatUrus();

                $this->load->view('komuniti/libatUrus/laman', $data);
                break;
            case 'PPN' :
                $data['header'] = 'ppn_na/susunletak/atas';
                $data['navbar'] = 'ppn_na/susunletak/navbar';
                $data['sidebar'] = 'ppn_na/susunletak/sidebar';
                $data['footer'] = 'ppn_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');

                //PERUBAHAN SETIAP PERANAN
                $this->load->model('komuniti_libaturus_model');
                $this->load->model('negeri_model');
                $this->load->model('daerah_model');
                $data['senaraiNegeri'] = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiKomunitiLibatUrus'] = $this->komuniti_libaturus_model->rumusanLibatUrusDaerah($data['senaraiDaerah']);

                $this->load->view('komuniti/libatUrus/laman', $data);
                break;
            case 'PKPM':
                $data['header'] = 'us_program_negeri_na/susunletak/atas';
                $data['navbar'] = 'us_program_negeri_na/susunletak/navbar';
                $data['sidebar'] = 'us_program_negeri_na/susunletak/sidebar';
                $data['footer'] = 'us_program_negeri_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');

                //PERUBAHAN SETIAP PERANAN
                $this->load->model('komuniti_libaturus_model');
                $this->load->model('negeri_model');
                $this->load->model('daerah_model');
                $data['senaraiNegeri'] = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiKomunitiLibatUrus'] = $this->komuniti_libaturus_model->rumusanLibatUrusDaerah($data['senaraiDaerah']);


                $this->load->view('komuniti/libatUrus/laman', $data);
                break;
            case 'PPD' :
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');

                //PERUBAHAN SETIAP PERANAN
                $this->load->model('daerah_model');
                $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiKomunitiLibatUrus'] = $this->komuniti_libaturus_model->rumusanLibatUrusDaerah($data['senaraiDaerah']);

                //PPD
                $this->load->model('ppd_model');
                $data['senaraiProgramPpd'] = "";
                $ppd = $this->ppd_model->ppd($data['pengguna']->pengguna_peranan_bil);
                if($ppd && ($ppd->bil == $data['pengguna']->bil)){
                    $data['senaraiProgramPpd'] = $this->komuniti_libaturus_model->senaraiProgramPpd($data['pengguna']->pengguna_peranan_bil);
                }

                $this->load->view('komuniti/libatUrus/laman', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function senaraiLibatUrus(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        switch($sesi){
            case 'ADMIN' :
                $data['header'] = 'admin_na/susunletak/atas';
                $data['navbar'] = 'admin_na/susunletak/navbar';
                $data['sidebar'] = 'admin_na/susunletak/sidebar';
                $data['footer'] = 'admin_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/senarai', $data);
                break;
            case 'URUSETIA' :
                $data['header'] = 'urusetia_na/susunletak/atas';
                $data['navbar'] = 'urusetia_na/susunletak/navbar';
                $data['sidebar'] = 'urusetia_na/susunletak/sidebar';
                $data['footer'] = 'urusetia_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/senarai', $data);
                break;
            case 'KP' :
                $data['header'] = 'kp_na/susunletak/atas';
                $data['navbar'] = 'kp_na/susunletak/navbar';
                $data['sidebar'] = 'kp_na/susunletak/sidebar';
                $data['footer'] = 'kp_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/senarai', $data);
                break;
            case 'US_PROGRAM' :
                $data['header'] = 'us_program_na/susunletak/atas';
                $data['navbar'] = 'us_program_na/susunletak/navbar';
                $data['sidebar'] = 'us_program_na/susunletak/sidebar';
                $data['footer'] = 'us_program_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/senarai', $data);
                break;
            case 'PPN' :
                $data['header'] = 'ppn_na/susunletak/atas';
                $data['navbar'] = 'ppn_na/susunletak/navbar';
                $data['sidebar'] = 'ppn_na/susunletak/sidebar';
                $data['footer'] = 'ppn_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/senarai', $data);
                break;
            case 'PKPM':
                $data['header'] = 'us_program_negeri_na/susunletak/atas';
                $data['navbar'] = 'us_program_negeri_na/susunletak/navbar';
                $data['sidebar'] = 'us_program_negeri_na/susunletak/sidebar';
                $data['footer'] = 'us_program_negeri_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/senarai', $data);
                break;
            case 'PPD' :
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/senarai', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function tambahLibatUrus(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        switch($sesi){
            case 'ADMIN' :
                $data['header'] = 'admin_na/susunletak/atas';
                $data['navbar'] = 'admin_na/susunletak/navbar';
                $data['sidebar'] = 'admin_na/susunletak/sidebar';
                $data['footer'] = 'admin_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/tambah', $data);
                break;
            case 'URUSETIA' :
                $data['header'] = 'urusetia_na/susunletak/atas';
                $data['navbar'] = 'urusetia_na/susunletak/navbar';
                $data['sidebar'] = 'urusetia_na/susunletak/sidebar';
                $data['footer'] = 'urusetia_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/tambah', $data);
                break;
            case 'KP' :
                $data['header'] = 'kp_na/susunletak/atas';
                $data['navbar'] = 'kp_na/susunletak/navbar';
                $data['sidebar'] = 'kp_na/susunletak/sidebar';
                $data['footer'] = 'kp_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/tambah', $data);
                break;
            case 'US_PROGRAM' :
                $data['header'] = 'us_program_na/susunletak/atas';
                $data['navbar'] = 'us_program_na/susunletak/navbar';
                $data['sidebar'] = 'us_program_na/susunletak/sidebar';
                $data['footer'] = 'us_program_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/tambah', $data);
                break;
            case 'PPN' :
                $data['header'] = 'ppn_na/susunletak/atas';
                $data['navbar'] = 'ppn_na/susunletak/navbar';
                $data['sidebar'] = 'ppn_na/susunletak/sidebar';
                $data['footer'] = 'ppn_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/tambah', $data);
                break;
            case 'PKPM':
                $data['header'] = 'us_program_negeri_na/susunletak/atas';
                $data['navbar'] = 'us_program_negeri_na/susunletak/navbar';
                $data['sidebar'] = 'us_program_negeri_na/susunletak/sidebar';
                $data['footer'] = 'us_program_negeri_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/tambah', $data);
                break;
            case 'PPD' :
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                $this->load->model('daerah_model');
                $this->load->model('komuniti_model');
                $daerahSenarai = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiKomuniti'] = $this->komuniti_model->senaraiKomunitiDaerah($daerahSenarai);
                //PERUBAHAN SETIAP PERANAN
                $data['senaraiLaporan'] = $this->komuniti_libaturus_model->senaraiLaporan($data['pengguna']->bil);

                $this->load->view('komuniti/libatUrus/tambah', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function prosesTambahLibatUrus(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $tajukPerjumpaan = $this->input->post('inputTajukPerjumpaan');
        if(empty($tajukPerjumpaan)){
            redirect(base_url());
        }
        $this->load->model('komuniti_libaturus_model');
        $libatUrusNama = $this->input->post('inputTajukPerjumpaan');
        $libatUrusTarikhMasa = $this->input->post('inputTarikhMasa');
        $libatUrusKehadiran = $this->input->post('inputKehadiran');
        $libatUrusLokasi = $this->input->post('inputLokasi');
        $libatUrusCatatan = $this->input->post('inputCatatan');
        $penggunaNama = $data['pengguna']->nama_penuh;
        $penggunaJawatan = $data['pengguna']->pekerjaan;
        $penggunaNoTel = $data['pengguna']->no_tel;
        $penggunaPenempatan = $data['pengguna']->pengguna_tempat_tugas;
        $this->komuniti_libaturus_model->tambah($penggunaPenempatan, $libatUrusNama, $libatUrusTarikhMasa, $libatUrusKehadiran, $libatUrusCatatan, $penggunaBil, $penggunaNama, $penggunaJawatan, $penggunaNoTel, $libatUrusLokasi);
        redirect('komuniti/senaraiLibatUrus');
    }

    public function laporanLibatUrus($libatUrusBil){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        switch($sesi){
            case 'ADMIN' :
                $data['header'] = 'admin_na/susunletak/atas';
                $data['navbar'] = 'admin_na/susunletak/navbar';
                $data['sidebar'] = 'admin_na/susunletak/sidebar';
                $data['footer'] = 'admin_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['laporan'] = $this->komuniti_libaturus_model->laporan($libatUrusBil);
                $this->load->view('komuniti/libatUrus/bil', $data);
                break;
            case 'URUSETIA' :
                $data['header'] = 'urusetia_na/susunletak/atas';
                $data['navbar'] = 'urusetia_na/susunletak/navbar';
                $data['sidebar'] = 'urusetia_na/susunletak/sidebar';
                $data['footer'] = 'urusetia_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['laporan'] = $this->komuniti_libaturus_model->laporan($libatUrusBil);
                $this->load->view('komuniti/libatUrus/bil', $data);
                break;
            case 'KP' :
                $data['header'] = 'kp_na/susunletak/atas';
                $data['navbar'] = 'kp_na/susunletak/navbar';
                $data['sidebar'] = 'kp_na/susunletak/sidebar';
                $data['footer'] = 'kp_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['laporan'] = $this->komuniti_libaturus_model->laporan($libatUrusBil);
                $this->load->view('komuniti/libatUrus/bil', $data);
                break;
            case 'US_PROGRAM' :
                $data['header'] = 'us_program_na/susunletak/atas';
                $data['navbar'] = 'us_program_na/susunletak/navbar';
                $data['sidebar'] = 'us_program_na/susunletak/sidebar';
                $data['footer'] = 'us_program_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['laporan'] = $this->komuniti_libaturus_model->laporan($libatUrusBil);
                $this->load->view('komuniti/libatUrus/bil', $data);
                break;
            case 'PPN' :
                $data['header'] = 'ppn_na/susunletak/atas';
                $data['navbar'] = 'ppn_na/susunletak/navbar';
                $data['sidebar'] = 'ppn_na/susunletak/sidebar';
                $data['footer'] = 'ppn_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['laporan'] = $this->komuniti_libaturus_model->laporan($libatUrusBil);
                $this->load->view('komuniti/libatUrus/bil', $data);
                break;
            case 'PKPM':
                $data['header'] = 'us_program_negeri_na/susunletak/atas';
                $data['navbar'] = 'us_program_negeri_na/susunletak/navbar';
                $data['sidebar'] = 'us_program_negeri_na/susunletak/sidebar';
                $data['footer'] = 'us_program_negeri_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $data['laporan'] = $this->komuniti_libaturus_model->laporan($libatUrusBil);
                $this->load->view('komuniti/libatUrus/bil', $data);
                break;
            case 'PPD' :
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $this->load->model('komuniti_libaturus_model');
                //PERUBAHAN SETIAP PERANAN
                $this->load->model('komuniti_model');
                $this->load->model('daerah_model');
                $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiKomuniti'] = $this->komuniti_model->senaraiKomunitiDaerah($data['senaraiDaerah']);
                $data['laporan'] = $this->komuniti_libaturus_model->laporan($libatUrusBil);
                if($data['pengguna']->bil !== $data['laporan']->libatUrusPelapor){
                    redirect('komuniti/libatUrusBil/'.$libatUrusBil);
                }
                $data['senaraiKomunitiTerlibat'] = $this->komuniti_libaturus_model->senaraiKomunitiTerlibat($libatUrusBil);
                $data['gambarLibatUrus'] = $this->komuniti_libaturus_model->senaraiGambar($libatUrusBil);
                $this->load->view('komuniti/libatUrus/bil', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function prosesSenaraiKomunitiLibatUrus(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($sesi)){
            redirect(base_url());
        }
        $senaraiKomunitiBil = $this->input->post('inputKomunitiBil');
        $libatUrusBil = $this->input->post('inputLaporanBil');
        $this->load->model('komuniti_libaturus_model');
        $this->load->model('komuniti_model');
        $libatUrus = $this->komuniti_libaturus_model->laporan($libatUrusBil);
        $this->komuniti_libaturus_model->buangSemuaTerlibat($libatUrusBil);
        if (!empty($senaraiKomunitiBil)) { 
            foreach ($senaraiKomunitiBil as $komunitiBil) { 
                $km = $this->komuniti_model->komuniti($komunitiBil);
                $this->komuniti_libaturus_model->tambahKomunitiTerlibat($km, $libatUrus, $data['pengguna']);
            } 
        }
        redirect('komuniti/laporanLibatUrus/'.$libatUrusBil);
    }

    public function kemaskiniLaporanLibatUrus($libatUrusBil){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    }


    public function prosesDaftar(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('peranan_model');
        $this->load->model('komuniti_model');
        $pengguna = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
          }
        switch($sesi){
            case 'PPD' :
              $nama = $this->input->post('inputNama');
              $negeriBil = $this->input->post('inputNegeri');
              $daerahBil = $this->input->post('inputDaerah');
              $parlimenBil = $this->input->post('inputParlimen');
              $dunBil = $this->input->post('inputDun');
              $penggunaBil = $this->input->post('inputPengguna');
              $ada = $this->komuniti_model->ada($nama, $negeriBil, $daerahBil, $parlimenBil, $dunBil, $penggunaBil);
              if(empty($ada)){
                $entri = $this->komuniti_model->daftar($nama, $negeriBil, $daerahBil, $parlimenBil, $dunBil, $penggunaBil);
                redirect('komuniti/bil/'.$entri['last_id']);
              }else{
                redirect('komuniti/bil/'.$ada->komuniti_bil);
              }
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
        $this->load->model('komuniti_model');
        $pengguna = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PKPM') !== FALSE){
          $sesi = 'PKPM';
        }
        switch($sesi){
          case 'PKPM' :
            $senaraiNegeri = $this->peranan_model->tugasNegeriPeranan($pengguna->pengguna_peranan_bil);
            $jumlahKomuniti = $this->komuniti_model->bilanganKomunitiNegeri($senaraiNegeri);
            echo $jumlahKomuniti->jumlahKomuniti;
            break;
          default :
            redirect(base_url());
        }
      }

    public function daftarAhli(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $komunitiBil = $this->input->post('inputKomuniti');
        $this->load->model('komuniti_ahli_model');
                $entri = $this->komuniti_ahli_model->tambahAhliPost();
        $sesi = 'US_PROGRAM';
        switch($sesi){
            case 'US_PROGRAM' :
                if($entri){
                    redirect('komuniti/bil/'.$komunitiBil);
                }else{
                    echo "TERDAPAT MASALAH.";
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function senaraiAhli($komunitiBil){
        if(empty($komunitiBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('komuniti_model');
        $this->load->model('komuniti_ahli_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['komuniti'] = $this->komuniti_model->komuniti($komunitiBil);
       $sesi = 'US_PROGRAM';
        switch($sesi){
            case 'US_PROGRAM' :
                $data['senaraiAhli'] = $this->komuniti_ahli_model->senarai($komunitiBil);
                $this->load->view('us_program_na/komuniti/ahli/senaraiIkutKomuniti', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function carian(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model("peranan_model");
        $this->load->model('negeri_model');
        $this->load->model('daerah_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $this->load->model('komuniti_model');
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
                $data['senaraiKomuniti'] = $this->komuniti_model->keputusanCarian();
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $data['senaraiDaerah'] = $this->daerah_model->senarai();
                $data['senaraiParlimen'] = $this->parlimen_model->senarai();
                $data['senaraiDun'] = $this->dun_model->senarai();
                $this->load->view('urusetia_na/komuniti/keputusanCarian', $data);
                break;
            case 'PKPM' :
                $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($data['senaraiNegeri']);
                //$data['senaraiKomuniti'] = $this->komuniti_model->senaraiKomuniti($data['senaraiNegeri'], $data['senaraiDaerah'], $data['senaraiParlimen'], $data['senaraiDun']);
                $data['senaraiKomuniti'] = $this->komuniti_model->mengikutCarian($data['senaraiNegeri'], $data['senaraiDaerah'], $data['senaraiParlimen'], $data['senaraiDun']);
                $this->load->view('us_program_negeri_na/komuniti/keputusanCarian', $data);
                break;
            case 'NEGERI' :
                $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiKomuniti'] = $this->komuniti_model->senaraiKomuniti($data['senaraiNegeri'], $data['senaraiDaerah'], $data['senaraiParlimen'], $data['senaraiDun']);
                $this->load->view('negeri_na/komuniti/keputusanCarian', $data);
                break;
            case 'PPD' :
                $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($data['pengguna']->pengguna_peranan_bil);
                $inputPengguna = $this->input->post('inputPengguna');
                if(!empty($inputPengguna)){
                    $data['senaraiKomuniti'] = $this->komuniti_model->keputusanCarian();
                }else{
                    $data['senaraiKomuniti'] = $this->komuniti_model->senaraiKomuniti($data['senaraiNegeri'], $data['senaraiDaerah'], $data['senaraiParlimen'], $data['senaraiDun']);
                }
                $this->load->view('ppd_na/komuniti/keputusanCarian', $data);
                break;
            case 'US_PROGRAM' :
                $data['senaraiKomuniti'] = $this->komuniti_model->keputusanCarian();
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $data['senaraiDaerah'] = $this->daerah_model->senarai();
                $data['senaraiParlimen'] = $this->parlimen_model->senarai();
                $data['senaraiDun'] = $this->dun_model->senarai();
                $this->load->view('us_program_na/komuniti/keputusanCarian', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function senarai(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('peranan_model');
        $this->load->model('negeri_model');
        $this->load->model('daerah_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $this->load->model('komuniti_model');
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
                $data['senaraiKomuniti'] = $this->komuniti_model->senaraiKomunitiPenuh();
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $data['senaraiDaerah'] = $this->daerah_model->senarai();
                $data['senaraiParlimen'] = $this->parlimen_model->senarai();
                $data['senaraiDun'] = $this->dun_model->senarai();
                $this->load->view('urusetia_na/komuniti/senarai', $data);
                break;
            case 'PKPM' :
                $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiKomuniti'] = $this->komuniti_model->senaraiKomuniti($data['senaraiNegeri'], $data['senaraiDaerah'], $data['senaraiParlimen'], $data['senaraiDun']);
                $this->load->view('us_program_negeri_na/komuniti/senarai', $data);
                break;
            case 'NEGERI' :
                $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->daerahMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiParlimen'] = $this->parlimen_model->parlimenMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiDun'] = $this->dun_model->dunMengikutSenaraiNegeri($data['senaraiNegeri']);
                $data['senaraiKomuniti'] = $this->komuniti_model->senaraiKomuniti($data['senaraiNegeri'], $data['senaraiDaerah'], $data['senaraiParlimen'], $data['senaraiDun']);
                $this->load->view('negeri_na/komuniti/senarai', $data);
                break;
            case 'PPD' :
                $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiKomuniti'] = $this->komuniti_model->senaraiKomuniti($data['senaraiNegeri'], $data['senaraiDaerah'], $data['senaraiParlimen'], $data['senaraiDun']);
                if(!empty($data['pengguna']->pengguna_status)){
                    //$data['senaraiKomuniti'] = $this->komuniti_model->senaraiKomunitiPelapor($data['pengguna']->bil);
                    $data['senaraiKomuniti'] = $this->komuniti_model->senaraiIkutDaerah($data['senaraiDaerah']);
                }
                $this->load->view('ppd_na/komuniti/senarai', $data);
                break;
            case 'US_PROGRAM' :
                $data['senaraiKomuniti'] = $this->komuniti_model->senaraiKomunitiPenuh();
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $data['senaraiDaerah'] = $this->daerah_model->senarai();
                $data['senaraiParlimen'] = $this->parlimen_model->senarai();
                $data['senaraiDun'] = $this->dun_model->senarai();
                $this->load->view('us_program_na/komuniti/senarai', $data);
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
                $this->load->view('us_program_na/komuniti/padamBerjaya', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function padamKomuniti(){
        $komunitiBil = $this->input->post('inputKomunitiBil');
        if(empty($komunitiBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $sesi = 'US_PROGRAM';
        $this->load->model('komuniti_model');
        switch($sesi){
            case 'US_PROGRAM':
                $aktiviti = $this->komuniti_model->padamKomuniti($komunitiBil);
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

    public function daftarKomunitiDun(){
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
                $this->load->view('us_program_na/komuniti/daftarKomunitiDun', $data);
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
                $this->load->view('us_program_na/komuniti/senaraiDun', $data);
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
                $this->load->view('us_program_na/komuniti/senaraiParlimen', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function prosesAm(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $this->load->model('komuniti_model');
        $entri = $this->komuniti_model->kemaskiniAmPost();
        $sesi = 'US_PROGRAM';
        switch($sesi){
            case 'US_PROGRAM' :
                if($entri){
                    redirect('komuniti/bil/'.$this->input->post('inputKomunitiBil'));
                }else{
                    redirect(base_url());
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function bil($komunitiBil){
        if(empty($komunitiBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        $this->load->model('pengguna_model');
        $this->load->model('komuniti_model');
        $this->load->model('daerah_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $this->load->model('program_komuniti_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['komuniti'] = $this->komuniti_model->komuniti($komunitiBil);
        $negeriBil = $data['komuniti']->komuniti_negeri;
        $data['senaraiDaerah'] = $this->daerah_model->daerah_negeri($negeriBil);
        $data['senaraiParlimen'] = $this->parlimen_model->parlimen_negeri($negeriBil);
        $data['senaraiDun'] = $this->dun_model->dun_negeri($negeriBil);
        $data['senaraiProgram'] = $this->program_komuniti_model->libatProgram($komunitiBil);
        switch($sesi){
            case "URUSETIA" :
                $this->load->view('us_program_na/komuniti/komuniti', $data);
                break;
            case "PKPM" :
                $this->load->view('us_program_negeri_na/komuniti/komuniti', $data);
                break;
            case "PPD" :
                $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($data['pengguna']->pengguna_peranan_bil);
                $this->load->view('ppd_na/komuniti/komuniti', $data);
                break;
            case "US_PROGRAM" :
                $this->load->view('us_program_na/komuniti/komuniti', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function daftarKomuniti(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $negeriBil = $this->input->post('inputNegeriBil');
        $daerahBil = $this->input->post('inputDaerahBil');
        $parlimenBil = $this->input->post('inputParlimenBil');
        $dunBil = $this->input->post('inputDunBil');
        $penggunaBil = $this->input->post('inputPenggunaBil');
        $nama = $this->input->post('inputNama');
        $this->load->model('komuniti_model');
        $sesi = 'US_PROGRAM';
        switch($sesi){
            case 'US_PROGRAM' :
                $entri = $this->komuniti_model->daftar($nama, $negeriBil, $daerahBil, $parlimenBil, $dunBil, $penggunaBil);
                redirect('komuniti/bil/'.$entri['last_id']);
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
                $this->load->view('us_program_na/komuniti/pilihDaerah', $data);
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
        switch($sesi){
            case 'PKPM' :
                $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
                $this->load->view('us_program_negeri_na/komuniti/pilihNegeri', $data);
                break;
            case 'NEGERI' :
                $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
                $this->load->view('negeri_na/komuniti/pilihNegeri', $data);
                break;
            case 'PPD' :
                $this->load->model('parlimen_model');
                $this->load->model('dun_model');
                $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($data['pengguna']->pengguna_peranan_bil);
                $this->load->view('ppd_na/komuniti/daftar', $data);
                break;
            case "US_PROGRAM" :
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $this->load->view('us_program_na/komuniti/pilihNegeri', $data);
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
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        switch($sesi){
            case "PPD" :
                $this->load->model('komuniti_model');
                $this->load->model('daerah_model');
                $this->load->model('komuniti_libaturus_model');
                $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
                $data['rumusanDaerah'] = $this->komuniti_model->rumusanKomunitiDaerahPeranan($data['pengguna']->pengguna_peranan_bil, $penggunaBil);
                $data['rumusanParlimen'] = $this->komuniti_model->rumusanKomunitiParlimenPeranan($data['pengguna']->pengguna_peranan_bil, $penggunaBil);
                $data['rumusanDun'] = $this->komuniti_model->rumusanKomunitiDunPeranan($data['pengguna']->pengguna_peranan_bil, $penggunaBil);
                $data['senaraiKomunitiLibatUrus'] = $this->komuniti_libaturus_model->rumusanLibatUrusDaerah($data['senaraiDaerah']);
                $this->load->view('ppd_na/komuniti/laman', $data);
                break;
            case "PKPM" :
                $this->load->view('us_program_negeri_na/komuniti/laman', $data);
                break;
            case "US_PROGRAM" :
                $this->load->view('us_program_na/komuniti/laman', $data);
                break;
            default :
                redirect(base_url());
        }
    }

}