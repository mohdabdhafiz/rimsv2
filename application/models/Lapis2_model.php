<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Lapis2 Model
 * * This model is responsible for all database interactions for the 'lapis_tb' table.
 * It handles creating, reading, updating, and deleting (CRUD) reports.
 *
 * @author     MOHD ABD HAFIZ BIN AWANG
 * @version    2.0
 */
class Lapis2_model extends CI_Model
{
    protected $tableName = 'lapis_tb';

    /**
     * Mendapatkan statistik kiraan laporan (jumlah, diterima, dipinda, ditolak)
     * untuk satu kluster spesifik.
     * @param int $kluster_bil Nombor siri kluster.
     * @return object
     */
    public function dapatkan_statistik_laporan_kluster($kluster_bil)
    {
        $this->db->select([
            'COUNT(*) AS jumlah_laporan',
            "COUNT(CASE WHEN lapis_status = 'Laporan Diterima' THEN 1 END) AS diterima",
            "COUNT(CASE WHEN lapis_status = 'Laporan Dipinda' THEN 1 END) AS dipinda",
            "COUNT(CASE WHEN lapis_status = 'Laporan Ditolak' THEN 1 END) AS ditolak"
        ]);
        $this->db->from('lapis_tb'); // Pastikan nama jadual betul
        $this->db->where('lapis_kluster_bil', $kluster_bil);

        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Mendapatkan senarai penuh laporan berdasarkan nombor siri kluster.
     * @param int $kluster_bil Nombor siri kluster.
     * @return array
     */
    public function laporan_mengikut_kluster($kluster_bil)
    {
        // Contoh query asas. Anda boleh tambah JOIN untuk dapatkan nama pelapor, dll.
        $this->db->where('lapis_kluster_bil', $kluster_bil);
        $this->db->order_by('lapis_tarikh_laporan', 'DESC');
        $query = $this->db->get('lapis_tb'); // Pastikan nama jadual betul
        return $query->result();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->dbforge(); // Load dbforge library
    }

    //======================================================================
    // SCHEMA MIGRATION
    //======================================================================

    /**
     * update20250716
     * A function to manually trigger table creation.
     * NOTE: It's highly recommended to use CodeIgniter's official Migration feature
     * for managing database schema changes in a production environment.
     * This keeps your database schema version-controlled.
     */
    public function update20250716(){
        $this->binaTable();
    }

    /**
     * Creates the 'lapis_tb' table if it doesn't exist.
     * Defines the entire schema for LAPIS 2.0 reports.
     */
    private function binaTable(){
        if ($this->db->table_exists($this->tableName)) {
            // KEMAS KINI: Tambah lajur status jika belum wujud
            if (!$this->db->field_exists('lapis_status', $this->tableName)) {
                $fields = [
                    'lapis_status' => [
                        'type' => 'VARCHAR',
                        'constraint' => '50',
                        'null' => TRUE,
                        'default' => 'Laporan Diterima'
                    ]
                ];
                $this->dbforge->add_column($this->tableName, $fields);
            }
            // KEMAS KINI: Tambah lajur ulasan tolak jika belum wujud
            if (!$this->db->field_exists('lapis_ulasan_tolak', $this->tableName)) {
                $this->dbforge->add_column($this->tableName, [
                    'lapis_ulasan_tolak' => ['type' => 'TEXT', 'null' => TRUE]
                ]);
            }
            return;
        }

        if ($this->db->table_exists($this->tableName)) {
            return; // Do nothing if table already exists
        }

        $fields = [
            'lapis_bil' => ['type' => 'BIGINT', 'constraint' => 20, 'null' => FALSE, 'auto_increment' => TRUE],
            'lapis_kluster_bil' => ['type' => 'BIGINT', 'constraint' => 20, 'null' => FALSE],
            'lapis_kluster_nama' => ['type' => 'TEXT', 'null' => TRUE],
            'lapis_tarikh_laporan_bil' => ['type' => 'BIGINT', 'constraint' => 20, 'null' => TRUE],
            'lapis_tarikh_laporan_dibina' => ['type' => 'DATETIME', 'null' => TRUE],
            'lapis_tarikh_laporan' => ['type' => 'DATE', 'null' => TRUE],
            'lapis_pelapor_bil' => ['type' => 'BIGINT', 'constraint' => 20, 'null' => TRUE],
            'lapis_pelapor_nama' => ['type' => 'TEXT', 'null' => TRUE],
            'lapis_negeri_bil' => ['type' => 'BIGINT', 'constraint' => 20, 'null' => TRUE],
            'lapis_negeri_nama' => ['type' => 'TEXT', 'null' => TRUE],
            'lapis_daerah_bil' => ['type' => 'BIGINT', 'constraint' => 20, 'null' => TRUE],
            'lapis_daerah_nama' => ['type' => 'TEXT', 'null' => TRUE],
            'lapis_parlimen_bil' => ['type' => 'BIGINT', 'constraint' => 20, 'null' => TRUE],
            'lapis_parlimen_nama' => ['type' => 'TEXT', 'null' => TRUE],
            'lapis_dun_bil' => ['type' => 'BIGINT', 'constraint' => 20, 'null' => TRUE],
            'lapis_dun_nama' => ['type' => 'TEXT', 'null' => TRUE],
            'lapis_dm_bil' => ['type' => 'BIGINT', 'constraint' => 20, 'null' => TRUE],
            'lapis_dm_nama' => ['type' => 'TEXT', 'null' => TRUE],
            'lapis_jenis_kawasan' => ['type' => 'TEXT', 'null' => TRUE],
            'lapis_tajuk_isu' => ['type' => 'TEXT', 'null' => TRUE],
            'lapis_ringkasan_isu' => ['type' => 'TEXT', 'null' => TRUE],
            'lapis_lokasi' => ['type' => 'TEXT', 'null' => TRUE],
            'lapis_latitude' => ['type' => 'TEXT', 'null' => TRUE],
            'lapis_longitude' => ['type' => 'TEXT', 'null' => TRUE],
            'lapis_cadangan_intervensi' => ['type' => 'TEXT', 'null' => TRUE],
            'lapis_waktu_dibina' => ['type' => 'DATETIME', 'null' => TRUE], // Renamed for clarity
            'lapis_status' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => TRUE, 'default' => 'Laporan Diterima']
        ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('lapis_bil', TRUE); // Set primary key
        $this->dbforge->create_table($this->tableName);
    }

    //======================================================================
    // CRUD FUNCTIONS (Create, Read, Update, Delete)
    //======================================================================

    /**
     * Inserts a new report into the database.
     *
     * @param  array $data The report data to be inserted.
     * @return int   The ID of the newly inserted report.
     */
    public function tambah_laporan($data)
    {
        // Logic to add a new report
        $this->db->insert($this->tableName, $data);
        return $this->db->insert_id();
    }

    /**
     * Mendapatkan senarai laporan. Boleh ditapis.
     *
     * @param  array $filters Kriteria carian (pilihan).
     * @return array Senarai objek laporan.
     */
    public function dapatkan_laporan($filters = [])
    {
        $this->db->from($this->tableName);

        // Menambah logik penapisan berdasarkan input dari borang carian
        if (!empty($filters['tarikhMula'])) {
            $this->db->where('lapis_tarikh_laporan >=', $filters['tarikhMula']);
        }
        if (!empty($filters['tarikhAkhir'])) {
            $this->db->where('lapis_tarikh_laporan <=', $filters['tarikhAkhir']);
        }
        if (!empty($filters['pelapor'])) {
            $this->db->where('lapis_pelapor_bil', $filters['pelapor']);
        }
        if (!empty($filters['negeri'])) {
            $this->db->where('lapis_negeri_bil', $filters['negeri']);
        }
        if (!empty($filters['daerah'])) {
            $this->db->where('lapis_daerah_bil', $filters['daerah']);
        }
        if (!empty($filters['parlimen'])) {
            $this->db->where('lapis_parlimen_bil', $filters['parlimen']);
        }
        if (!empty($filters['dun'])) {
            $this->db->where('lapis_dun_bil', $filters['dun']);
        }
        if (!empty($filters['dm'])) {
            $this->db->where('lapis_dm_bil', $filters['dm']);
        }
        if (!empty($filters['jenisKawasan'])) {
            $this->db->where('lapis_jenis_kawasan', $filters['jenisKawasan']);
        }
        if (!empty($filters['kluster'])) {
            $this->db->where('lapis_kluster_bil', $filters['kluster']);
        }
        if (!empty($filters['status'])) {
            $this->db->where('lapis_status', $filters['status']);
        }
        if (!empty($filters['isu'])) {
            $this->db->like('lapis_tajuk_isu', $filters['isu']);
        }

        $this->db->order_by('lapis_tarikh_laporan', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Updates an existing report.
     *
     * @param  int   $id   The primary key of the report to update.
     * @param  array $data The new data for the report.
     * @return bool  TRUE on success, FALSE on failure.
     */
    public function kemaskini_laporan($id, $data)
    {
        // Logic to update a report
        $this->db->where('lapis_bil', $id);
        return $this->db->update($this->tableName, $data);
    }

    /**
     * Deletes a report from the database.
     *
     * @param  int  $id The primary key of the report to delete.
     * @return bool TRUE on success, FALSE on failure.
     */
    public function padam_laporan($id)
    {
        // Logic to delete a report
        $this->db->where('lapis_bil', $id);
        return $this->db->delete($this->tableName);
    }

    /**
     * Alias untuk fungsi dapatkan_laporan untuk keserasian dengan controller.
     */
    public function dapatkan_laporan_carian($filters)
    {
        return $this->dapatkan_laporan($filters);
    }

    /**
     * FUNGSI BARU: Mendapatkan satu laporan berdasarkan ID.
     * Fungsi ini akan dipanggil oleh controller lihatLaporan().
     */
    public function dapatkan_satu_laporan($laporan_bil)
    {
        $this->db->from($this->tableName);
        $this->db->where('lapis_bil', $laporan_bil);
        $query = $this->db->get();
        return $query->row(); // Menggunakan row() untuk mendapatkan satu rekod sahaja
    }

    /**
     * FUNGSI BARU: Mendapatkan laporan terkini untuk paparan aktiviti.
     */
    public function dapatkan_laporan_terkini($limit = 5)
    {
        $this->db->from($this->tableName);
        $this->db->order_by('lapis_waktu_dibina', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    //======================================================================
    // FUNGSI DASHBOARD (DIKEMAS KINI DENGAN PENAPIS TARIKH)
    //======================================================================

    /**
     * Fungsi helper untuk menambah klausa WHERE tarikh pada query.
     */
    private function _set_date_filters($filters)
    {
        if (!empty($filters['tarikhMula'])) {
            $this->db->where('lapis_tarikh_laporan >=', $filters['tarikhMula']);
        }
        if (!empty($filters['tarikhTamat'])) {
            $this->db->where('lapis_tarikh_laporan <=', $filters['tarikhTamat']);
        }
    }

    /**
     * Mengira jumlah laporan, dengan pilihan penapis tarikh.
     */
    public function kira_jumlah_laporan($filters = [])
    {
        $this->_set_date_filters($filters);
        return $this->db->count_all_results($this->tableName);
    }

    /**
     * Mendapatkan pecahan laporan mengikut kluster, dengan pilihan penapis tarikh.
     */
    public function dapatkan_pecahan_kluster($filters = [])
    {
        $this->db->select('lapis_kluster_nama, COUNT(lapis_bil) as jumlah');
        $this->db->from($this->tableName);
        $this->_set_date_filters($filters); // Guna fungsi helper
        $this->db->group_by('lapis_kluster_nama');
        $this->db->order_by('jumlah', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Mendapatkan isu-isu utama bagi setiap kluster, dengan pilihan penapis tarikh.
     */
    public function dapatkan_isu_utama_kluster($kluster_nama, $limit = 5, $filters = [])
    {
        $this->db->select('lapis_tajuk_isu, COUNT(lapis_bil) as jumlah');
        $this->db->from($this->tableName);
        $this->db->where('lapis_kluster_nama', $kluster_nama);
        $this->_set_date_filters($filters); // Guna fungsi helper
        $this->db->group_by('lapis_tajuk_isu');
        $this->db->order_by('jumlah', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Mendapatkan prestasi pelaporan mengikut negeri dan kluster.
     */
    public function dapatkan_prestasi_negeri($filters = [])
    {
        $this->db->select('lapis_negeri_nama as negeri, lapis_kluster_nama as kluster, COUNT(lapis_bil) as jumlah');
        $this->db->from($this->tableName);
        
        // Guna fungsi helper untuk penapis tarikh
        $this->_set_date_filters($filters);

        $this->db->group_by(['lapis_negeri_nama', 'lapis_kluster_nama']);
        $this->db->order_by('lapis_negeri_nama', 'ASC');
        $query = $this->db->get();
        $result = $query->result();

        // Proses data mentah menjadi format jadual
        $prestasi = [];
        foreach ($result as $row) {
            if (!isset($prestasi[$row->negeri])) {
                $prestasi[$row->negeri] = [
                    'POLITIK' => 0, 'EKONOMI' => 0, 'SOSIAL' => 0, 'KESELAMATAN' => 0,
                    'FASILITI AWAM' => 0, 'TELEKOMUNIKASI' => 0, 'ALAM SEKITAR' => 0, 'KESIHATAN' => 0,
                    'JUMLAH' => 0
                ];
            }
            if (array_key_exists(strtoupper($row->kluster), $prestasi[$row->negeri])) {
                 $prestasi[$row->negeri][strtoupper($row->kluster)] = $row->jumlah;
            }
            $prestasi[$row->negeri]['JUMLAH'] += $row->jumlah;
        }
        return $prestasi;
    }

    /**
     * FUNGSI BARU: Mengira jumlah laporan mengikut status.
     */
    public function dapatkan_prestasi_status()
    {
        $this->db->select('lapis_status, COUNT(lapis_bil) as jumlah');
        $this->db->from($this->tableName);
        $this->db->group_by('lapis_status');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * FUNGSI BARU: Mendapatkan prestasi pelaporan mengikut negeri dan status.
     */
    public function dapatkan_prestasi_negeri_by_status($filters = [])
    {
        $this->db->select('lapis_negeri_nama as negeri, lapis_status as status, COUNT(lapis_bil) as jumlah');
        $this->db->from($this->tableName);
        
        // Guna fungsi helper untuk penapis tarikh
        $this->_set_date_filters($filters);

        $this->db->where('lapis_negeri_nama IS NOT NULL');
        $this->db->group_by(['lapis_negeri_nama', 'lapis_status']);
        $this->db->order_by('lapis_negeri_nama', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

     /**
     * Mengira jumlah semua laporan dalam jadual lapis_tb.
     */
    public function kira_semua()
    {
        // 'lapis_tb' adalah nama jadual anda. Sila ubah jika berbeza.
        return $this->db->count_all('lapis_tb');
    }

    /**
     * Mengira jumlah laporan berdasarkan status tertentu (cth: 'Ditolak').
     * @param string $status Status laporan yang ingin dikira.
     */
    public function kira_mengikut_status($status)
    {
        $this->db->where('lapis_status', $status);
        return $this->db->count_all_results('lapis_tb');
    }

    /**
     * Mengira jumlah laporan berdasarkan nombor siri kluster.
     * @param int $kluster_bil Nombor siri (ID) bagi kluster.
     */
    public function kira_mengikut_kluster($kluster_bil)
    {
        $this->db->where('lapis_kluster_bil', $kluster_bil);
        return $this->db->count_all_results('lapis_tb');
    }
    
}
