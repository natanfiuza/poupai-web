<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiptItem extends Model
{
    /**
 * The attributes that are mass assignable.
 *
 * @var array<int, string>
 */
protected $fillable = [
    'receipt_id',
    'description',
    'quantity',
    'unit_of_measure',
    'unit_price',
    'total_price',

];

}
