@extends('template.master')

@section('judul','tambah-mahasiswa')

@section('isi')
<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-primary" style="float: right;">
                            <h3 class="card-title">Tambah Data Mahasiswa</h3>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-warning">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="card-body">
                            <form action="{{ url('edit-mahasiswa')}}/{{ $data->id }}" method="post">
                                @method('put')
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="nims">Nim</label>
                                    <input type="text" id="nims" name="nim" value="{{ old('nim', $data->nim) }}" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nm">Nama</label>
                                    <input type="text" id="nm" name="nama_mahasiswa" value="{{ old('nama_mahasiswa', $data->nama_mahasiswa) }}"class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="smt">Semester</label>
                                    <input type="text" id="smt" name="semester" value="{{ old('semester', $data->semester) }}" class="form-control">
                                </div>
                               
                                <input type="submit" name="submit" value="Simpan Data">
                            <a class="btn btn-default" href="{{ url('data-mahasiswa') }}" role="button">Kembali</a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection