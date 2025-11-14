<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class CheckClock extends Model
{
    use HasFactory;

    protected $table = 'check_clocks';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'check_clock_type',
        'check_clock_time',
        'deleted_at',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function setting()
    {
        return $this->belongsTo(CheckClockSettingTime::class, 'ck_settings_id', 'id');
    }
}
