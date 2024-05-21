<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'No'=>$this->id,
            'title'=>$this->title,
            'body'=>$this->body,
            'user'=>$this->user->name, 
            'category'=>$this->category->name, 
            
    ];
    }
}
