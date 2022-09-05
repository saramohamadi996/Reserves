<?php
namespace Gym\Category\Models;

use Gym\PriceGroup\Models\PriceGroup;
use Gym\Service\Models\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * Class Category
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $parent_id
 * @property bool $status
 * @package Gym\Category\Models
 */

class Category extends Model
{
    use HasFactory;

//    /**
//     * The table associated with the model.
//     * @var string
//     */
//    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['title', 'slug', 'parent_id', 'status'];

    /**
     * create dynamic slug category
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();
        static::created(function ($category) {
            $category->slug = $category->createSlug($category->title);
            $category->save();
        });
    }

    /**
     * create dynamic slug category
     * @param $title
     * @return array|string|null
     */
    private function createSlug($title): array|string|null
    {
        if (static::whereSlug($slug = Str::slug($title))->exists()) {
            $max = static::whereName($title)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }

    /**
     * get parent attribute category
     * @return string
     */
    public function getParentAttribute(): string
    {
        return (is_null($this->parent_id)) ? 'ندارند' : $this->parentCategory->title;
    }

    /**
     * Get the parent category that owns the category.
     * @return BelongsTo
     */
    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get all the sub categories for the category.
     * @return HasMany
     */
    public function subCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get all the services for the category.
     * @return HasMany
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Get all the price group for the category.
     * @return HasMany
     */
    public function priceGroups(): HasMany
    {
        return $this->hasMany(PriceGroup::class);
    }
}
