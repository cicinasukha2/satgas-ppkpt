@extends('layout.main')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Daftar Laporan</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Laporan</h4>
                            <div class="card-header-action">
                                <!-- Hanya Role ID 1 yang bisa tambah laporan -->
                                @if(Auth::user()->role_id == 1)
                                    <a href="{{ route('laporan.create') }}" class="btn btn-lg btn-info">
                                        <i class="fas fa-plus"></i> Tambah Laporan
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>                                 
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th>Nama Pelapor</th>
                                            <th>Lokasi</th>
                                            <th>Tanggal Kejadian</th>
                                            <th>Kronologi</th>
                                            <th>Bukti</th>
                                            <th>Status</th>
                                            @if(Auth::user()->role_id == 1) <!-- Hanya role_id 1 bisa edit & hapus -->
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>                                 
                                        @forelse($laporan as $lapor)
                                            <tr>
                                                <td class="text-center">{{ $lapor->laporan_id }}</td>
                                                <td>{{ $lapor->nama_pelapor ?? 'Anonim' }}</td>
                                                <td>{{ $lapor->lokasi_kejadian }}</td>
                                                <td>{{ date('d-m-Y', strtotime($lapor->tanggal_kejadian)) }}</td>
                                                
                                                <!-- Tombol Kronologi Modal -->
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm btn-open-modal" data-modal="kronologiModal{{ $lapor->laporan_id }}">
                                                        Lihat
                                                    </button>
                                                </td>

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

                                                <!-- Tombol Bukti Kejadian -->
                                                <td>
                                                    @if($lapor->bukti_kejadian)
                                                        <a href="{{ asset('storage/' . $lapor->bukti_kejadian) }}" target="_blank" class="btn btn-primary btn-sm">Lihat</a>
                                                    @else
                                                        <span class="text-muted">Tidak Ada</span>
                                                    @endif
                                                </td>

                                                <!-- Dropdown Status -->
                                                <td>
                                                    @if(Auth::user()->role_id == 1) <!-- Hanya role_id 1 bisa mengubah status -->
                                                        <div class="dropdown">
                                                            <button class="btn btn-{{ $lapor->status == 'Di Proses' ? 'warning' : 'success' }} dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                {{ $lapor->status }}
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <form action="{{ route('laporan.updateStatus', $lapor->laporan_id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" name="status" value="Di Proses" class="dropdown-item">Di Proses</button>
                                                                    <button type="submit" name="status" value="Selesai" class="dropdown-item">Selesai</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="badge badge-secondary">{{ $lapor->status }}</span>
                                                    @endif
                                                </td>

                                                <!-- Tombol Edit & Hapus (Hanya Role ID 1) -->
                                                @if(Auth::user()->role_id == 1)
                                                    <td>
                                                        <a href="{{ route('laporan.edit', $lapor->laporan_id) }}" class="btn btn-primary btn-success btn-sm">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        <form action="{{ route('laporan.destroy', $lapor->laporan_id) }}" method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus laporan ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="{{ Auth::user()->role_id == 1 ? '8' : '7' }}" class="text-center">Tidak ada laporan tersedia</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection