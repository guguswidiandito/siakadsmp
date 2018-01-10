@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="panel-title">
                        Kehadiran
                    </div>
                </div>
                <div class="panel-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                {!! Form::open(array('route' => 'absenSiswaPerKelas', 'method' => 'GET')) !!}
                                <div class="form-group {{ $errors->has('tgl_absen') ? "has-error" : "" }}">
                                    {!! Form::label('tgl_absen', 'Tanggal Absen', ['class' => 'control-label']) !!}
                                    {!! Form::date('tgl_absen', date('Y-m-d'), ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('tgl_absen') !!}</p>
                                </div>
                                <div class="form-group {{ $errors->has('jam_ke') ? "has-error" : "" }}">
                                    {!! Form::label('jam_ke', 'Jam Ke', ['class' => 'control-label']) !!}
                                    {!! Form::selectRange('jam_ke', 1, 8, null, ['class' => 'form-control', 'placeholder' => 'Pilih']) !!}
                                    <p class="help-block">{!! $errors->first('jam_ke') !!}</p>
                                </div>
                                <div class="form-group {{ $errors->has('kelas') ? "has-error" : "" }}">
                                    {!! Form::label('kelas', 'Kelas', ['class' => 'control-label']) !!}
                                    {!! Form::select('kelas', $nama_kelas, null, ['class' => 'form-control', 'placeholder' => 'Pilih']) !!}
                                    <p class="help-block">{!! $errors->first('kelas') !!}</p>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-danger">Lihat Data</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection