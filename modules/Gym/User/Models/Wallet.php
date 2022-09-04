<?php

namespace Gym\User\Models;

use Gym\Card\Models\Card;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int|mixed|string|null $admin_id
 * @property int $user_id
 * @property int $card_id
 * @property bool $type
 * @property string $amount
 * @property string $description
 * @property mixed $date_payment
 * @property bool $status
 */
class Wallet extends Model
{
    use HasFactory;

//    /**
//     * The table associated with the model.
//     * @var string
//     */
//    protected $table = 'wallets';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'admin_id', 'user_id', 'card_id', 'amount', 'description', 'type', 'status', 'date_payment'
    ];

    /**
     * Get the user that owns the wallet.
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the card that owns the wallet.
     * @return BelongsTo
     */
    public function cards(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    /**
     * Get the admin that owns the wallet.
     * @return BelongsTo
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
