@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        Tambah Mapel
                    </div>
                </div>
                <div class="panel-body">
                    {!! Form::open(array('route' => 'mapel.store', 'method' => 'POST')) !!}
                    <div class="form-group {{ $errors->has('mapel') ? "has-error" : "" }}">
                        {!! Form::label('mapel', 'Mapel', ['class' => 'control-label']) !!}
                        {!! Form::text('mapel', null, ['class' => 'form-control', 'placeholder' => 'Mapel']) !!}
                        <p class="help-block">{!! $errors->first('mapel') !!}</p>
                    </div>
                    <div class="form-group {{ $errors->has('kelas_id') ? "has-error" : "" }}">
                        {!! Form::label('kelas_id', 'Kelas', ['class' => 'control-label']) !!}
                        {!! Form::select('kelas_id', $kelas, null, ['class' => 'form-control', 'placeholder' => 'Pilih']) !!}
                        <p class="help-block">{!! $errors->first('kelas_id') !!}</p>
                    </div>
                     <div class="form-group {{ $errors->has('user_id') ? "has-error" : "" }}">
                        {!! Form::label('user_id', 'Guru', ['class' => 'control-label']) !!}
                        {!! Form::select('user_id', $guru, null, ['class' => 'form-control', 'placeholder' => 'Pilih']) !!}
                        <p class="help-block">{!! $errors->first('user_id') !!}</p>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('mapel.index') }}" class="btn btn-default">Kembali</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection