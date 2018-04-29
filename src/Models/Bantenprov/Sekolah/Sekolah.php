<?php

namespace Bantenprov\Sekolah\Models\Bantenprov\Sekolah;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sekolah extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $table = 'sekolahs';
    protected $fillable = [
        'nama',
        'npsn',
        'jenis_sekolah_id',
        'alamat',
        'logo',
        'foto_gedung',
        'province_id',
        'city_id',
        'district_id',
        'village_id',
        'no_telp',
        'email',
        'kode_zona',
        'user_id',
    ];
    protected $hidden = [
    ];
    protected $appends = [
        'label',
        'jalur_umum',
        'jalur_prestasi',
        'jumlah_pendaftar',
    ];
    protected $dates = [
        'deleted_at',
    ];

    public function getLabelAttribute()
    {
        return $this->nama;
    }

    public function getJalurUmumAttribute()
    {
        return 0;
    }

    public function getJalurPrestasiAttribute()
    {
        return 0;
    }

    public function getJumlahPendaftarAttribute()
    {
        return $this->siswas->count();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function jenis_sekolah()
    {
        return $this->belongsTo('Bantenprov\Sekolah\Models\Bantenprov\Sekolah\JenisSekolah', 'jenis_sekolah_id');
    }

    public function province()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\Province', 'province_id');
    }

    public function city()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\City', 'city_id');
    }

    public function district()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\District', 'district_id');
    }

    public function village()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\Village', 'village_id');
    }

    public function master_zona()
    {
        return $this->belongsTo('Bantenprov\Zona\Models\Bantenprov\Zona\MasterZona', 'kode_zona');
    }

    public function siswas()
    {
        return $this->hasMany('Bantenprov\Siswa\Models\Bantenprov\Siswa\Siswa', 'sekolah_id');
    }
}
