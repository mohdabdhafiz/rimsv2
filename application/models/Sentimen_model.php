<?php
class Sentimen_model extends CI_Model
{

    private $table = 'sentimen_tb';
    private $tableIsu = "sentimen_isu_tb";
    private $tableDapatIsu = "sentimen_dapatan_isu_tb";

    

    public function padamMaklumatIsu($isuBil){
        $this->db->delete($this->tableIsu, ['sit_bil' => $isuBil]);
    }

    /**
     * Fungsi untuk mengemaskini rekod isu di dalam database.
     */
    public function update_isu($id, $data) {
        // ANDAIAN: Primary key anda ialah 'sit_id'
        $this->db->where('sit_bil', $id);
        // Kemaskini data dalam $this->tableIsu
        return $this->db->update($this->tableIsu, $data); 
    }

    public function padamIsu($sentimenBil){
        $this->db->delete($this->tableDapatIsu, ['sdi_sentimen_bil' => $sentimenBil]);
    }   

    /**
     * FUNGSI UNTUK JADUAL SENARAI ISU
     * Mendapatkan semua isu dari jadual utama dan mengira jumlah laporan
     * serta sentimen dominan untuk setiap isu.
     */
    public function dapatkan_semua_isu_dengan_rumusan()
    {
        $this->db->select("
            sit.*,
            (SELECT COUNT(*) FROM {$this->tableDapatIsu} sdi WHERE sdi.sdi_sentimen_bil = sit.sit_bil) as jumlah_laporan,
            (SELECT sdi_sentimen FROM {$this->tableDapatIsu} sdi WHERE sdi.sdi_sentimen_bil = sit.sit_bil GROUP BY sdi_sentimen ORDER BY COUNT(sdi_bil) DESC, sdi_sentimen ASC LIMIT 1) as sentimen_dominan
        ");
        $this->db->from("{$this->tableIsu} sit");
        $this->db->order_by('sit.sit_tarikh_dibina', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * FUNGSI UNTUK KAD STATISTIK (INFO CARDS) - Versi PHP 5 Compatible
     * Mengira tiga metrik utama untuk paparan di bahagian atas.
     */
    public function dapatkan_statistik_kad_info()
    {
        // 1. Dapatkan jumlah isu yang aktif
        $this->db->where('sit_aktif', 'YA');
        $this->db->from($this->tableIsu);
        $jumlah_aktif = $this->db->count_all_results();

        // 2. Dapatkan sentimen dominan keseluruhan
        $this->db->select('sdi_sentimen');
        $this->db->from($this->tableDapatIsu);
        $this->db->group_by('sdi_sentimen');
        $this->db->order_by('COUNT(sdi_bil)', 'DESC');
        $this->db->limit(1);
        $query_dominan = $this->db->get();
        
        // Semakan jika tiada data untuk mengelakkan error pada row()
        if ($query_dominan->num_rows() > 0) {
            $dominan_keseluruhan = $query_dominan->row()->sdi_sentimen;
        } else {
            $dominan_keseluruhan = null;
        }

        // 3. Dapatkan isu dengan laporan negatif terbanyak
        $this->db->select('sdi_isu, COUNT(sdi_bil) as jumlah_negatif');
        $this->db->from($this->tableDapatIsu);
        $this->db->where('sdi_sentimen', 'Negatif');
        
        // PEMBETULAN PHP 5: Gunakan array() menggantikan []
        $this->db->group_by(array('sdi_sentimen_bil', 'sdi_isu')); 
        
        $this->db->order_by('jumlah_negatif', 'DESC');
        $this->db->limit(1);
        $isu_paling_negatif = $this->db->get()->row();

        // Penyediaan Result Object
        $result = new stdClass();
        $result->jumlah_isu_aktif = $jumlah_aktif;
        
        // Logik ternary (Logic ini disokong dalam PHP 5)
        $result->dominan_keseluruhan = isset($dominan_keseluruhan) ? $dominan_keseluruhan : 'TIADA DATA';
        $result->isu_paling_negatif = isset($isu_paling_negatif->sdi_isu) ? $isu_paling_negatif->sdi_isu : 'TIADA DATA';
        $result->jumlah_paling_negatif = isset($isu_paling_negatif->jumlah_negatif) ? $isu_paling_negatif->jumlah_negatif : 0;

        return $result;
    }

    public function senaraiPelaporNegeri($senaraiNegeri){
        $this->db->select([
            'pengguna_tb.nama_penuh AS nama_pelapor',
            'pengguna_tb.no_tel AS no_tel_pelapor',
            'COUNT(sentimen_tb.stBil) AS jumlah_isu',
            'pengguna_tb.pekerjaan AS jawatan_pelapor',
            'pengguna_tb.pengguna_tempat_tugas AS penempatan_pelapor'
        ]);
        $this->db->from($this->table);
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('daerah.negeri_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->group_by('sentimen_tb.stPelaporBil');
        $this->db->order_by('jumlah_isu', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function dapatkan_statistik_kad_info_negeri($senaraiNegeri)
    {
        // 2. Dapatkan sentimen dominan keseluruhan
        $this->db->select('sdi_sentimen');
        $this->db->from($this->tableDapatIsu);
        $this->db->group_by('sdi_sentimen');
        $this->db->order_by('COUNT(sdi_bil)', 'DESC');
        $this->db->limit(1);
        $dominan_keseluruhan = $this->db->get()->row('sdi_sentimen');

        // 3. Dapatkan isu dengan laporan negatif terbanyak (BAHAGIAN YANG DIPERBETULKAN)
        $this->db->select('sdi_isu, COUNT(sdi_bil) as jumlah_negatif');
        $this->db->from($this->tableDapatIsu);
        $this->db->where('sdi_sentimen', 'Negatif');
        
        // PEMBETULAN: Tambah 'sdi_isu' ke dalam group_by
        $this->db->group_by(['sdi_sentimen_bil', 'sdi_isu']); 
        
        $this->db->order_by('jumlah_negatif', 'DESC');
        $this->db->limit(1);
        $isu_paling_negatif = $this->db->get()->row();

        // 4. Dapatkan bilangan pelapor semasa
        $this->db->select('COUNT(DISTINCT stPelaporBil) AS jumlah_pelapor');
        $this->db->from($this->table);
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('daerah.negeri_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $jumlah_pelapor = $this->db->get()->row('jumlah_pelapor');

        $result = new stdClass();
        $result->dominan_keseluruhan = isset($dominan_keseluruhan) ? $dominan_keseluruhan : 'TIADA DATA';

        // Semakan "Nested": Pastikan objek $isu_paling_negatif wujud DAHULU, baru cek property
        $result->isu_paling_negatif = (isset($isu_paling_negatif) && isset($isu_paling_negatif->sdi_isu)) ? $isu_paling_negatif->sdi_isu : 'TIADA DATA';

        $result->jumlah_paling_negatif = (isset($isu_paling_negatif) && isset($isu_paling_negatif->jumlah_negatif)) ? $isu_paling_negatif->jumlah_negatif : 0;

        $result->jumlah_pelapor = isset($jumlah_pelapor) ? $jumlah_pelapor : 0;

        return $result;
    }

    public function dapatkan_taburan_sentimen_negeri($senaraiNegeri)
    {
        $this->db->select('sdi_sentimen as label, COUNT(sdi_bil) as jumlah');
        $this->db->from($this->tableDapatIsu);
        $this->db->group_by('sdi_sentimen');
        if(!empty($senaraiNegeri)){
            $this->db->join('sentimen_tb st', 'sdi_sentimen_bil = st.stBil', 'left');
            $this->db->join('daerah d', 'st.stDaerahBil = d.bil', 'left');
            $this->db->group_start();
            foreach ($senaraiNegeri as $negeri) {
                $this->db->or_where('d.negeri_bil', $negeri->nt_bil);
            }
            $this->db->group_end();
        }
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * FUNGSI UNTUK CARTA DONUT
     * Mendapatkan taburan keseluruhan sentimen (Positif, Neutral, Negatif).
     */
    public function dapatkan_taburan_sentimen_keseluruhan()
    {
        $this->db->select('sdi_sentimen as label, COUNT(sdi_bil) as jumlah');
        $this->db->from($this->tableDapatIsu);
        $this->db->group_by('sdi_sentimen');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function dapatkan_top_isu_sentimen_negeri($limit = 5, $senaraiNegeri)
    {
        // 1. SELECT dengan CASE WHEN (Gunakan FALSE untuk elak backticks pada formula)
        $this->db->select('sit.sit_isu');
        $this->db->select("SUM(CASE WHEN sdi.sdi_sentimen = 'Positif' THEN 1 ELSE 0 END) as positif", FALSE);
        $this->db->select("SUM(CASE WHEN sdi.sdi_sentimen = 'Neutral' THEN 1 ELSE 0 END) as neutral", FALSE);
        $this->db->select("SUM(CASE WHEN sdi.sdi_sentimen = 'Negatif' THEN 1 ELSE 0 END) as negatif", FALSE);

        // 2. FROM & JOIN
        // Nota: 'sdi', 'sit', 'st', 'd' adalah alias untuk table
        $this->db->from($this->tableDapatIsu . ' sdi');
        $this->db->join($this->tableIsu . ' sit', 'sdi.sdi_sentimen_bil = sit.sit_bil');
        $this->db->join('sentimen_tb st', 'sdi.sdi_sentimen_bil = st.stBil', 'left');
        $this->db->join('daerah d', 'st.stDaerahBil = d.bil', 'left');

        // 3. FILTER NEGERI (Looping)
        // Kita letak dalam group (kurungan) supaya logik OR tidak kacau query lain
        if (!empty($senaraiNegeri)) {
            $this->db->group_start();
            foreach ($senaraiNegeri as $negeri) {
                // Pastikan guna object property atau array key bergantung data anda
                $id_negeri = isset($negeri->nt_bil) ? $negeri->nt_bil : $negeri; 
                $this->db->or_where('d.negeri_bil', $id_negeri);
            }
            $this->db->group_end();
        }

        // 4. GROUP BY (Gunakan array() untuk PHP 5)
        $this->db->group_by(array('sdi.sdi_sentimen_bil', 'sit.sit_isu'));

        // 5. ORDER BY & LIMIT
        $this->db->order_by('COUNT(sdi.sdi_bil)', 'DESC');
        $this->db->limit($limit);

        // 6. EXECUTE
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * FUNGSI UNTUK CARTA BAR - Versi PHP 5 Compatible
     * Mendapatkan pecahan sentimen untuk 5 isu yang mempunyai laporan terbanyak.
     */
    public function dapatkan_top_isu_sentimen($limit = 5)
    {
        // SQL string kekal sama
        $sql = "
            SELECT
                sit.sit_isu,
                SUM(CASE WHEN sdi.sdi_sentimen = 'Positif' THEN 1 ELSE 0 END) as positif,
                SUM(CASE WHEN sdi.sdi_sentimen = 'Neutral' THEN 1 ELSE 0 END) as neutral,
                SUM(CASE WHEN sdi.sdi_sentimen = 'Negatif' THEN 1 ELSE 0 END) as negatif
            FROM {$this->tableDapatIsu} sdi
            JOIN {$this->tableIsu} sit ON sdi.sdi_sentimen_bil = sit.sit_bil
            GROUP BY sdi.sdi_sentimen_bil, sit.sit_isu
            ORDER BY COUNT(sdi.sdi_bil) DESC
            LIMIT ?
        ";
        
        // PEMBETULAN PHP 5:
        // Tukar [(int) $limit] kepada array((int) $limit)
        // Kerana PHP versi lama (5.3 ke bawah) tidak menyokong [] untuk array.
        $query = $this->db->query($sql, array((int) $limit));
        
        return $query->result();
    }

     /**
     * Fungsi untuk memasukkan rekod isu baharu ke dalam pangkalan data.
     *
     * @param array $data Data isu yang telah disahkan dari controller.
     * @return bool Mengembalikan TRUE jika simpanan berjaya, FALSE jika gagal.
     */
    public function tambah_isu_baharu($data)
    {
        // Gunakan fungsi insert() dari Query Builder CodeIgniter
        // Ia akan memasukkan array $data ke dalam jadual $this->tableIsu
        // dan mengembalikan status kejayaan (TRUE/FALSE)
        return $this->db->insert($this->tableIsu, $data);
    }

    private function binaTableDapatIsu(){
        $this->load->dbforge();
        if(!$this->db->table_exists($this->tableDapatIsu)){
            $fields = [
                'sdi_bil' => array(
                    'type' => 'INT',
                    'auto_increment' => TRUE
                ),
                'sdi_sentimen_bil' => array(
                    'type' => 'INT',
                    'null' => FALSE
                ),
                'sdi_isu' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => FALSE
                ),
                'sdi_sentimen' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '20',
                    'null' => FALSE
                ),
                'sdi_alasan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                )
            ];
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('sdi_bil', TRUE);
            $this->dbforge->create_table($this->tableDapatIsu, TRUE);
        }
    }

    public function update20250910(){
        $this->binaTableIsu();
        $this->updateTableSentimen20251009();
        $this->binaTableDapatIsu();
    }

    private function updateTableSentimen20251009(){
        $this->load->dbforge();
        if(!$this->db->field_exists('stIsuPositif', $this->table)){
            $fields = [
                'stIsuPositif' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => TRUE,
                    'after' => 'stSentimen'
                )
            ];
            $this->dbforge->add_column($this->table, $fields);
        }
        if(!$this->db->field_exists('stIsuNegatif', $this->table)){
            $fields = [
                'stIsuNegatif' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => TRUE,
                    'after' => 'stIsuPositif'
                )
            ];
            $this->dbforge->add_column($this->table, $fields);
        }
        if(!$this->db->field_exists('stIsuNeutral', $this->table)){
            $fields = [
                'stIsuNeutral' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => TRUE,
                    'after' => 'stIsuNegatif'
                )
            ];
            $this->dbforge->add_column($this->table, $fields);
        }     
        if(!$this->db->field_exists('stIsuAlasan', $this->table)){
            $fields = [
                'stIsuAlasan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE,
                    'after' => 'stIsuNeutral'
                )
            ];
            $this->dbforge->add_column($this->table, $fields);
        }    
        if(!$this->db->field_exists('stIsuAlasan', $this->table)){
            $fields = [
                'stIsuAlasan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE,
                    'after' => 'stIsuNeutral'
                )
            ];
            $this->dbforge->add_column($this->table, $fields);
        }

        if(!$this->db->field_exists('sdi_alasan', $this->tableDapatIsu)){
            $fields = [
                'sdi_alasan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE,
                    'after' => 'sdi_sentimen'
                )
            ];
            $this->dbforge->add_column($this->tableDapatIsu, $fields);
        }
    }

    private function binaTableIsu(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableIsu)){
            return;
        }

        $fields = [
            'sit_bil' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'sit_isu' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'sit_keterangan' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'sit_tarikh_dibina' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'sit_pengguna_bil' => array(
                'type' => 'INT',
                'null' => TRUE
            ),
            'sit_aktif' => array(
                'type' => 'ENUM',
                'constraint' => ['YA', 'TIDAK'],
                'default' => 'YA',
                'null' => FALSE
            )
        ];
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('sit_bil', TRUE);
        $this->dbforge->create_table($this->tableIsu, TRUE);

    }

    public function isu($isuBil){
        $this->update20250910();
        $column = [
            "sit_bil",
            "sit_isu",
            "sit_keterangan",
            "sit_tarikh_dibina",
            "sit_pengguna_bil",
            "sit_aktif",
            "pengguna_tb.nama_penuh AS pengguna_nama"
        ];
        $this->db->select($column);
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_isu_tb.sit_pengguna_bil', 'left');
        $this->db->where("sit_bil", $isuBil);
        $query = $this->db->get($this->tableIsu);
        return $query->row();
    }

    public function senaraiIsu(){
        $this->update20250910();
        $this->db->select("UPPER(sentimen_isu_tb.sit_isu) AS nama");
        $this->db->select("sentimen_isu_tb.sit_bil AS id");
        $this->db->where("sentimen_isu_tb.sit_aktif", "YA");
        $this->db->order_by('sentimen_isu_tb.sit_tarikh_dibina', 'DESC');
        $query = $this->db->get($this->tableIsu);
        return $query->result();
    }

    public function senaraiBilanganLaporan($perananBil, $tahun){
        $columns = [
            "pengguna_tb.bil AS pegawaiNomborSiri",
            "UPPER(pengguna_tb.nama_penuh) AS pegawaiNama",
            "UPPER(pengguna_tb.pekerjaan) AS pegawaiJawatan",
            "COUNT(CASE WHEN DATE(sentimen_tb.stTarikhLaporan) = CURDATE() THEN 1 ELSE NULL END) AS laporanHari",
            "COUNT(CASE WHEN WEEKDAY(sentimen_tb.stTarikhLaporan) = WEEKDAY(CURDATE()) AND YEAR(sentimen_tb.stTarikhLaporan) = YEAR(CURDATE()) THEN 1 ELSE NULL END) AS laporanMinggu",
            "COUNT(CASE WHEN MONTH(sentimen_tb.stTarikhLaporan) = MONTH(CURDATE()) AND YEAR(sentimen_tb.stTarikhLaporan) = YEAR(CURDATE()) THEN 1 ELSE NULL END) AS laporanBulan",
            "COUNT(CASE WHEN YEAR(sentimen_tb.stTarikhLaporan) = YEAR(CURDATE()) THEN 1 ELSE NULL END) AS laporanTahun"
        ];
        $this->db->select($columns);

        $joins = [
            ['pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left']
        ];
        foreach ($joins as $join) {
            $this->db->join($join[0], $join[1], $join[2]);
        }

        $this->db->where("pengguna_tb.pengguna_peranan_bil", $perananBil);
        $this->db->where("YEAR(sentimen_tb.stTarikhLaporan)", $tahun);

        $this->db->order_by("laporanTahun", "DESC");

        $this->db->group_by("pengguna_tb.bil");
        $this->db->group_by("pengguna_tb.nama_penuh");
        $this->db->group_by("pengguna_tb.pekerjaan");

        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanIkutNegeri($tahun){
        $columns = [
            "UPPER(negeri_tb.nt_nama) AS negeriNama",
            "COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'POSITIF' THEN 1 END) AS positif",
            "COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'NEUTRAL' THEN 1 END) AS neutral",
            "COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'NEGATIF' THEN 1 END) AS negatif",
            "CASE 
            WHEN COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'POSITIF' THEN 1 END) >= COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'NEUTRAL' THEN 1 END) 
                 AND COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'POSITIF' THEN 1 END) >= COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'NEGATIF' THEN 1 END) 
            THEN 'POSITIF'
            WHEN COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'NEUTRAL' THEN 1 END) >= COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'POSITIF' THEN 1 END) 
                 AND COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'NEUTRAL' THEN 1 END) >= COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'NEGATIF' THEN 1 END) 
            THEN 'NEUTRAL'
            ELSE 'NEGATIF'
        END AS dominan"
        ];
        $this->db->select($columns);
        $this->db->where('YEAR(sentimen_tb.stTarikhLaporan)', $tahun);
        // Define table joins
        $joins = [
            ['pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left'],
            ['daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left'],
            ['negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left'],
            ['parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left'],
            ['dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left'],
        ];
    
        // Apply joins
        foreach ($joins as $join) {
            $this->db->join($join[0], $join[1], $join[2]);
        }
        $this->db->group_by('negeri_tb.nt_bil');
        $this->db->order_by('negeriNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function padam($sentimenBil){
        $this->db->delete($this->table, ['sentimen_tb.stBil' => $sentimenBil]);
    }

    public function statusPenghantaran($senaraiAnggota){
        $columns = [
            "UPPER(pengguna_tb.nama_penuh) AS nama_penuh",
            "pengguna_tb.bil",
            "UPPER(pengguna_tb.pekerjaan) AS jawatan",
            "UPPER(pengguna_tb.pengguna_tempat_tugas) AS penempatan",
            "COUNT(sentimen_tb.stPelaporBil) AS jumlah_laporan"
        ];
        $this->db->select($columns);
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiAnggota as $anggota){
            $this->db->or_where('sentimen_tb.stPelaporBil', $anggota->bil);
        }
        $this->db->group_end();
        $this->db->where('YEAR(sentimen_tb.stTarikhLaporan)', date("Y"));
        $this->db->group_by('sentimen_tb.stPelaporBil');
        $this->db->order_by("jumlah_laporan", "DESC");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function muatTurunPilihan($filters = [], $senaraiPeranan) {
        $senaraiIsu = $this->senaraiIsu();
        $this->db->select("sentimen_tb.stBil AS `NOMBOR SIRI`");
        $this->db->select("sentimen_tb.stPenggunaWaktu AS `LAPORAN DIBINA`");
        $this->db->select("pengguna_tb.emel AS `E-MEL PELAPOR`");
        $this->db->select("sentimen_tb.stTarikhLaporan AS `TARIKH LAPORAN`");
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS `NAMA PELAPOR`");
        $this->db->select("pengguna_tb.no_tel AS `NOMBOR TELEFON PELAPOR`");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS `NEGERI`");
        $this->db->select("UPPER(daerah.nama) AS `DAERAH`");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS `PARLIMEN`");
        $this->db->select("UPPER(dun_tb.dun_nama) AS `DUN`");
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS `KAWASAN RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS `PEKERJAAN RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stUmur) AS `KATEGORI UMUR RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stKaum) AS `KAUM RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stJantina) AS `JANTINA RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS `SENTIMEN`");
        $this->db->select("UPPER(sentimen_tb.stPerkara) AS `PERKARA`");
        $this->db->select("sentimen_tb.stAlasan AS `ULASAN SENTIMEN`");
        $this->db->select("UPPER(sentimen_tb.stIsuPositif) AS `SENARAI ISU POSITIF`");
        $this->db->select("UPPER(sentimen_tb.stIsuNegatif) AS `SENARAI ISU NEGATIF`");
        $this->db->select("UPPER(sentimen_tb.stIsuNeutral) AS `SENARAI ISU NEUTRAL`");
        $this->db->select("sentimen_tb.stIsuAlasan AS `ULASAN ISU`");
        
        foreach($senaraiIsu as $isu){
            $this->db->select("(SELECT UPPER(sentimen_dapatan_isu_tb.sdi_sentimen) FROM sentimen_dapatan_isu_tb WHERE sentimen_dapatan_isu_tb.sdi_sentimen_bil = sentimen_tb.stBil AND sentimen_dapatan_isu_tb.sdi_sentimen IS NOT NULL AND UPPER(sentimen_dapatan_isu_tb.sdi_isu) = '".strtoupper($isu->nama)."' LIMIT 1) AS `".$isu->nama."`", FALSE);
            $this->db->select("(SELECT sentimen_dapatan_isu_tb.sdi_alasan FROM sentimen_dapatan_isu_tb WHERE sentimen_dapatan_isu_tb.sdi_sentimen_bil = sentimen_tb.stBil AND sentimen_dapatan_isu_tb.sdi_sentimen IS NOT NULL AND UPPER(sentimen_dapatan_isu_tb.sdi_isu) = '".strtoupper($isu->nama)."' LIMIT 1) AS `".$isu->nama." - ULASAN`", FALSE);
        }
    
        // Define table joins
        $joins = [
            ['pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left'],
            ['daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left'],
            ['negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left'],
            ['parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left'],
            ['dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left'],
        ];
    
        // Apply joins
        foreach ($joins as $join) {
            $this->db->join($join[0], $join[1], $join[2]);
        }
    
        // Apply filtering conditions if provided
        if (!empty($filters)) {
            foreach ($filters as $column => $value) {
                // Check for special handling (e.g., LIKE for partial matches)
                if (is_array($value) && isset($value['operator'])) {
                    // Handle different operators (e.g., LIKE, >, <, etc.)
                    $this->db->where("{$column} {$value['operator']}", $value['value']);
                } else {
                    // Default to equality
                    $this->db->where($column, $value);
                }
            }
        }
    
        // Apply default condition
        $this->db->where('stTapisan', 'Terima');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
    
        // Set ordering
        $this->db->order_by('sentimen_tb.stPenggunaWaktu', 'DESC');
    
        // Execute query
        $query = $this->db->get($this->table);
    
        return $query->result_array();
    }
    

    public function sentimenPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS nama");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->where('sentimen_tb.stSentimen !=', '');
        $this->db->group_by('sentimen_tb.stSentimen');
        $this->db->order_by('sentimen_tb.stSentimen', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function jantinaPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(sentimen_tb.stJantina) AS nama");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->where('sentimen_tb.stJantina !=', '');
        $this->db->group_by('sentimen_tb.stJantina');
        $this->db->order_by('sentimen_tb.stJantina', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kaumPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(sentimen_tb.stKaum) AS nama");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->where('sentimen_tb.stKaum !=', '');
        $this->db->group_by('sentimen_tb.stKaum');
        $this->db->order_by('sentimen_tb.stKaum', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function umurPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(sentimen_tb.stUmur) AS nama");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->where('sentimen_tb.stUmur !=', '');
        $this->db->group_by('sentimen_tb.stUmur');
        $this->db->order_by('sentimen_tb.stUmur', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function pekerjaanPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS nama");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->where('sentimen_tb.stPekerjaan !=', '');
        $this->db->group_by('sentimen_tb.stPekerjaan');
        $this->db->order_by('sentimen_tb.stPekerjaan', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kawasanPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS nama");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->group_by('sentimen_tb.stKawasan');
        $this->db->order_by('sentimen_tb.stKawasan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function dunPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(dun_tb.dun_nama) AS dunNama");
        $this->db->select("dun_tb.dun_bil AS dunBil");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->group_by('sentimen_tb.stDunBil');
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function parlimenPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("parlimen_tb.pt_bil AS parlimenBil");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->group_by('sentimen_tb.stParlimenBil');
        $this->db->order_by('parlimenNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function daerahPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(daerah.nama) AS daerahNama");
        $this->db->select("daerah.bil AS daerahBil");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->group_by('sentimen_tb.stDaerahBil');
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function negeriPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(negeri_tb.nt_nama) AS negeriNama");
        $this->db->select("negeri_tb.nt_bil AS negeriBil");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_by('negeri_tb.nt_nama');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function pelaporPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS pelaporNama");
        $this->db->select("pengguna_tb.bil AS pelaporBil");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->group_by('sentimen_tb.stPelaporBil');
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiIkutIndividu($penggunaBil, $tahun){
        $this->checkTableExists();
        $this->db->select("sentimen_tb.stBil AS lksBil");
        $this->db->select("sentimen_tb.stPenggunaWaktu AS lksTimestamp");
        $this->db->select("pengguna_tb.emel AS penggunaEmel");
        $this->db->select("sentimen_tb.stTarikhLaporan AS lksTarikhLaporan");
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS penggunaNama");
        $this->db->select("pengguna_tb.no_tel AS penggunaNoTel");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS negeriNama");
        $this->db->select("UPPER(daerah.nama) AS daerahNama");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("UPPER(dun_tb.dun_nama) AS dunNama");
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS lksKawasan");
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS lksPekerjaan");
        $this->db->select("sentimen_tb.stUmur AS lksUmur");
        $this->db->select("UPPER(sentimen_tb.stKaum) AS lksKaum");
        $this->db->select("UPPER(sentimen_tb.stJantina) AS lksJantina");
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS lksSentimen");
        $this->db->select("UPPER(sentimen_tb.stPerkara) AS lksPerkara");
        $this->db->select("sentimen_tb.stAlasan AS lksUlasan");
        $this->db->select("UPPER(sentimen_tb.stTapisan) AS lksTapisan");
        $this->db->select("UPPER(sentimen_tb.stIsuPositif) AS lksIsuPositif");
        $this->db->select("UPPER(sentimen_tb.stIsuNegatif) AS lksIsuNegatif");
        $this->db->select("UPPER(sentimen_tb.stIsuNeutral) AS lksIsuNeutral");
        $this->db->select("sentimen_tb.stIsuAlasan AS lksIsuAlasan");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->where('sentimen_tb.stPelaporBil', $penggunaBil);
        $this->db->where('YEAR(sentimen_tb.stTarikhLaporan)', $tahun);
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiLaporanMengikutPelapor($perananBil, $tahun){
        $this->db->select('UPPER(pengguna_tb.nama_penuh) AS pelaporNama');
        $this->db->select('COUNT(sentimen_tb.stPelaporBil) AS bilanganLaporan');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $perananBil);
        $this->db->where('YEAR(sentimen_tb.stTarikhLaporan)', $tahun);
        $this->db->group_by('sentimen_tb.stPelaporBil');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function muatTurunTarikh($tarikhMula, $tarikhTamat){
        $senaraiIsu = $this->senaraiIsu();
        $this->db->select("sentimen_tb.stBil AS `NOMBOR SIRI`");
        $this->db->select("sentimen_tb.stPenggunaWaktu AS `LAPORAN DIBINA`");
        $this->db->select("pengguna_tb.emel AS `E-MEL PELAPOR`");
        $this->db->select("sentimen_tb.stTarikhLaporan AS `TARIKH LAPORAN`");
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS `NAMA PELAPOR`");
        $this->db->select("pengguna_tb.no_tel AS `NOMBOR TELEFON PELAPOR`");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS `NEGERI`");
        $this->db->select("UPPER(daerah.nama) AS `DAERAH`");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS `PARLIMEN`");
        $this->db->select("UPPER(dun_tb.dun_nama) AS `DUN`");
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS `KAWASAN RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS `PEKERJAAN RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stUmur) AS `KATEGORI UMUR RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stKaum) AS `KAUM RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stJantina) AS `JANTINA RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS `SENTIMEN`");
        $this->db->select("UPPER(sentimen_tb.stPerkara) AS `PERKARA`");
        $this->db->select("sentimen_tb.stAlasan AS `ULASAN SENTIMEN`");
        $this->db->select("UPPER(sentimen_tb.stIsuPositif) AS `SENARAI ISU POSITIF`");
        $this->db->select("UPPER(sentimen_tb.stIsuNegatif) AS `SENARAI ISU NEGATIF`");
        $this->db->select("UPPER(sentimen_tb.stIsuNeutral) AS `SENARAI ISU NEUTRAL`");
        $this->db->select("sentimen_tb.stIsuAlasan AS `ULASAN ISU`");
        
        foreach($senaraiIsu as $isu){
            $this->db->select("(SELECT UPPER(sentimen_dapatan_isu_tb.sdi_sentimen) FROM sentimen_dapatan_isu_tb WHERE sentimen_dapatan_isu_tb.sdi_sentimen_bil = sentimen_tb.stBil AND UPPER(sentimen_dapatan_isu_tb.sdi_isu) = '".strtoupper($isu->nama)."' LIMIT 1) AS `".$isu->nama."`", FALSE);
            $this->db->select("(SELECT sentimen_dapatan_isu_tb.sdi_alasan FROM sentimen_dapatan_isu_tb WHERE sentimen_dapatan_isu_tb.sdi_sentimen_bil = sentimen_tb.stBil AND UPPER(sentimen_dapatan_isu_tb.sdi_isu) = '".strtoupper($isu->nama)."' LIMIT 1) AS `".$isu->nama." - ULASAN`", FALSE);
        }


        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('DATE(sentimen_tb.stPenggunaWaktu) >=', $tarikhMula);
        $this->db->where('DATE(sentimen_tb.stPenggunaWaktu) <=', $tarikhTamat);

        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query;
    }

    public function muatTurunSemua(){
        $senaraiIsu = $this->senaraiIsu();
        $this->db->select("sentimen_tb.stBil AS `NOMBOR SIRI`");
        $this->db->select("sentimen_tb.stPenggunaWaktu AS `LAPORAN DIBINA`");
        $this->db->select("pengguna_tb.emel AS `E-MEL PELAPOR`");
        $this->db->select("sentimen_tb.stTarikhLaporan AS `TARIKH LAPORAN`");
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS `NAMA PELAPOR`");
        $this->db->select("pengguna_tb.no_tel AS `NOMBOR TELEFON PELAPOR`");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS `NEGERI`");
        $this->db->select("UPPER(daerah.nama) AS `DAERAH`");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS `PARLIMEN`");
        $this->db->select("UPPER(dun_tb.dun_nama) AS `DUN`");
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS `KAWASAN RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS `PEKERJAAN RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stUmur) AS `KATEGORI UMUR RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stKaum) AS `KAUM RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stJantina) AS `JANTINA RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS `SENTIMEN`");
        $this->db->select("UPPER(sentimen_tb.stPerkara) AS `PERKARA`");
        $this->db->select("sentimen_tb.stAlasan AS `ULASAN SENTIMEN`");
        $this->db->select("UPPER(sentimen_tb.stIsuPositif) AS `SENARAI ISU POSITIF`");
        $this->db->select("UPPER(sentimen_tb.stIsuNegatif) AS `SENARAI ISU NEGATIF`");
        $this->db->select("UPPER(sentimen_tb.stIsuNeutral) AS `SENARAI ISU NEUTRAL`");
        $this->db->select("sentimen_tb.stIsuAlasan AS `ULASAN ISU`");
        
        foreach($senaraiIsu as $isu){
            $this->db->select("(SELECT UPPER(sentimen_dapatan_isu_tb.sdi_sentimen) FROM sentimen_dapatan_isu_tb WHERE sentimen_dapatan_isu_tb.sdi_sentimen_bil = sentimen_tb.stBil AND sentimen_dapatan_isu_tb.sdi_sentimen IS NOT NULL AND UPPER(sentimen_dapatan_isu_tb.sdi_isu) = '".strtoupper($isu->nama)."' LIMIT 1) AS `".$isu->nama."`", FALSE);
            $this->db->select("(SELECT sentimen_dapatan_isu_tb.sdi_alasan FROM sentimen_dapatan_isu_tb WHERE sentimen_dapatan_isu_tb.sdi_sentimen_bil = sentimen_tb.stBil AND sentimen_dapatan_isu_tb.sdi_sentimen IS NOT NULL AND UPPER(sentimen_dapatan_isu_tb.sdi_isu) = '".strtoupper($isu->nama)."' LIMIT 1) AS `".$isu->nama." - ULASAN`", FALSE);
        }

        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->where('stTapisan', 'Terima');

        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query;
    }

    public function muatTurun($senaraiNegeri){
        $senaraiIsu = $this->senaraiIsu();
        $this->db->select("sentimen_tb.stBil AS `NOMBOR SIRI`");
        $this->db->select("sentimen_tb.stPenggunaWaktu AS `LAPORAN DIBINA`");
        $this->db->select("pengguna_tb.emel AS `E-MEL PELAPOR`");
        $this->db->select("sentimen_tb.stTarikhLaporan AS `TARIKH LAPORAN`");
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS `NAMA PELAPOR`");
        $this->db->select("pengguna_tb.no_tel AS `NOMBOR TELEFON PELAPOR`");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS `NEGERI`");
        $this->db->select("UPPER(daerah.nama) AS `DAERAH`");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS `PARLIMEN`");
        $this->db->select("UPPER(dun_tb.dun_nama) AS `DUN`");
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS `KAWASAN RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS `PEKERJAAN RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stUmur) AS `KATEGORI UMUR RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stKaum) AS `KAUM RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stJantina) AS `JANTINA RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS `SENTIMEN`");
        $this->db->select("UPPER(sentimen_tb.stPerkara) AS `PERKARA`");
        $this->db->select("sentimen_tb.stAlasan AS `ULASAN SENTIMEN`");
        $this->db->select("UPPER(sentimen_tb.stIsuPositif) AS `SENARAI ISU POSITIF`");
        $this->db->select("UPPER(sentimen_tb.stIsuNegatif) AS `SENARAI ISU NEGATIF`");
        $this->db->select("UPPER(sentimen_tb.stIsuNeutral) AS `SENARAI ISU NEUTRAL`");
        $this->db->select("sentimen_tb.stIsuAlasan AS `ULASAN ISU`");
        
        foreach($senaraiIsu as $isu){
            $this->db->select("(SELECT UPPER(sentimen_dapatan_isu_tb.sdi_sentimen) FROM sentimen_dapatan_isu_tb WHERE sentimen_dapatan_isu_tb.sdi_sentimen_bil = sentimen_tb.stBil AND sentimen_dapatan_isu_tb.sdi_sentimen IS NOT NULL AND UPPER(sentimen_dapatan_isu_tb.sdi_isu) = '".strtoupper($isu->nama)."' LIMIT 1) AS `".$isu->nama."`", FALSE);
            $this->db->select("(SELECT sentimen_dapatan_isu_tb.sdi_alasan FROM sentimen_dapatan_isu_tb WHERE sentimen_dapatan_isu_tb.sdi_sentimen_bil = sentimen_tb.stBil AND sentimen_dapatan_isu_tb.sdi_sentimen IS NOT NULL AND UPPER(sentimen_dapatan_isu_tb.sdi_isu) = '".strtoupper($isu->nama)."' LIMIT 1) AS `".$isu->nama." - ULASAN`", FALSE);
        }

        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->where('stTapisan', 'Terima');

        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();

        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query;
    }

    public function senaraiNegeri($senaraiNegeri)
    {
        //INTIALIZATION
        $this->checkTableExists();
        
        $this->db->select("sentimen_tb.stBil AS lksBil");
        $this->db->select("sentimen_tb.stPenggunaWaktu AS lksTimestamp");
        $this->db->select("pengguna_tb.emel AS penggunaEmel");
        $this->db->select("sentimen_tb.stTarikhLaporan AS lksTarikhLaporan");
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS penggunaNama");
        $this->db->select("pengguna_tb.no_tel AS penggunaNoTel");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS negeriNama");
        $this->db->select("UPPER(daerah.nama) AS daerahNama");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("UPPER(dun_tb.dun_nama) AS dunNama");
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS lksKawasan");
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS lksPekerjaan");
        $this->db->select("UPPER(sentimen_tb.stUmur) AS lksUmur");
        $this->db->select("UPPER(sentimen_tb.stKaum) AS lksKaum");
        $this->db->select("UPPER(sentimen_tb.stJantina) AS lksJantina");
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS lksSentimen");
        $this->db->select("UPPER(sentimen_tb.stPerkara) AS lksPerkara");
        $this->db->select("sentimen_tb.stAlasan AS lksUlasan");
        $this->db->select("UPPER(sentimen_tb.stTapisan) AS lksTapisan");
        $this->db->select("UPPER(sentimen_tb.stIsuPositif) AS lksIsuPositif");
        $this->db->select("UPPER(sentimen_tb.stIsuNegatif) AS lksIsuNegatif");
        $this->db->select("UPPER(sentimen_tb.stIsuNeutral) AS lksIsuNeutral");
        $this->db->select("sentimen_tb.stIsuAlasan AS lksIsuAlasan");

        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->where('stTapisan', 'Terima');

        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();

        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanJantina($senaraiNegeri){
        $this->db->select('UPPER(sentimen_tb.stJantina) AS jantina');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Positif" AND stJantina = jantina) AS bilanganPositif');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Neutral" AND stJantina = jantina) AS bilanganNeutral');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Negatif" AND stJantina = jantina) AS bilanganNegatif');
        $this->db->select('COUNT(sentimen_tb.stJantina) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('sentimen_tb.stJantina !=', '');
        $this->db->group_by('jantina');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanKaum($senaraiNegeri){
        $this->db->select('UPPER(sentimen_tb.stKaum) AS kaum');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where UPPER(stSentimen) = "POSITIF" AND stKaum = kaum) AS bilanganPositif');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where UPPER(stSentimen) = "NEUTRAL" AND stKaum = kaum) AS bilanganNeutral');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where UPPER(stSentimen) = "NEGATIF" AND stKaum = kaum) AS bilanganNegatif');
        $this->db->select('COUNT(sentimen_tb.stKaum) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('sentimen_tb.stKaum !=', '');
        $this->db->group_by('kaum');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanUmur($senaraiNegeri){
        $this->db->select('UPPER(sentimen_tb.stUmur) AS umur');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Positif" AND stUmur = umur) AS bilanganPositif');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Neutral" AND stUmur = umur) AS bilanganNeutral');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Negatif" AND stUmur = umur) AS bilanganNegatif');
        $this->db->select('COUNT(sentimen_tb.stUmur) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('sentimen_tb.stUmur !=', '');
        $this->db->group_by('umur');
        $this->db->order_by('umur', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanPekerjaan($senaraiNegeri){
        $this->db->select('UPPER(sentimen_tb.stPekerjaan) AS pekerjaan');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Positif" AND stPekerjaan = pekerjaan) AS bilanganPositif');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Neutral" AND stPekerjaan = pekerjaan) AS bilanganNeutral');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Negatif" AND stPekerjaan = pekerjaan) AS bilanganNegatif');
        $this->db->select('COUNT(sentimen_tb.stPekerjaan) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('sentimen_tb.stPekerjaan !=', '');
        $this->db->group_by('pekerjaan');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanKawasan($senaraiNegeri){
        $this->db->select('UPPER(sentimen_tb.stKawasan) AS kawasan');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Positif" AND stKawasan = kawasan) AS bilanganPositif');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Neutral" AND stKawasan = kawasan) AS bilanganNeutral');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Negatif" AND stKawasan = kawasan) AS bilanganNegatif');
        $this->db->select('COUNT(sentimen_tb.stKawasan) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('sentimen_tb.stKawasan !=', '');
        $this->db->group_by('kawasan');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanDun($senaraiNegeri){
        $this->db->select('UPPER(dun_tb.dun_nama) AS dunNama');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb B where B.stSentimen = "Positif" AND B.stDunBil = dun_tb.dun_bil) AS bilanganPositif');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb C where C.stSentimen = "Neutral" AND C.stDunBil = dun_tb.dun_bil) AS bilanganNeutral');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb D where D.stSentimen = "Negatif" AND D.stDunBil = dun_tb.dun_bil) AS bilanganNegatif');
        $this->db->select('COUNT(dun_tb.dun_nama) as bilanganLaporan');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->join('negeri_tb', 'UPPER(negeri_tb.nt_nama) = UPPER(dun_tb.dun_negeri)', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->group_start();
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'POSITIF');
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'NEUTRAL');
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'NEGATIF');
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('dun_tb.dun_nama !=', '');
        $this->db->group_by('dunNama');
        $this->db->order_by('dunNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanParlimen($senaraiNegeri){
        $this->db->select('UPPER(parlimen_tb.pt_nama) AS parlimenNama');
        $this->db->select('(SELECT COUNT(A.stParlimenBil) FROM sentimen_tb A where A.stSentimen = "Positif" AND A.stParlimenBil = parlimen_tb.pt_bil) AS bilanganPositif');
        $this->db->select('(SELECT COUNT(B.stParlimenBil) FROM sentimen_tb B where B.stSentimen = "Neutral" AND B.stParlimenBil = parlimen_tb.pt_bil) AS bilanganNeutral');
        $this->db->select('(SELECT COUNT(C.stParlimenBil) FROM sentimen_tb C where C.stSentimen = "Negatif" AND C.stParlimenBil = parlimen_tb.pt_bil) AS bilanganNegatif');
        $this->db->select('COUNT(parlimen_tb.pt_nama) as bilanganLaporan');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('negeri_tb', 'UPPER(negeri_tb.nt_nama) = UPPER(parlimen_tb.pt_negeri)', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->group_start();
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'POSITIF');
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'NEUTRAL');
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'NEGATIF');
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('parlimen_tb.pt_nama !=', '');
        $this->db->group_by('parlimenNama');
        $this->db->order_by('parlimenNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanNegeri($senaraiNegeri){
        $this->db->select('UPPER(sentimen_tb.stSentimen) AS sentimen');
        $this->db->select('COUNT(sentimen_tb.stSentimen) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('sentimen_tb.stSentimen !=', '');
        $this->db->group_start();
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'POSITIF');
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'NEUTRAL');
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'NEGATIF');
        $this->db->group_end();
        $this->db->group_by('sentimen');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanDaerah($senaraiNegeri){
        $this->db->select('UPPER(daerah.nama) AS daerahNama');
        $this->db->select('(SELECT COUNT(A.stDaerahBil) FROM sentimen_tb A where A.stSentimen = "Positif" AND A.stDaerahBil = daerah.bil) AS bilanganPositif');
        $this->db->select('(SELECT COUNT(B.stDaerahBil) FROM sentimen_tb B where B.stSentimen = "Neutral" AND B.stDaerahBil = daerah.bil) AS bilanganNeutral');
        $this->db->select('(SELECT COUNT(C.stDaerahBil) FROM sentimen_tb C where C.stSentimen = "Negatif" AND C.stDaerahBil = daerah.bil) AS bilanganNegatif');
        $this->db->select('COUNT(*) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->group_start();
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'POSITIF');
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'NEUTRAL');
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'NEGATIF');
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('daerah.nama !=', '');
        $this->db->group_by('daerahNama');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanOrganisasi($senaraiNegeri){
        $this->db->select('UPPER(pengguna_tb.pengguna_tempat_tugas) AS pelaporPenempatan');
        $this->db->select('COUNT(pengguna_tb.pengguna_tempat_tugas) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('pengguna_tb.pengguna_tempat_tugas !=', '');
        $this->db->group_by('pelaporPenempatan');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanPelapor($senaraiNegeri){
        $this->db->select('UPPER(pengguna_tb.nama_penuh) AS pelaporNama');
        $this->db->select('COUNT(pengguna_tb.nama_penuh) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('pengguna_tb.nama_penuh !=', '');
        $this->db->group_by('pelaporNama');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanMingguan($senaraiNegeri){
        $this->db->select('YEARWEEK(sentimen_tb.stTarikhLaporan,1) AS minggu');
        $this->db->select('COUNT(YEARWEEK(sentimen_tb.stTarikhLaporan,1)) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->group_by('minggu');
        $this->db->order_by('minggu', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function bilanganLaporanTahunKeseluruhan($perananBil, $tahun){
        $this->db->select('COUNT(*) AS bilanganLaporan');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $perananBil);
        $this->db->where('YEAR(stTarikhLaporan)', $tahun);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function bilanganLaporanTahun($penggunaBil, $tahun){
        $this->db->select('COUNT(*) AS bilanganLaporan');
        $this->db->where('stPelaporBil', $penggunaBil);
        $this->db->where('YEAR(stTarikhLaporan)', $tahun);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senaraiCarian()
    {
        //INTIALIZATION
        $this->checkTableExists();

        //FILTERING
        $tarikhMula = $this->input->post('inputTarikhMula');
        $tarikhTamat = $this->input->post('inputTarikhTamat');
        $kawasan = $this->input->post('inputKawasan');
        $pekerjaan = $this->input->post('inputPekerjaan');
        $julatUmur = $this->input->post('inputJulatUmur');
        $kaum = $this->input->post('inputKaum');
        $sentimen = $this->input->post('inputSentimen');
        $negeri = $this->input->post('inputNegeri');

        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->where('stTapisan', 'Terima');
        
        //WHERE FILTERING
        //1. FILTERING WAJIB
        $this->db->where('DATE(stPenggunaWaktu) >=', $tarikhMula);
        $this->db->where('DATE(stPenggunaWaktu) <=', $tarikhTamat);
        //2. FILTERING KALAU ADA
        if($kawasan != 'Semua'){
            $this->db->where('stKawasan', $kawasan);
        }
        if($pekerjaan != 'Semua'){
            $this->db->where('stPekerjaan', $pekerjaan);
        }
        if($julatUmur != 'Semua'){
            $this->db->where('stUmur', $julatUmur);
        }
        if($kaum != 'Semua'){
            $this->db->where('stKaum', $kaum);
        }
        if($sentimen != 'Semua'){
            $this->db->where('stSentimen', $sentimen);
        }
        if($negeri != 'Semua'){
            $this->db->where('negeri_tb.nt_bil', $negeri);
        }

        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiCarian2()
    {
        //INTIALIZATION
        $this->checkTableExists();

        //FILTERING
        $tarikhMula = $this->input->post('inputTarikhMula');
        $tarikhTamat = $this->input->post('inputTarikhTamat');
        $kawasan = $this->input->post('inputKawasan');
        $pekerjaan = $this->input->post('inputPekerjaan');
        $julatUmur = $this->input->post('inputJulatUmur');
        $kaum = $this->input->post('inputKaum');
        $sentimen = $this->input->post('inputSentimen');
        $negeri = $this->input->post('inputNegeri');

        
        $this->db->select("sentimen_tb.stBil AS lksBil");
        $this->db->select("sentimen_tb.stPenggunaWaktu AS lksTimestamp");
        $this->db->select("pengguna_tb.emel AS penggunaEmel");
        $this->db->select("sentimen_tb.stTarikhLaporan AS lksTarikhLaporan");
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS penggunaNama");
        $this->db->select("pengguna_tb.no_tel AS penggunaNoTel");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS negeriNama");
        $this->db->select("UPPER(daerah.nama) AS daerahNama");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("UPPER(dun_tb.dun_nama) AS dunNama");
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS lksKawasan");
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS lksPekerjaan");
        $this->db->select("sentimen_tb.stUmur AS lksUmur");
        $this->db->select("UPPER(sentimen_tb.stKaum) AS lksKaum");
        $this->db->select("UPPER(sentimen_tb.stJantina) AS lksJantina");
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS lksSentimen");
        $this->db->select("UPPER(sentimen_tb.stPerkara) AS lksPerkara");
        $this->db->select("sentimen_tb.stAlasan AS lksUlasan");
        $this->db->select("UPPER(sentimen_tb.stTapisan) AS lksTapisan");

        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->where('stTapisan', 'Terima');
        
        //WHERE FILTERING
        //1. FILTERING WAJIB
        $this->db->where('DATE(stPenggunaWaktu) >=', $tarikhMula);
        $this->db->where('DATE(stPenggunaWaktu) <=', $tarikhTamat);
        //2. FILTERING KALAU ADA
        if($kawasan != 'Semua'){
            $this->db->where('stKawasan', $kawasan);
        }
        if($pekerjaan != 'Semua'){
            $this->db->where('stPekerjaan', $pekerjaan);
        }
        if($julatUmur != 'Semua'){
            $this->db->where('stUmur', $julatUmur);
        }
        if($kaum != 'Semua'){
            $this->db->where('stKaum', $kaum);
        }
        if($sentimen != 'Semua'){
            $this->db->where('stSentimen', $sentimen);
        }
        if($negeri != 'Semua'){
            $this->db->where('negeri_tb.nt_bil', $negeri);
        }

        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiSentimen(){
        $this->db->select('stSentimen');
        $this->db->group_by('stSentimen');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiKaum(){
        $this->db->select('stKaum');
        $this->db->group_by('stKaum');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiJulatUmur(){
        $this->db->select('stUmur');
        $this->db->group_by('stUmur');
        $query = $this->db->get($this->table);
        return $query->result();
    }


    public function senaraiPekerjaan(){
        $this->db->select('stPekerjaan');
        $this->db->group_by('stPekerjaan');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiKawasan(){
        $this->db->select('stKawasan');
        $this->db->group_by('stKawasan');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiIkutNegeri($namaNegeri)
    {
        $this->checkTableExists();
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->where('negeri_tb.nt_nama', $namaNegeri);
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function satuTarikh($tarikh)
    {
        $this->checkTableExists();
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil');
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('DATE(stPenggunaWaktu)', $tarikh);
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function semuaTanpaTapisan()
    {
        $this->checkTableExists();
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil');
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function draf($sentimenBil){
        $this->checkTableExists();
        $data = array(
            'stTapisan' => 'Draf'
        );
        $this->db->where('stBil', $sentimenBil);
        $this->db->update($this->table, $data);
    }

    public function terima($sentimenBil){
        $this->checkTableExists();
        $data = array(
            'stTapisan' => 'Terima'
        );
        $this->db->where('stBil', $sentimenBil);
        $this->db->update($this->table, $data);
    }

    public function tapisan()
    {
        $this->checkTableExists();
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil');
        $this->db->where('stTapisan', 'Hantar');
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function semua()
    {
        $this->checkTableExists();
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil');
        $this->db->where('stTapisan', 'Terima');
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kemaskini(){
        $this->checkTableExists();
        $data = array(
            'stTarikhLaporan' => date_format(date_create($this->input->post('inputTarikhLaporan')), 'Y-m-d'),
            'stPelaporBil' => $this->input->post('inputPelaporBil'),
            'stDaerahBil' => $this->input->post('inputDaerahBil'),
            'stParlimenBil' => $this->input->post('inputParlimenBil'),
            'stDunBil' => $this->input->post('inputDunBil'),
            'stKawasan' => $this->input->post('inputKawasan'),
            'stSentimen' => $this->input->post('inputSentimen'),
            'stAlasan' => $this->input->post('inputAlasan'),
            'stPekerjaan' => $this->input->post('inputPekerjaan'),
            'stUmur' => $this->input->post('inputUmur'),
            'stKaum' => $this->input->post('inputKaum'),
            'stJantina' => $this->input->post('inputJantina'),
            'stPenggunaBil' => $this->input->post('inputPenggunaBil'),
            'stPenggunaWaktu' => date_format(date_create($this->input->post('inputPenggunaWaktu')), 'Y-m-d H:i:s'),
            'stTapisan' => 'Terima'
        );
        $this->db->where('stBil', $this->input->post('inputBil'));
        $this->db->update($this->table, $data);
    }

    public function sentimen($sentimenBil)
    {
        $this->checkTableExists();
        $this->db->where('stBil', $sentimenBil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senaraiIkutPeranan($perananBil)
    {
        $this->checkTableExists();
        $this->db->select("sentimen_tb.stBil AS lksBil");
        $this->db->select("sentimen_tb.stPenggunaWaktu AS lksTimestamp");
        $this->db->select("pengguna_tb.emel AS penggunaEmel");
        $this->db->select("sentimen_tb.stTarikhLaporan AS lksTarikhLaporan");
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS penggunaNama");
        $this->db->select("pengguna_tb.no_tel AS penggunaNoTel");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS negeriNama");
        $this->db->select("UPPER(daerah.nama) AS daerahNama");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("UPPER(dun_tb.dun_nama) AS dunNama");
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS lksKawasan");
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS lksPekerjaan");
        $this->db->select("sentimen_tb.stUmur AS lksUmur");
        $this->db->select("UPPER(sentimen_tb.stKaum) AS lksKaum");
        $this->db->select("UPPER(sentimen_tb.stJantina) AS lksJantina");
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS lksSentimen");
        $this->db->select("UPPER(sentimen_tb.stPerkara) AS lksPerkara");
        $this->db->select("sentimen_tb.stAlasan AS lksUlasan");
        $this->db->select("UPPER(sentimen_tb.stTapisan) AS lksTapisan");
        $this->db->select("sentimen_tb.stIsuPositif AS lksIsuPositif");
        $this->db->select("sentimen_tb.stIsuNegatif AS lksIsuNegatif");
        $this->db->select("sentimen_tb.stIsuNeutral AS lksIsuNeutral");
        $this->db->select("sentimen_tb.stIsuAlasan AS lksIsuAlasan");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $perananBil);
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function namaIsu($isuBil){
        $this->db->where('sit_bil', $isuBil);
        $query = $this->db->get($this->tableIsu);
        $row = $query->row();
        return $row->sit_isu;
    }

    public function tambah() {
        $this->db->trans_start();
        $this->checkTableExists();

        // --- Handle "Lain-lain" inputs ---
        $pekerjaan = $this->input->post('inputPekerjaan');
        if ($pekerjaan == "Lain-lain") {
            $pekerjaan = $this->input->post('inputPekerjaanLain');
        }

        $kaum = $this->input->post('inputKaum');
        if ($kaum == 'Lain-lain') {
            $kaum = $this->input->post('inputKaumLain');
        }

        // --- Insert Main Report Data ---
        $data = array(
            'stTarikhLaporan' => date_format(date_create($this->input->post('inputTarikhLaporan')), 'Y-m-d'),
            'stPelaporBil' => $this->input->post('inputPelaporBil'),
            'stDaerahBil' => $this->input->post('inputDaerahBil'),
            'stParlimenBil' => $this->input->post('inputParlimenBil'),
            'stDunBil' => $this->input->post('inputDunBil'),
            'stKawasan' => $this->input->post('inputKawasan'),
            'stSentimen' => $this->input->post('inputSentimen'),
            'stAlasan' => $this->input->post('inputAlasan'),
            'stPerkara' => $this->input->post('inputJenisPersepsi'),
            'stPekerjaan' => $pekerjaan,
            'stUmur' => $this->input->post('inputUmur'),
            'stKaum' => $kaum,
            'stJantina' => $this->input->post('inputJantina'),
            'stPenggunaBil' => $this->input->post('inputPenggunaBil'),
            'stPenggunaWaktu' => date_format(date_create($this->input->post('inputPenggunaWaktu')), 'Y-m-d H:i:s'),
            'stTapisan' => 'Terima',
            'stIsuAlasan' => $this->input->post('inputIsuAlasan')
        );
        $this->db->insert($this->table, $data);
        $laporanBil = $this->db->insert_id();

        // --- Process and Insert Issue Data (Optimized Single Loop) ---
        $senaraiIsu = $this->input->post('inputIsu');
        $senaraiAlasanIsu = $this->input->post('inputAlasanIsu');
        
        // Initialize all arrays before the loop
        $dataIsu = [];
        $isuPositif = [];
        $isuNegatif = [];
        $isuNeutral = [];
        
        if (!empty($senaraiIsu)) {
            foreach ($senaraiIsu as $isuBil => $sentimen) {
                $namaIsu = $this->namaIsu($isuBil);
                $ulasan = isset($senaraiAlasanIsu[$isuBil]) ? $senaraiAlasanIsu[$isuBil] : '';

                // 1. Prepare data for batch insert
                $dataIsu[] = array(
                    'sdi_sentimen_bil' => $laporanBil,
                    'sdi_isu' => $namaIsu,
                    'sdi_sentimen' => $sentimen,
                    'sdi_alasan' => $ulasan
                );

                // 2. Simultaneously sort issue names by sentiment
                if ($sentimen == 'Negatif') {
                    $isuNegatif[] = $namaIsu;
                } else if ($sentimen == 'Positif') {
                    $isuPositif[] = $namaIsu;
                } else {
                    $isuNeutral[] = $namaIsu;
                }
            }
            
            // Perform the batch insert if data exists
            $this->db->insert_batch($this->tableDapatIsu, $dataIsu);
        }
        
        // --- Update Main Report with Aggregated Issues (Optimized Single Query) ---
        $updateData = [];
        if (!empty($isuPositif)) {
            $updateData['stIsuPositif'] = implode(', ', array_unique($isuPositif));
        }
        if (!empty($isuNegatif)) {
            $updateData['stIsuNegatif'] = implode(', ', array_unique($isuNegatif));
        }
        if (!empty($isuNeutral)) {
            $updateData['stIsuNeutral'] = implode(', ', array_unique($isuNeutral));
        }

        // Run a single update query if there's anything to add
        if (!empty($updateData)) {
            $this->db->where('stBil', $laporanBil);
            $this->db->update($this->table, $updateData);
        }

        // --- Complete Transaction ---
        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    private function checkTableExists()
    {   
        $this->load->dbforge();

        //TIADA TABLE
        if($this->db->table_exists($this->table) == FALSE){
            $fields = array(
                'stBil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'stTarikhLaporan' => array(
                        'type' => 'DATE',
                        'null' => TRUE
                ),
                'stPelaporBil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'stDaerahBil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'stParlimenBil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'stDunBil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'stKawasan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'stSentimen' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'stAlasan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'stPenggunaBil' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'null' => TRUE
                ),
                'stPenggunaWaktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                ),
                'stTapisan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'null' => TRUE
                ),
                'stPekerjaan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'stUmur' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'stKaum' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'stJantina' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('stBil', TRUE);
            $this->dbforge->create_table($this->table, TRUE);
        }

        //ADA TABLE
        if($this->db->table_exists($this->table) == TRUE){
            if ($this->db->field_exists('stPerkara', $this->table) == FALSE)
            {   
                $field5 = array(
                    'stPerkara' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($this->table, $field5);
            }
            if ($this->db->field_exists('stPekerjaan', $this->table) == FALSE)
            {   
                $field4 = array(
                    'stPekerjaan' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($this->table, $field4);
            }
            if ($this->db->field_exists('stUmur', $this->table) == FALSE)
            {   
                $field3 = array(
                    'stUmur' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($this->table, $field3);
            }
            if ($this->db->field_exists('stKaum', $this->table) == FALSE)
            {   
                $field2 = array(
                    'stKaum' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($this->table, $field2);
            }
            if ($this->db->field_exists('stJantina', $this->table) == FALSE)
            {   
                $field1 = array(
                    'stJantina' => array(
                        'type' => 'VARCHAR',
                        'constraint' => 50,
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($this->table, $field1);
            }
        }
    }

}
?>