@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        Tambah Kelas
                    </div>
                </div>
                <div class="panel-body">
                    {!! Form::open(array('route' => 'kelas.store', 'method' => 'POST')) !!}
                    <div class="form-group {{ $errors->has('kelas') ? "has-error" : "" }}">
                        {!! Form::label('kelas', 'Kelas', ['class' => 'control-label']) !!}
                        {!! Form::text('kelas', null, ['class' => 'form-control', 'placeholder' => 'Kelas']) !!}
                        <p class="help-block">{!! $errors->first('kelas') !!}</p>
                    </div>
                    <div class="form-group {{ $errors->has('user_id') ? "has-error" : "" }}">
                        {!! Form::label('user_id', 'Wali Kelas', ['class' => 'control-label']) !!}
                        {!! Form::select('user_id', $wali_kelas, null, ['class' => 'form-control', 'placeholder' => 'Pilih']) !!}
                        <p class="help-block">{!! $errors->first('user_id') !!}</p>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('kelas.index') }}" class="btn btn-default">Kembali</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection