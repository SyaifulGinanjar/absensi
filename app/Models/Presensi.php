<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presensi extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'presensis';

    protected $dates = [
        'waktu',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama_sesi_id',
        'nama_peserta_id',
        'type',
        'status',
        'refer_to',
        'waktu',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function nama_sesi()
    {
        return $this->belongsTo(Session::class, 'nama_sesi_id');
    }

    public function nama_peserta()
    {
        return $this->belongsTo(Pesertum::class, 'nama_peserta_id');
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
