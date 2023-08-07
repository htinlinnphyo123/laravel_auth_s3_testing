<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Post;
use App\Services\PostService;
use Aws\Api\Service;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\RelationNotFoundException;

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

        // if($request->hasFile('image')){
        //     $orgImage = $request->file('image');
        //     dd($orgImage);
        //     $newImage = Image::make($orgImage)->resize(300,200);
        //     dd($orgImage,$newImage);
        // }


        if($request->hasFile('image')){
            $file = $request->file('image');
            $file_path = 'images/' . uniqid() . '_' . $file->getClientOriginalName();
            $success = Storage::disk('s3')->put($file_path,file_get_contents($file));
            if ($success) {
                $fileModel = new File();
                $fileModel->fie_path = $file_path;
                $fileModel->save();
                dd('success');
            } else {
                dd('fail');
            }
        }

    }

    public function check()
    {
        $getFilePath = File::find(8)->fie_path;
        if(Storage::disk('s3')->exists($getFilePath)){
            // dd(true);
            $imageUrl = Storage::disk('s3')->url($getFilePath);
            // dd($imageUrl);
            return view('posts.show',['image'=>$imageUrl]);
        }else{
            dd(false);
        }
    }

    public function show($id)
    {
        $post = (new PostService)->getUserById($id);

        dd($post);
    }

}
