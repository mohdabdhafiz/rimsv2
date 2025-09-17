<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_pautan_model extends CI_Model {

    //1. TABLE NAME
    private $tableName = 'pautan_program';
    //2. UPDATES
    public function update20231127(){
        $this->binaTable();
    }
    //3. CREATE TABLE
    private function binaTable()
    {
        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'pautan_program_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'pautan_program_program' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'pautan_program_pautan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'pautan_program_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'pautan_program_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('pautan_program_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }
    //4. VIEW
        //4.1 VIEW MANY
        public function senaraiPautanIkutProgram($programBil){
            $this->db->where('pautan_program_program', $programBil);
            $this->db->order_by('pautan_program_pengguna_waktu', 'DESC');
            $query = $this->db->get($this->tableName);
            return $query->result();
        }
    //5. ADD
        //5.1 ADD NEW URL USING POST
        public function tambahPautan(){
            //5.1.1 COLLECT DATA
            $data = array(
                'pautan_program_program' => $this->input->post('inputProgramBil'),
                'pautan_program_pautan' => $this->input->post('inputUrl'),
                'pautan_program_pengguna' => $this->input->post('inputPenggunaBil'),
                'pautan_program_pengguna_waktu' => date("Y-m-d H:i:s")
            );
            //5.1.2 STORE DATA
            $return_data['insert_data'] = $this->db->insert($this->tableName, $data);
            $return_data['last_id'] = $this->db->insert_id();
            return $return_data;
        }
    //6. EDIT
        //6.1 EDIT URL USING POST
        public function kemaskiniPautan(){
            $data = array(
                'pautan_program_pautan' => $this->input->post('inputPautan'),
                'pautan_program_pengguna' => $this->input->post('inputPenggunaBil'),
                'pautan_program_pengguna_waktu' => date('Y-m-d H:i:s')
            );
            $this->db->where('pautan_program_program', $this->input->post('inputProgramBil'));
            $this->db->where('pautan_program_bil', $this->input->post('inputPautanBil'));
            $this->db->update($this->tableName, $data);
        }
    //7. DELETE
        //7.1 DELETE PAUTAN USING POST
        public function padamPautan(){
            $this->db->where('pautan_program_bil', $this->input->post('inputPautanBil'));
            $this->db->where('pautan_program_program', $this->input->post('inputProgramBil'));
            $this->db->delete($this->tableName);
        }
        //7.2 DELETE PAUTAN USING PROGRAM POST
        public function padamPost(){
            $this->db->where('pautan_program_program', $this->input->post('inputProgramBil'));
            $this->db->delete($this->tableName);
        }
}