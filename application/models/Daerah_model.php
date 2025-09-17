<?php
class Daerah_model extends CI_Model {

    protected $table = "daerah";

    //======================================================================
    // FUNGSI BARU DITAMBAH DI SINI
    //======================================================================

    /**
     * Mendapatkan satu baris data daerah berdasarkan ID (bil).
     * Ini adalah alias untuk fungsi daerah($bil) untuk konsistensi.
     *
     * @param int $bil ID daerah.
     * @return object Data daerah.
     */
    public function satu_data($bil)
    {
        // Memanggil fungsi 'daerah' yang sedia ada.
        return $this->daerah($bil);
    }

    //======================================================================
    // FUNGSI SEDIA ADA ANDA
    //======================================================================

    public function senarai_ikut_negeri($negeri_bil)
    {
        $this->db->where('negeri_bil', $negeri_bil);
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('daerah');
        return $query->result();
    }

    public function update20250716(){
        //NOTHING
    }

    public function senaraiDaerahCarian(){
        $column = [
            'daerah.bil AS daerahBil', 
            'UPPER(daerah.nama) AS daerahNama',
            "UPPER(negeri_tb.nt_nama) AS negeriNama"
        ];
        $this->db->select($column);
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->order_by("daerahNama", "ASC");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function bilanganLaporanUtama(){
        $this->db->select("COUNT(*) AS bilanganLaporan");
        $query = $this->db->get($this->table);
        $bilanganLaporan = $query->row();
        return $bilanganLaporan->bilanganLaporan;
    }

    public function senaraiDaerah($senaraiNegeri){
        $this->db->select('UPPER(negeri_tb.nt_nama) AS negeriNama');
        $this->db->select('UPPER(daerah.nama) AS daerahNama');
        $this->db->select('daerah.bil AS daerahBil');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('daerah.negeri_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->order_by('negeriNama', 'ASC');
        $this->db->order_by('daerahNama', 'ASC');
        $query = $this->db->get('daerah');
        return $query->result();
    }

    public function senaraiTugasanNegeri($perananBil){
        $this->db->join('daerah', 'daerah.bil = tugas_daerah.daerah_bil');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil');
        $this->db->where('tugas_daerah.peranan_bil', $perananBil);
        $this->db->group_by('daerah.negeri_bil');
        $this->db->order_by('negeri_tb.nt_nama', 'ASC');
        $query = $this->db->get('tugas_daerah');
        return $query->result();
    }

    public function daerahMengikutSenaraiNegeri($senaraiNegeri)
    {
        $this->db->select('*');
        //LEFT JOIN NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $n){
                $this->db->or_where('negeri_bil', $n->negeri);
        }
        $this->db->group_end();
        $query = $this->db->get('daerah');
        return $query->result();
    }

    public function senarai()
    {
        $this->db->select('*');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil');
        $this->db->order_by('negeri_tb.nt_nama', 'ASC');
        $this->db->order_by('daerah.nama', 'ASC');
        $query = $this->db->get('daerah');
        return $query->result();
    }

    public function senaraiDaerahNegeri($namaNegeri)
    {
        $this->db->select('*');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil');
        $this->db->where('negeri_tb.nt_nama', $namaNegeri);
        $query = $this->db->get('daerah');
        return $query->result();
    }

    public function senaraiTugasanDaerah($perananBil){
        $this->db->join('daerah', 'daerah.bil = tugas_daerah.daerah_bil');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil');
        $this->db->where('tugas_daerah.peranan_bil', $perananBil);
        $query = $this->db->get('tugas_daerah');
        return $query->result();
    }
    

    public function negeriDaerahNama($namaDaerah){
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil');
        $this->db->where('daerah.nama', $namaDaerah);
        $query = $this->db->get('daerah');
        return $query->row();
    }

    public function senarai_tugas_ppd_bil($daerah_bil)
    {
        $this->db->select('tugas_daerah.bil');
        $this->db->select('tugas_daerah.peranan_bil');
        $this->db->select('peranan_tb.peranan_nama');
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = tugas_daerah.peranan_bil');
        $this->db->where('daerah_bil', $daerah_bil);
        $this->db->order_by('tugas_daerah.waktu', 'DESC');
        $query = $this->db->get('tugas_daerah');
        return $query->row();
    }

    public function kemaskini_tugas_daerah($tugas_bil)
    {
        $data = array(
            'peranan_bil' => $this->input->post('input_peranan_bil'),
            'daerah_bil' => $this->input->post('input_daerah_bil'),
            'pengguna_bil' => $this->input->post('input_pengguna_bil'),
            'waktu' => date('Y-m-d H:i:s')
        );
        $this->db->where('bil', $tugas_bil);
        return $this->db->update('tugas_daerah', $data);
    }

    public function tambah_tugas_daerah()
    {
        $data = array(
            'peranan_bil' => $this->input->post('input_peranan_bil'),
            'daerah_bil' => $this->input->post('input_daerah_bil'),
            'pengguna_bil' => $this->input->post('input_pengguna_bil'),
            'waktu' => date('Y-m-d H:i:s')
        );
        return $this->db->insert('tugas_daerah', $data);
    }

    public function tugas_daerah($daerah_bil)
    {
        $this->db->where('daerah_bil', $daerah_bil);
        $query = $this->db->get('tugas_daerah');
        return $query->row();
    }

    public function senarai_tugas_ppd($daerah_bil)
    {
        $this->db->select('tugas_daerah.bil');
        $this->db->select('tugas_daerah.peranan_bil');
        $this->db->select('peranan_tb.peranan_nama');
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = tugas_daerah.peranan_bil');
        $this->db->where('daerah_bil', $daerah_bil);
        $this->db->order_by('peranan_tb.peranan_nama', 'ASC');
        $query = $this->db->get('tugas_daerah');
        return $query->result();
    }

    public function padam()
    {
        $this->db->where('bil', $this->input->post('input_bil'));
        $this->db->delete('daerah');
    }

    public function daerah($daerah_bil)
    {
        $this->db->select('*');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil');
        $this->db->where('bil', $daerah_bil);
        $query = $this->db->get('daerah');
        return $query->row();
    }

    public function tambah()
    {
        $data = array(
            'nama' => $this->input->post('input_nama'),
            'negeri_bil' => $this->input->post('input_negeri_bil')
        );
        
        $return_data['insert_data'] = $this->db->insert('daerah', $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;

    }
    
    public function daerah_negeri($negeri_bil)
    {
        $this->db->select('*');
        $this->db->where('negeri_bil', $negeri_bil);
        $query = $this->db->get('daerah');
        return $query->result();
    }

}
?>
