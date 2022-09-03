<?php

namespace Gym\Reserve\Models;

use Gym\Sens\Models\Sens;
use Gym\Service\Models\Service;
use Gym\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reserve extends Model
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'reserves';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable =['sense_id', 'start_time', 'end_time'];

    /**
     * The users that belong to the reserve.
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'orders')->withPivot('status');
    }

    /**
     * The paid users that belong to the reserve.
     * @return BelongsToMany
     */
    public function paidUsers(): BelongsToMany
    {
        return $this->users()->wherePivotIn('status',['pending','paid']);
    }

    /**
     * Get all the orders for the reserve.
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the service that owns the reserve.
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the sens that owns the reserve.
     * @return BelongsTo
     */
    public function sens(): BelongsTo
    {
        return $this->belongsTo(Sens::class, 'sense_id');
    }
}
