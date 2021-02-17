<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('m_data');
  }

  public function index()
  {
    if($this->session->userdata('status') == "telah_login" && $this->session->userdata('id_role') == "1"){
      redirect(base_url().'admin');
    }elseif ($this->session->userdata('status') == "telah_login" && $this->session->userdata('id_role') == "2") {
      redirect(base_url().'supervisor');
    }elseif ($this->session->userdata('status') == "telah_login" && $this->session->userdata('id_role') == "3") {
      redirect(base_url().'staff');
    }else {
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
      $this->form_validation->set_rules('password', 'Password', 'required|trim');
      if ($this->form_validation->run() == false) {
        $data['title'] = 'Eno Journal - Login';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/v_login');
        $this->load->view('templates/auth_footer');
      } else {
        // valid
        $this->_login();
      }

    }
  }

  private function _login()
  {
    $email = $this->input->post('email');
    $password = $this->input->post('password');

    $user = $this->db->get_where('user', ['email' => $email])->row_array();
    ?>
    <script src="<?php echo base_url(); ?>assets/assets/js/sweetalert2/dist/sweetalert2.all.min.js" type="text/javascript"></script>
    <body></body>
    <?php
    // usernya ada
    if($user) {
      // jika usernya aktif
      if($user['is_active'] == 1) {
        // cek PASSWORD
        if(password_verify($password, $user['password'])){
          $data = [
            'id_user' => $user['id_user'],
            'email' => $user['email'],
            'id_role' => $user['id_role'],
            'fullname' => $user['fullname'],
            'status' => 'telah_login',
            'foto' => $user['foto']
          ];
          $this->session->set_userdata($data);
          if ($user['id_role'] == 1) {
            ?>
            <script>
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Login Success'
            }).then((result) => {
              window.location='<?=base_url('admin')?>';
            })
            </script>
            <?php
          } elseif ($user['id_role'] == 2) {
            ?>
            <script>
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Login Success'
            }).then((result) => {
              window.location='<?=base_url('supervisor')?>';
            })
            </script>
            <?php
          } else {
            ?>
            <script>
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Login Success'
            }).then((result) => {
              window.location='<?=base_url('staff')?>';
            })
            </script>
            <?php
          }

        } else {
          ?>
          <script>
          Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: 'Invalid Login, Wrong password'
          }).then((result) => {
            window.location='<?=base_url('auth')?>';
          })
          </script>
          <?php
        }
      } else {
        ?>
        <script>
        Swal.fire({
          icon: 'error',
          title: 'Failed',
          text: 'Invalid Login, This email has not been activated!'
        }).then((result) => {
          window.location='<?=base_url('auth')?>';
        })
        </script>
        <?php
      }
    } else {
      ?>
      <script>
      Swal.fire({
        icon: 'error',
        title: 'Failed',
        text: 'Invalid Login, Email is not registered!'
      }).then((result) => {
        window.location='<?=base_url('auth')?>';
      })
      </script>
      <?php
    }
  }

  public function registration()
  {
    $this->form_validation->set_rules('fullname', 'Fullname', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',[
      'is_unique' => 'This email has already registered!'
    ]);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
      'matches' => 'Password dont match!',
      'min_length' => 'Password too short!'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Registration';
      $data['title'] = 'Eno Journal - Registration';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/v_registration');
      $this->load->view('templates/auth_footer');
    } else {
      $email = $this->input->post('email', true);
      $data = [
        'fullname' => htmlspecialchars($this->input->post('fullname', true)),
        'email' => htmlspecialchars($email),
        'foto' => 'default.jpg',
        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'id_role' => 3,
        'is_active' => 0,
        'date_created' => time()
      ];

      // Siapkan token

      $token = base64_encode(random_bytes(32));
      $user_token = [
        'email' => $email,
        'token' => $token,
        'date_created' => time()
      ];


      $this->m_data->insert_data($data, 'user');
      $this->m_data->insert_data($user_token, 'user_token');

      $this->_sendEmail($token, 'verify');


      $this->session->set_flashdata('msg', 'Congratulation! your account has been created. Please check your email to activate!');
      redirect('auth');
    }
  }

  private function _sendEmail($token, $type)
  {
    $config = [
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'sadamhusein88.sh@gmail.com',
      'smtp_pass' => 'ICLOUD01aja',
      'smtp_port' => 465,
      'mailtype' => 'html',
      'charset' => 'utf-8',
      'newline' => "\r\n"
    ];

    $this->load->library('email', $config);
    $this->email->initialize($config);

    $this->email->from('sadamhusein88.sh@gmail.com', 'Sadam Husein');
    // $this->email->to($this->input->post('email'));

    if($type == 'verify') {
      $this->email->to('sadamhusein88.sh@gmail.com', 'Sadam Husein');
      $this->email->subject('Account Verification');
      $this->email->message('Click this link to verify your account '.$this->input->post('email').' before 24 hours : <a href="'.base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
    } elseif ($type == 'forgot') {
      $this->email->to($this->input->post('email'));
      $this->email->subject('Reset Password');
      $this->email->message('Click this link to reset your password or ignore it if that is not you! : <a href="'.base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');

    }

    if ($this->email->send()) {
      return true;
    } else {
      echo $this->email->print_debugger();
      die;
    }
  }

  public function verify()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    ?>
    <script src="<?php echo base_url(); ?>assets/assets/js/sweetalert2/dist/sweetalert2.all.min.js" type="text/javascript"></script>
    <body></body>
    <?php

    if ($user){
      $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

      if($user_token) {
        if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
          $this->db->set('is_active', 1);
          $this->db->where('email', $email);
          $this->db->update('user');

          $this->db->delete('user_token', ['email' => $email]);

          ?>
          <script>
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '<?= $email ?> has been activated! Please login.'
          }).then((result) => {
            window.location='<?=base_url('auth')?>';
          })
          </script>
          <?php
        } else {

          $this->db->delete('user', ['email' => $email]);
          $this->db->delete('user_token', ['email' => $email]);
          ?>
          <script>
          Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: 'Account activation failed! Token expired.'
          }).then((result) => {
            window.location='<?=base_url('auth')?>';
          })
          </script>
          <?php
        }
      } else {
        ?>
        <script>
        Swal.fire({
          icon: 'error',
          title: 'Failed',
          text: 'Account activation failed! Wrong token.'
        }).then((result) => {
          window.location='<?=base_url('auth')?>';
        })
        </script>
        <?php
      }
    } else {
      ?>
      <script>
      Swal.fire({
        icon: 'error',
        title: 'Failed',
        text: 'Account activation failed! Wrong email.'
      }).then((result) => {
        window.location='<?=base_url('auth')?>';
      })
      </script>
      <?php
    }

  }

  public function forgotpassword()
  {
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Recovery Password';
      $data['title'] = 'Eno Journal - Recovery';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/v_forgotpassword');
      $this->load->view('templates/auth_footer');
    } else {
      $email = $this->input->post('email');
      $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

      ?>
      <script src="<?php echo base_url(); ?>assets/assets/js/sweetalert2/dist/sweetalert2.all.min.js" type="text/javascript"></script>
      <body></body>
      <?php

      if ($user) {
        $token = base64_encode(random_bytes(32));
        $user_token = [
          'email' => $email,
          'token' => $token,
          'date_created' => time()
        ];

        $this->db->insert('user_token', $user_token);
        $this->_sendEmail($token, 'forgot');
        ?>
        <script>
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Please check your email to reset your password!'
        }).then((result) => {
          window.location='<?=base_url('auth/forgotpassword')?>';
        })
        </script>
        <?php
      } else {
        ?>
        <script>
        Swal.fire({
          icon: 'error',
          title: 'Failed',
          text: 'Email is not registered or activated!'
        }).then((result) => {
          window.location='<?=base_url('auth/forgotpassword')?>';
        })
        </script>
        <?php
      }
    }
  }

  public function resetpassword()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    ?>
    <script src="<?php echo base_url(); ?>assets/assets/js/sweetalert2/dist/sweetalert2.all.min.js" type="text/javascript"></script>
    <body></body>
    <?php

    if ($user) {
      $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

      if($user_token) {
        $this->session->set_userdata('reset_email', $email);
        $this->changePassword();
      } else {
        ?>
        <script>
        Swal.fire({
          icon: 'error',
          title: 'Failed',
          text: 'Reset password failed! Wrong token.'
        }).then((result) => {
          window.location='<?=base_url('auth')?>';
        })
        </script>
        <?php
      }
    } else {
      ?>
      <script>
      Swal.fire({
        icon: 'error',
        title: 'Failed',
        text: 'Reset password failed! Wrong email.'
      }).then((result) => {
        window.location='<?=base_url('auth')?>';
      })
      </script>
      <?php
    }
  }

  public function changePassword()
  {
    if(!$this->session->userdata('reset_email')){
      redirect('auth');
    }
    $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Repeat password', 'trim|required|min_length[3]|matches[password1]');

    if($this->form_validation->run() == false){
      $data['judul'] = 'Change Password';
      $data['title'] = 'Eno Journal - Change Password';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/v_changepassword');
      $this->load->view('templates/auth_footer');

    } else {
      $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
      $email = $this->session->userdata('reset_email');

      $this->db->set('password', $password);
      $this->db->where('email', $email);
      $this->db->update('user');

      $this->session->unset_userdata('reset_email');

      $this->session->set_flashdata('msg', 'Congratulation! Password has been changed, Please Login.');
      redirect('auth');

    }

  }

  public function logout()
  {
    $email = $this->session->userdata('email');
    $where = array(
      'email' => $email
    );
    $data = array(
      'last_login' => time()
    );
    $this->m_data->update_data($where,$data,'user');
    $this->session->sess_destroy();
    redirect('auth?alert=logout');
  }

  public function notfound()
  {
    $this->load->view('v_notfound');
  }


}
