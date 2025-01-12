<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Season;

class Episode extends Model
{
    use HasFactory;
    protected $fillable = ['number'];
    public $timestamps = false;

    //Um episódio pertence a uma temporada
    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function scopeWatched(Builder $query)
    {
        return $query->where('watched', true);
    }
}
