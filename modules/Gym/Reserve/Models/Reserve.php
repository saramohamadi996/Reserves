<?php

namespace Gym\Reserve\Models;

use Gym\Sens\Models\Sens;
use Gym\Service\Models\Service;
use Gym\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reserve extends Model
{
    protected $table = 'reserves';

//    protected $fillable = ['user_id', 'service_id', 'sens_id','date'];
    protected $guarded = [];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'orders')->withPivot('status');
    }

    public function paid_users(): BelongsToMany
    {
        return $this->users()->wherePivotIn('status',['pending','paid']);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function services(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function sens(): BelongsTo
    {
        return $this->belongsTo(Sens::class, 'sense_id');
    }
}
