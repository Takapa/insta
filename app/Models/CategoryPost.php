<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;
    protected $table = 'category_post'; //category_postというテーブルがモデルと結びついた設定になります。モデルのtableプロパティを定義し、カスタムテーブル名を指定することが可能。
    protected $fillable = ['category_id','post_id']; //fillable ⇄ guarded　つまり'category_id'と'post_id'の受け入れを許可する
    public $timestamps = false; //timestampsはcreated_atカラムとupdated_atカラムを自動で作る。そして作成時、更新時にそれぞれ更新する。
    //テーブルによってはcreated_atだけが必要だったり、あるいは両方ともいらないみたいな場面がある。falseとすれば排除できる。

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
