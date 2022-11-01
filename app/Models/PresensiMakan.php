<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresensiMakan extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'presensi_makans';

    protected $dates = [
        'waktu',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'peserta_id',
        'waktu',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function peserta()
    {
        return $this->belongsTo(Pesertum::class, 'peserta_id');
    }

    public function getWaktuAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setWaktuAttribute($value)
    {
        $this->attributes['waktu'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
