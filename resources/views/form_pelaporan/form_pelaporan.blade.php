<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Form Pelaporan</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('modules/fontawesome/css/all.min.css') }}">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
      <img src="{{ asset('img/logosatgas.png') }}" alt="Logo Satgas" class="me-2" style="max-height: 50px;">
      Satgas PPKPT
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link active" href="/">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('alur_pelaporan.index') }}">Alur Pelaporan</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('laporan.view') }}">Form Pelaporan</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- HERO Section dengan Background Gradient -->
<section class="d-flex align-items-center justify-content-center text-white text-center py-3"
  style="background: linear-gradient(135deg, #0D0B8C, #009FFD); min-height: 100px;">
  <div class="container">
    <h1 class="fw-bold">Form Pelaporan</h1>
    <p class="lead">Isilah data diri dan kejadian anda kepada Tim Satgas PPKPT UTDI</p>
  </div>
</section>

<!-- MAIN CONTENT -->
<main class="container mb-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <!-- Tampilkan error jika ada -->
          @if($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <!-- Form Pelaporan -->
          <form action="{{ route('halaman.form-pelaporan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="nama_pelapor" class="form-label">Nama Pelapor</label>
                <input type="text" name="nama_pelapor" id="nama_pelapor"
                       class="form-control" placeholder="Masukkan nama (Opsional)">
              </div>
              <div class="col-md-6">
                <label for="kontak_pelapor" class="form-label">Kontak Pelapor</label>
                <input type="text" name="kontak_pelapor" id="kontak_pelapor"
                       class="form-control" placeholder="Masukkan kontak (Opsional)">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="lokasi_kejadian" class="form-label">Lokasi Kejadian</label>
                <input type="text" name="lokasi_kejadian" id="lokasi_kejadian"
                       class="form-control" placeholder="Masukkan lokasi kejadian" required>
              </div>
              <div class="col-md-6">
                <label for="tanggal_kejadian" class="form-label">Tanggal Kejadian</label>
                <input type="date" name="tanggal_kejadian" id="tanggal_kejadian"
                       class="form-control" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="kronologi" class="form-label">Kronologi</label>
              <textarea name="kronologi" id="kronologi" class="form-control"
                        rows="3" placeholder="Tuliskan kronologi kejadian" required></textarea>
            </div>
            <div class="mb-3">
              <label for="bukti_kejadian" class="form-label">Unggah Bukti (Opsional)</label>
              <input type="file" name="bukti_kejadian" id="bukti_kejadian"
                     class="form-control">
            </div>
            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary">Kirim Laporan</button>
            </div>
          </form>
          <!-- End of Form -->
        </div>
      </div>
    </div>
  </div>
</main>

<!-- FOOTER -->
<footer class="bg-white border-top py-3 text-center">
  <div class="container">
    <p class="mb-0">
      &copy; 2025 
      <span class="fw-semibold">Satgas PPKPT Universitas Teknologi Digital Indonesia</span>
    </p>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="{{ asset('modules/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Tambahkan SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      Swal.fire({
        title: "Laporan Berhasil Dikirim!",
        text: "Terima kasih telah melapor. Tim Satgas PPKPT akan segera menindaklanjuti laporan Anda.",
        icon: "success",
        confirmButtonText: "OK"
      });
    });
  </script>
@endif

</body>
</html>
