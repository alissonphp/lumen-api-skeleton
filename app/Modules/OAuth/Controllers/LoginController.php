<?php

namespace App\Modules\OAuth\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Users\Controllers\UserController;
use App\Modules\Users\Models\User;
use App\Modules\Users\Supports\MailCheckSupport;
use Laravel\Socialite\Facades\Socialite as Socialite;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

/**
 * Class LoginController
 * @package App\Modules\OAuth\Controllers
 */

class LoginController extends Controller
{

    /**
     * @var JWTAuth
     */
    protected $jwt;
    /**
     * @var UserController
     */
    public $userController;


    /**
     * LoginController constructor.
     * @param JWTAuth $jwt
     * @param UserController $userController
     */
    public function __construct(JWTAuth $jwt, UserController $userController)
    {
        $this->jwt = $jwt;
        $this->userController = $userController;
    }

    /**
     * @param $provider
     * @return mixed
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)
            ->stateless()
            ->redirect();
    }

    /**
     * @param $provider
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function handleProviderCallback($provider)
    {
        try {

            /**
             * get user infos with callback provider token
             */

            $user = Socialite::driver($provider)
                ->stateless()
                ->user();

            /**
             * check if user email exists in database
             */

            if(!MailCheckSupport::userEmailCheck($user->email)) {

                /**
                 * create user array infos to save in database
                 */

                $userInfos = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => null,
                    'remember_token' => str_random(10),
                    'provider' => $provider,
                    'provider_id' => $user->id,
                    'avatar_url' => $user->avatar
                ];

                /**
                 * generate a personal token access from this new user
                 */

                $token = $this->userController->createUserFromProvider($userInfos);

            } else {

                /**
                 * search existent user in database and generate your personal token access
                 */

                $existsUser = User::where('email',$user->email)->first();
                $token = $this->jwt->fromUser($existsUser);

            }

            return response()->json(compact('token'));
        } catch (\Exception $ex) {
            return response($ex->getMessage(),500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);

        try {
            if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], $e->getStatusCode());
        }

        return response()->json(compact('token'));
    }

}