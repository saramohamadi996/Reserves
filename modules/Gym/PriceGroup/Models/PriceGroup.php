<?php
namespace Gym\PriceGroup\Models;
use Gym\Category\Models\Category;
use Gym\Service\Models\Service;
use Gym\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class PriceGroup extends Model
{
    protected $table = 'price_groups';

    protected $fillable = ['title', 'price', 'category_id', 'user_id','is_enabled'];

    public function service()
    {
        return $this->hasMany(Service::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
