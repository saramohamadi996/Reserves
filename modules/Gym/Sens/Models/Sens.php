<?php

namespace Gym\Sens\Models;

use Gym\PriceGroup\Models\PriceGroup;
use Gym\Reserve\Models\Reserve;
use Gym\Service\Models\Service;
use Gym\User\Models\User;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Model;

class Sens extends Model
{
    protected $table = 'senses';

//    protected $fillable = [
//        'user_id', 'service_id', 'volume',
//        'start', 'end', 'start_at', 'expire_at', 'day', 'is_enabled'
//    ];

    const SATURDAY = "شنبه";
    const SUNDAY = "inactive";
    const MONDAY = "ban";
    const TUESDAY = "ban";
    const WEDNESDAY = "ban";
    const THURSDAY = "ban";
    const FRIDAY = "ban";
    static $days = [
        self::SATURDAY,
        self::SUNDAY,
        self::MONDAY,
        self::TUESDAY,
        self::WEDNESDAY,
        self::THURSDAY,
        self::FRIDAY,
    ];

    protected $guarded = [];

    protected $casts = ['day' => AsCollection::class];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function priceGroup()
    {
        return $this->belongsTo(PriceGroup::class);
    }

    public function reserves()
    {
        return $this->hasMany(Reserve::class, 'sense_id');
    }

    public static function dayOfWeek($day)
    {
        return match ($day) {
            "0" => "شنبه",
            "1" => "یکشنبه",
            "2" => "دوشنبه",
            "3" => "سه شنبه",
            "4" => "چهارشنبه",
            "5" => "پنج شنبه",
            "6" => "جمعه",
            default => '',
        };
    }

}
