<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Post;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return new UserResource(auth()->user()->load('posts.comments', 'posts.likes'));
       //$user=Auth::user()::with(['posts.comments'])->get(); 
         //return ($user);
         $user=Auth::user();
        return view('profile.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
      $user=Auth::user();
      return view('profile.edit',compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user=Auth::user();
        
        if($request->name != null || $request->name != $user->name)
        {
            $user->name=$request->name;
        }
        if($request->bio != null || $request->bio != $user->bio)
            $user->bio=$request->bio;
        $user->save();
        return \redirect(route('profile'));
        
        
    }


    public function editpassword() {

        return view('profile.changepass');

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'oldpassword' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function updatepassword(Request $r) {
        $user=Auth::user();
        $this->validator($r->all())->validate();
        if(Hash::check($r->oldpassword, $user->password))
        { 
             $user->password=Hash::make($r->password);
             $user->save();
             Auth::logout();
             return redirect("login");
        }
        else {
                return redirect(route('changepass'))->withInput($r->all())
                ->withErrors(['message' => 'invalid password']);
             }
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
