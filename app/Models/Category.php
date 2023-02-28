<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $guarded = []; //ブラックリストにするものはないという意味
    //OR public $fillable = ['name']; 

    public function categoryPost()
    {
        return $this->hasMany(CategoryPost::class);
    }
}

