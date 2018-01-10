@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <p>Edit</p>
                        <p>NIS: {{ $nilai->siswa_id }}</p>
                    </div>
                </div>
                <div class="panel-body">
                    {!! Form::model($nilai, array('route' => ['nilai.update', $nilai->id], 'method' => 'PUT')) !!}
                    <div class="form-group {{ $errors->has('harian') ? "has-error" : "" }}">
                        {!! Form::label('harian', 'Nilai Harian', ['class' => 'control-label']) !!}
                        {!! Form::text('harian', null, ['class' => 'form-control', 'placheholder' => 'Nilai Harian']) !!}
                        <p class="help-block">{!! $errors->first('harian') !!}</p>
                    </div>
                    <div class="form-group {{ $errors->has('uts') ? "has-error" : "" }}">
                        {!! Form::label('uts', 'Nilai UTS', ['class' => 'control-label']) !!}
                        {!! Form::text('uts', null, ['class' => 'form-control', 'placeholder' => 'Nilai UTS']) !!}
                        <p class="help-block">{!! $errors->first('uts') !!}</p>
                    </div>
                    <div class="form-group {{ $errors->has('uas') ? "has-error" : "" }}">
                        {!! Form::label('uas', 'Nilai UAS', ['class' => 'control-label']) !!}
                        {!! Form::text('uas', null, ['class' => 'form-control', 'placheholder' => ' Nilai UAS']) !!}
                        <p class="help-block">{!! $errors->first('uas') !!}</p>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('nilai.index') }}" class="btn btn-default">Kembali</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection