<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class CustomModelNotFoundException extends Exception
{
    public $model;
    public $id;
    public function __construct($model,$id)
    {
        $this->model = $model;
        $this->id = $id;
    }
    public function report(): void
    {
        // ...
    }

    public function render(Request $request)
    {
        $errorMessage = $this->model . ' Not Found Complete with ' . $this->id;
        if($request->expectsJson()){
            return response()->json(['error'=>$errorMessage,'model'=>$this->model],404);
        }
        return view('errors.404',['error'=>$errorMessage]);
    }
    public function context()
    {
        return [
            // ...
        ];
    }
}
