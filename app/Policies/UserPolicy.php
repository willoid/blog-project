<?php
namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    public function delete(User $user, User $target): bool
    {
        return false; // Only admins via `before()` can delete users
    }
}
