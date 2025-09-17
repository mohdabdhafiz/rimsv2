<?php 
class Ppd extends CI_Controller
{

    public function prosesKemaskiniPpd(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        $this->load->model('ppd_model');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		$data['ppd'] = $this->ppd_model->ppd($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiAnggota'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
        switch($sesi){
            case 'PPD' :
                $penggunaBil = $this->input->post('inputPengguna');
                $perananBil = $this->input->post('inputPeranan');
                $ppd = $this->input->post('inputPpd');
                if(empty($ppd)){
                    redirect(base_url());
                }
                if(empty($penggunaBil)){
                    redirect(base_url());
                }
                $this->load->model('ppd_model');
                $adaPpd = $this->ppd_model->adaPpd($perananBil);
                if(empty($adaPpd)){
                    $entri = $this->ppd_model->setPpd($ppd, $perananBil, $penggunaBil);
                }else{
                    $entri = $this->ppd_model->tamatPerananPpd($adaPpd->p_bil);
                    $entri = $this->ppd_model->setPpd($ppd, $perananBil, $penggunaBil);
                }
                if($entri){
                    redirect('ppd/kemaskiniPegawai');
                }else{
                    die('Terdapat masalah. Hubungi urus setia');
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function kemaskiniPegawai(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        $this->load->model('ppd_model');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		$data['ppd'] = $this->ppd_model->ppd($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiAnggota'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
        $data['senaraiPpd'] = $this->ppd_model->senaraiPpd($data['pengguna']->pengguna_peranan_bil);
        switch($sesi){
            case 'PPD' :
                $this->load->view('ppd_na/pengguna/ppd/kemaskiniPpd', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function senarai(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'URUSETIA' :
                $this->load->model('peranan_model');
                $data['senaraiPpd'] = $this->peranan_model->senaraiPpd();
                $this->load->view('urusetia_na/peranan/senaraiPpd', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function setPegawai(){
        $penggunaBil = $this->input->post('inputPengguna');
        $perananBil = $this->input->post('inputPeranan');
        $ppd = $this->input->post('inputPpd');
        if(empty($ppd)){
            redirect(base_url());
        }
        if(empty($penggunaBil)){
            redirect(base_url());
        }
        $this->load->model('ppd_model');
        $adaPpd = $this->ppd_model->adaPpd($perananBil);
        if(empty($adaPpd)){
            $entri = $this->ppd_model->setPpd($ppd, $perananBil, $penggunaBil);
        }
        redirect(base_url());
    }

    public function setOrganisasi(){
        $penggunaBil = $this->input->post('inputPengguna');
        $perananBil = $this->input->post('inputPeranan');
        $organisasi = $this->input->post('inputOrganisasi');
        if(empty($penggunaBil)){
            redirect(base_url());
        }
        $this->load->model('japen_model');
        $ada = $this->japen_model->namaJapen($organisasi);
        if(empty($ada)){
            $entri = $this->japen_model->tambahPejabat($organisasi, $penggunaBil);
        }
        $ada = $this->japen_model->namaJapen($organisasi);
        $adaOrganisasi = $this->japen_model->semakOrganisasi($perananBil);
        if(empty($adaOrganisasi)){
            $entri = $this->japen_model->tambahOrganisasi($ada->jt_bil, $perananBil, $penggunaBil);
        }else{
            redirect(base_url());
        }
        redirect(base_url());
    }

    public function index()
    {
        redirect(base_url());
    }

    // KOMPONEN //

    public function nav(){
        $peranan_bil = $this->session->userdata('peranan_bil');
        if(empty($peranan_bil)){
            redirect(base_url());
        }
        $this->load->model('pengguna_model');
        $data['senarai_anggota_nav'] = $this->pengguna_model->senarai_pelapor($this->session->userdata('peranan_bil'));
        $this->load->view('ppd/komponen/nav', $data);
    }
}
?>