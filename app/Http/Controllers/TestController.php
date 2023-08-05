<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {   
        $posts = Post::simplePaginate(20);
        return view('dashboard',compact('posts'));
    }

    public function edit(Post $post,Comment $comment)
    {
        return view('test.index')->with('post',$post);
    }

}