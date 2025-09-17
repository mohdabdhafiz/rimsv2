<?php 
class Rekod_pilihanraya_model extends CI_Model{

    protected $parlimen = 'rekod_pilihanraya_parlimen_tb';
    protected $dun = 'rekod_pilihanraya_dun_tb';

    public function rekod_terakhir_dun($dun_bil, $pilihanraya_bil)
    {
        $this->db->select('rpdt_peti_undi, rpdt_waktu, rpdt_kategori_perubahan');
        $this->db->where('rpdt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->where('rpdt_dun_bil', $dun_bil);
        $this->db->order_by('rpdt_waktu', 'DESC');
        $query = $this->db->get($this->dun);
        return $query->row();
    }

    public function rekod_terakhir_parlimen($parlimen_bil, $pilihanraya_bil)
    {
        $this->db->select('rppt_peti_undi, rppt_waktu, rppt_kategori_perubahan');
        $this->db->where('rppt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->where('rppt_parlimen_bil', $parlimen_bil);
        $this->db->order_by('rppt_waktu', 'DESC');
        $query = $this->db->get($this->parlimen);
        return $query->row();
    }

    public function peti_undi_dun($dun_bil, $pilihanraya_bil)
    {
        $this->db->select('rpdt_peti_undi');
        $this->db->where('rpdt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->where('rpdt_dun_bil', $dun_bil);
        $this->db->order_by('rpdt_waktu', 'DESC');
        $query = $this->db->get($this->dun);
        return $query->row();
    }

    public function peti_undi($parlimen_bil, $pilihanraya_bil)
    {
        $this->db->select('rppt_peti_undi');
        $this->db->where('rppt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->where('rppt_parlimen_bil', $parlimen_bil);
        $this->db->order_by('rppt_waktu', 'DESC');
        $query = $this->db->get($this->parlimen);
        return $query->row();
    }

    public function rekod_pilihanraya_dun($pilihanraya_bil){
        $this->db->where('rpdt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->order_by('rpdt_waktu', 'DESC');
        $this->db->limit(20);
        $query = $this->db->get($this->dun);
        return $query->result();
    }

    public function rekod_pilihanraya_parlimen($pilihanraya_bil){
        $this->db->where('rppt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->order_by('rppt_waktu', 'DESC');
        $this->db->limit(20);
        $query = $this->db->get($this->parlimen);
        return $query->result();
    }

    public function tambah_rekod_parlimen($parlimen_bil, $pilihanraya_bil, $kategori_perubahan, $calon_sebelum, $calon_selepas, $calon_baru, $majoriti, $waktu, $warna, $peti_undi)
    {
        $data = array(
            'rppt_parlimen_bil' => $parlimen_bil,
            'rppt_pilihanraya_bil' => $pilihanraya_bil,
            'rppt_kategori_perubahan' => $kategori_perubahan,
            'rppt_calon_sebelum' => $calon_sebelum,
            'rppt_calon_selepas' => $calon_selepas,
            'rppt_calon_baru' => $calon_baru,
            'rppt_majoriti' => $majoriti,
            'rppt_waktu' => $waktu,
            'rppt_warna' => $warna,
            'rppt_peti_undi' => $peti_undi
        );
        $this->db->insert($this->parlimen, $data);
    }

    public function tambah_rekod_dun($dun_bil, $pilihanraya_bil, $kategori_perubahan, $calon_sebelum, $calon_selepas, $calon_baru, $majoriti, $waktu, $warna, $peti_undi)
    {
        $data = array(
            'rpdt_dun_bil' => $dun_bil,
            'rpdt_pilihanraya_bil' => $pilihanraya_bil,
            'rpdt_kategori_perubahan' => $kategori_perubahan,
            'rpdt_calon_sebelum' => $calon_sebelum,
            'rpdt_calon_selepas' => $calon_selepas,
            'rpdt_calon_baru' => $calon_baru,
            'rpdt_majoriti' => $majoriti,
            'rpdt_waktu' => $waktu,
            'rpdt_warna' => $warna,
            'rpdt_peti_undi' => $peti_undi
        );
        $this->db->insert($this->dun, $data);
    }

}
?>