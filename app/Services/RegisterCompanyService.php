<?php
namespace App\Services;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegisterCompanyService{
    public function registerCompany(
        $name,
        $surname,
        $email,
        $password,
        $companyName,
        $bin
    ){
        $user = new User();
        $token = sha1(Str::random(64).time());
        $user->name = $name;
        $user->surname = $surname;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->token = $token;
        $user->type = 2;
        $user->save();

        $user_id = $user->id;

        DB::table('company_details')->insertGetId([
            'bin' => $bin,
            'companyName'=> $companyName,
            'user_id' => $user_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $result['success'] = true;
        $result['token'] = $token;
        return $result;
    }
}
