<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parent() {
        return $this->belongsTo(Role::class, "parent_id");
    }

    public function children() {
        return $this->hasMany(Role::class, "parent_id");
    }

    public function identifiers()
    {
        return $this->hasMany(Identifier::class);
    }

    public function users()
    {
        return $this->identifiers()->users();
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'identifiers');
    }
}
