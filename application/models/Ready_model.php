<?php

class Ready_model extends CI_model
{
    public function getAllReady()
    {
        return $this->db->get('ready_barang')->result_array();
    }

    public function getReadyBarangByKode($kd_barang)
    {
        return $this->db->get_where('ready_barang', ['kd_barang' => $kd_barang])->row_array();
    }
    public function cariDataBarang()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama_barang', $keyword);
        $this->db->or_like('size', $keyword);
        $this->db->or_like('harga', $keyword);
        return $this->db->get('ready_barang')->result_array();
    }
}
