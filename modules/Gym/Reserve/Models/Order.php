<?php

namespace Gym\Reserve\Models;

use Gym\Service\Models\Service;
use Gym\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table=['orders'];

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable =['user_id', 'service_id', 'reserve_id', 'status'];

    /**
     * Get the user that owns the order.
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reserve that owns the order.
     * @return BelongsTo
     */
    public function reserve(): BelongsTo
    {
        return $this->belongsTo(Reserve::class);
    }

    /**
     * Get the service that owns the order.
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
