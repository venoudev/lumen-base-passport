<?php

use Illuminate\Database\Seeder;
use App\Entities\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class InitProyectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@venoudev.com',
            'password' => Hash::make('12345678'),

        ]);

        $roles = [
            'admin',
        ];

        foreach ($roles as $rol) {
            Role::create(['guard_name' => 'api', 'name' => $rol]);
        }

        $user = User::where('email', 'admin@venoudev.com')->first();
        $user->assignRole('admin');
    }
}
