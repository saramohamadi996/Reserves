<?php

namespace Gym\Reserve\Models;

use Gym\Sens\Models\Sens;
use Gym\Service\Models\Service;
use Gym\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    protected $table = 'reserves';

//    protected $fillable = ['user_id', 'service_id', 'sens_id','date'];
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'orders')->withPivot('status');
    }

    public function paid_users()
    {
        return $this->users()->wherePivotIn('status',['pending','paid']);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function services()
    {
        return $this->belongsTo(Service::class);
    }

    public function sens()
    {
        return $this->belongsTo(Sens::class, 'sense_id');
    }
}
