@extends('layout.app')

@push('styles')
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{asset('js/home.js')}}" defer="true"></script>
@endpush

@section('title')
    <title>HW2</title>
@endsection

@php($piace = \App\Http\Controllers\DBController::getDB('piace'))
@php($visti = \App\Http\Controllers\DBController::getDB('visto'))
@php($watchlist = \App\Http\Controllers\DBController::getDB('watchlist'))

@section('content')
    @include('inc.navbar')
    <div class="wrapper">
        <div id="profilo">
            <div class="back">
                <p class="back">></p>
            </div>
            <p class="text">Benvenuto {{ Auth::user()->name }}!</p>
            @if( Auth::user()->preferito == null )
                <a href="/lista/preferito" class="add_fav">AGGIUNGI UN FILM PREFERITO ></a>
            @else
                @php($film = \App\Http\Controllers\APIController::getMovie(Auth::user()->preferito))
                <p class="text">Film Preferito:</p>
                <a class="text">{{$film['Title']}}</a>
                <div class="locandina_p">
                    <a href="/result/{{$film['imdbID']}}"></a>
                    @if($film['Poster'] == 'N/A')
                        <p>{{$film['Title']}}</p>
                    @else
                        <img src='{{$film['Poster']}}'>
                    @endif
                </div>
                <a href="/lista/preferito" class="add_fav">CAMBIA PREFERITO ></a>
            @endif
            <a class="logout" href="{{ route('logout') }}">LOGOUT</a>
        </div>

        <div id="aggiunti">
            <div class="menu">
                <div class="d_menu">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <span>PREFERITO</span>
            </div>
            <div class="like">
                <a href="/lista/piace" class="lista">Film piaciuti ></a>
                @if(count($piace) == 0)<p class="new">Nessun Film aggiunto a questa lista</p>
                @else
                    <div class="locandine">
                        @if(count($piace) < 5)
                            @php($limit = count($piace))
                        @else
                            @php($limit = 5)
                        @endif
                        @for($i = 0; $i < $limit; $i++)
                            <div class="locandina" id="film_{{$i+1}}">
                                <a href = "/result/{{$piace[$i]->IMDBid}}"></a>
                                @if($piace[$i]->poster == null)
                                    <p class="titolo">{{$piace[$i]->titolo}}</p>
                                @else
                                    <img src="{{$piace[$i]->poster}}">
                                @endif
                                <div class="rating_overlay" id="{{$piace[$i]->IMDBid}}" title="{{$piace[$i]->rating}}">
                                    <span class="stella" id="1" title="">&#9734;</span>
                                    <span class="stella" id="2" title="">&#9734;</span>
                                    <span class="stella" id="3" title="">&#9734;</span>
                                    <span class="stella" id="4" title="">&#9734;</span>
                                    <span class="stella" id="5" title="">&#9734;</span>
                                </div>
                            </div>
                        @endfor
                            </div>
                @endif
            </div>

            <div class="visti">
                <a href="/lista/visto" class="lista">Film visti ></a>
                @if(count($visti) == 0)<p class="new">Nessun Film aggiunto a questa lista</p>
                @else
                    <div class="locandine">
                        @if(count($visti) < 5)
                            @php($limit = count($visti))
                        @else
                            @php($limit = 5)
                        @endif
                        @for($i = 0; $i < $limit; $i++)
                            <div class="locandina" id="film_{{$i+1}}">
                                <a href = "/result/{{$visti[$i]->IMDBid}}"></a>
                                @if($visti[$i]->poster == null)
                                    <p class="titolo">{{$visti[$i]->titolo}}</p>
                                @else
                                    <img src="{{$visti[$i]->poster}}">
                                @endif
                                <div class="rating_overlay" id="{{$visti[$i]->IMDBid}}" title="{{$visti[$i]->rating}}">
                                    <span class="stella" id="1" title="">&#9734;</span>
                                    <span class="stella" id="2" title="">&#9734;</span>
                                    <span class="stella" id="3" title="">&#9734;</span>
                                    <span class="stella" id="4" title="">&#9734;</span>
                                    <span class="stella" id="5" title="">&#9734;</span>
                                </div>
                            </div>
                        @endfor
                    </div>
                @endif
            </div>

            <div class="watch">
                <a href="/lista/watchlist" class="lista">Watchlist ></a>
                @if(count($watchlist) == 0)<p class="new">Nessun Film aggiunto a questa lista</p>
                @else
                    <div class="locandine">
                        @if(count($watchlist) < 5)
                            @php($limit = count($watchlist))
                        @else
                            @php($limit = 5)
                        @endif
                        @for($i = 0; $i < $limit; $i++)
                            <div class="locandina" id="film_{{$i+1}}">
                                <a href = "/result/{{$watchlist[$i]->IMDBid}}"></a>
                                @if($watchlist[$i]->poster == null)
                                    <p class="titolo">{{$watchlist[$i]->titolo}}</p>
                                @else
                                    <img src="{{$watchlist[$i]->poster}}">
                                @endif
                                <div class="rating_overlay" id="{{$watchlist[$i]->IMDBid}}" title="{{$watchlist[$i]->rating}}">
                                    <span class="stella" id="1" title="">&#9734;</span>
                                    <span class="stella" id="2" title="">&#9734;</span>
                                    <span class="stella" id="3" title="">&#9734;</span>
                                    <span class="stella" id="4" title="">&#9734;</span>
                                    <span class="stella" id="5" title="">&#9734;</span>
                                </div>
                            </div>
                        @endfor
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
