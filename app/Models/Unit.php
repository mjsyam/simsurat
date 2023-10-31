<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parent() {
        return $this->belongsTo(Unit::class, "parent_id");
    }

    public function children() {
        return $this->hasMany(Unit::class, "parent_id");
    }

    public function identifiers()
    {
        return $this->hasMany(Identifier::class);
    }
}
