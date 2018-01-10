@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <p>Edit:</p>
                        <p>NBM: {{ $guru['nbm'] }}</p>
                        <p>Nama: {{ $guru['nama'] }}</p>
                    </div>
                </div>
                <div class="panel-body">
                    {!! Form::model($guru, array('route' => ['guru.update', $guru['nbm']], 'method' => 'PUT')) !!}
                    <div class="form-group {{ $errors->has('nbm') ? "has-error" : "" }}">
                        {!! Form::label('nbm', 'NBM', ['class' => 'control-label']) !!}
                        {!! Form::text('nbm', null, ['class' => 'form-control', 'placeholder' => 'NBM']) !!}
                        <p class="help-block">{!! $errors->first('nbm') !!}</p>
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
                    <div class="form-group {{ $errors->has('alamat') ? "has-error" : "" }}">
                        {!! Form::label('alamat', 'Alamat', ['class' => 'control-label']) !!}
                        {!! Form::text('alamat', null, ['class' => 'form-control', 'placeholder' => 'Alamat']) !!}
                        <p class="help-block">{!! $errors->first('alamat') !!}</p>
                    </div>
                    <div class="form-group {{ $errors->has('no_hp') ? "has-error" : "" }}">
                        {!! Form::label('no_hp', 'No HP', ['class' => 'control-label']) !!}
                        {!! Form::text('no_hp', null, ['class' => 'form-control', 'placeholder' => 'No HP']) !!}
                        <p class="help-block">{!! $errors->first('no_hp') !!}</p>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('guru.index') }}" class="btn btn-default">Kembali</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection