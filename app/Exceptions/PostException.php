<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostException extends Exception
{
    public $errorMessage;
    public function __construct($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }
    public function report(): void
    {
        // ...
    }
    public function render(Request $request)
    {
        if($request->expectsJson()){
            return response()->json(['error'=>'page not found json'],404);
        }
        return view('posts.notFound',['error'=>$this->errorMessage]);
    }
}
