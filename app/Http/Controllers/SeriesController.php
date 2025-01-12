<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{

    public function __construct(private SeriesRepository $repository)
    {
        $this->middleware(Autenticador::class)->expect('index');
    }

    public function index(Request $request) 
    {
        $series = Series::query()->get();
        $mensagemSucesso = session("mensagem.sucesso");
        
        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);

    }

    public function create() 
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, SeriesRepository $repository)
    {
        
        $series = $repository->add($request);

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
    }

    public function destroy(Series $series, Request $request) 
    {    
        $series->delete();
        return to_route('series.index')->with('mensagem.sucesso', "Série '{ $series->nome }' removida com sucesso");
    }
}
