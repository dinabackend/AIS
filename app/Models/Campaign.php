<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'status',
        'budget',
        'daily_budget',
        'start_date',
        'end_date',
        'target_audience',
        'objectives',
        'created_by'
    ];

    protected $casts = [
        'budget' => 'decimal:2',
        'daily_budget' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'target_audience' => 'array',
        'objectives' => 'array',
    ];

    public function calculateROI(): float
    {
        $revenue = $this->conversions()->sum('value');
        $cost = $this->total_spend;
        return $cost > 0 ? (($revenue - $cost) / $cost) * 100 : 0;
    }

    public function calculateCTR(): float
    {
        $impressions = $this->getTotalImpressions();
        $clicks = $this->clicks()->count();
        return $impressions > 0 ? ($clicks / $impressions) * 100 : 0;
    }
}
