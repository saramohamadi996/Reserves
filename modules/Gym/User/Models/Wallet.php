<?php

namespace Gym\User\Models;

use Gym\Card\Models\Card;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int|mixed|string|null $admin_id
 * @property mixed $user_id
 * @property mixed $card_id
 * @property mixed|string $type
 * @property mixed $amount
 * @property mixed $description
 * @property mixed $date_payment
 * @property mixed $status
 */
class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallets';

    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function cards(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class,'admin_id');
    }
}
