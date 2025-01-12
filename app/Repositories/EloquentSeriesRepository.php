<?php

namespace App\Repositories;

use App\Models\Episode;
use App\Models\Series;
use App\Models\Season;
use App\Http\Requests\SeriesFormRequest;
use DB;

class EloquentSeriesRepository implements SeriesRepository {
    public function add(SeriesFormRequest $request): Series
    {
        //DB::beginTransaction(); //Substitui todo o DB::transaction. Tem a desvantagem de não trabalhar com deadlocks.
        
        return DB::transaction(function() use ($request) {

            $series = Series::create($request->all());
            $seasons = [];
            for ($i=1; $i <= $request->seasonsQty; $i++) {
                $seasons[] = [
                    'series_id' => $series->id,
                    'number' => $i
                ];
            }
            Season::insert($seasons);
    
            $episodes = [];
            foreach($series->seasons as $season) {
                for ($j=1; $j <= $request->episodesPerSeason; $j++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }    
            }
            Episode::insert($episodes);
            
            // DB::commit();
            // DB::rollback();
            
            return $series;
         }, 5); // Segundo parâmetro serve para desdlock. Caso ocorra, tenta-se executar a função novamente.

    }
}

?>