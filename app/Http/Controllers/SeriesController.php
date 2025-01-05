<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Series;
use App\Models\Season;
use DB;

class SeriesController extends Controller
{
    public function index(Request $request) 
    {
        //$series = DB::select('SELECT nome FROM series'); //retorna um objeto
        $series = Series::query()->get(); // Retorna uma collection

        $mensagemSucesso = session("mensagem.sucesso"); // equivalente -> $request->session()->get("mensagem.sucesso");
        // $request->session()->forget("mensagem.sucesso"); //Usado quando é requisitada a mensagem da session pelo método put
        
        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);

    }

    public function create() 
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        
        $series = Series::create($request->all());
        $seasons = [];
        for ($i=1; $i <= $request->seasonsQty; $i++) {
            // $season = $series->seasons()->create([
            //     'number' => $i,
            // ]);

            $seasons[] = [
                'series_id' => $series->id,
                'number' => $i
            ];
        }
        Season::insert($seasons);

        $episodes = [];
        foreach($series->seasons as $season) {
            for ($j=1; $j <= $request->episodesPerSeason; $j++) {
                // $season->episodes()->create([
                //     'number' => $j
                // ]);
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $j
                ];
            }    
        }
        Episode::insert($episodes);

        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' adicionada com sucesso");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('series', $series);
    }

    public function update(Series $series, Request $request) 
    {        
        $series->update($request->all());
        $series->save();
        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' atualizada com sucesso");

        // Tanto para enviar à view quanto para adicionar dados na session como flash, além de ->with('campo', 'valor'); podemos usar a sintaxe withCampo('valor');. Ambos são equivalentes.
        // Já o método ->withMensagemSucesso('Mensagem'); seria equivalente a ->with('mensagem_sucesso', Mensagem'); (repare no _).
    }

    // Ao definir o parâmetro id com o tipo ao qual ele referencia na tabela, ele retorna a própria coleção.
    // /series/destroy/{series}
    public function destroy(Series $series, Request $request) 
    {    
        $series->delete();
        //session('mensagem.sucesso'); quivalente -> $request->session()->put('mensagem.sucesso', 'Série removida com sucesso');
        //$request->session()->flash('mensagem.sucesso', "Série '{ $series->nome }' removida com sucesso");

        return to_route('series.index')->with('mensagem.sucesso', "Série '{ $series->nome }' removida com sucesso");
    }
}
