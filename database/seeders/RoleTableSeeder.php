<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = collect([
            'admin',
            'dit_gtk',
            'lptk',
            'guru',
        ]);

        $roles->map(function ($role) {
            $name = $role;
            $guard_name = 'web';

            Role::query()
                ->updateOrCreate(compact('name'), compact('name', 'guard_name'));
        });
    }
}
