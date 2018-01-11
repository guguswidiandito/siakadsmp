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
                        Tambah Nilai
                    </div>
                </div>
                <div class="panel-body">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <p>Kelas: <b>{{ DB::table('kelas')->where('id', request()->kelas)->first()->kelas }}</b></p>
                            <p>Mapel: <b>{{ $mapel->where('id', request()->mapel_id)->first()->mapel }}</b></p>
                            <p>Tahun Ajaran: <b>{{ str_replace('-', '/', $tahun_ajaran) }}</b></p>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <fieldset>
                                    <table class="table table-bordered table-condensed">
                                        <tr>
                                            <th colspan="{{ $mapel->count() }}" class="text-center">Daftar Mapel</th>
                                        </tr>
                                        <tr>
                                            @foreach ($mapel->where('kelas_id', request()->kelas) as $m)
                                                <td class="text-center"><a href="{{ url('/nilai/siswa?tahun_ajaran='.$tahun_ajaran.'&kelas='.request()->kelas.'&mapel_id='.$m->id) }}" class="btn btn-sm btn-danger">{{ $m->mapel }}</a></td>
                                            @endforeach
                                        </tr>
                                    </table>
                                    {!! Form::open(array('route' => 'nilai.store', 'method' => 'POST')) !!}
                                    <input type="hidden" name="tahun_ajaran" value="{{ $tahun_ajaran }}">
                                    <input type="hidden" name="mapel_id" value="{{ request()->mapel_id }}">
                                    <table class="table table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align: middle;" class="text-center" rowspan="2">NIS</th>
                                                <th style="vertical-align: middle;" class="text-center" rowspan="2">Nama</th>
                                                <th class="text-center" colspan="4">Nilai</th>
                                                <th class="text-center" rowspan="2" style="vertical-align: middle;">Aksi</th>
                                            </tr>
                                            <tr>
                                                @php
                                                $array = ['Harian (20%)', 'UTS (30%)', 'UAS (50%)', 'Nilai Akhir'];
                                                @endphp
                                                @foreach ($array as $arr)
                                                <th class="text-center">{{ $arr }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($siswa->get() as $s)
                                            @if ($s->dinilai()->where('tahun_ajaran', request()->tahun_ajaran)->where('mapel_id', request()->mapel_id)->count() > 0)
                                            @foreach ($s->dinilai()->where('tahun_ajaran', request()->tahun_ajaran)->where('mapel_id', request()->mapel_id)->get() as $k)
                                            <tr>
                                                <td class="text-center">{{ $s['nis'] }}
                                                </td>
                                                <td>{{ $s['nama'] }}</td>
                                                <td class="text-center">{{ $k['pivot']['harian'] }}</td>
                                                <td class="text-center">{{ $k['pivot']['uts'] }}</td>
                                                <td class="text-center">{{ $k['pivot']['uas'] }}</td>
                                                <td class="text-center">
                                                    @php
                                                    $akhir = ($k['pivot']['harian']*0.2)+($k['pivot']['uts']*0.3)+($k['pivot']['uas']*0.5);
                                                    echo $akhir;
                                                    @endphp
                                                </td>
                                                <td class="text-center"><a href="{{ url('nilai/'.$k['pivot']['id']) }}" class="btn btn-xs btn-primary" target="_blank">Edit</a></td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td class="text-center">{{ $s['nis'] }}
                                                    <input type="hidden" name="nis['{{ $s['nis'] }}']" value="{{ $s['nis'] }}">
                                                </td>
                                                <td>{{ $s['nama'] }}</td>
                                                <td class="text-center">{!! Form::number('harian['.$s['nis'].']', 0, ['class' => 'form-control', 'placheholder' => 'Harian', 'min' => 0, 'max' => 100]) !!}</td>
                                                <td class="text-center">{!! Form::number('uts['.$s['nis'].']', 0, ['class' => 'form-control', 'placheholder' => 'UTS', 'min' => 0, 'max' => 100]) !!}</td>
                                                <td class="text-center">{!! Form::number('uas['.$s['nis'].']', 0, ['class' => 'form-control', 'placheholder' => 'UAS', 'min' => 0, 'max' => 100]) !!}</td></td>
                                                <td class="text-center">Belum Ada Nilai</td>
                                                <td class="text-center">Belum Ada Nilai</td>
                                            </tr>
                                            @endif
                                            @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Data tidak ada</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @foreach ($siswa->take(1)->get() as $s)
                                    @if ($s->dinilai()->where('tahun_ajaran', request()->tahun_ajaran)->where('mapel_id', request()->mapel_id)->count() < 1)
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    @endif
                                    @endforeach
                                    <a href="{{ route('nilai.index') }}" class="btn btn-success">Kembali</a>
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