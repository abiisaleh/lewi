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
                'jk' => 'Perempuan',
                'tempt_lahir' => 'Timika',
                'tgl_lahir' => '2006-06-13',
                'agama' => 'Islam',
                'telp' => '082238204778',
                'telp_ortu' => '082238204776',
            ],
            [
                'nis' => '12123002',
                'nama' => 'Al Rahman Fazrin',
                'alamat' => 'Belakang Koramil, Abepura',
                'jk' => 'Laki-laki',
                'tempt_lahir' => 'Jayapura',
                'tgl_lahir' => '2006-12-12',
                'agama' => 'Islam',
                'telp' => '082238204773',
                'telp_ortu' => '082238204772',
            ],
        ];
        $this->db->table('siswa')->insertBatch($data);

        //guru
        $data = [
            [
                'nip' => '199208132006021001',
                'nama' => 'Aldi Arisandy',
                'gol' => 'IV',
                'ruang' => 'a',
                'tempt_lahir' => 'Toraja',
                'tgl_lahir' => '1992-08-13',
                'jk' => 'Laki-laki',
                'telp' => '082238204776',
            ],
        ];
        $this->db->table('guru')->insertBatch($data);

        //kelas
        for ($i = 1; $i <= 7; $i++) {
            $data = [
                'tingkat' => "X",
                'jurusan' => "",
                'kode' => $i
            ];
            $this->db->table('kelas')->insert($data);
        }

        $tingkat = ["XI", "XII"];
        $jurusan = ["IPA", "IPS", "BAHASA"];
        $kode = [1, 2, 3];

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
            'tahun_awal' => 2022,
            'tahun_akhir' => 2023,
            'semester' => 'I'
        ];
        $this->db->table('TA')->insert($data);

        //pelanggaran
        $data = [
            ['nama' => 'Tidak masuk sekolah tanpa keterangan (alpa)', 'jenis' => 'kerajinan', 'skor' => 8, 'ket' => 'Pembinaan Oleh Wali Kelas/Guru BP'],
            ['nama' => 'Tidak mengikuti doa/ibadah pagi, dan lainnya', 'jenis' => 'kerajinan', 'skor' => 8, 'ket' => 'Pembinaan Oleh Wali Kelas/Guru BP'],
            ['nama' => 'Tidak memasukkan baju (kecuali jam olahraga)', 'jenis' => 'kerapihan', 'skor' => 4, 'ket' => 'Peringatan Oleh Wali Kelas/Guru BP'],
            ['nama' => 'Tidak memakai kaos kaki', 'jenis' => 'kerapihan', 'skor' => 8, 'ket' => 'Peringatan Oleh Wali Kelas/Guru BP'],
            ['nama' => 'Mabuk/ membawa minuman keras', 'jenis' => 'sikap dan perilaku', 'skor' => 100, 'ket' => 'Dikeluarkan dari sekolah'],
            ['nama' => 'Membawa/ mengedarkan narkoba, obat/ zat aditif lainnya', 'jenis' => 'sikap dan perilaku', 'skor' => 100, 'ket' => 'Dikeluarkan dari sekolah'],
        ];
        $this->db->table('pelanggaran')->insertBatch($data);

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

        //Gruop Users
        $authorize = $auth = service('authorization');
        $authorize->addUserToGroup(1, 'admin');
        $authorize->addUserToGroup(2, 'guru');
        $authorize->addUserToGroup(3, 'siswa');
        $authorize->addUserToGroup(4, 'siswa');
    }
}
