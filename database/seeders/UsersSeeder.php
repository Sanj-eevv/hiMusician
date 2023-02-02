<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Constants\UserRole;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class UsersSeeder extends Seeder {

    public function run(): void
    {
        $roleService = resolve(RoleService::class);
        $role = $roleService->getRoleByKey(UserRole::SUPER_ADMIN);
        User::upsert([
            [
                'first_name'           => 'Suman',
                'last_name'            => 'Budathoki',
                'email'                => 'sumanbudathoki@gmail.com',
                'email_verified_at'    => now(),
                'password'             => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role_id'              => $role->id,
                'remember_token'       => Str::random(10),
            ],
            [
                'first_name'           => 'Suman1',
                'last_name'            => 'Budathoki1',
                'email'                => 'sumanbudathoki1@gmail.com',
                'email_verified_at'    => now(),
                'password'             => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role_id'              => 2,  // admin
                'remember_token'       => Str::random(10),
            ],
            [
                'first_name'        => 'Suman2',
                'last_name'         => 'Budathoki2',
                'email'             => 'sumanbudathoki2@gmail.com',
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role_id'           => 3,  // Basic User
                'remember_token'    => Str::random(10),
            ],
            [
                'first_name'        => 'Suman3',
                'last_name'         => 'Budathoki3',
                'email'             => 'sumanbudathoki3@gmail.com',
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role_id'           => 4,  // Artist
                'remember_token'    => Str::random(10),
            ],
            [
                'first_name'        => 'Suman4',
                'last_name'         => 'Budathoki4',
                'email'             => 'sumanbudathoki4@gmail.com',
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role_id'           => 5,  // Organizer
                'remember_token'    => Str::random(10),
            ],
        ], ['email'], []);
        User::factory(100)->create();
    }
}
