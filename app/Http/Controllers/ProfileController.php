<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    private $user;
    const LOCAL_STORAGE_FOLDER = 'public/avatars/';

    public function __construct(User $user){
        $this->user = $user;
    }

    public function show($id){
        $user = $this->user->findOrFail($id);
        $following_users = $this->getFollowingUser();
        $followed_users  = $this->getFollowedUser();

        return view('users.profile.show')
            ->with('user', $user)
            ->with('following_users', $following_users)
            ->with('followed_users', $followed_users);
    }

    public function getFollowingUser(){
        $all_users  = User::all()->except(Auth::user()->id);
        $following_users = [];

        foreach($all_users as $user){
            if($user->isFollowed()){
                $following_users[] = $user;
            }
        }
        return $following_users;
    }

    public function getFollowedUser(){
        $all_users  = User::all()->except(Auth::user()->id);
        $followed_users = [];

        foreach($all_users as $user){
            if($user->isFollowing()){
                $followed_users[] = $user;
            }
        }
        return $followed_users;
    }

    public function edit($id){
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.profile.edit')->with('user', $user);
    }


    // public function update(Request $request)
    // {
    //     $user                = $this->user->findOrFail(Auth::user()->id);
    //     $user->name          = $request->name;
    //     $user->email         = $request->email;
    //     $user->introduction  = $request->introduction;

    //     if($request->avatar){

    //         if($user->avatar)
    //         {
    //             $this->deleteAvatar($user->avatar);
    //         }
            
    //         $user->avatar = $this->saveAvatar($request);
    //     }        

    //     $user->save();
    //     // return redirect()->route('profile.show');
    //     return view('users.profile.show')->with('user', $user);
    // }

    public function update(Request $request, $id)
    {
        $user                = $this->user->findOrFail(Auth::user()->id);
        // $user                = $this->user->findOrFail($id); でも動く
        $user->name          = $request->name;
        $user->email         = $request->email;
        $user->introduction  = $request->introduction;
    
        if($request->avatar){
            if($user->avatar)
            {
                $this->deleteAvatar($user->avatar);
            }
                
            $user->avatar = $this->saveAvatar($request);
        }        
    
        $user->save();
        return redirect()->route('profile.show', $id);
    }


    public function saveAvatar($request){
        $avatar_name = time().".".$request->avatar->extension();
        $request->avatar->storeAs(self::LOCAL_STORAGE_FOLDER,$avatar_name);

        return $avatar_name;
    }

    public function deleteAvatar($avatar_name){
        $avatar_path = self::LOCAL_STORAGE_FOLDER.$avatar_name;

        if(Storage::disk('local')->exists($avatar_path)):
            Storage::disk('local')->delete($avatar_path);
        endif;


    }

}
