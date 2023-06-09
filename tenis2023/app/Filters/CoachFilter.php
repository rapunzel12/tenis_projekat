<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CoachFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if(!$session->has("user")) {
            return redirect()->to(site_url('Guest'));
        }

        $user=$session->get('user');
            if($user->tip == 0) {
        
                return redirect()->to('Member'); 
            }
            if($user->tip == 1) {
            
                return redirect()->to('Student');
            }
    
            if($user->tip == 3) {
            
                return redirect()->to('Admin'); 
            }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}