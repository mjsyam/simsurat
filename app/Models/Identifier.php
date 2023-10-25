<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identifier extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_identifiers');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
