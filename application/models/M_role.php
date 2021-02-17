<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_role extends CI_Model {
  // Fungsi untuk menampilkan semua data siswa
  public function view(){
    return $this->db->get('role')->result();
  }

  // Fungsi untuk menampilkan data siswa berdasarkan NIS nya
  public function view_by($id_role){
    $this->db->where('id_role', $id_role);
    return $this->db->get('role')->row();
  }

  // Fungsi untuk validasi form tambah dan ubah
  public function validation($mode){
    $this->load->library('form_validation'); // Load library form_validation untuk proses validasinya

    // Tambahkan if apakah $mode save atau update
    // Karena ketika update, NIS tidak harus divalidasi
    // Jadi NIS di validasi hanya ketika menambah data siswa saja
    if($mode == "save")
    $this->form_validation->set_rules('kode_role', 'Kode Role', 'required|max_length[6]');
    $this->form_validation->set_rules('nama_role', 'Nama Role', 'required|max_length[15]');
    if($this->form_validation->run()) // Jika validasi benar
      return TRUE; // Maka kembalikan hasilnya dengan TRUE
    else // Jika ada data yang tidak sesuai validasi
      return FALSE; // Maka kembalikan hasilnya dengan FALSE
  }

  // Fungsi untuk melakukan simpan data ke tabel siswa
  public function save(){
    $data = array(
      "kode_role" => $this->input->post('kode_role'),
      "nama_role" => $this->input->post('nama_role')
    );

    $this->db->insert('role', $data); // Untuk mengeksekusi perintah insert data
    $this->session->set_flashdata('msg', ' Disimpan');
  }

  // Fungsi untuk melakukan ubah data siswa berdasarkan NIS siswa
  public function edit($id_role){
    $data = array(
      "kode_role" => $this->input->post('kode_role'),
      "nama_role" => $this->input->post('nama_role')
    );

    $this->db->where('id_role', $id_role);
    $this->db->update('role', $data); // Untuk mengeksekusi perintah update data
    $this->session->set_flashdata('msg', ' Diubah');
  }

  // Fungsi untuk melakukan menghapus data siswa berdasarkan NIS siswa
  public function delete($id_role){
    $this->db->where('id_role', $id_role);
    $this->db->delete('role'); // Untuk mengeksekusi perintah delete data
    $this->session->set_flashdata('msg', ' Dihapus');
  }
}
