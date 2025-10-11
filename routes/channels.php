<?php

use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('terminal.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});
