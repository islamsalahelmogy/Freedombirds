<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

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
        $posts=Post::all();
        //dd(Auth::user());
        $user=Auth::user();
        $array = [];
       /* foreach($user->likes as $like){
            array_push($array,$like->pivot->post_id);
        }
        dd($array);*/
        return view('home',compact('posts','user'));
    }

    
}
