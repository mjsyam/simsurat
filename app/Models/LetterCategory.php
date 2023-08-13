<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function letters() {
        return $this->hasMany(Letter::class);
    }
}
