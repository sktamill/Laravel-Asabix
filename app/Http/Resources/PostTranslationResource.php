<?php

namespace App\Http\Resources;

use App\Models\Language;
use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class PostTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       $post = Post::where('id', '=', $this->post_id)->first();

       return [
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'lang' => new LanguageResource($this->language),
            'tags' => TagResource::collection($post->tags)
        ];
    }
}
