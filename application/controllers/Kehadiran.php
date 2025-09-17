<?php
class Kehadiran extends CI_Controller
{
    public function hadir()
    {
        $dun = $this->session->userdata('dun');
        $ada = TRUE;
        $this->load->model('kehadiran_model');
        if(count($this->kehadiran_model->semak($this->input->post('input_no_ic'))) == 0){
            $this->kehadiran_model->hadir();
            $ada = FALSE;
        }
        $this->load->model('pengundi_model');
		$this->load->model('pengundi_putih_model');
        $data['bilangan_pengundi'] = count($this->pengundi_model->senarai($dun));
        $data['bilangan_kehadiran'] = count($this->kehadiran_model->senarai($dun));
        $data['bilangan_kehadiran_putih'] = count($this->pengundi_putih_model->pengundi());
        $data['bilangan_pengundi_putih'] = count($this->pengundi_putih_model->senarai());
        $this->load->view('atas.php', $data);
        if(!$ada){
            $this->load->view('info_hadir');
        }else{
            $this->load->view('info_hadir_ada');
        }
        $this->load->view('utama.php');
        $this->load->view('bawah.php');
    }
}
?>