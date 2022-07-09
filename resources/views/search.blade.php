@extends('layout.app')

@push('styles')
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
    <link href="{{asset('css/search.css')}}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{asset('js/search.js')}}" defer="true"></script>
@endpush

@section('title')
    <title>HW2 - Ricerca</title>
@endsection

@section('content')
    @include('inc.navbar')
    <div id="wrapper">
        <div class="risultati" id = "{{request()->route('id')}}">
            @if($json['Response'] == 'False')
                <h1 id="errore">@if($json['Error'] == 'Too many results.') Inserisci più di 3 caratteri
                                @else {{$json['Error']}}
                                @endif</h1>
            @else
                @foreach($json['Search'] as $movie)
                    <a href="/result/{{$movie['imdbID']}}" class="risultato">
                        @if($movie['Poster'] != 'N/A')
                            <img class="ris_img" src="{{$movie['Poster']}}">
                        @else
                            <p>{{$movie['Title']}}</p>
                        @endif
                    </a>
                @endforeach
        </div>
        <div class="pagine">
            <p class="prev"><</p>
            <p class="currpage">{{request()->route('page')}}</p>
            <p>/</p>
            <p class="maxpage">{{ceil($json['totalResults'] / 10)}}</p>
            <p class="next">></p>
        </div>
            @endif
    </div>
@endsection
