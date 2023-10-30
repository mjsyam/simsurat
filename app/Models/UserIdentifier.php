<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIdentifier extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'identifier_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function identifier()
    {
        return $this->belongsTo(Identifier::class);
    }
}
