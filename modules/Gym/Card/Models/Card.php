<?php

namespace Gym\Card\Models;

use Gym\Wallet\Models\Wallet;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cards
 * @property int $id
 * @property string $bank
 * @property string $card_number
 * @property string $user_id
 * @package Gym\Cards\Models
 */
class Card extends Model
{
    /**
     * @var string
     */
    protected $table = 'cards';

    /**
     * @var string[]
     */
    protected $fillable = ['user_id','name_account_holder','bank_name', 'card_number','is_enabled'];

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

}