<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InspectionItem extends Model
{
    protected $fillable = [
        'section_id', 'item', 'interval', 'description', 'notes', 'source_page', 'sort_order',
    ];

    protected $casts = [
        'source_page' => 'integer',
        'sort_order'  => 'integer',
    ];

    // Standard interval constants
    const INTERVAL_50    = '50 hours';
    const INTERVAL_100   = '100 hours';
    const INTERVAL_200   = '200 hours';
    const INTERVAL_SPECIAL = 'Special';
    const INTERVAL_ANNUAL  = 'Annual';

    public static function intervals(): array
    {
        return [
            self::INTERVAL_50,
            self::INTERVAL_100,
            self::INTERVAL_200,
            self::INTERVAL_SPECIAL,
            self::INTERVAL_ANNUAL,
        ];
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
