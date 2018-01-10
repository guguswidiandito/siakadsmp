<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'nis', 'nama', 'agama', 'jenis_kelamin', 'tgl_lahir', 'alamat', 'tahun_masuk', 'kelas_id',
    ];

    public $incrementing = false;

    public $primaryKey = 'nis';

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function diabsen()
    {
        return $this->belongsToMany(User::class, 'kehadirans')
            ->withPivot('tgl_absen', 'jam_ke', 'keterangan', 'absen');
    }

    public function dinilai()
    {
        return $this->belongsToMany(User::class, 'nilais')
            ->withPivot('id', 'mapel_id', 'harian', 'uts', 'uas', 'tahun_ajaran');
    }

    public function scopeSemuaSiswa($q)
    {
        return $q->join('kelas', 'kelas.id', '=', 'siswas.kelas_id')
            ->join('users', 'kelas.user_id', '=', 'users.id')
            ->join('gurus', 'gurus.user_id', '=', 'users.id');
    }

    public function scopePerKelas($q, $tgl_absen, $jam_ke, $kelas)
    {
        $q->leftJoin('kehadirans', function ($q) use ($jam_ke, $tgl_absen) {
            $q->on('siswas.nis', '=', 'kehadirans.siswa_id')
                ->where('tgl_absen', $tgl_absen)
                ->where('jam_ke', $jam_ke);
        })->join('kelas', 'kelas.id', '=', 'siswas.kelas_id')
            ->where('kelas', $kelas);
    }

    public function scopePerTahunAjaran($q, $tahun_ajaran, $kelas, $mapel_id)
    {
        $q->leftJoin('nilais', function ($q) use ($tahun_ajaran, $mapel_id) {
            $q->on('siswas.nis', '=', 'nilais.siswa_id')
                ->where('tahun_ajaran', $tahun_ajaran)
                ->where('mapel_id', $mapel_id);
        })->join('kelas', 'kelas.id', '=', 'siswas.kelas_id')
            ->where('kelas.id', $kelas);
    }

}
