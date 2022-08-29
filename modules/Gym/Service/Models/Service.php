<?php

namespace Gym\Service\Models;

use Gym\Category\Models\Category;
use Gym\Reserve\Models\Order;
use Gym\Reserve\Models\Reserve;
use Gym\Sens\Models\Sens;
use Gym\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable =['category_id', 'title', 'slug',
         'code_service', 'priority', 'is_enabled'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sens()
    {
        return $this->hasMany(Sens::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function paid_orders()
    {
        return $this->orders()->where('status','paid');
    }

    public function reserves()
    {
        return $this->hasManyThrough(Reserve::class, Sens::class,null,'sense_id');
    }
}
