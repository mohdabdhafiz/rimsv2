<?php
class Pegawai_model extends CI_Model
{

    protected $pegawai = "pegawai_tb";

    //======================================================================
    // FUNGSI BARU DITAMBAH DI SINI
    //======================================================================

    /**
     * Mendapatkan satu baris data pegawai berdasarkan ID (bil).
     *
     * @param int $bil ID pegawai (pg_bil).
     * @return object Data pegawai.
     */
    public function satu_data($bil)
    {
        $this->db->where('pg_bil', $bil);
        $query = $this->db->get($this->pegawai);
        return $query->row();
    }

    /**
     * Mendapatkan senarai pegawai berdasarkan senarai ID (bil).
     *
     * @param array $senaraiBil Senarai ID pegawai (pg_bil).
     * @return array Senarai data pegawai.
     */
    public function senarai_data($senaraiBil)
    {
        if(empty($senaraiBil)){
            return [];
        }
        $this->db->where_in('pg_bil', $senaraiBil);
        $this->db->order_by('pg_nama', 'ASC');
        $query = $this->db->get($this->pegawai);
        return $query->result();
    }

    //======================================================================
    // FUNGSI SEDIA ADA ANDA
    //======================================================================

    public function senaraiTugasanPruAktif($pegawaiBil){
        $this->db->select('pg_bil, pg_nama, pg_jawatan, pg_bahagian, pg_ic, pg_telefon, pg_email, pg_peranan, pg_catatan, pg_dicipta_pada, pg_dicipta_oleh, pg_diubah_pada, pg_diubah_oleh, pengguna_bil, pru_bil, pru_nama, pru_singkatan, pilihanraya_jenis');
        $this->db->select('pilihanraya_tb.pilihanraya_bil AS pruBil');
        $this->db->select('UPPER(pilihanraya_tb.pilihanraya_nama) AS pruNama');
        $this->db->select('pilihanraya_tb.pilihanraya_singkatan AS pruSingkatan');
        $this->db->select('pilihanraya_bil, pilihanraya_nama, pilihanraya_jenis');
        $this->db->join('pilihanraya_tb', 'pegawai_tb.pru_bil = pilihanraya_tb.pilihanraya_bil', 'left');
        $this->db->where('pengguna_bil', $pegawaiBil);
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $this->db->order_by('pg_dicipta_pada', 'desc');
        $query = $this->db->get($this->pegawai);
        return $query->result();
    }

    public function senaraiTugasanPru($pegawaiBil){
        $this->db->select('pg_bil, pg_nama, pg_jawatan, pg_bahagian, pg_ic, pg_telefon, pg_email, pg_peranan, pg_catatan, pg_dicipta_pada, pg_dicipta_oleh, pg_diubah_pada, pg_diubah_oleh, pengguna_bil, pru_bil, pru_nama, pru_singkatan');
        $this->db->where('pengguna_bil', $pegawaiBil);
        $this->db->order_by('pg_dicipta_pada', 'desc');
        $query = $this->db->get($this->pegawai);
        return $query->result();
    }

    public function senarai_pegawai_by_pru($pru_bil){
        $this->db->select('pg_bil, pg_nama, pg_jawatan, pg_bahagian, pg_ic, pg_telefon, pg_email, pg_peranan, pg_catatan, pg_dicipta_pada, pg_dicipta_oleh, pg_diubah_pada, pg_diubah_oleh, pengguna_bil, pru_bil, pru_nama, pru_singkatan');
        $this->db->where('pru_bil', $pru_bil);
        $query = $this->db->get($this->pegawai);
        return $query->result();
    }

    public function senarai_pru_by_pegawai($pegawaiBil){
        $this->db->select('pru_bil, pru_nama, pru_singkatan, pengguna_bil, pg_dicipta_pada, pg_diubah_pada, pg_catatan');
        $this->db->where('pengguna_bil', $pegawaiBil);
        $this->db->group_by('pru_bil, pru_nama, pru_singkatan, pengguna_bil, pg_dicipta_pada, pg_diubah_pada, pg_catatan');
        $query = $this->db->get($this->pegawai);
        return $query->result();
    }

    public function cari_pegawai_pru($pengguna_bil, $pru_bil){
        $this->db->where('pengguna_bil', $pengguna_bil);
        $this->db->where('pru_bil', $pru_bil);
        $query = $this->db->get($this->pegawai);
        return $query->row();
    }
    
    public function tambah($data){
        return $this->db->insert($this->pegawai, $data);
    }

    public function kemaskini($data, $bil){
        $this->db->where('pg_bil', $bil);
        return $this->db->update($this->pegawai, $data);
    }

    public function buang($bil){
        $this->db->where('pg_bil', $bil);
        return $this->db->delete($this->pegawai);
    }

    public function bilangan(){
        $this->db->select("COUNT(*) AS bilangan");
        $query = $this->db->get($this->pegawai);
        return $query->row();
    }

    public function senarai(){
        $this->binaTable();
        $this->db->order_by('pg_dicipta_pada', 'desc');
        $query = $this->db->get($this->pegawai);
        return $query->result();
    }

    private function binaTable(){
        $this->load->dbforge();
        if(!$this->db->table_exists($this->pegawai)){
            $fields = array(
                'pg_bil' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'pengguna_bil' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'null' => FALSE
                ),
                'pru_bil' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'null' => FALSE
                ),
                'pg_nama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => FALSE
                ),
                'pg_jawatan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE
                ),
                'pg_bahagian' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE
                ),
                'pg_ic' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'pg_telefon' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '15',
                    'null' => TRUE
                ),
                'pg_email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE
                ),
                'pg_peranan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '20',
                    'null' => FALSE
                ),
                'pg_catatan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'pg_dicipta_pada' => array(
                    'type' => 'DATETIME',
                    'null' => FALSE
                ),
                'pg_dicipta_oleh' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'null' => FALSE
                ),
                'pg_diubah_pada' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                ),
                'pg_diubah_oleh' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'null' => TRUE
                ),
                'pru_nama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE
                ),
                'pru_singkatan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '20',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('pg_bil', TRUE);
            $this->dbforge->create_table($this->pegawai);
        }
    }

}