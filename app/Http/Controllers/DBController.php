<?php

namespace App\Http\Controllers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DBController extends Controller
{
    //
    static public function getSimbolo(string $id, string $value){
        if(Schema::hasTable(Auth::id())){
            $query = DB::table(Auth::id())->select()->where('IMDBid', '=', "$id")->get();
            if($query->first() != null){
                return $query->first()->$value;
            }
            else return 0;
        }
        else return 0;
    }

    static public function setValue(string $titolo, string $id, string $poster, string $value, int $val){
        $name = Auth::id();
        if(Schema::hasTable(Auth::id())){
            if(DB::table(Auth::id())->select('*')->where('IMDBid', '=', "$id")->get()->first() != null){
                DB::table(Auth::id())->where('IMDBid', '=', "$id")->update(["$value" => $val]);
            }
            else if($poster == 'null'){
                DB::table(Auth::id())->insert([
                    'IMDBid' => $id,
                    'titolo' => $titolo,
                    'poster' => null,
                    "$value" => $val
                ]);
            }
            else{
                DB::table(Auth::id())->insert([
                    'IMDBid' => $id,
                    'titolo' => $titolo,
                    'poster' => 'https://m.media-amazon.com/images/M/' . $poster,
                    "$value" => $val
                ]);
            }
        }
        else{
            Schema::create("$name", function (Blueprint $table) use ($titolo, $id, $poster, $value, $val) {
                $table->string('IMDBid')->primary();
                $table->string('titolo');
                $table->string('poster')->nullable();
                $table->boolean('visto')->default(false);
                $table->boolean('piace')->default(false);
                $table->boolean('watchlist')->default(false);
                $table->integer('rating')->default(0);

            });
            if($poster == 'null'){
                DB::table(Auth::id())->insert([
                    'IMDBid' => $id,
                    'titolo' => $titolo,
                    'poster' => null,
                    "$value" => $val
                ]);
            }
            else{
                DB::table(Auth::id())->insert([
                    'IMDBid' => $id,
                    'titolo' => $titolo,
                    'poster' => 'https://m.media-amazon.com/images/M/' . $poster,
                    "$value" => $val
                ]);
            }
        }
    }

    static public function getDB(string $value){
        if(Schema::hasTable(Auth::id())){
            return DB::table(Auth::id())->select()->where("$value", '=', 1)->get()->toArray();
        }
        else return [];
    }

    static public function getRating(string $id){
        if(Schema::hasTable(Auth::id())){
            $query = DB::table(Auth::id())->select('rating')->where("IMDBid", '=', "$id")->get()->first();
            if($query != null){
                return $query->rating;
            }
            else return 0;
        }
        else return 0;
    }

    static public function updateRating(string $id, int $rating){
        DB::table(Auth::id())->where('IMDBid', '=', "$id")->update(["rating" => $rating]);
    }

    static public function setPreferito(string $id){
        DB::table('users')->where('id', '=', Auth::id())->update(["preferito" => $id]);
        return redirect('/index');
    }
}
