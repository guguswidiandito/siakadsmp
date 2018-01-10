<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'kelas', 'user_id',
    ];

    public function scopeSemuaKelas($q)
    {
        return $q->join('users', 'users.id', '=', 'kelas.user_id')
                ->join('gurus', 'gurus.user_id', '=', 'kelas.user_id');
    }

    public function siswa()
    {
    	return $this->hasMany(Siswa::class);
    }

    public function mapel()
    {
        return $this->hasMany(Mapel::class);
    }

}
