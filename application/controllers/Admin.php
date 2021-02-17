<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('m_data'); // load model general
    // cek session yang login,
    // jika session status tidak sama dengan session telah_login, berarti pengguna belum login
    // maka halaman akan di alihkan kembali ke halaman login.
    if($this->session->userdata('status')!="telah_login"){
      redirect(base_url().'auth?alert=belum_login');
    }
    if($this->session->userdata('id_role')!="1"){
      redirect(base_url().'welcome/notfound');
    }
  }

  public function index()
  {
    // hitung jumlah role
    $data['total_role'] = $this->m_data->get_data('role')->num_rows();
    // hitung jumlah user
    $data['total_user'] = $this->m_data->get_data('user')->num_rows();
    // hitung jumlah customer
    $data['total_customer'] = $this->m_data->get_data('customer')->num_rows();
    // hitung jumlah vendor
    $data['total_vendor'] = $this->m_data->get_data('vendor')->num_rows();
    // hitung jumlah account
    $data['total_account'] = $this->m_data->get_data('account')->num_rows();
    // hitung jumlah services
    $data['total_services'] = $this->m_data->get_data('service')->num_rows();
    // load data user
    $data['title'] = 'Eno Journal - Dashboard';
    $data['card'] = 'Menu Admin';
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $this->load->view('admin/v_header',$data);
    $this->load->view('admin/v_index', $data);
    $this->load->view('admin/v_footer');
  }

  ////////////////////////////  fungsi role ///////////////////////////////////////////
  public function role()
  {
    $data['title'] = 'Eno Journal - Role';
    $data['card'] = 'Data Role User';
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['role'] = $this->m_data->get_data('role')->result();
    $data['msg'] = $this->session->flashdata('msg');
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_role',$data);
    $this->load->view('admin/v_footer');
  }

  public function tambah_role()
  {
    $data['title'] = 'Eno Journal - Tambah Data';
    $data['url'] = 'Tambah Role';
    $data['judul'] = 'Form Tambah Data Role' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_role_tambah', $data);
    $this->load->view('admin/v_footer');
  }

  public function role_aksi()
  {
    // Validasi Wajib isi form role
    $this->form_validation->set_rules('role_code', 'Kode Role', 'required|max_length[6]');
    $this->form_validation->set_rules('role_name', 'Nama Role', 'required|max_length[15]');

    if($this->form_validation->run() != false){
      $role_code = $this->input->post('role_code');
      $role_name = $this->input->post('role_name');
      $data = array(
        'role_code' => $role_code,
        'role_name' => $role_name
      );
      $this->m_data->insert_data($data,'role');
      $this->session->set_flashdata('msg', ' Disimpan');
      redirect(base_url().'admin/tambah_role');
    }else{
      $data['title'] = 'Eno Journal - Tambah Data';
      $data['url'] = 'Tambah Role';
      $data['judul'] = 'Form Tambah Data Role' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_role_tambah', $data);
      $this->load->view('admin/v_footer');
    }
  }
  public function ubah_role($id_role){
    $where = array(
      'id_role' => $id_role
    );
    $data['title'] = 'Eno Journal - Edit Role';
    $data['url'] = 'Edit Role';
    $data['judul'] = 'Form Edit Data Role' ;
    $data['role'] = $this->m_data->edit_data($where,'role')->result();
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_role_ubah', $data);
    $this->load->view('admin/v_footer');
  }

  // Fungsi update halaman
  public function role_update()
  {
    // Wajib isi judul,konten
    $this->form_validation->set_rules('role_code', 'Kode Role', 'required|max_length[6]');
    $this->form_validation->set_rules('role_name', 'Nama Role', 'required|max_length[15]');
    if($this->form_validation->run() != false){
      $id_role = $this->input->post('id_role');
      $kode_role = $this->input->post('role_code');
      $nama_role = $this->input->post('role_name');
      $where = array(
        'id_role' => $id_role
      );
      $data = array(
        'role_code' => $role_code,
        'role_name' => $role_name
      );
      $this->m_data->update_data($where,$data,'role');
      $this->session->set_flashdata('msg', ' Diubah');
      redirect(base_url().'admin/role');
    }else{
      $id_role = $this->input->post('id_role');
      $where = array(
        'id_role' => $id_role
      );
      $data['title'] = 'Eno Journal - Edit Role';
      $data['url'] = 'Edit Role';
      $data['judul'] = 'Form Edit Data Role' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['role'] = $this->m_data->edit_data($where,'role')->result();
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_role_ubah', $data);
      $this->load->view('admin/v_footer');
    }
  }

  // Fungsi hapus
  public function hapus_role($id_role)
  {
    $where = array(
      'id_role' => $id_role
    );
    $this->m_data->delete_data($where,'role');
    $this->session->set_flashdata('msg', ' Dihapus');
    redirect(base_url().'admin/role');
  }

  ////////////////////////////  fungsi user ///////////////////////////////////////////
  public function user()
  {
    $data['title'] = 'Eno Journal - User';
    $data['card'] = 'Data User';
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['user'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role")->result();
    $data['msg'] = $this->session->flashdata('msg');
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_user',$data);
    $this->load->view('admin/v_footer');
  }

  public function tambah_user()
  {
    $data['title'] = 'Eno Journal - Tambah User';
    $data['url'] = 'Tambah user';
    $data['judul'] = 'Form Tambah Data user' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['role'] = $this->m_data->get_data('role')->result();
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_user_tambah', $data);
    $this->load->view('admin/v_footer');
  }

  public function user_aksi()
  {
    // Validasi Wajib isi form role
    $this->form_validation->set_rules('fullname', 'Fullname', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',[
      'is_unique' => 'This email has already registered!'
    ]);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
      'matches' => 'Password dont match!',
      'min_length' => 'Password too short!'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
    $this->form_validation->set_rules('id_role', 'Role', 'required|max_length[3]');
    $this->form_validation->set_rules('gender', 'Gender', 'required|max_length[1]');
    $this->form_validation->set_rules('is_active', 'Status', 'required|max_length[1]');

    if($this->form_validation->run() != false){
      $email = $this->input->post('email');
      $id_role = $this->input->post('id_role');
      $gender = $this->input->post('gender');
      $is_active = $this->input->post('is_active');
      $data = array(
        'fullname' => htmlspecialchars($this->input->post('fullname', true)),
        'email' => htmlspecialchars($email),
        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'foto' => 'default.jpg',
        'id_role' => $id_role,
        'gender' => $gender,
        'is_active' => $is_active,
        'date_created' => time()
      );
      $this->m_data->insert_data($data,'user');
      $this->session->set_flashdata('msg', ' Disimpan');
      redirect(base_url().'admin/tambah_user');
    }else{
      $data['title'] = 'Eno Journal - Tambah User';
      $data['url'] = 'Tambah user';
      $data['judul'] = 'Form Tambah Data user' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['role'] = $this->m_data->get_data('role')->result();
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_user_tambah', $data);
      $this->load->view('admin/v_footer');
    }
  }
  public function ubah_user($id_user){
    $where = array(
      'id_user' => $id_user
    );
    $data['title'] = 'Eno Journal - Edit User';
    $data['url'] = 'Edit User';
    $data['judul'] = 'Form Edit Data User' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['user'] = $this->m_data->edit_data($where,'user')->result();
    $data['role'] = $this->m_data->get_data('role')->result();
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_user_ubah', $data);
    $this->load->view('admin/v_footer');
  }

  // Fungsi update halaman
  public function user_update()
  {
    // Wajib isi judul,konten
    $this->form_validation->set_rules('fullname', 'Fullname', 'required|trim');
    $this->form_validation->set_rules('gender', 'Gender', 'required|max_length[1]');
    $this->form_validation->set_rules('is_active', 'Status', 'required|max_length[1]');
    $this->form_validation->set_rules('id_role', 'Role', 'required|max_length[3]');

    if($this->form_validation->run() != false){
      $id_user = $this->input->post('id_user');
      $id_role = $this->input->post('id_role');
      $fullname = $this->input->post('fullname');
      $gender = $this->input->post('gender');
      $is_active = $this->input->post('is_active');
      $where = array(
        'id_user' => $id_user
      );
      $data = array(
        'fullname' => $fullname,
        'gender' => $gender,
        'is_active' => $is_active,
        'id_role' => $id_role
      );
      $this->m_data->update_data($where,$data,'user');
      $this->session->set_flashdata('msg', ' Diubah');
      redirect(base_url().'admin/user');
    }else{
      $id_user = $this->input->post('id_user');
      $where = array(
        'id_user' => $id_user
      );
      $data['title'] = 'Eno Journal - Edit User';
      $data['url'] = 'Edit User';
      $data['judul'] = 'Form Edit Data User' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['user'] = $this->m_data->edit_data($where,'user')->result();
      $data['role'] = $this->m_data->get_data('role')->result();
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_user_ubah', $data);
      $this->load->view('admin/v_footer');
    }
  }

  // Fungsi hapus
  public function hapus_user($id_user)
  {
    $where = array(
      'id_user' => $id_user
    );
    $this->m_data->delete_data($where,'user');
    $this->session->set_flashdata('msg', ' Dihapus');
    redirect(base_url().'admin/user');
  }

  ////////////////////////// fungsi customer //////////////////////////////////////////

  public function customer()
  {
    $data['title'] = 'Eno Journal - Customer';
    $data['card'] = 'Data Customer';
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['customer'] = $this->m_data->get_data('customer')->result();
    $data['msg'] = $this->session->flashdata('msg');
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_customer',$data);
    $this->load->view('admin/v_footer');
  }

  public function tambah_customer()
  {
    $data['title'] = 'Eno Journal - Tambah Customer';
    $data['url'] = 'Tambah Customer';
    $data['judul'] = 'Form Tambah Data Customer' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_customer_tambah', $data);
    $this->load->view('admin/v_footer');
  }

  public function customer_aksi()
  {
    // Validasi Wajib isi form customer
    $this->form_validation->set_rules('customer_name', 'Customer Name', 'max_length[50]|required|trim');
    $this->form_validation->set_rules('customer_address', 'Customer Address', 'max_length[150]|required|trim');
    $this->form_validation->set_rules('customer_telp', 'Customer Telp/HP', 'numeric|max_length[13]|required|trim');
    $this->form_validation->set_rules('hobby', 'hobby', 'max_length[30]|required|trim');
    $this->form_validation->set_rules('customer_email', 'Customer Email', 'required|trim|valid_email|is_unique[customer.customer_email]',[
      'is_unique' => 'This email has already registered!'
    ]);
    $this->form_validation->set_rules('customer_npwp', 'Customer NPWP', 'numeric|max_length[15]|required|trim|is_unique[customer.customer_npwp]',[
      'is_unique' => 'This NPWP has already registered!'
    ]);
    if($this->form_validation->run() != false){
      $data = array(
        'customer_name' => htmlspecialchars($this->input->post('customer_name', true)),
        'customer_address' => htmlspecialchars($this->input->post('customer_address', true)),
        'customer_telp' => htmlspecialchars($this->input->post('customer_telp', true)),
        'customer_email' => htmlspecialchars($this->input->post('customer_email', true)),
        'post_date' => time(),
        'customer_npwp' => htmlspecialchars($this->input->post('customer_npwp', true)),
        'hobby' => htmlspecialchars($this->input->post('hobby', true)),
      );
      $this->m_data->insert_data($data,'customer');
      $this->session->set_flashdata('msg', ' Disimpan');
      redirect(base_url().'admin/tambah_customer');
    }else{
      $data['title'] = 'Eno Journal - Tambah Customer';
      $data['url'] = 'Tambah Customer';
      $data['judul'] = 'Form Tambah Data Customer' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_customer_tambah', $data);
      $this->load->view('admin/v_footer');
    }
  }
  public function ubah_customer($id_customer){
    $where = array(
      'id_customer' => $id_customer
    );
    $data['title'] = 'Eno Journal - Edit Customer';
    $data['url'] = 'Edit Customer';
    $data['judul'] = 'Form Edit Data Customer' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['customer'] = $this->m_data->edit_data($where,'customer')->result();
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_customer_ubah', $data);
    $this->load->view('admin/v_footer');
  }

  // Fungsi update halaman
  public function customer_update()
  {
    // Wajib isi judul,konten
    // Validasi Wajib isi form role
    $this->form_validation->set_rules('customer_name', 'Customer Name', 'max_length[50]|required|trim');
    $this->form_validation->set_rules('customer_address', 'Customer Address', 'max_length[150]|required|trim');
    $this->form_validation->set_rules('customer_telp', 'Customer Telp/HP', 'numeric|max_length[13]|required|trim');
    $id_customer = $this->input->post('id_customer');
    $email = $this->db->get_where('customer', array('id_customer' => $id_customer))->row();
    $customer_email = $email->customer_email;
    if($this->input->post('customer_email') != $customer_email) {
      $is_unique =  '|is_unique[customer.customer_email]';
    } else {
      $is_unique =  '';
    }
    $this->form_validation->set_rules('customer_email', 'Customer Email', 'required|trim|valid_email'.$is_unique,[
      'is_unique' => 'This Email has already registered!'
    ]);

    $npwp = $this->db->get_where('customer', array('id_customer' => $id_customer))->row();
    $customer_npwp = $email->customer_npwp;
    if($this->input->post('customer_npwp') != $customer_npwp) {
      $npwp_unique =  '|is_unique[customer.customer_npwp]';
    } else {
      $npwp_unique =  '';
    }
    $this->form_validation->set_rules('customer_npwp', 'Customer NPWP', 'numeric|max_length[15]|required|trim'.$npwp_unique,[
      'is_unique' => 'This NPWP has already registered!'
    ]);

    if($this->form_validation->run() != false){
      $id_customer = $this->input->post('id_customer');
      $where = array(
        'id_customer' => $id_customer
      );
      $data = array(
        'customer_name' => htmlspecialchars($this->input->post('customer_name', true)),
        'customer_address' => htmlspecialchars($this->input->post('customer_address', true)),
        'customer_telp' => htmlspecialchars($this->input->post('customer_telp', true)),
        'customer_email' => htmlspecialchars($this->input->post('customer_email', true)),
        'customer_npwp' => htmlspecialchars($this->input->post('customer_npwp', true))
      );
      $this->m_data->update_data($where,$data,'customer');
      $this->session->set_flashdata('msg', ' Diubah');
      redirect(base_url().'admin/customer');
    }else{
      $id_customer = $this->input->post('id_customer');
      $where = array(
        'id_customer' => $id_customer
      );
      $data['title'] = 'Eno Journal - Edit Customer';
      $data['url'] = 'Edit Customer';
      $data['judul'] = 'Form Edit Data Customer' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['customer'] = $this->m_data->edit_data($where,'customer')->result();
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_customer_ubah', $data);
      $this->load->view('admin/v_footer');
    }
  }

  // Fungsi hapus
  public function hapus_customer($id_customer)
  {
    $where = array(
      'id_customer' => $id_customer
    );
    $this->m_data->delete_data($where,'customer');
    $this->session->set_flashdata('msg', ' Dihapus');
    redirect(base_url().'admin/customer');
  }


  //////////////////////////// Fungsi vendor ///////////////////////////////////////////////
  public function vendor()
  {
    $data['title'] = 'Eno Journal - Vendor';
    $data['card'] = 'Data Vendor';
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['vendor'] = $this->m_data->get_data('vendor')->result();
    $data['msg'] = $this->session->flashdata('msg');
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_vendor',$data);
    $this->load->view('admin/v_footer');
  }

  public function tambah_vendor()
  {
    $data['title'] = 'Eno Journal - Tambah Vendor';
    $data['url'] = 'Tambah Vendor';
    $data['judul'] = 'Form Tambah Data Vendor' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_vendor_tambah', $data);
    $this->load->view('admin/v_footer');
  }

  public function vendor_aksi()
  {
    // Validasi Wajib isi form customer
    $this->form_validation->set_rules('vendor_name', 'Vendor Name', 'max_length[50]|required|trim');
    $this->form_validation->set_rules('vendor_address', 'Vendor Address', 'max_length[150]|required|trim');
    $this->form_validation->set_rules('vendor_telp', 'Vendor Telp/HP', 'numeric|max_length[13]|required|trim');
    $this->form_validation->set_rules('vendor_email', 'Vendor Email', 'required|trim|valid_email|is_unique[vendor.vendor_email]',[
      'is_unique' => 'This email has already registered!'
    ]);
    $this->form_validation->set_rules('vendor_npwp', 'Vendor NPWP', 'numeric|max_length[15]|required|trim|is_unique[vendor.vendor_npwp]',[
      'is_unique' => 'This NPWP has already registered!'
    ]);
    if($this->form_validation->run() != false){
      $data = array(
        'vendor_name' => htmlspecialchars($this->input->post('vendor_name', true)),
        'vendor_address' => htmlspecialchars($this->input->post('vendor_address', true)),
        'vendor_telp' => htmlspecialchars($this->input->post('vendor_telp', true)),
        'vendor_email' => htmlspecialchars($this->input->post('vendor_email', true)),
        'post_date' => time(),
        'vendor_npwp' => htmlspecialchars($this->input->post('vendor_npwp', true))
      );
      $this->m_data->insert_data($data,'vendor');
      $this->session->set_flashdata('msg', ' Disimpan');
      redirect(base_url().'admin/tambah_vendor');
    }else{
      $data['title'] = 'Eno Journal - Tambah Vendor';
      $data['url'] = 'Tambah Vendor';
      $data['judul'] = 'Form Tambah Data Vendor' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_vendor_tambah', $data);
      $this->load->view('admin/v_footer');
    }
  }
  public function ubah_vendor($id_vendor){
    $where = array(
      'id_vendor' => $id_vendor
    );
    $data['title'] = 'Eno Journal - Edit Vendor';
    $data['url'] = 'Edit Vendor';
    $data['judul'] = 'Form Edit Data Vendor' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['vendor'] = $this->m_data->edit_data($where,'vendor')->result();
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_vendor_ubah', $data);
    $this->load->view('admin/v_footer');
  }

  // Fungsi update halaman
  public function vendor_update()
  {
    // Wajib isi judul,konten
    // Validasi Wajib isi form role
    $this->form_validation->set_rules('vendor_name', 'Vendor Name', 'max_length[50]|required|trim');
    $this->form_validation->set_rules('vendor_address', 'Vendor Address', 'max_length[150]|required|trim');
    $this->form_validation->set_rules('vendor_telp', 'Vendor Telp/HP', 'numeric|max_length[13]|required|trim');
    $id_vendor = $this->input->post('id_vendor');
    $email = $this->db->get_where('vendor', array('id_vendor' => $id_vendor))->row();
    $vendor_email = $email->vendor_email;
    if($this->input->post('vendor_email') != $vendor_email) {
      $is_unique =  '|is_unique[vendor.vendor_email]';
    } else {
      $is_unique =  '';
    }
    $this->form_validation->set_rules('vendor_email', 'vendor Email', 'required|trim|valid_email'.$is_unique,[
      'is_unique' => 'This Email has already registered!'
    ]);

    $npwp = $this->db->get_where('vendor', array('id_vendor' => $id_vendor))->row();
    $vendor_npwp = $email->vendor_npwp;
    if($this->input->post('vendor_npwp') != $vendor_npwp) {
      $npwp_unique =  '|is_unique[vendor.vendor_npwp]';
    } else {
      $npwp_unique =  '';
    }
    $this->form_validation->set_rules('vendor_npwp', 'vendor NPWP', 'numeric|max_length[15]|required|trim'.$npwp_unique,[
      'is_unique' => 'This NPWP has already registered!'
    ]);

    if($this->form_validation->run() != false){
      $id_vendor = $this->input->post('id_vendor');
      $where = array(
        'id_vendor' => $id_vendor
      );
      $data = array(
        'vendor_name' => htmlspecialchars($this->input->post('vendor_name', true)),
        'vendor_address' => htmlspecialchars($this->input->post('vendor_address', true)),
        'vendor_telp' => htmlspecialchars($this->input->post('vendor_telp', true)),
        'vendor_email' => htmlspecialchars($this->input->post('vendor_email', true)),
        'vendor_npwp' => htmlspecialchars($this->input->post('vendor_npwp', true))
      );
      $this->m_data->update_data($where,$data,'vendor');
      $this->session->set_flashdata('msg', ' Diubah');
      redirect(base_url().'admin/vendor');
    }else{
      $id_vendor = $this->input->post('id_vendor');
      $where = array(
        'id_vendor' => $id_vendor
      );
      $data['title'] = 'Eno Journal - Edit Vendor';
      $data['url'] = 'Edit Vendor';
      $data['judul'] = 'Form Edit Data Vendor' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['vendor'] = $this->m_data->edit_data($where,'vendor')->result();
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_vendor_ubah', $data);
      $this->load->view('admin/v_footer');
    }
  }

  // Fungsi hapus
  public function hapus_vendor($id_vendor)
  {
    $where = array(
      'id_vendor' => $id_vendor
    );
    $this->m_data->delete_data($where,'vendor');
    $this->session->set_flashdata('msg', ' Dihapus');
    redirect(base_url().'admin/vendor');
  }


  //////////////////////////// Fungsi account ///////////////////////////////////////////////

  public function account()
  {
    $data['title'] = 'Eno Journal - account';
    $data['card'] = 'Data account';
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['account'] = $this->db->query("SELECT * FROM account JOIN classaccount ON account.id_class=classaccount.id_class ORDER BY account.id_account ASC")->result();
    $data['msg'] = $this->session->flashdata('msg');
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_account',$data);
    $this->load->view('admin/v_footer');
  }

  public function tambah_account()
  {
    $data['title'] = 'Eno Journal - Tambah account';
    $data['url'] = 'Tambah account';
    $data['judul'] = 'Form Tambah Data account' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['class'] = $this->m_data->get_data('classaccount')->result();
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_account_tambah', $data);
    $this->load->view('admin/v_footer');
  }

  public function account_aksi()
  {
    // Validasi Wajib isi form account
    $this->form_validation->set_rules('account_code', 'Account Code', 'numeric|max_length[6]|required|trim|is_unique[account.account_code]',[
      'is_unique' => 'This account code has already set'
    ]);
    $this->form_validation->set_rules('id_class', 'Classification', 'max_length[11]|required|trim');
    $this->form_validation->set_rules('account_name', 'Account Name', 'max_length[50]|required|trim|is_unique[account.account_name]',[
      'is_unique' => 'This account name has already set'
    ]);
    $this->form_validation->set_rules('normal_balance', 'Normal Balance', 'max_length[1]');
    $this->form_validation->set_rules('balance', 'Balance', 'numeric|max_length[13]|required|trim');
    if($this->form_validation->run() != false){
      $data = array(
        'account_code' => htmlspecialchars($this->input->post('account_code', true)),
        'id_class' => htmlspecialchars($this->input->post('id_class', true)),
        'account_name' => htmlspecialchars($this->input->post('account_name', true)),
        'normal_balance' => htmlspecialchars($this->input->post('normal_balance', true)),
        'balance' => htmlspecialchars($this->input->post('balance', true))
      );
      $this->m_data->insert_data($data,'account');
      $this->session->set_flashdata('msg', ' Disimpan');
      redirect(base_url().'admin/tambah_account');
    }else{
      $data['title'] = 'Eno Journal - Tambah account';
      $data['url'] = 'Tambah account';
      $data['judul'] = 'Form Tambah Data account' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['class'] = $this->m_data->get_data('classaccount')->result();
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_account_tambah', $data);
      $this->load->view('admin/v_footer');
    }
  }
  public function ubah_account($id_account){
    $where = array(
      'id_account' => $id_account
    );
    $data['title'] = 'Eno Journal - Edit account';
    $data['url'] = 'Edit account';
    $data['judul'] = 'Form Edit Data account' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['account'] = $this->m_data->edit_data($where,'account')->result();
    $data['class'] = $this->m_data->get_data('classaccount')->result();
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_account_ubah', $data);
    $this->load->view('admin/v_footer');
  }

  // Fungsi update halaman
  public function account_update()
  {
    // Validasi Wajib isi form account
    $id_account = $this->input->post('id_account');
    $account = $this->db->get_where('account', array('id_account' => $id_account))->row();
    $account_code = $account->account_code;
    if($this->input->post('account_code') != $account_code) {
      $is_unique =  '|is_unique[account.account_code]';
    } else {
      $is_unique =  '';
    }
    $this->form_validation->set_rules('account_code', 'Account Code', 'numeric|max_length[6]|required|trim'.$is_unique,[
      'is_unique' => 'This Account Code has already set!'
    ]);

    $name = $this->db->get_where('account', array('id_account' => $id_account))->row();
    $account_name = $name->account_name;
    if($this->input->post('account_name') != $account_name) {
      $name_unique =  '|is_unique[account.account_name]';
    } else {
      $name_unique =  '';
    }
    $this->form_validation->set_rules('account_name', 'Account Name', 'max_length[50]|required|trim'.$name_unique,[
      'is_unique' => 'This Account Name has already set!'
    ]);
    $this->form_validation->set_rules('id_class', 'Classification', 'max_length[11]|required|trim');
    $this->form_validation->set_rules('normal_balance', 'Normal Balance', 'max_length[1]');
    $this->form_validation->set_rules('balance', 'Balance', 'numeric|max_length[13]|required|trim');

    if($this->form_validation->run() != false){
      $id_account = $this->input->post('id_account');
      $where = array(
        'id_account' => $id_account
      );
      $data = array(
        'account_code' => htmlspecialchars($this->input->post('account_code', true)),
        'id_class' => htmlspecialchars($this->input->post('id_class', true)),
        'account_name' => htmlspecialchars($this->input->post('account_name', true)),
        'normal_balance' => htmlspecialchars($this->input->post('normal_balance', true)),
        'balance' => htmlspecialchars($this->input->post('balance', true))
      );
      $this->m_data->update_data($where,$data,'account');
      $this->session->set_flashdata('msg', ' Diubah');
      redirect(base_url().'admin/account');
    }else{
      $id_account = $this->input->post('id_account');
      $where = array(
        'id_account' => $id_account
      );
      $data['title'] = 'Eno Journal - Edit account';
      $data['url'] = 'Edit account';
      $data['judul'] = 'Form Edit Data account' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['account'] = $this->m_data->edit_data($where,'account')->result();
      $data['class'] = $this->m_data->get_data('classaccount')->result();
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_account_ubah', $data);
      $this->load->view('admin/v_footer');
    }
  }

  // Fungsi hapus
  public function hapus_account($id_account)
  {
    $where = array(
      'id_account' => $id_account
    );
    $this->m_data->delete_data($where,'account');
    $this->session->set_flashdata('msg', ' Dihapus');
    redirect(base_url().'admin/account');
  }
  /////////////////////////////////////// fungsi services //////////////////////////////////////
  public function service()
  {
    $data['title'] = 'Eno Journal - Service';
    $data['card'] = 'Data service';
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['service'] = $this->m_data->get_data('service')->result();
    $data['msg'] = $this->session->flashdata('msg');
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_service',$data);
    $this->load->view('admin/v_footer');
  }

  public function tambah_service()
  {
    $data['title'] = 'Eno Journal - Tambah service';
    $data['url'] = 'Tambah service';
    $data['judul'] = 'Form Tambah Data service' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_service_tambah', $data);
    $this->load->view('admin/v_footer');
  }

  public function service_aksi()
  {
    // Validasi Wajib isi form service
    $this->form_validation->set_rules('service_name', 'Service Name', 'max_length[50]|required|trim|is_unique[service.service_name]',[
      'is_unique' => 'This service name has already set'
    ]);
    $this->form_validation->set_rules('price', 'Price', 'numeric|max_length[13]|required|trim');
    if($this->form_validation->run() != false){
      $data = array(
        'service_name' => htmlspecialchars($this->input->post('service_name', true)),
        'price' => htmlspecialchars($this->input->post('price', true))
      );
      $this->m_data->insert_data($data,'service');
      $this->session->set_flashdata('msg', ' Disimpan');
      redirect(base_url().'admin/tambah_service');
    }else{
      $data['title'] = 'Eno Journal - Tambah Service';
      $data['url'] = 'Tambah Service';
      $data['judul'] = 'Form Tambah Data Service' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_service_tambah', $data);
      $this->load->view('admin/v_footer');
    }
  }
  public function ubah_service($id_service){
    $where = array(
      'id_service' => $id_service
    );
    $data['title'] = 'Eno Journal - Edit service';
    $data['url'] = 'Edit service';
    $data['judul'] = 'Form Edit Data service' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['service'] = $this->m_data->edit_data($where,'service')->result();
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_service_ubah', $data);
    $this->load->view('admin/v_footer');
  }

  // Fungsi update halaman
  public function service_update()
  {
    // Validasi Wajib isi form service
    $id_service = $this->input->post('id_service');
    $name = $this->db->get_where('service', array('id_service' => $id_service))->row();
    $service_name = $name->service_name;
    if($this->input->post('service_name') != $service_name) {
      $name_unique =  '|is_unique[service.service_name]';
    } else {
      $name_unique =  '';
    }
    $this->form_validation->set_rules('service_name', 'Service Name', 'max_length[50]|required|trim'.$name_unique,[
      'is_unique' => 'This Service Name has already set!'
    ]);
    $this->form_validation->set_rules('price', 'Price', 'numeric|max_length[13]|required|trim');

    if($this->form_validation->run() != false){
      $id_service = $this->input->post('id_service');
      $where = array(
        'id_service' => $id_service
      );
      $data = array(
        'service_name' => htmlspecialchars($this->input->post('service_name', true)),
        'price' => htmlspecialchars($this->input->post('price', true))
      );
      $this->m_data->update_data($where,$data,'service');
      $this->session->set_flashdata('msg', ' Diubah');
      redirect(base_url().'admin/service');
    }else{
      $id_service = $this->input->post('id_service');
      $where = array(
        'id_service' => $id_service
      );
      $data['title'] = 'Eno Journal - Edit Service';
      $data['url'] = 'Edit Service';
      $data['judul'] = 'Form Edit Data Service' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['service'] = $this->m_data->edit_data($where,'service')->result();
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_service_ubah', $data);
      $this->load->view('admin/v_footer');
    }
  }

  // Fungsi hapus
  public function hapus_service($id_service)
  {
    $where = array(
      'id_service' => $id_service
    );
    $this->m_data->delete_data($where,'service');
    $this->session->set_flashdata('msg', ' Dihapus');
    redirect(base_url().'admin/service');
  }

  /////////////////////////////////////// fungsi profile //////////////////////////////////////

  public function profile()
  {
    $data['title'] = 'Eno Journal - Profile';
    $data['card'] = 'Profile';
    $data['msg'] = $this->session->flashdata('msg');
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_profile', $data);
    $this->load->view('admin/v_footer');
  }

  public function ubah_profile($id_user)
  {
    $data['title'] = 'Eno Journal - Edit Profile';
    $data['url'] = 'Edit Profile';
    $data['judul'] = 'Form Edit Data Profile' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['edtprofile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.id_user='$id_user'")->result();
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_profile_ubah', $data);
    $this->load->view('admin/v_footer');
  }

  // Fungsi update halaman
  public function profile_update()
  {
    $id_user = $this->input->post('id_user');
    $name = $this->db->get_where('user', array('id_user' => $id_user))->row();
    $fullname = $name->fullname;
    if($this->input->post('fullname') != $fullname) {
        $name_unique =  '|is_unique[user.fullname]';
    } else {
        $name_unique =  '';
    }
    $this->form_validation->set_rules('fullname', 'Fullname', 'max_length[50]|required|trim'.$name_unique,[
        'is_unique' => 'This Name has already registered!'
    ]);
      $this->form_validation->set_rules('address', 'Address', 'max_length[150]|required|trim');
    if($this->form_validation->run() != false){
      $where = array(
        'id_user' => $id_user
      );
      $data = array(
        'fullname' => htmlspecialchars($this->input->post('fullname', true)),
        'address' => htmlspecialchars($this->input->post('address', true)),
      );
      $this->m_data->update_data($where,$data,'user');
      if (!empty($_FILES['foto']['name'])){
        $config['upload_path'] = './assets/theme-assets/images/portrait/small/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2048;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('foto')) {
          $old_image = $name->foto;
          if($old_image != 'default.jpg'){
            unlink(FCPATH . 'assets/theme-assets/images/portrait/small/' . $old_image);
          }
          // mengambil data tentang gambar
          $gambar = $this->upload->data();
          $data = array(
            'foto' => $gambar['file_name'],
          );
          $this->m_data->update_data($where,$data,'user');
          $this->session->set_flashdata('msg', ' Diubah');
          redirect(base_url().'admin/profile');
        } else {
          $this->form_validation->set_message('foto', $data['foto_error'] = $this->upload->display_errors());
          $where = array(
            'id_user' => $id_user
          );
          $data['title'] = 'Eno Journal - Edit Profile';
          $data['url'] = 'Edit Profile';
          $data['judul'] = 'Form Edit Data Profile' ;
          $email = $this->session->userdata('email');
          $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
          $data['edtprofile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.id_user='$id_user'")->result();
          $this->load->view('admin/v_header', $data);
          $this->load->view('admin/v_profile_ubah', $data);
          $this->load->view('admin/v_footer');
        }
      }else{
        redirect(base_url().'admin/profile');
      }
    }else{
      $id_user = $this->input->post('id_user');
      $where = array(
        'id_user' => $id_user
      );
      $data['title'] = 'Eno Journal - Edit Profile';
      $data['url'] = 'Edit Profile';
      $data['judul'] = 'Form Edit Data Profile' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['edtprofile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.id_user='$id_user'")->result();
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_profile_ubah', $data);
      $this->load->view('admin/v_footer');
    }
  }

  /////////////////////////////////////// ganti password //////////////////////////////////////

  public function password()
  {
    $data['title'] = 'Eno Journal - Edit Password';
    $data['url'] = 'Edit Password';
    $data['judul'] = 'Form Edit Password' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_password_ubah', $data);
    $this->load->view('admin/v_footer');
  }

  public function password_aksi()
  {
    ?>
    <script src="<?php echo base_url(); ?>assets/assets/js/sweetalert2/dist/sweetalert2.all.min.js" type="text/javascript"></script>
    <body></body>
    <?php
    $data['title'] = 'Eno Journal - Edit Password';
    $data['url'] = 'Edit Password';
    $data['judul'] = 'Form Edit Password' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row_array();

    // form validasi
    $this->form_validation->set_rules('old_password','Old Password','required');
    $this->form_validation->set_rules('new_password', 'New Password', 'required|trim|min_length[3]|matches[repeat_password]', [
      'matches' => 'Password dont match!',
      'min_length' => 'Password too short!'
    ]);
    $this->form_validation->set_rules('repeat_password', 'Repeat Password', 'required|trim|matches[new_password]');
    // cek validasi
    if($this->form_validation->run() == false){
      $data['title'] = 'Eno Journal - Edit Password';
      $data['url'] = 'Edit Password';
      $data['judul'] = 'Form Edit Password' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_password_ubah', $data);
      $this->load->view('admin/v_footer');
    }else{
      $old_password = $this->input->post('old_password');
      $new_password = $this->input->post('new_password');
      if(!password_verify($old_password, $data['profile']['password'])){
        ?>
        <script>
        Swal.fire({
          icon: 'error',
          title: 'Failed',
          text: 'Wrong old password!'
        }).then((result) => {
          window.location='<?=base_url('admin/password')?>';
        })
        </script>
        <?php
      } else {
        if($old_password == $new_password){
          ?>
          <script>
          Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: 'New password cannot be the same as Old Password!'
          }).then((result) => {
            window.location='<?=base_url('admin/password')?>';
          })
          </script>
          <?php
        } else {
          // password sudah ok
          $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
          $this->db->set('password', $password_hash);
          $this->db->where('email', $email);
          $this->db->update('user');
          $this->session->set_flashdata('msg', ' Diubah');
          redirect(base_url().'admin/password');
        }
      }
    }
  }

    /////////////////////////////////////// class account //////////////////////////////////////

    public function classaccount()
    {
      $data['title'] = 'Eno Journal - Class Account';
      $data['card'] = 'Data Class Account';
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['classaccount'] = $this->m_data->get_data('classaccount')->result();
      $data['msg'] = $this->session->flashdata('msg');
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_classaccount',$data);
      $this->load->view('admin/v_footer');
    }

    public function tambah_classaccount()
    {
      $data['title'] = 'Eno Journal - Tambah Class Account';
      $data['url'] = 'Tambah Class Account';
      $data['judul'] = 'Form Tambah Data Class Account' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_classaccount_tambah', $data);
      $this->load->view('admin/v_footer');
    }

    public function classaccount_aksi()
    {
      // Validasi Wajib isi form classaccount
      $this->form_validation->set_rules('class_name', 'Class Account', 'max_length[30]|required|trim|is_unique[classaccount.class_name]',[
        'is_unique' => 'This class name name has already set'
      ]);

      if($this->form_validation->run() != false){
        $classaccount_name = $this->input->post('class_name');
        $data = array(
          'class_name' => $classaccount_name
        );
        $this->m_data->insert_data($data,'classaccount');
        $this->session->set_flashdata('msg', ' Disimpan');
        redirect(base_url().'admin/tambah_classaccount');
      }else{
        $data['title'] = 'Eno Journal - Tambah Data';
        $data['url'] = 'Tambah classaccount';
        $data['judul'] = 'Form Tambah Data classaccount' ;
        $email = $this->session->userdata('email');
        $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
        $this->load->view('admin/v_header', $data);
        $this->load->view('admin/v_classaccount_tambah', $data);
        $this->load->view('admin/v_footer');
      }
    }
    public function ubah_classaccount($id_class){
      $where = array(
        'id_class' => $id_class
      );
      $data['title'] = 'Eno Journal - Edit Class Account';
      $data['url'] = 'Edit Class Account';
      $data['judul'] = 'Form Edit Data Class Account' ;
      $data['classaccount'] = $this->m_data->edit_data($where,'classaccount')->result();
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_classaccount_ubah', $data);
      $this->load->view('admin/v_footer');
    }

    // Fungsi update halaman
    public function classaccount_update()
    {
      // Wajib isi judul,konten
      $id_class = $this->input->post('id_class');
      $name = $this->db->get_where('classaccount', array('id_class' => $id_class))->row();
      $classname = $name->class_name;
      if($this->input->post('class_name') != $classname) {
          $name_unique =  '|is_unique[classaccount.class_name]';
      } else {
          $name_unique =  '';
      }
      $this->form_validation->set_rules('class_name', 'Class Name', 'max_length[30]|required|trim'.$name_unique,[
          'is_unique' => 'This class name has already registered!'
      ]);
      if($this->form_validation->run() != false){
        $class_name = $this->input->post('class_name');
        $where = array(
          'id_class' => $id_class
        );
        $data = array(
          'class_name' => $class_name
        );
        $this->m_data->update_data($where,$data,'classaccount');
        $this->session->set_flashdata('msg', ' Diubah');
        redirect(base_url().'admin/classaccount');
      }else{
        $id_class = $this->input->post('id_class');
        $where = array(
          'id_class' => $id_class
        );
        $data['title'] = 'Eno Journal - Edit Class Account';
        $data['url'] = 'Edit Class Account';
        $data['judul'] = 'Form Edit Class Account' ;
        $email = $this->session->userdata('email');
        $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
        $data['classaccount'] = $this->m_data->edit_data($where,'classaccount')->result();
        $this->load->view('admin/v_header', $data);
        $this->load->view('admin/v_classaccount_ubah', $data);
        $this->load->view('admin/v_footer');
      }
    }

    function report()
    {
      $data['title'] = 'Eno Journal - Report';
      $data['card'] = 'Data Report';
      $data['judul'] = 'Form Reports' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['msg'] = $this->session->flashdata('msg');
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/v_adminreport',$data);
      $this->load->view('admin/v_footer');
    }

    function report_aksi()
    {
      $this->form_validation->set_rules('report', 'Report', 'required');
      ?>
      <script src="<?php echo base_url(); ?>assets/assets/js/sweetalert2/dist/sweetalert2.all.min.js" type="text/javascript"></script>
      <body></body>
      <?php
      $report = $this->input->post('report');
      if ($this->form_validation->run() != false) {
        if ($report == 'role') {

        }
      } else {
        ?>
        <script>
        Swal.fire({
          icon: 'error',
          title: 'Failed',
          text: 'Error get reports'
        }).then((result) => {
          window.location='<?=base_url('admin/report')?>';
        })
        </script>
        <?php
      }
    }

  }
