<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispositionInformation extends Model
{
    use HasFactory;
    protected $fillable = ['disposition_id', 'information_id'];

    public function information()
    {
        return $this->belongsTo(Information::class);
    }

    public function disposition()
    {
        return $this->belongsTo(Disposition::class);
    }
}
