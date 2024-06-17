<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'author_name' => $this->user->name,
            'caption' => Str::limit($this->body, 20, '...'),
            'featured_image' => ( $this->thumbnail !== null ) ? $this->thumbnail->url : null,
            'created_at' => Carbon::parse( $this->created_at )->diffForHumans(),
            'comments' => BlogCommentResource::collection( $this->comments()->get() )
        ];
    }
}
