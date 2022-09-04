<?php
namespace Gym\Reserve\Models;
use Gym\Service\Models\Service;
use Gym\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

//    /**
//     * The table associated with the model.
//     * @var string
//     */
//    protected $table=['carts'];

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable =['user_id', 'service_id', 'reserve_id', 'sens_price'];

    /**
     * Get the user that owns the cart.
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the service that owns the cart.
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the reserve that owns the cart.
     * @return BelongsTo
     */
    public function reserve(): BelongsTo
    {
        return $this->belongsTo(Reserve::class);
    }

    /**
     * Get the order that owns the order.
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
