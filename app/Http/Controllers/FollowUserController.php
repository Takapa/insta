<?php

namespace App\Http\Controllers;

use App\Models\FollowUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowUserController extends Controller
{
    private $followUser;

    public function __construct(FollowUser $followUser)
    {
        $this->followUser = $followUser;
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
    public function store(Request $request)
    {
        //
        $this->followUser->follower_id = Auth::user()->id;
        $this->followUser->following_id = $request->following_id;

        $this->followUser->save();

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FollowUser  $followUser
     * @return \Illuminate\Http\Response
     */
    public function show(FollowUser $followUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FollowUser  $followUser
     * @return \Illuminate\Http\Response
     */
    public function edit(FollowUser $followUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FollowUser  $followUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FollowUser $followUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FollowUser  $followUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->followUser->where('follower_id',Auth::user()->id)->where('following_id',$id)->delete();

        return redirect()->back();
    }
}
