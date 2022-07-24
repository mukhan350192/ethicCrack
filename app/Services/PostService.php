<?php
namespace App\Services;
use App\Models\Post;
use App\Models\User;

class PostService{
    public function createPost($title,$description,$restrictions,$token){
        $result['success'] = false;
        do{
            $user = User::where('token',$token)->first();
            if (!$user){
                $result['message'] = 'Не найден пользователь';
                break;
            }
            Post::create([
                'title' => $title,
                'description' => $description,
                'restrictions' => $restrictions,
                'user_id' => $user->id,
            ]);
            $result['success'] = true;
        }while(false);
        return $result;
    }
}
