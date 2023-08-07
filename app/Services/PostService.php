<?php

namespace App\Services;

use App\Exceptions\CustomModelNotFoundException;
use App\Exceptions\PostException;
use App\Models\Post;

class PostService
{
    public function getUserById($id)
    {
        $post = Post::find($id);
        if(!$post){
            // throw new PostException('Post Not Found i am returning from PostService class');
            throw new CustomModelNotFoundException('Post',$id);
        }
        return $post;
    }

}