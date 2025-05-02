@extends('layout.main')

@section('content')
  <div class="main-content">
    <section class="section">

      <!-- Statistik -->
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card border-0 shadow-lg p-4">
              <div class="d-flex align-items-center">
                <i class="far fa-user fa-3x text-danger me-3"></i>
                <div class="flex-grow-1">
                  <h5 class="fw-bold mb-1">👥 Total User</h5>
                  <p class="text-muted small">Jumlah user yang terdaftar</p>
                  <h3 class="fw-bold">{{ $totalUser }}</h3>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card border-0 shadow-lg p-4">
              <div class="d-flex align-items-center">
                <i class="fas fa-file-alt fa-3x text-success me-3"></i>
                <div class="flex-grow-1">
                  <h5 class="fw-bold mb-1">📑 Total Laporan</h5>
                  <p class="text-muted small">Jumlah laporan yang masuk</p>
                  <h3 class="fw-bold">{{ $totalLaporan }}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Tombol Tambah Laporan -->
        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <div class="col-12 mt-4">
          <a href="{{ route('laporan.create') }}">
            <button class="btn btn-lg btn-info w-100 shadow-sm">
              <i class="fas fa-plus"></i> Tambah Laporan
            </button>
          </a>
        </div>
        @endif

        <!-- Tabel Data Pelapor -->
        <div class="row mt-5">
          <div class="col-12">
            <div class="card border-0 shadow-lg">
              <div class="card-header bg-white text-center">
                <h4 class="fw-bold">📦 Data Pelapor</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped text-center" id="table-1">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Pelapor</th>
                        <th>Kontak Pelapor</th>
                        <th>Lokasi Kejadian</th>
                        <th>Tanggal Kejadian</th>
                        <th>Kronologi</th>
                        <th>Bukti</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($laporan as $index => $lapor)
                        <tr>
                          <td>{{ $index + 1 }}</td>
                          <td>{{ $lapor->nama_pelapor ?? 'Anonim' }}</td>
                          <td>{{ $lapor->kontak_pelapor }}</td>
                          <td>{{ $lapor->lokasi_kejadian }}</td>
                          <td>{{ date('d-m-Y', strtotime($lapor->tanggal_kejadian)) }}</td>
                          <td>
                            <button type="button" class="btn btn-primary btn-sm btn-open-modal" data-modal="kronologiModal{{ $lapor->laporan_id }}">
                              Lihat
                            </button>
                          </td>
                          <td>
                            @if($lapor->bukti_kejadian)
                              <a href="{{ asset('storage/' . $lapor->bukti_kejadian) }}" target="_blank" class="btn btn-primary btn-sm">Lihat</a>
                            @else
                              <span class="text-muted">Tidak Ada</span>
                            @endif
                          </td>
                        </tr>

                        <!-- Modal Kronologi -->
                        <div class="modal" id="kronologiModal{{ $lapor->laporan_id }}" style="display: none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title fw-bold">Kronologi Kejadian</h5>
                              </div>
                              <div class="modal-body">
                                {{ $lapor->kronologi }}
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-close-modal">Tutup</button>
                              </div>
                            </div>
                          </div>
                        </div>

                      @empty
                        <tr>
                          <td colspan="7" class="text-center">Tidak ada laporan tersedia</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div> <!-- Container -->
      
    </section>
  </div>
@endsection
