<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Database;

class Admin extends BaseController
{
   public function dashboard()
{
    if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
        return redirect()->to('/')->with('error', 'Akses ditolak.');
    }

    return view('admin/dashboard');
}

    public function verifikasiFoto()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }

        $db = Database::connect();
        $fotos = $db->table('bukti_foto')
                    ->where('status_verifikasi', 'pending')
                    ->get()
                    ->getResult();

        return view('admin/verifikasi_foto', ['fotos' => $fotos]);
    }

   public function setVerifikasi()
{
    if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
        return redirect()->to('/');
    }

    $id = $this->request->getPost('id');
    $aksi = $this->request->getPost('aksi');

    if (!$id || !in_array($aksi, ['terima', 'tolak'])) {
        return redirect()->back()->with('error', 'Data tidak lengkap atau tidak valid.');
    }

    $status = ($aksi === 'terima') ? 'diterima' : 'ditolak';

    $db = \Config\Database::connect(); // pastikan ini bukan 'use Config\Database;'

    $db->table('bukti_foto')->where('id', $id)->update(['status_verifikasi' => $status]);


    if ($status === 'diterima') {
        $foto = $db->table('bukti_foto')->where('id', $id)->get()->getRow();
        if ($foto) {
            $db->table('users')
               ->where('no_agen', $foto->no_agen)
               ->set('turn_left', 'turn_left + 1', false)
               ->update();
        }
    }

    return redirect()->to('/admin/verifikasi_foto')->with('success', 'Status diperbarui');
}

}
