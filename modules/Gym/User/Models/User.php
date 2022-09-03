<?php

namespace Gym\User\Models;

use Gym\PriceGroup\Models\PriceGroup;
use Gym\Reserve\Models\Cart;
use Gym\Reserve\Models\Order;
use Gym\Reserve\Models\Reserve;
use Gym\Sens\Models\Sens;
use Gym\Service\Models\Service;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'username', 'staff_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function service(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    /**
     * @return HasMany
     */
    public function sens(): HasMany
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

    /**
     * @return HasMany
     */
    public function priceGroup(): HasMany
    {
        return $this->hasMany(PriceGroup::class);
    }

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return void
     */
    public function active_orders(): void
    {
        $this->orders()->whereIn('status',['pending','paid']);
    }

    /**
     * @return HasMany
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }

    /**
     * @return HasMany
     */
    public function validTransactions(): HasMany
    {
        return $this->transactions()->where('status', 1);
    }

    /**
     * @return Attribute
     */
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

    /**
     * @return HasMany
     */
    public function registered_users(): HasMany
    {
        return $this->hasMany(User::class,'staff_id');
    }

    /**
     * @return Attribute
     */
    protected function balance(): Attribute
    {
        return Attribute::get(fn() => $this->credit - $this->debit);
    }

    /**
     * @param $amount
     * @return bool
     */
    public function allowWithdraw($amount) : bool
    {
        return $this->balance() >= $amount;
    }

}
