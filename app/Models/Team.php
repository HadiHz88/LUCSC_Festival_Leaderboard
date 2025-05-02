<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'points',
        'wins',
        'games_played',
    ];

    public function winPercentage(): float|int
    {
        return $this->games_played > 0 ? $this->wins / $this->games_played : 0;
    }
}
