<?php
namespace App\Services;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginService{
    public function login($email,$password){
        $result['success'] = false;
        do{
            $user = User::where('email',$email)->first();
            if (!$user){
                $result['message'] = 'Почта не существует';
                break;
            }
           if (!Hash::check($password,$user->password)){
                $result['message'] = 'Не совпадает пароль';
                break;
            }
            $token = sha1(Str::random(64).time());
            $user->token = $token;
            $user->save();
            $result['success'] = true;
            $result['data'] = UserResource::collection(User::where('id',$user->id)->get());
        }while(false);
        return $result;
    }
}
