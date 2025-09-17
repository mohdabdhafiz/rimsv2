public function dun_proses_set()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_peranan_bil', 'Akaun PPD', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila penuhi ruangan {field}');
        $dun_bil = $this->input->post('input_dun_bil');
        if($this->form_validation->run() === FALSE){
            $this->dun_set($dun_bil);
        }else{
            $this->load->model('dun_model');
            $sudah_ada = $this->dun_model->tugas_dun($dun_bil);
            if(empty($sudah_ada)){
                $this->dun_model->tambah_tugas_dun();
                redirect('konfigurasi/dun_set/'.$dun_bil, 'refresh');
            }else{
                $this->dun_model->kemaskini_tugas_dun($sudah_ada->bil);
                redirect('konfigurasi/dun_set/'.$dun_bil, 'refresh');
            }
        }
    }

    public function dun_set($dun_bil)
    {
        if(empty($dun_bil)){
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->load->model('dun_model');
        $this->load->model('peranan_model');
        $data['senarai_peranan'] = $this->peranan_model->senarai_peranan_ppd();
        $data['data_dun'] = $this->dun_model;
        $data['dun'] = $this->dun_model->dun($dun_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/dun_set');
        $this->load->view('susunletak/bawah');
    }

    public function tugas_dun()
    {
        $peranan_bil = $this->session->userdata('peranan_bil');
        if(empty($peranan_bil)){
            redirect(base_url());
        }
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('dun_model');
        $this->load->model('negeri_model');
        $data['data_dun'] = $this->dun_model;
        $negeri_peranan = $this->winnable_candidate_assign_model->assign($peranan_bil);
        $negeri = $this->negeri_model->negeri_nama($negeri_peranan->wcat_negeri);
        $data['senarai_dun'] = $this->dun_model->dun_negeri($negeri->nt_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/tugas_dun_senarai');
        $this->load->view('susunletak/bawah');
    }

    public function dun_proses_padam()
    {
        $dun_bil = $this->input->post('input_bil');
        if(empty($dun_bil)){
            redirect(base_url());
        }
        $this->load->model('dun_model');
        $this->dun_model->padam();
        redirect('konfigurasi/dun');
    }

    public function padam_dun($dun_bil)
    {   
        if(empty($dun_bil)){
            redirect(base_url());
        }
        $this->load->model('dun_model');
        $this->load->model('negeri_model');
        $data['data_negeri'] = $this->negeri_model;
        $data['dun'] = $this->dun_model->dun($dun_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/dun_verify_padam');
        $this->load->view('susunletak/bawah');
    }

    public function index()
    {
        $this->load->view('susunletak/atas');
        $this->load->view('negeri/konfigurasi/utama');
        $this->load->view('susunletak/bawah');
    }

    public function dun_bil($dun_bil)
    {
        if(empty($dun_bil)){
            redirect(base_url());
        }
        $this->load->model('dun_model');
        $this->load->model('negeri_model');
        $data['data_dun'] = $this->dun_model;
        $data['data_negeri'] = $this->negeri_model;
        $data['dun'] = $this->dun_model->dun($dun_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/dun_bil');
        $this->load->view('susunletak/bawah');
    }

    public function proses_tambah_dun()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_nama', 'Nama dun', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila penuhi ruangan {field}');
        if($this->form_validation->run() === FALSE)
        {
            $this->tambah_dun();
        }else{
            $this->load->model('dun_model');
            $dun_baru = $this->dun_model->tambah();
            redirect('konfigurasi/dun_bil/'.$dun_baru['last_id']);
        }
    }

    public function tambah_dun()
    {
        $peranan_bil = $this->session->userdata('peranan_bil');
        if(empty($peranan_bil)){
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('negeri_model');
        $negeri_peranan = $this->winnable_candidate_assign_model->assign($peranan_bil);
        $data['negeri'] = $this->negeri_model->negeri_nama($negeri_peranan->wcat_negeri);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/tambah_dun');
        $this->load->view('susunletak/bawah');
    }

    public function dun()
    {
        $peranan_bil = $this->session->userdata('peranan_bil');
        if(empty($peranan_bil)){
            redirect(base_url());
        }
        $this->load->model('dun_model');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('negeri_model');
        $negeri_peranan = $this->winnable_candidate_assign_model->assign($peranan_bil);
        $negeri = $this->negeri_model->negeri_nama($negeri_peranan->wcat_negeri);
        $data['senarai_dun'] = $this->dun_model->dun_negeri($negeri->nt_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/dun');
        $this->load->view('susunletak/bawah');
    }