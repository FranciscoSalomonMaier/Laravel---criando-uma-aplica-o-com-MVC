<x-layout title="Temporadas de {!! $series->nome !!}">
    <ul class="list-group">
        @foreach($seasons as $season)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            
            <a href="{{ route('episodes.index', $season->number) }}">
                Temporada {{$season->number}}
            </a>

            <span class='badge bg-secondary'>
            Boa performance -> {{  $season->numberOfWatchedEpisodes() }} / Pouca perfomance -> {{ $season->episodes()->watched()->count() }} / {{ $season->episodes->count() }}
            </span> 
        </li>
        @endforeach
    </ul>

</x-layout>