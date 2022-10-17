<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function etudiant() {
        return $this->belongsTo(Etudiant::class);
    }

    public function module() {
        return $this->belongsTo(Modules::class);
    }
}
