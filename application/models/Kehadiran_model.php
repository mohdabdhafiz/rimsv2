<?php
class Kehadiran_model extends CI_Model
{
    protected $table = 'kehadiran_tb';

    public function hadir()
    {
        $data = array(
            'kt_no_ic' => $this->input->post('input_no_ic'),
            'kt_waktu_hadir' => $this->input->post('input_waktu_hadir'),
            'kt_pengguna_bil' => $this->input->post('input_pengguna_bil'),
            'kt_parlimen' => $this->input->post('input_parlimen'),
            'kt_dun' => $this->input->post('input_dun'),
            'kt_daerah_mengundi' => $this->input->post('input_daerah_mengundi'),
            'kt_pusat_mengundi' => $this->input->post('input_pusat_mengundi')
        );
        $this->db->insert($this->table, $data);
    }

    public function senarai($table_name)
    {
        $this->db->select($table_name.'.ic');
        $this->db->join($this->table, $table_name.'.ic = kehadiran_tb.kt_no_ic');
        $this->db->group_by($table_name.'.ic');
        $query = $this->db->get($table_name);
        return $query->result();
    }

    public function semak($ic)
    {
        $this->db->where('kt_no_ic', $ic);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}
?>