<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P5m extends Model
{
    protected $table = 'p5m';
    protected $fillable = [
    	'user_id', 'pembahasan', 'materi', 'tanggal', 'qrcode'
    ];
    public $timestamps = true;

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function kesiapan_kerja()
    {
    	return $this->hasMany(KesiapanKerja::class);
    }
}
