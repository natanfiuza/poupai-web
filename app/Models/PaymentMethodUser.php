<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentMethodUser extends Model
{
/**
 * The attributes that are mass assignable.
 *
 * @var array<int, string>
 */
    protected $fillable = [
        'user_id',
        'payment_method_default_id',
        'name',
        'brand',
        'last_four_digits',

    ];
    /**
     * Get the user that owns the payment method.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function paymentMethodDefault(): BelongsTo
    {
        return $this->belongsTo(PaymentMethodDefault::class);
    }
}
