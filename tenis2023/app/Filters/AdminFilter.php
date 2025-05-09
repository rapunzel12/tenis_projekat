<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
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
    
            if($user->tip == 2) {
            
                return redirect()->to('Coach'); 
            }
        
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}