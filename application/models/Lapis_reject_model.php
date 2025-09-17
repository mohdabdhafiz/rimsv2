<?php
class Lapis_reject_model extends CI_Model
{
    protected $tableName = 'lapis_reject_tb';

    public function bilanganLaporanDiTolak(){
        $this->update20250612();
        $this->db->select('COUNT(lapis_reject_bil) AS bilangan');
        $this->db->select('lapis_reject_kluster_bil AS klusterBil');
        $this->db->group_by('lapis_reject_kluster_bil');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function update20250612(){
        $this->binaTable();
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'lapis_reject_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'lapis_reject_kluster_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE
                ),
                'lapis_reject_kluster_nama' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                "lapis_reject_tarikh_laporan_bil" => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                "lapis_reject_tarikh_laporan_dibina" => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                ),
                'lapis_reject_tarikh_laporan' => array(
                    'type' => 'DATE',
                    'null' => TRUE
                ),
                'lapis_reject_pelapor_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                "lapis_reject_pelapor_nama" => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                "lapis_reject_negeri_bil" => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                "lapis_reject_negeri_nama" => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                "lapis_reject_daerah_bil" => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                "lapis_reject_daerah_nama" => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                "lapis_reject_parlimen_bil" => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                "lapis_reject_parlimen_nama" => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                "lapis_reject_dun_bil" => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                "lapis_reject_dun_nama" => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                "lapis_reject_dm_bil" => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                "lapis_reject_dm_nama" => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                "lapis_reject_jenis_kawasan" => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                "lapis_reject_tajuk_isu" => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                "lapis_reject_ringkasan_isu" => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                "lapis_reject_lokasi" => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                "lapis_reject_latitude" => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                "lapis_reject_longitude" => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                "lapis_reject_cadangan_intervensi" => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'lapis_reject_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('lapis_reject_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }

}