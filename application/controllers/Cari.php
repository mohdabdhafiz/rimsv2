<?php 
class Cari extends CI_Controller
{
    public function proses()
    {
        $log = $this->session->userdata('peranan');
        if($log != 'a'){
            redirect(base_url());
        }
        $this->load->model('pengundi_model');
        $tmp_ic = $this->input->post('input_carian_ic');
        if(empty($tmp_ic)){
            redirect(base_url(), 'refresh');
        }
        $data['pengundi'] = $this->pengundi_model->papar('bekok', $this->input->post('input_carian_ic'));
        if(empty($data['pengundi'])){
            redirect(base_url(), 'refresh');
        }
        $this->load->view('atas', $data);
        $this->load->view('carian');
        $this->load->view('bawah');
    }
}
?>