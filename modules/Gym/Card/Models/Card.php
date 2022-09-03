<?php

namespace Gym\Card\Models;

use Gym\User\Models\Wallet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Cards
 * @property int $id
 * @property string $bank
 * @property string $card_number
 * @property string $user_id
 * @property string $name_account_holder
 * @property string $bank_name
 * @property bool $is_enabled
 * @property bool $status
 * @package Gym\Cards\Models
 */
class Card extends Model
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'cards';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['user_id','name_account_holder','bank_name', 'card_number','status'];

    /**
     * Get all the wallets for the card.
     * @return HasMany
     */
    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }

}
