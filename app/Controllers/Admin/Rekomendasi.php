<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Rekomendasi extends BaseController
{
    public function beasiswa()
    {
        $data['title'] = 'Rekomendasi Beasiswa';
        return view('admin/rekomendasi-beasiswa', $data);
    }

    public function prestasi()
    {
        $data['title'] = 'Rekomendasi Prestasi';
        return view('admin/rekomendasi-prestasi', $data);
    }
}
