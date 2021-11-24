<?php

use App\Laravue\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Laravue\Models\Role;
use App\Sonobe\Models\Department;
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
        Department::create([
            'name' => '管理者',
            'manager_id' => 1,
            'department_code' => 'ADMIN',
        ]);
        Department::create([
            'name' => '生産管理',
            'manager_id' => 2,
            'department_code' => 'MANAGER',
        ]);
        Department::create([
            'name' => '出荷',
            'manager_id' => 3,
            'department_code' => 'SHIPPING',
        ]);
        Department::create([
            'name' => '技術',
            'manager_id' => 4,
            'department_code' => 'TECHNICAL',
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@laravue.dev',
            'password' => Hash::make('laravue'),
            'username' => 'spectrum184',
            'birthday' => Carbon::now(),
            'join_date' => Carbon::now(),
            'gender' => 'male',
            'address' => 'joso',
            'avatar' => 'avatar.jpg',
            'department_id' => 1
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
            'avatar' => 'avatar.jpg',
            'department_id' => 1
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
            'avatar' => 'avatar.jpg',
            'department_id' => 1
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
            'avatar' => 'avatar.jpg',
            'department_id' => 2
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
            'avatar' => 'avatar.jpg',
            'department_id' => 3
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
