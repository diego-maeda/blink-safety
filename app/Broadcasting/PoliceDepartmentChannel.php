<?php

namespace App\Broadcasting;

use App\Models\User;

/**
 * This channel was created in case we need to authorize the connection to an specific PD
 */
class PoliceDepartmentChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(User $user): array|bool
    {
        return true;
    }
}
