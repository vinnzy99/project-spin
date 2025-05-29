<?php
namespace App\Controllers;
    use App\Models\UsersModel;
    use Config\Database;

class Home extends BaseController
{
    public function index(): string
    {
        return view('login');
    }

public function dologin()
{
    $noAgen = $this->request->getPost('no_agen');
    $noTelp = $this->request->getPost('no_telp');

    $validation = \Config\Services::validation();
    $validation->setRules([
        'no_agen' => 'required',
        'no_telp' => 'required|min_length[10]|numeric'
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()
            ->withInput()
            ->with('error', implode(', ', $validation->getErrors()));
    }

    $userModel = new \App\Models\UsersModel();
    $user = $userModel->where('no_agen', $noAgen)->first();

    if ($user) {
        if ($user['no_telp'] === $noTelp) {
            $userModel->update($user['id'], ['status' => 1]);

            session()->set('logged_in', true);
            session()->set('noAgen', $noAgen);
            session()->set('role', $user['role']); // SET SESSION ROLE

            // Redirect sesuai role
            if ($user['role'] === 'admin') {
                return redirect()->to('/admin/dashboard'); // arahkan ke halaman admin
            } else {
                return redirect()->to('/buktifoto');
            }
        } else {
            return redirect()->back()->with('error', 'Nomor telepon anda salah!');
        }
    } else {
        // Auto-assign role user
        $userModel->insert([    
            'no_agen' => $noAgen,
            'no_telp' => $noTelp,
            'status'  => 1,
            'role'    => 'user', // default user
        ]);

        session()->set('logged_in', true);
        session()->set('noAgen', $noAgen);
        session()->set('role', 'user');

        return redirect()->to('/buktifoto');
    }
}

public function bukti_foto()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('');
    }

    return view('bukti_foto');
}

public function logout()
{
    session()->destroy();
    return redirect()->to('');
}

public function kirimfoto()
{
    $session = session();
    $noAgen = $session->get('noAgen');
    $deskripsi = $this->request->getPost('deskripsi');
    $file = $this->request->getFile('foto');

    if ($file && $file->isValid() && !$file->hasMoved()) {
          $aseli = $file->getClientName();

          $file->move('assets/image', $aseli); // pastikan folder ini writable

        $pathFoto = 'assets/image/' . $aseli;

        $db = \Config\Database::connect();
      $db->table('bukti_foto')->insert([
    'no_agen' => $noAgen,
    'deskripsi' => $deskripsi,
    'path_foto' => $pathFoto,
    'status_verifikasi' => 'pending' // tambahkan field ini!
]);

        return redirect()->to('/spin');
    } else {
        return redirect()->back()->with('error', 'Upload gagal!');
    }
}

public function updateTurnLeftAndTotalSpin()
{
    // Ambil dari session, BUKAN dari request JSON
    $noAgen = session()->get('noAgen');
    $data = $this->request->getJSON();

    $turnLeft = $data->turnLeft ?? null;
    $totalSpin = $data->totalSpin ?? null;

    if (!$noAgen || $turnLeft === null || $totalSpin === null) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Data tidak lengkap'
        ]);
    }

    $userModel = new \App\Models\UsersModel();
    $user = $userModel->where('no_agen', $noAgen)->first();

    if (!$user) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Pengguna tidak ditemukan'
        ]);
    }

    $userModel->where('no_agen', $noAgen)
              ->set('turn_left', $turnLeft)
              ->set('total_spin', $totalSpin)
              ->update();

    return $this->response->setJSON([
        'status' => 'success',
        'turnLeft' => $turnLeft
    ]);
}


    // Method spin yang sudah ada
    public function spin2()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(''); // kembali ke halaman login jika belum login
        }

        $noAgen = session()->get('noAgen');
        $userModel = new \App\Models\UsersModel();
        $user = $userModel->where('no_agen', $noAgen)->first();

        $data = [
            'turn_left' => $user['turn_left'] ?? 0,
             'total_spin' => $user['total_spin'] ?? 0,
              'no_agen' => $noAgen 
        ];

        $db = Database::connect();

        $foto = $db->table('bukti_foto')
           ->where('no_agen', $noAgen)
           ->orderBy('id', 'DESC')
           ->get()
           ->getRow();

        return view('spin2', $data);
    }
}

    // public function register()
    // {
    //     return view('register');  // pastikan file register.php ada di folder 'app/Views/'
    // }

