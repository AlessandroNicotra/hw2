<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class APIController extends Controller
{
    static public function search(string $id, int $page){
        $json = Http::get('https://www.omdbapi.com/?apikey=870862df&s=' . $id . '&type=movie&page=' . $page);
        return view('search')->with('json', json_decode($json, true));
    }

    static public function getMovie(string $id){
        return Http::get('https://www.omdbapi.com/?apikey=870862df&i=' . $id . '&plot=full')->json();
    }
}
