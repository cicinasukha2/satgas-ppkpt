@extends('layout.main')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Form Laporan</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ isset($laporan) ? 'Edit Laporan' : 'Tambah Laporan' }}</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ isset($laporan) ? route('laporan.update', $laporan->laporan_id) : route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($laporan))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nama Pelapor</label>
                                        <input name="nama_pelapor" type="text" class="form-control" value="{{ $laporan->nama_pelapor ?? old('nama_pelapor') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Kontak Pelapor</label>
                                        <input name="kontak_pelapor" type="text" class="form-control" value="{{ $laporan->kontak_pelapor ?? old('kontak_pelapor') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Lokasi Kejadian</label>
                                        <input name="lokasi_kejadian" type="text" class="form-control" value="{{ $laporan->lokasi_kejadian ?? old('lokasi_kejadian') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Kejadian</label>
                                        <input name="tanggal_kejadian" type="date" class="form-control" value="{{ isset($laporan) ? date('Y-m-d', strtotime($laporan->tanggal_kejadian)) : old('tanggal_kejadian') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Kronologi Kejadian</label>
                                        <textarea name="kronologi" class="form-control" rows="4">{{ $laporan->kronologi ?? old('kronologi') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Bukti Kejadian (Opsional)</label>
                                        <input name="bukti_kejadian" type="file" class="form-control">
                                        @if(isset($laporan) && $laporan->bukti_kejadian)
                                            <p class="mt-2"><a href="{{ asset('storage/' . $laporan->bukti_kejadian) }}" target="_blank">Lihat Bukti</a></p>
                                        @endif
                                    </div>
                                    <div class="form-group text-right">
                                        <button class="btn btn-info mr-1" type="submit">Simpan</button>
                                        <a href="{{ route('laporan.index') }}" class="btn btn-danger">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection