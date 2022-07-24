<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(PostRequest $request, PostService $service){
        $result = $service->createPost(
            $request->input('title'),
            $request->input('description'),
            $request->input('restrictions'),
            $request->input('token'),
        );
        return $result;
    }
}
