<?php 
class Autentifikasi extends CI_Controller { 
    public function index() { 
        //jika statusnya sudah login, maka tidak bisa mengakses halaman login alias dikembalikan ke tampilan user 
        if($this->session->userdata('email')){ 
            redirect('user'); 
        } 
        $this->form_validation->set_rules(
            'email', 'Alamat Email', 'required|trim|valid_email', [ 
                'required' => 'Email Harus diisi!!',
                'valid_email' => 'Email Tidak Benar!!' 
                ]); 
        $this->form_validation->set_rules(
            'password', 'Password', 'required|trim', [
                'required' => 'Password Harus diisi'
                ]); 
        if ($this->form_validation->run() == false) { 
            $data['judul'] = 'Form Login'; 
            $data['user'] = ''; 
            //kata 'login' merupakan nilai dari variabel judul dalam array $data dikirimkan ke view aute_header 
            $this->load->view('admin/aute_header', $data); 
            $this->load->view('admin/login'); 
            $this->load->view('admin/aute_footer'); 
        }
        else { 
          $this->_login(); 
      } 
  } 
  
  public function logout()
  {
      $this->session->unset_userdata('email');
      $this->session->unset_userdata('role_id');
      $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Anda telah logout!!</div>');
      redirect('autentifikasi');
  }

  public function registrasi()
  {
      date_default_timezone_set('Asia/Jakarta');
      $now = date('Y-m-d H:i:s');
      if ($this->session->userdata('email')) {
          redirect('user');
      }
      $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', ['required' => 'Nama Belum diis!!']);
      $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[user.email]', ['valid_email' => 'Email Tidak Benar!!', 'required' => 'Email Belum diisi!!', 'is_unique' => 'Email Sudah Terdaftar!']);
      $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', ['matches' => 'Password Tidak Sama!!', 'min_length' => 'Password Terlalu Pendek']);
      $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');
      if ($this->form_validation->run() == false) {
          $data['judul'] = 'Registrasi Member';
          $this->load->view('admin/aute_header', $data);
          $this->load->view('admin/registrasi');
          $this->load->view('admin/aute_footer');
      } else {
          $email = $this->input->post('email', true);
          $data = ['nama' => htmlspecialchars($this->input->post('nama', true)), 'email' => htmlspecialchars($email), 'image' => 'default.jpg', 'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT), 'role_id' => 2, 'is_active' => 0, 'tanggal_input' => $now];
          $this->ModelUser->simpanData($data);
          $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Selamat!! akun member anda sudah dibuat. Silahkan Aktivasi Akun anda</div>');
          redirect('autentifikasi');
      }
  }

  private function _login() { 
      $email = htmlspecialchars($this->input->post('email', true)); 
      $password = $this->input->post('password', true); 
      $user = $this->ModelUser->cekData(['email' => $email])->row_array(); 
      
      //jika usernya ada 
      if ($user) { 
          //jika user sudah aktif 
          if ($user['is_active'] == 1) { 
              //cek password 
              if ($password==$user['password']) { 
                  $data = [ 'email' => $user['email'], 'role_id' => $user['role_id'] ]; 
                  $this->session->set_userdata($data); 
                  if ($user['role_id'] == 1) { 
                      redirect('admin');
                  } 
                  else { 
                      if ($user['image'] == 'default.jpg') {
                          $this->session->set_flashdata(
                              'pesan', '<div class="alert alert-info alert-message" role="alert">Silahkan Ubah Profile Anda untuk Ubah Photo Profil</div>'); 
                          } 
                          redirect('user'); 
                      } 
                  } 
                  else { 
                      $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>'); 
                      redirect('autentifikasi'); 
                  } 
              } 
              else { 
                  $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">User belum diaktifasi!!</div>'); 
                  redirect('autentifikasi'); 
              }
            } 
            else { 
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar!!</div>'); 
                redirect('autentifikasi'); 
            } 
        } 
    }
