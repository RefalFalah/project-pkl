@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts/_flash')
                <div class="card">
                    <div class="card-header">
                        Data Jurusan
                        <a href="{{ route('jurusan.create') }}" class="btn btn-sm btn-primary" style="float: right">
                            <i class="fas fa-plus-circle"></i>&nbsp;Tambah Data
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Mapel</th>
                                        <th>Nama Mapel</th>
                                        <th>Semester</th>
                                        <th>Jurusan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jurusan as $index => $data)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $data->kode_mp }}</td>
                                            <td>{{ $data->nama_mp }}</td>
                                            <td class="text-center">{{ $data->semester }}</td>
                                            <td>{{ $data->jurusan }}</td>
                                            <td>
                                                <form action="{{ route('jurusan.destroy', $data->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('jurusan.edit', $data->id) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        <i class="fas fa-edit"></i>&nbsp;Edit
                                                    </a> |
                                                    <a href="{{ route('jurusan.show', $data->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <i class="fas fa-info-circle"></i>&nbsp;Show
                                                    </a> |
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Apakah Anda Yakin?')"><i
                                                            class="fas fa-trash-alt"></i>&nbsp;Delete
                                                    </button>
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
    </div>
@endsection
