<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class CheckClockSettingTime extends Model
{
    use HasFactory;

    protected $table = 'check_clock_setting_times';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'ck_settings_id',
        'day',
        'clock_in',
        'clock_out',
        'break_start',
        'break_end',
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

    public function clocks()
    {
        return $this->hasMany(CheckClock::class, 'ck_settings_id', 'id');
    }
}
