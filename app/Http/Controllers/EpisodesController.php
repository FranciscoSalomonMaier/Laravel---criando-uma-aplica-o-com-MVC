<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodesController {
    public function index(Season $season) {
        return view('episodes.index', 
            ['episodes' => $season->episodes],
            ['mensagemSucesso' => session('mensagem.sucesso')]
        );
    }

    public function update(Request $request, Season $season) {
        
        //Essa não é a melhor maneira de fazer
        $watchedEpisodes = $request->episodes;
        $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
            $episode->watched = in_array($episode->id, $watchedEpisodes);
        });

        $season->push(); // Salva as alterações nos relacionamentos da entidade em questão (no caso a Season)
        //Essa não é a melhor maneira de fazer

        return to_route('episodes.index', $season->id)->with(['mensagem.sucesso' => 'Episódios salvos com sucesso']);
    }

}

?>