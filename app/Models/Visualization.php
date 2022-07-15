<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Visualization extends Model
{
    protected $fillable = [
        'ip','apartment_id'
    ];

    public function apartment():BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    public function apartments(): BelongsToMany
    {
        return $this->belongsToMany(Apartment::class);
    }
}
