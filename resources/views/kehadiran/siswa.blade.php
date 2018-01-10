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
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="panel-title">
                        Tambah Absensi
                    </div>
                </div>
                <div class="panel-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Keterangan Absensi</h4>
                                <p>A = Tidak Masuk Tanpa Keterangan</p>
                                <p>I = Tidak Masuk Ada Surat Ijin Atau Pemberitahuan</p>
                                <p>S = Tidak Masuk Ada Surat Dokter Atau Pemberitahuan</p>
                                <p>H = Hadir</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            Absen Jam Ke : <b>{{ $jam_ke }}</b>
                            Tanggal     : <b>{{ $tgl_absen }}</b>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <fieldset>
                                    {!! Form::open(array('route' => 'kehadiran.store', 'method' => 'POST')) !!}
                                    <input type="hidden" name="jam_ke" value="{{ $jam_ke }}">
                                    <input type="hidden" name="tgl_absen" value="{{ $tgl_absen }}">
                                    <table class="table table-bordered table-condensed table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center" colspan="8">
                                                    <div class="btn-group">
                                                        @foreach (range(1,8) as $r)
                                                        <a href="{{ url('absen/siswa/?tgl_absen='.$tgl_absen.'&jam_ke='.$r.'&kelas='.request()->kelas) }}" class="btn btn-danger">Jam Ke <b>{{$r}}</b></a>
                                                        @endforeach
                                                    </div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align: middle;" class="text-center" rowspan="2">NIS</th>
                                                <th style="vertical-align: middle;" class="text-center" rowspan="2">Nama</th>
                                                <th style="vertical-align: middle;" class="text-center" rowspan="2">Kelas</th>
                                                <th class="text-center" colspan="4">Absen</th>
                                                <th style="vertical-align: middle;" class="text-center" rowspan="2">Keterangan</th>
                                            </tr>
                                            <tr>
                                                @php
                                                $array = ['A', 'I', 'S', 'H'];
                                                @endphp
                                                @foreach ($array as $arr)
                                                <th class="text-center">{{ $arr }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($siswa->get() as $s)
                                            @if ($s->diabsen()->where('jam_ke', request()->jam_ke)->where('tgl_absen', request()->tgl_absen)->count() > 0)
                                            @foreach ($s->diabsen()->where('jam_ke', request()->jam_ke)->where('tgl_absen', request()->tgl_absen)->get() as $k)
                                            <tr>
                                                <td class="text-center">{{ $s['nis'] }}
                                                </td>
                                                <td>{{ $s['nama'] }}</td>
                                                <td class="text-center">{{ $s['kelas'] }}</td>
                                                <td class="text-center">{!! Form::radio('absen['.$s['nis'].']', 'A' , $k['pivot']['absen'] == 'A' ? true : false) !!}</td>
                                                <td class="text-center">{!! Form::radio('absen['.$s['nis'].']', 'I' , $k['pivot']['absen'] == 'I' ? true : false) !!}</td>
                                                <td class="text-center">{!! Form::radio('absen['.$s['nis'].']', 'S' , $k['pivot']['absen'] == 'S' ? true : false) !!}</td>
                                                <td class="text-center">{!! Form::radio('absen['.$s['nis'].']', 'H' , $k['pivot']['absen'] == 'H' ? true : false) !!}</td>
                                                <td class="text-center">
                                                    {{ $k['pivot']['keterangan'] }}
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td class="text-center">{{ $s['nis'] }}
                                                    <input type="hidden" name="nis['{{ $s['nis'] }}']" value="{{ $s['nis'] }}">
                                                </td>
                                                <td>{{ $s['nama'] }}</td>
                                                <td class="text-center">{{ $s['kelas'] }}</td>
                                                <td class="text-center">{!! Form::radio('absen['.$s['nis'].']', 'A') !!}</td>
                                                <td class="text-center">{!! Form::radio('absen['.$s['nis'].']', 'I') !!}</td>
                                                <td class="text-center">{!! Form::radio('absen['.$s['nis'].']', 'S') !!}</td>
                                                <td class="text-center">{!! Form::radio('absen['.$s['nis'].']', 'H') !!}</td>
                                                <td class="text-center">
                                                    Belum Ada Absen
                                                </td>
                                            </tr>
                                            @endif
                                            @empty
                                            <tr>
                                                <td colspan="9" class="text-center">Data tidak ada</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @foreach ($siswa->take(1)->get() as $s)
                                    @if ($s->diabsen()->where('jam_ke', request()->jam_ke)->where('tgl_absen', request()->tgl_absen)->count() < 1)
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    @endif
                                    @endforeach
                                    <a href="{{ route('kehadiran.index') }}" class="btn btn-success">Kembali</a>
                                    {!! Form::close() !!}
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection