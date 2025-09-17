<?php
class Pengundi_putih_model extends CI_Model{

    protected $table = 'pengundi_putih_tb';

    public function senarai()
    {
        $this->db->order_by('ppt_pengguna_waktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function pengundi()
    {
        $this->db->join('kehadiran_tb', 'kehadiran_tb.kt_no_ic = pengundi_putih_tb.ppt_no_ic');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function tambah()
    {
        $data = array(
            'ppt_nama_penuh' => $this->input->post('input_nama'),
            'ppt_no_ic' => $this->input->post('input_no_ic'),
            'ppt_no_tel' => $this->input->post('input_no_tel'),
            'ppt_alamat' => $this->input->post('input_alamat'),
            'ppt_pengguna_bil' => $this->input->post('input_pengguna_bil'),
            'ppt_pengguna_waktu' => $this->input->post('input_pengguna_waktu')
        );
        return $this->db->insert($this->table, $data);
    }
}
?>