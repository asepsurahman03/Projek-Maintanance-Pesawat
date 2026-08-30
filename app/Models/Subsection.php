<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subsection extends Model
{
    protected $fillable = [
        'section_id', 'paragraph_number', 'title', 'page', 'content', 'sort_order',
    ];

    protected $casts = [
        'page'       => 'integer',
        'sort_order' => 'integer',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    /** Excerpt for search results */
    public function getExcerptAttribute(): string
    {
        return \Str::limit(strip_tags($this->content ?? ''), 200);
    }
}
