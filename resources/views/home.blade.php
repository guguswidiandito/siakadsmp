@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    Selamat datang <b>
                    @php
                    if (Auth::user()->hasRole('guru')) {
                        foreach (Auth::user()->guru()->get() as $value) {
                            echo $value->nama;
                        }
                    } else {
                        echo Auth::user()->username;
                    }
                    @endphp
                    </b>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection