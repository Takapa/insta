<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private $post;
    private $category;
    const LOCAL_STORAGE_FOLDER = 'public/images/';

    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
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
        $all_categories = Category::all();
        return view('users.posts.create')->with('all_categories',$all_categories);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'category'    => 'required|array|between:1,3',
        //     'description' => 'required|min:1|max:1000'
        // ]);

        #save the post
        $this->post->user_id = Auth::id();
        $this->post->image = $this->saveImage($request);
        $this->post->description = $request->description;
        $this->post->save();

        foreach($request->category as $category_id):
            $category_post[] = ["category_id"=>$category_id];
        endforeach;

       $this->post->categoryPost()->createMany($category_post);

        // 例）もし1.Travelと3.Foodを選択したら
        // $request->category = ["1=>Travel", "2=>Food"]
        // $category_post[] = ["category_id"=>$category_id]; はつまり $category_postのarrayが["category_id"=>'1', "category_id"=>'3']
        // $this->post->categoryPost()->createMany($category_post);　はcategoryPostに全てのcategory_postを生成する

    
       return redirect()->route('index');

    }
    
    public function saveImage($request){
        $image_name = time().".".$request->image->extension();
        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER,$image_name);

        return $image_name;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        // $like = Like::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first();
        return view('users.posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $all_categories = $this->category->all();
        $selected_categories  = [];

        foreach($post->categoryPost as $category_post):
            $selected_categories[] = $category_post->category_id;
        endforeach;

        return view('users.posts.edit')
                ->with('post',$post)
                ->with('all_categories',$all_categories)
                ->with('selected_categories',$selected_categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $request->validate([
            'category'    => 'required|array|between:1,3',
            'description' => 'required|min:1|max:1000'
        ]);

        $post->description = $request->description;

        if($request->image){
            $this->deleteImage($post->image);

            $post->image = $this->saveImage($request);
        }
        $post->save();

        $post->categoryPost()->delete();

        foreach($request->category as $category_id):
            $category_post[] = ["category_id"=>$category_id];
        endforeach;

       $post->categoryPost()->createMany($category_post);

       return redirect()->route('post.show',$post);

    }

    public function deleteImage($image_name){
        $image_path = self::LOCAL_STORAGE_FOLDER.$image_name;

        if(Storage::disk('local')->exists($image_path)):
            Storage::disk('local')->delete($image_path);
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->categoryPost()->delete();
        $post->delete();
        $this->deleteImage($post->image);

        return redirect()->route('index');
    }
}
