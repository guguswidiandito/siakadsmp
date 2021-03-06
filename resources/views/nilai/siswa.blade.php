@extends('layouts.app')
@push('error')
@if ($errors->any())
<div class="container-fluid">
    <div class="alert alert-danger">
        <b>Warning!</b> Harap isi semua form!
    </div>
</div>
@endif
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="panel-title">
                        Tambah Nilai
                    </div>
                </div>
                <div class="panel-body">
                    <fieldset>
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <p>Kelas: <b>{{ DB::table('kelas')->where('id', request()->kelas)->first()->kelas }}</b></p>
                                    <p>Mapel: <b>{{ $mapel->where('id', request()->mapel_id)->first()->mapel }}</b></p>
                                    <p>Tahun Ajaran: <b>{{ str_replace('-', '/', $tahun_ajaran) }}</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Daftar Mapel
                                </div>
                                <div class="panel-body">
                                    <ul>
                                        @foreach ($mapel->where('kelas_id', request()->kelas) as $m)
                                        <li><a href="{{ url('/nilai/siswa?tahun_ajaran='.$tahun_ajaran.'&kelas='.request()->kelas.'&mapel_id='.$m->id) }}">{{ $m['mapel'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        Daftar Nilai
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-condensed">
                                            <thead>
                                                <tr>
                                                    <th style="vertical-align: middle;" class="text-center" rowspan="2">NIS</th>
                                                    <th style="vertical-align: middle;" class="text-center" rowspan="2">Nama</th>
                                                    <th class="text-center" colspan="6">Nilai</th>
                                                    <th class="text-center" rowspan="2" style="vertical-align: middle;">Status</th>
                                                </tr>
                                                <tr>
                                                    @php
                                                    $array = ['Harian (20%)', 'UTS (30%)', 'UAS (50%)', 'Nilai Akhir', 'KKM', 'Predikat'];
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
                                                    @php
                                                    $akhir = ($k['pivot']['harian']*0.2)+($k['pivot']['uts']*0.3)+($k['pivot']['uas']*0.5);
                                                    $kkm = 75;
                                                    @endphp
                                                    <td class="text-center">{{ $s['nis'] }}
                                                    </td>
                                                    <td>{{ $s['nama'] }}</td>
                                                    <td class="text-center">{{ $k['pivot']['harian'] }}</td>
                                                    <td class="text-center">{{ $k['pivot']['uts'] }}</td>
                                                    <td class="text-center">{{ $k['pivot']['uas'] }}</td>
                                                    <td class="text-center">
                                                        {{ $akhir }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $kkm }}
                                                    </td>
                                                    <td class="text-center">
                                                        @php
                                                        if ($akhir > 85) {
                                                        echo 'A';
                                                        } elseif ($akhir > 75) {
                                                        echo 'B';
                                                        } else {
                                                        echo 'C';
                                                        }
                                                        @endphp
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($akhir < $kkm)
                                                        <a href="{{ url('nilai/'.$k['pivot']['id']) }}" class="btn btn-xs btn-primary" target="_blank">Remidi</a>
                                                        @else
                                                        Lulus
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                {!! Form::open(array('route' => 'nilai.store', 'method' => 'POST')) !!}
                                                <input type="hidden" name="tahun_ajaran" value="{{ $tahun_ajaran }}">
                                                <input type="hidden" name="mapel_id" value="{{ request()->mapel_id }}">
                                                <tr>
                                                    <td class="text-center">{{ $s['nis'] }}
                                                        <input type="hidden" name="nis['{{ $s['nis'] }}']" value="{{ $s['nis'] }}">
                                                    </td>
                                                    <td>{{ $s['nama'] }}</td>
                                                    <td width="100" class="text-center {{ $errors->has('harian.'.$s['nis']) ? "has-error" : "" }}">{!! Form::number('harian['.$s['nis'].']', null, ['class' => 'form-control', 'placheholder' => 'Harian']) !!}</td>
                                                    <td width="100" class="text-center {{ $errors->has('uts.'.$s['nis']) ? "has-error" : "" }}">{!! Form::number('uts['.$s['nis'].']', null, ['class' => 'form-control', 'placheholder' => 'UTS']) !!}</td>
                                                    <td  width="100"class="text-center {{ $errors->has('uas.'.$s['nis']) ? "has-error" : "" }}">{!! Form::number('uas['.$s['nis'].']', null, ['class' => 'form-control', 'placheholder' => 'UAS']) !!}</td></td>
                                                    <td class="text-center">Belum dinilai</td>
                                                    <td class="text-center">76</td>
                                                    <td class="text-center">Belum dinilai</td>
                                                    <td class="text-center">Belum dinilai</td>
                                                </tr>
                                                @endif
                                                @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">Data tidak ada</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                                    <a href="{{ route('nilai.index') }}" class="btn btn-success">Kembali</a>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection