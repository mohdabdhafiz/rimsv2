<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peranan_model extends CI_Model {

    protected $table = 'peranan_tb';
    protected $tableTugasDaerah = 'tugas_daerah';
    protected $tableTugasParlimen = 'tugas_parlimen_tb';
    protected $tableTugasDun = 'tugas_dun_tb';
    protected $tableTugasNegeri = 'tugas_negeri';

    public function senaraiPerananPpdNegeri($negeriBil){
        $this->db->select('peranan_tb.peranan_bil AS perananBil');
        $this->db->select('peranan_tb.peranan_nama AS perananNama');
        $this->db->select('(
            SELECT japen_tb.jt_pejabat 
            FROM japen_tb
            LEFT JOIN organisasi ON organisasi.o_japen = japen_tb.jt_bil
            WHERE organisasi.o_peranan = perananBil
            LIMIT 1
            ) AS organisasiNama');
        $this->db->select('(
            SELECT COUNT(*)
            FROM program
            LEFT JOIN pengguna_tb ON pengguna_tb.bil = program.program_pelapor
            WHERE pengguna_tb.pengguna_peranan_bil = perananBil
            AND program.program_status = "Jadual Aktiviti"
        ) AS bilanganPerancangan');
        $this->db->select('(
            SELECT COUNT(*)
            FROM program
            LEFT JOIN pengguna_tb ON pengguna_tb.bil = program.program_pelapor
            WHERE pengguna_tb.pengguna_peranan_bil = perananBil
            AND program.program_status = "Selesai"
        ) AS bilanganPelaksanaan');
        $this->db->select('(
            SELECT COUNT(*)
            FROM program
            LEFT JOIN pengguna_tb ON pengguna_tb.bil = program.program_pelapor
            WHERE pengguna_tb.pengguna_peranan_bil = perananBil
            AND program.program_status != "Draf Negeri"
        ) AS jumlahLaporan');
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = tugas_daerah.peranan_bil', 'left');
        $this->db->join('daerah', 'daerah.bil = tugas_daerah.daerah_bil', 'left');
        $this->db->where('daerah.negeri_bil', $negeriBil);
        $this->db->group_by('peranan_tb.peranan_bil');
        $this->db->order_by('organisasiNama', 'ASC');
        $query = $this->db->get($this->tableTugasDaerah);
        return $query->result();
    }

    public function senaraiAkaunIpn(){
        $this->db->select('peranan_tb.peranan_bil AS perananBil');
        $this->db->select('peranan_tb.peranan_nama AS perananNama');
        $this->db->select('(
            SELECT japen_tb.jt_pejabat 
            FROM japen_tb
            LEFT JOIN organisasi ON organisasi.o_japen = japen_tb.jt_bil
            WHERE organisasi.o_peranan = perananBil
            LIMIT 1
            ) AS organisasiNama');
        $this->db->select('(
            SELECT COUNT(*)
            FROM program
            LEFT JOIN pengguna_tb ON pengguna_tb.bil = program.program_pelapor
            WHERE pengguna_tb.pengguna_peranan_bil = perananBil
            AND program.program_status = "Jadual Aktiviti"
        ) AS bilanganPerancangan');
        $this->db->select('(
            SELECT COUNT(*)
            FROM program
            LEFT JOIN pengguna_tb ON pengguna_tb.bil = program.program_pelapor
            WHERE pengguna_tb.pengguna_peranan_bil = perananBil
            AND program.program_status = "Selesai"
        ) AS bilanganPelaksanaan');
        $this->db->select('(
            SELECT COUNT(*)
            FROM program
            LEFT JOIN pengguna_tb ON pengguna_tb.bil = program.program_pelapor
            WHERE pengguna_tb.pengguna_peranan_bil = perananBil
            AND program.program_status != "Draf"
        ) AS jumlahLaporan');
        $this->db->join('tugas_negeri', 'tugas_negeri.peranan = peranan_tb.peranan_bil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = '.$this->tableTugasNegeri.'.negeri', 'left');
        $this->db->where('tugas_negeri.peranan !=', '');
        $this->db->like('peranan_tb.peranan_nama', 'PKPM');
        $this->db->group_by('peranan_tb.peranan_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kodPerananPpn(){
        $this->db->select("peranan_tb.peranan_bil AS perananBil");
        $this->db->select("peranan_tb.peranan_nama AS perananNama");
        $this->db->like('peranan_tb.peranan_nama', 'ppn');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function padamTugasDun(){
        $this->db->where('tdt_bil', $this->input->post('inputTugasanBil'));
        $this->db->delete($this->tableTugasDun);
    }

    public function padamTugasParlimen(){
        $this->db->where('tpt_bil', $this->input->post('inputTugasanBil'));
        $this->db->delete($this->tableTugasParlimen);
    }

    public function padamTugasDaerah(){
        $this->db->where('bil', $this->input->post('inputTugasanBil'));
        $this->db->delete($this->tableTugasDaerah);
    }

    public function senaraiPenuhTugasDun(){
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = tugas_dun_tb.tdt_peranan_bil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = tugas_dun_tb.tdt_dun_bil', 'left');
        $this->db->order_by($this->tableTugasDun.'.tdt_waktu', 'DESC');
        $query = $this->db->get($this->tableTugasDun);
        return $query->result();
    }

    public function senaraiPenuhTugasParlimen(){
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = tugas_parlimen_tb.tpt_peranan_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = tugas_parlimen_tb.tpt_parlimen_bil', 'left');
        $this->db->order_by($this->tableTugasParlimen.'.tpt_waktu', 'DESC');
        $query = $this->db->get($this->tableTugasParlimen);
        return $query->result();
    }

    public function senaraiPenuhTugasDaerah(){
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = tugas_daerah.peranan_bil', 'left');
        $this->db->join('daerah', 'daerah.bil = tugas_daerah.daerah_bil', 'left');
        $this->db->order_by($this->tableTugasDaerah.'.waktu', 'DESC');
        $query = $this->db->get($this->tableTugasDaerah);
        return $query->result();
    }

    public function senaraiPpd(){
        $this->db->select("pt.peranan_nama");
        $this->db->select("japen_tb.jt_pejabat AS namaOrganisasi");
        $this->db->select("pengguna_tb.nama_penuh AS namaPpd");
        $this->db->select("(
            SELECT GROUP_CONCAT(DISTINCT(negeri_tb.nt_nama) SEPARATOR ', ')
            FROM negeri_tb
            LEFT JOIN daerah ON daerah.negeri_bil = negeri_tb.nt_bil
            LEFT JOIN tugas_daerah ON daerah.bil = tugas_daerah.daerah_bil
            WHERE tugas_daerah.peranan_bil = pt.peranan_bil 
            ORDER BY negeri_tb.nt_nama ASC
            ) AS senaraiNegeri");
        $this->db->select("(
            SELECT GROUP_CONCAT(daerah.nama SEPARATOR ', ')
            FROM tugas_daerah
            LEFT JOIN daerah ON daerah.bil = tugas_daerah.daerah_bil
            WHERE tugas_daerah.peranan_bil = pt.peranan_bil 
        ) AS senaraiDaerah");
        $this->db->select("(
            SELECT GROUP_CONCAT(parlimen_tb.pt_nama SEPARATOR ', ')
            FROM parlimen_tb
            LEFT JOIN tugas_parlimen_tb ON tugas_parlimen_tb.tpt_parlimen_bil = parlimen_tb.pt_bil
            WHERE tugas_parlimen_tb.tpt_peranan_bil = pt.peranan_bil 
            ORDER BY parlimen_tb.pt_nama ASC
        ) AS senaraiParlimen");
        $this->db->select("(
            SELECT GROUP_CONCAT(dun_tb.dun_nama SEPARATOR ', ')
            FROM dun_tb
            LEFT JOIN tugas_dun_tb ON tugas_dun_tb.tdt_dun_bil = dun_tb.dun_bil
            WHERE tugas_dun_tb.tdt_peranan_bil = pt.peranan_bil 
            ORDER BY dun_tb.dun_nama ASC
        ) AS senaraiDun");
        $this->db->join('organisasi', 'organisasi.o_peranan = pt.peranan_bil', 'left');
        $this->db->join('japen_tb', 'japen_tb.jt_bil = organisasi.o_japen', 'left');
        $this->db->join('ppd', 'ppd.p_peranan = pt.peranan_bil', 'left');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = ppd.p_anggota', 'left');
        $this->db->like('pt.peranan_nama', 'ppd');
        $query = $this->db->get($this->table." AS pt");
        return $query->result();
    }

    public function organisasi($perananBil){
        $this->db->join('organisasi', 'organisasi.o_peranan = peranan_tb.peranan_bil', 'left');
        $this->db->join('japen_tb', 'japen_tb.jt_bil = organisasi.o_japen', 'left');
        $this->db->where('peranan_tb.peranan_bil', $perananBil);
        $query = $this->db->get($this->table);
        return $query->row();
    }


    public function tugasNegeriPeranan($perananBil){
        //LEFT JOIN NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = '.$this->tableTugasNegeri.'.negeri', 'left');
        $this->db->where('peranan', $perananBil);
        $query = $this->db->get($this->tableTugasNegeri);
        return $query->result();
    }

    public function padamTugasNegeri(){
        $this->db->where('bil', $this->input->post('inputTugasanBil'));
        $this->db->delete($this->tableTugasNegeri);
    }

    public function senaraiPenuhTugasNegeri(){
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = tugas_negeri.peranan', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = tugas_negeri.negeri', 'left');
        $this->db->order_by($this->tableTugasNegeri.'.pengguna_waktu', 'DESC');
        $query = $this->db->get($this->tableTugasNegeri);
        return $query->result();
    }

    public function tugasNegeri($perananBil, $negeriBil)
    {
        $this->db->select('bil');
        $this->db->where('peranan', $perananBil);
        $this->db->where('negeri', $negeriBil);
        $query = $this->db->get($this->tableTugasNegeri);
        return $query->result();
    }

    public function setTugasanNegeri()
    {
        $perananBil = $this->input->post('inputPerananBil');
        $negeriBil = $this->input->post('inputNegeri');
        $ada = $this->tugasNegeri($perananBil, $negeriBil);
        if(empty($ada)){
            $data = array(
                'peranan' => $perananBil,
                'negeri' => $negeriBil,
                'pengguna_bil' => $this->input->post('inputPenggunaBil'),
                'pengguna_waktu' => date('Y-m-d H:i:s')
            );
            $this->db->insert($this->tableTugasNegeri, $data);
        }
    }

    public function senaraiPerananIkutParlimen($parlimenBil)
    {
        $this->db->select('tpt_peranan_bil');
        $this->db->where('tpt_parlimen_bil', $parlimenBil);
        $query = $this->db->get($this->tableTugasParlimen);
        return $query->result();
    }

    public function senaraiPerananIkutDun($dunBil)
    {
        $this->db->select('tdt_peranan_bil');
        $this->db->where('tdt_dun_bil', $dunBil);
        $query = $this->db->get($this->tableTugasDun);
        return $query->result();
    }

    public function tugasParlimen($perananBil, $parlimenBil)
    {
        $this->db->select('tpt_bil');
        $this->db->where('tpt_peranan_bil', $perananBil);
        $this->db->where('tpt_parlimen_bil', $dunBil);
        $query = $this->db->get($this->tableTugasParlimen);
        return $query->result();
    }

    public function setTugasanParlimen()
    {
        $perananBil = $this->input->post('inputPerananBil');
        $parlimenBil = $this->input->post('inputParlimen');
        $ada = $this->tugasParlimen($perananBil, $parlimenBil);
        if(empty($ada)){
            $data = array(
                'tpt_peranan_bil' => $perananBil,
                'tpt_parlimen_bil' => $parlimenBil,
                'tpt_pengguna_bil' => $this->input->post('inputPenggunaBil'),
                'tpt_waktu' => date('Y-m-d H:i:s')
            );
            $this->db->insert($this->tableTugasParlimen, $data);
        }
    }

    public function tugasDun($perananBil, $dunBil)
    {
        $this->db->select('tdt_bil');
        $this->db->where('tdt_peranan_bil', $perananBil);
        $this->db->where('tdt_dun_bil', $dunBil);
        $query = $this->db->get($this->tableTugasDun);
        return $query->result();
    }

    public function setTugasanDun()
    {
        $perananBil = $this->input->post('inputPerananBil');
        $dunBil = $this->input->post('inputDun');
        $ada = $this->tugasDun($perananBil, $dunBil);
        if(empty($ada)){
            $data = array(
                'tdt_peranan_bil' => $perananBil,
                'tdt_dun_bil' => $dunBil,
                'tdt_pengguna_bil' => $this->input->post('inputPenggunaBil'),
                'tdt_waktu' => date('Y-m-d H:i:s')
            );
            $this->db->insert($this->tableTugasDun, $data);
        }
    }

    public function tugasDaerah($perananBil, $daerahBil)
    {
        $this->db->select('bil');
        $this->db->where('peranan_bil', $perananBil);
        $this->db->where('daerah_bil', $daerahBil);
        $query = $this->db->get($this->tableTugasDaerah);
        return $query->result();
    }

    public function setTugasanDaerah()
    {
        $perananBil = $this->input->post('inputPerananBil');
        $daerahBil = $this->input->post('inputDaerah');
        $ada = $this->tugasDaerah($perananBil, $daerahBil);
        if(empty($ada)){
            $data = array(
                'peranan_bil' => $perananBil,
                'daerah_bil' => $daerahBil,
                'pengguna_bil' => $this->input->post('inputPenggunaBil'),
                'waktu' => date('Y-m-d H:i:s')
            );
            $this->db->insert($this->tableTugasDaerah, $data);
        }
    }

    public function senarai()
    {
        $this->db->select('peranan_bil');
        $this->db->select('peranan_nama');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiPerananNegeri($negeriBil){
        $this->db->join('tugas_daerah', 'tugas_daerah.peranan_bil = peranan_tb.peranan_bil', 'left');
        $this->db->join('daerah', 'daerah.bil = tugas_daerah.daerah_bil', 'left');
        $this->db->where('daerah.negeri_bil', $negeriBil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_dun($peranan_bil)
    {
        $this->db->join('dun_tb', 'dun_tb.dun_bil = tugas_dun_tb.tdt_dun_bil');
        $this->db->where('tugas_dun_tb.tdt_peranan_bil', $peranan_bil);
        $query = $this->db->get('tugas_dun_tb');
        return $query->result();
    }

    public function senarai_parlimen($peranan_bil)
    {
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = tugas_parlimen_tb.tpt_parlimen_bil');
        $this->db->where('tugas_parlimen_tb.tpt_peranan_bil', $peranan_bil);
        $query = $this->db->get('tugas_parlimen_tb');
        return $query->result();
    }

    public function senarai_daerah($peranan_bil)
    {
        $this->db->join('daerah', 'daerah.bil = tugas_daerah.daerah_bil');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil');
        $this->db->where('peranan_bil', $peranan_bil);
        $query = $this->db->get('tugas_daerah');
        return $query->result();
    }

    public function senarai_peranan_ppd(){
        $this->db->like('peranan_nama', 'ppd');
        $this->db->order_by('peranan_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function negeri_parlimen($peranan_bil)
    {
        $this->db->select('parlimen_tb.pt_negeri');
        $this->db->join('tugas_parlimen_tb', 'tugas_parlimen_tb.tpt_peranan_bil = peranan_tb.peranan_bil');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = tugas_parlimen_tb.tpt_parlimen_bil');
        $this->db->where('peranan_tb.peranan_bil', $peranan_bil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function negeri_dun($peranan_bil)
    {
        $this->db->select('dun_tb.dun_negeri');
        $this->db->join('tugas_dun_tb', 'tugas_dun_tb.tdt_peranan_bil = peranan_tb.peranan_bil');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = tugas_dun_tb.tdt_dun_bil');
        $this->db->where('peranan_tb.peranan_bil', $peranan_bil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

	public function daftar()
	{
        $data = array(
            'peranan_nama' => $this->input->post('peranan_nama'),
            'peranan_petugas' => $this->input->post('peranan_petugas'),
            'peranan_waktu' => date ('Y-m-d H:i:s'),
            'peranan_dicipta' => $this->input->post('peranan_pencipta')          
        );

        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
    return $return_data;
    }

    public function tambah_manual($peranan_nama)
	{
        $data = array(
            'peranan_nama' => $peranan_nama,
            'peranan_waktu' => date ('Y-m-d H:i:s'),
            'peranan_dicipta' => '9'       
        );

        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
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
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = peranan_tb.peranan_petugas', 'left');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senarai_peranan(){
        $this->db->join('organisasi', 'organisasi.o_peranan = peranan_tb.peranan_bil', 'left');
        $this->db->join('japen_tb', 'japen_tb.jt_bil = organisasi.o_japen', 'left');
        $this->db->order_by('peranan_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_peranan($peranan_nama){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = peranan_tb.peranan_petugas', 'left');
        $this->db->where('peranan_tb.peranan_nama', $peranan_nama);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar($bil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = peranan_tb.peranan_petugas', 'left');
        $this->db->where('peranan_tb.peranan_bil', $bil);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function padam($bil){
        $this->db->where('peranan_bil', $bil);
        $this->db->delete($this->table);
    }

    public function peranan($perananBil)
    {
        $this->db->where('peranan_bil', $perananBil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function ada($peranan_nama)
    {
        $this->db->where('peranan_nama', $peranan_nama);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    


}
