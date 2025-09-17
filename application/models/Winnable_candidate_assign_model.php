<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Winnable_candidate_assign_model extends CI_Model {

    protected $table = 'winnable_candidate_assign_tb';

    public function daftar()
    {
        $data = array(
            "wcat_peranan_bil" => $this->input->post('input_peranan_bil'),
            "wcat_jabatan_bil" => $this->input->post('input_jabatan_bil'),
            "wcat_negeri" => $this->input->post('input_negeri')
        );
        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function assign($peranan_bil)
    {
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = winnable_candidate_assign_tb.wcat_negeri', 'left');
        $this->db->where('wcat_peranan_bil', $peranan_bil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

}