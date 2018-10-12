<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KesiapanKerja extends Model
{
	protected $table = 'kesiapan_kerja';
	protected $fillable = [
		'user_id', 'p5m_id', 'jamtidur', 'jambangun', 'minepermit', 'masalahpribadi', 'rompi', 'sepatu', 'helm', 'kacamata', 'loto', 'siap', 'status'
	];
	public $timestamps = true;

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function p5m()
	{
		return $this->belongsTo(P5m::class);
	}
}
