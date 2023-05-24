<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Demo extends Seeder
{
    public function run()
    {
        //siswa
        $data = [
            [
                'nis' => '12123001', 
                'nama' => 'Siti Nur Rahma', 
                'alamat' => 'Hotel 777, Abepura', 
                'jk' => 'P', 
                'tempt_lahir' => 'Timika', 
                'tgl_lahir' => '2006-06-13', 
                'agama' => 'Islam', 
                'telp' => '082238204776', 
                'telp_ortu' => '082238204777',
            ],
            [
                'nis' => '12123002', 
                'nama' => 'Al Rahman Fazrin', 
                'alamat' => 'Belakang Koramil, Abepura', 
                'jk' => 'L', 
                'tempt_lahir' => 'Jayapura', 
                'tgl_lahir' => '2006-12-12', 
                'agama' => 'Islam', 
                'telp' => '082238204773', 
                'telp_ortu' => '082238204772',
            ],
            [
                'nis' => '12123003', 
                'nama' => 'Riska Putri Nila Sari', 
                'alamat' => 'Depan Ramayana, Kotaraja', 
                'jk' => 'P', 
                'tempt_lahir' => 'Timika', 
                'tgl_lahir' => '2006-09-06', 
                'agama' => 'Islam', 
                'telp' => '082238204770', 
                'telp_ortu' => '082238204781',
            ],
            [
                'nis' => '12123004', 
                'nama' => 'Alfi Ulfa', 
                'alamat' => 'Hotel 777, Abepura', 
                'jk' => 'P', 
                'tempt_lahir' => 'Jayapura', 
                'tgl_lahir' => '2006-11-02', 
                'agama' => 'Islam', 
                'telp' => '082238204776', 
                'telp_ortu' => '082238204777',
            ],
            [
                'nis' => '12123005', 
                'nama' => 'Amin Raiz', 
                'alamat' => 'Hotel 777, Abepura', 
                'jk' => 'L', 
                'tempt_lahir' => 'Jayapura', 
                'tgl_lahir' => '2006-01-09', 
                'agama' => 'Islam', 
                'telp' => '082238204776', 
                'telp_ortu' => '082238204777',
            ],
        ];
        $this->db->table('siswa')->insertBatch($data);

        //guru
        $data = [
            [
                'nip' => '199206132005022001', 
                'nama' => 'Apriani Ningsih', 
                'gol' => 'III', 
                'ruang' => 'b', 
                'tempt_lahir' => 'Ambon', 
                'tgl_lahir' => '1992-06-13', 
                'jk' => 'P',
                'telp' => '082238204776',
            ],
            [
                'nip' => '199208132006021001', 
                'nama' => 'Aldi Arisandy', 
                'gol' => 'IV', 
                'ruang' => 'a', 
                'tempt_lahir' => 'Toraja', 
                'tgl_lahir' => '1992-08-13', 
                'jk' => 'L',
                'telp' => '082238204776',
            ],
            [
                'nip' => '199212132007012001', 
                'nama' => 'Nur Ilham', 
                'gol' => 'IV', 
                'ruang' => 'c', 
                'tempt_lahir' => 'Jayapura', 
                'tgl_lahir' => '1992-12-13', 
                'jk' => 'P',
                'telp' => '082238204776',
            ],
        ];
        $this->db->table('guru')->insertBatch($data);

        // //kelas
        $tingkat = ["X","XI","XII"];
        $jurusan = ["IPA","IPS","BAHASA"];
        $kode = [1,2,3,4];

        foreach ($tingkat as $Tingkat) {
            foreach ($jurusan as $Jurusan) {
                foreach ($kode as $Kode) {
                    $data = [
                        'tingkat' => $Tingkat,
                        'jurusan' => $Jurusan,
                        'kode' => $Kode
                    ];
                    $this->db->table('kelas')->insert($data);
                }
            }
        }

        //mapel
        $data = [
            [
                'pelajaran' => 'Agama',
                'jurusan' => 'Umum'
            ],
            [
                'pelajaran' => 'Pendidikan Kewarganegaraan',
                'jurusan' => 'Umum'
            ],
            [
                'pelajaran' => 'Bahasa Indonesia',
                'jurusan' => 'Umum'
            ],
            [
                'pelajaran' => 'Matematika',
                'jurusan' => 'Umum'
            ],
            [
                'pelajaran' => 'Bahasa Inggris',
                'jurusan' => 'Umum'
            ],
            [
                'pelajaran' => 'Seni dan Prakarya',
                'jurusan' => 'Umum'
            ],
            [
                'pelajaran' => 'Pendidikan Jasmani',
                'jurusan' => 'Umum'
            ],
            [
                'pelajaran' => 'Fisika',
                'jurusan' => 'IPA'
            ],
            [
                'pelajaran' => 'Biologi',
                'jurusan' => 'IPA'
            ],
            [
                'pelajaran' => 'Kimia',
                'jurusan' => 'IPA'
            ],
            [
                'pelajaran' => 'Sejarah',
                'jurusan' => 'IPS'
            ],
            [
                'pelajaran' => 'Geografi',
                'jurusan' => 'IPS'
            ],
            [
                'pelajaran' => 'Ekonomi',
                'jurusan' => 'IPS'
            ],
            [
                'pelajaran' => 'Sosiologi',
                'jurusan' => 'IPS'
            ],
            [
                'pelajaran' => 'Bahasa Inggris',
                'jurusan' => 'Bahasa'
            ],
            [
                'pelajaran' => 'Bahasa Mandarin',
                'jurusan' => 'Bahasa'
            ],
            [
                'pelajaran' => 'Bahasa Jerman',
                'jurusan' => 'Bahasa'
            ],
        ];
        $this->db->table('mapel')->insertBatch($data);

        //tahun ajaran
        $data = [
            'tahun' => 2022/2023
        ];
        $this->db->table('TA')->insert($data);

        //kriteria
        $data = [
            [
                'kriteria' => 'peringkat kelas',
                'bobot_prestasi' => 27,
                'bobot_beasiswa' => 24
            ],
            [
                'kriteria' => 'nilai semester',
                'bobot_prestasi' => 52,
                'bobot_beasiswa' => 41
            ],
            [
                'kriteria' => 'kehadiran',
                'bobot_prestasi' => 15,
                'bobot_beasiswa' => 0
            ],
            [
                'kriteria' => 'pelanggaran',
                'bobot_prestasi' => 6,
                'bobot_beasiswa' => 0
            ],
            [
                'kriteria' => 'penghasilan ortu',
                'bobot_prestasi' => 0,
                'bobot_beasiswa' => 16
            ],
            [
                'kriteria' => 'tanggungan ortu',
                'bobot_prestasi' => 0,
                'bobot_beasiswa' => 10
            ],
            [
                'kriteria' => 'jarak rumah ke sekolah',
                'bobot_prestasi' => 0,
                'bobot_beasiswa' => 3
            ],
            [
                'kriteria' => 'status rumah',
                'bobot_prestasi' => 0,
                'bobot_beasiswa' => 6
            ]
        ];
        $this->db->table('kriteria')->insertBatch($data);
    }
}
