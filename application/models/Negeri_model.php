<?php
class Negeri_model extends CI_Model
{
    protected $table = "negeri_tb";

    //======================================================================
    // FUNGSI BARU DITAMBAH DI SINI
    //======================================================================

    /**
     * Mendapatkan satu baris data negeri berdasarkan ID (bil).
     * Ini adalah alias untuk fungsi negeri($bil) untuk konsistensi.
     *
     * @param int $bil ID negeri (nt_bil).
     * @return object Data negeri.
     */
    public function satu_data($bil)
    {
        // Memanggil fungsi 'negeri' yang sedia ada.
        return $this->negeri($bil);
    }

    //======================================================================
    // FUNGSI SEDIA ADA ANDA
    //======================================================================

    public function senaraiNegeriCarian(){
        $column = [
            'negeri_tb.nt_bil AS negeriBil', 
            'UPPER(negeri_tb.nt_nama) AS negeriNama'
        ];
        $this->db->select($column);
        $this->db->order_by("negeriNama", "ASC");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function bilanganLaporanUtama(){
        $this->db->select("COUNT(*) AS bilanganLaporan");
        $query = $this->db->get($this->table);
        $bilanganLaporan = $query->row();
        return $bilanganLaporan->bilanganLaporan;
    }

    public function bilanganParlimenSenarai(){
        $this->db->select('negeri_tb.nt_bil AS negeriBil');
        $this->db->select('UPPER(negeri_tb.nt_nama) AS negeriNama');
        $this->db->select('(
        SELECT COUNT(*)
        FROM parlimen_tb
        WHERE UPPER(parlimen_tb.pt_negeri) = UPPER(negeri_tb.nt_nama)
        ) AS bilanganParlimen');
        $this->db->order_by('bilanganParlimen', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiNegeriBil($negeriBil){
        $this->db->select('negeri_tb.nt_bil as negeriBil');
        $this->db->select('negeri_tb.nt_nama as negeriNama');
        $this->db->select('negeri_tb.nt_nama_fail as negeriFail');
        $this->db->where('negeri_tb.nt_bil', $negeriBil);
        $this->db->order_by('negeriNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiNegeri(){
        $this->db->select('negeri_tb.nt_bil as negeriBil');
        $this->db->select('negeri_tb.nt_nama as negeriNama');
        $this->db->select('negeri_tb.nt_nama_fail as negeriFail');
        $this->db->order_by('negeriNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiTugasanNegeri($perananBil)
    {
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = tugas_negeri.negeri', 'left');
        $this->db->where('peranan', $perananBil);
        $query = $this->db->get('tugas_negeri');
        return $query->result();
    }

    public function ada($perananBil, $negeriBil)
    {
        $this->db->where('peranan', $perananBil);
        $this->db->where('negeri', $negeriBil);
        $query = $this->db->get('tugas_negeri');
        return $query->result();
    }

    public function tambahTugasanNegeri($perananBil, $negeriBil, $penggunaBil)
    {
        $data = array(
            "peranan" => $perananBil,
            "negeri" => $negeriBil,
            "pengguna_bil" => $penggunaBil,
            "pengguna_waktu" => date("Y-m-d H:i:s")
        );
        return $this->db->insert('tugas_negeri', $data);
    }

    public function tugasanNegeri(){
        $this->load->dbforge();
        if($this->db->table_exists('tugas_negeri') == FALSE){
            $fields = array(
                'bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'peranan' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'negeri' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'pengguna_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'null' => TRUE
                ),
                'pengguna_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('bil', TRUE);
            $this->dbforge->create_table('tugas_negeri', TRUE);
        }
    }

    public function nama_foto($negeri){
        $this->db->select('nt_nama_fail');
        $this->db->where('nt_nama', $negeri);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senarai_negeri_ikut_parlimen(){
        $this->db->select('negeri_tb.nt_bil, negeri_tb.nt_nama');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_negeri = negeri_tb.nt_nama');
        $this->db->group_by('parlimen_tb.pt_negeri');
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai()
    {
        $this->db->order_by('nt_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    public function negeri($negeri_bil)
    {
        $this->db->where('nt_bil', $negeri_bil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function negeri_nama($negeri_nama)
    {
        $this->db->where('nt_nama', $negeri_nama);
        $query = $this->db->get($this->table);
        return $query->row();
    }
}
?>
