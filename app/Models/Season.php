<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Episode;
use App\Models\Series;

class Season extends Model
{
    use HasFactory;
    protected $fillable = ['number'];

    // Uma Season pertence a uma Series (Series é singular em inglês, Serie em inglês também é singular)
    public function series()
    {
        return $this->belongTo(Serie::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function numberOfWatchedEpisodes()
    {
        return $this->episodes->filter(fn ($episode) => $episode->watched)->count();
    }
    
}
