<?php
class Calib_model extends CI_Model {
    public function calib_sarawak()
    {
        $query = $this->db->get('test');
        return $query->result();
    }
}
?>