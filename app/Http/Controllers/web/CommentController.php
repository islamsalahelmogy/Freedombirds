<?php

namespace App\Http\Controllers\web;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class CommentController extends Controller
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

        $comment = new Comment;
        $comment->post_id = $request->post_id;
        $comment->text = $request->text;
        $comment->user_id = Auth::id();
        $comment->save();
        $image_url = $comment->user->image_url;
        $commcount=Post::find($request->post_id)->comments->count();
        $user = Auth::user();
        $total = count($user->comments);
        
        return response()->json(['comment'=>$comment,'ccounter'=>$commcount,'totalComment'=>$total,'image'=>$image_url]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         if($request->ajax()) {
            $comment = Comment::find($request->id);
            $comment->text = $request->text;
            $comment->save();
            return response()->json(['comment'=>$comment],200);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->ajax()) {
            $comment = Comment::find($request->id);
            $comment->delete();
            return response()->json(['msg'=>"success"],200);
        }
        
    }
}
