<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function identifiers()
    {
        return $this->belongsToMany(Identifier::class, UserIdentifier::class)->orderBy('user_identifiers.created_at', 'desc');
    }

    public function dispositionTos()
    {
        return $this->hasMany(DispositionTo::class);
    }
}
