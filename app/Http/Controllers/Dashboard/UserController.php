<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\GenreService;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller {

    private UserService $userService;
    private RoleService $roleService;
    private GenreService $genreService;

    public function __construct(UserService $userService, RoleService $roleService, GenreService $genreService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->genreService = $genreService;
    }

    public function index(Request $request): View|JsonResponse
    {
        if (! $request->ajax())
        {
            return view('dashboard.users.index');
        }
        $input = $request->only(['length', 'start', 'order', 'search']);

        $resp = $this->userService->paginateWithQuery($input);

        return response()->json([
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($resp['meta']['recordsTotal']),
            "recordsFiltered" => intval($resp['meta']['recordsFiltered']),
            "data"            => $resp['data'],
        ], 200);
    }

    public function create(): View
    {
        $user = new User();
        $roles = $this->roleService->allRoles()->pluck('name', 'key');
        $genres = $this->genreService->allGenre();

        return view('dashboard.users.create', compact('user', 'roles', 'genres'));
    }


    public function store(UserRequest $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->only(['first_name', 'last_name', 'email', 'password', 'role', 'genres']);
        $user = $this->userService->createNewUser($input);
        return redirect(route('users.show',$user->id))->with('toast.success', 'User created successfully');
    }

    public function show(User $user): View
    {
        $user->load('genres', 'role');
        $genres = $this->genreService->allGenre();
        return view('dashboard.users.show', compact('user', 'genres'));
    }


    public function edit(User $user): View
    {
        $roles = $this->roleService->allRoles()->pluck('label', 'name');
        $genres = $this->genreService->allGenre();
        return view('dashboard.users.edit', compact('user', 'roles', 'genres'));
    }


    public function update(UserRequest $request, User $user)
    {
        $input = $request->only(['first_name', 'last_name', 'email', 'role', 'genres']);
        $this->userService->updateUser($input, $user);
        return view('dashboard.users.show', compact('user'))->with('toast.success', 'User updated successfully');
    }

    public function updatePassword(UserPasswordRequest $request, User $user): JsonResponse
    {
        $input = $request->only('password');
        $this->userService->updatePassword($input, $user);
        return response()->json(['message' => 'Password updated successfully']);
    }

    public function destroy(User $user): JsonResponse
    {
        $this->userService->delete($user);
        return response()->json(['message' => 'User successfully deleted']);
    }
}
