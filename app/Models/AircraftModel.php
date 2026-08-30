<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AircraftModel extends Model
{
    protected $fillable = [
        'popular_name', 'model', 'year', 'serial_beginning',
        'serial_ending', 'engine', 'notes', 'source_page',
    ];

    protected $casts = [
        'source_page' => 'integer',
    ];

    /**
     * Check if a serial number falls within this model's range.
     * Handles alphanumeric serials (strip prefix letters for numeric comparison).
     */
    public function matchesSerial(string $serial): bool
    {
        if (!$this->serial_beginning || !$this->serial_ending) {
            return false;
        }

        // Numeric comparison
        $sNum   = (int) preg_replace('/[^0-9]/', '', $serial);
        $begNum = (int) preg_replace('/[^0-9]/', '', $this->serial_beginning);
        $endNum = (int) preg_replace('/[^0-9]/', '', $this->serial_ending);

        return $sNum >= $begNum && $sNum <= $endNum;
    }
}
