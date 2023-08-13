<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function identifier()
    {
        return $this->belongsTo(Identifier::class);
    }
}
