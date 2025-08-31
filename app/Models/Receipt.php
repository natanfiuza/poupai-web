<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transaction_id',
        'emission_date',
        'access_key',
        'total_amount',
        'total_discount',
        'total_taxes',
        'raw_data',

    ];

    /**
     * Permite transformar automaticamente os valores dos atributos de um modelo em tipos de dados específicos ao recuperá-los ou defini-los
     *
     * @return array
     *
     */
    protected function casts(): array
    {
        return [
            'raw_data' => 'array',     // Cast o campo 'options' (JSON no BD) para array PHP
        ];
    }
}
