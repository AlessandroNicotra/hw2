<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function logged(){
        if(Auth::check()){
            return redirect("/index");
        }
        else return view('accesso');
    }

    public function authenticate(Request $request){
        if(Auth::attempt($request->only('name', 'password'))){
            $request->session()->regenerateToken();
            return redirect("/index");
        }
        return back()->withErrors(['fail' => 'Username e/o Password non corretti']);
    }

    public function register(Request $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect('/index');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function validation(string $type, string $val){
        if($type == 'email'){
            if(filter_var($val, FILTER_VALIDATE_EMAIL)){
                $email = count(DB::table('users')->where('email', '=', $val)->get()->toArray());
                if($email == 0){
                    return "Email disponibile";
                }
                else{
                    return "Email già in uso";
                }
            }
            else return "Email non valida";
        }
        else{
            if(Str::length($val) < 4){
                return "Inserisci 4 o più caratteri";
            }
            else{
                $user = count(DB::table('users')->where('name', '=', $val)->get()->toArray());
                if($user == 0){
                    return "Username disponibile";
                }
                else{
                    return "Username già in uso";
                }
            }
        }
    }
}
