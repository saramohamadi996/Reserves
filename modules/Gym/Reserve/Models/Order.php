<?php

namespace Gym\Reserve\Models;

use Gym\Service\Models\Service;
use Gym\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reserve()
    {
        return $this->belongsTo(Reserve::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
