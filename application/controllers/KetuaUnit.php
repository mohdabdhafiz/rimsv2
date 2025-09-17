<?php 
class KetuaUnit extends CI_Controller
{

    public function kemaskini(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('peranan_model');
        $this->load->model('ketua_unit_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $data['senaraiKetuaUnit'] = $this->ketua_unit_model->senarai($data['pengguna']->pengguna_peranan_bil);
        switch($sesi){
            case 'NEGERI' :
                $data['organisasi'] = $this->peranan_model->organisasi($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiAnggota'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
                $data['ketuaUnit'] = $this->ketua_unit_model->ketuaUnit($data['pengguna']->pengguna_peranan_bil);
                $this->load->view('negeri_na/pengguna/ketuaUnit/kemaskini', $data);
                break;
            case 'PKPM' :
                $data['organisasi'] = $this->peranan_model->organisasi($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiAnggota'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
                $data['ketuaUnit'] = $this->ketua_unit_model->ketuaUnit($data['pengguna']->pengguna_peranan_bil);
                $this->load->view('us_program_negeri_na/pengguna/ketuaUnit/kemaskini', $data);
                break;
            case 'US_PROGRAM' :
                $data['organisasi'] = $this->peranan_model->organisasi($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiAnggota'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
                $data['ketuaUnit'] = $this->ketua_unit_model->ketuaUnit($data['pengguna']->pengguna_peranan_bil);
                $this->load->view('us_program_na/pengguna/ketuaUnit/kemaskini', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function prosesLantikan(){
        $penggunaBil = $this->input->post('inputPengguna');
        $perananBil = $this->input->post('inputPeranan');
        $ketuaUnit = $this->input->post('inputKetuaUnit');
        $gelaranJawatan = $this->input->post('inputGelaranJawatan');
        if(empty($ketuaUnit)){
            redirect(base_url());
        }
        if(empty($penggunaBil)){
            redirect(base_url());
        }
        $this->load->model('ketua_unit_model');
        $kosongkan = $this->ketua_unit_model->kosongkan($perananBil);
        $adaKetuaUnit = $this->ketua_unit_model->adaKetuaUnit($perananBil);
        if(empty($adaKetuaUnit)){
            $entri = $this->ketua_unit_model->setKetuaUnit($ketuaUnit, $perananBil, $penggunaBil, $gelaranJawatan);
        }else{
            if($adaKetuaUnit->ku_anggota != $ketuaUnit){
                $kemaskiniTamat = $this->ketua_unit_model->tamat($adaKetuaUnit->ku_bil);
                if($kemaskiniTamat){
                    $entri = $this->ketua_unit_model->setKetuaUnit($ketuaUnit, $perananBil, $penggunaBil, $gelaranJawatan);
                }else{
                    $kosongkan = $this->ketua_unit_model->kosongkan($perananBil);
                    $entri = $this->ketua_unit_model->setKetuaUnit($ketuaUnit, $perananBil, $penggunaBil, $gelaranJawatan);
                }
            }
        }
        redirect('ketuaUnit/kemaskini');
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