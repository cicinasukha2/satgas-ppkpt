<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Admin Login - Satgas PPKPT</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('modules/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-2">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{ url('img/logosatgas.png') }}" style="width: 100px;"> Satgas PPKPT
            </div>

            <!-- Menampilkan Pesan Logout -->
            @if (session('keluar'))
              <div class="alert alert-success">
                {{ session('keluar') }}
              </div>
            @endif

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <!-- Menampilkan pesan error jika login gagal -->
                @if(session('error'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>{{ session('error') }}</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group">
                    <label for="nipn_nim">NIPN/NIM</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                      </div>
                      <input type="text" class="form-control" name="nipn_nim" tabindex="1" required autofocus>
                      <div class="invalid-feedback">
                        NIPN/NIM tidak boleh kosong!
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                      </div>
                      <input type="password" class="form-control" name="password" tabindex="2" required>
                      <div class="invalid-feedback">
                        Password tidak boleh kosong!
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="3">
                      Login
                    </button>
                  </div>
                </form>
                
              </div>
            </div>

            <div class="simple-footer">
              Copyright &copy; 2025 <div class="bullet"></div> Satgas PPKPT Universitas Teknologi Digital Indonesia
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<!-- General JS Scripts -->
<script src="{{ asset('modules/jquery.min.js') }}"></script>
<script src="{{ asset('modules/popper.js') }}"></script>
<script src="{{ asset('modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('modules/moment.min.js') }}"></script>
<script src="{{ asset('js/stisla.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
