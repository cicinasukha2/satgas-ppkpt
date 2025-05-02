@extends('layout.main')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Form User</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ isset($user) ? 'Edit User' : 'Tambah User' }}</h4>
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

                        <form action="{{ isset($user) ? route('users.update', $user->user_id) : route('users.store') }}" method="POST">
                            @csrf
                            @if(isset($user))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control text-capitalize" name="role_id">
                                            <option value="1" {{ (isset($user) && $user->role_id == 1) ? 'selected' : '' }}>Sekretaris Satgas</option>
                                            <option value="2" {{ (isset($user) && $user->role_id == 2) ? 'selected' : '' }}>Ketua Satgas</option>
                                            <option value="3" {{ (isset($user) && $user->role_id == 3) ? 'selected' : '' }}>Pelapor</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input name="nama" type="nama" class="form-control" value="{{ $user->nama ?? old('nama') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" type="email" class="form-control" value="{{ $user->email ?? old('email') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>NIPN/NIM</label>
                                        <input name="nipn_nim" type="text" class="form-control" value="{{ $user->nipn_nim ?? old('nipn_nim') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Kontak</label>
                                        <input name="kontak" type="text" class="form-control" value="{{ $user->kontak ?? old('kontak') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input name="password" type="password" class="form-control">
                                        @if(isset($user))
                                            <small>Kosongkan jika tidak ingin mengganti password</small>
                                        @endif
                                    </div>
                                    <div class="form-group text-right">
                                        <button class="btn btn-info mr-1" type="submit">Simpan</button>
                                        <a href="{{ route('users.index') }}" class="btn btn-danger">Kembali</a>
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
