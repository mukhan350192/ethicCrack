<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class UserService{
    public function store($name,$surname,$email,$password):User{
        $token = sha1(Str::random(64).time());
        $user = new User();
        $user->name = $name;
        $user->surname = $surname;
        $user->email = $email;
        $user->type = 1;
        $user->password = bcrypt($password);
        $user->token = $token;
        $user->save();

        return $user;
    }
}
