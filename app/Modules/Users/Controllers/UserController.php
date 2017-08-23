<?php

namespace App\Modules\Users\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Users\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class UserController
 * @package App\Modules\Users\Controllers
 */
class UserController extends Controller
{

    /**
     * @var JWTAuth
     */
    protected $jwt;

    /**
     * LoginController constructor.
     * @param JWTAuth $jwt
     */
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * @param array $infos
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function createUserFromProvider(array $infos)
    {
        try {

            $user = User::create($infos);
            $token = $this->jwt->fromUser($user);
            return response()->json(compact('token'));

        } catch (\Exception $ex) {

            return response($ex->getMessage(),500);

        }
    }

    /**
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function profile()
    {
        try {
            return response(Auth::user(),200);
        } catch (AuthorizationException $ex) {
            return response('Usuário não autorizado.' . $ex->getMessage(), $ex->getCode());
        } catch (AuthenticationException $ex) {
            return response('Usuário não autenticado.' . $ex->getMessage(), $ex->getCode());
        } catch (\Exception $ex) {
            return response($ex->getMessage(), $ex->getCode());
        }
    }

}