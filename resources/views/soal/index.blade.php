@extends('template.master')

@section('judul', 'Data Soal')

@section('isi')
<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header bg-info">
                            <h3 class="card-title"> Data Soal</h3>
                        </div>
                        <div class="card-body">
                            <a href="{{ url('add-soal') }}" role="button" class="btn btn-success mb-3"><i class="fas fa-add">Tambah Data</i></a>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-info">
                                    <th>No.</th>
                                    <th>Id</th>
                                    <th>Nama MK</th>
                                    <th>Dosen</th>
                                    <th>Jumlah Soal</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->nama_mk }}</td>
                                    <td>{{ $row->dosen }}</td>
                                    <td>{{ $row->jumlah_soal }}</td>
                                    <td>{{ $row->keterangan }}</td>
                                    <td> 
                                    <a class="btn btn-success btn-sm" href="{{ url('edit-soal')}}/{{ $row->id }}/edit" role="button">Update</a>
                                        <form action=" {{ route('delete.soal', $row->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('yakin ingin menghapus data?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection