<?php

namespace App\Modules\Users\Events;

use App\Events\Event;
use App\Modules\Users\Models\User;

/**
 * Class NewUserEvent
 * @package App\Modules\Users\Events
 */
class NewUserEvent extends Event
{

    /**
     * @var User
     */
    public $user;

    /**
     * NewUserEvent constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
