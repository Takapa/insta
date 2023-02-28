<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUser extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function following(){
        return $this->hasMany(FollowUser::class,'follower_id');
    }
}
