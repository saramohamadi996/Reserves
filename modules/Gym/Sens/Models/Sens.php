<?php

namespace Gym\Sens\Models;

use Gym\PriceGroup\Models\PriceGroup;
use Gym\Reserve\Models\Reserve;
use Gym\Service\Models\Service;
use Gym\User\Models\User;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $start_at
 * @property mixed $expire_at
 * @property mixed $start
 * @property mixed $end
 */
class Sens extends Model
{
    protected $table = 'senses';

//    protected $fillable = [
//        'user_id', 'service_id', 'volume',
//        'start', 'end', 'start_at', 'expire_at', 'day', 'is_enabled'
//    ];

    const SUNDAY = "inactive";
    const MONDAY = "ban";
    const TUESDAY = "ban";
    const WEDNESDAY = "ban";
    const THURSDAY = "ban";
    const FRIDAY = "ban";

    protected $guarded = [];

    protected $casts = ['day' => AsArrayObject::class];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * @return BelongsTo
     */
    public function priceGroup(): BelongsTo
    {
        return $this->belongsTo(PriceGroup::class);
    }

    /**
     * @return HasMany
     */
    public function reserves(): HasMany
    {
        return $this->hasMany(Reserve::class, 'sense_id');
    }

    /**
     * @param $day
     * @return string
     */
    public static function dayOfWeek($day): string
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
