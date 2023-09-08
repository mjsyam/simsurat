<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identifier extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function userRoles()
    {
        return $this->hasMany(UserRole::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }

    public function parent()
    {
        return $this->belongsTo(Identifier::class, "parent_id");
    }

    public function children() {
        return $this->hasMany(Identifier::class, "parent_id");
    }
}
