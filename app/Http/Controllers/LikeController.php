<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    private $like;
    private $post;

    public function __construct(Like $like, Post $post)
    {
        $this->like = $like;
        $this->post = $post;

    }
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

    // public function store(Post $post, Request $request, $post_id)
    // {
    //     //
    //     $like = New Like();

    //     $like->user_id = Auth::user()->id;
    //     $like->post_id = $post_id;
    //     $like->save();
    //     return redirect()->back();
    // }

    public function store(Request $request)
    {
        //
        $this->like->user_id = Auth::user()->id;
        $this->like->post_id = $request->post_id;
        $this->like->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Like  $like
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
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */

    // public function destroy($id)
    // {
    //     $this->like->destroy($id);
    //     return redirect()->back();
    // }

    public function destroy($post_id)
    {
        //

        $this->like
            ->where('user_id', Auth::user()->id)
            ->where('post_id', $post_id)
            ->delete();

        return redirect()->back();
    }

}
