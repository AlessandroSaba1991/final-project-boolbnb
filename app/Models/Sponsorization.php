<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sponsorization extends Model
{
    public function apartments(): BelongsToMany
    {
        return $this->belongsToMany(Apartment::class)->as('sponsor')->withPivot('start_sponsorization', 'end_sponsorization');
    }
}
