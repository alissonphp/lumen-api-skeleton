<?php

namespace App\Modules\OAuth\Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class LoginIntegrationTest extends TestCase {

    public function testExample()
    {
       $this
           ->json('POST','/api/v1/oauth/login/credentials', [
            'email' => 'bessie.kovacek@shanahan.net',
            'password' => 'lumenauth123'
        ]);
    }

}