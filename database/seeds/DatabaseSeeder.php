<?php

use App\Laravue\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Laravue\Models\Role;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@laravue.dev',
            'password' => Hash::make('laravue'),
            'username' => 'spectrum184',
            'birthday' => Carbon::now(),
            'join_date' => Carbon::now(),
            'gender' => 'male',
            'address' => 'joso',
            'avatar' => 'avatar.jpg'
        ]);
        $manager = User::create([
            'name' => 'Manager',
            'email' => 'manager@laravue.dev',
            'password' => Hash::make('laravue'),
            'username' => 'manager',
            'birthday' => Carbon::now(),
            'join_date' => Carbon::now(),
            'gender' => 'male',
            'address' => 'joso',
            'avatar' => 'avatar.jpg'
        ]);
        $editor = User::create([
            'name' => 'Editor',
            'email' => 'editor@laravue.dev',
            'password' => Hash::make('laravue'),
            'username' => 'editor',
            'birthday' => Carbon::now(),
            'join_date' => Carbon::now(),
            'gender' => 'male',
            'address' => 'joso',
            'avatar' => 'avatar.jpg'
        ]);
        $user = User::create([
            'name' => 'User',
            'email' => 'user@laravue.dev',
            'password' => Hash::make('laravue'),
            'username' => 'user',
            'birthday' => Carbon::now(),
            'join_date' => Carbon::now(),
            'gender' => 'male',
            'address' => 'joso',
            'avatar' => 'avatar.jpg'
        ]);
        $visitor = User::create([
            'name' => 'Visitor',
            'email' => 'visitor@laravue.dev',
            'password' => Hash::make('laravue'),
            'username' => 'visitor',
            'birthday' => Carbon::now(),
            'join_date' => Carbon::now(),
            'gender' => 'male',
            'address' => 'joso',
            'avatar' => 'avatar.jpg'
        ]);

        $adminRole = Role::findByName(\App\Laravue\Acl::ROLE_ADMIN);
        $managerRole = Role::findByName(\App\Laravue\Acl::ROLE_MANAGER);
        $editorRole = Role::findByName(\App\Laravue\Acl::ROLE_EDITOR);
        $userRole = Role::findByName(\App\Laravue\Acl::ROLE_USER);
        $visitorRole = Role::findByName(\App\Laravue\Acl::ROLE_VISITOR);
        $admin->syncRoles($adminRole);
        $manager->syncRoles($managerRole);
        $editor->syncRoles($editorRole);
        $user->syncRoles($userRole);
        $visitor->syncRoles($visitorRole);
        $this->call(UsersTableSeeder::class);
    }
}
