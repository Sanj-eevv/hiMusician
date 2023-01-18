<?php
declare(strict_types=1);

namespace App\Actions\Fortify;

use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers {

    use PasswordValidationRules;

    public function create(array $input): User
    {
        Validator::make($input, [
            'first_name'           => ['required', 'string', 'max:191'],
            'last_name'            => ['required', 'string', 'max:191'],
            'email'                => [ 'required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'password'             => $this->passwordRules(),
            'terms_and_conditions' => ['required'],
            'role'                 => ['required', 'string', 'exists:roles,name'],
        ], ['terms_and_conditions' => 'The :attribute must be accepted.',
            'role.required'        => 'Select least one role.'])->validate();

        $roleService = resolve(RoleService::class);
        $role = $roleService->getRoleByName($input['role']);

        return User::create([
            'first_name' => $input['first_name'],
            'last_name'  => $input['last_name'],
            'email'      => $input['email'],
            'role_id'    => $role->id,
            'password'   => Hash::make($input['password']),
        ]);
    }
}