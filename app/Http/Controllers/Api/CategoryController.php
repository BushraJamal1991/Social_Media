<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
//use App\Http\Controllers\Api\ApiResponseTrait;




class CategoryController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category=Category::all();
        $categories= CategoryResource::collection($category);
        return $this->apiResponse($categories,'ok',200);          
    }   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:100',
        ]);
       $category=Category::create([ 
        'name'=>$request->name,
    ]);

        return $this->apiResponse($category,'The Category Added',201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category= Category::find($id);

        if($category){
              return $this->apiResponse(new CategoryResource($category),'ok',200);;
            }
             
            return $this->apiReponse(null,'The Category Not Found',404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required|string|max:100',
            
        ]);

        $category= Category::find($id);
        if(!$category){
            return $this->apiReponse(null,'The Category Not Found',404);          
        }
          $category->update([
             'name'=>$request->name,
            ]);

            return $this->apiResponse(new CategoryResource($category),'The Category Updated',200);  
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category= Category::find($id);
        if(!$category){
            return $this->apiReponse(null,'The Category Not Found',404);          
        }
        $category->delete();
        return $this->apiResponse(new CategoryResource($category),'The Category Deleted',200);  

    }
}
