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

class Service extends Model
{
    protected $table = 'services';

    protected $fillable =['category_id', 'title', 'slug',
         'code_service', 'priority', 'is_enabled'];

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
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return HasMany
     */
    public function sens(): HasMany
    {
        return $this->hasMany(Sens::class);
    }

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return HasMany
     */
    public function paid_orders(): HasMany
    {
        return $this->orders()->where('status','paid');
    }

    /**
     * @return HasManyThrough
     */
    public function reserves(): HasManyThrough
    {
        return $this->hasManyThrough(Reserve::class, Sens::class,null,'sense_id');
    }
}
