@extends('adminPage.layouts.main')
@section('content')
    @if (session('berhasil'))
        <div class="alert alert-success mb-3 col-lg-10" role="alert">
            {{ session('berhasil') }}
        </div>
    @endif
    <a href="/master/data-montir/create" class="btn btn-info mb-4"><i class=" fas fa-solid fa-plus"></i> Tambah Montir</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Montir</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($montirs as $montir)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $montir->nama }}</td>
                                <td class="text-center">{{ $montir->alamat }}</td>
                                <td class="text-center">{{ $montir->no_telp }}</td>
                                <td class="text-center">
                                    <a href="/master/data-montir/{{ $montir->id }}/edit" class="btn btn-success btn-sm"><i
                                            class="fas fa-solid fa-pen"></i></a>
                                    <form action="/master/data-montir/{{ $montir->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm btn-danger" onclick="confirm('Yakin Ingin Menghapus?')"><i
                                                class="fas fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
