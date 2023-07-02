<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;

class Faker extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        //300 siswa perempuan
        for ($i = 0; $i < 300; $i++) {
            $nis = 12124000 + $i;
            $siswa = [
                'nis'               => $nis,
                'nama'              => $faker->firstNameFemale() . ' ' . $faker->lastName(),
                'alamat'            => $faker->address(),
                'jk'                => 'Perempuan',
                'tempt_lahir'       => $faker->city(),
                'tgl_lahir'         => $faker->dateTimeBetween('-18 years', '-14 years')->format('Y-m-d'),
                'telp'              => $faker->phoneNumber(),
                'telp_ortu'         => '082199906733',
                'penghasilan_ortu'  => random_int(1, 3),
                'tanggungan_ortu'   => random_int(1, 3),
                'jarak_rumah'       => random_int(1, 3),
                'kondisi_rumah'     => random_int(1, 2),
            ];
            $this->db->table('siswa')->insert($siswa);

            $users = model(UserModel::class);
            $user = new User([
                'email' => $nis . '@demo.com',
                'username' => $nis,
                'password' => $nis,
            ]);
            $user->activate();
            $users->withGroup('siswa')->save($user);
        }

        //300 siswa laki-laki
        for ($i = 0; $i < 300; $i++) {
            $nis = 12125000 + $i;
            $siswa = [
                'nis'               => $nis,
                'nama'              => $faker->firstNameMale() . ' ' . $faker->lastName(),
                'alamat'            => $faker->address(),
                'jk'                => 'Laki-laki',
                'tempt_lahir'       => $faker->city(),
                'tgl_lahir'         => $faker->dateTimeBetween('-18 years', '-14 years')->format('Y-m-d'),
                'telp'              => $faker->phoneNumber(),
                'telp_ortu'         => '082199906733',
                'penghasilan_ortu'  => random_int(1, 3),
                'tanggungan_ortu'   => random_int(1, 3),
                'jarak_rumah'       => random_int(1, 3),
                'kondisi_rumah'     => random_int(1, 2),
            ];
            $this->db->table('siswa')->insert($siswa);

            $users = model(UserModel::class);
            $user = new User([
                'email' => $nis . '@demo.com',
                'username' => $nis,
                'password' => $nis,
            ]);
            $user->activate();
            $users->withGroup('siswa')->save($user);
        }


        //15 guru perempuan
        for ($i = 0; $i < 15; $i++) {
            $nip = 199208132006031001 + $i;
            $guru = [
                'nip'           => $nip,
                'nama'          => $faker->name('Female'),
                'gol'           => 'II',
                'ruang'         => 'a',
                'tempt_lahir'   => $faker->city(),
                'tgl_lahir'     => $faker->dateTimeBetween('-50 years', '-30 years')->format('Y-m-d'),
                'jk'            => 'Perempuan',
                'telp'          => $faker->phoneNumber(),
            ];
            $this->db->table('guru')->insert($guru);

            $users = model(UserModel::class);
            $user = new User([
                'email' => $nip . '@demo.com',
                'username' => $nip,
                'password' => $nip,
            ]);
            $user->activate();
            $users->withGroup('guru')->save($user);
        }

        //15 guru laki-laki
        for ($i = 0; $i < 15; $i++) {
            $nip = 199208132006022001 + $i;
            $guru = [
                'nip'           => $nip,
                'nama'          => $faker->name('Male'),
                'gol'           => 'II',
                'ruang'         => 'a',
                'tempt_lahir'   => $faker->city(),
                'tgl_lahir'     => $faker->dateTimeBetween('-50 years', '-30 years')->format('Y-m-d'),
                'jk'            => 'Laki-laki',
                'telp'          => $faker->phoneNumber(),
            ];
            $this->db->table('guru')->insert($guru);

            $users = model(UserModel::class);
            $user = new User([
                'email' => $nip . '@demo.com',
                'username' => $nip,
                'password' => $nip,
            ]);
            $user->activate();
            $users->withGroup('guru')->save($user);
        }
    }
}
