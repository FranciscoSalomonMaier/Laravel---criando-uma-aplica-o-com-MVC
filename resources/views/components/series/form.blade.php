<form action="{{ $action }}" method="post">
    <!-- route('series.update', $series->id) -->
    @csrf
    
    @if($update)
    @method('PUT')
    @endif

    <div class="mb-3">
    <label for="nome" class="form-label">Nome:</label>
    <input type="text" 
            id="nome"
            name="nome" 
            class="form-control"
            @isset($nome) value="{{ $nome }}" @endisset>
    <button type="submit" class="btn btn-success mt-3">Salvar</button>
    </div>
</form>