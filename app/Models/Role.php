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

    public function unit() {
        return $this->belongsToMany(Unit::class, "model_has_roles", "role_id", "unit_id");
    }

    public function letters() {
        return $this->hasMany(Letter::class);
    }

    public function letterReceivers() {
        return $this->hasMany(letterReceiver::class);
    }

    public function dispositionTos()
    {
        return $this->hasMany(DispositionTo::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, "model_has_roles", "role_id", "model_id");
    }
}
