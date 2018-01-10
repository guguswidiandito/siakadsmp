<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function guru()
    {
        return $this->hasOne(Guru::class);
    }

    public function mapel()
    {
        return $this->hasMany(Mapel::class);
    }

    public function mengabsen()
    {
        return $this->belongsToMany(Siswa::class, 'kehadirans')
            ->withPivot('tgl_absen', 'jam_ke', 'keterangan', 'absen');
    }

    public function menilai()
    {
        return $this->belongsToMany(Siswa::class, 'nilais')
            ->withPivot('id', 'mapel_id', 'harian', 'uts', 'uas', 'tahun_ajaran');
    }

    public function scopeDaftarGuru($q)
    {
        return $q->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'role_user.role_id', 'roles.id')
            ->join('gurus', 'gurus.user_id', '=', 'users.id')
            ->where('roles.name', 'guru')
            ->pluck('gurus.nama', 'users.id');
    }
}
