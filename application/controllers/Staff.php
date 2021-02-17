<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Staff extends CI_Controller {
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
    if($this->session->userdata('id_role')!="3"){
      redirect(base_url().'welcome/notfound');
    }
  }

  public function index()
  {
    $data['user'] = $this->db->query("SELECT * FROM user ORDER BY last_login DESC LIMIT 5;")->result();
    $data['title'] = 'Eno Journal - Dashboard';
    $data['card'] = 'Staff';
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $this->load->view('staff/v_header',$data);
    $this->load->view('staff/v_index', $data);
    $this->load->view('staff/v_footer');
  }

  ////////////////////////////  fungsi cashin ///////////////////////////////////////////
  public function cashin()
  {
    $data['title'] = 'Eno Journal - Cash In';
    $data['card'] = 'Data Cash In';
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['cashin'] = $this->db->query("SELECT * FROM cashin LEFT JOIN invoice ON cashin.id_invoice=invoice.id_invoice ORDER BY cashin.post_date DESC")->result();
    $data['msg'] = $this->session->flashdata('msg');
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_cashin',$data);
    $this->load->view('staff/v_footer');
  }

  public function tambah_cashin()
  {
    $data['title'] = 'Eno Journal - Add Cash In';
    $data['url'] = 'Add Cash In';
    $data['judul'] = 'Form Add Cash In' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['account'] = $this->db->query("SELECT * FROM account JOIN classaccount ON account.id_class=classaccount.id_class ORDER BY classaccount.id_class ASC")->result();
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_cashin_tambah', $data);
    $this->load->view('staff/v_footer');
  }

  public function cashin_aksi()
  {
    // Validasi Wajib isi form cashin
    $this->form_validation->set_rules('post_date', 'Post Date', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required|max_length[50]');
    $this->form_validation->set_rules('receipt', 'Income', 'required');
    $this->form_validation->set_rules('id_accountd', 'Account Debet', 'required');
    $this->form_validation->set_rules('id_accountc', 'Account Credit', 'required');
    $this->form_validation->set_rules('total', 'Total', 'numeric|required|max_length[13]');

    if($this->form_validation->run() != false){
      $id_user = $this->session->userdata('id_user');
      $no_cashin = $this->m_data->code_cashin();
      $description = $this->input->post('description');
      $post_date = $this->input->post('post_date');
      $receipt = $this->input->post('receipt');
      $id_accountd = $this->input->post('id_accountd');
      $id_accountc = $this->input->post('id_accountc');
      $total = $this->input->post('total');
      $data = array(
        'no_cashin' => $no_cashin,
        'receipt' => $receipt,
        'id_user' => $id_user,
        'description' => $description,
        'post_date' => $post_date,
        'total_cashin' => $total
      );
      $this->m_data->insert_data($data,'cashin');
      $detil1 = array(
        'no_cashin' => $no_cashin,
        'id_account' => $id_accountd,
        'dc' => 'D',
        'total' => $total
      );
      $this->m_data->insert_data($detil1,'detil_cashin');
      $detil2 = array(
        'no_cashin' => $no_cashin,
        'id_account' => $id_accountc,
        'dc' => 'C',
        'total' => $total
      );
      $this->m_data->insert_data($detil2,'detil_cashin');
      $this->session->set_flashdata('msg', ' Disimpan');
      redirect(base_url().'staff/tambah_cashin');
    }else{
      $data['title'] = 'Eno Journal - Add Cash In';
      $data['url'] = 'Add Cash In';
      $data['judul'] = 'Form Add Cash In' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['account'] = $this->db->query("SELECT * FROM account JOIN classaccount ON account.id_class=classaccount.id_class ORDER BY classaccount.id_class ASC")->result();
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_cashin_tambah', $data);
      $this->load->view('staff/v_footer');
    }
  }
  public function ubah_cashin($no_cashin){
    $where = array(
      'no_cashin' => $no_cashin
    );
    $data['title'] = 'Eno Journal - Edit Cash In';
    $data['url'] = 'Edit Cash In';
    $data['judul'] = 'Form Edit Cash In' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['cashin'] = $this->db->query("SELECT * FROM cashin JOIN detil_cashin ON cashin.no_cashin=detil_cashin.no_cashin WHERE cashin.no_cashin='$no_cashin'")->result();
    $data['cashind'] = $this->db->query("SELECT * FROM cashin JOIN detil_cashin ON cashin.no_cashin=detil_cashin.no_cashin WHERE detil_cashin.no_cashin='$no_cashin' AND detil_cashin.dc='D'")->result();
    $data['cashinc'] = $this->db->query("SELECT * FROM cashin JOIN detil_cashin ON cashin.no_cashin=detil_cashin.no_cashin WHERE detil_cashin.no_cashin='$no_cashin' AND detil_cashin.dc='C'")->result();
    $data['account'] = $this->db->query("SELECT * FROM account JOIN classaccount ON account.id_class=classaccount.id_class ORDER BY classaccount.id_class ASC")->result();
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_cashin_ubah', $data);
    $this->load->view('staff/v_footer');
  }

  // Fungsi update halaman
  public function cashin_update()
  {
    // Wajib isi judul,konten
    $this->form_validation->set_rules('post_date', 'Post Date', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required|max_length[50]');
    $this->form_validation->set_rules('receipt', 'Income', 'required');
    $this->form_validation->set_rules('id_accountd', 'Account Debet', 'required');
    $this->form_validation->set_rules('id_accountc', 'Account Credit', 'required');
    $this->form_validation->set_rules('total', 'Total', 'numeric|required|max_length[13]');

    if($this->form_validation->run() != false){
      $id_user = $this->session->userdata('id_user');
      $no_cashin = $this->input->post('no_cashin');
      $description = $this->input->post('description');
      $post_date = $this->input->post('post_date');
      $receipt = $this->input->post('receipt');
      $id_accountd = $this->input->post('id_accountd');
      $id_accountc = $this->input->post('id_accountc');
      $total = $this->input->post('total');
      $debet = 'D';
      $credit = 'C';
      $where = array(
        'no_cashin' => $no_cashin
      );
      $data = array(
        'no_cashin' => $no_cashin,
        'receipt' => $receipt,
        'id_user' => $id_user,
        'description' => $description,
        'post_date' => $post_date,
        'total_cashin' => $total
      );
      $this->m_data->update_data($where,$data,'cashin');
      $where1 = array(
        'no_cashin' => $no_cashin,
        'dc' => $debet
      );
      $detil1 = array(
        'no_cashin' => $no_cashin,
        'id_account' => $id_accountd,
        'dc' => 'D',
        'total' => $total
      );
      $this->m_data->update_data($where1,$detil1,'detil_cashin');
      $where2 = array(
        'no_cashin' => $no_cashin,
        'dc' => $credit
      );
      $detil2 = array(
        'no_cashin' => $no_cashin,
        'id_account' => $id_accountc,
        'dc' => 'C',
        'total' => $total
      );
      $this->m_data->update_data($where2,$detil2,'detil_cashin');
      $this->session->set_flashdata('msg', ' Diubah');
      redirect(base_url().'staff/cashin');
    }else{
      $no_cashin = $this->input->post('no_cashin');
      $where = array(
        'no_cashin' => $no_cashin
      );
      $data['title'] = 'Eno Journal - Edit Cash In';
      $data['url'] = 'Edit Cash In';
      $data['judul'] = 'Form Edit Cash In' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['cashin'] = $this->db->query("SELECT * FROM cashin JOIN detil_cashin ON cashin.no_cashin=detil_cashin.no_cashin WHERE cashin.no_cashin='$no_cashin'")->result();
      $data['cashind'] = $this->db->query("SELECT * FROM cashin JOIN detil_cashin ON cashin.no_cashin=detil_cashin.no_cashin WHERE detil_cashin.no_cashin='$no_cashin' AND detil_cashin.dc='D'")->result();
      $data['cashinc'] = $this->db->query("SELECT * FROM cashin JOIN detil_cashin ON cashin.no_cashin=detil_cashin.no_cashin WHERE detil_cashin.no_cashin='$no_cashin' AND detil_cashin.dc='C'")->result();
      $data['account'] = $this->db->query("SELECT * FROM account JOIN classaccount ON account.id_class=classaccount.id_class ORDER BY classaccount.id_class ASC")->result();
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_cashin_ubah', $data);
      $this->load->view('staff/v_footer');
    }
  }

  // Fungsi hapus
  public function hapus_cashin($no_cashin)
  {
    $id=$no_cashin;
    $tables = array('cashin', 'detil_cashin');
    $this->db->where('no_cashin', $id);
    $this->db->delete($tables);
    $this->session->set_flashdata('msg', ' Dihapus');
    redirect(base_url().'staff/cashin');
  }

  ////////////////////////////  fungsi cashout ///////////////////////////////////////////
  public function cashout()
  {
    $data['title'] = 'Eno Journal - Cash Out';
    $data['card'] = 'Data Cash Out';
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['cashout'] = $this->db->query("SELECT * FROM cashout LEFT JOIN purchase_order ON cashout.id_po=purchase_order.id_po ORDER BY cashout.post_date DESC")->result();
    $data['msg'] = $this->session->flashdata('msg');
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_cashout',$data);
    $this->load->view('staff/v_footer');
  }

  public function tambah_cashout()
  {
    $data['title'] = 'Eno Journal - Add Cash Out';
    $data['url'] = 'Add Cash Out';
    $data['judul'] = 'Form Add Cash Out' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['account'] = $this->db->query("SELECT * FROM account JOIN classaccount ON account.id_class=classaccount.id_class ORDER BY classaccount.id_class ASC")->result();
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_cashout_tambah', $data);
    $this->load->view('staff/v_footer');
  }

  public function cashout_aksi()
  {
    // Validasi Wajib isi form cashin
    $this->form_validation->set_rules('post_date', 'Post Date', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required|max_length[50]');
    $this->form_validation->set_rules('no_document', 'Nomor Document', 'required|max_length[30]');
    $this->form_validation->set_rules('id_accountd', 'Account Debet', 'required');
    $this->form_validation->set_rules('id_accountc', 'Account Credit', 'required');
    $this->form_validation->set_rules('total', 'Total', 'numeric|required|max_length[13]');

    if($this->form_validation->run() != false){
      $id_user = $this->session->userdata('id_user');
      $no_cashout = $this->m_data->code_cashout();
      $description = $this->input->post('description');
      $post_date = $this->input->post('post_date');
      $no_document = $this->input->post('no_document');
      $id_accountd = $this->input->post('id_accountd');
      $id_accountc = $this->input->post('id_accountc');
      $total = $this->input->post('total');
      $data = array(
        'no_cashout' => $no_cashout,
        'no_document' => $no_document,
        'id_user' => $id_user,
        'description' => $description,
        'post_date' => $post_date,
        'total_cashout' => $total
      );
      $this->m_data->insert_data($data,'cashout');
      $detil1 = array(
        'no_cashout' => $no_cashout,
        'id_account' => $id_accountd,
        'dc' => 'D',
        'total' => $total
      );
      $this->m_data->insert_data($detil1,'detil_cashout');
      $detil2 = array(
        'no_cashout' => $no_cashout,
        'id_account' => $id_accountc,
        'dc' => 'C',
        'total' => $total
      );
      $this->m_data->insert_data($detil2,'detil_cashout');
      $this->session->set_flashdata('msg', ' Disimpan');
      redirect(base_url().'staff/tambah_cashout');
    }else{
      $data['title'] = 'Eno Journal - Add Cash Out';
      $data['url'] = 'Add Cash Out';
      $data['judul'] = 'Form Add Cash Out';
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['account'] = $this->db->query("SELECT * FROM account JOIN classaccount ON account.id_class=classaccount.id_class ORDER BY classaccount.id_class ASC")->result();
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_cashout_tambah', $data);
      $this->load->view('staff/v_footer');
    }
  }
  public function ubah_cashout($no_cashout){
    $where = array(
      'no_cashout' => $no_cashout
    );
    $data['title'] = 'Eno Journal - Edit Cash Out';
    $data['url'] = 'Edit Cash Out';
    $data['judul'] = 'Form Edit Cash Out' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['cashout'] = $this->db->query("SELECT * FROM cashout JOIN detil_cashout ON cashout.no_cashout=detil_cashout.no_cashout WHERE cashout.no_cashout='$no_cashout'")->result();
    $data['cashoutd'] = $this->db->query("SELECT * FROM cashout JOIN detil_cashout ON cashout.no_cashout=detil_cashout.no_cashout WHERE detil_cashout.no_cashout='$no_cashout' AND detil_cashout.dc='D'")->result();
    $data['cashoutc'] = $this->db->query("SELECT * FROM cashout JOIN detil_cashout ON cashout.no_cashout=detil_cashout.no_cashout WHERE detil_cashout.no_cashout='$no_cashout' AND detil_cashout.dc='C'")->result();
    $data['account'] = $this->db->query("SELECT * FROM account JOIN classaccount ON account.id_class=classaccount.id_class ORDER BY classaccount.id_class ASC")->result();
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_cashout_ubah', $data);
    $this->load->view('staff/v_footer');
  }

  // Fungsi update halaman
  public function cashout_update()
  {
    // Wajib isi judul,konten
    $this->form_validation->set_rules('post_date', 'Post Date', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required|max_length[50]');
    $this->form_validation->set_rules('no_document', 'Nomor Document', 'required');
    $this->form_validation->set_rules('id_accountd', 'Account Debet', 'required');
    $this->form_validation->set_rules('id_accountc', 'Account Credit', 'required');
    $this->form_validation->set_rules('total', 'Total', 'numeric|required|max_length[13]');

    if($this->form_validation->run() != false){
      $id_user = $this->session->userdata('id_user');
      $no_cashout = $this->input->post('no_cashout');
      $description = $this->input->post('description');
      $post_date = $this->input->post('post_date');
      $no_document = $this->input->post('no_document');
      $id_accountd = $this->input->post('id_accountd');
      $id_accountc = $this->input->post('id_accountc');
      $total = $this->input->post('total');
      $debet = 'D';
      $credit = 'C';
      $where = array(
        'no_cashout' => $no_cashout
      );
      $data = array(
        'no_cashout' => $no_cashout,
        'no_document' => $no_document,
        'id_user' => $id_user,
        'description' => $description,
        'post_date' => $post_date,
        'total_cashout' => $total
      );
      $this->m_data->update_data($where,$data,'cashout');
      $where1 = array(
        'no_cashout' => $no_cashout,
        'dc' => $debet
      );
      $detil1 = array(
        'no_cashout' => $no_cashout,
        'id_account' => $id_accountd,
        'dc' => 'D',
        'total' => $total
      );
      $this->m_data->update_data($where1,$detil1,'detil_cashout');
      $where2 = array(
        'no_cashout' => $no_cashout,
        'dc' => $credit
      );
      $detil2 = array(
        'no_cashout' => $no_cashout,
        'id_account' => $id_accountc,
        'dc' => 'C',
        'total' => $total
      );
      $this->m_data->update_data($where2,$detil2,'detil_cashout');
      $this->session->set_flashdata('msg', ' Diubah');
      redirect(base_url().'staff/cashout');
    }else{
      $no_cashout = $this->input->post('no_cashout');
      $where = array(
        'no_cashout' => $no_cashout
      );
      $data['title'] = 'Eno Journal - Edit Cash Out';
      $data['url'] = 'Edit Cash Out';
      $data['judul'] = 'Form Edit Cash Out' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['cashout'] = $this->db->query("SELECT * FROM cashout JOIN detil_cashout ON cashout.no_cashout=detil_cashout.no_cashout WHERE cashout.no_cashout='$no_cashout'")->result();
      $data['cashoutd'] = $this->db->query("SELECT * FROM cashout JOIN detil_cashout ON cashout.no_cashout=detil_cashout.no_cashout WHERE detil_cashout.no_cashout='$no_cashout' AND detil_cashout.dc='D'")->result();
      $data['cashoutc'] = $this->db->query("SELECT * FROM cashout JOIN detil_cashout ON cashout.no_cashout=detil_cashout.no_cashout WHERE detil_cashout.no_cashout='$no_cashout' AND detil_cashout.dc='C'")->result();
      $data['account'] = $this->db->query("SELECT * FROM account JOIN classaccount ON account.id_class=classaccount.id_class ORDER BY classaccount.id_class ASC")->result();
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_cashout_ubah', $data);
      $this->load->view('staff/v_footer');
    }
  }

  // Fungsi hapus
  public function hapus_cashout($no_cashout)
  {
    $id=$no_cashout;
    $tables = array('cashout', 'detil_cashout');
    $this->db->where('no_cashout', $id);
    $this->db->delete($tables);
    $this->session->set_flashdata('msg', ' Dihapus');
    redirect(base_url().'staff/cashout');
  }


  ////////////////////////// fungsi order //////////////////////////////////////////

  public function order()
  {
    $data['title'] = 'Eno Journal - Order';
    $data['card'] = 'Data Order';
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['orderservice'] = $this->db->query("SELECT * FROM order_service JOIN customer ON order_service.id_customer=customer.id_customer JOIN user ON order_service.id_user=user.id_user ORDER BY id_order")->result();
    $data['msg'] = $this->session->flashdata('msg');
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_order',$data);
    $this->load->view('staff/v_footer');
  }

  public function tambah_order()
  {
    $data['title'] = 'Eno Journal - Tambah order';
    $data['url'] = 'Tambah order';
    $data['judul'] = 'Form Tambah Data order' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['customer'] = $this->m_data->get_data('customer')->result();
    $data['service'] = $this->m_data->get_data('service')->result();
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_order_tambah', $data);
    $this->load->view('staff/v_footer');
  }

  function get_customer(){
    $id_customer=$this->input->post('id_customer');
    $data=$this->m_data->get_data_customer_bykode($id_customer);
    echo json_encode($data);
  }

  function get_service(){
    $id_service=$this->input->post('id_service');
    $data=$this->m_data->get_data_service_bykode($id_service);
    echo json_encode($data);
  }


  public function order_aksi()
  {
    // Validasi Wajib isi form order
    $this->form_validation->set_rules('id_customer', 'Customer Name', 'required|trim');
    $this->form_validation->set_rules('id_service', 'Service', 'required|trim');
    $this->form_validation->set_rules('quantity', 'Quantity', 'numeric|max_length[13]|required|trim');
    $this->form_validation->set_rules('amount', 'Amount', 'numeric|max_length[13]|required|trim');
    $this->form_validation->set_rules('date', 'Date Order', 'required|trim');
    if($this->form_validation->run() != false){
      $data = array(
        'id_customer' => htmlspecialchars($this->input->post('id_customer', true)),
        'id_service' => htmlspecialchars($this->input->post('id_service', true)),
        'quantity' => htmlspecialchars($this->input->post('quantity', true)),
        'total' => htmlspecialchars($this->input->post('amount', true)),
        'date_order' => htmlspecialchars($this->input->post('date', true)),
        'status_detil' => "1"
      );
      $this->m_data->insert_data($data,'order_detil');
      $this->session->set_flashdata('msg', ' Disimpan');
      redirect(base_url().'staff/tambah_order');
    }else{
      $data['title'] = 'Eno Journal - Tambah order';
      $data['url'] = 'Tambah order';
      $data['judul'] = 'Form Tambah Data order' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['customer'] = $this->m_data->get_data('customer')->result();
      $data['service'] = $this->m_data->get_data('service')->result();
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_order_tambah', $data);
      $this->load->view('staff/v_footer');
    }
  }

  public function order_list(){
    $where = $this->input->post('id_customer');
    $data['title'] = 'Eno Journal - List Order';
    $data['url'] = 'List order';
    $data['judul'] = 'List Order' ;
    $email = $this->session->userdata('email');
    $data['customer'] = $this->db->query("SELECT * FROM customer WHERE id_customer='$where'")->row();
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['list_order'] = $this->db->query("SELECT * FROM order_detil JOIN service ON order_detil.id_service=service.id_service LEFT JOIN customer ON order_detil.id_customer=customer.id_customer WHERE order_detil.id_customer='$where' AND order_detil.status_detil='1'")->result();
    $data['jumlah'] = $this->db->query("SELECT SUM(total) AS jumlah FROM order_detil WHERE id_customer='$where' AND status_detil='1'")->row()->jumlah;
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_order_list', $data);
    $this->load->view('staff/v_footer');
  }

  public function order_proses(){
    $no_order = $this->m_data->code_order();
    $id_customer = $this->input->post('id_customer');
    $id_user = $this->session->userdata('id_user');
    $date_order = date('Y-m-d');
    $total_service = $this->input->post('total_service');
    $data = array(
      'no_order' => $no_order,
      'id_customer' => $id_customer,
      'id_user' => $id_user,
      'total_service' => $total_service,
      'date_order' => $date_order,
      'status_order' => "1"
    );
    $this->m_data->insert_data($data,'order_service');
    $no_note = $this->m_data->code_note();
    $data2 = array(
      'id_user' => $id_user,
      'no_note' => $no_note,
      'no_order' => $no_order,
      'date_created' => $date_order,
      'total_note' => $total_service
    );
    $this->m_data->insert_data($data2,'order_note');
    $where = array(
      'id_customer' => $id_customer,
      'status_detil' => "1"
    );
    $data3 = array(
      'no_order' => $no_order,
      'status_detil' => "2"
    );
    $this->m_data->update_data($where, $data3,'order_detil');
    $this->session->set_flashdata('msg', ' Disimpan');
    redirect(base_url().'staff/order');
  }

  // Fungsi hapus
  public function hapus_list($id_od)
  {
    $where = array(
      'id_od' => $id_od
    );
    $this->m_data->delete_data($where,'order_detil');
    $this->session->set_flashdata('msg', ' Dihapus');
    redirect(base_url().'staff/tambah_order');
  }

  public function ubah_order($id_order){
    $where = array(
      'id_order' => $id_order
    );
    $data['title'] = 'Eno Journal - Edit order';
    $data['url'] = 'Edit order';
    $data['judul'] = 'Form Edit Data order' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['order'] = $this->m_data->edit_data($where,'order')->result();
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_order_ubah', $data);
    $this->load->view('staff/v_footer');
  }

  // Fungsi update halaman
  public function order_update()
  {
    // Wajib isi judul,konten
    // Validasi Wajib isi form order
    $this->form_validation->set_rules('id_customer', 'Customer Name', 'max_length[11]|required|trim');
    $this->form_validation->set_rules('date_order', 'Tanggal Order', 'required|trim');
    $this->form_validation->set_rules('order_telp', 'order Telp/HP', 'numeric|max_length[13]|required|trim');

    if($this->form_validation->run() != false){
      $id_order = $this->input->post('id_order');
      $where = array(
        'id_order' => $id_order
      );
      $data = array(
        'order_name' => htmlspecialchars($this->input->post('order_name', true)),
        'order_address' => htmlspecialchars($this->input->post('order_address', true)),
        'order_telp' => htmlspecialchars($this->input->post('order_telp', true)),
        'order_email' => htmlspecialchars($this->input->post('order_email', true)),
        'order_npwp' => htmlspecialchars($this->input->post('order_npwp', true))
      );
      $this->m_data->update_data($where,$data,'order');
      $this->session->set_flashdata('msg', ' Diubah');
      redirect(base_url().'staff/order');
    }else{
      $id_order = $this->input->post('id_order');
      $where = array(
        'id_order' => $id_order
      );
      $data['title'] = 'Eno Journal - Edit order';
      $data['url'] = 'Edit order';
      $data['judul'] = 'Form Edit Data order' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['order'] = $this->m_data->edit_data($where,'order')->result();
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_order_ubah', $data);
      $this->load->view('staff/v_footer');
    }
  }

  // Fungsi hapus
  public function hapus_order($no_order)
  {
    $data = array(
      'status_detil' => "1"
    );
    $where=$no_order;
    $tables = array('order_service', 'order_note');
    $this->db->where('no_order', $where);
    $this->db->delete($tables);
    $this->db->update('order_detil', $data);
    $this->session->set_flashdata('msg', ' Dihapus');
    redirect(base_url().'staff/order');
  }

  public function preview_note($no_order)
  {
    $id=$no_order;
    $data['title'] = 'Eno Journal - Order Note';
    $data['card'] = 'Order Noter';
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['pesanan'] = $this->db->query("SELECT * FROM order_service WHERE no_order='$id'")->row();
    $data['user'] = $this->db->query("SELECT * FROM order_service JOIN user ON order_service.id_user=user.id_user WHERE order_service.no_order='$id'")->row();
    $data['customer'] = $this->db->query("SELECT * FROM order_service JOIN customer ON order_service.id_customer=customer.id_customer WHERE order_service.no_order='$id'")->row();
    $data['item'] = $this->db->query("SELECT * FROM order_detil JOIN service ON order_detil.id_service=service.id_service WHERE order_detil.no_order='$id' ORDER BY id_od")->result();
    $data['jumlah'] = $this->db->query("SELECT SUM(total) AS jumlah FROM order_detil WHERE no_order='$id' AND status_detil='2'")->row()->jumlah;
    $data['msg'] = $this->session->flashdata('msg');
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_preview_ordernote',$data);
    $this->load->view('staff/v_footer');
  }

  //////////////////////////// Fungsi invoice ///////////////////////////////////////////////
  public function invoice()
  {
    $data['title'] = 'Eno Journal - invoice';
    $data['card'] = 'Data invoice';
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['invoice'] = $this->db->query("SELECT * FROM invoice JOIN order_service ON invoice.no_order=order_service.no_order
                                                               LEFT JOIN customer ON order_service.id_customer=customer.id_customer")->result();
    $data['msg'] = $this->session->flashdata('msg');
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_invoice',$data);
    $this->load->view('staff/v_footer');
  }

  public function tambah_invoice()
  {
    $data['title'] = 'Eno Journal - Tambah invoice';
    $data['url'] = 'Tambah invoice';
    $data['judul'] = 'Form Tambah Data invoice' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['no_or'] = $this->db->query("SELECT * FROM order_service WHERE status_order='1'")->result();
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_invoice_tambah', $data);
    $this->load->view('staff/v_footer');
  }

  function get_noorder(){
    $no_order=$this->input->post('no_order');
    $data=$this->m_data->get_data_noorder_bykode($no_order);
    echo json_encode($data);
  }


  public function invoice_aksi()
  {
    // Validasi Wajib isi form customer
    $this->form_validation->set_rules('date_invoice', 'invoice Date', 'required|trim');
    $this->form_validation->set_rules('no_order', 'Order Number', 'max_length[30]|required|trim');
    $this->form_validation->set_rules('due_date', 'Due Date', 'required|trim');
    $this->form_validation->set_rules('total_invoice', 'Total Invoice', 'required|trim');
    if($this->form_validation->run() != false){
      $no_invoice = $this->m_data->code_invoice();
      $data = array(
        'no_invoice' => $no_invoice,
        'no_order' => htmlspecialchars($this->input->post('no_order', true)),
        'due_date' => htmlspecialchars($this->input->post('due_date', true)),
        'total_invoice' => htmlspecialchars($this->input->post('total_invoice', true)),
        'date_invoice' => htmlspecialchars($this->input->post('date_invoice', true)),
        'status_invoice' => "1"
      );
      $this->m_data->insert_data($data,'invoice');
      $where = array(
        'no_order' => htmlspecialchars($this->input->post('no_order', true)),
      );
      $data1 = array(
        'status_order' => "2"
      );
      $this->m_data->update_data($where,$data1,'order_service');
      $this->session->set_flashdata('msg', ' Disimpan');
      redirect(base_url().'staff/tambah_invoice');
    }else{
      $data['title'] = 'Eno Journal - Tambah invoice';
      $data['url'] = 'Tambah invoice';
      $data['judul'] = 'Form Tambah Data invoice' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['no_or'] = $this->db->query("SELECT * FROM order_service WHERE status_order='1'")->result();
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_invoice_tambah', $data);
      $this->load->view('staff/v_footer');
    }
  }
  public function ubah_invoice($no_order){
    $where = array(
      'no_order' => $no_order
    );
    $data['title'] = 'Eno Journal - Edit invoice';
    $data['url'] = 'Edit invoice';
    $data['judul'] = 'Form Edit Data invoice' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['invoice'] = $this->m_data->edit_data($where,'invoice')->result();
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_invoice_ubah', $data);
    $this->load->view('staff/v_footer');
  }

  // Fungsi update halaman
  public function invoice_update()
  {
    $this->form_validation->set_rules('date_invoice', 'invoice Date', 'required|trim');
    $this->form_validation->set_rules('no_order', 'Order Number', 'max_length[30]|required|trim');
    $this->form_validation->set_rules('due_date', 'Due Date', 'required|trim');
    $this->form_validation->set_rules('total_invoice', 'Total Invoice', 'required|trim');
    $this->form_validation->set_rules('status_invoice', 'Status Invoice', 'required|trim');

    if($this->form_validation->run() != false){
      $no_order = $this->input->post('no_order');
      $where = array(
        'no_order' => $no_order
      );
      $data = array(
        'due_date' => htmlspecialchars($this->input->post('due_date', true)),
        'total_invoice' => htmlspecialchars($this->input->post('total_invoice', true)),
        'date_invoice' => htmlspecialchars($this->input->post('date_invoice', true)),
        'status_invoice' => htmlspecialchars($this->input->post('status_invoice', true))
      );
      $this->m_data->update_data($where,$data,'invoice');
      $this->session->set_flashdata('msg', ' Diubah');
      redirect(base_url().'staff/invoice');
    }else{
      $no_order = $this->input->post('no_order');
      $where = array(
        'no_order' => $no_order
      );
      $data['title'] = 'Eno Journal - Edit invoice';
      $data['url'] = 'Edit invoice';
      $data['judul'] = 'Form Edit Data invoice' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['invoice'] = $this->m_data->edit_data($where,'invoice')->result();
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_invoice_ubah', $data);
      $this->load->view('staff/v_footer');
  }
}

  // Fungsi hapus
  public function hapus_invoice($no_order)
  {
    $data = array(
      'status_order' => "1"
    );
    $where=$no_order;
    $tables = array('invoice');
    $this->db->where('no_order', $where);
    $this->db->delete($tables);
    $this->db->update('order_service', $data);
    $this->session->set_flashdata('msg', ' Dihapus');
    redirect(base_url().'staff/invoice');
  }


  public function previewInvoice($no_order)
  {
    $id=$no_order;
    $data['title'] = 'Eno Journal - invoice';
    $data['card'] = 'Data invoice';
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['pesanan'] = $this->db->query("SELECT * FROM invoice WHERE no_order='$id'")->row();
    $data['user'] = $this->db->query("SELECT * FROM order_service JOIN user ON order_service.id_user=user.id_user WHERE order_service.no_order='$id'")->row();
    $data['customer'] = $this->db->query("SELECT * FROM order_service JOIN customer ON order_service.id_customer=customer.id_customer WHERE order_service.no_order='$id'")->row();
    $data['item'] = $this->db->query("SELECT * FROM order_detil JOIN service ON order_detil.id_service=service.id_service WHERE order_detil.no_order='$id' ORDER BY id_od")->result();
    $data['jumlah'] = $this->db->query("SELECT SUM(total) AS jumlah FROM order_detil WHERE no_order='$id' AND status_detil='2'")->row()->jumlah;
    $data['msg'] = $this->session->flashdata('msg');
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_preview_invoice',$data);
    $this->load->view('staff/v_footer');
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
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_profile', $data);
    $this->load->view('staff/v_footer');
  }

  public function ubah_profile($id_user)
  {
    $data['title'] = 'Eno Journal - Edit Profile';
    $data['url'] = 'Edit Profile';
    $data['judul'] = 'Form Edit Data Profile' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['edtprofile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.id_user='$id_user'")->result();
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_profile_ubah', $data);
    $this->load->view('staff/v_footer');
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
          redirect(base_url().'staff/profile');
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
          $this->load->view('staff/v_header', $data);
          $this->load->view('staff/v_profile_ubah', $data);
          $this->load->view('staff/v_footer');
        }
      }else{
        redirect(base_url().'staff/profile');
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
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_profile_ubah', $data);
      $this->load->view('staff/v_footer');
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
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_password_ubah', $data);
    $this->load->view('staff/v_footer');
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
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_password_ubah', $data);
      $this->load->view('staff/v_footer');
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
          window.location='<?=base_url('staff/password')?>';
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
            window.location='<?=base_url('staff/password')?>';
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
          redirect(base_url().'staff/password');
        }
      }
    }
  }

  /////////////////////////////////////// purchase order //////////////////////////////////////
  public function po()
  {
    $data['title'] = 'Eno Journal - Purchase Order';
    $data['card'] = 'Data Purchase Order';
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['po'] = $this->db->query("SELECT * FROM purchase_order JOIN user ON purchase_order.id_user=user.id_user JOIN vendor ON purchase_order.id_vendor=vendor.id_vendor ORDER BY purchase_order.date_po")->result();
    $data['msg'] = $this->session->flashdata('msg');
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_po',$data);
    $this->load->view('staff/v_footer');
  }

  public function tambah_po()
  {
    $data['title'] = 'Eno Journal - Tambah Purchase Order';
    $data['url'] = 'Tambah Purchase Order';
    $data['judul'] = 'Form Tambah Data Purchase order' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['vendor'] = $this->m_data->get_data('vendor')->result();
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_po_tambah', $data);
    $this->load->view('staff/v_footer');
  }

  function get_vendor(){
    $id_vendor=$this->input->post('id_vendor');
    $data=$this->m_data->get_data_vendor_bykode($id_vendor);
    echo json_encode($data);
  }


  public function po_aksi()
  {
    // Validasi Wajib isi form order
    $this->form_validation->set_rules('id_vendor', 'Vendor Name', 'required|trim');
    $this->form_validation->set_rules('product_name', 'Product Name', 'required|trim');
    $this->form_validation->set_rules('price', 'Price', 'numeric|max_length[13]|required|trim');
    $this->form_validation->set_rules('qty', 'Quantity', 'numeric|max_length[13]|required|trim');
    $this->form_validation->set_rules('sub_total', 'Amount', 'numeric|max_length[13]|required|trim');
    if($this->form_validation->run() != false){
      $data = array(
        'id_vendor' => htmlspecialchars($this->input->post('id_vendor', true)),
        'product_name' => htmlspecialchars($this->input->post('product_name', true)),
        'price' => htmlspecialchars($this->input->post('price', true)),
        'qty' => htmlspecialchars($this->input->post('qty', true)),
        'sub_total' => htmlspecialchars($this->input->post('sub_total', true)),
        'status_dpo' => "1"
      );
      $this->m_data->insert_data($data,'detil_po');
      $this->session->set_flashdata('msg', ' Disimpan');
      redirect(base_url().'staff/tambah_po');
    }else{
      $data['title'] = 'Eno Journal - Tambah Purchase Order';
      $data['url'] = 'Tambah Purchase Order';
      $data['judul'] = 'Form Tambah Data Purchase order' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['vendor'] = $this->m_data->get_data('vendor')->result();
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_po_tambah', $data);
      $this->load->view('staff/v_footer');
    }
  }

  public function po_list(){
    $where = $this->input->post('id_vendor');
    $data['title'] = 'Eno Journal - List Order PO';
    $data['url'] = 'List order PO';
    $data['judul'] = 'List Order PO' ;
    $email = $this->session->userdata('email');
    $data['vendor'] = $this->db->query("SELECT * FROM vendor WHERE id_vendor='$where'")->row();
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['list_orderpo'] = $this->db->query("SELECT * FROM detil_po JOIN vendor ON detil_po.id_vendor=vendor.id_vendor WHERE detil_po.id_vendor='$where' AND detil_po.status_dpo='1'")->result();
    $data['jumlah'] = $this->db->query("SELECT SUM(sub_total) AS jumlah FROM detil_po WHERE id_vendor='$where' AND status_dpo='1'")->row()->jumlah;
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_po_list', $data);
    $this->load->view('staff/v_footer');
  }

  public function po_proses(){
    $no_po = $this->m_data->code_po();
    $id_vendor = $this->input->post('id_vendor');
    $id_user = $this->session->userdata('id_user');
    $date_po = date('Y-m-d');
    $total_po = $this->input->post('total_po');
    $data = array(
      'no_po' => $no_po,
      'id_vendor' => $id_vendor,
      'id_user' => $id_user,
      'total_po' => $total_po,
      'date_po' => $date_po,
      'status_po' => "1"
    );
    $this->m_data->insert_data($data,'purchase_order');
    $where = array(
      'id_vendor' => $id_vendor,
      'status_dpo' => "1"
    );
    $data2 = array(
      'no_po' => $no_po,
      'status_dpo' => "2"
    );
    $this->m_data->update_data($where, $data2,'detil_po');
    $this->session->set_flashdata('msg', ' Disimpan');
    redirect(base_url().'staff/po');
  }

  // Fungsi hapus
  public function hapus_listpo($id_dpo)
  {
    $where = array(
      'id_dpo' => $id_dpo
    );
    $this->m_data->delete_data($where,'detil_po');
    $this->session->set_flashdata('msg', ' Dihapus');
    redirect(base_url().'staff/tambah_po');
  }

  // public function po_ubah($id_order){
  //   $where = array(
  //     'id_order' => $id_order
  //   );
  //   $data['title'] = 'Eno Journal - Edit order';
  //   $data['url'] = 'Edit order';
  //   $data['judul'] = 'Form Edit Data order' ;
  //   $email = $this->session->userdata('email');
  //   $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
  //   $data['order'] = $this->m_data->edit_data($where,'order')->result();
  //   $this->load->view('staff/v_header', $data);
  //   $this->load->view('staff/v_order_ubah', $data);
  //   $this->load->view('staff/v_footer');
  // }
  //
  // // Fungsi update halaman
  // public function po_update()
  // {
  //   // Wajib isi judul,konten
  //   // Validasi Wajib isi form order
  //   $this->form_validation->set_rules('id_customer', 'Customer Name', 'max_length[11]|required|trim');
  //   $this->form_validation->set_rules('date_order', 'Tanggal Order', 'required|trim');
  //   $this->form_validation->set_rules('order_telp', 'order Telp/HP', 'numeric|max_length[13]|required|trim');
  //
  //   if($this->form_validation->run() != false){
  //     $id_order = $this->input->post('id_order');
  //     $where = array(
  //       'id_order' => $id_order
  //     );
  //     $data = array(
  //       'order_name' => htmlspecialchars($this->input->post('order_name', true)),
  //       'order_address' => htmlspecialchars($this->input->post('order_address', true)),
  //       'order_telp' => htmlspecialchars($this->input->post('order_telp', true)),
  //       'order_email' => htmlspecialchars($this->input->post('order_email', true)),
  //       'order_npwp' => htmlspecialchars($this->input->post('order_npwp', true))
  //     );
  //     $this->m_data->update_data($where,$data,'order');
  //     $this->session->set_flashdata('msg', ' Diubah');
  //     redirect(base_url().'staff/order');
  //   }else{
  //     $id_order = $this->input->post('id_order');
  //     $where = array(
  //       'id_order' => $id_order
  //     );
  //     $data['title'] = 'Eno Journal - Edit order';
  //     $data['url'] = 'Edit order';
  //     $data['judul'] = 'Form Edit Data order' ;
  //     $email = $this->session->userdata('email');
  //     $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
  //     $data['order'] = $this->m_data->edit_data($where,'order')->result();
  //     $this->load->view('staff/v_header', $data);
  //     $this->load->view('staff/v_order_ubah', $data);
  //     $this->load->view('staff/v_footer');
  //   }
  // }

  // Fungsi hapus
  public function hapus_po($no_po)
  {
    $data = array(
      'status_dpo' => "1"
    );
    $where=$no_po;
    $tables = array('purchase_order');
    $this->db->where('no_po', $where);
    $this->db->delete($tables);
    $this->db->update('detil_po', $data);
    $this->session->set_flashdata('msg', ' Dihapus');
    redirect(base_url().'staff/po');
  }

  public function preview_po($no_po)
  {
    $id=$no_po;
    $data['title'] = 'Eno Journal - Purcahse Order';
    $data['card'] = 'Purcahse Order';
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $data['pesanan'] = $this->db->query("SELECT * FROM purchase_order WHERE no_po='$id'")->row();
    $data['user'] = $this->db->query("SELECT * FROM purchase_order JOIN user ON purchase_order.id_user=user.id_user WHERE purchase_order.no_po='$id'")->row();
    $data['vendor'] = $this->db->query("SELECT * FROM purchase_order JOIN vendor ON purchase_order.id_vendor=vendor.id_vendor WHERE purchase_order.no_po='$id'")->row();
    $data['item'] = $this->db->query("SELECT * FROM detil_po WHERE detil_po.no_po='$id' ORDER BY id_dpo")->result();
    $data['jumlah'] = $this->db->query("SELECT SUM(sub_total) AS jumlah FROM detil_po WHERE no_po='$id' AND status_dpo='2'")->row()->jumlah;
    $data['msg'] = $this->session->flashdata('msg');
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_preview_po',$data);
    $this->load->view('staff/v_footer');
  }


  /////////////////////////////////////// report //////////////////////////////////////
  public function report()
  {
    $data['title'] = 'Eno Journal - Edit Reports';
    $data['url'] = 'Reports';
    $data['judul'] = 'All Reports' ;
    $email = $this->session->userdata('email');
    $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
    $this->load->view('staff/v_header', $data);
    $this->load->view('staff/v_report', $data);
    $this->load->view('staff/v_footer');
  }

  public function reportCashIn()
  {
      $data['title'] = 'Eno Journal - Report Cash In';
      $data['url'] = 'Reports';
      $data['judul'] = 'Reports Cash In' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_report_cashin', $data);
      $this->load->view('staff/v_footer');
  }

  public function reportCIView()
  {
      $date1 = $this->input->post('date1');
      $date2 = $this->input->post('date2');
      $data['date1'] = $this->input->post('date1');
      $data['date2'] = $this->input->post('date2');
      $data['title'] = 'Eno Journal - Cash In Reports';
      $data['url'] = 'Reports';
      $data['judul'] = 'Cash In Reports' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['report'] = $this->db->query("SELECT * FROM cashin JOIN user ON cashin.id_user=user.id_user WHERE cashin.post_date BETWEEN '$date1' AND '$date2' ORDER BY cashin.post_date ASC")->result();
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_report_ciview', $data);
      $this->load->view('staff/v_footer');
  }

  public function reportCashOut()
  {
      $data['title'] = 'Eno Journal - Report Cash Out';
      $data['url'] = 'Reports';
      $data['judul'] = 'Report Cash Out' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_report_cashout', $data);
      $this->load->view('staff/v_footer');
  }

  public function reportCOView()
  {
      $date1 = $this->input->post('date1');
      $date2 = $this->input->post('date2');
      $data['date1'] = $this->input->post('date1');
      $data['date2'] = $this->input->post('date2');
      $data['title'] = 'Eno Journal - Cash Out Reports';
      $data['url'] = 'Reports';
      $data['judul'] = 'Cash Out Reports' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['report'] = $this->db->query("SELECT * FROM cashout JOIN user ON cashout.id_user=user.id_user
                                                                JOIN detil_cashout ON cashout.no_cashout=detil_cashout.no_cashout
                                                                LEFT JOIN account ON detil_cashout.id_account=account.id_account
                                                                WHERE detil_cashout.dc='D' AND cashout.post_date BETWEEN '$date1' AND '$date2' ORDER BY cashout.post_date ASC")->result();
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_report_coview', $data);
      $this->load->view('staff/v_footer');
  }

  public function reportLR()
  {
      $data['title'] = 'Eno Journal - Income Statement';
      $data['url'] = 'Reports';
      $data['judul'] = 'Income Statement' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_report_lr', $data);
      $this->load->view('staff/v_footer');
  }

  public function reportLRView()
  {
      $date1 = $this->input->post('date1');
      $date2 = $this->input->post('date2');
      $data['date1'] = $this->input->post('date1');
      $data['date2'] = $this->input->post('date2');
      $data['title'] = 'Eno Journal - Cash Out Reports';
      $data['url'] = 'Reports';
      $data['judul'] = 'Cash Out Reports' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $p = $this->db->query("SELECT SUM(total) AS jumlahin FROM detil_cashin JOIN cashin ON detil_cashin.no_cashin=cashin.no_cashin
                                                                            WHERE detil_cashin.dc='C' AND cashin.post_date BETWEEN '$date1' AND '$date2' ORDER BY cashin.post_date ASC")->row()->jumlahin;
      $l = $this->db->query("SELECT SUM(total) AS jumlahout FROM detil_cashout JOIN cashout ON detil_cashout.no_cashout=cashout.no_cashout
                                                                            WHERE detil_cashout.dc='D' AND cashout.post_date BETWEEN '$date1' AND '$date2' ORDER BY cashout.post_date ASC")->row()->jumlahout;
      $data['pl'] = $p - $l;
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_report_lrview', $data);
      $this->load->view('staff/v_footer');
  }

  public function reportCF()
  {
      $data['title'] = 'Eno Journal - Cash FLow ';
      $data['url'] = 'Reports';
      $data['judul'] = 'Cash FLow' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_report_lr', $data);
      $this->load->view('staff/v_footer');
  }

  public function reportCFView()
  {
      $date1 = $this->input->post('date1');
      $date2 = $this->input->post('date2');
      $data['date1'] = $this->input->post('date1');
      $data['date2'] = $this->input->post('date2');
      $data['title'] = 'Eno Journal - Cash Out Reports';
      $data['url'] = 'Reports';
      $data['judul'] = 'Cash Out Reports' ;
      $email = $this->session->userdata('email');
      $data['profile'] = $this->db->query("SELECT * FROM user JOIN role ON user.id_role=role.id_role WHERE user.email='$email'")->row();
      $data['reportin'] = $this->db->query("SELECT * FROM detil_cashin JOIN account ON detil_cashin.id_account=account.id_account
                                                                       JOIN cashin ON detil_cashin.no_cashin=cashin.no_cashin
                                                                       WHERE detil_cashin.dc='C' AND cashin.post_date BETWEEN '$date1' AND '$date2' ORDER BY cashin.post_date ASC")->result();
      $data['reportout'] = $this->db->query("SELECT * FROM detil_cashout JOIN account ON detil_cashout.id_account=account.id_account
                                                                         JOIN cashout ON detil_cashout.no_cashout=cashout.no_cashout
                                                                         WHERE detil_cashout.dc='D' AND cashout.post_date BETWEEN '$date1' AND '$date2' ORDER BY cashout.post_date ASC")->result();
      $data['jumlahin'] = $this->db->query("SELECT SUM(total) AS jumlahin FROM detil_cashin JOIN cashin ON detil_cashin.no_cashin=cashin.no_cashin
                                                                            WHERE detil_cashin.dc='C' AND cashin.post_date BETWEEN '$date1' AND '$date2' ORDER BY cashin.post_date ASC")->row()->jumlahin;
      $data['jumlahout'] = $this->db->query("SELECT SUM(total) AS jumlahout FROM detil_cashout JOIN cashout ON detil_cashout.no_cashout=cashout.no_cashout
                                                                            WHERE detil_cashout.dc='D' AND cashout.post_date BETWEEN '$date1' AND '$date2' ORDER BY cashout.post_date ASC")->row()->jumlahout;
      $p = $this->db->query("SELECT SUM(total) AS jumlahin FROM detil_cashin JOIN cashin ON detil_cashin.no_cashin=cashin.no_cashin
                                                                            WHERE detil_cashin.dc='C' AND cashin.post_date BETWEEN '$date1' AND '$date2' ORDER BY cashin.post_date ASC")->row()->jumlahin;
      $l = $this->db->query("SELECT SUM(total) AS jumlahout FROM detil_cashout JOIN cashout ON detil_cashout.no_cashout=cashout.no_cashout
                                                                            WHERE detil_cashout.dc='D' AND cashout.post_date BETWEEN '$date1' AND '$date2' ORDER BY cashout.post_date ASC")->row()->jumlahout;
      $data['pl'] = $p - $l;
      $this->load->view('staff/v_header', $data);
      $this->load->view('staff/v_report_lrview', $data);
      $this->load->view('staff/v_footer');
  }

}
