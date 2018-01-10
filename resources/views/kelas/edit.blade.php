@extends('layouts.app')
@push('error')
@if ($errors->any())
<div class="container">
    <div class="alert alert-danger">
        <b>Error(s):</b>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <p>Edit:</p> 
                        <p>Kelas: {{ $kelas['kelas'] }}</p>
                        <p>Wali Kelas: {{ $kelas['nama'] }}</p>
                    </div>
                </div>
                <div class="panel-body">
                    {!! Form::model($kelas, array('route' => ['kelas.update', $kelas['id']], 'method' => 'PUT')) !!}
                    <table class="table">
                        <tr>
                            <th width="200">Kelas</th>
                            <td>
                                <div class="{{ $errors->has('kelas') ? "has-error" : "" }}">
                                    {!! Form::text('kelas', null, ['class' => 'form-control', 'placeholder' => 'Kelas']) !!}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>
                                <div class="{{ $errors->has('nbm') ? "has-error" : "" }}">
                                    {!! Form::select('nbm', $wali_kelas, null, ['class' => 'form-control', 'placeholder' => 'Pilih']) !!}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" class="btn btn-warning">Update</button>
                                <a href="{{ route('kelas.index') }}" class="btn btn-info">Batal</a>
                            </td>
                            <td></td>
                        </tr>
                    </table>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection