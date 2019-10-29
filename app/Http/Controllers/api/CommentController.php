<?php

namespace App\Http\Controllers\api;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;

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
    public function store(CommentRequest $request)
    {
        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->post_id=$request->post_id;
        $comment->text = $request->text;
        $comment->save();
        return response($comment);
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
    public function update(CommentRequest $request, Comment $comment)
    {
        
        if ($comment->user_id !== auth()->user()->id) return response()->json([
            'message'=>'not allowed'
        ],401);

        if(!is_null($request->text)){
           
            $comment->text = $request->text;
            $comment->update();
            return $comment;
        }

        return response()->json([
            'data'=>$comment
        ],200); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
       
        if($comment->user_id==auth()->user()->id)
        {
        $comment->delete();
        return "comment deleted successfully";
        }
        else{
            return response()->json([
                'message'=>'not allowed'
            ],401);
        }
    }
}
