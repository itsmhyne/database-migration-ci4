<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class IsLoggedIn implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // $uri = service('uri');
        // if ($uri->segment(1) == 'Dashboard') {
        //     if ($uri->segment(2) == '') 
        //         $segment = '/';
        //     else
        //         $segment = $uri->segment(2);

        //     return redirect()->to(base_url() . '/Auth/logout');

        // }
        if (!session()->get('is_logged_in')) {
            return redirect()->to(base_url() . '/Auth/logout');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
