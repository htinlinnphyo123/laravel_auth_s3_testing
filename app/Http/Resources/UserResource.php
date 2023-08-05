<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'languages' => $this->languages,
            'country' => $this->country,
            'city' => 'Pyinmana',
            'is_admin' => $this->is_admin,
            'post_count' => $this->whenCounted('posts'),
            // 'posts'  => PostResource::collection(Post::all()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
