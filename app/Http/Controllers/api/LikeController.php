<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Like;

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
        $check = Like::where(['user_id'=>auth()->user()->id,'post_id'=>$request->post_id])->get();
        if(count($check)>0)
        {
          $deleted=Like::where(['user_id'=>auth()->user()->id,'post_id'=>$request->post_id]);
          $deleted->delete();
            return response("dislike");
        }
       else
       {
        $like=new Like;
        $like->user_id=auth()->user()->id;
        $like->post_id=$request->post_id;
        $like->save();
        return response("liked");
       }
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
       /* $check = Like::where(['user_id'=>auth()->user()->id,'post_id'=>$like->post_id])->get();
        if(count($check)==0)
        {
            $like=new Like;
            $like->user_id=auth()->user()->id;
            $like->post_id=$request->post_id;
            $like->save();
            return response("liked");

        }
       else
       {
        return response()->json([
            'message'=>'no'
        ]);
       }*/
    }
}
