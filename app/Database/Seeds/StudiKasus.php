<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StudiKasus extends Seeder
{
    public function run()
    {
        //siswa
        // $data = [
        //     [
        //         'nis' => '12134001',
        //         'nama' => 'Lidia Dian Griapon',
        //         'alamat' => 'Hotel 777, Abepura',
        //         'jk' => 'Perempuan',
        //         'tempt_lahir' => 'Timika',
        //         'tgl_lahir' => '2006-06-13',
        //         'agama' => 'Islam',
        //         'telp' => '082238204778',
        //         'telp_ortu' => '082238204776',
        //         'penghasilan_ortu'  => 2,
        //         'tanggungan_ortu'   => 3,
        //         'jarak_rumah'       => 1,
        //         'kondisi_rumah'     => 1,
        //     ],
        //     [
        //         'nis' => '12134002',
        //         'nama' => 'Ronaldo T. Amisim',
        //         'alamat' => 'Belakang Koramil, Abepura',
        //         'jk' => 'Laki-laki',
        //         'tempt_lahir' => 'Jayapura',
        //         'tgl_lahir' => '2006-12-12',
        //         'agama' => 'Islam',
        //         'telp' => '082238204773',
        //         'telp_ortu' => '082238204776',
        //         'penghasilan_ortu'  => 2,
        //         'tanggungan_ortu'   => 3,
        //         'jarak_rumah'       => 2,
        //         'kondisi_rumah'     => 1,
        //     ],
        //     [
        //         'nis' => '12134003',
        //         'nama' => 'Alince Giay',
        //         'alamat' => 'Belakang Koramil, Abepura',
        //         'jk' => 'Perempuan',
        //         'tempt_lahir' => 'Jayapura',
        //         'tgl_lahir' => '2006-12-12',
        //         'agama' => 'Islam',
        //         'telp' => '082238204773',
        //         'telp_ortu' => '082238204776',
        //         'penghasilan_ortu'  => 2,
        //         'tanggungan_ortu'   => 3,
        //         'jarak_rumah'       => 3,
        //         'kondisi_rumah'     => 2,
        //     ],
        //     [
        //         'nis' => '12134004',
        //         'nama' => 'Emmanuel Enesia F. Mambrasar',
        //         'alamat' => 'Belakang Koramil, Abepura',
        //         'jk' => 'Perempuan',
        //         'tempt_lahir' => 'Jayapura',
        //         'tgl_lahir' => '2006-12-12',
        //         'agama' => 'Islam',
        //         'telp' => '082238204773',
        //         'telp_ortu' => '082238204776',
        //         'penghasilan_ortu'  => 1,
        //         'tanggungan_ortu'   => 2,
        //         'jarak_rumah'       => 3,
        //         'kondisi_rumah'     => 2,
        //     ],
        //     [
        //         'nis' => '12134005',
        //         'nama' => 'Engel Berta Fransiska Imkowonong',
        //         'alamat' => 'Belakang Koramil, Abepura',
        //         'jk' => 'Laki-laki',
        //         'tempt_lahir' => 'Jayapura',
        //         'tgl_lahir' => '2006-12-12',
        //         'agama' => 'Islam',
        //         'telp' => '082238204773',
        //         'telp_ortu' => '082238204776',
        //         'penghasilan_ortu'  => 2,
        //         'tanggungan_ortu'   => 2,
        //         'jarak_rumah'       => 3,
        //         'kondisi_rumah'     => 1,
        //     ],
        //     [
        //         'nis' => '12134006',
        //         'nama' => 'Papia Yosephina Dahay',
        //         'alamat' => 'Belakang Koramil, Abepura',
        //         'jk' => 'Laki-laki',
        //         'tempt_lahir' => 'Jayapura',
        //         'tgl_lahir' => '2006-12-12',
        //         'agama' => 'Islam',
        //         'telp' => '082238204773',
        //         'telp_ortu' => '082238204776',
        //         'penghasilan_ortu'  => 2,
        //         'tanggungan_ortu'   => 3,
        //         'jarak_rumah'       => 3,
        //         'kondisi_rumah'     => 1,
        //     ],
        //     [
        //         'nis' => '12134007',
        //         'nama' => 'Vicky.M.Weyato',
        //         'alamat' => 'Belakang Koramil, Abepura',
        //         'jk' => 'Laki-laki',
        //         'tempt_lahir' => 'Jayapura',
        //         'tgl_lahir' => '2006-12-12',
        //         'agama' => 'Islam',
        //         'telp' => '082238204773',
        //         'telp_ortu' => '082238204776',
        //         'penghasilan_ortu'  => 3,
        //         'tanggungan_ortu'   => 3,
        //         'jarak_rumah'       => 3,
        //         'kondisi_rumah'     => 1,
        //     ],
        //     [
        //         'nis' => '12134008',
        //         'nama' => 'Yosep Fernando Kopong',
        //         'alamat' => 'Belakang Koramil, Abepura',
        //         'jk' => 'Laki-laki',
        //         'tempt_lahir' => 'Jayapura',
        //         'tgl_lahir' => '2006-12-12',
        //         'agama' => 'Islam',
        //         'telp' => '082238204773',
        //         'telp_ortu' => '082238204776',
        //         'penghasilan_ortu'  => 3,
        //         'tanggungan_ortu'   => 1,
        //         'jarak_rumah'       => 1,
        //         'kondisi_rumah'     => 1,
        //     ],
        //     [
        //         'nis' => '12134009',
        //         'nama' => 'Barnabas Eligius Ohee',
        //         'alamat' => 'Belakang Koramil, Abepura',
        //         'jk' => 'Perempuan',
        //         'tempt_lahir' => 'Jayapura',
        //         'tgl_lahir' => '2006-12-12',
        //         'agama' => 'Islam',
        //         'telp' => '082238204773',
        //         'telp_ortu' => '082238204776',
        //         'penghasilan_ortu'  => 2,
        //         'tanggungan_ortu'   => 1,
        //         'jarak_rumah'       => 1,
        //         'kondisi_rumah'     => 1,
        //     ],
        //     [
        //         'nis' => '12134010',
        //         'nama' => 'Brigitha Faustina Pigay',
        //         'alamat' => 'Belakang Koramil, Abepura',
        //         'jk' => 'Laki-laki',
        //         'tempt_lahir' => 'Jayapura',
        //         'tgl_lahir' => '2006-12-12',
        //         'agama' => 'Islam',
        //         'telp' => '082238204773',
        //         'telp_ortu' => '082238204776',
        //         'penghasilan_ortu'  => 2,
        //         'tanggungan_ortu'   => 3,
        //         'jarak_rumah'       => 1,
        //         'kondisi_rumah'     => 1,
        //     ],
        // ];
        // $this->db->table('siswa')->insertBatch($data);

        //data kelas
        $data = [
            ['fkKelas' => '11', 'fkSiswa' => '12134001', 'peringkat' => 1, 'fkTA' => 1],
            ['fkKelas' => '11', 'fkSiswa' => '12134002', 'peringkat' => 3, 'fkTA' => 1],
            ['fkKelas' => '11', 'fkSiswa' => '12134003', 'peringkat' => 2, 'fkTA' => 1],
            ['fkKelas' => '12', 'fkSiswa' => '12134004', 'peringkat' => 3, 'fkTA' => 1],
            ['fkKelas' => '12', 'fkSiswa' => '12134005', 'peringkat' => 5, 'fkTA' => 1],
            ['fkKelas' => '12', 'fkSiswa' => '12134006', 'peringkat' => 10, 'fkTA' => 1],
            ['fkKelas' => '13', 'fkSiswa' => '12134007', 'peringkat' => 1, 'fkTA' => 1],
            ['fkKelas' => '13', 'fkSiswa' => '12134008', 'peringkat' => 2, 'fkTA' => 1],
            ['fkKelas' => '13', 'fkSiswa' => '12134009', 'peringkat' => 7, 'fkTA' => 1],
            ['fkKelas' => '13', 'fkSiswa' => '12134010', 'peringkat' => 10, 'fkTA' => 1],
        ];
        $this->db->table('kelas_siswa_ta')->insertBatch($data);
    }
}
