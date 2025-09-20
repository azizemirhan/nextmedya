<?php

namespace App\Policies;

use App\Models\Board;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BoardPolicy
{
    // app/Policies/BoardPolicy.php
    public function update(User $user, Board $board): bool
    {
        // Kullanıcının 'update-board' izni var mı VEYA panonun sahibi mi?
        return $user->can('update-board') || $user->id === $board->owner_id;
    }

    public function delete(User $user, Board $board): bool
    {
        // Kullanıcının 'delete-board' izni var mı VEYA panonun sahibi mi?
        return $user->can('delete-board') || $user->id === $board->owner_id;
    }
}
