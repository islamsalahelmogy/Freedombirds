<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'image_url'=>$this->image_url,
            'bio'=>$this->bio,
            'verify'=>$this->email_verified_at,
            'posts' => PostResource::collection($this->whenLoaded('posts')),
        ];
    }
}
