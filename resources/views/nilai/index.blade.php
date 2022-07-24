@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts/_flash')
                <div class="card">
                    <div class="card-header">
                        Data Nilai
                        <a href="{{ route('nilai.create') }}" class="btn btn-sm btn-primary" style="float: right">
                            <i class="fas fa-plus-circle"></i>&nbsp;Tambah Data
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover text-center" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Kode Mata Pelajaran</th>
                                        <th>Nilai</th>
                                        <th>Grade</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilai as $index => $data)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $data->nis }}</td>
                                            <td>{{ $data->kode_mp }}</td>
                                            <td>{{ $data->nilai }}</td>
                                            <td>{{ $data->index_nilai }}</td>
                                            <td>
                                                <form action="{{ route('nilai.destroy', $data->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('nilai.edit', $data->id) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        <i class="fas fa-edit"></i>&nbsp;Edit
                                                    </a> |
                                                    <a href="{{ route('nilai.show', $data->id) }}"
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
