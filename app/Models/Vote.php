<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    protected $fillable = [
        'candidature_id',
        'voter_name',
        'voter_email',
        'voter_phone',
        'voter_type',
        'amount',
        'points',
        'payment_method',
        'transaction_ref',
        'status',
        'ip_address',
        'vote_token',
    ];

    public function candidature(): BelongsTo
    {
        return $this->belongsTo(Candidature::class);
    }

    public static function pointsForAmount(int $amount): int
    {
        return (int) ($amount / 100);
    }

    // Montants disponibles → points
    public static function pricingTable(): array
    {
        return [
            100   => 1,
            200   => 2,
            500   => 5,
            1000  => 10,
            2000  => 20,
            5000  => 50,
            10000 => 100,
        ];
    }
}
