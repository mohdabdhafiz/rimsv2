<?php 
class Ppkpm extends CI_Controller
{

    public function pelaksanaanProgram(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'TOPPROGRAM' :
                $this->load->model('peranan_model');
                $this->load->model('program_model');
                $this->load->model('negeri_model');
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $tahun = date('Y');
                $data['senaraiProgram'] = $this->program_model->senaraiProgramNegeriLaksana($data['senaraiNegeri'], $tahun);
                $this->load->view('ppkpm_na/program/pelaksanaanProgram', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function perancanganProgram(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'TOPPROGRAM' :
                $this->load->model('peranan_model');
                $this->load->model('program_model');
                $this->load->model('negeri_model');
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $tahun = date('Y');
                $data['senaraiProgram'] = $this->program_model->senaraiProgramNegeriRancang($data['senaraiNegeri'], $tahun);
                $this->load->view('ppkpm_na/program/perancanganProgram', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function maklumat($ppnBil){
        if(empty($ppnBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'URUSETIA' :
                $this->load->model('ppn_model');
                $data['ppn'] = $this->ppn_model->ppn($ppnBil);
                if(empty($data['ppn'])){
                    redirect(base_url());
                }
                $this->load->view('urusetia_na/ppn/maklumat', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function prosesDaftar(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        switch($sesi){
            case 'URUSETIA' :
                $this->load->model('ppn_model');
                $this->load->model('pengguna_model');
                $this->load->model('peranan_model');
                $this->load->model('japen_model');
                $penggunaIc = $this->input->post('input_no_ic');
                $noTel = $this->input->post('input_no_tel');
                $sudahDaftar = $this->pengguna_model->semakan($penggunaIc, $noTel);
                if(empty($sudahDaftar)){
                    $perananBil = $this->input->post('inputPeranan');
                    if(empty($perananBil)){
                        redirect(base_url());
                    }
                    $japenBil = $this->input->post('inputJapen');
                    if(empty($japenBil)){
                        redirect(base_url());
                    }
                    $ada = $this->japen_model->semakOrganisasiPejabat($perananBil, $japenBil);
                    if(empty($ada)){
                        $this->japen_model->tambahOrganisasi($japenBil, $perananBil, $penggunaBil);
                    }
                    $peranan = $this->peranan_model->peranan($perananBil);
                    $japen = $this->japen_model->japen($japenBil);
                    if(!empty($peranan) && !empty($japen)){
                        $entri = $this->pengguna_model->daftarPpn($peranan->peranan_bil, $peranan->peranan_nama, $japen->jt_pejabat);
                        if(!empty($entri)){
                            $adaPpn = $this->ppn_model->adaPpn($perananBil);
                            if(empty($adaPpn) || $adaPpn->ppn_tarikh_tamat != NULL){
                                $ppnBil = $this->ppn_model->setPpn($entri, $perananBil, $penggunaBil);
                                redirect('ppn/maklumat/'.$ppnBil); 
                            }                            
                        }
                    }
                    redirect(base_url());
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function daftarPpn(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'URUSETIA' :
                $this->load->model('peranan_model');
                $this->load->model('japen_model');
                $data['senaraiKodPeranan'] = $this->peranan_model->kodPerananPpn();
                $data['senaraiJapen'] = $this->japen_model->japenPpn();
                $this->load->view('urusetia_na/ppn/daftarPengguna', $data);
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
        switch($sesi){
            case 'URUSETIA' :
                $this->load->model('ppn_model');
                $data['senaraiPengarah'] = $this->ppn_model->senaraiTerkini();
                $this->load->view('urusetia_na/ppn/utama', $data);
                break;
            default :
                redirect(base_url());
        }
    }

}
?>