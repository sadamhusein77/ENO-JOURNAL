<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_user extends CI_Model {
  // Fungsi untuk menampilkan semua data siswa
  public function view(){
    return $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role order by id_user desc")->result();
  }

  // Fungsi untuk menampilkan data siswa berdasarkan NIS nya
  public function view_by($id_user){
    $this->db->where('id_user', $id_user);
    return $this->db->get('user')->row();
  }

  // Fungsi untuk validasi form tambah dan ubah
  public function validation($mode){
    $this->load->library('form_validation'); // Load library form_validation untuk proses validasinya

    // Tambahkan if apakah $mode save atau update
    // Karena ketika update, NIS tidak harus divalidasi
    // Jadi NIS di validasi hanya ketika menambah data siswa saja
    if($mode == "save")
    $this->form_validation->set_rules('id_role', 'ID Role', 'required|numeric|max_length[3]|trim');
    $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required|max_length[50]');
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
      'matches' => 'Password dont match!',
      'min_length' => 'Password too short!'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
    $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',[
      'is_unique' => 'This email has already registered!'
    ]);
    $this->form_validation->set_rules('foto', 'foto', 'required');
    if($this->form_validation->run()) // Jika validasi benar
      return TRUE; // Maka kembalikan hasilnya dengan TRUE
    else // Jika ada data yang tidak sesuai validasi
      return FALSE; // Maka kembalikan hasilnya dengan FALSE
  }

  // Fungsi untuk melakukan simpan data ke tabel siswa
  public function save(){
    $data = array(
      "id_role" =>  htmlspecialchars($this->input->post('id_role', true)),
      "fullname" => htmlspecialchars($this->input->post('fullname', true)),
      "password" => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
      "jenis_kelamin" => htmlspecialchars($this->input->post('jenis_kelamin', true)),
      "alamat" => htmlspecialchars($this->input->post('alamat', true)),
      "email" => htmlspecialchars($this->input->post('email', true)),
      "foto" => 'default.jpg',
      "is_active" => '1',
      "date_created" => time()
    );

    $this->db->insert('user', $data); // Untuk mengeksekusi perintah insert data
    $this->session->set_flashdata('msg', ' Disimpan');
  }

  // Fungsi untuk melakukan ubah data siswa berdasarkan NIS siswa
  public function edit($id_user){
    $data = array(
      "id_role" => $this->input->post('id_role'),
      "fullname" => htmlspecialchars($this->input->post('fullname', true)),
      "password" => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
      "jenis_kelamin" => htmlspecialchars($this->input->post('jenis_kelamin', true)),
      "alamat" => htmlspecialchars($this->input->post('alamat', true)),
      "email" => htmlspecialchars($this->input->post('email', true)),
      "foto" => $this->input->post('foto'),
    );

    $this->db->where('id_user', $id_user);
    $this->db->update('user', $data); // Untuk mengeksekusi perintah update data
    $this->session->set_flashdata('msg', ' Diubah');
  }

  // Fungsi untuk melakukan menghapus data siswa berdasarkan NIS siswa
  public function delete($id_user){
    $this->db->where('id_user', $id_user);
    $this->db->delete('user'); // Untuk mengeksekusi perintah delete data
    $this->session->set_flashdata('msg', ' Dihapus');
  }
}
