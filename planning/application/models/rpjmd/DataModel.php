<?php

class DataModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Filter');
    }

    public function getAllOpd(){
        
        $data = $this->db->get('tb_sub_unit')->result_array();
        return $data;
    }
    public function getAllSatuan(){
        
        $data = $this->db->get('tb_satuan')->result_array();
        return $data;
    }
    
    public function getAllSasaran(){
        $data = $this->db->get('tb_rpjmd_sasaran')->result_array();
        return $data;
    }

    public function getSumberDana(){
        $data = $this->db->get('tb_sumber_dana')->result_array();
        return $data;
    }

    public function getRowVisi(){
        $this->db->where('id_tb_rpjmd', $this->session->rpjmd);
        $data = $this->db->get('tb_rpjmd')->row();
        return $data;
    }

    public function getDataFungsi(){
        $data = $this->db->get('tb_fungsi')->result_array();
        return $data;
    }

    public function getRowMisi($kode){
        $table = 'tb_rpjmd_misi';
        $this->db->join('tb_rpjmd', 'tb_rpjmd.id_tb_rpjmd = '.$table.'.id_tb_rpjmd', 'left');
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_rpjmd_misi_kode', $kode);
        $data = $this->db->get($table)->row();
        return $data;
    }

    public function getRowTujuan($kode){
        $kode = explode("-", $kode);
        $table = 'tb_rpjmd_tujuan';
        $this->db->join('tb_rpjmd', 'tb_rpjmd.id_tb_rpjmd = '.$table.'.id_tb_rpjmd', 'left');
        $this->db->join('tb_rpjmd_misi', 'tb_rpjmd_misi.id_tb_rpjmd = '.$table.'.id_tb_rpjmd
                    AND tb_rpjmd_misi.tb_rpjmd_misi_kode = '.$table.'.tb_rpjmd_misi_kode', 'left');
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_rpjmd_misi_kode', $kode[0]);
        $this->db->where($table.'.tb_rpjmd_tujuan_kode', $kode[1]);
        $data = $this->db->get($table)->row();
        return $data;
    }

    public function getRowSasaran($kode){
        $kode = explode("-", $kode);
        $table = 'tb_rpjmd_sasaran';
        $this->db->join('tb_rpjmd', 'tb_rpjmd.id_tb_rpjmd = '.$table.'.id_tb_rpjmd', 'left');
        $this->db->join('tb_rpjmd_misi', 'tb_rpjmd_misi.id_tb_rpjmd = '.$table.'.id_tb_rpjmd
                    AND tb_rpjmd_misi.tb_rpjmd_misi_kode = '.$table.'.tb_rpjmd_misi_kode', 'left');
        $this->db->join('tb_rpjmd_tujuan', 'tb_rpjmd_tujuan.id_tb_rpjmd = '.$table.'.id_tb_rpjmd
                                    AND tb_rpjmd_tujuan.tb_rpjmd_misi_kode = '.$table.'.tb_rpjmd_misi_kode
                                    AND tb_rpjmd_tujuan.tb_rpjmd_tujuan_kode = '.$table.'.tb_rpjmd_tujuan_kode', 'left');
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_rpjmd_misi_kode', $kode[0]);
        $this->db->where($table.'.tb_rpjmd_tujuan_kode', $kode[1]);
        $this->db->where($table.'.tb_rpjmd_sasaran_kode', $kode[2]);
        $data = $this->db->get($table)->row();
        return $data;
    }

    public function getRowOpd($kode){
        $kode = explode("-", $kode);
        
        $table = 'tb_rpjmd_opd';
        $this->db->join('tb_rpjmd', 'tb_rpjmd.id_tb_rpjmd = '.$table.'.id_tb_rpjmd', 'left');
        $this->db->join('tb_rpjmd_misi', 'tb_rpjmd_misi.id_tb_rpjmd = '.$table.'.id_tb_rpjmd
                    AND tb_rpjmd_misi.tb_rpjmd_misi_kode = '.$table.'.tb_rpjmd_misi_kode', 'left');
        $this->db->join('tb_rpjmd_tujuan', 'tb_rpjmd_tujuan.id_tb_rpjmd = '.$table.'.id_tb_rpjmd
                                    AND tb_rpjmd_tujuan.tb_rpjmd_misi_kode = '.$table.'.tb_rpjmd_misi_kode
                                    AND tb_rpjmd_tujuan.tb_rpjmd_tujuan_kode = '.$table.'.tb_rpjmd_tujuan_kode', 'left');
        $this->db->join('tb_rpjmd_sasaran', 'tb_rpjmd_sasaran.id_tb_rpjmd = '.$table.'.id_tb_rpjmd
                                    AND tb_rpjmd_sasaran.tb_rpjmd_misi_kode = '.$table.'.tb_rpjmd_misi_kode
                                    AND tb_rpjmd_sasaran.tb_rpjmd_tujuan_kode = '.$table.'.tb_rpjmd_tujuan_kode
                                    AND tb_rpjmd_sasaran.tb_rpjmd_sasaran_kode = '.$table.'.tb_rpjmd_sasaran_kode', 'left');
        $this->db->join('tb_sub_unit', 'tb_sub_unit.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_sub_unit.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_sub_unit.tb_unit_kode = '.$table.'.tb_unit_kode
                                    AND tb_sub_unit.tb_sub_unit_kode = '.$table.'.tb_sub_unit_kode');
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_rpjmd_misi_kode', $kode[0]);
        $this->db->where($table.'.tb_rpjmd_tujuan_kode', $kode[1]);
        $this->db->where($table.'.tb_rpjmd_sasaran_kode', $kode[2]);
        $this->db->where($table.'.tb_urusan_kode', $kode[3]);
        $this->db->where($table.'.tb_bidang_kode', $kode[4]);
        $this->db->where($table.'.tb_unit_kode', $kode[5]);
        $this->db->where($table.'.tb_sub_unit_kode', $kode[6]);
        $data = $this->db->get($table)->row();
        return $data;
    }

    public function getRowProgram($kode, $jenis = null){
        $kode = explode("-", $kode);
        $table = 'tb_rpjmd_program';
        if($jenis == null){
            $jenis = $this->filter->getJenisRpjmd();
        }
        if($jenis == 2){
            $table = 'tb_rpjmd_program_penetapan';
        }else if($jenis == 3){
            $table = 'tb_rpjmd_program_perubahan';
        }
        $this->db->join('tb_rpjmd', 'tb_rpjmd.id_tb_rpjmd = '.$table.'.id_tb_rpjmd', 'left');
        $this->db->join('tb_rpjmd_misi', 'tb_rpjmd_misi.id_tb_rpjmd = '.$table.'.id_tb_rpjmd
                    AND tb_rpjmd_misi.tb_rpjmd_misi_kode = '.$table.'.tb_rpjmd_misi_kode', 'left');
        $this->db->join('tb_rpjmd_tujuan', 'tb_rpjmd_tujuan.id_tb_rpjmd = '.$table.'.id_tb_rpjmd
                                    AND tb_rpjmd_tujuan.tb_rpjmd_misi_kode = '.$table.'.tb_rpjmd_misi_kode
                                    AND tb_rpjmd_tujuan.tb_rpjmd_tujuan_kode = '.$table.'.tb_rpjmd_tujuan_kode', 'left');
        $this->db->join('tb_rpjmd_sasaran', 'tb_rpjmd_sasaran.id_tb_rpjmd = '.$table.'.id_tb_rpjmd
                                    AND tb_rpjmd_sasaran.tb_rpjmd_misi_kode = '.$table.'.tb_rpjmd_misi_kode
                                    AND tb_rpjmd_sasaran.tb_rpjmd_tujuan_kode = '.$table.'.tb_rpjmd_tujuan_kode
                                    AND tb_rpjmd_sasaran.tb_rpjmd_sasaran_kode = '.$table.'.tb_rpjmd_sasaran_kode', 'left');
        $this->db->join('tb_program', 'tb_program.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_program.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_program.tb_program_kode = '.$table.'.tb_program_kode', 'left');
        $this->db->join('tb_sub_unit', 'tb_sub_unit.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_sub_unit.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_sub_unit.tb_unit_kode = '.$table.'.tb_unit_kode
                                    AND tb_sub_unit.tb_sub_unit_kode = '.$table.'.tb_sub_unit_kode');
        $this->db->join('tb_urusan', 'tb_urusan.tb_urusan_kode = '.$table.'.tb_urusan_kode');
        $this->db->join('tb_bidang', 'tb_bidang.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_bidang.tb_bidang_kode = '.$table.'.tb_bidang_kode');
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_rpjmd_misi_kode', $kode[0]);
        $this->db->where($table.'.tb_rpjmd_tujuan_kode', $kode[1]);
        $this->db->where($table.'.tb_rpjmd_sasaran_kode', $kode[2]);
        $this->db->where($table.'.tb_urusan_kode', $kode[3]);
        $this->db->where($table.'.tb_bidang_kode', $kode[4]);
        $this->db->where($table.'.tb_unit_kode', $kode[5]);
        $this->db->where($table.'.tb_sub_unit_kode', $kode[6]);
        $this->db->where($table.'.tb_program_kode', $kode[7]);
        $data = $this->db->get($table)->row();
        return $data;
    }

    public function getRowKegiatan($kode, $jenis = null){
        $kode = explode("-", $kode);
        
        $table = 'tb_rpjmd_kegiatan';
        if($jenis == null){
            $jenis = $this->filter->getJenisRpjmd();
        }
        if($jenis == 2){
            $table = 'tb_rpjmd_kegiatan_penetapan';
        }else if($jenis == 3){
            $table = 'tb_rpjmd_kegiatan_perubahan';
        }
        $this->db->join('tb_rpjmd', 'tb_rpjmd.id_tb_rpjmd = '.$table.'.id_tb_rpjmd', 'left');
        $this->db->join('tb_rpjmd_misi', 'tb_rpjmd_misi.id_tb_rpjmd = '.$table.'.id_tb_rpjmd
                    AND tb_rpjmd_misi.tb_rpjmd_misi_kode = '.$table.'.tb_rpjmd_misi_kode', 'left');
        $this->db->join('tb_rpjmd_tujuan', 'tb_rpjmd_tujuan.id_tb_rpjmd = '.$table.'.id_tb_rpjmd
                                    AND tb_rpjmd_tujuan.tb_rpjmd_misi_kode = '.$table.'.tb_rpjmd_misi_kode
                                    AND tb_rpjmd_tujuan.tb_rpjmd_tujuan_kode = '.$table.'.tb_rpjmd_tujuan_kode', 'left');
        $this->db->join('tb_rpjmd_sasaran', 'tb_rpjmd_sasaran.id_tb_rpjmd = '.$table.'.id_tb_rpjmd
                                    AND tb_rpjmd_sasaran.tb_rpjmd_misi_kode = '.$table.'.tb_rpjmd_misi_kode
                                    AND tb_rpjmd_sasaran.tb_rpjmd_tujuan_kode = '.$table.'.tb_rpjmd_tujuan_kode
                                    AND tb_rpjmd_sasaran.tb_rpjmd_sasaran_kode = '.$table.'.tb_rpjmd_sasaran_kode', 'left');
        $this->db->join('tb_program', 'tb_program.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_program.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_program.tb_program_kode = '.$table.'.tb_program_kode', 'left');
        $this->db->join('tb_kegiatan', 'tb_kegiatan.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_kegiatan.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_kegiatan.tb_program_kode = '.$table.'.tb_program_kode
                                    AND tb_kegiatan.tb_kegiatan_kode = '.$table.'.tb_kegiatan_kode', 'left');
        $this->db->join('tb_sub_unit', 'tb_sub_unit.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_sub_unit.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_sub_unit.tb_unit_kode = '.$table.'.tb_unit_kode
                                    AND tb_sub_unit.tb_sub_unit_kode = '.$table.'.tb_sub_unit_kode');
        $this->db->join('tb_urusan', 'tb_urusan.tb_urusan_kode = '.$table.'.tb_urusan_kode');
        $this->db->join('tb_bidang', 'tb_bidang.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_bidang.tb_bidang_kode = '.$table.'.tb_bidang_kode');
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_rpjmd_misi_kode', $kode[0]);
        $this->db->where($table.'.tb_rpjmd_tujuan_kode', $kode[1]);
        $this->db->where($table.'.tb_rpjmd_sasaran_kode', $kode[2]);
        $this->db->where($table.'.tb_urusan_kode', $kode[3]);
        $this->db->where($table.'.tb_bidang_kode', $kode[4]);
        $this->db->where($table.'.tb_unit_kode', $kode[5]);
        $this->db->where($table.'.tb_sub_unit_kode', $kode[6]);
        $this->db->where($table.'.tb_program_kode', $kode[7]);
        $this->db->where($table.'.tb_kegiatan_kode', $kode[8]);
        $data = $this->db->get($table)->row();
        return $data;
    }
    
    public function getProgram($kode){
        $kode = explode("-", $kode);
        $this->db->where('tb_urusan_kode', $kode[0]);
        $this->db->where('tb_bidang_kode', $kode[1]);
        $data = $this->db->get('tb_program')->result_array();
        return $data;
    }
    
    public function getKegiatan($kode){
        $kode = explode("-", $kode);
        $this->db->where('tb_urusan_kode', $kode[0]);
        $this->db->where('tb_bidang_kode', $kode[1]);
        $this->db->where('tb_program_kode', $kode[2]);
        $data = $this->db->get('tb_kegiatan')->result_array();
        return $data;
    }

    public function getRekening3($kode){
        $kode = explode("-", $kode);
        $this->db->where('tb_rekening1_kode', $kode[0]);
        $this->db->where('tb_rekening2_kode', $kode[1]);
        $data = $this->db->get('tb_rekening3')->result_array();
        return $data;
    }

    public function getRekening4($kode){
        $kode = explode("-", $kode);
        $this->db->where('tb_rekening1_kode', $kode[0]);
        $this->db->where('tb_rekening2_kode', $kode[1]);
        $this->db->where('tb_rekening3_kode', $kode[2]);
        $data = $this->db->get('tb_rekening4')->result_array();
        return $data;
    }

    public function getRekening5($kode){
        $kode = explode("-", $kode);
        $this->db->where('tb_rekening1_kode', $kode[0]);
        $this->db->where('tb_rekening2_kode', $kode[1]);
        $this->db->where('tb_rekening3_kode', $kode[2]);
        $this->db->where('tb_rekening4_kode', $kode[3]);
        $data = $this->db->get('tb_rekening5')->result_array();
        return $data;
    }

    public function getLraRek1($kode){
        $table = 'tb_monev_lra_rek1';
        $this->db->join('tb_rekening1', 'tb_rekening1.tb_rekening1_kode = '.$table.'.tb_rekening1_kode', 'left');

        $kodeOpd = explode("-", $this->session->kodeOpd);
        $this->db->where($table.'.tb_urusan_kode', $kodeOpd[0]);
        $this->db->where($table.'.tb_bidang_kode', $kodeOpd[1]);
        $this->db->where($table.'.tb_unit_kode', $kodeOpd[2]);
        $this->db->where($table.'.tb_sub_unit_kode', $kodeOpd[3]);

        $kode = explode("-", $kode);
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_monev_lra_tahun', $this->session->tahun);
        $this->db->where($table.'.tb_rekening1_kode', $kode[0]);
        $data = $this->db->get($table)->row();
        return $data;
    }

    public function getLraRek2($kode){
        $table = 'tb_rekening2';
        $this->db->join('tb_rekening1', 'tb_rekening1.tb_rekening1_kode = '.$table.'.tb_rekening1_kode', 'left');

        $kode = explode("-", $kode);
        $this->db->where($table.'.tb_rekening1_kode', $kode[0]);
        $this->db->where($table.'.tb_rekening2_kode', $kode[1]);
        $data = $this->db->get($table)->row();
        print_r($data);
        return $data;
    }

    public function getLraRek2Program($kode){
        $table = 'tb_monev_lra_rek2_program';
        $this->db->join('tb_rekening1', 'tb_rekening1.tb_rekening1_kode = '.$table.'.tb_rekening1_kode', 'left');
        $this->db->join('tb_rekening2', 'tb_rekening2.tb_rekening1_kode = '.$table.'.tb_rekening1_kode
                                    AND tb_rekening2.tb_rekening2_kode = '.$table.'.tb_rekening2_kode', 'left');
        $this->db->join('tb_program', 'tb_program.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_program.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_program.tb_program_kode = '.$table.'.tb_program_kode', 'left');

        $kodeOpd = explode("-", $this->session->kodeOpd);
        $this->db->where($table.'.tb_urusan_kode', $kodeOpd[0]);
        $this->db->where($table.'.tb_bidang_kode', $kodeOpd[1]);
        $this->db->where($table.'.tb_unit_kode', $kodeOpd[2]);
        $this->db->where($table.'.tb_sub_unit_kode', $kodeOpd[3]);

        $kode = explode("-", $kode);
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_monev_lra_tahun', $this->session->tahun);
        $this->db->where($table.'.tb_rekening1_kode', 5);
        $this->db->where($table.'.tb_rekening2_kode', 2);
        $this->db->where($table.'.tb_program_kode', $kode[0]);
        $data = $this->db->get($table)->row();
        return $data;
    }

    public function getLraRek2Kegiatan($kode){
        $table = 'tb_monev_lra_rek2_kegiatan';
        $this->db->join('tb_rekening1', 'tb_rekening1.tb_rekening1_kode = '.$table.'.tb_rekening1_kode', 'left');
        $this->db->join('tb_rekening2', 'tb_rekening2.tb_rekening1_kode = '.$table.'.tb_rekening1_kode
                                    AND tb_rekening2.tb_rekening2_kode = '.$table.'.tb_rekening2_kode', 'left');
        $this->db->join('tb_program', 'tb_program.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_program.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_program.tb_program_kode = '.$table.'.tb_program_kode', 'left');
        $this->db->join('tb_kegiatan', 'tb_kegiatan.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_kegiatan.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_kegiatan.tb_program_kode = '.$table.'.tb_program_kode
                                    AND tb_kegiatan.tb_kegiatan_kode = '.$table.'.tb_kegiatan_kode', 'left');

        $kodeOpd = explode("-", $this->session->kodeOpd);
        $this->db->where($table.'.tb_urusan_kode', $kodeOpd[0]);
        $this->db->where($table.'.tb_bidang_kode', $kodeOpd[1]);
        $this->db->where($table.'.tb_unit_kode', $kodeOpd[2]);
        $this->db->where($table.'.tb_sub_unit_kode', $kodeOpd[3]);

        $kode = explode("-", $kode);
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_monev_lra_tahun', $this->session->tahun);
        $this->db->where($table.'.tb_rekening1_kode', 5);
        $this->db->where($table.'.tb_rekening2_kode', 2);
        $this->db->where($table.'.tb_program_kode', $kode[0]);
        $this->db->where($table.'.tb_kegiatan_kode', $kode[1]);
        $data = $this->db->get($table)->row();
        return $data;
    }

    public function getLraRek3($kode){
        $table = 'tb_monev_lra_rek3';
        $this->db->join('tb_rekening1', 'tb_rekening1.tb_rekening1_kode = '.$table.'.tb_rekening1_kode', 'left');
        $this->db->join('tb_rekening2', 'tb_rekening2.tb_rekening1_kode = '.$table.'.tb_rekening1_kode
                                    AND tb_rekening2.tb_rekening2_kode = '.$table.'.tb_rekening2_kode', 'left');
        $this->db->join('tb_program', 'tb_program.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_program.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_program.tb_program_kode = '.$table.'.tb_program_kode', 'left');
        $this->db->join('tb_kegiatan', 'tb_kegiatan.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_kegiatan.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_kegiatan.tb_program_kode = '.$table.'.tb_program_kode
                                    AND tb_kegiatan.tb_kegiatan_kode = '.$table.'.tb_kegiatan_kode', 'left');
        $this->db->join('tb_rekening3', 'tb_rekening3.tb_rekening1_kode = '.$table.'.tb_rekening1_kode
                                    AND tb_rekening3.tb_rekening2_kode = '.$table.'.tb_rekening2_kode
                                    AND tb_rekening3.tb_rekening3_kode = '.$table.'.tb_rekening3_kode', 'left');

        $kodeOpd = explode("-", $this->session->kodeOpd);
        $this->db->where($table.'.tb_urusan_kode', $kodeOpd[0]);
        $this->db->where($table.'.tb_bidang_kode', $kodeOpd[1]);
        $this->db->where($table.'.tb_unit_kode', $kodeOpd[2]);
        $this->db->where($table.'.tb_sub_unit_kode', $kodeOpd[3]);

        $kode = explode("-", $kode);
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_monev_lra_tahun', $this->session->tahun);
        $this->db->where($table.'.tb_rekening1_kode', 5);
        $this->db->where($table.'.tb_rekening2_kode', 2);
        $this->db->where($table.'.tb_program_kode', $kode[0]);
        $this->db->where($table.'.tb_kegiatan_kode', $kode[1]);
        $this->db->where($table.'.tb_rekening3_kode', $kode[2]);
        $data = $this->db->get($table)->row();
        return $data;
    }

    public function getLraRek4($kode){
        $table = 'tb_monev_lra_rek4';
        $this->db->join('tb_rekening1', 'tb_rekening1.tb_rekening1_kode = '.$table.'.tb_rekening1_kode', 'left');
        $this->db->join('tb_rekening2', 'tb_rekening2.tb_rekening1_kode = '.$table.'.tb_rekening1_kode
                                    AND tb_rekening2.tb_rekening2_kode = '.$table.'.tb_rekening2_kode', 'left');
        $this->db->join('tb_program', 'tb_program.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_program.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_program.tb_program_kode = '.$table.'.tb_program_kode', 'left');
        $this->db->join('tb_kegiatan', 'tb_kegiatan.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_kegiatan.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_kegiatan.tb_program_kode = '.$table.'.tb_program_kode
                                    AND tb_kegiatan.tb_kegiatan_kode = '.$table.'.tb_kegiatan_kode', 'left');
        $this->db->join('tb_rekening3', 'tb_rekening3.tb_rekening1_kode = '.$table.'.tb_rekening1_kode
                                    AND tb_rekening3.tb_rekening2_kode = '.$table.'.tb_rekening2_kode
                                    AND tb_rekening3.tb_rekening3_kode = '.$table.'.tb_rekening3_kode', 'left');
        $this->db->join('tb_rekening4', 'tb_rekening4.tb_rekening1_kode = '.$table.'.tb_rekening1_kode
                                    AND tb_rekening4.tb_rekening2_kode = '.$table.'.tb_rekening2_kode
                                    AND tb_rekening4.tb_rekening3_kode = '.$table.'.tb_rekening3_kode
                                    AND tb_rekening4.tb_rekening4_kode = '.$table.'.tb_rekening4_kode', 'left');

        $kodeOpd = explode("-", $this->session->kodeOpd);
        $this->db->where($table.'.tb_urusan_kode', $kodeOpd[0]);
        $this->db->where($table.'.tb_bidang_kode', $kodeOpd[1]);
        $this->db->where($table.'.tb_unit_kode', $kodeOpd[2]);
        $this->db->where($table.'.tb_sub_unit_kode', $kodeOpd[3]);

        $kode = explode("-", $kode);
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_monev_lra_tahun', $this->session->tahun);
        $this->db->where($table.'.tb_rekening1_kode', 5);
        $this->db->where($table.'.tb_rekening2_kode', 2);
        $this->db->where($table.'.tb_program_kode', $kode[0]);
        $this->db->where($table.'.tb_kegiatan_kode', $kode[1]);
        $this->db->where($table.'.tb_rekening3_kode', $kode[2]);
        $this->db->where($table.'.tb_rekening4_kode', $kode[3]);
        $data = $this->db->get($table)->row();
        return $data;
    }

    
    public function getOpdKegiatan($kode, $jenis, $all = true){

        $table = 'tb_rpjmd_kegiatan';
        $tableProgram = 'tb_rpjmd_program';
        if($jenis == 2){
            $table = 'tb_rpjmd_kegiatan_penetapan';
            $tableProgram = 'tb_rpjmd_program_penetapan';
        }else if($jenis == 3){
            $table = 'tb_rpjmd_kegiatan_perubahan';
            $tableProgram = 'tb_rpjmd_program_perubahan';
        }
        
        $this->db->join('tb_rpjmd_sasaran', 'tb_rpjmd_sasaran.id_tb_rpjmd = '.$table.'.id_tb_rpjmd
                                    AND tb_rpjmd_sasaran.tb_rpjmd_misi_kode = '.$table.'.tb_rpjmd_misi_kode
                                    AND tb_rpjmd_sasaran.tb_rpjmd_tujuan_kode = '.$table.'.tb_rpjmd_tujuan_kode
                                    AND tb_rpjmd_sasaran.tb_rpjmd_sasaran_kode = '.$table.'.tb_rpjmd_sasaran_kode', 'left');


        $this->db->join($tableProgram, $tableProgram.'.id_tb_rpjmd = '.$table.'.id_tb_rpjmd
                                    AND '.$tableProgram.'.tb_rpjmd_misi_kode = '.$table.'.tb_rpjmd_misi_kode
                                    AND '.$tableProgram.'.tb_rpjmd_tujuan_kode = '.$table.'.tb_rpjmd_tujuan_kode
                                    AND '.$tableProgram.'.tb_rpjmd_sasaran_kode = '.$table.'.tb_rpjmd_sasaran_kode
                                    AND '.$tableProgram.'.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND '.$tableProgram.'.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND '.$tableProgram.'.tb_unit_kode = '.$table.'.tb_unit_kode
                                    AND '.$tableProgram.'.tb_sub_unit_kode = '.$table.'.tb_sub_unit_kode
                                    AND '.$tableProgram.'.tb_program_kode = '.$table.'.tb_program_kode', 'left');

        $this->db->join('tb_urusan', 'tb_urusan.tb_urusan_kode = '.$table.'.tb_urusan_kode', 'left');
        $this->db->join('tb_bidang', 'tb_bidang.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_bidang.tb_bidang_kode = '.$table.'.tb_bidang_kode', 'left');
        $this->db->join('tb_program', 'tb_program.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_program.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_program.tb_program_kode = '.$table.'.tb_program_kode', 'left');
        $this->db->join('tb_kegiatan', 'tb_kegiatan.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_kegiatan.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_kegiatan.tb_program_kode = '.$table.'.tb_program_kode
                                    AND tb_kegiatan.tb_kegiatan_kode = '.$table.'.tb_kegiatan_kode', 'left');
        $this->db->join('tb_sub_unit', 'tb_sub_unit.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_sub_unit.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_sub_unit.tb_unit_kode = '.$table.'.tb_unit_kode
                                    AND tb_sub_unit.tb_sub_unit_kode = '.$table.'.tb_sub_unit_kode', 'left');

        if(!$all){

            $kode = explode("-", $kode);
            $this->db->where($table.'.tb_urusan_kode', $kode[0]);
            $this->db->where($table.'.tb_bidang_kode', $kode[1]);
            $this->db->where($table.'.tb_unit_kode', $kode[2]);
            $this->db->where($table.'.tb_sub_unit_kode', $kode[3]);
        }

        $this->db->order_by($table.'.id_tb_rpjmd', "asc");
        $this->db->order_by($table.'.tb_rpjmd_misi_kode', "asc");
        $this->db->order_by($table.'.tb_rpjmd_tujuan_kode', "asc");
        $this->db->order_by($table.'.tb_rpjmd_sasaran_kode', "asc");
        $this->db->order_by($table.'.tb_urusan_kode', "asc");
        $this->db->order_by($table.'.tb_bidang_kode', "asc");
        $this->db->order_by($table.'.tb_unit_kode', "asc");
        $this->db->order_by($table.'.tb_sub_unit_kode', "asc");
        $this->db->order_by($table.'.tb_program_kode', "asc");
        $this->db->order_by($table.'.tb_kegiatan_kode', "asc");

        $data = $this->db->get($table)->result_array();
        return $data;
    }

    // laporan LRA
    public function getOpdKegiatanLra($kode, $tahun){
        $table = 'tb_monev_lra_rek5';

        $this->db->select($table.".*, tb_urusan.tb_urusan_nama, tb_bidang.tb_bidang_nama, tb_sub_unit.tb_sub_unit_nama, tb_program.tb_program_nama, tb_kegiatan.tb_kegiatan_nama");
        $this->db->select_max('tb_monev_lra_rek5_bulan');

        $this->db->join('tb_urusan', 'tb_urusan.tb_urusan_kode = '.$table.'.tb_urusan_kode', 'left');
        $this->db->join('tb_bidang', 'tb_bidang.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_bidang.tb_bidang_kode = '.$table.'.tb_bidang_kode', 'left');
        $this->db->join('tb_program', 'tb_program.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_program.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_program.tb_program_kode = '.$table.'.tb_program_kode', 'left');
        $this->db->join('tb_kegiatan', 'tb_kegiatan.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_kegiatan.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_kegiatan.tb_program_kode = '.$table.'.tb_program_kode
                                    AND tb_kegiatan.tb_kegiatan_kode = '.$table.'.tb_kegiatan_kode', 'left');
        $this->db->join('tb_sub_unit', 'tb_sub_unit.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_sub_unit.tb_bidang_kode = '.$table.'.tb_bidang_kode
                                    AND tb_sub_unit.tb_unit_kode = '.$table.'.tb_unit_kode
                                    AND tb_sub_unit.tb_sub_unit_kode = '.$table.'.tb_sub_unit_kode', 'left');

        $kode = explode("-", $kode);
        $this->db->where($table.'.tb_urusan_kode', $kode[0]);
        $this->db->where($table.'.tb_bidang_kode', $kode[1]);
        $this->db->where($table.'.tb_unit_kode', $kode[2]);
        $this->db->where($table.'.tb_sub_unit_kode', $kode[3]);
        $this->db->where($table.'.tb_monev_lra_tahun', $tahun);

        $this->db->order_by($table.'.id_tb_rpjmd', "asc");
        $this->db->order_by($table.'.tb_urusan_kode', "asc");
        $this->db->order_by($table.'.tb_bidang_kode', "asc");
        $this->db->order_by($table.'.tb_unit_kode', "asc");
        $this->db->order_by($table.'.tb_sub_unit_kode', "asc");
        $this->db->order_by($table.'.tb_monev_lra_tahun', "asc");
        $this->db->order_by($table.'.tb_rekening1_kode', "asc");
        $this->db->order_by($table.'.tb_rekening2_kode', "asc");
        $this->db->order_by($table.'.tb_program_kode', "asc");
        $this->db->order_by($table.'.tb_kegiatan_kode', "asc");
        $this->db->order_by($table.'.tb_rekening3_kode', "asc");
        $this->db->order_by($table.'.tb_rekening4_kode', "asc");
        $this->db->order_by($table.'.tb_rekening5_kode', "asc");
        $this->db->order_by($table.'.tb_monev_lra_rek5_bulan', "desc");

        $groupBy = array(
            $table.'.id_tb_rpjmd',
            $table.'.tb_urusan_kode',
            $table.'.tb_bidang_kode',
            $table.'.tb_unit_kode',
            $table.'.tb_sub_unit_kode',
            $table.'.tb_rekening1_kode',
            $table.'.tb_rekening2_kode',
            $table.'.tb_program_kode',
            $table.'.tb_kegiatan_kode',
        );
        $this->db->group_by($groupBy);

        $data = $this->db->get($table)->result_array();
        return $data;
    }

    // . laporan LRA

    public function getCapaian($kode, $tahun = 1, $tahunan = true){
        $table = 'tb_monev_lra_rek5';
        $this->db->select($table.".*");
        $this->db->select_max('tb_monev_lra_rek5_bulan');
        $kode = explode("-", $kode);
        $this->db->where($table.'.id_tb_rpjmd', $kode[0]);
        $this->db->where($table.'.tb_urusan_kode', $kode[1]);
        $this->db->where($table.'.tb_bidang_kode', $kode[2]);
        $this->db->where($table.'.tb_unit_kode', $kode[3]);
        $this->db->where($table.'.tb_sub_unit_kode', $kode[4]);
        $this->db->where($table.'.tb_program_kode', $kode[5]);
        $this->db->where($table.'.tb_kegiatan_kode', $kode[6]);
        $this->db->where($table.'.tb_monev_lra_tahun', $tahun);

        $this->db->order_by($table.'.id_tb_rpjmd', "asc");
        $this->db->order_by($table.'.tb_urusan_kode', "asc");
        $this->db->order_by($table.'.tb_bidang_kode', "asc");
        $this->db->order_by($table.'.tb_unit_kode', "asc");
        $this->db->order_by($table.'.tb_sub_unit_kode', "asc");
        $this->db->order_by($table.'.tb_rekening1_kode', "asc");
        $this->db->order_by($table.'.tb_rekening2_kode', "asc");
        $this->db->order_by($table.'.tb_program_kode', "asc");
        $this->db->order_by($table.'.tb_kegiatan_kode', "asc");
        $this->db->order_by($table.'.tb_rekening3_kode', "asc");
        $this->db->order_by($table.'.tb_rekening4_kode', "asc");
        $this->db->order_by($table.'.tb_rekening5_kode', "asc");
        $this->db->order_by($table.'.tb_monev_lra_rek5_bulan', "desc");

        $groupBy = array(
            $table.'.id_tb_rpjmd',
            $table.'.tb_urusan_kode',
            $table.'.tb_bidang_kode',
            $table.'.tb_unit_kode',
            $table.'.tb_sub_unit_kode',
            $table.'.tb_rekening1_kode',
            $table.'.tb_rekening2_kode',
            $table.'.tb_program_kode',
            $table.'.tb_kegiatan_kode',
            $table.'.tb_rekening3_kode',
            $table.'.tb_rekening4_kode',
            $table.'.tb_rekening5_kode',
        );
        $this->db->group_by($groupBy);

        $data = $this->db->get($table)->result_array();
        return $data;
    }

    public function getRkpdAwalKegiatan($kode){
        $table = 'tb_rpjmd_kegiatan';
        
        $kode = explode("-", $kode);
        $this->db->where($table.'.id_tb_rpjmd', $kode[0]);
        $this->db->where($table.'.tb_urusan_kode', $kode[1]);
        $this->db->where($table.'.tb_bidang_kode', $kode[2]);
        $this->db->where($table.'.tb_unit_kode', $kode[3]);
        $this->db->where($table.'.tb_sub_unit_kode', $kode[4]);
        $this->db->where($table.'.tb_program_kode', $kode[5]);
        $this->db->where($table.'.tb_kegiatan_kode', $kode[6]);

        $data = $this->db->get($table)->result_array();
        return $data;
    }

    public function getRkpdAwalProgram($kode){
        $table = 'tb_rpjmd_program';
        
        $kode = explode("-", $kode);
        $this->db->where($table.'.id_tb_rpjmd', $kode[0]);
        $this->db->where($table.'.tb_urusan_kode', $kode[1]);
        $this->db->where($table.'.tb_bidang_kode', $kode[2]);
        $this->db->where($table.'.tb_unit_kode', $kode[3]);
        $this->db->where($table.'.tb_sub_unit_kode', $kode[4]);
        $this->db->where($table.'.tb_program_kode', $kode[5]);

        $data = $this->db->get($table)->result_array();
        return $data;
    }

    public function getDataMisi(){
        $table = 'tb_rpjmd_misi';
        $this->db->join('tb_rpjmd', 'tb_rpjmd.id_tb_rpjmd = '.$table.'.id_tb_rpjmd', 'left');
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $data = $this->db->get($table)->result_array();
        return $data;
    }

    public function checkProgram($kode, $jenis, $tahun = null){

        $kode = explode("-", $kode);
        $table = 'tb_rpjmd_program';
        if($jenis == 2){
            $table = 'tb_rpjmd_program_penetapan';
        }else if($jenis == 3){
            $table = 'tb_rpjmd_program_perubahan';
        }
        
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_urusan_kode', $kode[0]);
        $this->db->where($table.'.tb_bidang_kode', $kode[1]);
        $this->db->where($table.'.tb_unit_kode', $kode[2]);
        $this->db->where($table.'.tb_sub_unit_kode', $kode[3]);
        $this->db->where($table.'.tb_program_kode', $kode[4]);

        if($tahun != null){
            $this->db->where($table.'.tb_rpjmd_program_tahun', $tahun);
        }

        $data = $this->db->get($table)->num_rows();
        $hasil = 0;
        if($data > 0){
            $hasil = 1;
        }
        return $hasil;
    }

    public function checkKegiatan($kode, $jenis, $tahun = null){

        $kode = explode("-", $kode);
        $table = 'tb_rpjmd_kegiatan';
        if($jenis == 2){
            $table = 'tb_rpjmd_kegiatan_penetapan';
        }else if($jenis == 3){
            $table = 'tb_rpjmd_kegiatan_perubahan';
        }
        
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_urusan_kode', $kode[0]);
        $this->db->where($table.'.tb_bidang_kode', $kode[1]);
        $this->db->where($table.'.tb_unit_kode', $kode[2]);
        $this->db->where($table.'.tb_sub_unit_kode', $kode[3]);
        $this->db->where($table.'.tb_program_kode', $kode[4]);
        $this->db->where($table.'.tb_kegiatan_kode', $kode[5]);

        if($tahun != null){
            $this->db->where($table.'.tb_rpjmd_program_tahun', $tahun);
        }

        $data = $this->db->get($table)->num_rows();
        $hasil = 0;
        if($data > 0){
            $hasil = 1;
        }
        return $hasil;
    }

    // sotk 

    

    public function getRowUrusan($kode){
        $this->db->where('tb_urusan_kode', $kode);
        $data = $this->db->get('tb_urusan')->row();
        return $data;
    }

    public function getRowBidang($kode){

        $table = "tb_bidang";
        $this->db->join('tb_urusan', 'tb_urusan.tb_urusan_kode = '.$table.'.tb_urusan_kode', 'left');
        

        $kode = explode("-", $kode);
        $this->db->where($table.'.tb_urusan_kode', $kode[0]);
        $this->db->where($table.'.tb_bidang_kode', $kode[1]);
        $data = $this->db->get($table )->row();
        return $data;
    }

    public function getRowProgram2($kode){

        $table = "tb_program";
        $this->db->join('tb_urusan', 'tb_urusan.tb_urusan_kode = '.$table.'.tb_urusan_kode', 'left');
        $this->db->join('tb_bidang', 'tb_bidang.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                AND tb_bidang.tb_bidang_kode = '.$table.'.tb_bidang_kode', 'left');
        

        $kode = explode("-", $kode);
        $this->db->where($table.'.tb_urusan_kode', $kode[0]);
        $this->db->where($table.'.tb_bidang_kode', $kode[1]);
        $this->db->where($table.'.tb_program_kode', $kode[2]);
        $data = $this->db->get($table )->row();
        return $data;
    }

    public function getRowUnit($kode){

        $table = "tb_unit";
        $this->db->join('tb_urusan', 'tb_urusan.tb_urusan_kode = '.$table.'.tb_urusan_kode', 'left');
        $this->db->join('tb_bidang', 'tb_bidang.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                AND tb_bidang.tb_bidang_kode = '.$table.'.tb_bidang_kode', 'left');
        

        $kode = explode("-", $kode);
        $this->db->where($table.'.tb_urusan_kode', $kode[0]);
        $this->db->where($table.'.tb_bidang_kode', $kode[1]);
        $this->db->where($table.'.tb_unit_kode', $kode[2]);
        $data = $this->db->get($table )->row();
        return $data;
    }

    

    public function getDataIndikatorTujuan($kode){
        $table = "tb_rpjmd_tujuan_indikator";
        $kode = explode("-", $kode);
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_rpjmd_misi_kode', $kode[0]);
        $this->db->where($table.'.tb_rpjmd_tujuan_kode', $kode[1]);
        $data = $this->db->get($table)->result_array();
        return $data;
    }

    public function getDataIndikatorSasaran($kode){
        $table = "tb_rpjmd_sasaran_indikator";
        $kode = explode("-", $kode);
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_rpjmd_misi_kode', $kode[0]);
        $this->db->where($table.'.tb_rpjmd_tujuan_kode', $kode[1]);
        $this->db->where($table.'.tb_rpjmd_sasaran_kode', $kode[2]);
        $data = $this->db->get($table)->result_array();
        return $data;
    }

    public function getDataIndikatorProgram($kode){
        $table = "tb_rpjmd_program_indikator";
        $kode = explode("-", $kode);
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_rpjmd_misi_kode', $kode[0]);
        $this->db->where($table.'.tb_rpjmd_tujuan_kode', $kode[1]);
        $this->db->where($table.'.tb_rpjmd_sasaran_kode', $kode[2]);
        $this->db->where($table.'.tb_urusan_kode', $kode[3]);
        $this->db->where($table.'.tb_bidang_kode', $kode[4]);
        $this->db->where($table.'.tb_unit_kode', $kode[5]);
        $this->db->where($table.'.tb_sub_unit_kode', $kode[6]);
        $this->db->where($table.'.tb_program_kode', $kode[7]);
        $data = $this->db->get($table)->result_array();
        return $data;
    }

    public function getDataIndikatorKegiatan($kode){
        $table = "tb_rpjmd_kegiatan_indikator";
        $kode = explode("-", $kode);
        $this->db->where($table.'.id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where($table.'.tb_rpjmd_misi_kode', $kode[0]);
        $this->db->where($table.'.tb_rpjmd_tujuan_kode', $kode[1]);
        $this->db->where($table.'.tb_rpjmd_sasaran_kode', $kode[2]);
        $this->db->where($table.'.tb_urusan_kode', $kode[3]);
        $this->db->where($table.'.tb_bidang_kode', $kode[4]);
        $this->db->where($table.'.tb_unit_kode', $kode[5]);
        $this->db->where($table.'.tb_sub_unit_kode', $kode[6]);
        $this->db->where($table.'.tb_program_kode', $kode[7]);
        $this->db->where($table.'.tb_kegiatan_kode', $kode[8]);
        $data = $this->db->get($table)->result_array();
        return $data;
    }

    public function getAllPkOpd(){
        $table = 'tb_rpjmd_opd';

        $this->db->join('tb_rpjmd_sasaran', 'tb_rpjmd_sasaran.id_tb_rpjmd = '.$table.'.id_tb_rpjmd
                    AND tb_rpjmd_sasaran.tb_rpjmd_misi_kode = '.$table.'.tb_rpjmd_misi_kode
                    AND tb_rpjmd_sasaran.tb_rpjmd_tujuan_kode = '.$table.'.tb_rpjmd_tujuan_kode
                    AND tb_rpjmd_sasaran.tb_rpjmd_sasaran_kode = '.$table.'.tb_rpjmd_sasaran_kode');

        $kodeOpd = explode("-", $this->session->kodeOpd);
        $this->db->where($table.'.tb_urusan_kode', $kodeOpd[0]);
        $this->db->where($table.'.tb_bidang_kode', $kodeOpd[1]);
        $this->db->where($table.'.tb_unit_kode', $kodeOpd[2]);
        $this->db->where($table.'.tb_sub_unit_kode', $kodeOpd[3]);

        $groupBy = array(
            $table.'.id_tb_rpjmd',
            $table.'.tb_rpjmd_misi_kode',
            $table.'.tb_rpjmd_tujuan_kode',
            $table.'.tb_rpjmd_sasaran_kode',
        );
        $this->db->group_by($groupBy);

        $data = $this->db->get($table)->result_array();
        return $data;

    }
    // . sotk

    // hak
    public function getHak($id){
        
        $table = 'tb_user';
        $this->db->where($table.'.id_tb_user', $id);
        $data = $this->db->get($table)->result_array();
        return json_decode(@$data[0]['tb_user_hak'], true);
    }

    public function getDataUser(){
        $table = 'tb_user';
        $this->db->where($table.'.tb_user_akun', 7);
        $data = $this->db->get($table)->result_array();
        return $data;

    }

    //
    public function getOneOpd($kode){
        $table = 'tb_sub_unit';
        $kode = explode("-", $kode);

        $this->db->join('tb_urusan', 'tb_urusan.tb_urusan_kode = '.$table.'.tb_urusan_kode', 'left');
        $this->db->join('tb_bidang', 'tb_bidang.tb_urusan_kode = '.$table.'.tb_urusan_kode
                                    AND tb_bidang.tb_bidang_kode = '.$table.'.tb_bidang_kode', 'left');
        

        $this->db->where($table.'.tb_urusan_kode', $kode[0]);
        $this->db->where($table.'.tb_bidang_kode', $kode[1]);
        $this->db->where($table.'.tb_unit_kode', $kode[2]);
        $this->db->where($table.'.tb_sub_unit_kode', $kode[3]);
        $data = $this->db->get($table)->row();
        return $data;

    }

}