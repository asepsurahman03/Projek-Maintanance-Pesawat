<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Figure extends Model
{
    protected $fillable = [
        'section_id', 'figure_number', 'title', 'page', 'image_path', 'caption', 'category',
    ];

    protected $casts = [
        'page' => 'integer',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    /** Whether this figure has a stored image */
    public function hasImage(): bool
    {
        return !empty($this->image_path);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }
}
