<?php

namespace Gym\User\Models;

use Gym\PriceGroup\Models\PriceGroup;
use Gym\Reserve\Models\Cart;
use Gym\Reserve\Models\Order;
use Gym\Reserve\Models\Reserve;
use Gym\Sens\Models\Sens;
use Gym\Service\Models\Service;
use Gym\Wallet\Models\Wallet;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const STATUS_ACTIVE = "active";
    const STATUS_INACTIVE = "inactive";
    const STATUS_BAN = "ban";
    static $statuses = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
        self::STATUS_BAN
    ];

    const ADMIN ="admin";
    const STAFF ="staff";
    const USER ="user";
    static $roles =[
        self::ADMIN,
        self::STAFF,
        self::USER
    ];

    public static $defaultUsers = [
        [
            'staff_id' => 1,
            'email' => 'admin@site.com',
            'mobile' => '09100000000',
            'password' => 'admin',
            'name' => 'Admin',
            'username' => 'admin',
        ],
        [
            'staff_id' => 1,
            'email' => 'staff@site.com',
            'mobile' => '09120000000',
            'password' => 'staff',
            'name' => 'Staff',
            'username' => 'staff',
        ],
        [
            'staff_id' => 1,
            'email' => 'user@site.com',
            'mobile' => '091230000000',
            'password' => 'user',
            'name' => 'User',
            'username' => 'user',
        ]
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'username', 'staff_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function service()
    {
        return $this->hasMany(Service::class);
    }

    public function sens()
    {
        return $this->hasMany(Sens::class);
    }

    /**
     * The users that belong to the Reserve.
     * @return BelongsToMany
     */
    public function reserves():BelongsToMany
    {
        return $this->belongsToMany(Reserve::class, 'user_reserve');
    }

    public function priceGroup()
    {
        return $this->hasMany(PriceGroup::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function active_orders()
    {
        $this->orders()->whereIn('status',['pending','paid']);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function transactions()
    {
        return $this->hasMany(Wallet::class);
    }

    public function validTransactions()
    {
        return $this->transactions()->where('status', 1);
    }

    protected function credit(): Attribute
    {
        return Attribute::get(fn() => $this->validTransactions()
            ->where('type', 'credit')->sum('amount'));
    }

    protected function debit(): Attribute
    {
        return Attribute::get(fn() => $this->validTransactions()
            ->where('type', 'debit')->sum('amount'));
    }

    public function registered_users()
    {
        return $this->hasMany(User::class,'staff_id');
    }

    protected function balance(): Attribute
    {
        return Attribute::get(fn() => $this->credit - $this->debit);
    }

    public function allowWithdraw($amount) : bool
    {
        return $this->balance() >= $amount;
    }

}
