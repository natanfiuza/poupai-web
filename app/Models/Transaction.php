<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'payment_method_id',
        'merchant_id',
        'description',
        'amount',
        'type',
        'date',
    ];
   /**
     * Get the user that owns the transaction
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the user that owns category
     *
     * @return BelongsTo
     *
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryUser::class,'category_id');
    }
    /**
     * Get the user that owns Payment Method
     *
     * @return BelongsTo
     *
     */
    public function payment_method(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class,'payment_method_id');
    }
}
