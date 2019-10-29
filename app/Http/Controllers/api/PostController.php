<?php

namespace App\Http\Controllers\api;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::with('comments','likes')->get(); //get all posts and relations in this step eager loading      
        return PostResource::collection($posts);
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
    public function store(PostRequest $request)
    {
        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->body = $request->body;
        $post->save();
        return response($post);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request,Post $post)
    {
       // return auth()->user();
        if ($post->user_id !== auth()->user()->id) return response()->json([
            'message'=>'not allowed'
        ],401);

        if(!is_null($request->body)){
           
            $post->body = $request->body;
            $post->update();
            return $post;
        }

        return response()->json([
            'data'=>$post
        ],200); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id==auth()->user()->id)
        {
        $post->delete();
        return "post deleted successfully";
        }
        else{
            return response()->json([
                'message'=>'not allowed'
            ],401);
        }
    }
}
