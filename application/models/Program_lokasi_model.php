<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_lokasi_model extends CI_Model {

    private $tableName = 'lokasi_program';

    //NOTES.
    //1. Latitude is a measurement on a globe or map of location north or south of the Equator. Technically, there are different kinds of latitude, which are geocentric, astronomical, and geographic (or geodetic), but there are only minor differences between them. Vertical.
    //2. Longitude is a measurement of location east or west of the prime meridian at Greenwich, London, England, the specially designated imaginary north-south line that passes through both geographic poles and Greenwich. Longitude is measured 180° both east and west of the prime meridian. Horizontal.
    
    //1. UPDATES. NOTE. PLEASE MAKE THIS ON TOP FOR FUTURE.
    public function update20231121(){
        $this->binaTable();
    }

    //2. DELETE VALUE
        //2.1 DELETE USING PROGRAM, LOKASI VALUE
        public function padamLokasi($programBil, $lokasiBil){
            $this->db->where('lokasi_program_program', $programBil);
            $this->db->where('lokasi_program_bil', $lokasiBil);
            $this->db->delete($this->tableName);
        }
        //2.2 DELETE USING PROGRAM POST
        public function padamPost(){
            $this->db->where('lokasi_program_program', $this->input->post('inputProgramBil'));
            $this->db->delete($this->tableName);
        }

    //3. ADD VALUES
    public function tambahPost(){
        $data = array(
            'lokasi_program_program' => $this->input->post('inputProgramBil'),
            'lokasi_program_lokasi' => $this->input->post('inputLokasi'),
            'lokasi_program_latitude' => $this->input->post('inputLatitude'),
            'lokasi_program_longitude' => $this->input->post('inputLongitude'),
            'lokasi_program_pengguna' => $this->input->post('inputPenggunaBil'),
            'lokasi_program_pengguna_waktu' => date("Y-m-d H:i:s")
        );
        $return_data['insert_data'] = $this->db->insert($this->tableName, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    //4. SHOW TABLE
    public function senaraiLokasi($programBil){
        $this->db->where('lokasi_program_program', $programBil);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }


    //5. CREATE TABLE
    public function binaTable(){

        //5.1LOAD LIBRARIES
        $this->load->dbforge();

    if($this->db->table_exists($this->tableName) == FALSE)
    {
        $fields = array(
            'lokasi_program_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => FALSE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'lokasi_program_program' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => FALSE
            ),
            'lokasi_program_lokasi' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'lokasi_program_latitude' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'lokasi_program_longitude' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'lokasi_program_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'lokasi_program_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('lokasi_program_bil', TRUE);
        $this->dbforge->create_table($this->tableName);
    }
    }

}

?>