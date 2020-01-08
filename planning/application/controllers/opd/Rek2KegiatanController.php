<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rek2KegiatanController extends CI_Controller {
    
    private $levelArr;

	public function __construct()
    {
		parent::__construct();
        $this->load->model('opd/Rek2KegiatanModel');
        $this->load->library('Filter');
        $this->load->library('Fungsi');
        $this->levelArr = array(1,3);
    }

    public function view($kode){
        $this->filter->cekLoginOut($this->levelArr);
        
        $data = array();
        $data['judul'] = "Data Rek 2 Kegiatan";
        $data['kode'] = $kode;
        $this->load->model('rpjmd/DataModel');
        $data['dataLra'] = $this->DataModel->getLraRek2Program($kode);

        $setKode = explode("-", $this->session->kodeOpd);
        $kode = explode("-", $kode);
        $setKode = $setKode[0]."-".$setKode[1]."-".$kode[3];
        $data['dataKegiatan'] = $this->DataModel->getKegiatan($setKode);
        
        $file['content'] = $this->load->view('components-opd/lra-rek2-kegiatan/content', $data, true);
        $file['script'] = $this->load->view('components-opd/lra-rek2-kegiatan/script', $data, true);
        $this->load->view('includes/layout', $file);
	}

    public function getData($page = 1){
        $post = $this->input->post();
        $post['page'] = $page;
        $jumDataAll = 0;
        $jumlahDatainPage = 0;
        $data = array();
        $jumlahPage = 1;
        $status = $this->filter->cekLogin($this->levelArr);
        
		if($status){
            $data = $this->Rek2KegiatanModel->getAll($post);
            $jumDataAll = $this->Rek2KegiatanModel->getCount($post);
            $jumlahDatainPage = $this->Rek2KegiatanModel->getJumlahInPage();
            $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
		}

        $kirim = array(
            'jumlahAll' => $jumDataAll,
            'jumlahPage' => $jumlahPage,
			'data' => $data,
			'status' => $status
        );

        echo json_encode($kirim);
    }
    
	public function action($action = ''){
        $post = $this->input->post();
        $status = $this->filter->cekLogin($this->levelArr);
		$result = array(
			'pesan' => 'gagal terhubung server',
			'status' => false,
        );
        if($status){
            $result = $this->Rek2KegiatanModel->$action($post);
        }
        $kirim = $result;
		echo json_encode($kirim);

    }

}