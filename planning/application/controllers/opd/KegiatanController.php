<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KegiatanController extends CI_Controller {
    
    private $levelArr;

	public function __construct()
    {
		parent::__construct();
        $this->load->model('opd/KegiatanModel');
        $this->load->library('Filter');
        $this->load->library('Fungsi');
        $this->levelArr = array(1,3);
    }

    public function view($kode){
        $this->filter->cekLoginOut($this->levelArr);
        
        $data = array();
        $data['judul'] = "Data Kegiatan";
        $data['kode'] = $kode;
        $this->load->model('rpjmd/DataModel');
        $data['dataRpjmd'] = $this->DataModel->getRowProgram($kode);
        
        $setKode = explode("-", $kode);
        $setKode = $setKode[3].'-'.$setKode[4].'-'.$setKode[7];
        $data['dataKegiatan'] = $this->DataModel->getKegiatan($setKode);
        $data['dataSatuan'] = $this->DataModel->getAllSatuan();

        $file['content'] = $this->load->view('components-opd/kegiatan/content', $data, true);
        $file['script'] = $this->load->view('components-opd/kegiatan/script', $data, true);
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
            $data = $this->KegiatanModel->getAll($post);
            $jumDataAll = $this->KegiatanModel->getCount($post);
            $jumlahDatainPage = $this->KegiatanModel->getJumlahInPage();
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
            $result = $this->KegiatanModel->$action($post);
        }
        $kirim = $result;
		echo json_encode($kirim);

    }

}