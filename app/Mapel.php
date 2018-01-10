<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
	public $timestamps = false;

    protected $fillable = [
    	'mapel', 'kelas_id', 'user_id'
    ];

    public function kelas()
    {
    	return $this->belongsTo(Kelas::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
