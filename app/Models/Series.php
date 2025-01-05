<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Series;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];
    
    
    //protected $with = ['seasons']; É possível configurar para a model sempre usar a função ao ser acessada.


    //Um série possui muitas seasons
    public function seasons()
    {
        return $this->hasMany(Season::class, 'series_id'); //Especifica a chave estrangeira na tabela Season. O terceiro parâmetro indica a chave ao qual a chave estrangeira na model Season deve referenciar na model Serie
    }

    //Função que aplica um escopo global da model.
    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('nome');
        });
    }

    // Há outras formas de manipular o escopo global da model, desde que passe o query builder como parâmetro
    // #EXEMPLO:
    // public function scopeActive(Builder $query)
    // {
    //     return $query->where('active', true);
    // }
    // Ao chamar o método se usa o método active()
    // #EXEMPLO:
    // $series = SERIE::active();

}
