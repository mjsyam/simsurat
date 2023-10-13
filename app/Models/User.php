<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function userRoles()
    {
        return $this->belongsToMany(Role::class, UserRole::class)->orderBy('user_roles.created_at', 'desc');
    }

    public function letterReceivers()
    {
        return $this->hasMany(LetterReceiver::class);
    }

    public function letters()
    {
        return $this->hasMany(Letter::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, "model_has_roles", "model_id", "role_id");
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class, "model_has_roles", "model_id", "role_id");
    }

    public function Identifier()
    {
        return $this->belongsTo(Identifier::class);
    }

    public function dispositionTos()
    {
        return $this->hasMany(DispositionTo::class);
    }
}
