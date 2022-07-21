<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apartment extends Model
{
    protected $fillable=['title','rooms','beds','bathrooms','square_meters','address','latitude','longitude','cover_image','description','visible','user_id'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function visualizations(): HasMany
    {
        return $this->hasMany(Visualization::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function sponsorizations(): BelongsToMany
    {
        return $this->belongsToMany(Sponsorization::class)->as('sponsor')->withPivot('start_sponsorization', 'end_sponsorization');
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }
}
