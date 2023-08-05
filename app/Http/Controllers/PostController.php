<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'image' => 'mimes:jpg,bmp,png',
        ])->validate();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $file_path = 'images/' . uniqid() . $file->getClientOriginalExtension();
            Storage::disk('s3')->put($file_path, file_get_contents($file));
            $fileModel = new File();
            $fileModel->fie_path = $file_path;
            $fileModel->save();
            dd('success');
        }

    }

    public function check()
    {
        $getFilePath = File::find(2)->fie_path;
        if(Storage::disk('s3')->exists($getFilePath)){
            dd(true);
        }else{
            dd(false);
        }
    }

}
