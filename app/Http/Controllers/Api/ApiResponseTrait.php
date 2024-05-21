<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\JsonResponse;
   
trait  ApiResponseTrait 
{
public function apiResponse($data,$message,$status){

$array=[
'data'=>$data,
'message'=>$message,
'status'=>$status,
];

return response($array,$status);

}



}