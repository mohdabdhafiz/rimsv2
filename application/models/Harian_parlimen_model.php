<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harian_parlimen_model extends CI_Model {

    protected $table = 'harian_parlimen_tb';
    protected $dm_harian = 'harian_dm_parlimen_tb';

    public function kedudukanTerkini($pilihanrayaBil){
        $columns = [
            "UPPER(parlimen_tb.pt_nama) AS kawasanNama",
            "harian_parlimen_tb.harian_parlimen_tarikh AS harianTarikh",
            "harian_parlimen_tb.harian_parlimen_color AS color",
            "harian_parlimen_tb.harian_parlimen_atas_pagar AS atasPagar",
            "harian_parlimen_tb.harian_parlimen_grading AS grading",
            "harian_parlimen_tb.harian_parlimen_ulasan AS ulasan",
            "harian_parlimen_tb.harian_parlimen_keluar_mengundi AS keluarMengundi",
            "UPPER(pengguna_tb.nama_penuh) AS pelaporNama"
        ];
    
        // Select columns
        $this->db->select($columns);

        $this->db->join("pilihanraya_tb", "pilihanraya_tb.pilihanraya_bil = harian_parlimen_tb.harian_parlimen_pilihanraya", "left");
        $this->db->join("parlimen_tb", "parlimen_tb.pt_bil = harian_parlimen_tb.harian_parlimen_parlimen", "left");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = harian_parlimen_tb.harian_parlimen_pengguna_bil', 'left');
        
        $this->db->where("pilihanraya_tb.pilihanraya_bil", $pilihanrayaBil);
        $this->db->where("harian_parlimen_tb.harian_parlimen_tarikh = (
            SELECT MAX(h2.harian_parlimen_tarikh)
            FROM harian_parlimen_tb h2
            WHERE h2.harian_parlimen_parlimen = harian_parlimen_tb.harian_parlimen_parlimen
        )");
        $this->db->group_by("parlimen_tb.pt_bil");
        $this->db->order_by("harian_parlimen_tb.harian_parlimen_tarikh", "DESC");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function bilanganLaporanUtama(){
        $this->db->select("COUNT(*) as bilanganLaporan");
        $query = $this->db->get($this->table);
        return $query->row();
    }


    public function senaraiHarianParlimen($parlimenSenarai){
        $this->db->select("harian_parlimen_tb.harian_parlimen_bil AS hpBil");
        $this->db->select("harian_parlimen_tb.harian_parlimen_tarikh AS hpTarikh");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("UPPER(parlimen_tb.pt_negeri) AS negeriNama");
        $this->db->select("UPPER(pilihanraya_tb.pilihanraya_nama) AS pruNama");
        $this->db->select("harian_parlimen_tb.harian_parlimen_grading AS hpStatus");
        $this->db->select("harian_parlimen_tb.harian_parlimen_atas_pagar AS hpAtasPagar");
        $this->db->select("harian_parlimen_tb.harian_parlimen_keluar_mengundi AS hpKeluarMengundi");
        $this->db->join("parlimen_tb", "parlimen_tb.pt_bil = harian_parlimen_tb.harian_parlimen_parlimen", "left");
        $this->db->join("negeri_tb", "negeri_tb.nt_nama = parlimen_tb.pt_negeri", "left");
        $this->db->join("pilihanraya_tb", "pilihanraya_tb.pilihanraya_bil = harian_parlimen_tb.harian_parlimen_pilihanraya", "left");
        $this->db->group_start();
        foreach($parlimenSenarai as $parlimen){
            $this->db->or_where('parlimen_tb.pt_bil', $parlimen->pt_bil);
        }
        $this->db->group_end();
        $this->db->order_by("hpTarikh", "DESC");
        $this->db->order_by("parlimenNama", "ASC");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiHarianNegeri($senaraiNegeri){
        $this->db->select("harian_parlimen_tb.harian_parlimen_bil AS hpBil");
        $this->db->select("harian_parlimen_tb.harian_parlimen_tarikh AS hpTarikh");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("UPPER(parlimen_tb.pt_negeri) AS negeriNama");
        $this->db->select("UPPER(pilihanraya_tb.pilihanraya_nama) AS pruNama");
        $this->db->select("harian_parlimen_tb.harian_parlimen_grading AS hpStatus");
        $this->db->select("harian_parlimen_tb.harian_parlimen_atas_pagar AS hpAtasPagar");
        $this->db->select("harian_parlimen_tb.harian_parlimen_keluar_mengundi AS hpKeluarMengundi");
        $this->db->join("parlimen_tb", "parlimen_tb.pt_bil = harian_parlimen_tb.harian_parlimen_parlimen", "left");
        $this->db->join("negeri_tb", "negeri_tb.nt_nama = parlimen_tb.pt_negeri", "left");
        $this->db->join("pilihanraya_tb", "pilihanraya_tb.pilihanraya_bil = harian_parlimen_tb.harian_parlimen_pilihanraya", "left");
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->order_by("hpTarikh", "DESC");
        $this->db->order_by("parlimenNama", "ASC");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiHarian(){
        $this->db->select("harian_parlimen_tb.harian_parlimen_bil AS hpBil");
        $this->db->select("harian_parlimen_tb.harian_parlimen_tarikh AS hpTarikh");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("UPPER(parlimen_tb.pt_negeri) AS negeriNama");
        $this->db->select("UPPER(pilihanraya_tb.pilihanraya_nama) AS pruNama");
        $this->db->select("harian_parlimen_tb.harian_parlimen_grading AS hpStatus");
        $this->db->select("harian_parlimen_tb.harian_parlimen_atas_pagar AS hpAtasPagar");
        $this->db->select("harian_parlimen_tb.harian_parlimen_keluar_mengundi AS hpKeluarMengundi");
        $this->db->join("parlimen_tb", "parlimen_tb.pt_bil = harian_parlimen_tb.harian_parlimen_parlimen", "left");
        $this->db->join("pilihanraya_tb", "pilihanraya_tb.pilihanraya_bil = harian_parlimen_tb.harian_parlimen_pilihanraya", "left");
        $this->db->order_by("hpTarikh", "DESC");
        $this->db->order_by("parlimenNama", "ASC");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiGradingParlimen(){
        $this->db->select("harian_parlimen_tb.harian_parlimen_bil AS nomborSiri");
        $this->db->select("harian_parlimen_tb.harian_parlimen_tarikh AS tarikhGrading");
        $this->db->select("parlimen_tb.pt_nama AS namaParlimen");
        $this->db->select("pilihanraya_tb.pilihanraya_nama AS namaPru");
        $this->db->select("(SELECT COUNT(*) FROM pencalonan_parlimen_tb AS p WHERE p.pencalonan_parlimen_parlimenBil = parlimen_tb.pt_bil AND p.pencalonan_parlimen_pilihanrayaBil = pilihanraya_tb.pilihanraya_bil) AS bilanganCalon");
        $this->db->select("(SELECT COUNT(*) FROM status_grading_parlimen_tb AS sg WHERE sg.sgpt_parlimen_bil = parlimen_tb.pt_bil AND sg.sgpt_tarikh = tarikhGrading) AS bilanganGrading");
        $this->db->join("parlimen_tb", "parlimen_tb.pt_bil = harian_parlimen_tb.harian_parlimen_parlimen", "left");
        $this->db->join("pilihanraya_tb", "pilihanraya_tb.pilihanraya_bil = harian_parlimen_tb.harian_parlimen_pilihanraya", "left");
        $this->db->order_by("tarikhGrading", "DESC");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikutParlimen($tarikh, $negeri, $pilihanrayaBil){
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = harian_parlimen_tb.harian_parlimen_parlimen');
        $this->db->where('parlimen_tb.pt_negeri', $negeri);
        $this->db->where('DATE(harian_parlimen_tb.harian_parlimen_tarikh)', $tarikh);
        $this->db->where('harian_parlimen_pilihanraya', $pilihanrayaBil);
        $this->db->order_by('harian_parlimen_tb.harian_parlimen_pengguna_waktu', 'DESC');
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $this->db->group_by('harian_parlimen_tb.harian_parlimen_parlimen');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_pilihanraya($pilihanraya_bil){
        $this->db->where('harian_parlimen_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('harian_parlimen_tarikh', 'DESC');
        $this->db->group_by('harian_parlimen_tarikh');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_parlimen_negeri($tarikh, $negeri, $grading, $pilihanrayaBil){
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = harian_parlimen_tb.harian_parlimen_parlimen');
        $this->db->where('parlimen_tb.pt_negeri', $negeri);
        $this->db->where('harian_parlimen_tb.harian_parlimen_grading', $grading);
        $this->db->where('harian_parlimen_tb.harian_parlimen_tarikh', $tarikh);
        $this->db->where('harian_parlimen_tb.harian_parlimen_pilihanraya', $pilihanrayaBil);
        $this->db->order_by('harian_parlimen_tb.harian_parlimen_tarikh', 'DESC');
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $this->db->group_by('harian_parlimen_tb.harian_parlimen_parlimen');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function harian($harian_bil){
        $this->db->select("harian_parlimen_tb.harian_parlimen_bil AS nomborSiri");
        $this->db->select("harian_parlimen_tb.harian_parlimen_tarikh AS tarikh");
        $this->db->select("harian_parlimen_tb.harian_parlimen_grading AS grading");
        $this->db->select("harian_parlimen_tb.harian_parlimen_color AS color");
        $this->db->select("harian_parlimen_tb.harian_parlimen_ulasan AS ulasan");
        $this->db->select("harian_parlimen_tb.harian_parlimen_keluar_mengundi AS keluarMengundi");
        $this->db->select("harian_parlimen_tb.harian_parlimen_pengguna_waktu AS tarikhKemaskini");
        $this->db->select("pengguna_tb.nama_penuh AS namaPelapor");
        $this->db->select("parlimen_tb.pt_nama AS namaParlimen");
        $this->db->select("parlimen_tb.pt_bil AS parlimenBil");
        $this->db->select("pilihanraya_tb.pilihanraya_nama AS namaPru");
        $this->db->select("pilihanraya_tb.pilihanraya_bil AS pruBil");
        $this->db->join('parti_tb', 'parti_tb.parti_bil = harian_parlimen_tb.harian_parlimen_parti', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = harian_parlimen_tb.harian_parlimen_parlimen', 'left');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = harian_parlimen_tb.harian_parlimen_pilihanraya', 'left');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = harian_parlimen_tb.harian_parlimen_pengguna_bil', 'left');
        $this->db->where('harian_parlimen_tb.harian_parlimen_bil', $harian_bil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function hari_ini($parlimen_bil, $pilihanraya_bil, $tarikh)
    {
        $this->db->where('harian_parlimen_parlimen', $parlimen_bil);
        $this->db->where('harian_parlimen_pilihanraya', $pilihanraya_bil);
        $this->db->where('DATE(harian_parlimen_tarikh)', $tarikh);
        $this->db->order_by('harian_parlimen_pengguna_waktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function sedia_ada($parlimen_bil, $pilihanraya_bil)
    {
        $this->db->where('harian_parlimen_parlimen', $parlimen_bil);
        $this->db->where('harian_parlimen_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('harian_parlimen_tarikh', 'DESC');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senarai_harian($parlimen_bil, $pilihanraya_bil){
        $this->db->join('parti_tb', 'parti_tb.parti_bil = harian_parlimen_tb.harian_parlimen_parti', 'LEFT');
        $this->db->where('harian_parlimen_parlimen', $parlimen_bil);
        $this->db->where('harian_parlimen_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('harian_parlimen_tarikh', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function tukar_jangkaan(){
        $data = array(
            "hdpt_keluar_mengundi" => $this->input->post('input_jangkaan_keluar_mengundi')
        );
        $this->db->where('date(hdpt_tarikh)', date('Y-m-d'));
        $this->db->update($this->dm_harian, $data);
    }

    private function checkTableExists($checkTable)
    {   
        $this->load->dbforge();
        if($this->db->table_exists($checkTable) == FALSE){
            $fields = array(
                'harian_parlimen_bil' => array(
                    'type' => 'BIGINT',
                    'null'=> FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),

                'harian_parlimen_tarikh' => array(
                    'type' => 'DATE',
                    'null' => TRUE
                ),
                'harian_parlimen_parlimen' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'harian_parlimen_pilihanraya' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'harian_parlimen_atas_pagar' => array(
                    'type' => 'DECIMAL',
                    'constraint' => '13,2',
                    'null' => TRUE
                ),
                'harian_parlimen_grading' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                ),
                'harian_parlimen_color' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                ),
                'harian_parlimen_keluar_mengundi' => array(
                    'type' => 'DECIMAL',
                    'constraint' => '13,2',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('harian_parlimen_bil', TRUE);
            $this->dbforge->create_table($this->table, TRUE);
        }
    }

    public function binaDataHarian($tarikh, $parlimenBil, $pilihanrayaBil, $atasPagar)
    {
        $this->checkTableExists($this->table);
        $data = array(
            'harian_parlimen_tarikh' => $tarikh,
            'harian_parlimen_parlimen' => $parlimenBil,
            'harian_parlimen_pilihanraya' => $pilihanrayaBil,
            'harian_parlimen_atas_pagar' => $atasPagar,
            'harian_parlimen_grading' => "BELUM DITETAPKAN",
            'harian_parlimen_color' => "background:red; color:white;",
            'harian_parlimen_keluar_mengundi' => 70,
            'harian_parlimen_parti' => ''
        );
        return $this->db->insert($this->table, $data);
    }

    public function semasa_parlimen($parlimen_bil)
    {
        $this->db->where('harian_parlimen_parlimen', $parlimen_bil);
        $this->db->order_by('harian_parlimen_tarikh', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function parlimen_harian($parlimen_bil, $tarikh)
    {
        $this->db->where('harian_parlimen_tarikh', $tarikh);
        $this->db->where('harian_parlimen_parlimen', $parlimen_bil);
        $this->db->order_by('harian_parlimen_tarikh', 'ASC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function tambah_harian()
    {
        $warna = "";
        switch ($this->input->post('input_grading')) {
                case 'PUTIH': $warna = 'background:#FFFFFF; color:black'; 
                
                break;
                case 'KELABU PUTIH': $warna = 'background:#BEBEBE; color:black';
                
                break;
                case 'KELABU HITAM': $warna = 'background:#696969; color:white';
                
                break;
                case 'HITAM': $warna = 'background:#000000; color:white';
                
                break;
            
            default:
                $warna = "background:red; color:white;";
                break;
        }

        $data = array(
            "harian_parlimen_tarikh" => $this->input->post('input_harian_tarikh'),
            "harian_parlimen_parlimen" => $this->input->post('input_parlimen_bil'),
            "harian_parlimen_grading" => $this->input->post('input_grading'),
            "harian_parlimen_color" => $warna,
            'harian_parlimen_parti' => $this->input->post('input_parti_bil')
        );
        return $this->db->insert($this->table, $data);
    }

    public function tambah_harian_parlimen($grading, $tarikh, $parlimen_bil, $pengguna_bil, $waktu, $ulasan, $pilihanraya_bil, $parti)
    {
        $warna = "";
        switch ($grading) {
                case 'PUTIH': $warna = 'background:#FFFFFF; color:black'; 
                
                break;
                case 'KELABU PUTIH': $warna = 'background:#BEBEBE; color:black';
                
                break;
                case 'KELABU HITAM': $warna = 'background:#696969; color:white';
                
                break;
                case 'HITAM': $warna = 'background:#000000; color:white';
                
                break;
            
            default:
                $warna = "background:red; color:white;";
                break;
        }

        $data = array(
            "harian_parlimen_tarikh" => $tarikh,
            "harian_parlimen_parlimen" => $parlimen_bil,
            "harian_parlimen_grading" => $grading,
            "harian_parlimen_color" => $warna,
            "harian_parlimen_pengguna_bil" => $pengguna_bil,
            "harian_parlimen_pengguna_waktu" => $waktu,
            "harian_parlimen_ulasan" => $ulasan,
            'harian_parlimen_pilihanraya' => $pilihanraya_bil,
            'harian_parlimen_parti' => $parti
        );
        return $this->db->insert($this->table, $data);
    }
	

    public function tambah_harian_parlimen_penuh($grading, $tarikh, $parlimen_bil, $pengguna_bil, $waktu, $ulasan, $pilihanraya_bil, $atas_pagar, $keluar_mengundi, $parti)
    {
        $warna = "";
        switch ($grading) {
                case 'PUTIH': $warna = 'background:#FFFFFF; color:black'; 
                
                break;
                case 'KELABU PUTIH': $warna = 'background:#BEBEBE; color:black';
                
                break;
                case 'KELABU HITAM': $warna = 'background:#696969; color:white';
                
                break;
                case 'HITAM': $warna = 'background:#000000; color:white';
                
                break;
            
            default:
                $warna = "background:red; color:white;";
                break;
        }

        $data = array(
            "harian_parlimen_tarikh" => $tarikh,
            "harian_parlimen_parlimen" => $parlimen_bil,
            "harian_parlimen_grading" => $grading,
            "harian_parlimen_color" => $warna,
            "harian_parlimen_pengguna_bil" => $pengguna_bil,
            "harian_parlimen_pengguna_waktu" => $waktu,
            "harian_parlimen_ulasan" => $ulasan,
            "harian_parlimen_atas_pagar" => $atas_pagar,
            "harian_parlimen_pilihanraya" => $pilihanraya_bil,
            "harian_parlimen_keluar_mengundi" => $keluar_mengundi,
            'harian_parlimen_parti' => $parti
        );
        return $this->db->insert($this->table, $data);
    }

    public function kemaskini_harian()
    {
        $warna = "";
        switch ($this->input->post('input_grading')) {
                case 'PUTIH': $warna = 'background:#FFFFFF; color:black'; 
                
                break;
                case 'KELABU PUTIH': $warna = 'background:#BEBEBE; color:black';
                
                break;
                case 'KELABU HITAM': $warna = 'background:#696969; color:white';
                
                break;
                case 'HITAM': $warna = 'background:#000000; color:white';
                
                break;
            
            default:
                $warna = "background:red; color:white;";
                break;
        }

        $data = array(
            "harian_parlimen_tarikh" => $this->input->post('input_harian_tarikh'),
            "harian_parlimen_parlimen" => $this->input->post('input_parlimen_bil'),
            "harian_parlimen_grading" => $this->input->post('input_grading'),
            "harian_parlimen_color" => $warna,
            'harian_parlimen_parti' => $this->input->post('input_parti_bil')
        );

        $this->db->where('harian_parlimen_bil', $this->input->post('input_harian_bil'));
        return $this->db->update($this->table, $data);
    }

    public function kemaskini_harian_parlimen($bil, $grading, $tarikh, $parlimen_bil, $pengguna_bil, $waktu, $ulasan, $pilihanraya_bil, $atas_pagar, $keluar_mengundi, $parti)
    {
        $warna = "";
        switch ($grading) {
                case 'PUTIH': $warna = 'background:#FFFFFF; color:black'; 
                
                break;
                case 'KELABU PUTIH': $warna = 'background:#BEBEBE; color:black';
                
                break;
                case 'KELABU HITAM': $warna = 'background:#696969; color:white';
                
                break;
                case 'HITAM': $warna = 'background:#000000; color:white';
                
                break;
            
            default:
                $warna = "background:red; color:white;";
                break;
        }

        $data = array(
            "harian_parlimen_tarikh" => $tarikh,
            "harian_parlimen_parlimen" => $parlimen_bil,
            "harian_parlimen_grading" => $grading,
            "harian_parlimen_color" => $warna,
            "harian_parlimen_pengguna_bil" => $pengguna_bil,
            "harian_parlimen_pengguna_waktu" => $waktu,
            "harian_parlimen_ulasan" => $ulasan,
            "harian_parlimen_pilihanraya" => $pilihanraya_bil,
            "harian_parlimen_atas_pagar" => $atas_pagar,
            "harian_parlimen_keluar_mengundi" => $keluar_mengundi,
            'harian_parlimen_parti' => $parti
        );

        $this->db->where('harian_parlimen_bil', $bil);
        return $this->db->update($this->table, $data);
    }

    public function rumusan_ikut_grading($pilihanraya_bil){
        $this->db->select('harian_parlimen_grading, COUNT(*) AS kira');
        $this->db->join('pilihanraya_parlimen_tb','pilihanraya_parlimen_tb.ppt_parlimen_bil = harian_parlimen_tb.harian_parlimen_parlimen');
        $this->db->where('pilihanraya_parlimen_tb.ppt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->group_by('harian_parlimen_grading');
        $this->db->order_by('harian_parlimen_grading', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function grading_parlimen($grading)
    {
        $this->db->select('harian_parlimen_parlimen, COUNT(*) AS kira');
        $this->db->where('harian_parlimen_grading', $grading);
        $this->db->group_by('harian_parlimen_parlimen');
        $this->db->order_by('harian_parlimen_grading', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_grading($grading)
    {
        $this->db->where('harian_parlimen_grading', $grading);
        $this->db->group_by('harian_parlimen_parlimen');
        $this->db->order_by('harian_parlimen_tarikh', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_grading_penuh($pilihanraya_bil)
    {
        $this->db->join('pilihanraya_parlimen_tb', 'pilihanraya_parlimen_tb.ppt_parlimen_bil = harian_parlimen_tb.harian_parlimen_parlimen');
        $this->db->where('pilihanraya_parlimen_tb.ppt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->group_by('harian_parlimen_parlimen');
        $this->db->order_by('harian_parlimen_tarikh', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_hari_ini($tarikh){
        $this->db->where('harian_parlimen_tarikh', $tarikh);
        $this->db->group_by('harian_parlimen_grading');
        $this->db->order_by('harian_parlimen_tarikh', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai($parlimen_bil)
    {
        $this->db->where('harian_parlimen_parlimen', $parlimen_bil);
        $this->db->order_by('harian_parlimen_tarikh', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function padam()
    {
        $this->db->where('harian_parlimen_bil', $this->input->post('input_grading_bil'));
        $this->db->delete($this->table);
    }

    public function dm_harian($tarikh, $dm_bil)
    {
        $this->db->where('date(hdpt_tarikh)' ,$tarikh);
        $this->db->where('hdpt_dm_bil', $dm_bil);
        $this->db->order_by('hdpt_tarikh', 'DESC');
        $query = $this->db->get($this->dm_harian);
        return $query->row();
    }

    public function dm_harian_hari($tarikh, $dm_bil)
    {
        $this->db->where('date(hdpt_tarikh) <=', $tarikh);
        $this->db->where('hdpt_dm_bil', $dm_bil);
        $this->db->order_by('hdpt_tarikh', 'DESC');
        $query = $this->db->get($this->dm_harian);
        return $query->row();
    }

    public function dm_semasa($dm_bil)
    {
        $this->db->where('hdpt_dm_bil', $dm_bil);
        $this->db->order_by('hdpt_tarikh', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->dm_harian);
        return $query->row();
    }

    public function tambah_harian_pdm($pengundi, $keluar_mengundi, $atas_pagar, $parlimen_bil, $dm_bil, $sekarang, $parti){
        $data = array(
            'hdpt_pengundi' => $pengundi,
            'hdpt_keluar_mengundi' => $keluar_mengundi,
            'hdpt_atas_pagar' => $atas_pagar,
            'hdpt_parlimen_bil' => $parlimen_bil,
            'hdpt_dm_bil' => $dm_bil,
            'hdpt_tarikh' => $sekarang,
            'hdpt_parti' => $parti
        );
        $this->db->insert($this->dm_harian, $data);
    }

    public function kemaskini_harian_pdm($hdpt_bil, $pengundi, $keluar_mengundi, $atas_pagar, $parlimen_bil, $dm_bil, $sekarang, $parti){
        $data = array(
            'hdpt_pengundi' => $pengundi,
            'hdpt_keluar_mengundi' => $keluar_mengundi,
            'hdpt_atas_pagar' => $atas_pagar,
            'hdpt_parlimen_bil' => $parlimen_bil,
            'hdpt_dm_bil' => $dm_bil,
            'hdpt_tarikh' => $sekarang,
            'hdpt_parti' => $parti
        );
        $this->db->where('hdpt_bil', $hdpt_bil);
        $this->db->update($this->dm_harian, $data);
    }

}
