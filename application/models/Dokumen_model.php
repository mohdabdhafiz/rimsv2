<?php
class Dokumen_model extends CI_Model {

    protected $table = "dokumen_sokongan_program_tb";

    public function senaraiDokumen($limit, $start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get('dokumen_sokongan_program_tb');
        return $query->result();
    }

    public function jumlahDokumen() {
        $this->checkTableExists();
        return $this->db->count_all('dokumen_sokongan_program_tb'); 
    }

    public function checkTableExists()
    {
        $this->load->dbforge();
        $namaTable = 'dokumen_sokongan_program_tb';
        
        if ($this->db->table_exists($namaTable) == FALSE) {
            $fields = array(
                'dspt_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE,
                    'auto_increment' => TRUE
                ),
                'dspt_nama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '250',
                    'null' => TRUE
                ),
                'dspt_tarikh_kemaskini' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                ),
                'dspt_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'dspt_pengguna_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                ),
                'dspt_deskripsi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'dspt_nama_fail' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '250',
                    'null' => TRUE
                ),
                'dspt_program' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                )
            );
            
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('dspt_bil', TRUE);
            $this->dbforge->create_table($namaTable, TRUE);
        }

        // Optimize table for better performance
        $this->db->query("OPTIMIZE TABLE `" . $namaTable . "`");
    }


}
?>