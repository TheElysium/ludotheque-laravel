@push('styles')
    <link href="{{ asset('resources/css/carte.css') }}" rel="stylesheet">
@endpush

<div class="carte card">
    <div class="card-body">
        <img src={{$jeu->url_media}} alt="$nom">
        <h5 class="card-title">{{$jeu->nom}}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{$jeu->editeur->nom}}</h6>
        <div class="d-flex p-2 bg-light">
            @foreach ($jeu->mecaniques as $t)
                <span class="tag badge badge-pill badge-primary">{{$t->nom}}</span>
            @endforeach
        </div>
    </div>
</div>