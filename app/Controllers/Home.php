<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (in_groups(['admin', 'guru'])) {
            return redirect()->to('admin');
        }

        $data['title'] = '';
        return view('user/index', $data);
    }

    public function siswa()
    {
        $nis = $this->request->getPost('nis');

        $data['title'] = 'Data Siswa';
        $data['siswa'] = model('SiswaModel')->find($nis);
        $data['kelas'] = model('SiswaKelasModel')->kelas($nis)->first();
        $data['skorPelanggaran'] = model('PelanggaranSiswaModel')->skor($nis);
        $data['pelanggaran'] = model('PelanggaranSiswaModel')->join('pelanggaran', 'pelanggaran.id = fkPelanggaran')->where('fkSiswa', $nis)->find();
        $data['nilai'] = model('SiswaModel')->find($nis);
        $data['absen'] = model('AbsensiModel')->where('fkSiswa', $nis)->where('tgl', date('Y-m-d'))->find($nis) ?? '';
        $data['prestasi'] = model('PrestasiModel')->where('fkSiswa', $nis)->find();

        return view('user/siswa', $data);
    }

    public function profile()
    {
        $profileUser = model('UserModel')->find(user()->id);
        if ($profileUser === null) {
            return redirect()->to('/')->with('error', 'Data akun tidak ditemukan.');
        }

        $name = $profileUser->nama ?? '';
        if ($name === '') {
            $guru = model('GuruModel')->find($profileUser->username);
            $siswa = model('SiswaModel')->find($profileUser->username);
            $name = $guru['nama'] ?? $siswa['nama'] ?? '';
        }

        return view('user/profile', [
            'title' => 'Profil Pengguna',
            'profileUser' => $profileUser,
            'name' => $name,
        ]);
    }

    public function updateProfile()
    {
        $name = trim((string) $this->request->getPost('nama'));
        $password = (string) $this->request->getPost('password');
        $rules = [
            'nama' => 'required|max_length[100]',
        ];

        if ($password !== '') {
            $rules['password'] = 'required';
            $rules['pass_confirm'] = 'required|matches[password]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $users = model('UserModel');
        $profileUser = $users->find(user()->id);
        if ($profileUser === null) {
            return redirect()->to('/')->with('error', 'Data akun tidak ditemukan.');
        }

        $profileUser->nama = $name;
        if ($password !== '') {
            $profileUser->password = $password;
        }

        if (! $users->save($profileUser)) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        return redirect()->to('profile')->with('message', 'Profil berhasil diperbarui.');
    }
}
