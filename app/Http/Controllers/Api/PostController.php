<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post=Post::with(['user','category'])->get();
        $posts=PostResource::collection($post);
        return $this->apiResponse($posts,'ok',200);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'body'=>'required|string',
            'user_id'=>'required|exists:users,id',
            'category_id'=>'required|exists:categories,id',
            
        ]);

        $post=Post::create([
          'title'=>$request->title,
          'body'=>$request->body,
          'user_id'=>Auth::id(),
          'category_id'=>$request->category_id,

        ]);

        if($post){
            return $this->apiResponse(new PostResource($post),'The Post Added',201);
            }
             
            return $this->apiResponse(null,'The Post Not Save',400);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post=Post::with(['category','comments'])->find($id);     

        if($post){
        return $this->apiResponse(new PostResource($post),'ok',200);
        }
         
        return $this->apiResponse(null,'The Post Not Found',404);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'body'=>'required|string',
            'category_id'=>'required|category:user,id',
            
        ]);

        $post=Post::find($id);
        if(!$post){
            return $this->apiResponse(null,'The Post Not Found',404);
        }

        if($post->user_id !== Auth::id()){
            return $this->apiResponse(null,'Unauthorized',403);
   
        }
        $post->update($request->only(['title','body','category_id']));
        return $this->apiResponse(new PostResource($post),'The Post Updated',201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post=Post::find($id);

        if(!$post){
            return $this->apiResponse(null,'The Post Not Found',404);
        }

        if($post->user_id !== Auth::id()){
            return $this->apiResponse(null,'Unauthorized',403);
   
       }
        $post->delete();
        return $this->apiResponse(new PostResource($post),'The Post Deleted',201);



    }
}
