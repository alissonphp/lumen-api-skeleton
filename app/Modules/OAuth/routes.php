<?php

$app->get('login/{provider}',   'LoginController@redirectToProvider');
$app->get('login/{provider}/callback', 'LoginController@handleProviderCallback');
$app->post('login/credentials', 'LoginController@authenticate');
