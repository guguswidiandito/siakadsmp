@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="panel-title">
                        Data Kelas
                    </div>
                </div>
                <div class="panel-body">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <a href="{{ route('kelas.create') }}" class="btn btn-danger">Tambah Data</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Wali Kelas</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($kelas) > 0)
                                        @foreach ($kelas as $k)
                                        <tr>
                                            <td class="text-center">{{ $k['nama_kelas'] }}</td>
                                            <td class="text-center">{{ $k['nama_guru'] }}</td>
                                            <td class="text-center">
                                                {!! Form::model($k, ['route' => ['kelas.destroy', $k['kelas_id']], 'method' => 'DELETE']) !!}
                                                <a href="{{ route('kelas.edit', $k['kelas_id']) }}" class="btn btn-xs btn-primary">Edit</a>
                                                <button class="btn btn-xs btn-danger">Hapus</button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3" class="text-center">Data tidak ada</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection