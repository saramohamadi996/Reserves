<?php
namespace Gym\PriceGroup\Models;
use Gym\Category\Models\Category;
use Gym\Service\Models\Service;
use Gym\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int|mixed|string|null $user_id
 * @property mixed $title
 * @property mixed $price
 * @property mixed $category_id
 */
class PriceGroup extends Model
{
    protected $table = 'price_groups';

    protected $fillable = ['title', 'price', 'category_id', 'user_id','is_enabled'];

    public function service(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
