<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = ['fullname','email','content','apartment_id'];

    public function apartment():BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }
}
