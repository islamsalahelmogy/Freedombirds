<?php

namespace App\Http\Controllers\web;

use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $id = Auth::id();
        $post_id =$request->post_id;
        //dd(Like::where(['user_id'=>$id,'post_id'=>$post_id])->get());
        $like = Like::where(['user_id'=>$id,'post_id'=>$post_id])->get();
        if(count($like) > 0) {
            $flag = 0;
            $delete = Like::where(['user_id'=>$id,'post_id'=>$post_id])->delete();
        }else {
            $like = new Like ;
            $like->user_id = $id;
            $like->post_id = $post_id;
            $like->save();
            $flag = 1 ;
        }
        $post = Post::find($post_id);
        $count = count($post->likes);
        return response()->json(['count'=>$count,'flag'=>$flag]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
    }
}
