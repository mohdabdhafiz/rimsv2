<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kapar_kadun_model extends CI_Model {

    protected $table = 'kapar_kadun_tb';

    public function senarai()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function dun($dun_bil)
    {
        $this->db->where('kkt_dun_nama');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function daftar()
    {
        $data = array(
            "kkt_parlimen_bil" => $this->input->post('input_parlimen_bil'),
            "kkt_dun_bil" => $this->input->post('input_dun_bil'),
            "kkt_dun_nama" => $this->input->post('input_dun_nama'),
            "kkt_pengguna_bil" => $this->input->post('input_pengguna_bil'),
            "kkt_waktu" => $this->input->post('input_pengguna_waktu')
        );
        return $this->db->insert($this->table, $data);
    }

}