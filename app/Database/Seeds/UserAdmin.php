<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;

class UserAdmin extends Seeder
{
    public function run()
    {
        $users = model(UserModel::class);
        $user = new User([
            'email' => 'admin@demo.com',
            'username' => 'admin2',
            'password' => 'admin',
        ]);
        $user->activate();
        $users->withGroup('admin')->save($user);
    }
}
