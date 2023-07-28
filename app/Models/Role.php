<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Role;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ["role", "superior"];

    public function userRole() {
        return $this->belongsToMany(User::class, 'users_roles')->orderBy('users_roles.created_at', 'asc');
    }

    public function superior() {
        return $this->belongsTo("App\Models\Role");
    }

    public function letters() {
        return $this->hasMany("App\Models\Letter");
    }

    public function letterReceivers() {
        return $this->hasMany("App\Models\letterReceiver");
    }
}
