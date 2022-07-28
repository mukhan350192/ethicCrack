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
    /**
     * @OA\Post(
     ** path="/api/register",
     *   tags={"Регистрация"},
     *   summary="register",
     *   operationId="register",
     *
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="surname",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string",
     *           minLength=8
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="true/false",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

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


    /**
     * @OA\Post(
     ** path="/api/login",
     *   tags={"Авторизация"},
     *   summary="login",
     *   operationId="login",
     *
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="true/false",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

    public function login(LoginUser $request,LoginService $service){
        $login = $service->login($request->input('email'),$request->input('password'));
        return $login;
    }


    /**
     * @OA\Post(
     ** path="/api/registerCompany",
     *   tags={"Регистрация"},
     *   summary="registerCompany",
     *   operationId="registerCompany",
     *
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *  @OA\Parameter(
     *      name="surname",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Parameter(
     *      name="bin",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Parameter(
     *      name="companyName",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="true/false",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/


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
