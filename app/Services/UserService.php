<?php
declare(strict_types=1);

namespace App\Services;

use App\Constants\UserRole;
use App\Helpers\AppHelper;
use App\Http\Resources\UserResource;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService {

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function paginateWithQuery(array $input): array
    {
        $columns = [
            'first_name',
            'last_name',
            'email',
            'role',
            'created_at',
            'action',
        ];
        $meta = AppHelper::defaultTableInput($input, $columns);
        $resp = $this->userRepository->paginatedWithQuery($meta);

        return [
            'data' => UserResource::collection($resp['results']),
            'meta' => $resp['meta'],
        ];
    }

    public function createNewUser(array $input): object
    {
        $roleService  = resolve(RoleService::class);
        $genreService = resolve(GenreService::class);

        $role = $roleService->getRoleByName($input['role']);
        $genreIds = $genreService->getGenreByName($input['genres'])->pluck('id');

        $input['password'] = Hash::make($input['password']);
        $input['role_id'] = $role->id;

        $user = $this->userRepository->store($input);
        $genreService->assignGenreToUser($genreIds, $user);
        return $user;
    }

    public function delete(User $user): void
    {
        $this->userRepository->delete($user);
    }

    public function getUserRole(): Role
    {
        return auth()->user()->role;
    }


    public function isAdmin(): bool
    {
        $userRole = self::getUserRole();
        return in_array($userRole->name, [UserRole::SUPER_ADMIN, UserRole::ADMIN]);
    }



}