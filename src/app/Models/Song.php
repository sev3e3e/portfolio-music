<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description", "user_id"];

    public function creators(): BelongsToMany
    {
        return $this->belongsToMany(Creator::class);
    }
}
