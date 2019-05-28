<?php

class Manajemen extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['judul'] = 'Riwayat Barang';
        $data['manajemen'] = $this->Manajemen_model->getAllManajemen();
        $this->load->view('templates/header', $data);
        $this->load->view('manajemen/index');
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Form Tambah Data Barang';
       
        $this->form_validation->set_rules('kode_barang', 'Kode Barang','required');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang','required');
        $this->form_validation->set_rules('size', 'Size','required');
        $this->form_validation->set_rules('harga', 'Harga','required');

        if( $this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('manajemen/tambah');
            $this->load->view('templates/footer');    
        }else {
            $this->Manajemen_model->tambahDataBarang();
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('manajemen');
        }
        
    }

    public function hapus($kode_barang)
    {
        $this->Manajemen_model->hapusDataBarang($kode_barang);
        $this->session->set_flashdata('flash','Dihapus');
        redirect('manajemen');
    }

    public function detail($kode_barang)
    {
        $data['judul']='Detail Data Barang';
        $data['riwayat_barang'] = $this->Manajemen_model->getRiwayatBarangByKode($kode_barang);
        $this->load->view('templates/header', $data);
        $this->load->view('manajemen/detail', $data);
        $this->load->view('templates/footer');
    }


    public function ubah($kode_barang)
    {
        $data['judul'] = 'Form Ubah Data Barang';
        $data['riwayat_barang'] = $this->Manajemen_model->getRiwayatBarangByKode($kode_barang);
        $data['size'] = ['S','M','L','XL','XXL'];

        $this->form_validation->set_rules('kode_barang', 'Kode Barang','required');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang','required');
        $this->form_validation->set_rules('size', 'Size','required');
        $this->form_validation->set_rules('harga', 'Harga','required');

        if( $this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('manajemen/ubah', $data);
            $this->load->view('templates/footer');    
        }else {
            $this->Manajemen_model->ubahDataBarang();
            $this->session->set_flashdata('flash','Diubah');
            redirect('manajemen');
        }
        
    }
} 