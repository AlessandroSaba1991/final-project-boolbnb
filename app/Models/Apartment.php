<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable=['title','rooms','beds','bathrooms','square_meters','address','latitude','longitude','cover_image','description','visible'];
}
