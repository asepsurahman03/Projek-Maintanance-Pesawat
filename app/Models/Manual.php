<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Manual extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'edition', 'coverage_start', 'coverage_end',
        'source_file', 'description', 'publisher', 'part_number', 'total_pages',
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->orderBy('sort_order');
    }
}
