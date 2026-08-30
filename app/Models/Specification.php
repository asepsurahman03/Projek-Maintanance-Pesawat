<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Specification extends Model
{
    protected $fillable = [
        'section_id', 'category', 'name', 'value', 'unit',
        'model', 'year', 'notes', 'source_page', 'sort_order',
    ];

    protected $casts = [
        'source_page' => 'integer',
        'sort_order'  => 'integer',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    /** Formatted value with unit */
    public function getFormattedValueAttribute(): string
    {
        return $this->unit ? "{$this->value} {$this->unit}" : $this->value;
    }
}
