<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = collect([
            'data provinsi' => [
                'create data provinsi',
                'view data provinsi',
                'edit data provinsi',
                'delete data provinsi',
            ],
            'data kabupaten' => [
                'create data kabupaten',
                'view data kabupaten',
                'edit data kabupaten',
                'delete data kabupaten',
            ],
            'data kecamatan' => [
                'create data kecamatan',
                'view data kecamatan',
                'edit data kecamatan',
                'delete data kecamatan',
            ],
            'data kelurahan' => [
                'create data kelurahan',
                'view data kelurahan',
                'edit data kelurahan',
                'delete data kelurahan',
            ],
        ]);

        $permissions->map(function ($permission, $group) {
            collect($permission)->map(function ($name) use ($group) {
                $guard_name = 'web';

                Permission::query()
                    ->updateOrCreate(compact('name'), compact('name', 'group', 'guard_name'));
            });
        });
    }
}
