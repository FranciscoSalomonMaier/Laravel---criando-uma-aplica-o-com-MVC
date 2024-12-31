<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use DB;

class SeriesController extends Controller
{
    public function index() 
    {
        //$series = DB::select('SELECT nome FROM series'); //retorna um objeto
        $series = Serie::query()->orderBy('nome')->get(); // Retorna uma collection

        return view('series.index')->with('series', $series);

    }

    public function create() 
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $nomeSerie = $request->input('nome');
        //DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie]);

        $serie = new Serie();
        $serie->nome = $nomeSerie;
        $serie->save();

        return redirect('series');
    }
}
