<?php

namespace App\Modules\Users\Supports;

use App\Modules\Users\Models\User;

/**
 * Class MailCheckSupports
 * @package App\Modules\Users\Support
 */
class MailCheckSupport {

    /**
     * @param $email
     * @return bool|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    static function userEmailCheck($email)
    {
        try {

            $user = User::where('email',$email)->first();

            if(!$user) {
                return false;
            }

            return $user;

        } catch (\Exception $ex) {
            return response($ex->getMessage(),500);
        }
    }

}