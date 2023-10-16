<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }

    public function dispositionTos()
    {
        return $this->hasMany(DispositionTo::class);
    }

    public function DispositionInformations()
    {
        return $this->hasMany(DispositionInformation::class);
    }
}
