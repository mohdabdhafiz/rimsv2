<?php

class Dpi extends CI_Controller {

    public function prosesKaumDun(){

        //CHECK VALUES
        $dunBil = $this->input->post('inputDunBil');
        if(empty($dunBil)){
            redirect(base_url());
        }

        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));

        //LOAD MODEL
        $this->load->model('pdm_model');
        $this->load->model('dpi_model');

        //LOAD DATA
        $senaraiDaerahMengundi = $this->pdm_model->dun($dunBil);

        switch($sesi){
            case 'DATA' :

                //SETTING UP VALUES
                $penggunaBil = $this->input->post('inputPenggunaBil');
                $penggunaWaktu = $this->input->post('inputPenggunaWaktu');

                //GOING THROUGH DM
                $tempInputMelayu = $this->input->post('inputKaumMelayu');
                $tempInputCina = $this->input->post('inputKaumCina');
                $tempInputIndia = $this->input->post('inputKaumIndia');
                $tempInputBumiSabah = $this->input->post('inputKaumBumiSabah');
                $tempInputBumiSarawak = $this->input->post('inputKaumBumiSarawak');
                $tempInputOrangAsli = $this->input->post('inputKaumOrangAsli');
                $tempInputLain = $this->input->post('inputKaumLain');
                foreach($senaraiDaerahMengundi as $dm){
                    if(!empty($tempInputMelayu)){
                        $kaum = 'Melayu';
                        $this->dpi_model->kemaskiniDun($dm->pdt_bil, $kaum, $tempInputMelayu[$dm->pdt_bil], $penggunaBil, $penggunaWaktu);
                    }
                    if(!empty($tempInputCina)){
                        $kaum = 'Cina';
                        $this->dpi_model->kemaskiniDun($dm->pdt_bil, $kaum, $tempInputCina[$dm->pdt_bil], $penggunaBil, $penggunaWaktu);
                    }
                    if(!empty($tempInputIndia)){
                        $kaum = 'India';
                        $this->dpi_model->kemaskiniDun($dm->pdt_bil, $kaum, $tempInputIndia[$dm->pdt_bil], $penggunaBil, $penggunaWaktu);
                    }
                    if(!empty($tempInputBumiSabah)){
                        $kaum = 'Bumi Sabah';
                        $this->dpi_model->kemaskiniDun($dm->pdt_bil, $kaum, $tempInputBumiSabah[$dm->pdt_bil], $penggunaBil, $penggunaWaktu);
                    }
                    if(!empty($tempInputBumiSarawak)){
                        $kaum = 'Bumi Sarawak';
                        $this->dpi_model->kemaskiniDun($dm->pdt_bil, $kaum, $tempInputBumiSarawak[$dm->pdt_bil], $penggunaBil, $penggunaWaktu);
                    }
                    if(!empty($tempInputOrangAsli)){
                        $kaum = 'Orang Asli';
                        $this->dpi_model->kemaskiniDun($dm->pdt_bil, $kaum, $tempInputOrangAsli[$dm->pdt_bil], $penggunaBil, $penggunaWaktu);
                    }
                    if(!empty($tempInputLain)){
                        $kaum = 'Lain-lain';
                        $this->dpi_model->kemaskiniDun($dm->pdt_bil, $kaum, $tempInputLain[$dm->pdt_bil], $penggunaBil, $penggunaWaktu);
                    }
                }
                $this->kemaskiniKaumDun($dunBil);
                break;
            default :
                redirect(base_url());
        }
        
    }

    public function kemaskiniKaumDun($dunBil){

        //IDEA
        //1. Majoriti kaum adalah lebih 60% dalam jumlah pengundi mengikut kaum.
        //2. Pilihan Dato Sukari atas 50%
        $data['majoriti'] = 50;

        //CHECK VALUES
        if(empty($dunBil)){
            redirect(base_url());
        }

        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');
        $this->load->model('dun_model');
        $this->load->model('pdm_model');
        $this->load->model('dpi_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['dun'] = $this->dun_model->dun($dunBil);
        $data['senaraiDaerahMengundi'] = $this->pdm_model->dun($dunBil);
        $data['dataDpiKaum'] = $this->dpi_model;

        //CALIBRATION
        foreach($data['senaraiDaerahMengundi'] as $dm){
            $pilihKaum = 'Melayu';
            $dpiKaum = $this->dpi_model->dmKaumDun($dm->pdt_bil, $pilihKaum);
            if(empty($dpiKaum)){
                $this->dpi_model->tambahDun($dm->pdt_bil, $pilihKaum, 0, $penggunaBil, date("Y-m-d H:i:s"));
            }
            $pilihKaum = 'Cina';
            $dpiKaum = $this->dpi_model->dmKaumDun($dm->pdt_bil, $pilihKaum);
            if(empty($dpiKaum)){
                $this->dpi_model->tambahDun($dm->pdt_bil, $pilihKaum, 0, $penggunaBil, date("Y-m-d H:i:s"));
            }
            $pilihKaum = 'India';
            $dpiKaum = $this->dpi_model->dmKaumDun($dm->pdt_bil, $pilihKaum);
            if(empty($dpiKaum)){
                $this->dpi_model->tambahDun($dm->pdt_bil, $pilihKaum, 0, $penggunaBil, date("Y-m-d H:i:s"));
            }
            $pilihKaum = 'Bumi Sabah';
            $dpiKaum = $this->dpi_model->dmKaumDun($dm->pdt_bil, $pilihKaum);
            if(empty($dpiKaum)){
                $this->dpi_model->tambahDun($dm->pdt_bil, $pilihKaum, 0, $penggunaBil, date("Y-m-d H:i:s"));
            }
            $pilihKaum = 'Bumi Sarawak';
            $dpiKaum = $this->dpi_model->dmKaumDun($dm->pdt_bil, $pilihKaum);
            if(empty($dpiKaum)){
                $this->dpi_model->tambahDun($dm->pdt_bil, $pilihKaum, 0, $penggunaBil, date("Y-m-d H:i:s"));
            }
            $pilihKaum = 'Orang Asli';
            $dpiKaum = $this->dpi_model->dmKaumDun($dm->pdt_bil, $pilihKaum);
            if(empty($dpiKaum)){
                $this->dpi_model->tambahDun($dm->pdt_bil, $pilihKaum, 0, $penggunaBil, date("Y-m-d H:i:s"));
            }
            $pilihKaum = 'Lain-lain';
            $dpiKaum = $this->dpi_model->dmKaumDun($dm->pdt_bil, $pilihKaum);
            if(empty($dpiKaum)){
                $this->dpi_model->tambahDun($dm->pdt_bil, $pilihKaum, 0, $penggunaBil, date("Y-m-d H:i:s"));
            }
        }

        switch($sesi){
            case 'DATA' :
                $this->load->view('us_sismap_na/dpi/kemaskiniKaumDun', $data);
                break;
            default :
                redirect(base_url());
        }
        
    }

    public function senaraiKaumNegeri($negeriBil){

        //CHECK VALUE
        if(empty($negeriBil)){
            redirect(base_url());
        }

        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');
        $this->load->model('negeri_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['negeri'] = $this->negeri_model->negeri($negeriBil);
        $data['senaraiParlimen'] = $this->parlimen_model->paparIkutNegeri($data['negeri']->nt_nama);
        $data['bilanganParlimen'] = count($data['senaraiParlimen']);
        $data['senaraiDun'] = $this->dun_model->ikut_negeri($data['negeri']->nt_nama);
        $data['bilanganDun'] = count($data['senaraiDun']);

        switch($sesi){
            case 'DATA' :
                $this->load->view('us_sismap_na/dpi/senaraiIkutNegeri', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function senaraiKaum(){
        
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');
        $this->load->model('negeri_model');
        $this->load->model('dpi_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['senaraiNegeri'] = $this->negeri_model->senarai();

        switch($sesi){
            case 'DATA' :
                $this->load->view('us_sismap_na/dpi/senaraiKaumNegeri', $data);
                break;
            default :
                redirect(base_url());
        }

    }

}

?>