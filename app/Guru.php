<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
	public $primaryKey = 'nbm';

	public $incrementing = false;

    protected $fillable = [
        'nama', 'nbm', 'alamat', 'no_hp', 'agama', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
