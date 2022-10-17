<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function note() {
        return $this->hasMany(Note::class);
    }
    public function Niveau() {
        return $this->belongsTo(App\Models\Niveau::class);
    }
}
