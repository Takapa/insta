<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Like;
use App\Models\FollowUser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $post;
    private $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        $this->middleware('auth');
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $all_posts = Post::query()->whereIn('user_id', Auth::user()->following()->pluck('following_id'))->latest()->get();
        // $all_users = User::latest()->get()->except(Auth::user()->id);


        $all_posts = Post::latest()->get();
        $home_post = [];
        $suggested_users = $this->getSuggestedUser();
        foreach($all_posts as $post){
            if($post->user->isFollowed() || $post->user->id === Auth::id()){
                $home_post[] = $post;
            }
        }

        return view('users.home')
        ->with('all_posts', $home_post)
        ->with('suggested_users', $suggested_users);
    }

    //following()->pluck('following_id') フォロワーのみ
    //following()->pluck('follower_id')  自分のみ

    //followers()->pluck('follower_id') 自分以外＋フォロー機能反応しない
    //followers()->pluck('following_id') 自分のみ


    public function getSuggestedUser(){
        $all_users  = User::all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach($all_users as $user){
            if(!$user->isFollowed()){
                $suggested_users[] = $user;
            }
        }
        return $suggested_users;
    }

}
 
