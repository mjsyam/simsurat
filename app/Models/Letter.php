<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function letterCategory()
    {
        return $this->belongsTo(LetterCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function signed()
    {
        return $this->belongsTo(User::class, "signed_id");
    }

    public function dispositions()
    {
        return $this->hasMany(Disposition::class);
    }

    public function letterReceivers()
    {
        return $this->hasMany(LetterReceiver::class);
    }

    public function identifier()
    {
        return $this->belongsTo(Identifier::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y H:i');
    }
}
