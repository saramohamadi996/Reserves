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
 * @property string $title
 * @property string $price
 * @property int $category_id
 * @property bool $status
 */
class PriceGroup extends Model
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'price_groups';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['title', 'price', 'category_id', 'user_id','status'];

    /**
     * Get all the wallets for the price group.
     * @return HasMany
     */
    public function service(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Get the category that owns the price group.
     * @return BelongsTo
     */
    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the user that owns the price group.
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
