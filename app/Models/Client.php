<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function calls()
    {
        return $this->hasMany(Call::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
