<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUser;
use App\Http\Requests\RegisterCompanyUser;
use App\Http\Requests\RegisterUser;
use App\Services\LoginService;
use App\Services\RegisterCompanyService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(RegisterUser $request, UserService $service){
        try{
            $user = $service->store(
                $request->input('name'),
                $request->input('surname'),
                $request->input('email'),
                $request->input('password'),
            );
            $token = $user->token;
            $result['token'] = $token;
            $result['success'] = true;
            return response()->json($result,200);
        }catch (\Exception $e){
            return response()->json(['errors' => $request],422);
        }
    }

    public function login(LoginUser $request,LoginService $service){
        $login = $service->login($request->input('email'),$request->input('password'));
        return $login;
    }

    public function registerCompany(RegisterCompanyUser $request, RegisterCompanyService $service){
        $company = $service->registerCompany(
            $request->input('name'),
            $request->input('surname'),
            $request->input('email'),
            $request->input('password'),
            $request->input('companyName'),
            $request->input('bin'),
        );
        return $company;
    }
}
