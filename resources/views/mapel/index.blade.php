@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="panel-title">
                        Data Mapel
                    </div>
                </div>
                <div class="panel-body">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <a href="{{ route('mapel.create') }}" class="btn btn-danger">Tambah Data</a>
                        </div>
                        <div class="panel-body">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        {!! Form::open(['url' => 'mapel/', 'method' => 'GET', 'class' => 'form-inline']) !!}
                                        {!! Form::select('kelas_id', $kelas, null, ['class' => 'form-control', 'placeholder' => 'Pilih', 'required']) !!}
                                        {!! Form::submit('Lihat Data', ['class' => 'btn btn-default']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Mapel</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Guru</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($mapel) > 0)
                                        @foreach ($mapel as $m)
                                        <tr>
                                            <td class="text-center">{{ $m['mapel'] }}</td>
                                            <td class="text-center">{{ $m['kelas']['kelas'] }}</td>
                                            <td class="text-center">{{ $m['user']['guru']['nama'] }}</td>
                                            <td class="text-center">
                                                {!! Form::model($m, ['route' => ['mapel.destroy', $m['id']], 'method' => 'DELETE']) !!}
                                                <a href="{{ route('mapel.edit', $m['id']) }}" class="btn btn-xs btn-primary">Edit</a>
                                                <button class="btn btn-xs btn-danger">Hapus</button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="4" class="text-center">Data tidak ada</td>
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