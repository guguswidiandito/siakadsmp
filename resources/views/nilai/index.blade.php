@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-danger">
        <div class="panel-heading">
          <div class="panel-title">
            Nilai
          </div>
        </div>
        <div class="panel-body">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">
                {!! Form::open(array('route' => 'nilaiSiswaPerKelas', 'method' => 'GET')) !!}
                <div class="form-group {{ $errors->has('tahun_ajaran') ? "has-error" : "" }}">
                  {!! Form::label('tahun_ajaran', 'Tahun Ajaran', ['class' => 'control-label']) !!}
                  @php
                  foreach (range(date('Y')-2,date('Y')) as $i ) {
                  $j=$i+1;
                  $tahun_ajaran[$i.'-'.$j.'-1'] = $j.' / '.$i.' /1';
                  $tahun_ajaran[$i.'-'.$j.'-2'] = $j.' / '.$i.' /2';
                  }
                  @endphp
                  {!! Form::select('tahun_ajaran', $tahun_ajaran, null, ['class' => 'form-control', 'placeholder' => 'Pilih']) !!}
                  <p class="help-block">{!! $errors->first('tahun_ajaran') !!}</p>
                </div>
                <div class="form-group {{ $errors->has('kelas') ? "has-error" : "" }}">
                  {!! Form::label('kelas', 'Kelas', ['class' => 'control-label']) !!}
                  {!! Form::select('kelas', $nama_kelas, null, ['class' => 'form-control', 'placeholder' => 'Pilih', 'id' => 'kelas_selector']) !!}
                  <p class="help-block">{!! $errors->first('kelas') !!}</p>
                </div>
                <div class="form-group {{ $errors->has('mapel_id') ? "has-error" : "" }}">
                  {!! Form::label('mapel_id', 'Mapel', ['class' => 'control-label']) !!}
                  {!! Form::select('mapel_id', old('kelas') !== null ? DB::table('mapels')->where('kelas_id', old('kelas'))->pluck('mapel', 'id') : [], old('mapel_id'), ['class' => 'form-control', 'placeholder' => 'Pilih', 'id' => 'mapel_selector']) !!}
                  <p class="help-block">{!! $errors->first('mapel_id') !!}</p>
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
@push('scripts')
<script>
$(document).ready(function () {

  // mengecheck kelas
  if ($('#kelas_selector').length > 0) {
    var xhr
    var kelas_selector, $kelas_selector
    var mapel_selector, $mapel_selector

    $kelas_selector = $('#kelas_selector').selectize({
      sortField: 'text',
      onChange: function (value) {
        if (!value.length) {
          mapel_selector.disable()
          mapel_selector.clearOptions()
          return
        }
        mapel_selector.clearOptions()
        mapel_selector.load(function (callback) {
          xhr && xhr.abort()
          xhr = $.ajax({
            url: 'nilai/siswa/kelas?kelas=' + value,
            success: function (results) {
              mapel_selector.enable()
              callback(results)
            },
            error: function () {
              callback()
            }
          })
        })
      }
    })

    $mapel_selector = $('#mapel_selector').selectize({
      sortField: 'mapel',
      valueField: 'id',
      labelField: 'mapel',
      searchField: ['mapel']
    })

    kelas_selector = $kelas_selector[0].selectize
    mapel_selector = $mapel_selector[0].selectize
  }

})
</script>
@endpush