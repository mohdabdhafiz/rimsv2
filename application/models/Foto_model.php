<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foto_model extends CI_Model {

    protected $table = 'foto_tb';

	public function muatnaik()
	{
        $data = array(
            'nama' => $this->input->post('foto_nama'),
            'deskripsi' => $this->input->post('foto_deskripsi'),
            'waktu' => date ('Y-m-d H:i:s'),
            'pengguna_bil' => $this->input->post('pengguna_bil')          
        );

    return $this->db->insert($this->table, $data);
    }

    public function wct_ahli($nama, $deskripsi, $waktu, $pengguna_bil){
        $data = array(
            'foto_nama' => $nama,
            'foto_deskripsi' => $deskripsi,
            'foto_waktu' => $waktu,
            'foto_pengguna' => $pengguna_bil
        );
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function muatnaik_parti($nama_fail){
        $data = array(
            'foto_nama' => $nama_fail,
            'foto_deskripsi' => $this->input->post('foto_deskripsi'),
            'foto_waktu' => date ('Y-m-d H:i:s'),
            'foto_pengguna' => $this->input->post('pengguna_bil')          
        );
        $this->db->insert($this->table, $data);
    return $this->db->insert_id();
    }

    public function muatnaik_wct($nama_fail){
        $data = array(
            'foto_nama' => $nama_fail,
            'foto_deskripsi' => $this->input->post('input_foto_deskripsi'),
            'foto_waktu' => date ('Y-m-d H:i:s'),
            'foto_pengguna' => $this->input->post('input_pengguna_bil')          
        );
        $this->db->insert($this->table, $data);
    return $this->db->insert_id();
    }

    public function uploadGambarJdt($nama_fail, $fotoDeskripsi, $penggunaBil){
        $data = array(
            'foto_nama' => $nama_fail,
            'foto_deskripsi' => $fotoDeskripsi,
            'foto_waktu' => date ('Y-m-d H:i:s'),
            'foto_pengguna' => $penggunaBil          
        );
        $this->db->insert($this->table, $data);
    return $this->db->insert_id();
    }

    public function muatnaik_jdt($nama_fail){
        $data = array(
            'foto_nama' => $nama_fail,
            'foto_deskripsi' => $this->input->post('input_foto_deskripsi'),
            'foto_waktu' => date ('Y-m-d H:i:s'),
            'foto_pengguna' => $this->input->post('input_pengguna_bil')          
        );
        $this->db->insert($this->table, $data);
    return $this->db->insert_id();
    }

    public function kira_semua(){
        return $this->db->count_all($this->table);
    }
    
    public function lihat_semua($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar_semua(){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = foto_tb.foto_pengguna', 'left');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function padam($bil){
        $this->db->where('foto_bil', $bil);
        $this->db->delete($this->table);
    }

    public function foto($fotoBil)
    {
        $this->db->where('foto_bil', $fotoBil);
        $query = $this->db->get($this->table);
        return $query->row();
    }
}
