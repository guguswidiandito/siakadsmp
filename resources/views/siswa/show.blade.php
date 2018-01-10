@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        Data <b>{{ $guru['nama'] }}</b>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>NBM</th>
                            <td>{{ $guru['nbm'] }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $guru['nama'] }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>{{ $guru['agama'] }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $guru['alamat'] }}</td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td>{{ $guru['no_hp'] }}</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>{{ $guru['user']['username'] }}</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ route('guru.edit', $guru['nbm']) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('guru.index') }}" class="btn btn-primary">Kembali</a>
                            </td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
