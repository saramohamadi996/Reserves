<?php

namespace Gym\Sens\Models;

use Gym\PriceGroup\Models\PriceGroup;
use Gym\Reserve\Models\Reserve;
use Gym\Service\Models\Service;
use Gym\User\Models\User;
use Illuminate\Database\Eloquent\Casts\AsCollection;
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
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'senses';


    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable =[
        'user_id', 'price_group_id', 'service_id', 'volume', 'status', 'day', 'start', 'end', 'start_at', 'expire_at'
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = ['day' => AsCollection::class];

    /**
     * Get the user that owns the sens.
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the service that owns the sens.
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the price group that owns the sens.
     * @return BelongsTo
     */
    public function priceGroup(): BelongsTo
    {
        return $this->belongsTo(PriceGroup::class);
    }

    /**
     * Get all the reserves for the sens.
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
