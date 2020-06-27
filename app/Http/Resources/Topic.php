<?php

namespace App\Http\Resources;

use App\Http\Resources\Post as PostResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Topic extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'posts' => PostResource::collection($this->posts),
            'user' => $this->user,
        ];
    }
}
