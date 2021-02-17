<?php
class M_data extends CI_Model{
  function cek_login($table,$where){
    return $this->db->get_where($table,$where);
  }
  // fungsi untuk mengupdate atau mengubah data di database
  function update_data($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
  }
  // fungsi untuk mengambil data dari database
  function get_data($table){
    return $this->db->get($table);
  }
  // fungsi untuk menginput data ke database
  function insert_data($data,$table){
    $this->db->insert($table,$data);
  }
  // fungsi untuk mengedit data
  function edit_data($where,$table){
    return $this->db->get_where($table,$where);
  }
  // fungsi untuk menghapus data dari database
  function delete_data($where,$table){
    $this->db->delete($table,$where);
  }


  function get_data_customer_bykode($id_customer){
    $hsl=$this->db->query("SELECT * FROM customer WHERE id_customer='$id_customer'");
    if($hsl->num_rows()>0){
      foreach ($hsl->result() as $data) {
        $hasil=array(
          'id_customer' => $data->id_customer,
          'customer_email' => $data->customer_email,
          'customer_telp' => $data->customer_telp,
          'customer_npwp' => $data->customer_npwp,
          'customer_address' => $data->customer_address,
        );
      }
    }
    return $hasil;
  }

  function get_data_service_bykode($id_service){
    $hsl=$this->db->query("SELECT * FROM service WHERE id_service='$id_service'");
    if($hsl->num_rows()>0){
      foreach ($hsl->result() as $data) {
        $hasil=array(
          'id_service' => $data->id_service,
          'price' => $data->price,
        );
      }
    }
    return $hasil;
  }

  function get_data_noorder_bykode($no_order){
    $hsl=$this->db->query("SELECT * FROM order_service JOIN customer ON order_service.id_customer=customer.id_customer WHERE no_order='$no_order' AND status_order='1'");
    if($hsl->num_rows()>0){
      foreach ($hsl->result() as $data) {
        $hasil=array(
          'customer_name' => $data->customer_name,
          'total_service' => $data->total_service,
        );
      }
    }
    return $hasil;
  }

  function get_data_vendor_bykode($id_vendor){
    $hsl=$this->db->query("SELECT * FROM vendor WHERE id_vendor='$id_vendor'");
    if($hsl->num_rows()>0){
      foreach ($hsl->result() as $data) {
        $hasil=array(
          'id_vendor' => $data->id_vendor,
          'vendor_email' => $data->vendor_email,
          'vendor_telp' => $data->vendor_telp,
          'vendor_npwp' => $data->vendor_npwp,
          'vendor_address' => $data->vendor_address,
        );
      }
    }
    return $hasil;
  }

  function code_cashin()
  {
    $this->db->select('RIGHT(cashin.no_cashin,4) as kode', FALSE);
    $this->db->order_by('no_cashin','DESC');
    $this->db->limit(1);
    $query = $this->db->get('cashin');      //cek dulu apakah ada sudah ada kode di tabel.
    if($query->num_rows() <> 0){
      //jika kode ternyata sudah ada.
      $data = $query->row();
      $kode = intval($data->kode) + 1;
    }else{
      //jika kode belum ada
      $kode = 1;
    }
    $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
    $date = date('dmY');
    $codein = 1;
    // $sub_tahun = substr($tahun,2);
    $kodejadi = $codein.$date.$kodemax;
    return $kodejadi;
  }

  function code_cashout()
  {
    $this->db->select('RIGHT(cashout.no_cashout,4) as kode', FALSE);
    $this->db->order_by('no_cashout','DESC');
    $this->db->limit(1);
    $query = $this->db->get('cashout');      //cek dulu apakah ada sudah ada kode di tabel.
    if($query->num_rows() <> 0){
      //jika kode ternyata sudah ada.
      $data = $query->row();
      $kode = intval($data->kode) + 1;
    }else{
      //jika kode belum ada
      $kode = 1;
    }
    $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
    $date = date('dmY');
    $codeout = 2;
    // $sub_tahun = substr($tahun,2);
    $kodejadi = $codeout.$date.$kodemax;
    return $kodejadi;
  }

  function code_order()
  {
    $this->db->select('RIGHT(order_service.no_order,4) as kode', FALSE);
    $this->db->order_by('no_order','DESC');
    $this->db->limit(1);
    $query = $this->db->get('order_service');      //cek dulu apakah ada sudah ada kode di tabel.
    if($query->num_rows() <> 0){
      //jika kode ternyata sudah ada.
      $data = $query->row();
      $kode = intval($data->kode) + 1;
    }else{
      //jika kode belum ada
      $kode = 1;
    }
    $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
    $date = date('dmY');
    $codeorder = 3;
    // $sub_tahun = substr($tahun,2);
    $kodejadi = $codeorder.$date.$kodemax;
    return $kodejadi;
  }

  function code_note()
  {
    $this->db->select('RIGHT(order_note.no_note,4) as kode', FALSE);
    $this->db->order_by('no_note','DESC');
    $this->db->limit(1);
    $query = $this->db->get('order_note');      //cek dulu apakah ada sudah ada kode di tabel.
    if($query->num_rows() <> 0){
      //jika kode ternyata sudah ada.
      $data = $query->row();
      $kode = intval($data->kode) + 1;
    }else{
      //jika kode belum ada
      $kode = 1;
    }
    $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
    $date = date('dmY');
    $codenote = 4;
    // $sub_tahun = substr($tahun,2);
    $kodejadi = $codenote.$date.$kodemax;
    return $kodejadi;
  }

  function code_invoice()
  {
    $this->db->select('RIGHT(invoice.no_invoice,4) as kode', FALSE);
    $this->db->order_by('no_invoice','DESC');
    $this->db->limit(1);
    $query = $this->db->get('invoice');      //cek dulu apakah ada sudah ada kode di tabel.
    if($query->num_rows() <> 0){
      //jika kode ternyata sudah ada.
      $data = $query->row();
      $kode = intval($data->kode) + 1;
    }else{
      //jika kode belum ada
      $kode = 1;
    }
    $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
    $date = date('dmY');
    $codeinvoice = 5;
    // $sub_tahun = substr($tahun,2);
    $kodejadi = $codeinvoice.$date.$kodemax;
    return $kodejadi;
  }

  function code_po()
  {
    $this->db->select('RIGHT(purchase_order.no_po,4) as kode', FALSE);
    $this->db->order_by('no_po','DESC');
    $this->db->limit(1);
    $query = $this->db->get('purchase_order');      //cek dulu apakah ada sudah ada kode di tabel.
    if($query->num_rows() <> 0){
      //jika kode ternyata sudah ada.
      $data = $query->row();
      $kode = intval($data->kode) + 1;
    }else{
      //jika kode belum ada
      $kode = 1;
    }
    $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
    $date = date('dmY');
    $codepo = 6;
    // $sub_tahun = substr($tahun,2);
    $kodejadi = $codepo.$date.$kodemax;
    return $kodejadi;
  }

}
?>
