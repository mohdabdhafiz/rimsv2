<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harian_model extends CI_Model {

    protected $table = 'harian_tb';
    protected $dm_harian = 'harian_dm_dun_tb';

    private function update20250205(){
        $this->load->dbforge();
        if ($this->db->field_exists('harian_pengguna', $this->table) == FALSE)
            {   
                $fields = array(
                    'harian_pengguna' => array(
                        'type' => 'BIGINT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($this->table, $fields);
            }
    }

    public function kedudukanTerkini($pilihanrayaBil){
        $this->update20250205();
        $columns = [
            "UPPER(dun_tb.dun_nama) AS kawasanNama",
            "harian_tb.harian_tarikh AS harianTarikh",
            "harian_tb.harian_color AS color",
            "harian_tb.harian_atas_pagar AS atasPagar",
            "harian_tb.harian_grading AS grading",
            "harian_tb.harian_ulasan AS ulasan",
            "harian_tb.harian_keluar_mengundi AS keluarMengundi",
            "UPPER(pengguna_tb.nama_penuh) AS pelaporNama"
        ];
    
        // Select columns
        $this->db->select($columns);

        $this->db->join("pilihanraya_tb", "pilihanraya_tb.pilihanraya_bil = harian_tb.harian_pilihanraya", "left");
        $this->db->join("dun_tb", "dun_tb.dun_bil = harian_tb.harian_dun", "left");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = harian_tb.harian_pengguna', 'left');
        
        $this->db->where("pilihanraya_tb.pilihanraya_bil", $pilihanrayaBil);
        $this->db->where("harian_tb.harian_tarikh = (
            SELECT MAX(h2.harian_tarikh)
            FROM harian_tb h2
            WHERE h2.harian_dun = harian_tb.harian_dun
        )");
        $this->db->group_by("dun_tb.dun_bil");
        $this->db->order_by("harian_tb.harian_tarikh", "DESC");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function bilanganLaporanUtama(){
        $this->db->select("COUNT(*) as bilanganLaporan");
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senaraiHarianDun($dunSenarai){
        $this->db->select("harian_tb.harian_bil AS hdBil");
        $this->db->select("harian_tb.harian_tarikh AS hdTarikh");
        $this->db->select("UPPER(dun_tb.dun_nama) AS dunNama");
        $this->db->select("UPPER(dun_tb.dun_negeri) AS negeriNama");
        $this->db->select("UPPER(pilihanraya_tb.pilihanraya_nama) AS pruNama");
        $this->db->select("harian_tb.harian_grading AS hdStatus");
        $this->db->select("harian_tb.harian_atas_pagar AS hdAtasPagar");
        $this->db->select("harian_tb.harian_keluar_mengundi AS hdKeluarMengundi");
        $this->db->join("dun_tb", "dun_tb.dun_bil = harian_tb.harian_dun", "left");
        $this->db->join("negeri_tb", "negeri_tb.nt_nama = dun_tb.dun_negeri", "left");
        $this->db->join("pilihanraya_tb", "pilihanraya_tb.pilihanraya_bil = harian_tb.harian_pilihanraya", "left");
        $this->db->group_start();
        foreach($dunSenarai as $dun){
            $this->db->or_where('dun_tb.dun_bil', $dun->dun_bil);
        }
        $this->db->group_end();
        $this->db->order_by("hdTarikh", "DESC");
        $this->db->order_by("dunNama", "ASC");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiHarianNegeri($senaraiNegeri){
        $this->db->select("harian_tb.harian_bil AS hdBil");
        $this->db->select("harian_tb.harian_tarikh AS hdTarikh");
        $this->db->select("UPPER(dun_tb.dun_nama) AS dunNama");
        $this->db->select("UPPER(dun_tb.dun_negeri) AS negeriNama");
        $this->db->select("UPPER(pilihanraya_tb.pilihanraya_nama) AS pruNama");
        $this->db->select("harian_tb.harian_grading AS hdStatus");
        $this->db->select("harian_tb.harian_atas_pagar AS hdAtasPagar");
        $this->db->select("harian_tb.harian_keluar_mengundi AS hdKeluarMengundi");
        $this->db->join("dun_tb", "dun_tb.dun_bil = harian_tb.harian_dun", "left");
        $this->db->join("negeri_tb", "negeri_tb.nt_nama = dun_tb.dun_negeri", "left");
        $this->db->join("pilihanraya_tb", "pilihanraya_tb.pilihanraya_bil = harian_tb.harian_pilihanraya", "left");
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->order_by("hdTarikh", "DESC");
        $this->db->order_by("dunNama", "ASC");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiHarian(){
        $this->db->select("harian_tb.harian_bil AS hdBil");
        $this->db->select("harian_tb.harian_tarikh AS hdTarikh");
        $this->db->select("UPPER(dun_tb.dun_nama) AS dunNama");
        $this->db->select("UPPER(dun_tb.dun_negeri) AS negeriNama");
        $this->db->select("UPPER(pilihanraya_tb.pilihanraya_nama) AS pruNama");
        $this->db->select("harian_tb.harian_grading AS hdStatus");
        $this->db->select("harian_tb.harian_atas_pagar AS hdAtasPagar");
        $this->db->select("harian_tb.harian_keluar_mengundi AS hdKeluarMengundi");
        $this->db->join("dun_tb", "dun_tb.dun_bil = harian_tb.harian_dun", "left");
        $this->db->join("pilihanraya_tb", "pilihanraya_tb.pilihanraya_bil = harian_tb.harian_pilihanraya", "left");
        $this->db->order_by("hdTarikh", "DESC");
        $this->db->order_by("dunNama", "ASC");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiTarikhDun($pilihanrayaBil, $dunBil){
        $this->db->select('harian_tarikh');
        $this->db->where('harian_pilihanraya', $pilihanrayaBil);
        $this->db->where('harian_dun', $dunBil);
        $this->db->group_by('harian_tarikh');
        $this->db->order_by('harian_tarikh', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result(); 
    }

    public function statusHari($dun_bil, $pilihanraya_bil, $tarikh)
    {
        $this->db->join('parti_tb', 'parti_tb.parti_bil = harian_tb.harian_parti', 'left');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = harian_tb.harian_pilihanraya', 'left');
        $this->db->where('harian_dun', $dun_bil);
        $this->db->where('harian_pilihanraya', $pilihanraya_bil);
        $this->db->where('DATE(harian_tarikh)', $tarikh);
        $this->db->order_by('harian_tarikh', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function ikutDun($tarikh, $negeri, $pilihanrayaBil){
        $this->db->join('dun_tb', 'dun_tb.dun_bil = harian_tb.harian_dun');
        $this->db->where('dun_tb.dun_negeri', $negeri);
        $this->db->where('DATE(harian_tb.harian_tarikh)', $tarikh);
        $this->db->where('harian_pilihanraya', $pilihanrayaBil);
        $this->db->order_by('harian_waktu', 'DESC');
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $this->db->group_by('harian_tb.harian_dun');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function harianParti($partiBil, $pilihanrayaBil)
    {
        $this->db->where('harian_parti', $partiBil);
        $this->db->where('harian_pilihanraya', $pilihanrayaBil);
        $this->db->order_by('harian_tarikh', 'DESC');
        $this->db->group_by('harian_dun');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function dm_harian_hari($tarikh, $dm_bil)
    {
        $this->db->where('date(hddt_tarikh) <=', $tarikh);
        $this->db->where('hddt_dm_bil', $dm_bil);
        $this->db->order_by('hddt_tarikh', 'DESC');
        $query = $this->db->get($this->dm_harian);
        return $query->row();
    }

    public function senarai_harian($dun_bil, $pilihanraya_bil){
        $this->db->join('parti_tb', 'parti_tb.parti_bil = harian_tb.harian_parti', 'left');
        $this->db->where('harian_tb.harian_dun', $dun_bil);
        $this->db->where('harian_tb.harian_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('harian_tb.harian_tarikh', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function harian($harian_bil){
        $this->db->join('parti_tb', 'parti_tb.parti_bil = harian_tb.harian_parti', 'left');
        $this->db->where('harian_tb.harian_bil', $harian_bil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senarai_pilihanraya($pilihanraya_bil){
        $this->db->where('harian_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('harian_tarikh', 'DESC');
        $this->db->group_by('harian_tarikh');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_dun_negeri($tarikh, $negeri, $grading, $pilihanrayaBil){
        $this->db->join('dun_tb', 'dun_tb.dun_bil = harian_tb.harian_dun');
        $this->db->where('dun_tb.dun_negeri', $negeri);
        $this->db->where('harian_tb.harian_grading', $grading);
        $this->db->where('harian_tb.harian_tarikh', $tarikh);
        $this->db->where('harian_tb.harian_pilihanraya', $pilihanrayaBil);
        $this->db->order_by('harian_tarikh', 'DESC');
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $this->db->group_by('harian_tb.harian_dun');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_hari_ini($tarikh){
        $this->db->where('harian_tarikh', $tarikh);
        $this->db->group_by('harian_grading');
        $this->db->order_by('harian_tarikh', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function sedia_ada($dun_bil, $pilihanraya_bil)
    {
        $this->db->where('harian_dun', $dun_bil);
        $this->db->where('harian_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('harian_tarikh', 'DESC');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function hari_ini($dun_bil, $pilihanraya_bil, $tarikh)
    {
        $this->db->where('harian_dun', $dun_bil);
        $this->db->where('harian_pilihanraya', $pilihanraya_bil);
        $this->db->where('harian_tarikh', $tarikh);
        $this->db->order_by('harian_tarikh', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senarai_grading_penuh($pilihanraya_bil)
    {
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_dun_bil = harian_tb.harian_dun');
        $this->db->where('pilihanraya_dun_tb.pdt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->group_by('harian_dun');
        $this->db->order_by('harian_tarikh', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_grading($pilihanraya_bil){
        $this->db->select('harian_grading, COUNT(*) AS kira');
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_dun_bil = harian_tb.harian_dun');
        $this->db->where('pilihanraya_dun_tb.pdt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->group_by('harian_grading');
        $this->db->order_by('harian_grading', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kemaskini_harian_dun($bil, $grading, $tarikh, $dun_bil, $pengguna_bil, $waktu, $ulasan, $pilihanraya_bil, $atas_pagar, $keluar_mengundi, $parti_bil)
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
            "harian_tarikh" => $tarikh,
            "harian_dun" => $dun_bil,
            "harian_grading" => $grading,
            "harian_color" => $warna,
            "harian_ulasan" => $ulasan,
            "harian_pilihanraya" => $pilihanraya_bil,
            "harian_atas_pagar" => $atas_pagar,
            "harian_keluar_mengundi" => $keluar_mengundi,
            'harian_waktu' => $waktu,
            'harian_parti' => $parti_bil
        );

        $this->db->where('harian_bil', $bil);
        return $this->db->update($this->table, $data);
    }

    public function kemaskini_harian($bil, $grading, $tarikh, $dun_bil, $pengguna_bil, $waktu, $ulasan, $pilihanraya_bil, $atas_pagar, $keluar_mengundi, $parti_bil)
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
            "harian_tarikh" => $tarikh,
            "harian_dun" => $dun_bil,
            "harian_grading" => $grading,
            "harian_color" => $warna,
            "harian_ulasan" => $ulasan,
            "harian_pilihanraya" => $pilihanraya_bil,
            "harian_atas_pagar" => $atas_pagar,
            "harian_keluar_mengundi" => $keluar_mengundi,
            'harian_parti' => $parti_bil
        );

        $this->db->where('harian_bil', $bil);
        return $this->db->update($this->table, $data);
    }

    public function kemaskini_harian_pdm($hddt_bil, $pengundi, $keluar_mengundi, $atas_pagar, $dun_bil, $dm_bil, $sekarang, $parti_bil){
        $data = array(
            'hddt_pengundi' => $pengundi,
            'hddt_keluar_mengundi' => $keluar_mengundi,
            'hddt_atas_pagar' => $atas_pagar,
            'hddt_dun_bil' => $dun_bil,
            'hddt_dm_bil' => $dm_bil,
            'hddt_tarikh' => $sekarang,
            'hddt_parti' => $parti_bil
        );
        $this->db->where('hddt_bil', $hddt_bil);
        $this->db->update($this->dm_harian, $data);
    }

    public function dm_harian($tarikh, $dm_bil)
    {
        $this->db->where('DATE(hddt_tarikh)', $tarikh);
        $this->db->where('hddt_dm_bil', $dm_bil);
        $query = $this->db->get($this->dm_harian);
        return $query->row();
    }

    public function tambah_harian_pdm($pengundi, $keluar_mengundi, $atas_pagar, $dun_bil, $dm_bil, $sekarang, $parti_bil){
        $data = array(
            'hddt_pengundi' => $pengundi,
            'hddt_keluar_mengundi' => $keluar_mengundi,
            'hddt_atas_pagar' => $atas_pagar,
            'hddt_dun_bil' => $dun_bil,
            'hddt_dm_bil' => $dm_bil,
            'hddt_tarikh' => $sekarang,
            'hddt_parti' => $parti_bil
        );
        $this->db->insert($this->dm_harian, $data);
    }

    public function dm_semasa($dm_bil)
    {
        $this->db->where('hddt_dm_bil', $dm_bil);
        $this->db->order_by('hddt_tarikh', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->dm_harian);
        return $query->row();
    }

    public function tambah_harian_dun($grading, $tarikh, $dun_bil, $ulasan, $pilihanraya_bil, $sekarang, $parti_bil, $atasPagar, $keluarMengundi)
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
            "harian_tarikh" => $tarikh,
            "harian_dun" => $dun_bil,
            "harian_grading" => $grading,
            "harian_color" => $warna,
            "harian_ulasan" => $ulasan,
            'harian_pilihanraya' => $pilihanraya_bil,
            'harian_waktu' => $sekarang,
            'harian_parti' => $parti_bil,
            'harian_atas_pagar' => $atasPagar,
            'harian_keluar_mengundi' => $keluarMengundi
        );
        return $this->db->insert($this->table, $data);
    }

    public function semasa_dun($dun_bil)
    {
        $this->db->where('harian_dun', $dun_bil);
        $this->db->order_by('harian_tarikh', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->row();
    }

	public function cipta($dun_bil, $pilihanraya_bil, $harian_atas_pagar, $harian_grading, $harian_keluar_mengundi, $harian_tarikh, $parti_bil)
	{
        $data = array(
            'harian_dun' => $dun_bil,
            'harian_pilihanraya' => $pilihanraya_bil,
            'harian_atas_pagar' => $harian_atas_pagar,
            'harian_grading' => $harian_grading,
            'harian_keluar_mengundi' => $harian_keluar_mengundi,
            'harian_tarikh' => $harian_tarikh,
            'harian_parti' => $parti_bil       
        );

        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
    return $return_data;
    }

    public function binaDataHarian($tarikh, $dunBil, $pilihanrayaBil, $atasPagar, $parti_bil)
    {
        $data = array(
            'harian_tarikh' => $tarikh,
            'harian_dun' => $dunBil,
            'harian_pilihanraya' => $pilihanrayaBil,
            'harian_atas_pagar' => $atasPagar,
            'harian_grading' => "BELUM DITETAPKAN",
            'harian_color' => "background:red; color:white;",
            'harian_keluar_mengundi' => 0,
            'harian_parti' => $parti_bil
        );
        return $this->db->insert($this->table, $data);
    }

    public function kira_semua(){
        return $this->db->count_all($this->table);
    }
    
    public function lihat_semua($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar_ikut_dun($dun_bil, $pilihanraya_bil){
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = harian_tb.harian_pilihanraya', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = harian_tb.harian_dun', 'left');
        $this->db->where('harian_tb.harian_dun', $dun_bil);
        $this->db->where('harian_tb.harian_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('harian_tb.harian_tarikh', 'DESC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function padam($bil){
        $this->db->where('harian_bil', $bil);
        $this->db->delete($this->table);
    }

    public function set_atas_pagar($bil, $atas_pagar){
        $data = array('harian_atas_pagar' => $atas_pagar);
        $this->db->where('harian_bil', $bil);
        $this->db->update($this->table, $data);
    }

    public function set_grading($bil, $grading, $warna){
        $data = array('harian_grading' => $grading,
                    'harian_color' => $warna
        );
        $this->db->where('harian_bil', $bil);
        $this->db->update($this->table, $data);
    }

    public function set_keluar_mengundi($bil, $keluar_mengundi){
        $data = array('harian_keluar_mengundi' => $keluar_mengundi);
        $this->db->where('harian_bil', $bil);
        $this->db->update($this->table, $data);
    }

    public function semakAda($dun_bil, $pilihanraya_bil){
        $this->db->where('harian_dun', $dun_bil);
        $this->db->where('harian_pilihanraya', $pilihanraya_bil);
        $this->db->where('harian_tarikh', date('Y-m-d'));
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function semak_ikut_tarikh($dun_bil, $pilihanraya_bil, $harian_tarikh){
        $this->db->where('harian_dun', $dun_bil);
        $this->db->where('harian_pilihanraya', $pilihanraya_bil);
        $this->db->where('harian_tarikh', $harian_tarikh);
        $this->db->order_by('harian_tarikh', 'DESC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senarai_warna($harian_tarikh)
    {
        $this->db->select('harian_grading');
        $this->db->select('harian_color');
        $this->db->select('COUNT(harian_grading) AS kira_dun');
        $this->db->where('harian_tarikh', $harian_tarikh);
        $this->db->group_by('harian_grading');
        $this->db->group_by('harian_color');
        $this->db->order_by('harian_grading', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();    
    }

    public function senarai_dun($pilihanraya_bil, $harian_tarikh)
    {
        $this->db->join('dun_tb', 'dun_tb.dun_bil = harian_tb.harian_dun', 'left');
        $this->db->where('harian_pilihanraya', $pilihanraya_bil);
        $this->db->where('harian_tarikh', $harian_tarikh);
        $query = $this->db->get($this->table);
        return $query->result();    
    }

    public function dunStatus($pilihanrayaBil, $tarikh, $grading){
        $this->db->where('harian_pilihanraya', $pilihanrayaBil);
        $this->db->where('harian_grading', $grading);
        $this->db->where('harian_tarikh', $tarikh);
        $query = $this->db->get($this->table);
        return $query->result(); 
    }

    public function senaraiStatus($pilihanrayaBil)
    {
        $this->db->select('harian_grading', 'harian_color');
        $this->db->where('harian_pilihanraya', $pilihanrayaBil);
        $this->db->group_by('harian_grading');
        $query = $this->db->get($this->table);
        return $query->result();    
    }

    public function senaraiDUNGrading($pilihanrayaBil, $harianGrading, $today)
    {
        $this->db->select('harian_dun');
        $this->db->where('harian_pilihanraya', $pilihanrayaBil);
        $this->db->where('harian_grading', $harianGrading);
        $this->db->where('harian_tarikh', date_format(date_create($today), "Y-m-d"));
        $this->db->group_by('harian_dun');
        $query = $this->db->get($this->table);
        return $query->result();   
    }

    public function senaraiTarikh($pilihanrayaBil){
        $this->db->select('harian_tarikh');
        $this->db->where('harian_pilihanraya', $pilihanrayaBil);
        $this->db->group_by('harian_tarikh');
        $this->db->order_by('harian_tarikh', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result(); 
    }

}
