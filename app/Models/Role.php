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
}
