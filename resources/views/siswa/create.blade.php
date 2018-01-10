@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        Tambah Guru
                    </div>
                </div>
                <div class="panel-body">
                    {!! Form::open(array('route' => 'siswa.store', 'method' => 'POST')) !!}
                    <div class="form-group {{ $errors->has('nis') ? "has-error" : "" }}">
                        {!! Form::label('nis', 'NIS', ['class' => 'control-label']) !!}
                        {!! Form::text('nis', null, ['class' => 'form-control', 'placeholder' => 'NIS']) !!}
                        <p class="help-block">{!! $errors->first('nis') !!}</p>
                    </div>
                    <div class="form-group {{ $errors->has('nama') ? "has-error" : "" }}">
                        {!! Form::label('nama', 'Nama', ['class' => 'control-label']) !!}
                        {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama']) !!}
                        <p class="help-block">{!! $errors->first('nama') !!}</p>
                    </div>
                    <div class="form-group {{ $errors->has('agama') ? "has-error" : "" }}">
                        @php
                        $collect = collect(['Islam' => 'Islam', 'Kristen' => 'Kristen', 'Hindu' => 'Hindu', 'Buddha' => 'Buddha']);
                        $agama = $collect->toArray();
                        @endphp
                        {!! Form::label('agama', 'Agama', ['class' => 'control-label']) !!}
                        {!! Form::select('agama', $agama, null, ['class' => 'form-control', 'placeholder' => 'Agama']) !!}
                        <p class="help-block">{!! $errors->first('agama') !!}</p>
                    </div>
                    <div class="form-group {{ $errors->has('jenis_kelamin') ? "has-error" : "" }}">
                        {!! Form::label('jenis_kelamin', 'Jenis Kelamin', ['class' => 'control-label']) !!}
                        {!! Form::select('jenis_kelamin', ['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'], null, ['class' => 'form-control', 'placeholder' => 'Jenis Kelamin']) !!}
                        <p class="help-block">{!! $errors->first('jenis_kelamin') !!}</p>
                    </div>
                    <div class="form-group {{ $errors->has('tgl_lahir') ? "has-error" : "" }}">
                        {!! Form::label('tgl_lahir', 'Tanggal Lahir', ['class' => 'control-label']) !!}
                        {!! Form::date('tgl_lahir', null, ['class' => 'form-control']) !!}
                        <p class="help-block">{!! $errors->first('tgl_lahir') !!}</p>
                    </div>
                    <div class="form-group {{ $errors->has('alamat') ? "has-error" : "" }}">
                        {!! Form::label('alamat', 'Alamat', ['class' => 'control-label']) !!}
                        {!! Form::text('alamat', null, ['class' => 'form-control', 'placeholder' => 'Alamat']) !!}
                        <p class="help-block">{!! $errors->first('alamat') !!}</p>
                    </div>
                    <div class="form-group {{ $errors->has('tahun_masuk') ? "has-error" : "" }}">
                        {!! Form::label('tahun_masuk', 'Tahun Masuk', ['class' => 'control-label']) !!}
                        {!! Form::selectRange('tahun_masuk', 2010, date('Y'), null, ['class' => 'form-control', 'placeholder' => 'Pilih']) !!}
                        <p class="help-block">{!! $errors->first('tahun_masuk') !!}</p>
                    </div>
                    <div class="form-group {{ $errors->has('kelas_id') ? "has-error" : "" }}">
                        {!! Form::label('kelas_id', 'Kelas', ['class' => 'control-label']) !!}
                        {!! Form::select('kelas_id', $kelas, null, ['class' => 'form-control', 'placeholder' => 'Pilih']) !!}
                        <p class="help-block">{!! $errors->first('kelas_id') !!}</p>
                    </div>
                   
                    <div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('siswa.index') }}" class="btn btn-default">Kembali</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection