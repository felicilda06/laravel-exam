<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MainController extends Controller
{
    public function index(){
        $announcement = Announcement::query()
          ->where('active', 1)
          ->orderBy('created_at', 'desc')
          ->get();

        return view('main', ['announcements'=> $announcement]);
    }
    public function signin(){
        if(Session::has('is_logged_in')){
            return redirect('/announcement');
        }

        return view('login');
    }
    public function signout(Request $req){
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/signin');
    }
    public function register(){
        return view('register');
    }
    public function login(Request $req){
        $validator = Validator::make($req->all(), [
            'username'=>'required',
            'password'=>'required'
        ]);

        if($validator->fails()){
            return response(['message'=>$validator->messages()], 400);
        }else{
            $user = DB::table('users')
            ->where('login_id', $req->username)
            ->get()
            ->first();

            if(!$user){
                return response(['message'=>'Login Id Not Found'], 400);
            }
            if($user->password === sha1($req->password)){
                $req->session()->put('is_logged_in', 1);
                return redirect('/announcement');
            }else{
                return response(['message'=>'Incorrect Password'], 400);
            }
        }
    }
    public function store(Request $req){
        $validator = Validator::make($req->all(), [
            'name'=>'required',
            'username'=>'required',
            'password'=>'required'
        ]);

        if($validator->fails()){
            return response(['message'=>$validator->messages()], 400);
        }else{
           try{
              $user = DB::table('users')
                ->insert([
                    'name'=>$req->name,
                    'login_id'=>$req->username,
                    'password'=>sha1($req->password)
              ]);
              return response(['message'=>'Account Created Successfully'], 200);
           }catch(err){
              return response(['message'=>err.message], 500);
           }
        }
    }
}
