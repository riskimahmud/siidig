<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika belum login
        if (!session()->has('user')) {
            return redirect()->to('/login');
        }

        if (session()->get('user')["level"] != "admin") {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Anda tidak memiliki akses', 0);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
