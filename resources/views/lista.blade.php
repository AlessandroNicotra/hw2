@extends('layout.app')

@push('styles')
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
    <link href="{{asset('css/search.css')}}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{asset('js/lista.js')}}" defer="true"></script>
@endpush

@if(request()->route('type') == 'preferito')
    @php($lista = \App\Http\Controllers\DBController::getDB('piace'))
@else
    @php($lista = \App\Http\Controllers\DBController::getDB(request()->route('type')))
@endif

@section('title')
    <title>HW2 - {{ucfirst(request()->route('type'))}}</title>
@endsection

@section('content')
    @include('inc.navbar')
    <div id="wrapper">
        <h1>@switch(request()->route('type'))
                @case('watchlist')
                    WATCHLIST
                    @break
                @case('piace')
                    FILM PIACIUTI
                    @break
                @case('visto')
                    FILM VISTI
                    @break
                @case('preferito')
                    AGGIUNGI PREFERITO
                    @break
            @endswitch
        </h1>
        <div class="risultati">
            @if(count($lista) == 0)
                <h1 id="errore">NESSUN FILM IN QUESTA LISTA</h1>
            @else
                @foreach($lista as $movie)
                    <div class="risultato">
                        <a href="@if(request()->route('type') == 'preferito')
                                    /setfav/{{$movie->IMDBid}}
                                 @else
                                    /result/{{$movie->IMDBid}}
                                 @endif">
                        </a>
                        @if($movie->poster != null)
                            <img class="ris_img" src="{{$movie->poster}}">
                        @else
                            <p>{{$movie->titolo}}</p>
                        @endif
                        @if(request()->route('type') != 'preferito')
                            <div class="rating_overlay" id="{{$movie->IMDBid}}" title="{{$movie->rating}}">
                                <span class="stella" id="1" title="">&#9734;</span>
                                <span class="stella" id="2" title="">&#9734;</span>
                                <span class="stella" id="3" title="">&#9734;</span>
                                <span class="stella" id="4" title="">&#9734;</span>
                                <span class="stella" id="5" title="">&#9734;</span>
                            </div>
                        @endif
                    </div>
                @endforeach
        </div>
        @endif
    </div>
@endsection
