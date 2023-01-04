<?php

namespace Database\Seeders;

use App\Models\m_kantor;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        $data = collect([
            [
                'name' => "Admin",
                'email' => 'admin@gmail.com',
                'role' => 'admin',
            ],
            [
                'name' => "DIT GTK",
                'email' => 'dit_gtk@gmail.com',
                'role' => 'dit_gtk',
            ],
            [
                'name' => "LPTK",
                'email' => 'lptk@gmail.com',
                'role' => 'lptk',
            ],
            [
                'name' => "Guru",
                'email' => 'guru@gmail.com',
                'role' => 'guru',
            ],
        ]);

        $data->map(function ($data) {
            $name = $data['name'];
            $email = $data['email'];
            $role = $data['role'];
            $email_verified_at = now();
            $password = bcrypt('000000');

            $user = User::query()->updateOrCreate(compact('name', 'email', 'email_verified_at', 'role', 'password'), compact('name', 'email', 'email_verified_at', 'role', 'password'));
            $user->syncRoles($user->role);
        });
    }
}
