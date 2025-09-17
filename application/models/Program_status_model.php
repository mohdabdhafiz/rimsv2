<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_status_model extends CI_Model {
    //1. TABLE NAME
    private $tableName = "status_program";
    //2. UPDATES
    public function update20231128(){
        $this->binaTable();
    }
    //3. CREATE TABLE
    private function binaTable()
    {
        //3.1 CHECK IF TABLE EXISTS
        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'status_program_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'status_program_program' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'status_program_status' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                ),
                'status_program_deskripsi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'status_program_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'status_program_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('status_program_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }
    //4. VIEW
        //4.1 VIEW MANY
        public function senaraiStatusIkutProgram($programBil){
            //4.1.1 JOIN PENGGUNA
            $this->db->join('pengguna_tb', 'pengguna_tb.bil = status_program.status_program_pengguna', 'left');
            $this->db->where('status_program_program', $programBil);
            $this->db->order_by('status_program_pengguna_waktu', 'DESC');
            $this->db->order_by('status_program_bil', 'DESC');
            $query = $this->db->get($this->tableName);
            return $query->result();
        }
        //4.1 VIEW ONE
        public function statusSemasa($programBil){
            $this->db->where('status_program_program', $programBil);
            $this->db->order_by('status_program_pengguna_waktu', 'DESC');
            $query = $this->db->get($this->tableName);
            return $query->row();
        }
    //5. ADD
        //5.1 ADD NEW ACTIVITY ON REPORTS USING PENGGUNA, PROGRAM, STATUS, STATUS DESKRIPSI
        public function tambahLog($penggunaBil, $programBil, $status, $statusDeskripsi){
            //5.1.1 COLLECT DATA
            $data = array(
                'status_program_pengguna' => $penggunaBil,
                'status_program_program' => $programBil,
                'status_program_status' => $status,
                'status_program_deskripsi' => $statusDeskripsi,
                'status_program_pengguna_waktu' => date('Y-m-d H:i:s')
            );
            //5.1.2 STORE DATA
            $return_data['insert_data'] = $this->db->insert($this->tableName, $data);
            $return_data['last_id'] = $this->db->insert_id();
            return $return_data;
        }
    //6. EDIT
    //7. DELETE
        //7.1. DELETE USING PROGRAM POST
        public function padamPost(){
            $this->db->where('status_program_program', $this->input->post('inputProgramBil'));
            $this->db->delete($this->tableName);
        }
}
?>