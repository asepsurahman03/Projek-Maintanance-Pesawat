<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    protected $fillable = [
        'manual_id', 'section_number', 'title', 'description',
        'page_start', 'page_end', 'system_slug', 'sort_order',
    ];

    protected $casts = [
        'page_start' => 'integer',
        'page_end'   => 'integer',
        'sort_order' => 'integer',
    ];

    public function manual(): BelongsTo
    {
        return $this->belongsTo(Manual::class);
    }

    public function subsections(): HasMany
    {
        return $this->hasMany(Subsection::class)->orderBy('sort_order');
    }

    public function figures(): HasMany
    {
        return $this->hasMany(Figure::class)->orderBy('figure_number');
    }

    public function specifications(): HasMany
    {
        return $this->hasMany(Specification::class)->orderBy('sort_order');
    }

    public function inspectionItems(): HasMany
    {
        return $this->hasMany(InspectionItem::class)->orderBy('sort_order');
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    /** Full display label: "11 — ENGINE" */
    public function getDisplayTitleAttribute(): string
    {
        return "Section {$this->section_number} — {$this->title}";
    }
}
