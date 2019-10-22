<?php

namespace App\Http\Controllers\web;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Comment;
use App\Http\Controllers\Controller;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'body' => ['required'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        $post = new Post;
        $post->user_id = $request->id;
        $post->body = $request->body;
        $post->save();
        return \redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $post = Post::find($request->post_id);
        $post->body = $request->body;
        $post->save();
        $time = $post->updated_at->diffForHumans();

        return response()->json(['post'=>$post,'time'=>$time]);

           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $r)
    {
        $post = Post::find($r->post_id);
        foreach($post->comments as $c) {
            $comment = Comment::find($c->id);
            $comment->delete();
        }
        $post->delete();
        return response()->json(['msg'=>"success"]);


    }
}
