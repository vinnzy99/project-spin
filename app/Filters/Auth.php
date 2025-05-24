<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    /**
     * Method yang dijalankan sebelum request diproses
     * 
     * @param RequestInterface $request
     * @param array|null $arguments
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah session 'logged_in' ada dan bernilai true
        if (!session()->get('logged_in')) {
            // Jika session 'logged_in' tidak ada atau false, arahkan ke halaman login
            return redirect()->to('/'); // Ganti dengan URL halaman login jika berbeda
        }
    }

    /**
     * Method yang dijalankan setelah request diproses
     * 
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array|null $arguments
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu diisi jika tidak ada logika setelah response
    }
}
