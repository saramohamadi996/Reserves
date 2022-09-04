<?php

namespace Gym\Service\Models;

use Gym\Category\Models\Category;
use Gym\Reserve\Models\Order;
use Gym\Reserve\Models\Reserve;
use Gym\Sens\Models\Sens;
use Gym\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

/**
 * @property string $title
 * @property string $slug
 * @property string $code_service
 * @property int $priority
 * @property int $category_id
 * @property bool $status
 */
class Service extends Model
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'services';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable =['category_id', 'title', 'slug', 'code_service', 'priority', 'status'];

    /**
     * Get the user that owns the service.
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the service.
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all the sens for the service.
     * @return HasMany
     */
    public function sens(): HasMany
    {
        return $this->hasMany(Sens::class);
    }

    /**
     * Get all the orders for the service.
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get all the paid orders for the service.
     * @return HasMany
     */
    public function paidOrders(): HasMany
    {
        return $this->orders()->where('status','paid');
    }

    /**
     * Get all the deployments for the project.
     * @return HasManyThrough
     */
    public function reserves(): HasManyThrough
    {
        return $this->hasManyThrough(Reserve::class, Sens::class,null,'sense_id');
    }
}
