<?php
declare(strict_types=1);

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user): bool
    {
        return true;
    }


    public function view(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }


    public function update(User $user, Event $event): bool
    {
        return true;

    }


    public function delete(User $user, Event $event): bool
    {
        return true;
    }

    public function restore(User $user, Event $event): bool
    {
        return true;
    }

    public function forceDelete(User $user, Event $event): bool
    {
        return true;

    }
}
