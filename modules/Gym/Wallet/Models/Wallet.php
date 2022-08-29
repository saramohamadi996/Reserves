<?php

namespace Gym\Wallet\Models;

use Gym\Card\Models\Card;
use Gym\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallets';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cards()
    {
        return $this->belongsTo(Card::class);
    }


}
