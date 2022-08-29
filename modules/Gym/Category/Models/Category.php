<?php
namespace Gym\Category\Models;

use Gym\Order\Model\Percent;
use Gym\PriceGroup\Models\PriceGroup;
use Gym\Service\Models\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $parent_id
 * @package Gym\Category\Models
 */

class Category extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var string[]
     */
    protected $fillable = ['title', 'slug', 'parent_id', 'is_enabled'];

//    /**
//     * Boot the model.
//     */
//    protected static function boot()
//    {
//        parent::boot();
//
//        static::created(function ($product) {
//            $product->slug = $product->createSlug($product->title);
//            $product->save();
//        });
//    }
//
//    private function createSlug($title){
//        if (static::whereSlug($slug = Str::slug($title))->exists()) {
//            $max = static::whereTitle($title)->latest('id')->skip(1)->value('slug');
//            if (is_numeric($max[-1])) {
//                return preg_replace_callback('/(\d+)$/', function ($mathces) {
//                    return $mathces[1] + 1;
//                }, $max);
//            }
//            return "{$slug}-2";
//        }
//        return $slug;
//    }

    public function getParentAttribute()
    {
        return (is_null($this->parent_id)) ? 'ندارند' : $this->parentCategory->title;
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function percent()
    {
        return $this->hasMany(Percent::class);
    }

    public function priceGroup()
    {
        return $this->hasMany(PriceGroup::class);
    }
}
