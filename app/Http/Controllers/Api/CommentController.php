<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;


class CommentController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $comment=Comment::with(['user','post'])->get();
        $comments=CommentResource::collection($comment);
        return $this->apiResponse($comments,'ok',200);

    }

      

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'body'=>'required|string',
            'post_id'=>'required|exists:posts,id',
            'user_id'=>'required|exists:users,id',

            
        ]);
        $comment=Comment::create([
            'body'=>$request->body,
            'post_id'=>$request->post_id,
            'user_id'=>Auth::id(),
        ]);
        dd($comment);
        return $this->apiResponse(new CommentResource($comment),'The Comment Added',200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $comment=Comment::with(['user','post'])->find($id);
       
        if(!$comment){
            return $this->apiResponse(null,'The Comment Not Found',404);            }
          
            
            return $this->apiResponse(new CommentResource($comment),'ok',200);
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'body'=>'required|string',
        ]);
        if(!$comment){
            return $this->apiResponse(null,'The Comment Not Found',404); 
         }
         $comment->update($request->all());
         return $this->apiResponse(new CommentResource($comment),'The Comment Update',200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment=Comment::find($id);
        if(!$comment){
            return apiResponse(null,'The Comment Not Found',404);  
                  }

                  $comment->delete();
                  return apiResponse(new CommentResource($comment),'The Comment Deleted',200);


    }
}
