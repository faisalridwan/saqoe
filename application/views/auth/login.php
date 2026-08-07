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
                    <h1 class="h4 text-gray-900 mb-4">Login Page</h1>
                  </div>

                  <?= $this->session->flashdata('message'); ?>
                  <?= form_open('auth', ['class' => 'user']); ?>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Enter Username Address..." value="<?= set_value('username'); ?>">
                      <?= form_error('Username', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group position-relative">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" style="padding-right: 50px;">
                      <span id="togglePassword" style="position: absolute; right: 20px; top: 12px; cursor: pointer; padding: 5px; z-index: 10;">
                        <i class="fas fa-eye text-gray-500" id="eyeIcon"></i>
                      </span>
                      <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                  
                  <script>
                    const togglePassword = document.querySelector('#togglePassword');
                    const password = document.querySelector('#password');
                    const eyeIcon = document.querySelector('#eyeIcon');

                    togglePassword.addEventListener('click', function (e) {
                      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                      password.setAttribute('type', type);
                      eyeIcon.classList.toggle('fa-eye-slash');
                      eyeIcon.classList.toggle('fa-eye');
                    });
                  </script>
                  
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?= base_url('auth/registration'); ?>">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>