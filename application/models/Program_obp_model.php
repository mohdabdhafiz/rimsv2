<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_obp_model extends CI_Model {

    private $tableName = 'program_obp';

    //UDPATES
    public function update20231121(){
        $this->binaTable();
    }

    //DELETE VALUES
    //1. DELETE OBP USING PROGRAM VALUES
    public function resetSenaraiObp($programBil){
        $this->db->where('obp_program_program', $programBil);
        $this->db->delete($this->tableName);
    }
    //2. DELETE OBP USING PROGRAM POST
    public function padamPost(){
        $this->db->where('obp_program_program', $this->input->post('inputProgramBil'));
        $this->db->delete($this->tableName);
    }

    //ADD VALUES
    public function tambahObp($programBil, $nama, $jawatan, $obpBil, $penggunaBil){
        $data = array(
            'obp_program_program' => $programBil,
            'obp_program_obp' => $obpBil,
            'obp_program_jawatan' => $jawatan,
            'obp_program_nama' => $nama,
            'obp_program_pengguna' => $penggunaBil,
            'obp_program_pengguna_waktu' => date("Y-m-d H:i:s")
        );
        $return_data['insert_data'] = $this->db->insert($this->tableName, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    //VIEW TABLE
    public function semak($programBil, $nama, $jawatan, $obpBil){
        $this->db->where('obp_program_obp', $obpBil);
        $this->db->where('obp_program_nama', $nama);
        $this->db->where('obp_program_jawatan', $jawatan);
        $this->db->where('obp_program_program', $programBil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function senaraiObp($programBil){
        $select = [
            "*",
            "UPPER(program_obp.obp_program_nama) AS obpNama"
        ];
        $this->db->select($select);
        $this->db->where('program_obp.obp_program_program', $programBil);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    //CREATE TABLE
    private function binaTable()
    {
        //LOAD LIBRARIES
        $this->load->dbforge();

        if($this->db->table_exists($this->tableName) == FALSE)
        {
        $fields = array(
            'obp_program_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => FALSE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'obp_program_program' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'obp_program_obp' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'obp_program_nama' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'obp_program_jawatan' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'obp_program_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'obp_program_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('obp_program_bil', TRUE);
        $this->dbforge->create_table($this->tableName);
    }
}

}
?>