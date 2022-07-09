@extends('layout.app')

@push('styles')
    <link href="{{asset('css/login.css')}}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{asset('js/login.js')}}" defer="true"></script>
    <script src="{{asset('js/index.js')}}" defer="true"></script>
@endpush

@section('title')
    <title>HW2</title>
@endsection

@section('content')
    <div class="no_session">
        <div id="button">
            <a href="/" id="logo">HW2</a>
            @if($errors->any())
                <p>{{$errors->first()}}</p>
            @endif
            <button class="log">ACCEDI</button>
            <button class="reg">REGISTRATI</button>
        </div>
        <form class="registra" action="/register" id="registra" method="post">
            @csrf
            <nav>
                <a href="/" id="logo">HW2</a>
                <p>REGISTRAZIONE</p>
            </nav>
            <wrap>
                <input class="user_log" type="text" placeholder="Utente" name="name" id="name">
                <p id="user_check"></p>
                <input class="email_log" type="text" placeholder="Email" name="email" id="email">
                <p id="email_check"></p>
                <input type="password" placeholder="Password" name="password" id="password">
                <input type="password" placeholder="Conferma Password" id="conpass">
                <input type="submit" value="REGISTRATI" class="invalidf" id="submit_r" disabled>
                <div id="password">
                    <strong>La password deve contenere:</strong>
                    <p id="car">- 8 caratteri</p>
                    <p id="mai">- Una lettera maiuscola</p>
                    <p id="min">- Una lettera minuscola</p>
                    <p id="num">- Un numero</p>
                    <p id="spe">- Un carattere speciale</p>
                </div>
                <div id="account">
                    <p id="log">Hai già un account? Clicca qui!</p>
                </div>
            </wrap>
        </form>

        <form action="/authenticate" class="login" method="post">
            @csrf
            <nav>
                <a href="/" id="logo">HW2</a>
                <p>LOGIN</p>
            </nav>
            <input type="text" placeholder="Utente" name="name" id="name">
            <input type="password" placeholder="Password" name="password" id="password">
            <input type="submit" value="ACCEDI">
            <div id="account">
                <p id="reg">Non hai un account? Clicca qui!</p>
            </div>
        </form>

    </div>
@endsection
