@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="panel-title">
                        Data Siswa
                    </div>
                </div>
                <div class="panel-body">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <a href="{{ route('siswa.create') }}" class="btn btn-danger">Tambah Data</a>
                        </div>
                        <div class="panel-body">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        {!! Form::open(['url' => 'siswa/', 'method' => 'GET', 'class' => 'form-inline']) !!}
                                        {!! Form::select('kelas_id', $kelas, null, ['class' => 'form-control', 'placeholder' => 'Pilih kelas', 'required']) !!}
                                        {!! Form::selectRange('tahun_masuk', 2010, date('Y'), null, ['class' => 'form-control', 'placeholder' => 'Pilih tahun']) !!}
                                        {!! Form::text('q', isset($q) ? $q : null, ['class' => 'form-control', 'placeholder' => 'NIS / Nama']) !!}
                                        {!! Form::submit('Search / Filter', ['class' => 'btn btn-primary']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">NIS</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Wali Kelas</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($siswa) > 0)
                                        @foreach ($siswa as $s)
                                        <tr>
                                            <td class="text-center">{{ $s['nis'] }}</td>
                                            <td class="text-center">{{ $s['nama_siswa'] }}</td>
                                            <td class="text-center">{{ $s['nama_kelas'] }}</td>
                                            <td class="text-center">{{ $s['nama_guru'] }}</td>
                                            <td class="text-center">
                                                {!! Form::model($s, ['route' => ['siswa.destroy', $s['nis']], 'method' => 'DELETE']) !!}
                                                <a href="{{ route('siswa.edit', $s['nis']) }}" class="btn btn-xs btn-primary">Edit</a>
                                                <button class="btn btn-xs btn-danger">Hapus</button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">Data tidak ada</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                {!! $siswa->appends(compact('kelas_id', 'tahun_masuk', 'q'))->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection