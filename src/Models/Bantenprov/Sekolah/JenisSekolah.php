<?php

namespace Bantenprov\Sekolah\Models\Bantenprov\Sekolah;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisSekolah extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $table = 'jenis_sekolahs';
    protected $fillable = [
        'jenis_sekolah',
        'user_id',
    ];
    protected $appends = [
        'label',
    ];
    protected $hidden = [
    ];
    protected $dates = [
        'deleted_at',
    ];

    public function getLabelAttribute()
    {
        return $this->jenis_sekolah;
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
