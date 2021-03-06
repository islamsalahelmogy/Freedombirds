<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('Authentication');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$posts=Post::all();   // 1
        $posts=Post::orderBy('updated_at', 'desc')->get();  //good 2
        //dd(Auth::user());
        //$posts=DB::table('posts')->orderBy('updated_at','desc')->get();
        //dd($posts);
        $user=Auth::user();
        $array = [];
       /* foreach($user->likes as $like){
            array_push($array,$like->pivot->post_id);
        }
        dd($array);*/
        return view('home',compact('posts','user'));
    }

    
}
