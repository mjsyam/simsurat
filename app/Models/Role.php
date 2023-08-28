<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userRoles() {
        return $this->belongsToMany(User::class, UserRole::class);
    }

    public function parent() {
        return $this->belongsTo(Role::class, "parent_id");
    }

    public function letters() {
        return $this->hasMany(Letter::class);
    }

    public function letterReceivers() {
        return $this->hasMany(letterReceiver::class);
    }
}
