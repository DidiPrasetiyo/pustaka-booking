  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-lg-7">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Halaman Login!</h1>
                  </div>
                  <?=$this->session->flashdata('pesan');?>
      <form class="user" method="post" action="<?=base_url('autentifikasi');?>">
        <div class="form-group">
          <input value="<?=set_value('email');?>" type="text" name="email" class="form-control form-control-user" placeholder="Masukkan Alamat Email...">
          <?=form_error('email', '<small class="text-danger pl-3">', '</small>');?> 
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control form-control-user" placeholder="Masukkan Password...">
          <?=form_error('password', '<small class="text-danger pl-3">', '</small>');?>
        </div>         
        <button type="submit" class="btn btn-primary btn-user btn-block"> Masuk </button>
      </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?=base_url('autentifikasi/lupaPassword');?>">Lupa Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?=base_url('autentifikasi/registrasi');?>">Daftar Akun</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>