<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dun_model extends CI_Model {

    protected $table = 'dun_tb';

    //======================================================================
    // FUNGSI BARU DITAMBAH DI SINI
    //======================================================================

    /**
     * Mendapatkan satu baris data DUN berdasarkan ID (bil).
     * Ini adalah alias untuk fungsi dun_bil($bil) untuk konsistensi.
     *
     * @param int $bil ID DUN (dun_bil).
     * @return object Data DUN.
     */
    public function satu_data($bil)
    {
        // Memanggil fungsi 'dun_bil' yang sedia ada.
        return $this->dun_bil($bil);
    }

    //======================================================================
    // FUNGSI SEDIA ADA ANDA
    //======================================================================

    public function senarai_ikut_negeri($negeri_bil)
    {
        // JOIN dengan negeri_tb dan tapis menggunakan ID negeri
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = dun_tb.dun_negeri', 'left');
        $this->db->where('negeri_tb.nt_bil', $negeri_bil);
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get('dun_tb');
        return $query->result();
    }

    public function senaraiDunCarian(){
        $column = [
            'dun_tb.dun_bil AS dunBil', 
            'UPPER(dun_tb.dun_nama) AS dunNama',
            "UPPER(negeri_tb.nt_nama) AS negeriNama"
        ];
        $this->db->select($column);
        $this->db->join("negeri_tb", "UPPER(negeri_tb.nt_nama) = UPPER(dun_tb.dun_negeri)", "left");
        $this->db->order_by("dunNama", "ASC");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function bilanganLaporanUtama(){
        $this->db->select("COUNT(*) AS bilanganLaporan");
        $query = $this->db->get($this->table);
        $bilanganLaporan = $query->row();
        return $bilanganLaporan->bilanganLaporan;
    }

    public function senaraiDun(){
        $this->db->select('dun_tb.dun_bil AS dunBil');
        $this->db->select('UPPER(dun_tb.dun_nama) AS dunNama');
        $this->db->select('UPPER(negeri_tb.nt_nama) AS negeriNama');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = dun_tb.dun_negeri', 'left');
        $this->db->order_by('negeriNama', 'ASC');
        $this->db->order_by('dunNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiDunNegeri($senaraiNegeri){
        $this->db->select('dun_tb.dun_bil AS dunBil');
        $this->db->select('UPPER(dun_tb.dun_nama) AS dunNama');
        $this->db->select('UPPER(negeri_tb.nt_nama) AS negeriNama');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = dun_tb.dun_negeri', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->order_by('negeriNama', 'ASC');
        $this->db->order_by('dunNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiWakilRakyat()
    {
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_dun = dun_tb.dun_bil', 'left');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = dun_tb.dun_negeri', 'left');
        $this->db->where('pencalonan_tb.pencalonan_keputusan_tidak_rasmi', 'MENANG');
        $this->db->order_by('negeri_tb.nt_nama', 'ASC');
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $this->db->order_by('pilihanraya_tb.pilihanraya_lock_status', 'ASC');
        $this->db->group_by('dun_tb.dun_nama');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function dunMengikutSenaraiNegeri($senaraiNegeri)
    {
        $this->db->select('*');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = dun_tb.dun_negeri');
        $this->db->group_start();
        foreach($senaraiNegeri as $n){
            $this->db->or_where('negeri_tb.nt_bil', $n->negeri);
        }
        $this->db->group_end();
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_dun_pilihanraya_pengundi($pilihanraya_bil)
    {
        $this->db->select('*');
        $this->db->select('(SELECT SUM(pdm_dun_tb.pdt_bilangan_pengundi) FROM pdm_dun_tb WHERE pdm_dun_tb.pdt_dun = dun_tb.dun_bil) AS jumlahPengundi');
        $this->db->select('(SELECT dun_keluar_mengundi_tb.dkmt_bilangan_pengundi FROM dun_keluar_mengundi_tb WHERE dun_keluar_mengundi_tb.dkmt_pilihanraya_bil = pilihanraya_dun_tb.pdt_pilihanraya_bil AND dun_keluar_mengundi_tb.dkmt_dun_bil = pilihanraya_dun_tb.pdt_dun_bil GROUP BY dun_keluar_mengundi_tb.dkmt_dun_bil ORDER BY dun_keluar_mengundi_tb.dkmt_waktu DESC LIMIT 1) AS pengundiKeluarMengundi');
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_dun_bil = dun_tb.dun_bil');
        $this->db->where('pilihanraya_dun_tb.pdt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->order_by('dun_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiDunPruIkutNegeri($pilihanraya_bil, $negeriBil)
    {
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_dun_bil = dun_tb.dun_bil');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = dun_tb.dun_negeri', 'left');
        $this->db->where('pilihanraya_dun_tb.pdt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->where('negeri_tb.nt_bil', $negeriBil);
        $this->db->order_by('dun_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiTugasanDun($perananBil){
        $this->db->join('dun_tb', 'dun_tb.dun_bil = tugas_dun_tb.tdt_dun_bil');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = dun_tb.dun_negeri', 'left');
        $this->db->where('tdt_peranan_bil', $perananBil);
        $query = $this->db->get('tugas_dun_tb');
        return $query->result();
    }

    public function senarai_tugas_ppd_bil($dun_bil)
    {
        $this->db->select('tugas_dun_tb.tdt_bil');
        $this->db->select('tugas_dun_tb.tdt_peranan_bil');
        $this->db->select('peranan_tb.peranan_bil');
        $this->db->select('peranan_tb.peranan_nama');
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = tugas_dun_tb.tdt_peranan_bil');
        $this->db->where('tugas_dun_tb.tdt_dun_bil', $dun_bil);
        $this->db->order_by('tugas_dun_tb.tdt_waktu', 'DESC');
        $query = $this->db->get('tugas_dun_tb');
        return $query->row();
    }

    public function kemaskini_tugas_dun($tugas_bil)
    {
        $data = array(
            'tdt_peranan_bil' => $this->input->post('input_peranan_bil'),
            'tdt_dun_bil' => $this->input->post('input_dun_bil'),
            'tdt_pengguna_bil' => $this->input->post('input_pengguna_bil'),
            'tdt_waktu' => date('Y-m-d H:i:s')
        );
        $this->db->where('tdt_bil', $tugas_bil);
        return $this->db->update('tugas_dun_tb', $data);
    }

    public function tambah_tugas_dun()
    {
        $data = array(
            'tdt_peranan_bil' => $this->input->post('input_peranan_bil'),
            'tdt_dun_bil' => $this->input->post('input_dun_bil'),
            'tdt_pengguna_bil' => $this->input->post('input_pengguna_bil'),
            'tdt_waktu' => date('Y-m-d H:i:s')
        );
        return $this->db->insert('tugas_dun_tb', $data);
    }

    public function tugas_dun($dun_bil)
    {
        $this->db->where('tdt_dun_bil', $dun_bil);
        $query = $this->db->get('tugas_dun_tb');
        return $query->row();
    }

    public function senarai_tugas_ppd($dun_bil)
    {
        $this->db->select('tugas_dun_tb.tdt_bil');
        $this->db->select('tugas_dun_tb.tdt_peranan_bil');
        $this->db->select('peranan_tb.peranan_bil');
        $this->db->select('peranan_tb.peranan_nama');
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = tugas_dun_tb.tdt_peranan_bil');
        $this->db->where('tugas_dun_tb.tdt_dun_bil', $dun_bil);
        $this->db->order_by('peranan_tb.peranan_nama', 'ASC');
        $query = $this->db->get('tugas_dun_tb');
        return $query->result();
    }

    public function padam_bil()
    {
        $this->db->where('dun_bil', $this->input->post('input_bil'));
        $this->db->delete($this->table);
    }

    public function dun($dun_bil)
    {
        $this->db->select('*');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = dun_tb.dun_negeri');
        $this->db->where('dun_bil', $dun_bil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function tambah()
    {
        $data = array(
            'dun_nama' => $this->input->post('input_nama'),
            'dun_negeri' => $this->input->post('input_negeri_nama')
        );
        
        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;

    }
    
    public function dun_negeri($negeri_bil)
    {
        $this->db->select('*');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = dun_tb.dun_negeri');
        $this->db->where('negeri_tb.nt_bil', $negeri_bil);
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function dun_pr_aktif($negeri){
        $this->db->select('dun_tb.dun_bil, dun_tb.dun_nama');
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_dun_bil = dun_tb.dun_bil');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pilihanraya_dun_tb.pdt_pilihanraya_bil');
        $this->db->where('dun_tb.dun_negeri', $negeri);
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_dun_pilihanraya($pilihanraya_bil)
    {
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_dun_bil = dun_tb.dun_bil');
        $this->db->where('pilihanraya_dun_tb.pdt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->order_by('dun_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai()
    {
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = dun_tb.dun_negeri', 'left');
        $this->db->order_by('negeri_tb.nt_nama', 'ASC');
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function cari_dm_no($nombor_dun, $negeri){
        $this->db->like('dun_nama', $nombor_dun);
        $this->db->where('dun_negeri', $negeri);
        $query = $this->db->get($this->table);
        return $query->result();
    }

	public function daftar()
	{
        $data = array(
            'dun_nama' => $this->input->post('dun_nama'),
            'dun_negeri' => $this->input->post('dun_negeri'),
            'dun_waktu' => date ('Y-m-d H:i:s'),
            'dun_pengguna' => $this->input->post('dun_pengguna')          
        );

        $ada = $this->semak_ada($data['dun_nama'],$data['dun_negeri']);

        if(count($ada) == 0){
            $return_data['insert_data'] = $this->db->insert($this->table, $data);
            $return_data['last_id'] = $this->db->insert_id();
            $return_data['status'] = TRUE;
        }else{
            foreach($ada as $a){
                $return_data['last_id'] = $a->dun_bil;
            }
            $return_data['status'] = FALSE;           
        }    
        return $return_data;
        
    }

    public function kira_semua(){
        return $this->db->count_all($this->table);
    }
    
    public function lihat_semua($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar_semua(){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = dun_tb.dun_pengguna', 'left');
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function negeri($nama){
        $this->db->where('dun_negeri', $nama);
        $this->db->order_by('dun_nama', 'ASC');
        $query = $this->db->get($this->table);

        return $query->result();
    }
    
    public function semua(){
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar_ikut_negeri($negeri){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = dun_tb.dun_pengguna', 'left');
        $this->db->where('dun_tb.dun_negeri', $negeri);
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function ikut_negeri($negeri)
    {
        $this->db->where('dun_negeri', $negeri);
        $this->db->order_by('dun_nama', 'ASC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar($bil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = dun_tb.dun_pengguna', 'left');
        $this->db->where('dun_tb.dun_bil', $bil);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function dun_bil($bil){
        $this->db->where('dun_bil', $bil);
        $query = $this->db->get($this->table);

        return $query->row();
    }

    public function padam($bil){
        $this->db->where('dun_bil', $bil);
        $this->db->delete($this->table);
    }

    public function semak_ada($dun_nama,$dun_negeri){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = dun_tb.dun_pengguna', 'left');
        $this->db->where('dun_tb.dun_nama', $dun_nama);
        $this->db->where('dun_tb.dun_negeri', $dun_negeri);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senarai_negeri(){
        $this->db->select('dun_negeri');
        $this->db->group_by('dun_negeri');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function carian(){
        $data = array(
            'dun_nama' => $this->input->post('dun_nama')        
        );
        $this->db->like('dun_nama', $data['dun_nama']);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function dun_ikut_pilihanraya($pilihanraya_bil){
        $this->db->select('dun_tb.dun_nama');
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_dun = dun_tb.dun_bil', 'right');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->where('pilihanraya_tb.pilihanraya_bil', $pilihanraya_bil);
        $this->db->group_by('pencalonan_tb.pencalonan_dun');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function dun_grading($pilihanraya_bil, $harian_tarikh)
    {
        $this->db->select('harian_tb.harian_grading');
        $this->db->select('harian_tb.harian_color');
        $this->db->select('COUNT(dun_tb.dun_nama) AS kira_dun');
        $this->db->join('harian_tb', 'harian_tb.harian_dun = dun_tb.dun_bil', 'left');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = harian_tb.harian_pilihanraya', 'left');
        $this->db->where('pilihanraya_tb.pilihanraya_bil', $pilihanraya_bil);
        $this->db->where('harian_tb.harian_tarikh', $harian_tarikh);
        $this->db->group_by('harian_tb.harian_grading');
        $this->db->group_by('harian_tb.harian_color');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function dun_putih($pilihanraya_bil, $harian_tarikh)
    {
        $this->db->select('dun_tb.dun_nama');
        $this->db->join('harian_tb', 'harian_tb.harian_dun = dun_tb.dun_bil', 'left');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = harian_tb.harian_pilihanraya', 'left');
        $this->db->where('pilihanraya_tb.pilihanraya_bil', $pilihanraya_bil);
        $this->db->where('harian_tb.harian_tarikh', $harian_tarikh);
        $this->db->where('harian_tb.harian_grading', 'PUTIH');
        $this->db->group_by('harian_tb.harian_dun');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_tugasan($peranan_bil)
    {
        $this->db->join('tugas_dun_tb', 'tugas_dun_tb.tdt_dun_bil = dun_tb.dun_bil');
        $this->db->where('tugas_dun_tb.tdt_peranan_bil', $peranan_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

}
