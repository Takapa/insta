<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;


    public function __construct(Comment $comment)
    {
        $this->comment = $comment;

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
    public function store($post_id, Request $request)
    {
        $request->validate([
            'comment_body' . $post_id => 'required|max:150'
        ],
        [
            'comment_body' . $post_id . '.required' => 'Cannot submit an empty comment',
            'comment_body' . $post_id . '.max'      => 'The comment must not be greater tha 150 characters.'

        ]);

        $this->comment->user_id = Auth::user()->id; //Who created the comment
        $this->comment->post_id = $post_id; //What post was commented
        // $this->comment->body    = $request->body; // What is the comment
        $this->comment->body    = $request->input('comment_body' . $post_id);
        $this->comment->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
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
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->comment->destroy($id);
        return redirect()->back();
    }
}
