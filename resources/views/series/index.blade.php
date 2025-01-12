<x-layout title="{{__('messages.app_name')}}">
    
    @auth
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth

    @isset($mensagemSucesso)
    <div class="alert alert-success">
        {{ $mensagemSucesso }}
    </div>
    @endisset

    <ul class="list-group">
        @foreach($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            @auth <a href="{{ route('seasons.index', $serie->id) }}"> @endauth
                {{$serie->nome}}
            @auth </a> @endauth
            @auth
            <span class='d-flex'>

                @method('GET')
                <a class="btn btn-warning btn-sm mr-3" href="{{ route('series.edit', $serie->id) }}">
                    Editar
                </a>
        
                <form action="{{ route('series.destroy', $serie->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        X
                    </button>
                </form>
            </span>
            @endauth
        </li>
        @endforeach
    </ul>

    <script>
        const series = {{ Js::from($series) }};
    </script>
</x-layout>