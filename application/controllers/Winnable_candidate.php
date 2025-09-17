<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Winnable_candidate extends CI_Controller {

    public function daftar_dun(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(empty($sesi)){
            redirect(base_url());
        }
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        switch($sesi){
            case 'NEGERI' :
                $this->load->library('form_validation');
                $this->load->model(['parti_model', 'foto_model', 'negeri_model']);
                $this->load->model('dun_model');
                $this->load->model('jangkaan_calon_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiParti'] = $this->parti_model->senaraiParti();
                $data['senaraiDun'] = $this->dun_model->senaraiDunNegeri($senaraiNegeri);
                $data['header'] = 'negeri_na/susunletak/atas';
                $data['sidebar'] = 'negeri_na/susunletak/sidebar';
                $data['navbar'] = 'negeri_na/susunletak/navbar';
                $data['footer'] = 'negeri_na/susunletak/bawah';
                $this->form_validation->set_rules('inputNama', 'Nama Calon', 'required');
                $this->form_validation->set_message('required', 'Sila penuhi maklumat di ruangan {field}');
                $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
                if($this->form_validation->run() == FALSE){
                    $this->load->view('sismap/jangkaanCalon/daftarDun', $data);
                }else{
                    $this->load->library('upload');

                    $data = array(
                        "jdt_foto_bil" => 0,
                        "jdt_nama_penuh" => $this->input->post('inputNama'),
                        "jdt_parti_bil" => $this->input->post('inputParti'),
                        "jdt_jawatan_parti" => $this->input->post('inputJawatan'),
                        "jdt_kategori_umur" => $this->input->post('inputKategoriUmur'),
                        "jdt_jantina" => $this->input->post('inputJantina'),
                        "jdt_kaum" => $this->input->post('inputKaum'),
                        "jdt_status_calon" => $this->input->post('inputStatus'),
                        "jdt_pengguna_bil" => $this->input->post('inputPengguna'),
                        "jdt_pengguna_waktu" => $this->input->post('inputWaktu'),
                        "jdt_dun_bil" => $this->input->post('inputDun')
                    );
                    $this->db->insert('jangka_dun_tb', $data);
                    $jdtBil = $this->db->insert_id();

                    $config['upload_path'] = './assets/img/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['file_name'] = date('Y-m-d') . 'JCD' . $jdtBil;
                    $config['overwrite'] = TRUE; 
                    $config['max_size'] = 5120;

                    $this->upload->initialize($config); 
                    if (!$this->upload->do_upload('inputGambar')) {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('winnable_candidate/daftar_dun');
                    } else {
                        $upload_data = $this->upload->data();
                        $nama_fail = $upload_data['file_name'];
                        $fotoDeskripsi = "Gambar jangkaan calon DUN : " . $this->input->post('inputNama');
                        $fotoBil = $this->foto_model->uploadGambarJdt($nama_fail, $fotoDeskripsi, $penggunaBil);
                        $this->db->where('jdt_bil', $jdtBil);
                        $this->db->update('jangka_dun_tb', ['jdt_foto_bil' => $fotoBil]);
                        $this->session->set_flashdata('success', 'Data berjaya disimpan.');
                        redirect('winnable_candidate');
                    }
                }                
                break;
            case 'DATA' :
                $this->load->library('form_validation');
                $this->load->model(['parti_model', 'foto_model']);
                $this->load->model('dun_model');
                $this->load->model('jangkaan_calon_model');
                $data['senaraiParti'] = $this->parti_model->senaraiParti();
                $data['senaraiDun'] = $this->dun_model->senaraiDun();
                $data['header'] = 'us_sismap_na/susunletak/atas';
                $data['sidebar'] = 'us_sismap_na/susunletak/sidebar';
                $data['navbar'] = 'us_sismap_na/susunletak/navbar';
                $data['footer'] = 'us_sismap_na/susunletak/bawah';
                $this->form_validation->set_rules('inputNama', 'Nama Calon', 'required');
                $this->form_validation->set_message('required', 'Sila penuhi maklumat di ruangan {field}');
                $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
                if($this->form_validation->run() == FALSE){
                    $this->load->view('sismap/jangkaanCalon/daftarDun', $data);
                }else{
                    $this->load->library('upload');

                    $data = array(
                        "jdt_foto_bil" => 0,
                        "jdt_nama_penuh" => $this->input->post('inputNama'),
                        "jdt_parti_bil" => $this->input->post('inputParti'),
                        "jdt_jawatan_parti" => $this->input->post('inputJawatan'),
                        "jdt_kategori_umur" => $this->input->post('inputKategoriUmur'),
                        "jdt_jantina" => $this->input->post('inputJantina'),
                        "jdt_kaum" => $this->input->post('inputKaum'),
                        "jdt_status_calon" => $this->input->post('inputStatus'),
                        "jdt_pengguna_bil" => $this->input->post('inputPengguna'),
                        "jdt_pengguna_waktu" => $this->input->post('inputWaktu'),
                        "jdt_dun_bil" => $this->input->post('inputDun')
                    );
                    $this->db->insert('jangka_dun_tb', $data);
                    $jdtBil = $this->db->insert_id();

                    $config['upload_path'] = './assets/img/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['file_name'] = date('Y-m-d') . 'JCD' . $jdtBil;
                    $config['overwrite'] = TRUE; 
                    $config['max_size'] = 5120;

                    $this->upload->initialize($config); 
                    if (!$this->upload->do_upload('inputGambar')) {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('winnable_candidate/daftar_dun');
                    } else {
                        $upload_data = $this->upload->data();
                        $nama_fail = $upload_data['file_name'];
                        $fotoDeskripsi = "Gambar jangkaan calon DUN : " . $this->input->post('inputNama');
                        $fotoBil = $this->foto_model->uploadGambarJdt($nama_fail, $fotoDeskripsi, $penggunaBil);
                        $this->db->where('jdt_bil', $jdtBil);
                        $this->db->update('jangka_dun_tb', ['jdt_foto_bil' => $fotoBil]);
                        $this->session->set_flashdata('success', 'Data berjaya disimpan.');
                        redirect('winnable_candidate');
                    }
                }                
                break;
            default :
                redirect(base_url());
        }
    }

    public function parlimen($parlimenBil){
        if(empty($parlimenBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, "PPD") !== FALSE)
		{
			$sesi = 'PPD';
		}
        switch($sesi){
            case 'DATA' :
                $this->load->model('parlimen_model');
                $this->load->model('winnable_candidate_parlimen_model');
                $data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimenBil);
                $data['senaraiCalon'] = $this->winnable_candidate_parlimen_model->senaraiCalonParlimen($parlimenBil);
                $data['senaraiKekuatan'] = $this->winnable_candidate_parlimen_model->kekuatanCalonParlimen('Kekuatan Calon', $parlimenBil);
                $data['senaraiKelemahan'] = $this->winnable_candidate_parlimen_model->kekuatanCalonParlimen('Kelemahan Calon', $parlimenBil);
                $data['header'] = 'us_sismap_na/susunletak/atas';
                $data['navbar'] = 'us_sismap_na/susunletak/navbar';
                $data['sidebar'] = 'us_sismap_na/susunletak/sidebar';
                $data['footer'] = 'us_sismap_na/susunletak/bawah';
                $this->load->view('sismap/jangkaanCalon/parlimen', $data);
                break;
            case 'PPD' :
                $this->load->model('winnable_candidate_parlimen_model');
                $data['calon'] = $this->winnable_candidate_parlimen_model->bil($jcBil);
                $data['kekuatan_calon'] = $this->winnable_candidate_parlimen_model->kekuatan_calon($jcBil, 'Kekuatan Calon');
                $data['kelemahan_calon'] = $this->winnable_candidate_parlimen_model->kekuatan_calon($jcBil, 'Kelemahan Calon');
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $this->load->view('sismap/jangkaanCalon/calonBilParlimen', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function bil($jcBil){
        if(empty($jcBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, "PPD") !== FALSE)
		{
			$sesi = 'PPD';
		}
        switch($sesi){
            case 'DATA' :
                $this->load->model('winnable_candidate_parlimen_model');
                $data['calon'] = $this->winnable_candidate_parlimen_model->bil($jcBil);
                $data['kekuatan_calon'] = $this->winnable_candidate_parlimen_model->kekuatan_calon($jcBil, 'Kekuatan Calon');
                $data['kelemahan_calon'] = $this->winnable_candidate_parlimen_model->kekuatan_calon($jcBil, 'Kelemahan Calon');
                $data['header'] = 'us_sismap_na/susunletak/atas';
                $data['navbar'] = 'us_sismap_na/susunletak/navbar';
                $data['sidebar'] = 'us_sismap_na/susunletak/sidebar';
                $data['footer'] = 'us_sismap_na/susunletak/bawah';
                $this->load->view('sismap/jangkaanCalon/calonBilParlimen', $data);
                break;
            case 'PPD' :
                $this->load->model('winnable_candidate_parlimen_model');
                $data['calon'] = $this->winnable_candidate_parlimen_model->bil($jcBil);
                $data['kekuatan_calon'] = $this->winnable_candidate_parlimen_model->kekuatan_calon($jcBil, 'Kekuatan Calon');
                $data['kelemahan_calon'] = $this->winnable_candidate_parlimen_model->kekuatan_calon($jcBil, 'Kelemahan Calon');
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $this->load->view('sismap/jangkaanCalon/calonBilParlimen', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function calonParlimen($jcBil){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'DATA' :
                $this->load->model('winnable_candidate_parlimen_model');
                $data['calon'] = $this->winnable_candidate_parlimen_model->bil($jcBil);
                $data['kekuatan_calon'] = $this->winnable_candidate_parlimen_model->kekuatan_calon($jcBil, 'Kekuatan Calon');
                $data['kelemahan_calon'] = $this->winnable_candidate_parlimen_model->kekuatan_calon($jcBil, 'Kelemahan Calon');
                $data['header'] = 'us_sismap_na/susunletak/atas';
                $data['navbar'] = 'us_sismap_na/susunletak/navbar';
                $data['sidebar'] = 'us_sismap_na/susunletak/sidebar';
                $data['footer'] = 'us_sismap_na/susunletak/bawah';
                $this->load->view('sismap/jangkaanCalon/calonBilParlimen', $data);
                break;
            case 'KP' :
                $this->load->model('winnable_candidate_parlimen_model');
                $data['senaraiCalon'] = $this->winnable_candidate_parlimen_model->senaraiCalon();
                $this->load->view('kp_na/sismap/jangkaanCalon/calonParlimen', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function kemaskiniCalonDun($calonId){
        if(empty($calonId)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('negeri_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'DATA' :
                $this->load->model('dun_model');
                $this->load->model('foto_model');
                $this->load->model('jangka_dun_model');
                $this->load->model('parti_model');
                $data['calon'] = $this->jangka_dun_model->calon_id($calonId);
                $data['dun'] = $this->dun_model->dun($data['calon']->jdt_dun_bil);
                $data['data_foto'] = $this->foto_model;
                $data['senarai_parti'] = $this->parti_model->senarai();
                $this->load->view('us_sismap_na/sismap/jangkaan_calon/kemaskiniCalonDun', $data);
                break;
            default :
                redirect(base_url());
        }

    }

    public function senaraiDun($negeriBil){
        if(empty($negeriBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('negeri_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['negeri'] = $this->negeri_model->negeri($negeriBil);
        switch($sesi){
            case 'DATA' :
                $this->load->model('dun_model');
                $this->load->model('foto_model');
                $this->load->model('jangka_dun_model');
                $data['senaraiDun'] = $this->dun_model->dun_negeri($negeriBil);
                $data['dataCalonDun'] = $this->jangka_dun_model;
                $data['dataFoto'] = $this->foto_model;
                $this->load->view('us_sismap_na/sismap/jangkaan_calon/senaraiDun', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function senaraiParlimen($negeriBil){
        if(empty($negeriBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('negeri_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['negeri'] = $this->negeri_model->negeri($negeriBil);
        switch($sesi){
            case 'DATA' :
                $this->load->model('parlimen_model');
                $this->load->model('winnable_candidate_parlimen_model');
                $this->load->model('foto_model');
                $data['senaraiParlimen'] = $this->parlimen_model->parlimen_negeri($negeriBil);
                $data['dataCalonParlimen'] = $this->winnable_candidate_parlimen_model;
                $data['dataFoto'] = $this->foto_model;
                $this->load->view('us_sismap_na/sismap/jangkaan_calon/senaraiParlimen', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function dun($dunBil)
    {   
        if(empty($dunBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('dun_model');
        $this->load->model('jangka_dun_model');
        $this->load->model('foto_model');
        $data['dun'] = $this->dun_model->dun($dunBil);
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['senaraiCalon'] = $this->jangka_dun_model->calon_dun($dunBil);
        $data['dataFoto'] = $this->foto_model;
        $data['dataKuatLemah'] = $this->jangka_dun_model;
        $data['dataPengguna'] = $this->pengguna_model;
        switch($sesi){
            case 'DATA' :
                $this->load->view('us_sismap_na/sismap/jangkaan_calon/dun', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function exportDunToPdf($negeriBil){
        $sesi = strtoupper($this->session->userdata('peranan'));
        switch($sesi){
            case 'DATA' : 
                $this->load->library('fpdf/fpdf');
                $pdf = new FPDF();
                $pdf->AddPage('L', 'A4');
                $pdf->SetFont('Arial','B',10);

                $pdf->Cell(40,10,'Senarai Jangkaan Calon'); 
                $pdf->Ln();

                $header = array('DUN', 'Foto', 'Nama Penuh', 'Parti', 'Jawatan Parti', 'Kategori Umur', 'Jantina', 'Kaum', 'Status Calon', 'Kemaskini', 'Kekuatan', 'Kelemahan');

                foreach($header as $col){
                    $width = '20';
                    if($col == 'Nama Penuh'){
                        $width = '40';
                    }
                    if($col == 'Jawatan Parti' || $col == 'Kategori Umur'){
                        $width = '30';
                    }
                $pdf->Cell($width,7,$col,1);
                }
                //$pdf->Ln();
                // Data
                /* foreach($data as $row)
                {
                    foreach($row as $col)
                        $this->Cell(40,6,$col,1);
                    $this->Ln();
                }

                */


                $pdf->Output();
                break;
            default :
                redirect(base_url());
        }
    }

    public function negeri($negeriBil){
        if(empty($negeriBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(empty($sesi)){
            redirect(base_url());
        }
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(empty($penggunaBil)){
            redirect(base_url());
        }
        $this->load->model('negeri_model');
        $this->load->model('pengguna_model');
        $data['negeri'] = $this->negeri_model->negeri($negeriBil);
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'URUSETIA' : 
                $this->load->model('parlimen_model');
                $this->load->model('dun_model');
                $this->load->model('winnable_candidate_parlimen_model');
                $this->load->model('foto_model');
                $this->load->model('jangka_dun_model');
                $data['senaraiParlimen'] = $this->parlimen_model->parlimen_negeri($negeriBil);
                $data['senaraiDun'] = $this->dun_model->dun_negeri($negeriBil);
                $data['dataCalonParlimen'] = $this->winnable_candidate_parlimen_model;
                $data['dataCalonDun'] = $this->jangka_dun_model;
                $data['dataFoto'] = $this->foto_model;
                $this->load->view('urusetia_na/sismap/jangkaan_calon/negeri', $data);
            break;
            case 'DATA' : 
                $this->load->model('parlimen_model');
                $this->load->model('dun_model');
                $this->load->model('winnable_candidate_parlimen_model');
                $this->load->model('foto_model');
                $this->load->model('jangka_dun_model');
                $data['senaraiParlimen'] = $this->parlimen_model->parlimen_negeri($negeriBil);
                $data['senaraiDun'] = $this->dun_model->dun_negeri($negeriBil);
                $data['dataCalonParlimen'] = $this->winnable_candidate_parlimen_model;
                $data['dataCalonDun'] = $this->jangka_dun_model;
                $data['dataFoto'] = $this->foto_model;
                $this->load->view('us_sismap_na/sismap/jangkaan_calon/negeri', $data);
            break;
            default : redirect(base_url());
        }
    }

    public function senarai_negeri()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        switch($sesi){
            case 'NEGERI' :
                if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
                {
                    redirect(base_url());
                }
                $this->load->model('parlimen_model');
                $this->load->model('winnable_candidate_assign_model');
                $this->load->model('winnable_candidate_parlimen_model');
                $this->load->model('pengguna_model');
                $this->load->model('foto_model');
                $pengguna = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));
                $assign = $this->winnable_candidate_assign_model->assign($pengguna->pengguna_peranan_bil);
                if(empty($assign)){
                    $negeri = "";
                    $senarai_parlimen = $this->parlimen_model->ikut_tugasan($pengguna->pengguna_peranan_bil);
                }else{
                    $negeri = $assign->wcat_negeri;
                    $senarai_parlimen = $this->parlimen_model->paparIkutNegeri($negeri);
                }
                $data['senarai_parlimen_negeri'] = $senarai_parlimen;
                $data['negeri'] = $negeri;
                $data['data_calon'] = $this->winnable_candidate_parlimen_model;
                $data['data_foto'] = $this->foto_model;
                $data['header'] = 'negeri_na/susunletak/atas';
                $data['sidebar'] = 'negeri_na/susunletak/sidebar';
                $data['navbar'] = 'negeri_na/susunletak/navbar';
                $data['footer'] = 'negeri_na/susunletak/bawah';
                $this->load->view('winnable_candidate/senaraiNegeri', $data);
                break;
            case 'PPD'  :
                if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
                {
                    redirect(base_url());
                }
                $this->load->model('parlimen_model');
                $this->load->model('winnable_candidate_assign_model');
                $this->load->model('winnable_candidate_parlimen_model');
                $this->load->model('pengguna_model');
                $this->load->model('foto_model');
                $pengguna = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));
                $assign = $this->winnable_candidate_assign_model->assign($pengguna->pengguna_peranan_bil);
                if(empty($assign)){
                    $negeri = "";
                    $senarai_parlimen = $this->parlimen_model->ikut_tugasan($pengguna->pengguna_peranan_bil);
                }else{
                    $negeri = $assign->wcat_negeri;
                    $senarai_parlimen = $this->parlimen_model->paparIkutNegeri($negeri);
                }
                $data['senarai_parlimen_negeri'] = $senarai_parlimen;
                $data['negeri'] = $negeri;
                $data['data_calon'] = $this->winnable_candidate_parlimen_model;
                $data['data_foto'] = $this->foto_model;
                $this->load->view('susunletak/atas', $data);
                $this->load->view('winnable_candidate/senarai_negeri');
                $this->load->view('susunletak/bawah');
                break;
            case 'URUSETIA' :   
                $this->load->model('negeri_model');
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $this->load->view('urusetia_na/sismap/jangkaan_calon/senarai_negeri', $data);
                break;
            case 'DATA' :   
                    $this->load->model('negeri_model');
                    $data['senaraiNegeri'] = $this->negeri_model->senarai();
                    $this->load->view('us_sismap_na/sismap/jangkaan_calon/senarai_negeri', $data);
                    break;
            default :   redirect(base_url());
        }
        
    }

    public function index()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        switch($sesi){
            case 'NEGERI' :
                $data['header'] = 'us_sismap_na/susunletak/atas';
                $data['sidebar'] = 'us_sismap_na/susunletak/sidebar';
                $data['navbar'] = 'us_sismap_na/susunletak/navbar';
                $data['footer'] = 'us_sismap_na/susunletak/bawah';
                $this->load->model('jangkaan_calon_model');
                $this->load->model('negeri_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiNegeriCalon'] = $this->jangkaan_calon_model->rumusanNegeri($senaraiNegeri);
                $this->load->view('sismap/jangkaanCalon/utama', $data);
                break;
            case 'URUSETIA' : 
                $data['header'] = 'urusetia_na/susunletak/atas';
                $data['sidebar'] = 'urusetia_na/susunletak/sidebar';
                $data['navbar'] = 'urusetia_na/susunletak/navbar';
                $data['footer'] = 'urusetia_na/susunletak/bawah';
                $this->load->model('jangkaan_calon_model');
                $data['senaraiNegeriCalon'] = $this->jangkaan_calon_model->senaraiNegeriCalon();
                $this->load->view('sismap/jangkaanCalon/utama', $data);
                break;
            case 'DATA' :
                $data['header'] = 'us_sismap_na/susunletak/atas';
                $data['sidebar'] = 'us_sismap_na/susunletak/sidebar';
                $data['navbar'] = 'us_sismap_na/susunletak/navbar';
                $data['footer'] = 'us_sismap_na/susunletak/bawah';
                $this->load->model('jangkaan_calon_model');
                $data['senaraiNegeriCalon'] = $this->jangkaan_calon_model->senaraiNegeriCalon();
                $this->load->view('sismap/jangkaanCalon/utama', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function proses_kerja()
    {
        if($this->session->userdata('peranan') != 'Urusetia'){
        redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->load->model('winnable_candidate_assign_model');
        $this->form_validation->set_rules('input_jabatan_bil', 'Jabatan', 'callback_pilih_check');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        if($this->form_validation->run() === FALSE){
            $this->index();
        }else{
            $this->winnable_candidate_assign_model->daftar();
            $this->index();
        }
    }

    function pilih_check($str)
    {
        if ($str == 0)
                {
                        $this->form_validation->set_message('pilih_check', 'Sila pilih di ruangan {field}');
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
    }

    public function proses_daftar()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }elseif(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
                $this->load->library('form_validation');
                $this->load->model('winnable_candidate_parlimen_model');
                $this->form_validation->set_rules('input_parlimen_bil', 'Parlimen', 'callback_pilih_check');
                $this->form_validation->set_rules('input_nama_penuh', 'Nama Calon', 'required');
                $this->form_validation->set_rules('input_parti_bil', 'Parti', 'callback_pilih_check');
                $this->form_validation->set_rules('input_jawatan_parti', 'Jawatan Parti', 'required');
                $this->form_validation->set_rules('input_kategori_umur', 'Kategori Umur', 'callback_pilih_check');
                $this->form_validation->set_message('required', 'Sila penuhi maklumat di ruangan {field}');
                $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
                if($this->form_validation->run() === FALSE){
                    $this->daftar();
                }else{
                    $data_calon = $this->winnable_candidate_parlimen_model->daftar();
                    $this->proses_gambar($data_calon['last_id']);
                }
                break;
            case 'DATA' :
                $this->load->library('form_validation');
                $this->load->model('winnable_candidate_parlimen_model');
                $this->form_validation->set_rules('input_parlimen_bil', 'Parlimen', 'callback_pilih_check');
                $this->form_validation->set_rules('input_nama_penuh', 'Nama Calon', 'required');
                $this->form_validation->set_rules('input_parti_bil', 'Parti', 'callback_pilih_check');
                $this->form_validation->set_rules('input_jawatan_parti', 'Jawatan Parti', 'required');
                $this->form_validation->set_rules('input_kategori_umur', 'Kategori Umur', 'callback_pilih_check');
                $this->form_validation->set_message('required', 'Sila penuhi maklumat di ruangan {field}');
                $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
                if($this->form_validation->run() === FALSE){
                    $this->daftar();
                }else{
                    $data_calon = $this->winnable_candidate_parlimen_model->daftar();
                    $this->proses_gambar($data_calon['last_id']);
                }
                break;
            case 'PPD' :
                $this->load->library('form_validation');
                $this->load->model('winnable_candidate_parlimen_model');
                $this->form_validation->set_rules('input_parlimen_bil', 'Parlimen', 'callback_pilih_check');
                $this->form_validation->set_rules('input_nama_penuh', 'Nama Calon', 'required');
                $this->form_validation->set_rules('input_parti_bil', 'Parti', 'callback_pilih_check');
                $this->form_validation->set_rules('input_jawatan_parti', 'Jawatan Parti', 'required');
                $this->form_validation->set_rules('input_kategori_umur', 'Kategori Umur', 'callback_pilih_check');
                $this->form_validation->set_message('required', 'Sila penuhi maklumat di ruangan {field}');
                $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
                if($this->form_validation->run() === FALSE){
                    $this->daftar();
                }else{
                    $data_calon = $this->winnable_candidate_parlimen_model->daftar();
                    $this->proses_gambar($data_calon['last_id']);
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function proses_gambar($calon_id)
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "PPD") !== FALSE)
		{
			$sesi = 'PPD';
		}elseif(strpos($sesi, "NEGERI") !== FALSE)
		{
			$sesi = 'NEGERI';
		}
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('winnable_candidate_parlimen_model');
                $this->load->model('foto_model');
                $this->load->model('parlimen_model');
                $data['calon'] = $this->winnable_candidate_parlimen_model->calon_id($calon_id);
                $data['data_foto'] = $this->foto_model;
                $data['data_parlimen'] = $this->parlimen_model;
                $data['header'] = 'negeri_na/susunletak/atas';
                $data['navbar'] = 'negeri_na/susunletak/navbar';
                $data['sidebar'] = 'negeri_na/susunletak/sidebar';
                $data['footer'] = 'negeri_na/susunletak/bawah';
                $this->load->view('sismap/jangkaanCalon/prosesDaftarParlimen', $data);
                break;
            case 'DATA' :
                $this->load->model('winnable_candidate_parlimen_model');
                $this->load->model('foto_model');
                $this->load->model('parlimen_model');
                $data['calon'] = $this->winnable_candidate_parlimen_model->calon_id($calon_id);
                $data['data_foto'] = $this->foto_model;
                $data['data_parlimen'] = $this->parlimen_model;
                $data['header'] = 'us_sismap_na/susunletak/atas';
                $data['navbar'] = 'us_sismap_na/susunletak/navbar';
                $data['sidebar'] = 'us_sismap_na/susunletak/sidebar';
                $data['footer'] = 'us_sismap_na/susunletak/bawah';
                $this->load->view('sismap/jangkaanCalon/prosesDaftarParlimen', $data);
                break;
            case 'PPD' :
                $this->load->model('winnable_candidate_parlimen_model');
                $this->load->model('foto_model');
                $this->load->model('parlimen_model');
                $data['calon'] = $this->winnable_candidate_parlimen_model->calon_id($calon_id);
                $data['data_foto'] = $this->foto_model;
                $data['data_parlimen'] = $this->parlimen_model;
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $this->load->view('sismap/jangkaanCalon/prosesDaftarParlimen', $data);
                break;
            default :
                redirect(base_url());
        }
    }


    public function daftar()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "PPD") !== FALSE)
		{
			$sesi = 'PPD';
		}elseif(strpos($sesi, "NEGERI") !== FALSE)
		{
			$sesi = 'NEGERI';
		}
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->library('form_validation');
        $this->load->model('parti_model');
        $this->load->model(['negeri_model', 'parlimen_model']);
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('pengguna_model');
        $data['senarai_parti'] = $this->parti_model->senarai_jenis("Parti Komponen");
        $data['data_parlimen'] = $this->parlimen_model;
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['data_assign'] = $this->winnable_candidate_assign_model;
        $data['data_parti'] = $this->parti_model;
        $data['senarai_kumpulan_jawatan'] = $this->parti_model->jawatan_kumpulan();
        switch($sesi){
            case 'NEGERI' :
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senarai_parlimen'] = $this->parlimen_model->senaraiParlimenNegeri($senaraiNegeri);
                $data['header'] = 'us_sismap_na/susunletak/atas';
                $data['navbar'] = 'us_sismap_na/susunletak/navbar';
                $data['sidebar'] = 'us_sismap_na/susunletak/sidebar';
                $data['footer'] = 'us_sismap_na/susunletak/bawah';
                $this->load->view('sismap/jangkaanCalon/tambahJangkaanCalon', $data);
                break;
            case 'DATA' :
                $data['senarai_parlimen'] = $this->parlimen_model->senaraiParlimen();
                $data['header'] = 'us_sismap_na/susunletak/atas';
                $data['navbar'] = 'us_sismap_na/susunletak/navbar';
                $data['sidebar'] = 'us_sismap_na/susunletak/sidebar';
                $data['footer'] = 'us_sismap_na/susunletak/bawah';
                $this->load->view('sismap/jangkaanCalon/tambahJangkaanCalon', $data);
                break;
            case 'PPD' :
                $data['senarai_parlimen'] = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $this->load->view('sismap/jangkaanCalon/tambahJangkaanCalon', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function senarai_negeri1()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $this->load->model('parlimen_model');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('winnable_candidate_parlimen_model');
        $this->load->model('pengguna_model');
        $this->load->model('foto_model');
        $pengguna = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));
        $assign = $this->winnable_candidate_assign_model->assign($pengguna->pengguna_peranan_bil);
        if(empty($assign)){
            $negeri = "";
            $senarai_parlimen = $this->parlimen_model->ikut_tugasan($pengguna->pengguna_peranan_bil);
        }else{
            $negeri = $assign->wcat_negeri;
            $senarai_parlimen = $this->parlimen_model->paparIkutNegeri($negeri);
        }
        $data['senarai_parlimen_negeri'] = $senarai_parlimen;
        $data['negeri'] = $negeri;
        $data['data_calon'] = $this->winnable_candidate_parlimen_model;
        $data['data_foto'] = $this->foto_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('winnable_candidate/senarai_negeri');
        $this->load->view('susunletak/bawah');
    }

    public function senarai_calon($parlimen_bil)
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $this->load->model('parlimen_model');
        $this->load->model('winnable_candidate_parlimen_model');
        $this->load->model('foto_model');
        $this->load->model('parti_model');
        $data['data_parti'] = $this->parti_model;
        $data['data_foto'] = $this->foto_model;
        $data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimen_bil);
        $data['senarai_calon'] = $this->winnable_candidate_parlimen_model->calon_parlimen($parlimen_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('winnable_candidate/senarai_wct');
        $this->load->view('susunletak/bawah');
    }

    public function kemaskini_parlimen($parlimen_bil)
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $this->load->library('form_validation');
        $this->load->model('parlimen_model');
        $this->load->model('winnable_candidate_parlimen_model');
        $this->load->model('foto_model');
        $this->load->model('parti_model');
        $data['senarai_parti'] = $this->parti_model->senarai();
        $data['data_foto'] = $this->foto_model;
        $data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimen_bil);
        $data['senarai_calon'] = $this->winnable_candidate_parlimen_model->calon_parlimen($parlimen_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('winnable_candidate/kemaskini_wct');
        $this->load->view('susunletak/bawah');
    }

    public function utama()
    {
        $this->load->model('winnable_candidate_assign_model');
										$this->load->model('pengguna_model');
										$this->load->model('japen_model');
										$this->load->model('winnable_candidate_parlimen_model');
										$this->load->model('parti_model');
										$this->load->model('parlimen_model');
										$data['data_parlimen'] = $this->parlimen_model;
										$data['pengguna'] = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));
										$data['data_wc_model'] = $this->winnable_candidate_assign_model;
										$data['data_japen'] = $this->japen_model;
										$data['data_wcp'] = $this->winnable_candidate_parlimen_model;
										$data['data_parti'] = $this->parti_model;
										$this->load->view('susunletak/atas', $data);
										$this->load->view('winnable_candidate/utama');
										$this->load->view('winnable_candidate/stat_negeri');
										$this->load->view('susunletak/bawah');
    }

    public function proses_kemaskini()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $tmp_wct_bil = $this->input->post('input_wct_bil');
        if(empty($tmp_wct_bil)){
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->load->model('winnable_candidate_parlimen_model');
        $this->form_validation->set_rules('input_nama_penuh', 'Nama Calon', 'required');
        $this->form_validation->set_rules('input_parti_bil', 'Parti', 'callback_pilih_check');
        $this->form_validation->set_rules('input_kategori_umur', 'Kategori Umur', 'callback_pilih_check');
        $this->form_validation->set_message('required', 'Sila penuhi maklumat di ruangan {field}');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        if($this->form_validation->run() === FALSE){
            $this->kemaskini_parlimen($this->input->post('input_parlimen_bil'));
        }else{
            $this->winnable_candidate_parlimen_model->kemaskini_calon();
            $this->kemaskini_parlimen($this->input->post('input_parlimen_bil'));
        }
    }

    public function verify_padam($wct_bil)
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        if(empty($wct_bil)){
            redirect(base_url());
        }
        $this->load->model('winnable_candidate_parlimen_model');
        $this->load->model('parlimen_model');
        $this->load->model('parti_model');
        $data['calon'] = $this->winnable_candidate_parlimen_model->calon_id($wct_bil);
        $data['data_parlimen'] = $this->parlimen_model;
        $data['data_parti'] = $this->parti_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('winnable_candidate/verify_padam');
        $this->load->view('susunletak/bawah');
    }

    public function padam()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $tmp_wct_bil = $this->input->post('input_wct_bil');
        $tmp_foto_bil = $this->input->post('input_foto_bil');
        $tmp_parlimen_bil = $this->input->post('input_parlimen_bil');
        if(empty($tmp_wct_bil) && empty($tmp_foto_bil) && empty($tmp_parlimen_bil))
        {
            redirect(base_url());
        }
        $this->load->model('winnable_candidate_parlimen_model');
        $this->load->model('foto_model');
        $nama_foto = $this->foto_model->foto($this->input->post('input_foto_bil'));
        $this->winnable_candidate_parlimen_model->padam_calon();
        if($this->input->post('input_foto_bil') != '5'){
            $this->foto_model->padam($this->input->post('input_foto_bil'));
            unlink('./assets/img/'.$nama_foto->foto_nama);
        }
        redirect('winnable_candidate/kemaskini_parlimen/'.$this->input->post('input_parlimen_bil'), 'refresh');
    }

    public function tambahan($wct_bil){
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $this->load->model('winnable_candidate_parlimen_model');
        $data['calon'] = $this->winnable_candidate_parlimen_model->calon_id($wct_bil);
        if(empty($wct_bil) && empty($data['calon'])){
            redirect(base_url());
        }
        $this->load->model('parlimen_model');
        $this->load->model('foto_model');
        $this->load->model('parti_model');
        $this->load->model('pengguna_model');
        $data['data_pengguna'] = $this->pengguna_model;
        $data['data_parlimen'] = $this->parlimen_model;
        $data['data_foto'] = $this->foto_model;
        $data['data_parti'] = $this->parti_model;
        $data['kekuatan_calon'] = $this->winnable_candidate_parlimen_model->kekuatan_calon($wct_bil, 'Kekuatan Calon');
        $data['kelemahan_calon'] = $this->winnable_candidate_parlimen_model->kekuatan_calon($wct_bil, 'Kelemahan Calon');
        $this->load->view('susunletak/atas', $data);
        $this->load->view('winnable_candidate/tambahan');
        $this->load->view('susunletak/bawah');
    }

    public function kuat_lemah()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(empty($sesi)){
            redirect(base_url());
        }
        if(strpos($sesi, "PPD") !== FALSE)
		{
			$sesi = 'PPD';
		}
        if(strpos($sesi, "NEGERI") !== FALSE)
		{
			$sesi = 'NEGERI';
		}
        $this->load->library('form_validation');
        $this->load->model('winnable_candidate_parlimen_model');
        $this->form_validation->set_rules('input_kekuatan', 'Kekuatan/Kelemahan Calon', 'required');
        $this->form_validation->set_message('required', 'Sila penuhi maklumat di ruangan {field}');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $calonBil = $this->input->post('input_calon');
        if($this->form_validation->run() === FALSE){
            redirect('winnable_candidate/bil/'.$calonBil);
        }else{
            $this->winnable_candidate_parlimen_model->tambahan_calon();
            redirect('winnable_candidate/bil/'.$calonBil);
        }
    }

    public function padam_kuat_lemah()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $this->load->library('form_validation');
        $this->load->model('winnable_candidate_parlimen_model');
        $this->form_validation->set_rules('input_wctm_bil', 'Nombor ID Calon', 'required');
        $this->form_validation->set_rules('input_pengguna_bil', 'Pengguna ID', 'required');
        $this->form_validation->set_message('required', 'Wajib ada {field}');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        if($this->form_validation->run() === FALSE){
            $this->tambahan($this->input->post('input_calon'));
        }else{
            $this->winnable_candidate_parlimen_model->padam_kuat_lemah();
            redirect('winnable_candidate/tambahan/'.$this->input->post('input_calon'), 'refresh');
        }
    }

    //TOPONE

    public function maklumat_penuh()
    {
        echo "MAKLUMAT PENUH";
    }

    public function maklumat_negeri($slug_negeri)
    {
        if(empty($slug_negeri)){
            redirect(base_url());
        }else{
            $negeri = "";
            switch($slug_negeri){
                case url_title("Johor") : $negeri = "Johor"; break;
                case url_title("Kedah") : $negeri = "Kedah"; break;
                case url_title("Kelantan") : $negeri = "Kelantan"; break;
                case url_title("Melaka") : $negeri = "Melaka"; break;
                case url_title("Pahang") : $negeri = "Pahang"; break;
                case url_title("Perak") : $negeri = "Perak"; break;
                case url_title("Perlis") : $negeri = "Perlis"; break;
                case url_title("Pulau Pinang") : $negeri = "Pulau Pinang"; break;
                case url_title("Sabah") : $negeri = "Sabah"; break;
                case url_title("Sarawak") : $negeri = "Sarawak"; break;
                case url_title("Selangor") : $negeri = "Selangor"; break;
                case url_title("Negeri Sembilan") : $negeri = "Negeri Sembilan"; break;
                case url_title("Terengganu") : $negeri = "Terengganu"; break;
                case url_title("Wilayah Persekutuan Kuala Lumpur") : $negeri = "Wilayah Persekutuan Kuala Lumpur"; break;
                case url_title("Wilayah Persekutuan Putrajaya") : $negeri = "Wilayah Persekutuan Putrajaya"; break;
                case url_title("Wilayah Persekutuan Labuan") : $negeri = "Wilayah Persekutuan Labuan"; break;
            }
        }
        $tmp_peranan = strtoupper($this->session->userdata('peranan'));
        if($tmp_peranan != "TOPONE"){
            redirect(base_url());
        }
        $data['negeri'] = $negeri;
        $this->load->model('parlimen_model');
        $data['senarai_parlimen'] = $this->parlimen_model->paparIkutNegeri($negeri);
        $data['data_parlimen'] = $this->parlimen_model;
        $this->load->model('winnable_candidate_parlimen_model');
        $data['data_wc'] = $this->winnable_candidate_parlimen_model;
        $this->load->model('foto_model');
        $data['data_foto'] = $this->foto_model;
        $this->load->model('parti_model');
        $data['data_parti'] = $this->parti_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('topone/negeri');
        $this->load->view('susunletak/bawah');
    }

    public function maklumat_parlimen($parlimen_bil)
    {
        if(empty($parlimen_bil)){
            redirect(base_url());
        }
        $tmp_peranan = strtoupper($this->session->userdata('peranan'));
        if($tmp_peranan != "TOPONE"){
            redirect(base_url());
        }
        $this->load->model('winnable_candidate_parlimen_model');
        $data['senarai_calon'] = $this->winnable_candidate_parlimen_model->calon_parlimen($parlimen_bil);
        $data['data_kuat_lemah'] = $this->winnable_candidate_parlimen_model;
        $this->load->model('foto_model');
        $data['data_foto'] = $this->foto_model;
        $this->load->model('parlimen_model');
        $data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimen_bil);
        $this->load->model('parti_model');
        $data['data_parti'] = $this->parti_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('topone/parlimen');
        $this->load->view('susunletak/bawah');
    }

    public function maklumat_parti($parti_bil)
    {
        if(empty($parti_bil)){
            redirect(base_url());
        }
        $tmp_peranan = strtoupper($this->session->userdata('peranan'));
        if($tmp_peranan != "TOPONE"){
            redirect(base_url());
        }
        $this->load->model('parti_model');
        $data['parti'] = $this->parti_model->parti($parti_bil);
        $this->load->model('parlimen_model');
        $data['senarai_parlimen'] = $this->parlimen_model->senarai();
        $this->load->model('winnable_candidate_parlimen_model');
        $data['data_wc'] = $this->winnable_candidate_parlimen_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('topone/parti');
        $this->load->view('susunletak/bawah');
    }

    

}