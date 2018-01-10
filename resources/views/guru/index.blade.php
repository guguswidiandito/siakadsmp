@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="panel-title">
                        Daftar Guru
                    </div>
                </div>
                <div class="panel-body">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                                <a href="{{ route('guru.create') }}" class="btn btn-danger">Tambah Data</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>NBM</th>
                                        <th>Nama</th>
                                        <th>Agama</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guru as $g)
                                    <tr>
                                        <td>{{ $g['guru']['nbm'] }}</td>
                                        <td>{{ $g['guru']['nama'] }}</td>
                                        <td>{{ $g['guru']['agama'] }}</td>
                                        <td>{{ $g['guru']['no_hp'] }}</td>
                                        <td>{{ $g['guru']['alamat'] }}</td>
                                        <td class="text-center">
                                            {!! Form::model($g, ['route' => ['guru.destroy', $g['id']], 'method' => 'DELETE']) !!}
                                            <a href="{{ route('guru.edit', $g['guru']['nbm']) }}" class="btn btn-xs btn-primary">Edit</a>
                                            <button class="btn btn-xs btn-danger">Hapus</button>
                                            {!! Form::close() !!}
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
</div>
</div>
@endsection