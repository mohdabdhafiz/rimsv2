<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengundi_model extends CI_Model {

    protected $table = 'pengundi_tb';

    public function pengundi($dun_bil, $pilihanraya_bil){
        $this->db->where('pengundi_dun', $dun_bil);
        $this->db->where('pengundi_pilihanraya', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

	public function cipta($dun_bil, $pilihanraya_bil, $pengundi_jumlah)
	{
        $data = array(
            'pengundi_dun' => $dun_bil,
            'pengundi_pilihanraya' => $pilihanraya_bil,
            'pengundi_jumlah' => $pengundi_jumlah, 
        );

        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
    return $return_data;
    }

    public function kira_semua(){
        return $this->db->count_all($this->table);
    }
    
    public function lihat_semua($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar_ikut_dun($dun_bil, $pilihanraya_bil){
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pengundi_tb.pengundi_pilihanraya', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pengundi_tb.pengundi_dun', 'left');
        $this->db->where('pengundi_tb.pengundi_dun', $dun_bil);
        $this->db->where('pengundi_tb.pengundi_pilihanraya', $pilihanraya_bil);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function padam($bil){
        $this->db->where('pengundi_bil', $bil);
        $this->db->delete($this->table);
    }

    public function set_pengundi($bil, $pengundi_jumlah){
        $data = array('pengundi_jumlah' => $pengundi_jumlah);
        $this->db->where('pengundi_bil', $bil);
        $this->db->update($this->table, $data);
    }

    public function semakAda($dun_bil, $pilihanraya_bil){
        $this->db->where('pengundi_dun', $dun_bil);
        $this->db->where('pengundi_pilihanraya', $pilihanraya_bil);
        $query = $this->db->get($this->table);

        return $query->result();
    }

}
