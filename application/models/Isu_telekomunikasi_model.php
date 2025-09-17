<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Isu_telekomunikasi_model extends CI_Model
{

    public function terima($kluster, $laporan, $pelapor, $tahun){
        $namaTable = $kluster."_".$pelapor.'_'.$tahun;
        if($this->db->table_exists($namaTable) != FALSE){
            $data = array(
                'tapisan' => 'Terima'
            );
            $this->db->where('bil', $laporan);
            $this->db->update($namaTable, $data);
        }
    }

    public function hantarPPD($kluster, $laporan, $pelapor, $tahun){
        $namaTable = $kluster."_".$pelapor.'_'.$tahun;
        if($this->db->table_exists($namaTable) != FALSE){
            $data = array(
                'tapisan' => 'Draf'
            );
            $this->db->where('bil', $laporan);
            $this->db->update($namaTable, $data);
        }
    }

    public function hantarHq($kluster, $laporan, $pelapor, $tahun){
        $namaTable = $kluster."_".$pelapor.'_'.$tahun;
        if($this->db->table_exists($namaTable) != FALSE){
            $data = array(
                'tapisan' => 'Hantar HQ'
            );
            $this->db->where('bil', $laporan);
            $this->db->update($namaTable, $data);
        }
    }

    public function hantarNegeri($kluster, $laporan, $pelapor, $tahun){
        $namaTable = $kluster."_".$pelapor.'_'.$tahun;
        if($this->db->table_exists($namaTable) != FALSE){
            $data = array(
                'tapisan' => 'Hantar Negeri'
            );
            $this->db->where('bil', $laporan);
            $this->db->update($namaTable, $data);
        }
    }

    public function isuRangkaian($telekomunikasiBil, $pelaporBil, $tahun){
        $namaTable = 'telekomunikasi_rangkaian_'.$pelaporBil.'_'.$tahun;
        if($this->db->table_exists($namaTable) != FALSE){
            $this->db->where('telekomunikasi', $telekomunikasiBil);
            $query = $this->db->get($namaTable);
            return $query->row();
        }
    }

    public function papar($telekomunikasiBil, $pelaporBil, $tahun){
        $namaTable = 'telekomunikasi_'.$pelaporBil.'_'.$tahun;
        if($this->db->table_exists($namaTable) != FALSE){
            $this->db->where('bil', $telekomunikasiBil);
            $query = $this->db->get($namaTable);
            return $query->row();
        }
    }

    public function tambah_internet($telekomunikasiBil, $namaDokumen)
    {
        $pelapor = $this->input->post('input_pelapor');
        $tahun = date_format(date_create($this->input->post('input_tarikh_laporan')), 'Y');
        $this->checkTableExists($pelapor, $tahun);
        $data = array(
            'tarikh_laporan' => date_format(date_create($this->input->post('input_tarikh_laporan')), 'Y-m-d'),
            'pelapor' => $this->input->post('input_pelapor'),
            'download' => $this->input->post('input_download'),
            'upload' => $this->input->post('input_upload'),
            'ping' => $this->input->post('input_ping'),
            'mobile_operator' => $this->input->post('input_mobile'),
            'dokumen' => $namaDokumen,
            'telekomunikasi' => $telekomunikasiBil,
            'pengguna_bil' => $this->input->post('input_pengguna_bil'),
            'pengguna_waktu' => date('Y-m-d H:i:s')
        );
        $this->db->insert('telekomunikasi_rangkaian_'.$pelapor.'_'.$tahun, $data);
    }

    public function senarai_laporan($pelapor, $tahun)
    {
        $namaTable = 'telekomunikasi_'.$pelapor.'_'.$tahun;
        if($this->db->table_exists($namaTable) != FALSE){
            $this->db->select('*');
            $this->db->select($namaTable.'.bil AS laporanBil');
            $this->db->select('daerah.bil AS daerahBil');
            $this->db->select('daerah.nama AS daerahNama');
            $this->db->join('daerah', 'daerah.bil = '.$namaTable.'.daerah', 'left');
            $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
            $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = '.$namaTable.'.parlimen', 'left');
            $this->db->join('dun_tb', 'dun_tb.dun_bil = '.$namaTable.'.dun', 'left');
            $this->db->join('pdm_parlimen_tb', 'pdm_parlimen_tb.ppt_parlimen_bil = '.$namaTable.'.pdm', 'left');
            $query = $this->db->get('telekomunikasi_'.$pelapor.'_'.$tahun);
            return $query->result();
        }
    }

    public function tambah()
    {
        $pelapor = $this->input->post('input_pelapor');
        $tahun = date('Y');
        $this->checkTableExists($pelapor, $tahun);
        $lain = $this->input->post('input_tajuk_isu_lain');
        $daerahBil = $this->input->post('input_daerah');
        $isu_telekomunikasi = $this->input->post('input_tajuk_isu');
        if(!empty($lain) && $isu_telekomunikasi == 'Lain-lain'){
            $isu_telekomunikasi = $lain;
        }
        $data = array(
            'tarikh_laporan' => date_format(date_create($this->input->post('input_tarikh_laporan')), 'Y-m-d'),
            'pelapor' => $this->input->post('input_pelapor'),
            'parlimen' => $this->input->post('input_parlimen'),
            'dun' => $this->input->post('input_dun'),
            'pdm' => $this->input->post('input_pdm'),
            'ringkasan_isu' => $this->input->post('input_ringkasan_isu'),
            'lokasi_isu' => $this->input->post('input_lokasi'),
            'latitude' => $this->input->post('input_latitude'),
            'longitude' => $this->input->post('input_longitude'),
            'kluster_bil' => $this->input->post('input_kluster_bil'),
            'pengguna_bil' => $this->input->post('input_pengguna_bil'),
            'pengguna_waktu' => date('Y-m-d H:i:s'),
            'daerah' => $this->input->post('input_daerah'),
            'jenis_kawasan' => $this->input->post('input_jenis_kawasan'),
            'isu_telekomunikasi' => $isu_telekomunikasi,
            'tapisan' => 'Terima',
            'cadangan_intervensi' => $this->input->post('input_cadangan_intervensi')
        );
        $this->db->insert('telekomunikasi_'.$pelapor.'_'.$tahun, $data);
        $lastId = $this->db->insert_id();
        return $lastId;
    }

    public function checkTableExists($pelapor, $tahun)
    {   
        $this->load->dbforge();
        $namaTable = 'telekomunikasi_'.$pelapor.'_'.$tahun;
        if($this->db->table_exists($namaTable) == FALSE){
            $fields = array(
                'bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'tarikh_laporan' => array(
                        'type' => 'DATE',
                        'null' => TRUE
                ),
                'pelapor' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'parlimen' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'dun' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'pdm' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'ringkasan_isu' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'lokasi_isu' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'latitude' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'longitude' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'kluster_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
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
                ),
                'daerah' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 200,
                    'null' => TRUE
                ),
                'jenis_kawasan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => TRUE
                ),
                'isu_telekomunikasi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'cadangan_intervensi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'tapisan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('bil', TRUE);
            $this->dbforge->create_table('telekomunikasi_'.$pelapor.'_'.$tahun, TRUE);
            $tableTele2 = 'telekomunikasi_rangkaian_'.$pelapor.'_'.$tahun;
            if($this->db->table_exists($tableTele2) == FALSE){
                $fields2 = array(
                    'bil' => array(
                            'type' => 'BIGINT',
                            'constraint' => '20',
                            'null'=> FALSE,
                            'auto_increment' => TRUE,
                            'primary_key' => TRUE
                    ),
                    'tarikh_laporan' => array(
                            'type' => 'DATE',
                            'null' => TRUE
                    ),
                    'pelapor' => array(
                            'type' => 'BIGINT',
                            'constraint' => '20',
                            'null' => TRUE
                    ),
                    'download' => array(
                        'type' => 'VARCHAR',
                        'constraint' => 50,
                        'null' => TRUE
                    ),
                    'upload' => array(
                        'type' => 'VARCHAR',
                        'constraint' => 50,
                        'null' => TRUE
                    ),
                    'ping' => array(
                        'type' => 'VARCHAR',
                        'constraint' => 50,
                        'null' => TRUE
                    ),
                    'mobile_operator' => array(
                        'type' => 'VARCHAR',
                        'constraint' => 200,
                        'null' => TRUE
                    ),
                    'dokumen' => array(
                        'type' => 'VARCHAR',
                        'constraint' => 200,
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
                    ),
                    'telekomunikasi' => array(
                        'type' => 'BIGINT',
                        'constraint' => 20,
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_field($fields2);
                $this->dbforge->add_key('bil', TRUE);
                $this->dbforge->create_table($tableTele2, TRUE);
            }
        }

        if($this->db->table_exists($namaTable) == TRUE){
            if ($this->db->field_exists('cadangan_intervensi', $namaTable) == FALSE)
            {   
                $fields = array(
                    'cadangan_intervensi' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($namaTable, $fields);
            }
            if ($this->db->field_exists('pdm', $namaTable) == FALSE)
            {   
                $fields = array(
                    'pdm' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($namaTable, $fields);
            }
            if ($this->db->field_exists('latitude', $namaTable) == FALSE)
            {   
                $fields = array(
                    'latitude' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($namaTable, $fields);
            }
            if ($this->db->field_exists('longitude', $namaTable) == FALSE)
            {   
                $fields = array(
                    'longitude' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($namaTable, $fields);
            }
        }

        
    }
}


?>