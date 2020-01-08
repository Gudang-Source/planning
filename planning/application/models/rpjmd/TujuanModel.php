<?php

class TujuanModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 2000;
        $this->table = 'tb_rpjmd_tujuan';
    }

    public function setQuery($post){
        
        $kode = explode("-", $post['kode']);
        $this->db->where('id_tb_rpjmd', $this->session->rpjmd);
        $this->db->where('tb_rpjmd_misi_kode', $kode[0]);
        
    }

    public function getCount($post = array()){

        $this->setQuery($post);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($post){
        
        $jumlah = $this->jumlah;
        $awal = (@$post['page'] - 1)*$jumlah;

        $this->setQuery($post);
        $this->db->limit($jumlah,$awal); 
        $query = $this->db->get($this->table)->result_array();
        return $query;
    }

    public function create($post){
        
        $post = $this->security->xss_clean($post);
        $pesan = "Gagal Menambah Data";
        $status = False;
        if($this->cekInput($post)){
            $kode = explode("-", $post['kode']);
            $data = array(
                'id_tb_rpjmd' => $this->session->rpjmd,
                'tb_rpjmd_misi_kode' => $kode[0],
                'tb_rpjmd_tujuan_kode' => $post['tb_rpjmd_tujuan_kode'],
                'tb_rpjmd_tujuan_nama' => $post['tb_rpjmd_tujuan_nama'],
            );
            $status = $this->db->insert($this->table, $data);

            if($status)
                $pesan = "Berhasil Menambah Data";
        }

        $kirim = array(
            'pesan' => $pesan,
            'status' => $status,
        );
        return $kirim;
    }

    public function update($post){
        
        $post = $this->security->xss_clean($post);
        $pesan = "Gagal Mengubah Data";
        $status = False;
        
        if($this->cekInput($post)){

            $data = array(
                'tb_rpjmd_tujuan_kode' => $post['tb_rpjmd_tujuan_kode'],
                'tb_rpjmd_tujuan_nama' => $post['tb_rpjmd_tujuan_nama'],
            );

            $kode = explode("-", $post['kode']);
            $this->db->where('id_tb_rpjmd', $this->session->rpjmd);
            $this->db->where('tb_rpjmd_misi_kode', $kode[0]);
            $this->db->where('tb_rpjmd_tujuan_kode', $kode[1]);
            $status = $this->db->update($this->table, $data);
            if($status)
                $pesan = "Berhasil Mengubah Data";
        }

        $kirim = array(
            'pesan' => $pesan,
            'status' => $status,
        );
        return $kirim;
    }

    public function delete($post){
        $post = $this->security->xss_clean($post);
        $pesan = "Gagal Menghapus Data";
        $status = False;
        
        if($this->cekInput($post)){
            $kode = explode("-", $post['kode']);
            $this->db->where('id_tb_rpjmd', $this->session->rpjmd);
            $this->db->where('tb_rpjmd_misi_kode', $kode[0]);
            $this->db->where('tb_rpjmd_tujuan_kode', $kode[1]);
            $status = $this->db->delete($this->table);
            if($status)
                $pesan = "Berhasil Menghapus Data";
        }

        $kirim = array(
            'pesan' => $pesan,
            'status' => $status,
        );
        return $kirim;
    }
    
    public function cekInput($post){
        
        return true;
    }


}