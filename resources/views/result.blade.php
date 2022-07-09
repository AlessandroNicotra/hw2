@extends('layout.app')

@php($movie = (\App\Http\Controllers\APIController::getMovie(request()->route('id'))))
@php($visto_s = \App\Http\Controllers\DBController::getSimbolo($movie['imdbID'], 'visto'))
@php($piace_s = \App\Http\Controllers\DBController::getSimbolo($movie['imdbID'], 'piace'))
@php($watchlist_s = \App\Http\Controllers\DBController::getSimbolo($movie['imdbID'], 'watchlist'))

@push('styles')
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
    <link href="{{asset('css/result.css')}}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{asset('js/result.js')}}" defer="true"></script>
@endpush

@section('title')
    <title> HW2 - {{$movie['Title']}}</title>
@endsection

@section('content')
    @include('inc.navbar')
    <div class="ris">
        <div id="{{$movie['imdbID']}}" class="movie">
            <div class="poster">
                @if($movie['Poster'] == 'N/A')
                    <p class="titolo">{{$movie['Title']}}</p>
                @else
                    <img class="poster" src="{{$movie['Poster']}}">
                @endif
            </div>

            <div class="user">
                <div class="rate">
                    <div class="stelle" id = "{{\App\Http\Controllers\DBController::getRating($movie['imdbID'])}}">
                        <span class="stella" id="1">&#9734;</span>
                        <span class="stella" id="2">&#9734;</span>
                        <span class="stella" id="3">&#9734;</span>
                        <span class="stella" id="4">&#9734;</span>
                        <span class="stella" id="5">&#9734;</span>
                    </div>
                    <p>VOTA</p>
                </div>
                <div class="buttons">
                    <div class="button" id="visto">
                        <span id="{{$visto_s}}" class="simbolo">@if($visto_s)&#9733;@else&#9734;@endif</span>
                        <span>Visto</span>
                    </div>
                    <div class="button" id="like">
                        <span id="{{$piace_s}}" class="simbolo">@if($piace_s)&#9829;@else&#9825;@endif</span>
                        <span>Like</span>
                    </div>
                    <div class="button" id="watchlist">
                        <span id="{{$watchlist_s}}" class="simbolo">@if($watchlist_s)&#9745;@else&#9746;@endif</span>
                        <span>Watchlist</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="text">
            <span class="titolo">{{$movie['Title']}}</span>
            <span class="anno">{{$movie['Year']}}</span>
            <span class="regista">Regista: {{$movie['Director']}}</span>
            <span class="durata">Durata: {{$movie['Runtime']}}</span>
            <span class="plot">{{$movie['Plot']}}</span>
            <div class="ratings">
                <span class="rate">RATINGS</span><br>
                <span class="rotten">Rotten Tomatoes: @if(count($movie['Ratings']) > 1)
                                                         {{$movie['Ratings'][1]['Value']}}
                                                     @else
                                                         N/A
                                                     @endif</span>
                <span class="imdb">IMDB: {{$movie['imdbRating']}}</span>
                <span class="meta">Metacritic: {{$movie['Metascore']}}</span>
            </div>
        </div>
    </div>
@endsection
