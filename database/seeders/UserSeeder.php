<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $user1 = User::create([
        //     'name' => 'Admin',
        //     'email' => 'tungpm@holomia.com',
        //     'password' => bcrypt('Abcd1234')
        // ]);
        // $user1->assignRole('administrator');

        $user2 = User::create([
            'name' => 'Nemo',
            'email' => 'nemo@holomia.com',
            'password' => bcrypt('Abcd1234')
        ]);
        $user2->assignRole('administrator');
    }
}
