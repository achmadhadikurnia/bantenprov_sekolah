<?php

namespace Bantenprov\Sekolah\Models\Bantenprov\Sekolah;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminSekolah extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $table = 'admin_sekolahs';
    protected $fillable = [
        'sekolah_id',
        'user_id',
    ];
    protected $hidden = [
    ];
    protected $dates = [
        'deleted_at',
    ];

    

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function sekolah()
    {
        return $this->belongsTo('Bantenprov\Sekolah\Models\Bantenprov\Sekolah\Sekolah','sekolah_id');
    }


    public function admin_sekolah()
    {
        return $this->belongsTo('App\User', 'admin_sekolah_id');
    }
}
